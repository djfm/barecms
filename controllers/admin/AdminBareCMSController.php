<?php

class AdminBareCMSController extends ModuleAdminController
{
    public function __construct()
    {
        $this->template = 'index.tpl';
        parent::__construct();
    }
}
