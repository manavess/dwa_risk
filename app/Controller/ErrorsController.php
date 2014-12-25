<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * CakePHP ErrorsController
 * @author prakash
 */
class ErrorsController extends AppController {
    public $name = 'Errors';

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('error404');
    }

    public function error404() {
        $this->layout = 'default';
    }
    
    public function error403($page){
        $this->layout = 'default';
        $this->set('page',$page);
    }
    
    public function missing_action($page){
        $this->layout = 'default';
        $this->set('page',$page);
    }

}
