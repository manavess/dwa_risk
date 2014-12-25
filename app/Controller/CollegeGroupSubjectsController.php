<?php

App::uses('AppController', 'Controller');

/**
 * CollegeGroupSubjects Controller
 *
 * @property CollegeGroupSubject $CollegeGroupSubject
 */
class CollegeGroupSubjectsController extends AppController {

    /**
     * Helpers
     *
     * @var array
     */
    public $helpers = array('Html', 'Js', 'Form');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->CollegeGroupSubject->recursive = 0;
        $this->set('collegeGroupSubjects', $this->paginate());
    }
}
