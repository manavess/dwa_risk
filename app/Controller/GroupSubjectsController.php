<?php

App::uses('AppController', 'Controller');

/**
 * GroupSubjects Controller
 *
 * @property GroupSubject $GroupSubject
 */
class GroupSubjectsController extends AppController {

    /**
     * Helpers
     *
     * @var array
     */
    public $helpers = array('Html', 'Js', 'Form');

    //public $uses = array('');
    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->GroupSubject->recursive = 0;
        $this->set('groupSubjects', $this->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->GroupSubject->exists($id)) {
            throw new NotFoundException(__('Invalid group subject'));
        }
        $options = array('conditions' => array('GroupSubject.' . $this->GroupSubject->primaryKey => $id));
        $groupSubjectData = $this->GroupSubject->find('first', $options);
        $this->loadModel('GroupSubSubject');
        $subjectIdArr = $this->GroupSubSubject->find('all', array('fields' => array('subject_id'), 'conditions' => array('group_subject_id=' . $id)));

        foreach ($subjectIdArr as $value) {
            $subjectId[] = $value['GroupSubSubject']['subject_id'];
        }
        if (!empty($subjectId)) {
            $this->loadModel('Subject');
            foreach ($subjectId as $value) {
                $subjectName[] = $this->Subject->find('first', array('fields' => array('name'), 'conditions' => array('Subject.id=' . $value)));
            }
            $subjectNames = '';
            foreach ($subjectName as $name) {
                $subjectNames .= $name['Subject']['name'] . ',';
            }
            $subjectNames = rtrim($subjectNames, ',');
        } else {
            $subjectNames = '';
        }

        $this->loadModel('User');
        $createUserId = $groupSubjectData['GroupSubject']['created_by'];
        $createUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $createUserId)));
        $modifyUserId = $groupSubjectData['GroupSubject']['modified_by'];
        $groupSubjectData['GroupSubject']['created'] = date("d-m-Y", strtotime($groupSubjectData['GroupSubject']['created']));
        $groupSubjectData['GroupSubject']['modified'] = date("d-m-Y", strtotime($groupSubjectData['GroupSubject']['modified']));
        $modifyUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $modifyUserId)));
        $this->loadModel('GroupSubSubject');
        $subjects = $this->GroupSubSubject->find('all', array('fields' => array('subject_id'), 'conditions' => array('group_subject_id' => $id)));
        $this->set('groupSubject', $groupSubjectData);
        $this->set('subjectName', $subjectNames);
        $this->set('createuser', $createUserData['User']['username']);
        $this->set('modifyuser', $modifyUserData['User']['username']);
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        $this->loadModel('Subject');
        $this->loadModel('GroupSubSubject');
        $subjects = $this->Subject->find('all', array('fields' => array('id', 'name')));
        $courses = $this->GroupSubject->Course->find('list',array('limit'=>2));
        $this->set('courses',$courses);
        //pr($courses);die;
        foreach ($subjects as $sub) {
            $subjct[$sub['Subject']['id']] = $sub['Subject']['name'];
        }

        $this->set('subjects', $subjct);

        if ($this->request->is('post')) {
           
            $this->GroupSubject->set($this->request->data);
            if ($this->GroupSubject->validates()) {


            $userid = $this->Session->read('Auth.User.id');
            $this->request->data['GroupSubject']['created_by'] = $userid;
            $groupsubject['name'] = $this->request->data['GroupSubject']['name'];
            $groupsubject['course_id'] = $this->request->data['GroupSubject']['course_id'];
            $groupsubject['status'] = $this->request->data['GroupSubject']['status'];
            $groupsubject['created_by'] = $userid;
           if(!empty($this->data['GroupSubSubject']['subject_id'])){
            $this->GroupSubject->create();
            
            
			
            if ($this->GroupSubject->saveAll($groupsubject)) {
                $id = $this->GroupSubject->getLastInsertId();
                $groupSubjectIDs = $this->data['GroupSubSubject']['subject_id'];
                if (!empty($groupSubjectIDs)) {
                    foreach ($groupSubjectIDs as $subjectspair) {
                        $groupsubjectpair[] = array('group_subject_id' => $id, 'subject_id' => $subjectspair, 'created_by' => $userid);
                    }
                    if ($this->GroupSubSubject->saveAll($groupsubjectpair)) {
                        $this->Session->setFlash(__('The group sub subject has been saved'));
                    }
                }

                $this->Session->setFlash('The group subject has been saved','default',array('class'=>'successmessage'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The group subject could not be saved. Please, try again.'));
            }
            }else{
            $this->Session->setFlash(__('You did not selected any subject. Please select some subjects to create group.'));
            }
        }else {
                // didn't validate logic
                $errors = $this->GroupSubject->validationErrors;
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
        if (!$this->GroupSubject->exists($id)) {
            throw new NotFoundException(__('Invalid group subject'));
        }

        $this->loadModel('Subject');
        $this->loadModel('GroupSubSubject');
        $subjects = $this->Subject->find('all', array('fields' => array('id', 'name')));
        $courses = $this->GroupSubject->Course->find('list',array('limit'=>2));
        $this->set('courses',$courses);

        foreach ($subjects as $sub) {
            $subjct[$sub['Subject']['id']] = $sub['Subject']['name'];
        }

        $this->set('subjects', $subjct);
        //finding selected subjects from group sub subjects

        $selectedSub = $this->GroupSubSubject->find('all', array('fields' => array('subject_id'), 'conditions' => array('GroupSubSubject.group_subject_id' => $id)));
        foreach ($selectedSub as $groupsubject) {
            $selectedSubId[] = $groupsubject['GroupSubSubject']['subject_id'];
        }
        if (!empty($selectedSubId)) {

            $this->set('selected', $selectedSubId);
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $userid = $this->Session->read('Auth.User.id');
 
            $groupsubject['id'] = $id;
            $groupsubject['name'] = $this->request->data['GroupSubject']['name'];
            $groupsubject['course_id'] = $this->request->data['GroupSubject']['course_id'];
            $groupsubject['status'] = $this->request->data['GroupSubject']['status'];
            $groupsubject['modified_by'] = $userid;
		 if(!empty($this->data['GroupSubSubject']['subject_id'])){
            if ($this->GroupSubject->saveAll($groupsubject)) {
                $this->GroupSubSubject->deleteAll(array('GroupSubSubject.group_subject_id' => $id), false);
                $groupSubjectIDs = $this->data['GroupSubSubject']['subject_id'];
                if (!empty($groupSubjectIDs)) {

                    foreach ($groupSubjectIDs as $subjectspair) {
                        $groupsubjectpair[] = array('group_subject_id' => $id, 'subject_id' => $subjectspair, 'created_by' => $userid);
                    }

                    if ($this->GroupSubSubject->saveAll($groupsubjectpair)) {
                        $this->Session->setFlash(__('The group subject has been saved'));
                    }
                }
                $this->Session->setFlash('The group subject has been saved','default',array('class'=>'successmessage'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The group subject could not be saved. Please, try again.'));
            }
            }else{
            $this->Session->setFlash(__('You did not selected any subject. Please select some subjects to create group.'));
            }
        } else {
            $options = array('conditions' => array('GroupSubject.' . $this->GroupSubject->primaryKey => $id));
            $this->request->data = $this->GroupSubject->find('first', $options);
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
        $this->loadModel('GroupSubSubject');
        $this->GroupSubject->id = $id;
        if (!$this->GroupSubject->exists()) {
            throw new NotFoundException(__('Invalid group subject'));
        }
        try {
        $this->request->onlyAllow('post', 'delete');
        $this->GroupSubSubject->deleteAll(array('GroupSubSubject.group_subject_id' => $id), false);
        if ($this->GroupSubject->delete()) {

            $this->Session->setFlash('Group subject deleted','default',array('class'=>'successmessage'));
            $this->redirect(array('action' => 'index'));
        }

         }catch ( Exception $e ) {   }
        $this->Session->setFlash(__('Group subject cannot be deleted as it has been used for various admissions'));

        $this->redirect(array('action' => 'index'));
    }

}
