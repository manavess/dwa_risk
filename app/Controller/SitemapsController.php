<?php
App::uses('AppController', 'Controller');
/**
 * Subscribermails Controller
 *
 * @property Subscribermail $Subscribermail
 */
class SitemapsController extends AppController {

/**
 * index method
 *
 * @return void
 */
 
 public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index');
    }
 
	public function index() {
		
		$this->loadModel('SubMenu');
		
		$sitemaps = $this->SubMenu->Query("SELECT menus.name, sub_menus.name, sub_menus.menu_id, sub_menus.url FROM sub_menus
INNER JOIN menus ON menus.id = sub_menus.menu_id WHERE sub_menus.require_login = 'N' AND sub_menus.status = 'Y' ORDER BY sub_menus.menu_id ASC LIMIT 0 , 30");
		//pr($query); die;
		
		foreach($sitemaps as $sitemap){
		
			//$sitem[$sitemap['menus']['name']]['submenu'][] = $sitemap['sub_menus']['name'];
			$sitem[$sitemap['menus']['name']][$sitemap['sub_menus']['name']]['url']= $sitemap['sub_menus']['url'];
		
		}
		
		$this->set('menus',$sitem);
		
	}


}
