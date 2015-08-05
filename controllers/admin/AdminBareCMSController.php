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

    private function vendorPath()
    {
        return implode(DIRECTORY_SEPARATOR, array_merge(
            [__DIR__, '..', '..', 'vendor'],
            func_get_args()
        ));
    }

    private function userCSSPath()
    {
        return implode(DIRECTORY_SEPARATOR, [
            __DIR__, '..', '..', 'data', 'user.css'
        ]);
    }

    private function addCodeMirror()
    {
        $this->addJS($this->vendorPath('codemirror.js'));
        $this->addJS($this->vendorPath('xml.js'));
        $this->addJS($this->vendorPath('css.js'));
        $this->addJS($this->vendorPath('javascript.js'));
        $this->addJS($this->vendorPath('htmlmixed.js'));
        $this->addCSS($this->vendorPath('codemirror.css'));
        return $this;
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

        return [
            'pages' => $pages,
            'edit_css_url' => $this->editCSSURL()
        ];
    }

    public function editRoute()
    {
        $this->addCodeMirror();

        $id     = Tools::getValue('id');
        $page   = new CMS($id, $this->context->language->id);

        if (!$page->meta_title) {
            $page->meta_title = $this->l('[untitled page]');
        }

        return [
            'page' => $page,
            'update_url' => $this->updateURL($id),
            'edit_css_url' => $this->editCSSURL()
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

    public function updateURL($id)
    {
        return $this->context->link->getAdminLink('AdminBareCMS') . '&route=update&id=' . $id;
    }

    public function editCSSRoute()
    {
        $cssPath = $this->userCSSPath();

        $css = '';
        if (file_exists($cssPath)) {
            $css = file_get_contents($cssPath);
        }

        $this->addCodeMirror();

        return [
            'css' => $css,
            'update_css_url' => $this->updateCSSURL()
        ];
    }

    public function editCSSURL()
    {
        return $this->context->link->getAdminLink('AdminBareCMS') . '&route=editCSS';
    }

    public function updateCSSRoute()
    {
        $css = Tools::getValue('code');
        file_put_contents($this->userCSSPath(), $css);
        $this->setRoute('editCSS');
    }

    public function updateCSSURL()
    {
        return $this->context->link->getAdminLink('AdminBareCMS') . '&route=updateCSS';
    }
}
