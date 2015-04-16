<?php

App::uses('AppController', 'Controller');
//ini_set('display_errors', 1);

/**
 * StudentAlotments Controller
 *
 * @property StudentAlotment $StudentAlotment
 */
class StudentAlotmentsController extends AppController {

    var $components = array('RequestHandler', 'Paginator');
    var $helpers = array("Html", "Form", "Session", 'Js', 'StdRegistrations');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->StudentAlotment->recursive = 0;
        $this->set('studentAlotments', $this->paginate());

        //$this->Session->write('download_students', '1=1');

        $this->loadModel('State');
        $this->loadModel('College');
        $this->loadModel('University');
        $this->loadModel('City');
        $this->loadModel('Course');

        $this->set('states', $this->State->find('list'));
        $this->set('universities', $this->University->find('list', array('order' => 'University.name ASC')));
        $this->set('colleges', $this->College->find('list', array('order' => 'College.name ASC')));
        $cities = $this->City->find('list');
        $this->set('cities', $cities);
        $this->set('courses', $this->Course->find('list', array('conditions' => array('id' => array(1, 2)))));

        /* Search methods */

        $conditions = array();

        if (!empty($this->request->data) || !empty($this->passedArgs['student_name']) || !empty($this->passedArgs['application_number']) || !empty($this->passedArgs['state_id']) || !empty($this->passedArgs['city_id']) || !empty($this->passedArgs['college_id']) || !empty($this->passedArgs['university_id']) || !empty($this->passedArgs['gender']) || !empty($this->passedArgs['course_id'])) {


            if (isset($this->request->data['Reset'])) {
                $this->redirect("/studentAlotments/index");
            }

            @$this->passedArgs['student_name'] = isset($this->request->data['StudentAlotment']['student_name']) ? $this->request->data['StudentAlotment']['student_name'] : $this->passedArgs['student_name'];

            @$this->passedArgs['application_number'] = isset($this->request->data['StudentAlotment']['application_number']) ? $this->request->data['StudentAlotment']['application_number'] : $this->passedArgs['application_number'];

            @$this->passedArgs['state_id'] = isset($this->request->data['StudentAlotment']['state_id']) ? $this->request->data['StudentAlotment']['state_id'] : $this->passedArgs['state_id'];

            @$this->passedArgs['city_id'] = isset($this->request->data['StudentAlotment']['city_id']) ? $this->request->data['StudentAlotment']['city_id'] : $this->passedArgs['city_id'];

            @$this->passedArgs['college_id'] = isset($this->request->data['StudentAlotment']['college_id']) ? $this->request->data['StudentAlotment']['college_id'] : $this->passedArgs['college_id'];

            @$this->passedArgs['university_id'] = isset($this->request->data['StudentAlotment']['university_id']) ? $this->request->data['StudentAlotment']['university_id'] : $this->passedArgs['university_id'];

            @$this->passedArgs['gender'] = isset($this->request->data['StudentAlotment']['gender']) ? $this->request->data['StudentAlotment']['gender'] : $this->passedArgs['gender'];

            @$this->passedArgs['course_id'] = isset($this->request->data['StudentAlotment']['course_id']) ? $this->request->data['StudentAlotment']['course_id'] : $this->passedArgs['course_id'];




            if (!empty($this->passedArgs['student_name'])) {

                $conditions[] = "StudentRegistration.applicant_name LIKE '" . $this->passedArgs['student_name'] . "%'";
            }

            if (!empty($this->passedArgs['application_number'])) {
                $conditions[] = "StudentRegistration.application_number ='" . $this->passedArgs['application_number'] . "'";
            }

            if (!empty($this->passedArgs['state_id'])) {
                $conditions[] = "StudentRegistration.state_id ='" . $this->passedArgs['state_id'] . "'";
            }

            if (!empty($this->passedArgs['city_id'])) {
                $conditions[] = "StudentRegistration.city_id ='" . $this->passedArgs['city_id'] . "'";
            }
            $iscollege = 0;
            if (!empty($this->passedArgs['college_id'])) {
                $iscollege = 1;
                $conditions[] = "Colleges.id ='" . $this->passedArgs['college_id'] . "'";
            }

            if (!empty($this->passedArgs['university_id'])) {

                $Collegelistid = $this->College->find('all', array('fields' => array('id', 'university_id'), 'conditions' => array('College.university_id' => $this->passedArgs['university_id'])));

                $collegeidlist = array();
                $collegelist = '';
                if (!empty($Collegelistid)) {
                    foreach ($Collegelistid as $collegeID) {
                        $collegeidlist[] = $collegeID['College']['id'];
                    }
                    $collegelist = implode(',', $collegeidlist);
                }

                $conditions[] = "Colleges.id IN (" . $collegelist . ")";
            }

            if (!empty($this->passedArgs['gender'])) {
                $conditions[] = "StudentRegistration.gender ='" . $this->passedArgs['gender'] . "'";
            }

            if (!empty($this->passedArgs['course_id'])) {
                $conditions[] = "StudentAlotment.course_id ='" . $this->passedArgs['course_id'] . "'";
            }



            //$data = $this->StudentAlotment->find('count',array('conditions'=>array('StudentAlotment.course_id'=> $this->passedArgs['course_id'])));
            //pr($data);die;
            //$this->Session->write('download_students',$data);

            $this->set('studentAlotments', $this->paginate('StudentAlotment', $conditions));
            
            $this->set('universityID', $this->passedArgs['university_id']);
            $this->set('colleges', $this->College->find('list', array('conditions' => array('College.university_id' => $this->passedArgs['university_id']), 'order' => 'College.name ASC')));
            $this->set('cities', $this->City->find('list', array('conditions' => array('City.state_id' => $this->passedArgs['state_id']))));
            //$this->set('courses', $this->Course->find('list',array('conditions' => array('StudentAlotment.course_id' => $this->passedArgs['course_id']))));
            $this->set('collegeID', $this->passedArgs['college_id']);
            $this->set('stateID', $this->passedArgs['state_id']);
            $this->set('cityID', $this->passedArgs['city_id']);
            $this->set('genderID', $this->passedArgs['gender']);
            $this->set('courseID', $this->passedArgs['course_id']);
            if ($iscollege == 1) {
                $this->Session->write('download_students', @$conditions[0]);
                $this->Session->write('iscollege', 1);
            } else if ($iscollege == 0) {
                $this->Session->write('download_students', @$conditions[0]);
                $this->Session->write('iscollege', 0);
            }
        } else {
            //pr($this->paginate()); exit;
            $this->set('studentAlotments', $this->paginate());
            //pr($conditions); die;
            $this->Session->write('download_students', @$conditions[0]);
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
        if (!$this->StudentAlotment->exists($id)) {
            throw new NotFoundException(__('Invalid student alotment'));
        }
        $options = array('conditions' => array('StudentAlotment.' . $this->StudentAlotment->primaryKey => $id));
        $this->set('studentAlotment', $this->StudentAlotment->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->StudentAlotment->create();
            if ($this->StudentAlotment->save($this->request->data)) {
                $this->Session->setFlash(__('The student alotment has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The student alotment could not be saved. Please, try again.'));
            }
        }
        $studentRegistrations = $this->StudentAlotment->StudentRegistration->find('list');
        $collegeGroupSubjects = $this->StudentAlotment->CollegeGroupSubject->find('list');
        $this->set(compact('studentRegistrations', 'collegeGroupSubjects'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->StudentAlotment->exists($id)) {
            throw new NotFoundException(__('Invalid student alotment'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->StudentAlotment->save($this->request->data)) {
                $this->Session->setFlash(__('The student alotment has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The student alotment could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('StudentAlotment.' . $this->StudentAlotment->primaryKey => $id));
            $this->request->data = $this->StudentAlotment->find('first', $options);
        }
        $studentRegistrations = $this->StudentAlotment->StudentRegistration->find('list');
        $collegeGroupSubjects = $this->StudentAlotment->CollegeGroupSubject->find('list');
        $this->set(compact('studentRegistrations', 'collegeGroupSubjects'));
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
        $this->StudentAlotment->id = $id;
        if (!$this->StudentAlotment->exists()) {
            throw new NotFoundException(__('Invalid student alotment'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->StudentAlotment->delete()) {
            $this->Session->setFlash('Student alotment deleted', 'default', array('class' => 'successmessage'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Student alotment was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    public function download_nominated_student() {


        $conditions = $this->Session->read('download_students');
        $iscollege = $this->Session->read('iscollege');
        if (!empty($iscollege)) {
            $this->set('coll', 1);
        } else {
            $this->set('coll', 0);
        }
        $this->Session->delete('download_students');
        $this->Session->delete('iscollege');
        $this->set('nominate', $conditions);
        //print_r($conditions);die;
        $nominatedstudentDetails = $this->StudentAlotment->find('all', array('conditions' => $conditions));

        //$nominatedstudentDetails = $this->StudentAlotment->query($query);

        if (!empty($nominatedstudentDetails)) {
            $this->set('studentAlotments', $nominatedstudentDetails);

            $year = '2014';
            $this->layout = 'nominatedstudents';
        } else {
            $this->Session->setFlash(__('No data is there to download'));
            $this->redirect("/StudentAlotments");
        }
    }

    public function listallocatedpercentage() {

        $this->StudentAlotment->recursive = 3;
        $db = $this->StudentAlotment->getDataSource();

        /**/
        $this->loadModel('College');
        $this->loadModel('University');
        $this->set('universities', $this->University->find('list', array('order' => 'University.name ASC')));
        $this->set('colleges', $this->College->find('list', array('order' => 'College.name ASC')));

        $conditions = array();

        if (!empty($this->request->data)) {

            if (!empty($this->request->data['StudentAlotment']['college_id'])) {
                $conditions[] = "Colleges.id =" . $this->request->data['StudentAlotment']['college_id'] . "";
            }

            $this->set('collegeid', $this->request->data['StudentAlotment']['college_id']);
            $this->paginate = array(
                'conditions' => $conditions,
                'fields' => array('max(StudentAlotment.grade) as grade ', 'StudentAlotment.allocation_year', 'StudentAlotment.college_id',
                    '(SELECT total_percentage
                                        FROM student_registrations
                                        WHERE id = (select a.student_registration_id from ' . $db->fullTableName($this->StudentAlotment) . ' a WHERE StudentAlotment.college_id = a.college_id AND a.grade = max(StudentAlotment.grade)))as total_percentage'),
                'group' => array('StudentAlotment.college_id'),
                'order' => array('StudentAlotment.allocation_year')
            );

            $this->set('listallocatedpercentage', $this->paginate('StudentAlotment'));
        }
        /**/


        $this->paginate = array(
            'conditions' => $conditions,
            'fields' => array('max(StudentAlotment.grade) as grade ', 'StudentAlotment.allocation_year', 'StudentAlotment.college_id',
                '(SELECT total_percentage
                                        FROM student_registrations
                                        WHERE id = (select a.student_registration_id from ' . $db->fullTableName($this->StudentAlotment) . ' a WHERE StudentAlotment.college_id = a.college_id AND a.grade = max(StudentAlotment.grade)))as total_percentage'),
            'group' => array('StudentAlotment.college_id'),
            'order' => array('StudentAlotment.allocation_year')
        );

        //echo "<pre>"; print_r($this->paginate('StudentAlotment')); die;

        $this->set('listallocatedpercentage', $this->paginate('StudentAlotment'));
    }

    public function download_listallocated_percentage() {

        $this->StudentAlotment->recursive = 3;
        $db = $this->StudentAlotment->getDataSource();

        /**/
        $this->loadModel('College');
        $this->loadModel('University');
        $this->set('universities', $this->University->find('list', array('order' => 'University.name ASC')));
        $this->set('colleges', $this->College->find('list', array('order' => 'College.name ASC')));

        $conditions = array();
        if (!empty($this->request->data)) {

            if (!empty($this->request->data['StudentAlotment']['college_id'])) {
                $conditions[] = "College.id ='" . $this->request->data['StudentAlotment']['college_id'] . "'";
            }
            $this->set('collegeid', $this->request->data['StudentAlotment']['college_id']);
        }
        /**/


        $con = array(
            'conditions' => $conditions,
            'fields' => array('max(StudentAlotment.grade) as grade ', 'StudentAlotment.allocation_year', 'StudentAlotment.college_id',
                '(SELECT total_percentage
                            FROM student_registrations
                            WHERE id = (select a.student_registration_id from ' . $db->fullTableName($this->StudentAlotment) . ' a WHERE StudentAlotment.college_id = a.college_id AND a.grade = max(StudentAlotment.grade)))as total_percentage'),
            'group' => array('StudentAlotment.college_id'),
            'order' => array('StudentAlotment.allocation_year')
        );

        $alllcatedpercentageDetails = $this->StudentAlotment->find("all", $con);

        if (!empty($alllcatedpercentageDetails)) {
            $this->set('listallocatedpercentage', $alllcatedpercentageDetails);
            $year = Date('Y');
            $this->layout = 'nominatedstudents'; //this will use the pdf.ctp layout
        } else {
            $this->flash(__('No data is there to download'), array('action' => 'index'));
        }
    }

    /* Exception report */

    public function exception() {

        $this->loadModel('University');
        $this->loadModel('College');
        $this->loadModel('Course');
        $this->set('universities', $this->University->find('list', array('order' => 'University.name ASC')));
        $this->set('courses', $this->Course->find('list', array('conditions' => array('id' => array(1, 2)))));
        $conditions = array();
        if (!empty($this->request->data) || !empty($this->passedArgs['university_id']) || !empty($this->passedArgs['course_id'])) {

            @$this->passedArgs['university_id'] = isset($this->request->data['StudentAlotment']['university_id']) ? $this->request->data['StudentAlotment']['university_id'] : $this->passedArgs['university_id'];
            
            @$this->passedArgs['course_id'] = isset($this->request->data['StudentAlotment']['course_id']) ? $this->request->data['StudentAlotment']['course_id'] : $this->passedArgs['course_id'];

            if (!empty($this->passedArgs['university_id'])) {

                $Collegelistid = $this->College->find('all', array('fields' => array('id', 'university_id'), 'conditions' => array('College.university_id' => $this->passedArgs['university_id'])));

                $collegeidlist = array();
                $collegelist = '';
                if (!empty($Collegelistid)) {
                    foreach ($Collegelistid as $collegeID) {
                        $collegeidlist[] = $collegeID['College']['id'];
                    }
                    $collegelist = implode(',', $collegeidlist);
                }

                $conditions[] = "Colleges.id IN (" . $collegelist . ")";
                $this->Session->write('collegeid', $collegelist);
            }
            
            if (!empty($this->passedArgs['course_id'])) {
                $conditions[] = "StudentAlotment.course_id ='" . $this->passedArgs['course_id'] . "'";
            }
            
            $this->set('universityID', $this->passedArgs['university_id']);
            $this->set('courseID', $this->passedArgs['course_id']);
            
            $this->Session->write('universityid', $this->passedArgs['university_id']);
            $this->Session->write('courseid', $this->passedArgs['course_id']);
        }

        $this->StudentAlotment->recursive = 3;
        $db = $this->StudentAlotment->getDataSource();



        $this->paginate = array(
            'conditions' => $conditions,
            'fields' => array('StudentAlotment.course_id', 'StudentAlotment.allocation_year',
                'StudentAlotment.college_id',
                'count(StudentAlotment.id) as opt',
                'count(case when StudentRegistration.gender="M" then 1 end) as malecount',
                'count(case when StudentRegistration.gender="F" then 1 end) as femalecount'),
            'group' => array('StudentAlotment.college_id',
                'StudentAlotment.course_id'),
        );

        //$this->Session->write('exceptionsadmission',$this->paginate('StudentAlotment'));
        $this->set('exceptionallotment', $this->paginate('StudentAlotment'));
    }

    public function download_exceptions() {
        $conditions = '';
        $university_id = '';
        $course_id = '';
        $conditions = $this->Session->read('collegeid');
        $university_id = $this->Session->read('universityid');
        $course_id = $this->Session->read('courseid');
        
        $this->set('university_id', $university_id);
        $this->set('course_id', $course_id);
        
        
        //pr($university_id);die;

        $this->StudentAlotment->recursive = 3;
        $db = $this->StudentAlotment->getDataSource();
        $cn=array();
        if (!empty($conditions)) {
            $cn[] = 'StudentAlotment.college_id IN(' . $conditions . ')';
        } else {
            $cn[] = NULL;
        }
        
        if(!empty($course_id))
        {
            $cn[] = 'StudentAlotment.course_id IN('.$course_id.')';
        }else {
            $cn[] = NULL;
        }
        
        
        $condi = array(
            'conditions' => $cn,
            'fields' => array('StudentAlotment.course_id', 'StudentAlotment.allocation_year',
                'StudentAlotment.college_id', 'max(StudentAlotment.grade) as grade ',
                'count(StudentAlotment.id) as opt',
                'count(case when StudentRegistration.gender="M" then 1 end) as malecount',
                'count(case when StudentRegistration.gender="F" then 1 end) as femalecount',
            ),
            'group' => array('StudentAlotment.college_id',
                'StudentAlotment.course_id'),
        );
        
        $this->Session->delete('collegeid');
        $this->Session->delete('universityid');
        $this->Session->delete('courseid');

        //$exceptionsadmissions = $this->Session->read('exceptionsadmission');
        $exceptionsadmissions = $this->StudentAlotment->find('all', $condi);
        if (!empty($exceptionsadmissions)) {
            $this->set('exceptionsadmissions', $exceptionsadmissions);
            $year = Date('Y');
            $this->layout = 'nominatedstudents';
            //$conditions = $this->Session->delete('collegeid');
        } else {
            $this->flash(__('No data is there to download'), array('action' => 'index'));
        }
    }

    public function getcitylist() {
        $this->layout = null;
        $this->loadModel('City');
        $state_id = $this->request->data['State'];
        $cities = $this->City->find('list', array('conditions' => array('state_id' => $state_id, 'City.status' => 'Y')));
        $this->set('cities', $cities);
    }

    function getcollegelist() {
        $this->layout = null;
        $this->loadModel('College');
        $university_id = $this->request->data['university_id'];
        $colleges = $this->College->find('list', array('conditions' => array('College.university_id' => $university_id)));
        $this->set('colleges', $colleges);
    }

    public function allocationcancellation() {
        $this->loadModel('StudentAlotmentDetail');
        $this->loadModel('AllocationCancellation');

        $allocatedyear = $this->StudentAlotmentDetail->find('list', array('fields' => array('year'), 'order' => array('year' => 'DESC')));
        $this->set('allocatedyear', $allocatedyear);

        $selectedyear = $this->StudentAlotmentDetail->find('first', array('fields' => array('year'), 'conditions' => array('id' => $this->data['StudentAlotment']['year'])));

        $this->Session->write('alocatedyr', $selectedyear['StudentAlotmentDetail']['year']);
        
        if (!empty($this->data['StudentAlotment']['year'])) {

            $this->StudentAlotment->deleteAll(array('StudentAlotment.allocation_year' => $selectedyear['StudentAlotmentDetail']['year']), false);
            $this->StudentAlotmentDetail->delete($this->data['StudentAlotment']['year']);
            
            $userid = $this->Session->read('Auth.User.id');

            $this->AllocationCancellation->create(false);
            $this->AllocationCancellation->set(array(
                'id' => NUll,
                'year' => $this->Session->read('alocatedyr'),
                'cancelled_by' => $userid,
                'created_by' => $userid
            ));
            $this->AllocationCancellation->save();
            $this->Session->setFlash(__('Allocation has been Cancelled'));
            $this->redirect(array('action' => 'allocationcancellation'));
        } else {
            
        }
    }

}
