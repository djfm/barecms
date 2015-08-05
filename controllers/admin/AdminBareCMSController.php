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
            if (empty($page['meta_title'])) {
                $page['meta_title'] = $this->l('[untitled page]');
            }
            return $page;
        }, CMS::getCMSPages($this->context->language->id));

        return ['pages' => $pages];
    }

    private function vendorPath()
    {
        return implode(DIRECTORY_SEPARATOR, array_merge(
            [__DIR__, '..', '..', 'vendor'],
            func_get_args()
        ));
    }

    public function editRoute()
    {
        $this->addJS($this->vendorPath('codemirror.js'));
        $this->addJS($this->vendorPath('xml.js'));
        $this->addJS($this->vendorPath('css.js'));
        $this->addJS($this->vendorPath('javascript.js'));
        $this->addJS($this->vendorPath('htmlmixed.js'));
        $this->addCSS($this->vendorPath('codemirror.css'));

        $id     = Tools::getValue('id');
        $page   = new CMS($id, $this->context->language->id);

        if (!$page->meta_title) {
            $page->meta_title = $this->l('[untitled page]');
        }

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
