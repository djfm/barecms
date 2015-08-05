<?php
/*
* 2007-2014 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2014 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

if (!defined('_PS_VERSION_'))
	exit;

class BareCMS extends Module
{
	public function __construct()
	{
		$this->name = 'barecms';
		$this->tab = 'content_management';
		$this->version = '0.0.1';
		$this->author = 'fmdj';

		parent::__construct();

		$this->displayName = $this->l('Bare CMS');
		$this->description = $this->l('Know HTML? Then use it!');
	}

	public function installTab()
	{
		$tab = new Tab();
		$tab->active = 1;
		$tab->class_name = 'AdminBareCMS';
		$tab->name = array();
		foreach (Language::getLanguages(true) as $lang) {
			$tab->name[$lang['id_lang']] = $this->l('Bare CMS');
		}
		$tab->id_parent = -1;
		$tab->module = $this->name;
		return $tab->add();
	}
	public function uninstallTab()
	{
		$id_tab = (int)Tab::getIdFromClassName('AdminBareCMS');
		if ($id_tab) {
			$tab = new Tab($id_tab);
			return $tab->delete();
		} else {
			return false;
		}
	}

	public function install()
	{
		return parent::install() && $this->installTab() && $this->registerHook('header');
	}

	public function uninstall()
	{
		return parent::uninstall() && $this->uninstallTab();
	}

	public function getContent()
	{
		Tools::redirectAdmin($this->context->link->getAdminLink('AdminBareCMS'));
	}

	public function hookHeader()
	{
		if ('CmsController' === get_class($this->context->controller)) {
			$cssPath = implode(DIRECTORY_SEPARATOR, [
				__DIR__,
				'data', 'user.css'
			]);
			if (file_exists($cssPath)) {
				$this->context->controller->addCSS($cssPath);
			}
		}
	}
}
