<?php

App::uses('AppController', 'Controller');

/**
 * GroupSubSubjects Controller
 *
 * @property GroupSubSubject $GroupSubSubject
 */
class GroupSubSubjectsController extends AppController {

    /**
     * Helpers
     *
     * @var array
     */
    public $helpers = array('Html', 'Form', 'Js');

    /**
     * index method
     *
     * @return void
     */
    // public $paginate = array('group' => 'GroupSubSubject.group_subject_id');

    public function index() {
        $this->GroupSubSubject->recursive = 0;
        //pr($this->paginate()); die;

        $this->set('groupSubSubjects', $this->paginate());
    }
}