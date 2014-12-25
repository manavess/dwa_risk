<?php

App::uses('AppController', 'Controller');

/**
 * Gradepoints Controller
 *
 * @property Gradepoint $Gradepoint
 */
class GradepointsController extends AppController {

    /**
     * index method
     *
     * @return void

     * 
     */
    public $uses = array('Gradepoint', 'StudentRegistration');
    public $helpers = array('Html', 'Form', 'Js');

    public function index() {
        $this->Gradepoint->recursive = 0;
        $options = '';

        if (!empty($this->request->data) || !empty($this->passedArgs['year'])) {
            
            if (isset($this->request->data['Reset'])) {
                $this->redirect("/gradepoints/index");
            }
            
            $this->passedArgs['year'] = isset($this->request->data['Gradepoint']['year']['year']) ? $this->request->data['Gradepoint']['year']['year'] : $this->passedArgs['year'];
            if (!empty($this->request->data['Gradepoint']['year']['year'])) {
                $options = array('Gradepoint.year' => $this->request->data['Gradepoint']['year']['year']);
                $this->set('selectedyear', $this->request->data['Gradepoint']['year']['year']);
            } elseif (!empty($this->passedArgs['year'])) {
                $options = array('Gradepoint.year' => $this->passedArgs['year']);
                $this->set('selectedyear', $this->passedArgs['year']);
            } else {
                $options = '';
            }
        }

        $this->set('gradepoints', $this->paginate($options));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        $this->Gradepoint->recursive = 1;

        if (!$this->Gradepoint->exists($id)) {
            throw new NotFoundException(__('Invalid gradepoint'));
        }
        $options = array('conditions' => array('Gradepoint.' . $this->Gradepoint->primaryKey => $id));

        $this->set('gradepoint', $this->Gradepoint->find('first', $options));
//                $studentregistrations = $this->StudentRegistration->find('all',array('fields'=>array('applicant_name')));
//                $this->set('studentRegistrations',$studentregistrations);
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {

            $check = $this->checkgifexist($this->request->data['Gradepoint']['gradepoints'], $this->request->data['Gradepoint']['year']);
            if ($check) {
                $this->Session->setFlash(__('This grade/point already exists. Please, try another.'));

                $this->redirect(array('action' => 'add'));
            } else {

                $userid = $this->Session->read('Auth.User.id');
                $this->request->data['Gradepoint']['created_by'] = $userid;
                $this->Gradepoint->create();
                $this->Gradepoint->data['Gradepoint']['year'] = $this->request->data['Gradepoint']['year'];
                $userid = $this->Session->read('Auth.User.id');
                $this->Gradepoint->data['Gradepoint']['created_by'] = $userid;
                $this->request->data['Gradepoint']['modified_by'] = $userid;
                if ($this->Gradepoint->save($this->request->data)) {
                    $this->Session->setFlash('Gradepoint has been saved successfully', 'default', array('class' => 'successmessage'));
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The gradepoint could not be saved. Please, try again.'));
                }
            }
        }
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Gradepoint->exists($id)) {
            throw new NotFoundException(__('Invalid gradepoint'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $userid = $this->Session->read('Auth.User.id');
            $this->request->data['Gradepoint']['modified_by'] = $userid;

            if ($this->Gradepoint->save($this->request->data)) {
                $this->Session->setFlash('Gradepoint has been saved successfully', 'default', array('class' => 'successmessage'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The gradepoint could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Gradepoint.' . $this->Gradepoint->primaryKey => $id));
            $this->request->data = $this->Gradepoint->find('first', $options);
        }
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @throws MethodNotAllowedException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Gradepoint->id = $id;
        if (!$this->Gradepoint->exists()) {
            throw new NotFoundException(__('Invalid gradepoint'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Gradepoint->delete()) {
            $this->Session->setFlash('Gradepoint deleted', 'default', array('class' => 'successmessage'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Gradepoint was not deleted'));
        $this->redirect(array('action' => 'index'));
    }
    
    public function checkgifexist($g, $year){
        $grade = $this->Gradepoint->find('first',array('conditions'=>array('Gradepoint.gradepoints'=>$g,'Gradepoint.year'=>$year)));
        
        if(!empty($grade)){
            return true;
        }else{
            return false;
        }
        
    }

}
