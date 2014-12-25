<?php

App::uses('AppController', 'Controller');

/**
 * Colleges Controller
 *
 * @property College $College
 */
class CollegesController extends AppController {

    /**
     * Helpers
     *
     * @var array
     */
    public $helpers = array('Html', 'Form', 'Session');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('generalcollegeview', 'course', 'saveGroupSubject', 'RemoveGroupSubject', 'download_list_of_colleges');

        ini_set('memory_limit', '-1');
        $default = ini_get('max_execution_time');
        set_time_limit($default);
    }

    /**
     * index method
     *
     * @return void
     */
    public function index() {

        $this->College->recursive = 0;
        $universities = $this->College->University->find('list', array('University.name asc'));
        $collegedata = $this->College->find('list', array('College.name asc'));
        $this->set(compact('collegedata', 'universities'));

        /* Search methods */

        $conditions = array();

        if (!empty($this->request->data) || !empty($this->passedArgs['university_name'])) {
            if (isset($this->request->data['Reset'])) {
                $this->redirect("/colleges/index");
            }


            $this->passedArgs['university_name'] = isset($this->request->data['College']['university_name']) ? $this->request->data['College']['university_name'] : $this->passedArgs['university_name'];

            if (!empty($this->request->data['College']['college_name'])) {
                $conditions[] = "College.id ='" . $this->request->data['College']['college_name'] . "'";
            }

            if (!empty($this->passedArgs['university_name'])) {
                $conditions[] = "College.university_id ='" . $this->passedArgs['university_name'] . "'";
            }

            if (!empty($this->request->data['College']['collegecode'])) {
                $conditions[] = "College.college_code ='" . $this->request->data['College']['collegecode'] . "'";
            }

            $data = $this->College->find('all', array('conditions' => $conditions));

            $this->Session->write('download_collegelist', $conditions);
            $this->Session->write('univ_id', $this->passedArgs['university_name']);

            $this->set('colleges', $this->paginate('College', $conditions));

            $collegedata = $this->College->find('list', array('conditions' => array('College.university_id' => $this->passedArgs['university_name'])));
            $universitydata = $this->passedArgs['university_name'];
            $this->set(compact('collegedata', 'universitydata'));
        } else {
            //pr($this->paginate()); exit;


            $this->set('colleges', $this->paginate());
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
        //$this->loadModel('CollegeGroupSubject');
        if (!$this->College->exists($id)) {
            throw new NotFoundException(__('Invalid college'));
        }
        $options = array('conditions' => array('College.' . $this->College->primaryKey => $id));
        $collegeData = $this->College->find('first', $options);
        $this->loadModel('User');
        $createUserId = $collegeData['College']['created_by'];
        $createUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $createUserId)));
        $modifyUserId = $collegeData['College']['modified_by'];
        $collegeData['College']['created'] = date("d-m-Y", strtotime($collegeData['College']['created']));
        $collegeData['College']['modified'] = date("d-m-Y", strtotime($collegeData['College']['modified']));
        $modifyUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $modifyUserId)));
        $this->loadModel('CollegeGroupSubject');

        $this->CollegeGroupSubject->recursive = 2;
        $GroupSubjects_seats = $this->CollegeGroupSubject->find('all', array('fields' => array('CollegeGroupSubject.group_subjects_id,CollegeGroupSubject.no_of_seat'), 'conditions' => array('CollegeGroupSubject.college_id' => $id)));
        $this->set('GroupSubjects_seats', $GroupSubjects_seats);
        $this->set('college', $collegeData);
        $this->set('createuser', $createUserData['User']['username']);
        $this->set('modifyuser', $modifyUserData['User']['username']);
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {

        /* to filter college code */
        $this->College->recursive = -1;
        $collegecode = $this->College->find('all', array('fields' => array('college_code')));
        foreach ($collegecode as $code) {
            $collegeCode[] = $code['College']['college_code'];
        }

        if ($this->request->is('post')) {

            if (isset($this->request->data['Reset'])) {
                $this->redirect("/colleges/add");
            }

            $this->request->data['College']['affilated_from'] = date("Y-m-d", strtotime($this->request->data['College']['affilated_from']));
            $this->request->data['College']['affilated_to'] = date("Y-m-d", strtotime($this->request->data['College']['affilated_to']));
            $userid = $this->Session->read('Auth.User.id');
            $this->request->data['College']['created_by'] = $userid;
            $this->College->create();

            $college_no_of_seat = array();
            $remove = array(0);
            $blank_array = array('');



            $this->request->data['CollegeGroupSubject']['no_of_seat'] = $this->request->data['CollegeGroupSubject']['no_of_seat'];
            $result = array_filter($this->request->data['CollegeGroupSubject']['group_subjects_id']);

            $college_no_of_seat = array_filter($this->request->data['CollegeGroupSubject']['no_of_seat']);

            $collegesubgroupitem = array();
            $groupnumofseat = array();
            if (!empty($result) && !empty($college_no_of_seat)) {
                foreach ($result as $key => $val) {
                    $groupSubjectID[] = $val;
                }

                foreach ($college_no_of_seat as $key => $val) {
                    $groupnumofseat[] = $val;
                }


                for ($i = 0; $i < count($groupSubjectID); $i++) {

                    if (!empty($groupnumofseat[$i])) {
                        $collegesubgroupitem[$groupSubjectID[$i]] = $groupnumofseat[$i];
                    }
                }
            }

            if (!in_array($this->data['College']['college_code'], $collegeCode, TRUE)) {
                if ($this->College->save($this->request->data)) {
                    $Collegeid = $this->College->getLastInsertID();
                    $numofseat = 0;
                    $groupsubjectmessage = '';
                    if (!empty($collegesubgroupitem)) {
                        foreach ($collegesubgroupitem as $key => $val) {
                            $collegegroupsubjectpair[] = array('college_id' => $Collegeid, 'group_subjects_id' => $key, 'no_of_seat' => $val, 'created_by' => $userid);
                            $numofseat = $numofseat + $val;
                        }


                        $numofseatupdate = array('no_of_seats' => $numofseat);
                        $this->College->updateAll($numofseatupdate, array('College.id' => $Collegeid));
                        $this->College->CollegeGroupSubject->saveAll($collegegroupsubjectpair);
                    } else {
                        $groupsubjectmessage = 'You did not selected any of the group subject or did not fill number of seat so subject group has not been saved for this college';
                    }


                    $this->Session->setFlash('The college has been saved. <br />' . $groupsubjectmessage, 'default', array('class' => 'successmessage'));

                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The college could not be saved. Please, try again.'));
                }
            } else {
                $this->Session->setFlash(__('The college could not be saved due to duplicate college code. Please enter a unique college code'));
            }
        }
        $cities = $this->College->City->find('list', array('conditions' => array('City.status' => 'Y')));
        //$groupsubjects = $this->College->CollegeGroupSubject->GroupSubjects->find('all');
        $states = $this->College->State->find('list', array('conditions' => array('State.status' => 'Y')));
        $universities = $this->College->University->find('list');
        $groupsubjects = $this->College->CollegeGroupSubject->GroupSubjects->find('all', array('conditions' => array('GroupSubjects.status' => 'Y')));

        $this->set(compact('cities', 'states', 'universities', 'groupsubjects'));
    }

    public function edit($id = null) {
        if (!$this->College->exists($id)) {
            throw new NotFoundException(__('Invalid college'));
        }

        $Collegegroupsubjects = $this->College->CollegeGroupSubject->find('all', array('fields' => array('group_subjects_id', 'no_of_seat'), 'conditions' => array('CollegeGroupSubject.college_id' => $id)));

        $this->set('CollegeGroupSubject', $Collegegroupsubjects);
        if ($this->request->is('post') || $this->request->is('put')) {

            $remove = array(0);
            $blank_no_seat = array(0);
            $result = array_filter($this->request->data['CollegeGroupSubject']['group_subjects_id']);
            $result_no_of_seat = array_filter($this->request->data['CollegeGroupSubject']['no_of_seat']);

            if (!empty($result)) {
                foreach ($result as $key => $val) {

                    $groupSubjectID[] = $val;
                }
                //making proper array of no of seats//
                foreach ($result_no_of_seat as $key => $val) {
                    if (!empty($val)) {
                        $no_of_seat[] = $val;
                    }
                }

                $collegesubgroupitem = array();
                for ($i = 0; $i < count($groupSubjectID); $i++) {
                    if (!empty($no_of_seat[$i])) {
                        $collegesubgroupitem[$groupSubjectID[$i]] = $no_of_seat[$i];
                    }
                }
            }
            $this->request->data['College']['affilated_from'] = date("Y-m-d", strtotime($this->request->data['College']['affilated_from']));
            $this->request->data['College']['affilated_to'] = date("Y-m-d", strtotime($this->request->data['College']['affilated_to']));
            $userid = $this->Session->read('Auth.User.id');
            $this->request->data['College']['modified_by'] = $userid;

            if ($this->College->save($this->request->data)) {
                if (!empty($collegesubgroupitem)) {

                    /* saving college sub group table content */
                    $numofseat = 0;


                    foreach ($collegesubgroupitem as $key => $val) {
                        //$collegegroupsubjectpair[] = array('college_id' => $id, 'group_subjects_id' => $key, 'no_of_seat' => $val, 'modified_by' => $userid);
                        $numofseat = $numofseat + $val;
                    }

                    $numofseatupdate = array('no_of_seats' => $numofseat);
                    $this->College->updateAll($numofseatupdate, array('College.id' => $id));

                    //$this->College->CollegeGroupSubject->saveAll($collegegroupsubjectpair);
                }

                $this->Session->setFlash('The college has been saved. ', 'default', array('class' => 'successmessage'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The college could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('College.' . $this->College->primaryKey => $id));
            $this->request->data = $this->College->find('first', $options);
            $this->request->data['College']['affilated_from'] = date("d-m-Y", strtotime($this->request->data['College']['affilated_from']));
            $this->request->data['College']['affilated_to'] = date("d-m-Y", strtotime($this->request->data['College']['affilated_to']));
        }
        $cities = $this->College->City->find('list');
        $states = $this->College->State->find('list');
        $universities = $this->College->University->find('list');
        $groupsubjects = $this->College->CollegeGroupSubject->GroupSubjects->find('all', array('conditions' => array('GroupSubjects.status' => 'Y')));
        $this->set(compact('cities', 'states', 'universities', 'groupsubjects'));
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
        $this->College->id = $id;
        if (!$this->College->exists()) {
            throw new NotFoundException(__('Invalid college'));
        }

        try {
            $this->request->onlyAllow('post', 'delete');
            $this->College->CollegeGroupSubject->deleteAll(array('CollegeGroupSubject.college_id' => $id), false);
            if ($this->College->delete()) {
                $this->Session->setFlash('College deleted', 'default', array('class' => 'successmessage'));
                $this->redirect(array('action' => 'index'));
            }
        } catch (Exception $e) {
            
        }
        $this->Session->setFlash(__('College cannot be deleted because it has been used for other sections'));
        $this->redirect(array('action' => 'index'));
    }

    public function generalcollegeview() {
        $this->College->recursive = 2;
        // $Colleges = $this->College->find('all', array('condition' => array('College.university_id' => 'University.id')));
        //$this->set('colleges', $Colleges);

        $this->set('colleges', $this->paginate());
    }

    public function course() {
        $id = $this->params['pass'];
        $id = $id[0];

        $Colleges = $this->College->find('first', array('conditions' => array('College.id' => $id)));
        $this->loadModel('CollegeGroupSubject');
        $collegegroupSubjectIdArr = $this->CollegeGroupSubject->find('first', array('fields' => array('group_subjects_id'), 'conditions' => array('CollegeGroupSubject.college_id' => $id)));
        $subjectName = '';
        $SubjectIdArr = '';
        $SubjectArr = '';
        if (!empty($collegegroupSubjectIdArr)) {
            $this->loadModel('GroupSubSubject');
            $SubjectIdArr = $this->GroupSubSubject->find('all', array('fields' => array('subject_id'), 'conditions' => array('GroupSubSubject.group_subject_id' => $collegegroupSubjectIdArr['CollegeGroupSubject']['group_subjects_id'])));

            foreach ($SubjectIdArr as $data) {
                $this->loadModel('Subject');
                $SubjectArr[] = $this->Subject->find('first', array('fields' => array('name'), 'conditions' => array('Subject.id' => $data['GroupSubSubject']['subject_id'])));
            }
            if (!empty($SubjectArr)) {
                foreach ($SubjectArr as $value) {
                    $subjectName[] = $value['Subject']['name'];
                }
                $subjectName = implode(',', $subjectName);
            }
        }
        $this->set('colleges', $Colleges);
        $this->set('subjects', $subjectName);
    }

    public function download_list_of_colleges() {

        $condition = $this->Session->read('download_collegelist');
        $univid = $this->Session->read('univ_id');
        $university_name = array();
        
        if (!empty($univid)) {
            $university_name = $this->College->University->find('first', array('fields' => array('University.name'), 'conditions' => array('University.id' => $univid)));
            unset($_SESSION['univ_id']);
            $this->set('university', $university_name);
        }
        unset($_SESSION['download_collegelist']);

        $colleges = $this->College->find('all', array('conditions' => $condition));

        $this->set('colleges', $colleges);
    }

    function getcollecode() {
        $data = array();
        $collegeid = '';
        if (!empty($this->data['college_id'])) {
            $collegeid = $this->data['college_id'];

            $data = $this->College->find('first', array('fields' => array('college_code'), 'conditions' => array('College.id' => $collegeid)));
        }
        if (!empty($data)) {
            echo $data['College']['college_code'];
        } else {
            echo "";
        }
        exit;
    }

    function saveGroupSubject() {
        $this->layout = false;
        if ($this->request->is('post') || $this->request->is('put')) {

            $this->loadModel('CollegeGroupSubject');
            $iscollegegrpid = array();
            $msg = '';
            $iscollegegrpid = $this->CollegeGroupSubject->read('', @$this->request->data['Colgrpsubid']);
            $colgrpid = '';
            if (!empty($this->request->data['Colgrpsubid']) && !empty($iscollegegrpid)) {
                $colgrpid = $this->request->data['Colgrpsubid'];
                $this->request->data['CollegeGroupSubject']['id'] = $this->request->data['Colgrpsubid'];
                $this->request->data['CollegeGroupSubject']['college_id'] = $this->request->data['collegeID'];
                $this->request->data['CollegeGroupSubject']['group_subjects_id'] = $this->request->data['group_sub_id'];
                $this->request->data['CollegeGroupSubject']['no_of_seat'] = $this->request->data['no_of_seat'];

                $this->CollegeGroupSubject->save($this->request->data['CollegeGroupSubject']);
                $msg = '{"msg":"Record Updated Successfully","Colgrpsubid":"' . $colgrpid . '"}';

                echo $msg;
                //return $msg;
                exit;
            } else {

                $this->request->data['CollegeGroupSubject']['college_id'] = $this->request->data['collegeID'];
                $this->request->data['CollegeGroupSubject']['group_subjects_id'] = $this->request->data['group_sub_id'];
                $this->request->data['CollegeGroupSubject']['no_of_seat'] = $this->request->data['no_of_seat'];

                $this->CollegeGroupSubject->save($this->request->data['CollegeGroupSubject']);
                $echocollegegrpid = $this->CollegeGroupSubject->getLastInsertID();

                //echo $echocollegegrpid;
                $msg = '{"msg":"Record Added Successfully","Colgrpsubid":"' . $echocollegegrpid . '"}';
                echo $msg;

                exit;
            }
            exit;
        }
    }

    function RemoveGroupSubject() {
        $this->layout = false;
        if ($this->request->is('post') || $this->request->is('put')) {

            $this->loadModel('CollegeGroupSubject');
            $this->loadModel('StudentPreferedColleges');

            if (!empty($this->request->data['Colgrpsubid'])) {

                $isprefered = $this->StudentPreferedColleges->find('first', array('conditions' => array('StudentPreferedColleges.college_group_subject_id' => $this->request->data['Colgrpsubid'])));

                if (empty($isprefered)) {
                    $this->CollegeGroupSubject->delete($this->request->data['Colgrpsubid']);


                    $msg = '{"msg":"Group Subject removed successfully","Colgrpsubid":""}';
                    echo $msg;
                    exit;
                } else {
                    // echo "This colleges group subject has been used in admission so you can't remove it";
                    $msg = '{"msg":"This colleges group subject has been used in admission so you cannot remove it","Colgrpsubid":"' . $this->request->data['Colgrpsubid'] . '"}';
                    echo $msg;
                    exit;
                }
            } else {
                exit;
            }
        }
    }

}
