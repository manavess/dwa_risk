<?php

App::uses('AppController', 'Controller');


class MapsController extends AppController {

    /**
     * Helpers
     *
     * @var array
     */
    public $helpers = array('Html', 'Form', 'Js',);


	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index');
    }
    /**
     * index method
     *
     * @return void
     */
    
    public function index() {
        //$this->AdmissionGuide->recursive = 0;
        //$this->set('galleries', $this->paginate());
    }
}

    
