<?php

App::uses('AppController', 'Controller');

/**
 * Courses Controller
 *
 * @property Course $Course
 */
class CoursesController extends AppController {

    /**
     * Helpers
     *
     * @var array
     */
    public $helpers = array('Html', 'Form', 'Js');

//public $uses = array('Subject');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Course->recursive = 0;
        $coursedata = $this->paginate();
        $allcourse = array();
        foreach ($coursedata as $value) {

            $courses['Course']['id'] = $value['Course']['id'];
            $courses['Course']['name'] = $value['Course']['name'];
            $courses['Course']['no_of_subject'] = $value['Course']['no_of_subject'];
            if (!empty($value['Course']['compulsary_subject'])) {
                $courses['Course']['compulsary_subject'] = $this->getSubjectName($value['Course']['compulsary_subject']);
            } else {
                $courses['Course']['compulsary_subject'] = '';
            }
            $allcourse[] = $courses;
        }

        $this->set('courses', $allcourse);
    }

    function getSubjectName($compsubject = null) {
        if (!empty($compsubject)) {
            $this->loadModel('Subject');
            $subjects = array();
            $subjectName = array();
            $data = explode(',', $compsubject);
            foreach ($data as $subjecID) {

                if ($subjecID) {
                    $subjects = $this->Subject->find('first', array('fields' => array('name'), 'conditions' => array('Subject.id=' . $subjecID)));
                    $subjectName[] = $subjects['Subject']['name'];
                }
            }
            $totalcompsubject = '';
            $totalcompsubject = implode(',', $subjectName);

            return $totalcompsubject;
        }
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Course->exists($id)) {
            throw new NotFoundException(__('Invalid course'));
        }
        $options = array('conditions' => array('Course.' . $this->Course->primaryKey => $id));
        $courseData = $this->Course->find('first', $options);

        $complusarySubject = $courseData['Course']['compulsary_subject'];
        if ($complusarySubject) {
            $courseIdArr = explode(',', $complusarySubject);
            $this->loadModel('Subject');
            foreach ($courseIdArr as $value) {
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
        $createUserId = $courseData['Course']['created_by'];
        $createUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $createUserId)));
        $modifyUserId = $courseData['Course']['modified_by'];
        $courseData['Course']['created'] = date("d-m-Y", strtotime($courseData['Course']['created']));
        $courseData['Course']['modified'] = date("d-m-Y", strtotime($courseData['Course']['modified']));
        $modifyUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $modifyUserId)));
        $this->set('course', $courseData);
        $this->set('subjectname', $subjectNames);
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

        $subjects = $this->Subject->find('all', array('fields' => array('id', 'name')));

        foreach ($subjects as $sub) {
            $subjct[$sub['Subject']['id']] = $sub['Subject']['name'];
        }

        $this->set('subjects', $subjct);

        if ($this->request->is('post')) {
            $this->Course->set($this->request->data);

            if ($this->Course->validates()) {
                $countsubject = 0;
                if (!empty($this->data['Course']['compulsary_subject'])) {
                    $countsubject = count($this->data['Course']['compulsary_subject']);
                    $sub = implode(',', $this->data['Course']['compulsary_subject']);
                    $this->request->data['Course']['compulsary_subject'] = $sub;
                } else {
                    $this->request->data['Course']['compulsary_subject'] = '';
                }
                $userid = $this->Session->read('Auth.User.id');
                $this->request->data['Course']['created_by'] = $userid;
                $this->Course->create();
                if (!empty($countsubject) && $countsubject <= $this->request->data['Course']['no_of_subject']) {
                    if ($this->Course->save($this->request->data)) {
                        $this->Session->setFlash('The course has been saved', 'default', array('class' => 'successmessage'));
                        $this->redirect(array('action' => 'index'));
                    } else {
                        $this->Session->setFlash(__('The course could not be saved. Please, try again.'));
                    }
                } else {
                    $this->Session->setFlash(__('Compulsary subjects selected should be less than number of subject!.'));
                }
            } else {
                // didn't validate logic
                $errors = $this->Course->validationErrors;
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
        $this->loadModel('Subject');

        $subjects = $this->Subject->find('all', array('fields' => array('id', 'name')));

        foreach ($subjects as $sub) {
            $subjct[$sub['Subject']['id']] = $sub['Subject']['name'];
        }
        $this->set('subjects', $subjct);

        $comsub = $this->Course->find('first', array('fields' => array('compulsary_subject'), 'conditions' => array('Course.id' => $id)));

        $selectedSub = array($comsub['Course']['compulsary_subject']);
        $this->set('selected', $selectedSub);
        if (!$this->Course->exists($id)) {
            throw new NotFoundException(__('Invalid course'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {

            if (!empty($this->data['Course']['compulsary_subject'])) {
                $sub = implode(',', $this->data['Course']['compulsary_subject']);
                $this->request->data['Course']['compulsary_subject'] = $sub;
            } else {
                $this->request->data['Course']['compulsary_subject'] = '';
            }

            $userid = $this->Session->read('Auth.User.id');
            $this->request->data['Course']['modified_by'] = $userid;
            if ($this->Course->save($this->request->data)) {
                $this->Session->setFlash('The course has been saved', 'default', array('class' => 'successmessage'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The course could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Course.' . $this->Course->primaryKey => $id));
            $this->request->data = $this->Course->find('first', $options);
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
        $this->Course->id = $id;
        if (!$this->Course->exists()) {
            throw new NotFoundException(__('Invalid course'));
        }
        try {
            $this->request->onlyAllow('post', 'delete');
            if ($this->Course->delete()) {
                $this->Session->setFlash('Course deleted', 'default', array('class' => 'successmessage'));
                $this->redirect(array('action' => 'index'));
            }
        } catch (Exception $e) {
            
        }
        $this->Session->setFlash(__('Course cannot be deleted because it has been used at other sections'));
        $this->redirect(array('action' => 'index'));
    }

}
