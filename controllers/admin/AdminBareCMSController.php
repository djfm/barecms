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
        $this->setView($name);
        $this->route = $name;

        $methodName = $name . 'Route';
        $this->context->smarty->assign(
            $this->$methodName()
        );
    }

    private function setView($name)
    {
        $this->template = $name . '.tpl';
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
        $this->addJS(implode(DIRECTORY_SEPARATOR, [__DIR__, '..', '..', 'vendor', 'codemirror.min.js']));
        $this->addCSS(implode(DIRECTORY_SEPARATOR, [__DIR__, '..', '..', 'vendor', 'codemirror.css']));

        $id     = Tools::getValue('id');
        $page   = new CMS($id, $this->context->language->id);

        return [
            'page' => $page,
            'update_url' => $this->context->link->getAdminLink('AdminBareCMS') . '&route=update&id=' . $id
        ];
    }

    public function updateRoute()
    {
        $page = new CMS(Tools::getValue('id'), $this->context->language->id);

        $page->meta_title = Tools::getValue('title');
        $page->meta_description = Tools::getValue('description');
        $page->content = Tools::getValue('code');

        $page->save();
        $this->setRoute('edit');
    }
}
