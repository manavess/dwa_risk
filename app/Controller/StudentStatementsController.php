<?php

App::uses('AppController', 'Controller');

/**
 * StudentRegistrations Controller
 *
 * @property StudentStatement $StudentStatement
 */
class StudentStatementsController extends AppController {

    /**
     * Helpers
     *
     * @var array
     */
    public $helpers = array('Html', 'Form', 'Js','StdRegistrations');
    public $uses = array('StudentRegistration', 'StudentSubjects', 'StudentPreferedCollege');
    public $components = array('Email');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('admissionstatement','getstudentdetails','getcourse_year');
    }

    public function index() {
        
    }

    public function student_admisson_statement() {
        
    }

    public function admissionstatement() {
        $application_num = '';
        $application_num = $this->Session->read('stdregistrationID'); /* Registration id in session for enrolled student */
        $groupcollege = array();
        $allotedcollege = array();
        $collegedata = array();
        $this->loadModel('StudentPreferedColleges');
        $this->loadModel('StudentRegistration');
        $this->loadModel('StudentAlotment');
        $this->loadModel('StudentGrade');
        if (!empty($application_num)) {
            $this->StudentRegistration->recursive = 0;
            $registrationid = $this->StudentRegistration->find('first', array('conditions' => array('StudentRegistration.id' => $application_num)));

            if (!empty($registrationid['StudentRegistration']['id'])) {
                /* Checking marks exitst also in grade table */


                if (!empty($registrationid['StudentRegistration']['total_percentage'])) {

                    $studentgrade = $this->StudentGrade->find('first', array('conditions' => array('StudentGrade.student_registration_id' => $registrationid['StudentRegistration']['id'])));

                    if (!empty($studentgrade)) {
                        $marksinpercentage = $this->getPercentageofGrade($registrationid['StudentRegistration']['total_percentage']);
                        $registrationid['totalmarks'] = $marksinpercentage;
                    }
                }

                $this->set('totalpercentage', $registrationid);
                $this->StudentPreferedColleges->recursive = 3;

                if (!empty($registrationid['StudentRegistration']['id'])) {
                    $groupcollege = $this->StudentPreferedColleges->find('all', array('fields' => array('college_group_subject_id'), 'conditions' => array('StudentPreferedColleges.student_registration_id' => $registrationid['StudentRegistration']['id'])));


                    $this->StudentAlotment->recursive = 3;
                    $allotedcollege = $this->StudentAlotment->find('first', array('conditions' => array('StudentAlotment.student_registration_id' => $registrationid['StudentRegistration']['id'])));

                    if (!empty($allotedcollege)) {
                        $this->set('grade', $allotedcollege);
                    }

                    if (!empty($allotedcollege)) {
                        $collegedata = $this->StudentPreferedColleges->CollegeGroupSubject->find('first', array('conditions' => array('CollegeGroupSubject.id' => $allotedcollege['StudentAlotment']['college_group_subject_id'])));
                    }
                }


                if (!empty($collegedata)) {
                    $this->set('allotedcollege', $collegedata);
                }

                //$this->set('groupcollege',$groupcollege);

                $collegegroupsubjcts = array();
                $prefernce = array();
                $h = 1;

                if (!empty($collegedata)) {
                    foreach ($groupcollege as $collegegroup) {
                        if (!empty($collegegroup['CollegeGroupSubject']['id'])) {
                            $collegegroupsubjcts[] = $collegegroup['CollegeGroupSubject']['id'];
                            $prefernce[$collegegroup['StudentPreferedColleges']['college_group_subject_id']] = $h;
                        $h++;
                        }
                    }
                }

//pr($prefernce); die;
            $this->set('preferences',$prefernce);
                if (!empty($collegegroupsubjcts)) {
                    $collegegroupsubjcts = implode(',', $collegegroupsubjcts);
                }

                /**/
                $db = $this->StudentAlotment->getDataSource();

//                $this->paginate = array(
//                    'conditions' => array('StudentAlotment.college_group_subject_id in (' . $collegegroupsubjcts . ')'),
//                    'fields' => array('max(StudentAlotment.grade) as grade ', 'StudentAlotment.allocation_year', 'StudentAlotment.college_group_subject_id',
//                        '(SELECT total_percentage
//					FROM student_registrations
//					WHERE id = (select a.student_registration_id from ' . $db->fullTableName($this->StudentAlotment) . ' a WHERE StudentAlotment.college_group_subject_id = a.college_group_subject_id AND a.grade = max(StudentAlotment.grade)))as total_percentage'),
//                    'group' => array('StudentAlotment.college_group_subject_id'),
//                    'order' => array('StudentAlotment.allocation_year')
//                );

                $cxd = $this->StudentAlotment->find('all', array(
                    'conditions' => array('StudentAlotment.college_group_subject_id in (' . $collegegroupsubjcts . ')'),
                    'fields' => array('max(StudentAlotment.grade) as grade ', 'StudentAlotment.allocation_year', 'StudentAlotment.college_group_subject_id',
                       '(SELECT total_percentage FROM student_registrations WHERE id = (select a.student_registration_id from ' . $db->fullTableName($this->StudentAlotment) . ' a WHERE StudentAlotment.college_group_subject_id = a.college_group_subject_id AND a.grade = max(StudentAlotment.grade)))as total_percentage'),
                    'joins' => array(
                    array(
                        'type' => 'left',
                        'table' => 'student_prefered_colleges',
                        'alias' => 'StudentPreCol',
                        'foreign_key' => '',
                        'conditions' => array('StudentAlotment.student_registration_id = StudentPreCol.student_registration_id')
                    )
                ),
                'group' => 'StudentAlotment.college_group_subject_id',
                'order' => 'StudentPreCol.college_preference ASC'
                ));

                /**/
                //pr($this->paginate('StudentAlotment')); exit;
                $this->set('studentallocation', $cxd);
            }
        }
    }

    public function getcourse_year() {
        $registrationid = array();
        if (!empty($this->request->data['applicationNum'])) {

            $this->loadModel('StudentRegistration');
            $this->StudentRegistration->recursive = 3;
            $registrationid = $this->StudentRegistration->find('first', array('conditions' => array('StudentRegistration.application_number' => $this->request->data['applicationNum'])));
        }
        //pr($registrationid); die;
        if (!empty($registrationid)) {
            echo '{"studentID":"' . $registrationid['StudentRegistration']['applicant_name'] . '","year":"' . date('Y', strtotime($registrationid['StudentRegistration']['created'])) . '"}';
        } else {
            echo '{"studentID":"","year":""}';
        }
        exit;
    }

    public function getstudentdetails() {

        $this->layout = null;
        $groupcollege = array();
        $allotedcollege = array();
        $collegedata = array();
        $this->loadModel('StudentPreferedColleges');
        $this->loadModel('StudentRegistration');
        $this->loadModel('StudentAlotment');

        if (!empty($this->request->data['applicationNum'])) {
            $this->StudentRegistration->recursive = 0;

            $registrationid = $this->StudentRegistration->find('first', array('conditions' => array('StudentRegistration.application_number' => $this->request->data['applicationNum'])));
            if(empty($registrationid)){
               $this->redirect("StudentStatements/student_admisson_statement"); 
            }

            $this->set('totalpercentage', $registrationid);

            $this->StudentPreferedColleges->recursive = -1;
            if (!empty($registrationid['StudentRegistration']['id'])) {
                $groupcollege = $this->StudentPreferedColleges->find('all', array('fields' => array('college_id', 'college_preference'), 'conditions' => array('StudentPreferedColleges.student_registration_id' => $registrationid['StudentRegistration']['id']), 'order' => array('StudentPreferedColleges.college_preference ASC')));

                $this->set('groupcollege', $groupcollege);
                
                $qery = "select colleges.name,colleges.college_code,colleges.id,colleges.university_id, student_prefered_colleges.college_id,student_prefered_colleges.college_preference from student_prefered_colleges INNER JOIN student_registrations on student_registrations.id=student_prefered_colleges.student_registration_id INNER JOIN colleges on colleges.id=student_prefered_colleges.college_id INNER JOIN student_alotments on student_alotments.student_registration_id=student_prefered_colleges.student_registration_id where student_prefered_colleges.student_registration_id=".$registrationid['StudentRegistration']['id']." order by student_prefered_colleges.college_preference ";
                $prefferedcolleges = $this->StudentPreferedColleges->query($qery);
                
                $this->set('prefferedcolleges',$prefferedcolleges);
                
                

                $this->StudentAlotment->recursive = 3;
                $allotedcollege = $this->StudentAlotment->find('first', array('conditions' => array('StudentAlotment.student_registration_id' => $registrationid['StudentRegistration']['id'])));
                if (!empty($allotedcollege)) {
                    $this->set('grade', $allotedcollege);
                }
                if (!empty($allotedcollege)) {
                    $collegedata = $this->StudentPreferedColleges->Colleges->find('first', array('conditions' => array('Colleges.id' => $allotedcollege['StudentAlotment']['college_id'])));
                }
            }


            if (!empty($collegedata)) {
                $this->set('allotedcollege', $collegedata);
            }
            $collegegroupsubjcts = array();
            $prefernce = array();
            if (!empty($groupcollege)) {
                $g = 1;
                
                foreach ($groupcollege as $collegegroup) {
                    if (!empty($collegegroup['StudentPreferedColleges']['college_id'])) {
                        $collegegroupsubjcts[] = $collegegroup['StudentPreferedColleges']['college_id'];
                        $prefernce[$collegegroup['StudentPreferedColleges']['college_id']] = $g;
                        $g++;
                    }
                }
            }
            
            $this->set('preferences',$prefernce);

//            if (!empty($collegegroupsubjcts)) {
//                $collegegroupsubjcts = implode(',', $collegegroupsubjcts);
//            }
//pr($groupcollege); echo $collegegroupsubjcts; die;
            /**/
//            $db = $this->StudentAlotment->getDataSource();
//
//
//            $this->paginate = array(
//                'conditions' => array('StudentAlotment.college_id in (' . $collegegroupsubjcts . ')'),
//                'fields' => array('max(StudentAlotment.grade) as grade ', 'StudentAlotment.allocation_year', 'StudentAlotment.college_id',
//                    '(SELECT total_percentage
//			FROM student_registrations
//			WHERE id = (select a.student_registration_id from ' . $db->fullTableName($this->StudentAlotment) . ' a WHERE StudentAlotment.college_id = a.college_id AND a.grade = max(StudentAlotment.grade)))as total_percentage'),
//                'group' => array('StudentAlotment.college_id')
//                
//            );
//
//            /**/
////pr($this->paginate('StudentAlotment'));die;
//            if (!empty($collegegroupsubjcts)) {
//               
//                $this->set('studentallocation', $this->paginate('StudentAlotment'));
//            }
        }
    }

    private function getPercentageofGrade($gradeval) {

        $this->loadModel('Gradepoint');
        $this->loadModel('AdminPreference');

        $markslimit = $this->AdminPreference->find('first', array('fields' => array('markslimit'), 'conditions' => array('year' => date('Y'))));

        if (!empty($gradeval)) {
            $subjectpercentagemarks = $this->Gradepoint->find('first', array('fields' => array('lowerlimit', 'id'), 'conditions' => array('gradepoints' => $gradeval)));

            if (!empty($subjectpercentagemarks)) {
                $lowerlimit = $subjectpercentagemarks['Gradepoint']['lowerlimit'];
            }

            $markspercentage = ($lowerlimit * $markslimit['AdminPreference']['markslimit']) / 100;

            return $percentagemarks = $markspercentage + $lowerlimit;
        } else {
            return false;
        }
    }

}
