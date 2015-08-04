<?php

class AdminBareCMSController extends ModuleAdminController
{
    private $route;

    public function __construct()
    {
        $this->bootstrap    = true;
        parent::__construct();
    }

    private function setRoute($name)
    {
        $this->template = $name . '.tpl';
        $this->route = $name;

        $methodName = $name . 'Route';
        $this->context->smarty->assign(
            $this->$methodName()
        );
    }

    public function postProcess()
    {
        if (($route = Tools::getValue('route'))) {
            $this->setRoute($route);
        } else {
            $this->setRoute('index');
        }
    }

    public function indexRoute()
    {
        $pages = array_map(function ($page) {
            $page['edit_url'] = $this->context->link->getAdminLink('AdminBareCMS') . '&route=edit&id=' . $page['id_cms'];
            return $page;
        }, CMS::getCMSPages($this->context->language->id));

        return ['pages' => $pages];
    }

    public function editRoute()
    {
        $page = new CMS(Tools::getValue('id'), $this->context->language->id);
        return ['page' => $page];
    }
}
