<?php

App::uses('AppController', 'Controller');

/**
 * StudentRegistrations Controller
 *
 * @property StudentRegistration $StudentRegistration
 */
class StudentRegistrationsController extends AppController {

    /**
     * Helpers
     *
     * @var array
     */
    public $helpers = array('Html', 'Form', 'Js','StdRegistrations');
    public $uses = array('StudentRegistration', 'Country','StudentSecondarySchDetail', 'State', 'City', 'StudentGrade', 'StudentSubjects', 'StudentPreferedCollege','StudentAmendment');
    public $components = array('Email');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login', 'registerstudent','getregsubjectlist','getsubmarks', 'studentinfoboard', 'reciept', 'getcitylist', 'getstatelist', 'getsubjectlist', 'getcollegelist', 'calculatepercentage', 'download_document','changecollege');
        //$group_id = $this->Session->read('Auth.User.group_id');
        //if (isset($group_id) && $this->action == 'login')
        //  $this->deshboard($this->Session->read('Auth.User.group_id'));
    }

    /**
     * index method
     *
     * @return void
     */

    public function index() {

        $this->StudentRegistration->recursive = 0;

        $this->loadModel('College');
        $this->loadModel('University');

        $this->set('universities', $this->University->find('list', array('order' => 'University.name ASC')));
        $this->set('colleges', $this->College->find('list'));
        $conditions = array();
        $collegeGroupsubjectID = array();
        $grpsubid = array();
        $grpsubimplodedid = '';
        $totalregid = array();
        $whereRegID = '';
        $data = array();
        
        /*check for edit and delete after alotment*/
        $isallocatted = array();
        $this->loadModel("StudentAlotmentDetail");
        $isallocatted = $this->StudentAlotmentDetail->find('first', array('conditions' => array('YEAR(StudentAlotmentDetail.created)' => date('Y'))));
        
        if (!empty($isallocatted )) {

            $this->set('isalloted','Y');
        }
        /**/
        if (!empty($this->request->data) || !empty($this->passedArgs['college_id']) || !empty($this->passedArgs['university_id']) || !empty($this->passedArgs['year'])) {

            if (isset($this->request->data['Reset'])) {
                $this->redirect("/StudentRegistrations/index");
            }

            $this->loadModel('CollegeGroupSubject');

            if (!empty($this->request->data['StudentRegistration']['college_id']) || !empty($this->passedArgs['college_id'])) {

                @$this->passedArgs['college_id'] = isset($this->request->data['StudentRegistration']['college_id']) ? $this->request->data['StudentRegistration']['college_id'] : $this->passedArgs['college_id'];
                $collegeGroupsubjectID = $this->CollegeGroupSubject->find('all', array('conditions' => array("CollegeGroupSubject.college_id ='" . $this->passedArgs['college_id'] . "'")));

                foreach ($collegeGroupsubjectID as $colleg_group_subjecID) {
                    $grpsubid[] = $colleg_group_subjecID['CollegeGroupSubject']['id'];
                }

                if (!empty($grpsubid)) {
                    $grpsubimplodedid = implode(',', $grpsubid);
                    $conditions[] =
                            "StudentPreferedColleges.college_group_subject_id IN (" . $grpsubimplodedid . ")";
                } else {
                    $conditions[] = '';
                }
            }


            @$this->passedArgs['university_id'] = isset($this->request->data['StudentRegistration']['university_id']) ? $this->request->data['StudentRegistration']['university_id'] : $this->passedArgs['university_id'];
            if (!empty($this->passedArgs['university_id']) || !empty($this->request->data['StudentRegistration']['university_id'])) {


                $Collegelistid = $this->College->find('all', array('fields' => array('id', 'university_id'), 'conditions' => array('College.university_id' => $this->passedArgs['university_id'])));
                $collegeidlist = array();
                $collegelist = '';
                if (!empty($Collegelistid)) {
                    foreach ($Collegelistid as $collegeID) {
                        $collegeidlist[] = $collegeID['College']['id'];
                    }
                    $collegelist = implode(',', $collegeidlist);
                }

                $collegegrpidlist = array();
                $collegegrplist = '';

                if (!empty($collegelist)) {

                    $collegegroupsubjectIDs = $this->CollegeGroupSubject->find('all', array('conditions' => array('CollegeGroupSubject.college_id IN (' . $collegelist . ')')));

                    $collegegrpidlist = array();
                    $collegegrplist = '';
                    if (!empty($collegegroupsubjectIDs)) {
                        foreach ($collegegroupsubjectIDs as $collegegrpID) {
                            $collegegrpidlist[] = $collegegrpID['CollegeGroupSubject']['id'];
                        }

                        $collegegrplist = implode(',', $collegegrpidlist);
                    }
                }
                if (!empty($collegegrplist)) {
                    $collegegrplist = $collegegrplist;
                } else {
                    $collegegrplist = 'null';
                }

                $conditions[] = "StudentPreferedColleges.college_group_subject_id IN (" . $collegegrplist . ")";
            }

            // echo $this->request->data['StudentRegistration']['year'];
            if (!empty($this->request->data['StudentRegistration']['year']) || !empty($this->passedArgs['year'])) {
                $this->passedArgs['year'] = isset($this->request->data['StudentRegistration']['year']) ? $this->request->data['StudentRegistration']['year'] : $this->passedArgs['year'];
                $conditions[] =
                        "year(`StudentRegistration`.`created`)='" . $this->passedArgs['year'] . "'";
            }

            if (!empty($conditions)) {

                $totalregid = $this->StudentRegistration->StudentPreferedColleges->find('all', array('fields' => array('student_registration_id'), 'conditions' => $conditions));

                $totalregids = array();
                $data = array();
                if (!empty($totalregid)) {
                    foreach ($totalregid as $total) {
                        $totalregids[] = $total['StudentPreferedColleges']['student_registration_id'];
                    }

                    if (!empty($totalregids)) {
                        $totalregids = implode(',', $totalregids);
                        $whereRegID = "StudentRegistration.id IN (" . $totalregids . ")";

                        $data = $this->paginate('StudentRegistration', array($whereRegID));
                        //$data = $this->StudentRegistration->find('all',array('conditions'=>$whereRegID));
                        $this->set('studentRegistrations', $data);
                    }
                } else {
                    $this->set('studentRegistrations', $data);
                }
            } else {
                $this->set('studentRegistrations', $this->paginate());
            }
            if (!empty($this->passedArgs['college_id'])) {
                $this->passedArgs['college_id'] = $this->passedArgs['college_id'];
            } else {
                $this->passedArgs['college_id'] = '';
            }

            if (!empty($this->passedArgs['year'])) {
                $selectedyear = $this->set('selectedyear', $this->passedArgs['year']);
            } else {
                $selectedyear = '';
            }

            $selecteduniver = '';
            $this->set('collegeid', $this->passedArgs['college_id']);
            $this->set('universityID', $this->passedArgs['university_id']);
            if (!empty($this->passedArgs['university_id'])) {
                $this->set('colleges', $this->College->find('list', array('conditions' => array('College.university_id' => $this->passedArgs['university_id']))));
            } else {
                $this->set('colleges', $this->College->find('list'));
            }
        } else {
            
            $this->set('studentRegistrations', $this->paginate());
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
        if (!$this->StudentRegistration->exists($id)) {
            throw new NotFoundException(__('Invalid student registration'));
        }
        $options = array('conditions' => array('StudentRegistration.' . $this->StudentRegistration->primaryKey => $id));
        $studentRegistrationData = $this->StudentRegistration->find('first', $options);
        $this->loadModel('User');
        $createUserId = $studentRegistrationData['StudentRegistration']['created_by'];
        $createUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $createUserId)));
        $modifyUserId = $studentRegistrationData['StudentRegistration']['modified_by'];
        $studentRegistrationData['StudentRegistration']['created'] = date("d-m-Y", strtotime($studentRegistrationData['StudentRegistration']['created']));
        $studentRegistrationData['StudentRegistration']['modified'] = date("d-m-Y", strtotime($studentRegistrationData['StudentRegistration']['modified']));
        $modifyUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $modifyUserId)));
        $this->set('studentRegistration', $studentRegistrationData);
        $this->set('createuser', $createUserData['User']['username']);
        $this->set('modifyuser', $modifyUserData['User']['username']);


        /* subject list and university */
        $studentRegistrationData = $this->StudentRegistration->find('first', $options);
        //pr($studentRegistrationData); exit;
        $this->set('studentRegistration', $studentRegistrationData);
        $this->loadModel('StudentPreferedColleges');

        $this->StudentPreferedColleges->recursive = 2;
        $collegeGroupSubjectIdArr = $this->StudentPreferedColleges->find('all', array('fields' => array('college_id','college_group_subject_id','StudentPreferedColleges.college_id'), 'conditions' => array('StudentPreferedColleges.student_registration_id' => $id), 'order' => array('college_preference ASC')));
        
        $num_of_choice = count($collegeGroupSubjectIdArr);

        $this->loadModel('Colleges');
        $this->loadModel('CollegeGroupSubject');
       
        $collegeGroupArr = '';
        $this->loadModel('GroupSubject');
        $stdselectedcollege = array();
        $collegeuniversitydata = array();
      
        if (!empty($collegeGroupSubjectIdArr)) {
            foreach ($collegeGroupSubjectIdArr as $value) {
                $collegeGroupArr = array();
                $this->Colleges->recursive = 2;
               if($value['StudentPreferedColleges']['college_group_subject_id']!=0){
             
                $collegeGroupArr = $this->CollegeGroupSubject->read('',$value['StudentPreferedColleges']['college_group_subject_id']);
                $finalArr['collegename'] = $collegeGroupArr['College']['name'];
                $finalArr['university_id'] = $collegeGroupArr['College']['university_id'];
                $finalArr['groupsubjectName'] = $collegeGroupArr['GroupSubjects']['name'];
                
               }else{
                    $collegeGroupArr = $this->Colleges->read('',$value['StudentPreferedColleges']['college_id']);
                $finalArr['collegename'] = $collegeGroupArr['Colleges']['name'];
                $finalArr['university_id'] = $collegeGroupArr['Colleges']['university_id'];
                $finalArr['groupsubjectName'] = 'Not Applicable';
                }
                

                $collegeuniversitydata[] = $finalArr;
                $finalArr = '';
                
            }
            $stdselectedcollege = $collegeuniversitydata;
        } 
       
        //* getting subjects list from student subjects table
        $this->loadModel('StudentSubject');

        $studentsubject = $this->StudentSubjects->find('all', array('conditions' => array('student_registration_id' => $id)));

        $subcollectionarray = array();
        $finalsubjectarray = array();

        $this->loadModel('Subject');
        if (!empty($studentsubject)) {
            foreach ($studentsubject as $subjects_id) {
                $subjectID = $subjects_id['StudentSubjects']['subject_id'];

                $subjectsName = $this->Subject->find('all', array('fields' => array('name'), 'conditions' => array('id' => $subjectID)));

                $studsub['Subjectname'] = $subjectsName[0]['Subject']['name'];
                $studsub['marks'] = $subjects_id['StudentSubjects']['marks'];

                $subcollectionarray[] = $studsub;
            }
            $finalsubjectarray = $subcollectionarray;
        }
        /* Alloted student information  and cancellation information */
        $allotedcollege = array();
        $cancelledinfo = array();
        $allotedcollege = $this->StudentRegistration->StudentAlotment->find('first', array('conditions' => array('StudentAlotment.student_registration_id' => $id)));

        if (!empty($allotedcollege) && $allotedcollege['StudentAlotment']['isCancelled'] == 'Y') {
            $this->loadModel('AdmissionCancellation');

            $cancelledinfo = $this->AdmissionCancellation->find('first', array('conditions' => array('AdmissionCancellation.student_registration_id' => $id)));
        }


        /* checked either student get alloted or not */
        $this->set(compact('num_of_choice', 'stdselectedcollege', 'finalsubjectarray', 'allotedcollege', 'cancelledinfo'));

        /* Check payment status of Student */
        $this->loadModel("BankReceipt");
        $checkpayment = array();
        $checkpayment = $this->BankReceipt->find("first", array('fields' => array('receipt_no'), 'conditions' => array('BankReceipt.receipt_no' => $id)));

        if (!empty($checkpayment)) {
            $this->set('paymentstatus', true);
        } else {
            $this->set('paymentstatus', false);
        }
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {

        $this->loadModel("StudentAlotmentDetail");
        $this->loadModel("StudentAlotment");
        $isallocatted = $this->StudentAlotmentDetail->find('first', array('conditions' => array('YEAR(StudentAlotmentDetail.created)' => date('Y'))));


        if ($this->request->is('post')) {
            
            if (isset($this->request->data['Reset'])) {
                $this->redirect("/StudentRegistrations/add");
            }
            $this->StudentRegistration->set($this->request->data);

            if ($this->StudentRegistration->validates()) {
                $msg = '';

                //pr($this->request->data); die;
                if (!empty($this->request->data) && $this->request->data['StudentRegistration']['student_document']['error'] == '0' && is_uploaded_file($this->request->data['StudentRegistration']['student_document']['tmp_name'])) {

                    $photoData = fread(fopen($this->request->data['StudentRegistration']['student_document']['tmp_name'], "r"), $this->request->data['StudentRegistration']['student_document']['size']);
                    $this->request->data['StudentRegistration']['student_document'] = $photoData;



                    if (!empty($this->request->data) && is_uploaded_file($this->request->data['StudentRegistration']['photo']['tmp_name'])) {
                        $documentData = fread(fopen($this->request->data['StudentRegistration']['photo']['tmp_name'], "r"), $this->request->data['StudentRegistration']['photo']['size']);
                        $this->request->data['StudentRegistration']['photo'] = $documentData;
                    } else {
                        $this->request->data['StudentRegistration']['photo'] = '';
                    }

                    $this->request->data['StudentRegistration']['ip_address'] = $this->request->clientIp();

                    // For User Id
                    $userid = $this->Session->read('Auth.User.id');
                    $this->request->data['StudentRegistration']['created_by'] = $userid;

                    if ($this->request->data['employee'] == 'Y' && $this->request->data['StudentRegistration']['admission_type']=='P') {
                        $this->request->data['StudentRegistration']['employee_id'] = $this->request->data['StudentRegistration']['employee_id'];
                    }else{
                    	$this->request->data['StudentRegistration']['employee_id'] = '';
                    }

                    $this->request->data['StudentRegistration']['is_emp_referance'] = $this->request->data['employee'];

                    $this->request->data['StudentRegistration']['is_distance'] = $this->request->data['distanceoption'];
                    $this->request->data['StudentRegistration']['is_mature'] = $this->request->data['matureStudent'];

                    $this->request->data['StudentRegistration']['date_of_birth'] = date("Y-m-d", strtotime($this->request->data['StudentRegistration']['date_of_birth']));

                    $this->request->data['StudentRegistration']['date_of_certificate'] = date("Y-m-d", strtotime($this->request->data['StudentRegistration']['date_of_certificate']));
                    $this->request->data['StudentRegistration']['nationality_issue_date'] = date("Y-m-d", strtotime($this->request->data['StudentRegistration']['nationality_issue_date']));
                    $this->request->data['StudentRegistration']['passport_issue_date'] = date("Y-m-d", strtotime($this->request->data['StudentRegistration']['passport_issue_date']));
                    $this->request->data['StudentRegistration']['guardian_nationality_issue_date'] = date("Y-m-d", strtotime($this->request->data['StudentRegistration']['guardian_nationality_issue_date']));
                    $this->request->data['StudentRegistration']['submission_date'] = date("Y-m-d h:i:s");
                    $streams = array();
                    $streams = $this->StudentRegistration->getColumnType('stream');
                    
                    // extract values in single quotes separated by comma
                    if (!empty($streams) && isset($this->request->data['StudentRegistration']['stream'])) {
                        preg_match_all("/'(.*?)'/", $streams, $enums);
                        $streamdata = str_replace("'", '', $enums[0][$this->request->data['StudentRegistration']['stream']]);
                        $this->request->data['StudentRegistration']['stream'] = $streamdata;
                    }
                    
                    
                    $schoolty = array();
                    $schooltypes = $this->StudentRegistration->getColumnType('school_type');
                    
                    if (!empty($schooltypes) && isset($this->request->data['StudentRegistration']['school_type'])) {
                        preg_match_all("/'(.*?)'/", $schooltypes, $enums);
                        $schoolty = str_replace("'", '', $enums[0][$this->request->data['StudentRegistration']['school_type']]);
                        $this->request->data['StudentRegistration']['school_type'] = $schoolty;
                    }else
                    // extract values in single quotes separated by comma
                   
                    $maritalStatus = array();
                    $marital_status = $this->StudentRegistration->getColumnType('marital_status');
                    
                    if (!empty($marital_status) && isset($this->request->data['StudentRegistration']['marital_status']) && !empty($this->request->data['StudentRegistration']['marital_status'])) {
                        preg_match_all("/'(.*?)'/", $marital_status, $enums);
                        $maritalStatus = str_replace("'", '', $enums[0][$this->request->data['StudentRegistration']['marital_status']]);
                        $this->request->data['StudentRegistration']['marital_status'] = $maritalStatus;
                        
                    }else{
                        $this->request->data['StudentRegistration']['marital_status'] = '';
                    }
                 
                    $nationality = array();
                    $nationalities = $this->StudentRegistration->getColumnType('nationality');
                    if (!empty($nationalities) && isset($this->request->data['StudentRegistration']['nationality'])) {
                        preg_match_all("/'(.*?)'/", $nationalities, $enums);
                        $nationality = str_replace("'", '', $enums[0][$this->request->data['StudentRegistration']['nationality']]);
                        $this->request->data['StudentRegistration']['nationality'] = $nationality;
                    }
                    
                    /* Load model for calculation of marks on the grade */
                    $totalperc = '';
                    $lowerlimit = '';
                    $markspercentage = '';
                    $this->loadModel('AdminPreference');

                    $this->loadModel('Gradepoint');

                    $markslimit = $this->AdminPreference->find('first', array('fields' => array('markslimit'), 'conditions' => array('year' => date('Y'))));

                    /* Application Number generation */
                    $application_num = '';
                    $rest = '';
                    $lastregid = array();
                    $stateid = '';

                    $lastregid = $this->StudentRegistration->find('first', array('conditions' => array('YEAR(StudentRegistration.created)' => date('Y', strtotime($this->request->data['StudentRegistration']['submission_date']))), 'order' => 'StudentRegistration.id desc'));

                    if (!empty($lastregid['StudentRegistration']['application_number'])) {
                        $rest = substr($lastregid['StudentRegistration']['application_number'], -6);
                    } else {
                        $rest = 0;
                    }
                    $rest = (int) $rest + 1;
                    $rest = str_pad((int) $rest, 6, "0", STR_PAD_LEFT);

                    if (!empty($this->request->data['StudentRegistration']['state_id']) && strlen($this->request->data['StudentRegistration']['state_id']) == 2) {
                        $stateid = $this->request->data['StudentRegistration']['state_id'];
                    } else {
                        $stateid = str_pad((int) $this->request->data['StudentRegistration']['state_id'], 2, "0", STR_PAD_LEFT);
                    }
                    $applicationNum = date('Ym', strtotime($this->request->data['StudentRegistration']['submission_date'])) . $stateid . $rest;
                    $this->request->data['StudentRegistration']['application_number'] = $applicationNum;

                    /* checking if this certificate index has any application form filled already */

                    $registeredstudent = $this->StudentRegistration->find('first', array('fields' => array('id'), 'conditions' => array('StudentRegistration.certificate_index' => $this->request->data['StudentRegistration']['certificate_index'])));

                    $checkmarks = '';
                    /* checking for fail students */

                    if (!empty($this->request->data['percentage'])) {
                        if ($this->request->data['marks'] == 'G') {
                            foreach ($this->request->data['percentage'] as $permarks) {
                                if (!empty($permarks) && $permarks == 'E' || $permarks == '9') {
                                    $checkmarks = false;
                                    $this->Session->setFlash(__('Student is not eligible for admission due to less marks in some subjects below 50.'));
                                    $this->redirect(array('action' => 'add'));
                                } else {
                                    $checkmarks = true;
                                }
                            }
                        } else if ($this->request->data['marks'] == 'M') {
                            foreach ($this->request->data['percentage'] as $permarks) {
                                if (!empty($permarks) && $permarks <= 49) {
                                    $checkmarks = false;
                                    $this->Session->setFlash(__('Student is not eligible for admission due to less marks in some subjects below 50.'));
                                    $this->redirect(array('action' => 'add'));
                                } else {
                                    $checkmarks = true;
                                }
                            }
                        }
                    }
                    /**/ 
                    //pr($this->request->data['right-select'][0]); die;
                    
                                    $collegrpsub = explode(",",$this->request->data['right-select'][0]);
                                    if(!empty($collegrpsub[0]) && !empty($collegrpsub[1])){
                                        $this->request->data['StudentAlotment']['college_id'] = $collegrpsub[0];
                                        $this->request->data['StudentAlotment']['college_group_subject_id'] = $collegrpsub[1];
                                    }else{
                                        $this->Session->setFlash('Please select recommended college marked in yellow, in order to comply with the available seats as per the combination of subjects ' , 'default', array('class' => 'successmessage'));
                                        //$this->redirect(array('action' => 'index'));
                                        $this->redirect(array('action' => 'index'));
                                    }

                    if (empty($registeredstudent['StudentRegistration']['id'])) {


                        if (!empty($this->request->data['right-select']) && !empty($this->request->data['subjectid']) && !empty($this->request->data['percentage']) && !empty($this->request->data['StudentRegistration']['total_percentage'])) {
                            $this->StudentRegistration->create();
                            if ($this->StudentRegistration->save($this->request->data)) {
                                $registrationId = $this->StudentRegistration->getLastInsertID();



                                $this->Session->write('stdregistrationID', $registrationId);

                                $application_num = $applicationNum;



                                $numofseatupdate = array();


                                // Student Subject option
                                $this->loadModel('StudentSubjects');
                                $SubjectId = $this->request->data['subjectid'];
                                $SubjectPercentage = $this->request->data['percentage'];

                                /* getting values out of grade */
                                $subjgrade = '';
                                if ($this->request->data['marks'] == 'G') {

                                    $subjgrade = $this->request->data['percentage'];

                                    /* saving in student grade table */
                                    $this->loadModel('StudentGrade');
                                    $gradepointsid = '';
                                    $SubjectPercentage = '';
                                    foreach ($subjgrade as $subgrade) {
                                        $subjectpercentagemarks = $this->Gradepoint->find('first', array('fields' => array('id'), 'conditions' => array('gradepoints' => $subgrade,'year'=>'2014')));
                                        if (!empty($subjectpercentagemarks)) {
                                            $gradepointsid[] = $subjectpercentagemarks['Gradepoint']['id'];
                                        }
                                    }
                                    for ($i = 0, $j = 0; $i < count($SubjectId), $j < count($gradepointsid); $i++, $j++) {
                                        $subjectArr1[$SubjectId[$i]] = $gradepointsid[$j];
                                    }

                                    foreach ($subjectArr1 as $key => $value) {
                                        $data1[] = array('subject_id' => $key, 'student_registration_id' => $registrationId, 'gradepoints_id' => $value);
                                    }

                                    $this->StudentGrade->saveAll($data1);


                                    /* saved in student grade table now getting marks from grade */


                                    foreach ($subjgrade as $subgrade) {
                                        $subjectpercentagemarks = $this->Gradepoint->find('first', array('fields' => array('lowerlimit', 'id'), 'conditions' => array('gradepoints' => $subgrade,'year'=>'2014')));

                                        if (!empty($subjectpercentagemarks)) {
                                            $lowerlimit = $subjectpercentagemarks['Gradepoint']['lowerlimit'];
                                        }

                                        $markspercentage = ($lowerlimit * $markslimit['AdminPreference']['markslimit']) / 100;

                                        $percentagemarks = $markspercentage + $lowerlimit;
                                        $SubjectPercentage[] = $percentagemarks;
                                        $percentagemarks = '';
                                    }
                                }
                                for ($i = 0, $j = 0; $i < count($SubjectId), $j < count($SubjectPercentage); $i++, $j++) {
                                    $subjectArr[$SubjectId[$i]] = $SubjectPercentage[$j];
                                }


                                //end of getting values out of grade

                                foreach ($subjectArr as $key => $value) {
                                    $data[] = array('subject_id' => $key, 'student_registration_id' => $registrationId, 'marks' => $value, 'created_by' => $userid);
                                }

                                $this->StudentSubjects->saveAll($data);

                                // Student Prefered Colleges option
                                $this->loadModel('StudentPreferedColleges');

                                $collegeIdArr = $this->request->data['right-select'];
                                 
                                 
                                $collegeData = array();

                                $d = 1;
                                
                                foreach ($collegeIdArr as $value) {
                                    $value = explode(",",$value);
                                    
                                    if(!empty($value[0]) && !empty($value[1])){
                                        $collegeData[] = array('college_preference' => $d, 'student_registration_id' => $registrationId, 'college_id' => $value[0],'college_group_subject_id' => $value[1], 'created_by' => $userid);
                                    }else if(!empty($value[0])){
                                        $collegeData[] = array('college_preference' => $d, 'student_registration_id' => $registrationId, 'college_id' => $value[0],'college_group_subject_id' => '0', 'created_by' => $userid);     
                                    }
                                    unset($value);
                                    $d++;
                                }
                               
                                $this->StudentPreferedColleges->saveAll($collegeData);

                                // For is-mature option
                                $workExp = '';
                                $birthCertificateIssueDate = '';
                                $workExp = '';
                                $birthCertificateIssueDate = '';
                                $isWorking = '';
                                $address = '';
                                $companyName = '';
                                if ($this->request->data['matureStudent'] == 'Y') {


                                    $this->loadModel('MatureStudents');
                                    $workExp = $this->request->data['workexp'];
                                    $birthCertificateIssueDate = date("Y-m-d", strtotime($this->request->data['certissuedate']));
  
                                    if (!empty($this->request->data['isworking'])) {
                                        $isWorking = $this->request->data['isworking'];
                                    } else {
                                        $isWorking = 'N';
                                    }
                                    $address = $this->request->data['address'];
                                    $companyName = $this->request->data['compamyname'];
                                    $ismatureArr[] = array('student_registration_id' => $registrationId, 'job_experience' => $workExp, 'birth_certificate_issue_date' => $birthCertificateIssueDate, 'company_name' => $companyName, 'address' => $address, 'working' => $isWorking, 'mature_studentscol' => 'ABC', 'created_by' => $userid);
                                    $this->MatureStudents->saveAll($ismatureArr);
                                }
                                
                                /*Direct allocation of colleges for foreign students*/
                                if($this->request->data['StudentRegistration']['admission_type']=='P' && $this->request->data['StudentRegistration']['nationality']=='Others'){
                              
                                    $this->loadModel('StudentAlotment');
                                    $this->StudentAlotment->create(false);
                                    $this->request->data['StudentAlotment']['id'] = Null;
                                    $this->request->data['StudentAlotment']['student_registration_id'] = $registrationId;
                                    $this->request->data['StudentAlotment']['course_id'] = $this->request->data['StudentRegistration']['course_id'];
                                    $value = explode(",",$this->request->data['right-select'][0]);
                                    if(!empty($value[0]) && !empty($value[1])){
                                        $this->request->data['StudentAlotment']['college_id'] = $value[0];
                                        $this->request->data['StudentAlotment']['college_group_subject_id'] = $value[1];
                                    }else{
                                        $this->Session->setFlash('Please select recommended college in order to comply with the available seats as per the combination of subjects ' , 'default', array('class' => 'successmessage'));
                                        //$this->redirect(array('action' => 'index'));
                                        $this->redirect(array('action' => 'reciept'));
                                    }
                                    
                                    $this->request->data['StudentAlotment']['allocation_year'] = date('Y');
                                    $this->request->data['StudentAlotment']['status'] = 'foreign';
                                    $this->StudentAlotment->save($this->request->data['StudentAlotment']);
                                  //  echo $vijay = 'Yes';
                                }
                                /**/
                              
                                /* if allocation has been done already then admin can do private admission for students. below function has been written separately to do this. */
                                $info = '';
                                $colid = '';
                                if (!empty($isallocatted) && !empty($registrationId) && !empty($this->request->data['right-select'])) {
                                    $collegegrpsubid = explode(",",$this->request->data['right-select'][0]);
                                    if(!empty($collegegrpsubid[0]) && !empty($collegegrpsubid[1])){
                                        $grpsubid = $collegegrpsubid[1];
                                        $colid = $collegegrpsubid[0];
                                    }
                                    $checkalotment = $this->admissionAfterallocation($registrationId, $grpsubid,$colid);
                                    if ($checkalotment) {
                                        $info .= "Alotment has been done for this application number. Please check from student statement.";
                                    } else {
                                        $info .= "Alotment could not be done for this application number. There occurred some problem. Please try again with new admission form by removing the current entry from student registration list";
                                    }
                                }
                                /* ends here */

                                $this->Session->setFlash('The student registration has been saved. ' . $info, 'default', array('class' => 'successmessage'));
                                //$this->redirect(array('action' => 'index'));
                                $this->redirect(array('action' => 'reciept'));
                            } else {
                                $this->Session->setFlash(__('The student registration could not be saved. Please, try again.'));
                            }
                        } else {
                            $this->Session->setFlash(__('Fill proper information for subjects, percentage of marks and select colleges. Also Please check Date of Birth and try again'));
                        }
                    } else {

                        $this->Session->setFlash(__('For this Certificate Number admission has been done already. Try with another certificate number.'));
                    }
                } else {
                    $this->Session->setFlash(__('Please check either you missed uploading document or if not choose a small size doc with maximum size of 1 MB'));
                }
            } else {
                // didn't validate logic
                $errors = $this->StudentRegistration->validationErrors;
            }
        }

        $this->loadModel('Gradepoint');
        $grades = $this->Gradepoint->find('all',array('conditions'=>array('year'=>date('Y'))));
        
        $listgrade = array();
        
        foreach ($grades as $grade) {
            $listgrade[] = $grade['Gradepoint']['gradepoints'];
        }
        
        $courses = $this->StudentRegistration->Course->find('list',array('limit'=>2));
        $religions = $this->StudentRegistration->Religion->find('list');
        $cities = $this->StudentRegistration->City->find('list', array('conditions' => array('City.status' => 'Y')));
        $states = $this->StudentRegistration->State->find('list', array('conditions' => array('State.status' => 'Y')));
        $countries = $this->StudentRegistration->Country->find('list', array('conditions' => array('Country.status' => 'Y')));
        $groupSubjects = $this->StudentRegistration->GroupSubject->find('list');
        $employees = $this->StudentRegistration->Employee->find('list');

        $streams = $this->StudentRegistration->getColumnType('stream');
        // extract values in single quotes separated by comma
        preg_match_all("/'(.*?)'/", $streams, $enums);
        
        $this->set('streams', $enums[1]);
        
        $schooltypes = $this->StudentRegistration->getColumnType('school_type');
        // extract values in single quotes separated by comma
        preg_match_all("/'(.*?)'/", $schooltypes, $enums);
        
        $this->set('schooltypes', $enums[1]);
        
        $marital_status = $this->StudentRegistration->getColumnType('marital_status');
        // extract values in single quotes separated by comma
        preg_match_all("/'(.*?)'/", $marital_status, $enums);
        
        $this->set('marital_status', $enums[1]);
        
        $nationality = $this->StudentRegistration->getColumnType('nationality');
        // extract values in single quotes separated by comma
        preg_match_all("/'(.*?)'/", $nationality, $enums);
        
        $this->set('nationalities', $enums[1]);
        
        
         if (!empty($isallocatted)) {
            $this->set('isalloted', 'Y');
        }

        $this->set(compact('courses', 'religions', 'cities', 'states', 'countries', 'groupSubjects', 'employees', 'listgrade'));
    }

    private function admissionAfterallocation($stdregid = null, $collegegrpid = null,$colid=null) {
        $this->loadModel('StudentAlotment');
        $this->loadModel('CollegeGroupSubjects');
        if (!empty($stdregid) && !empty($collegegrpid)) {
            $collegegroups = $this->CollegeGroupSubjects->read(null, $collegegrpid);
            if (!empty($collegegroups)) {
                $totalseats = $collegegroups['CollegeGroupSubjects']['no_of_seat'];
                // pr($collegegroup);
                //echo $totalseats;die;

                $avaliableseat = round($totalseats * 25 / 100, 0, PHP_ROUND_HALF_DOWN);
                $allocatedseats = $this->StudentAlotment->find('count', array('conditions' => array('college_group_subject_id' => $collegegrpid)));
                $avaliableseat = $avaliableseat - $allocatedseats;
                if ($avaliableseat > 0) {

                    $grade = $allocatedseats + 1;
                    $this->StudentAlotment->create(false);
                    $this->StudentAlotment->set(array(
                        'id' => NUll,
                        'student_registration_id' => $stdregid,
                        'college_id'=>$colid,
                        'college_group_subject_id' => $collegegrpid,
                        'grade' => '',
                        'allocation_year' => date('Y')
                    ));
                    $this->StudentAlotment->save();
                }
            } else {
                
            }
            return true;
        } else {
            return false;
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

        $this->loadModel('Gradepoint');
        if (!$this->StudentRegistration->exists($id)) {
            throw new NotFoundException(__('Invalid student registration'));
        }

        $studentpic_document = $this->StudentRegistration->find('first', array('fields' => array('student_document', 'photo'), 'conditions' => array('StudentRegistration.id' => $id)));


        if ($this->request->is('post') || $this->request->is('put')) {
  		
            $msg = '';
            if (!empty($this->request->data) && is_uploaded_file($this->request->data['StudentRegistration']['student_document']['tmp_name'])) {
                $photoData = fread(fopen($this->request->data['StudentRegistration']['student_document']['tmp_name'], "r"), $this->request->data['StudentRegistration']['student_document']['size']);
                $this->request->data['StudentRegistration']['student_document'] = $photoData;
            } else {

                $this->request->data['StudentRegistration']['student_document'] = $studentpic_document['StudentRegistration']['student_document'];
            }


            if (!empty($this->request->data) && $this->request->data['StudentRegistration']['photo']['error'] == 0 && is_uploaded_file($this->request->data['StudentRegistration']['photo']['tmp_name'])) {
                $documentData = fread(fopen($this->request->data['StudentRegistration']['photo']['tmp_name'], "r"), $this->request->data['StudentRegistration']['photo']['size']);
                $this->request->data['StudentRegistration']['photo'] = $documentData;
            } else {
                $this->request->data['StudentRegistration']['photo'] = $studentpic_document['StudentRegistration']['photo'];
            }

            $this->request->data['StudentRegistration']['ip_address'] = $this->request->clientIp();


            // For User Id
            $userid = $this->Session->read('Auth.User.id');
            $this->request->data['StudentRegistration']['modified_by'] = $userid;
            $this->request->data['StudentRegistration']['is_emp_referance'] = $this->request->data['employee'];
            if ($this->request->data['employee'] == 'Y' && $this->request->data['StudentRegistration']['admission_type']=='P') {
                $this->request->data['StudentRegistration']['employee_id'] = $this->request->data['StudentRegistration']['employee_id'];
            }else{
            	$this->request->data['StudentRegistration']['employee_id'] = '';
            }
            $this->request->data['StudentRegistration']['is_distance'] = $this->request->data['distanceoption'];
            $this->request->data['StudentRegistration']['is_mature'] = $this->request->data['matureStudent'];

            $this->request->data['StudentRegistration']['date_of_birth'] = date("Y-m-d", strtotime($this->request->data['StudentRegistration']['date_of_birth']));
            $this->request->data['StudentRegistration']['date_of_certificate'] = date("Y-m-d", strtotime($this->request->data['StudentRegistration']['date_of_certificate']));
            $this->request->data['StudentRegistration']['nationality_issue_date'] = date("Y-m-d", strtotime($this->request->data['StudentRegistration']['nationality_issue_date']));
            $this->request->data['StudentRegistration']['passport_issue_date'] = date("Y-m-d", strtotime($this->request->data['StudentRegistration']['passport_issue_date']));
            $this->request->data['StudentRegistration']['guardian_nationality_issue_date'] = date("Y-m-d", strtotime($this->request->data['StudentRegistration']['guardian_nationality_issue_date']));
            $this->request->data['StudentRegistration']['submission_date'] = date("Y-m-d h:i:s");
            $streams = array();
            $streams = $this->StudentRegistration->getColumnType('stream');
            // extract values in single quotes separated by comma

            if (!empty($streams) && isset($this->request->data['StudentRegistration']['stream'])) {

                preg_match_all("/'(.*?)'/", $streams, $enums);

                //pr($enums); die;
                $streamdata = str_replace("'", '', $enums[0][$this->request->data['StudentRegistration']['stream']]);
                $this->request->data['StudentRegistration']['stream'] = $streamdata;
            }
            
                $schooltypes = array();
                    $schooltypes = $this->StudentRegistration->getColumnType('school_type');
                    if (!empty($schooltypes) && isset($this->request->data['StudentRegistration']['school_type'])) {
                        preg_match_all("/'(.*?)'/", $schooltypes, $enums);
                        $schoolty = str_replace("'", '', $enums[0][$this->request->data['StudentRegistration']['school_type']]);
                        $this->request->data['StudentRegistration']['school_type'] = $schoolty;
                    }
                    // extract values in single quotes separated by comma
                    
                    $marital_status = array();
                    $marital_status = $this->StudentRegistration->getColumnType('marital_status');
                    if (!empty($marital_status) && isset($this->request->data['StudentRegistration']['marital_status']) && !empty($this->request->data['StudentRegistration']['marital_status'])) {
                        preg_match_all("/'(.*?)'/", $marital_status, $enums);
                        $maritalStatus = str_replace("'", '', $enums[0][$this->request->data['StudentRegistration']['marital_status']]);
                        $this->request->data['StudentRegistration']['marital_status'] = $maritalStatus;
                    }
                    
                    $nationalities = array();
                    $nationalities = $this->StudentRegistration->getColumnType('nationality');
                    if (!empty($nationalities) && isset($this->request->data['StudentRegistration']['nationality'])) {
                        preg_match_all("/'(.*?)'/", $nationalities, $enums);
                        $nationality = str_replace("'", '', $enums[0][$this->request->data['StudentRegistration']['nationality']]);
                        $this->request->data['StudentRegistration']['nationality'] = $nationality;
                    }
            
            /* grade operation */
            $totalperc = '';

            $lowerlimit = '';
            $markspercentage = '';
            $this->loadModel('AdminPreference');

            $this->loadModel('Gradepoint');

            $markslimit = $this->AdminPreference->find('first', array('fields' => array('markslimit'), 'conditions' => array('year' => date('Y'))));


            $checkmarks = '';
            /* checking for fail students */

            if (!empty($this->request->data['percentage'])) {
                if ($this->request->data['marks'] == 'G') {
                    foreach ($this->request->data['percentage'] as $permarks) {
                        if (!empty($permarks) && $permarks == 'E' || $permarks == '9') {
                            $checkmarks = false;
                            $this->Session->setFlash(__('Student is not eligible for admission due to less marks in some subjects below 50.'));
                            $this->redirect(array('action' => 'edit', $id));
                        } else {
                            $checkmarks = true;
                        }
                    }
                } else if ($this->request->data['marks'] == 'M') {
                    foreach ($this->request->data['percentage'] as $permarks) {
                        if (!empty($permarks) && $permarks <= 49) {
                            $checkmarks = false;
                            $this->Session->setFlash(__('Student is not eligible for admission due to less marks in some subjects below 50.'));
                            $this->redirect(array('action' => 'edit', $id));
                        } else {
                            $checkmarks = true;
                        }
                    }
                }
            }
            /**/
            if (!empty($this->request->data['right-select']) && !empty($this->request->data['subjectid']) && !empty($this->request->data['percentage']) && !empty($this->request->data['StudentRegistration']['total_percentage'])) {
                if ($this->StudentRegistration->save($this->request->data)) {
                    $registrationId = $id;
                    // Student Subject option
                    // Student Subject option
                    $this->loadModel('StudentSubjects');
                    $SubjectId = $this->request->data['subjectid'];
                    $SubjectPercentage = $this->request->data['percentage'];
                    /* Checked and delete if marksystem is selected as Marks and grade values saved before for student */
                    $findingradevalue_exist = array();
                    if ($this->request->data['marks'] == 'M') {
                        $findingradevalue_exist = $this->StudentGrade->find('all', array('fields' => array('student_registration_id'), 'conditions' => array('student_registration_id' => $id)));
                        if (!empty($findingradevalue_exist)) {
                            $this->StudentGrade->deleteAll(array('StudentGrade.student_registration_id' => $id), false);
                        }
                    }
                    /* Delete student grades if it was saved in grade and now we are saving it in number */

                    /* getting values out of grade */
                    $subjgrade = '';
                    if ($this->request->data['marks'] == 'G') {

                        $subjgrade = $this->request->data['percentage'];

                        /* saving in student grade table */
                        $this->loadModel('StudentGrade');
                        $gradepointsid = '';
                        $SubjectPercentage = '';
                        foreach ($subjgrade as $subgrade) {
                            $subjectpercentagemarks = $this->Gradepoint->find('first', array('fields' => array('id'), 'conditions' => array('gradepoints' => $subgrade,'year'=>'2014')));
                            if (!empty($subjectpercentagemarks)) {
                                $gradepointsid[] = $subjectpercentagemarks['Gradepoint']['id'];
                            }
                        }
                        for ($i = 0, $j = 0; $i < count($SubjectId), $j < count($gradepointsid); $i++, $j++) {
                            $subjectArr1[$SubjectId[$i]] = $gradepointsid[$j];
                        }

                        foreach ($subjectArr1 as $key => $value) {
                            $data1[] = array('subject_id' => $key, 'student_registration_id' => $registrationId, 'gradepoints_id' => $value);
                        }
                        $this->StudentGrade->deleteAll(array('StudentGrade.student_registration_id' => $id), false);
                        $this->StudentGrade->saveAll($data1);


                        /* saved in student grade table now getting marks from grade */


                        foreach ($subjgrade as $subgrade) {
                            $subjectpercentagemarks = $this->Gradepoint->find('first', array('fields' => array('lowerlimit', 'id'), 'conditions' => array('gradepoints' => $subgrade,'year'=>'2014')));

                            if (!empty($subjectpercentagemarks)) {
                                $lowerlimit = $subjectpercentagemarks['Gradepoint']['lowerlimit'];
                            }

                            $markspercentage = ($lowerlimit * $markslimit['AdminPreference']['markslimit']) / 100;

                            $percentagemarks = $markspercentage + $lowerlimit;
                            $SubjectPercentage[] = $percentagemarks;
                            $percentagemarks = '';
                        }
                    }


                    for ($i = 0, $j = 0; $i < count($SubjectId), $j < count($SubjectPercentage); $i++, $j++) {
                        $subjectArr[$SubjectId[$i]] = $SubjectPercentage[$j];
                    }


                    //end of getting values out of grade

                    foreach ($subjectArr as $key => $value) {
                        $data[] = array('subject_id' => $key, 'student_registration_id' => $registrationId, 'marks' => $value, 'created_by' => $userid);
                    }
                    $this->StudentSubjects->deleteAll(array('StudentSubjects.student_registration_id' => $id), false);
                    
                    $this->StudentSubjects->saveAll($data);

                    // Student Prefered Colleges option
                    $this->loadModel('StudentPreferedColleges');

                    $collegeIdArr = $this->request->data['right-select'];

                    $collegeData = array();
                    
                     $d = 1;
                                     
                     foreach ($collegeIdArr as $value) {
                                    $value = explode(",",$value);
                                    
                                    if(!empty($value[0]) && !empty($value[1])){
                                        $collegeData[] = array('college_preference' => $d, 'student_registration_id' => $registrationId, 'college_id' => $value[0],'college_group_subject_id' => $value[1], 'created_by' => $userid);
                                    }else if(!empty($value[0])){
                                        $collegeData[] = array('college_preference' => $d, 'student_registration_id' => $registrationId, 'college_id' => $value[0],'college_group_subject_id' => '0', 'created_by' => $userid);     
                                    }
                                    unset($value);
                                    $d++;
                                }
                    
                    
                    $this->StudentPreferedColleges->deleteAll(array('StudentPreferedColleges.student_registration_id' => $id), false);
                    $this->StudentPreferedColleges->saveAll($collegeData);

                    // For is-mature option

                    if ($this->request->data['matureStudent'] == 'Y') {
                        $workExp = '';
                        $birthCertificateIssueDate = '';
                        $workExp = '';
                        $birthCertificateIssueDate = '';
                        $isWorking = '';

                        $address = '';
                        $companyName = '';

                        $this->loadModel('MatureStudents');
                        $workExp = $this->request->data['workexp'];
                        $birthCertificateIssueDate = date("Y-m-d", strtotime($this->request->data['certissuedate']));
                        if (!empty($this->request->data['isworking'])) {
                            $isWorking = $this->request->data['isworking'];
                        } else {
                            $isWorking = 'N';
                        }

                        $address = $this->request->data['address'];
                        $companyName = $this->request->data['compamyname'];
                        $ismatureArr[] = array('student_registration_id' => $registrationId, 'job_experience' => $workExp, 'birth_certificate_issue_date' => $birthCertificateIssueDate, 'company_name' => $companyName, 'address' => $address, 'working' => $isWorking, 'mature_studentscol' => 'ABC', 'created_by' => $userid);
                        $this->MatureStudents->deleteAll(array('MatureStudents.student_registration_id' => $id), false);
                        $this->MatureStudents->saveAll($ismatureArr);
                    }
                    /*Direct allocation of colleges for foreign students*/
                                if($this->request->data['StudentRegistration']['admission_type']=='P' && $this->request->data['StudentRegistration']['nationality']=='Others'){
                              
                                    $this->loadModel('StudentAlotment');
                                  $stdalot =   $this->StudentAlotment->find('first',array('fields'=>array('id'),'conditions'=>array('StudentAlotment.student_registration_id'=>$registrationId)));
                                   // $this->request->data['StudentAlotment']['id'] = NULL;
                                  if(!empty($stdalot)){                                         
                                         $this->request->data['StudentAlotment']['id'] = $stdalot['StudentAlotment']['id'];
                                  }else{
                                         $this->request->data['StudentAlotment']['id'] = NULL;
                                  }
                                  
                                    $this->request->data['StudentAlotment']['student_registration_id'] = $registrationId;
                                    $this->request->data['StudentAlotment']['course_id'] = $this->request->data['StudentRegistration']['course_id'];
                                    $value = explode(",",$this->request->data['right-select'][0]);
                                    if(!empty($value[0]) && !empty($value[1])){
                                        $this->request->data['StudentAlotment']['college_id'] = $value[0];
                                        $this->request->data['StudentAlotment']['college_group_subject_id'] = $value[1];
                                    }else{
                                        $this->Session->setFlash('Please select recommended college in order to comply with the available seats as per the combination of subjects ' , 'default', array('class' => 'successmessage'));
                                        //$this->redirect(array('action' => 'index'));
                                        $this->redirect(array('action' => 'index'));
                                    }
                                    
                                    $this->request->data['StudentAlotment']['allocation_year'] = date('Y');
                                    $this->request->data['StudentAlotment']['status'] = 'foreign';
                                    $this->StudentAlotment->save($this->request->data['StudentAlotment']);
                                  //  echo $vijay = 'Yes';
                                }
                                /**/

                    /* updated other student related information such as student subjects, students grade, student subjects marks, mature students information */
                    $this->Session->setFlash('The student registration has been saved. ' . $msg, 'default', array('class' => 'successmessage'));

                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The student registration could not be saved. Please, try again.'));
                }
            } else {
                $this->Session->setFlash(__('Fill proper information for subjects, percentage of marks and select colleges. Please try again'));
            }
        } else {
            $options = array('conditions' => array('StudentRegistration.' . $this->StudentRegistration->primaryKey => $id));
            $this->request->data = $this->StudentRegistration->find('first', $options);
        }
        /* listing all grades */
        $grades = $this->Gradepoint->find('all',array('conditions'=>array('year'=>'2014')));
        $listgrade = array();
        foreach ($grades as $grade) {
            $listgrade[] = $grade['Gradepoint']['gradepoints'];
        }

        /**/

        /* checking student's grade */
        $studentsgrade = $this->StudentGrade->find('all', array('conditions' => array('student_registration_id' => $id)));


        $studentSubject = $this->StudentSubjects->find('all', array('fields' => array('subject_id'), 'conditions' => array('student_registration_id' => $id)));
        $studentSelectedSub = array();
        foreach ($studentSubject as $stdselectedsub) {

            $studentSelectedSub[] = $stdselectedsub['StudentSubjects']['subject_id'];
        }
        sort($studentSelectedSub);

        /**/
        $courses = $this->StudentRegistration->Course->find('list',array('limit'=>2));
        $religions = $this->StudentRegistration->Religion->find('list');
        $cities = $this->StudentRegistration->City->find('list');
        $states = $this->StudentRegistration->State->find('list');
        $countries = $this->StudentRegistration->Country->find('list');
        $groupSubjects = $this->StudentRegistration->GroupSubject->find('list');
        $employees = $this->StudentRegistration->Employee->find('list');
        $streams = $this->StudentRegistration->getColumnType('stream');
        // extract values in single quotes separated by comma
        preg_match_all("/'(.*?)'/", $streams, $enums);
        $this->set('streams', $enums[1]);
  
        $schooltypes = $this->StudentRegistration->getColumnType('school_type');
        // extract values in single quotes separated by comma
        preg_match_all("/'(.*?)'/", $schooltypes, $enums);
        
        $this->set('schooltypes', $enums[1]);
        
        $marital_status = $this->StudentRegistration->getColumnType('marital_status');
        // extract values in single quotes separated by comma
        preg_match_all("/'(.*?)'/", $marital_status, $enums);
        
        $this->set('marital_status', $enums[1]);
        
        $nationality = $this->StudentRegistration->getColumnType('nationality');
        // extract values in single quotes separated by comma
        preg_match_all("/'(.*?)'/", $nationality, $enums);
        
        $this->set('nationalities', $enums[1]);
        
        $this->set('editId', $id);
        $this->set(compact('courses', 'religions', 'cities', 'states', 'countries', 'groupSubjects', 'employees', 'listgrade', 'studentsgrade', 'studentSelectedSub'));
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
        $this->StudentRegistration->id = $id;
        if (!$this->StudentRegistration->exists()) {
            throw new NotFoundException(__('Invalid student registration'));
        }

        $this->loadModel('StudentAlotment');
        $isalloted = $this->StudentAlotment->find('first', array('fields' => array('student_registration_id'), 'conditions' => array('StudentAlotment.student_registration_id' => $id)));
        //pr($isalloted); exit;
        // try{
        //if(empty($isalloted)){
        $this->loadModel('StudentGrade');
        $isexiststdgrade = $this->StudentGrade->find('first', array('StudentGrade.student_registration_id' => $id));
        $this->loadModel('StudentSubjects');
        $this->loadModel('StudentPreferedColleges');
        $this->loadModel('MatureStudents');
        $this->loadModel('AdmissionCancellation');
        $this->loadModel('UpgradedStudent');
        $this->loadModel('BankReceipt');
        $this->loadModel('StudentAlotment');

        $this->request->onlyAllow('post', 'delete');
        if (!empty($isexiststdgrade)) {
            $this->StudentGrade->deleteAll(array('StudentGrade.student_registration_id' => $id), false);
        }
        $this->AdmissionCancellation->deleteAll(array('AdmissionCancellation.student_registration_id' => $id), false);
        $this->StudentSubjects->deleteAll(array('StudentSubjects.student_registration_id' => $id), false);
        $this->StudentPreferedColleges->deleteAll(array('StudentPreferedColleges.student_registration_id' => $id), false);
        $this->UpgradedStudent->deleteAll(array('UpgradedStudent.student_registration_id' => $id), false);
        $this->BankReceipt->deleteAll(array('BankReceipt.receipt_no' => $id), false);
        $this->StudentAlotment->deleteAll(array('StudentAlotment.student_registration_id' => $id), false);

        $this->MatureStudents->deleteAll(array('MatureStudents.student_registration_id' => $id), false);
        if ($this->StudentRegistration->delete()) {

            $this->Session->setFlash('Student registration deleted', 'default', array('class' => 'successmessage'));
            $this->redirect(array('action' => 'index'));
        }
        
        $this->Session->setFlash(__('Student registration was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    /**
     * front rnd user add method
     *
     * @return void
     */
    public function registerstudent() {


        $this->loadModel('Gradepoint');
        $this->loadModel('StudentSecondarySchDetail');
        $certificate_id = $this->Session->read('sec_certificate_id');
        $year = $this->Session->read('yearofcertificate');
        //print_r($year);
        if (!empty($certificate_id)) {
            $certificateId = $this->Session->read('sec_certificate_id');
        } //else if (!empty($this->request->data['certificateId'])) {
        
      $secstdname = $this->StudentSecondarySchDetail->find('first',array('fields'=>array('StudentSecondarySchDetail.name'),'conditions'=>array('StudentSecondarySchDetail.secondary_certificate_id'=>$certificate_id)));
      $this->set('secstdname',$secstdname);
        if (empty($certificateId)) {
            throw new NotFoundException(__('Invalid student registration'));
        }
        if ($this->request->is('post')) {
 
             if (isset($this->request->data['Reset'])) {
                $this->redirect("/StudentRegistrations/registerstudent");
            }
            
            $certificateCode = array();
            $this->StudentRegistration->set($this->request->data);

            if ($this->StudentRegistration->validates()) {

                $certificateCode = $this->StudentRegistration->find('first', array('fields' => array('certificate_index'), 'conditions' => array('StudentRegistration.certificate_index' => $this->request->data['StudentRegistration']['certificate_index'])));

                $msg = '';
                //pr($this->request->data); die;
                if (!empty($this->request->data) && $this->request->data['StudentRegistration']['student_document']['error'] == '0' && is_uploaded_file($this->request->data['StudentRegistration']['student_document']['tmp_name'])) {

                    $photoData = fread(fopen($this->request->data['StudentRegistration']['student_document']['tmp_name'], "r"), $this->request->data['StudentRegistration']['student_document']['size']);
                    $this->request->data['StudentRegistration']['student_document'] = $photoData;
                    $msg .= 'Document has not been uploaded due big size of your doc. Please check and follow instruction given for upload while Edit student information.';
                } else {
                    $this->request->data['StudentRegistration']['student_document'] = '';
                }

                if (!empty($this->request->data) && is_uploaded_file($this->request->data['StudentRegistration']['photo']['tmp_name'])) {
                    $documentData = fread(fopen($this->request->data['StudentRegistration']['photo']['tmp_name'], "r"), $this->request->data['StudentRegistration']['photo']['size']);
                    $this->request->data['StudentRegistration']['photo'] = $documentData;
                } else {
                    $this->request->data['StudentRegistration']['photo'] = '';
                }

                $this->request->data['StudentRegistration']['ip_address'] = $this->request->clientIp();

                // For User Id
                $userid = array();
                $userid = $this->StudentRegistration->find('first', array('order' => 'StudentRegistration.id DESC'));
                if (!empty($userid)) {
                    $this->request->data['StudentRegistration']['created_by'] = $userid['StudentRegistration']['id'] + 1;
                    $userid = $userid['StudentRegistration']['id'] + 1;
                } else {
                    $userid = 1;
                }
                // For set Admission Type
                $this->request->data['StudentRegistration']['admission_type'] = 'N';


                $this->request->data['StudentRegistration']['date_of_birth'] = date("Y-m-d", strtotime($this->request->data['StudentRegistration']['date_of_birth']));
                $this->request->data['StudentRegistration']['date_of_certificate'] = date("Y-m-d", strtotime($this->request->data['StudentRegistration']['date_of_certificate']));
                $this->request->data['StudentRegistration']['nationality_issue_date'] = date("Y-m-d", strtotime($this->request->data['StudentRegistration']['nationality_issue_date']));
                $this->request->data['StudentRegistration']['passport_issue_date'] = date("Y-m-d", strtotime($this->request->data['StudentRegistration']['passport_issue_date']));
                $this->request->data['StudentRegistration']['guardian_nationality_issue_date'] = date("Y-m-d", strtotime($this->request->data['StudentRegistration']['guardian_nationality_issue_date']));
                $this->request->data['StudentRegistration']['submission_date'] = date("Y-m-d h:i:s");

                /* Edited by Vijay on 24th August */
                $streams = array();
                $streams = $this->StudentRegistration->getColumnType('stream');
                // extract values in single quotes separated by comma
                if (!empty($streams) && isset($this->request->data['StudentRegistration']['stream'])) {
                    preg_match_all("/'(.*?)'/", $streams, $enums);

                    $streamdata = str_replace("'", '', $enums[0][$this->request->data['StudentRegistration']['stream']]);
                    $this->request->data['StudentRegistration']['stream'] = $streamdata;
                }
                
                $schoolty = array();
                    $schooltypes = $this->StudentRegistration->getColumnType('school_type');
                    if (!empty($schooltypes) && isset($this->request->data['StudentRegistration']['school_type'])) {
                        preg_match_all("/'(.*?)'/", $schooltypes, $enums);
                        $schoolty = str_replace("'", '', $enums[0][$this->request->data['StudentRegistration']['school_type']]);
                        $this->request->data['StudentRegistration']['school_type'] = $schoolty;
                    }
                    // extract values in single quotes separated by comma
                    
                    $maritalStatus = array();
                    $marital_status = $this->StudentRegistration->getColumnType('marital_status');
                    if (!empty($marital_status) && isset($this->request->data['StudentRegistration']['marital_status'])) {
                        preg_match_all("/'(.*?)'/", $marital_status, $enums);
                        $maritalStatus = str_replace("'", '', $enums[0][$this->request->data['StudentRegistration']['marital_status']]);
                        $this->request->data['StudentRegistration']['marital_status'] = $maritalStatus;
                    }
                    
                    $this->request->data['StudentRegistration']['nationality'] = 'South Sudan';
                    
                    
                /* Load model for calculation of marks on the grade */

                $totalperc = '';
                $lowerlimit = '';
                $markspercentage = '';
                $this->loadModel('AdminPreference');

                $this->loadModel('Gradepoint');

                $markslimit = $this->AdminPreference->find('first', array('fields' => array('markslimit'), 'conditions' => array('year' => date('Y'))));
                /* Application Number generation with date(Ym)+state_id+lastnumber of application number + 1 */
                $application_num = '';
                $rest = '';
                $lastregid = array();
                $stateid = '';

                $lastregid = $this->StudentRegistration->find('first', array('conditions' => array('YEAR(StudentRegistration.created)' => date('Y', strtotime($this->request->data['StudentRegistration']['submission_date']))), 'order' => 'StudentRegistration.id desc'));

                if (!empty($lastregid['StudentRegistration']['application_number'])) {
                    $rest = substr($lastregid['StudentRegistration']['application_number'], -6);
                } else {
                    $rest = 0;
                }
                $rest = (int) $rest + 1;
                $rest = str_pad((int) $rest, 6, "0", STR_PAD_LEFT);

                if (!empty($this->request->data['StudentRegistration']['state_id']) && strlen($this->request->data['StudentRegistration']['state_id']) == 2) {
                    $stateid = $this->request->data['StudentRegistration']['state_id'];
                } else {
                    $stateid = str_pad((int) $this->request->data['StudentRegistration']['state_id'], 2, "0", STR_PAD_LEFT);
                }
                $applicationNum = date('Ym', strtotime($this->request->data['StudentRegistration']['submission_date'])) . $stateid . $rest;
                $this->request->data['StudentRegistration']['application_number'] = $applicationNum;

                $checkmarks = '';
                /* checking for fail students */

                if (!empty($this->request->data['percentage'])) {
                    if ($this->request->data['marks'] == 'G') {
                        foreach ($this->request->data['percentage'] as $permarks) {
                            if (!empty($permarks) && $permarks == 'E' || $permarks == '9') {
                                $checkmarks = false;
                                $this->Session->setFlash(__('Student is not eligible for admission due to less marks in some subjects below 50.'));
                                $this->redirect(array('action' => 'registerstudent'));
                            } else {
                                $checkmarks = true;
                            }
                        }
                    } else if ($this->request->data['marks'] == 'M') {
                        foreach ($this->request->data['percentage'] as $permarks) {
                            if (!empty($permarks) && $permarks <= 49) {
                                $checkmarks = false;
                                $this->Session->setFlash(__('Student is not eligible for admission due to less marks in some subjects below 50.'));
                                $this->redirect(array('action' => 'registerstudent'));
                            } else {
                                $checkmarks = true;
                            }
                        }
                    }
                }
                /**/


                if (!empty($this->request->data['right-select']) && !empty($this->request->data['subjectid']) && !empty($this->request->data['percentage']) && !empty($this->request->data['StudentRegistration']['total_percentage'])) {
                    if (empty($certificateCode)) {
                        $this->StudentRegistration->create();
                        if ($this->StudentRegistration->save($this->request->data)) {


                            $registrationId = $this->StudentRegistration->getLastInsertID();

                            $this->Session->write('stdregistrationID', $registrationId);

                            $createdby = array('created_by' => $registrationId);
                            $this->StudentRegistration->updateAll($createdby, array('StudentRegistration.id' => $registrationId), true);
                            // Student Subject option
                            $this->loadModel('StudentSubjects');
                            $SubjectId = $this->request->data['subjectid'];
                            $SubjectPercentage = $this->request->data['percentage'];
                            /* changes after grade implementation */
                            /* getting values out of grade */
                            $subjgrade = '';
                            if ($this->request->data['marks'] == 'G') {

                                $subjgrade = $this->request->data['percentage'];

                                /* saving in student grade table */
                                $this->loadModel('StudentGrade');
                                $gradepointsid = '';
                                $SubjectPercentage = '';
                                foreach ($subjgrade as $subgrade) {
                                    $subjectpercentagemarks = $this->Gradepoint->find('first', array('fields' => array('id'), 'conditions' => array('gradepoints' => $subgrade,'year'=>'2014')));
                                    if (!empty($subjectpercentagemarks)) {
                                        $gradepointsid[] = $subjectpercentagemarks['Gradepoint']['id'];
                                    }
                                }
                                for ($i = 0, $j = 0; $i < count($SubjectId), $j < count($gradepointsid); $i++, $j++) {
                                    $subjectArr1[$SubjectId[$i]] = $gradepointsid[$j];
                                }

                                foreach ($subjectArr1 as $key => $value) {
                                    $data1[] = array('subject_id' => $key, 'student_registration_id' => $registrationId, 'gradepoints_id' => $value);
                                }
                                $this->loadModel('StudentGrade');
                                $this->StudentGrade->saveAll($data1);


                                /* saved in student grade table now getting marks from grade */


                                foreach ($subjgrade as $subgrade) {
                                    $subjectpercentagemarks = $this->Gradepoint->find('first', array('fields' => array('lowerlimit', 'id'), 'conditions' => array('gradepoints' => $subgrade,'year'=>'2014')));

                                    if (!empty($subjectpercentagemarks)) {
                                        $lowerlimit = $subjectpercentagemarks['Gradepoint']['lowerlimit'];
                                    }

                                    $markspercentage = ($lowerlimit * $markslimit['AdminPreference']['markslimit']) / 100;

                                    $percentagemarks = $markspercentage + $lowerlimit;
                                    $SubjectPercentage[] = $percentagemarks;
                                    $percentagemarks = '';
                                }
                            }
                            for ($i = 0, $j = 0; $i < count($SubjectId), $j < count($SubjectPercentage); $i++, $j++) {
                                $subjectArr[$SubjectId[$i]] = $SubjectPercentage[$j];
                            }


                            //end of getting values out of grade

                            foreach ($subjectArr as $key => $value) {
                                $data[] = array('subject_id' => $key, 'student_registration_id' => $registrationId, 'marks' => $value, 'created_by' => $userid);
                            }

                            $this->StudentSubjects->saveAll($data);

                            // Student Prefered Colleges option
                            $this->loadModel('StudentPreferedColleges');

                            $collegeIdArr = $this->request->data['right-select'];

                            $collegeData = array();

                            $f = 1;

//                            foreach ($collegeIdArr as $value) {
//                                $collegeData[] = array('college_preference' => $f, 'student_registration_id' => $registrationId, 'college_id' => $value, 'created_by' => $userid);
//                                $f++;
//                            }
                            
                            foreach ($collegeIdArr as $value) {
                                    $value = explode(",",$value);
                                    
                                    if(!empty($value[0]) && !empty($value[1])){
                                        $collegeData[] = array('college_preference' => $f, 'student_registration_id' => $registrationId, 'college_id' => $value[0],'college_group_subject_id' => $value[1], 'created_by' => $userid);
                                    }else if(!empty($value[0])){
                                        $collegeData[] = array('college_preference' => $f, 'student_registration_id' => $registrationId, 'college_id' => $value[0],'college_group_subject_id' => '0', 'created_by' => $userid);     
                                    }
                                    unset($value);
                                    $f++;
                                }

                            /* change after grade implementation ends here */
                            $this->StudentPreferedColleges->saveAll($collegeData);
                            $this->Session->setFlash('The student registration has been saved', 'default', array('class' => 'successmessage'));
                            $this->redirect(array('controller' => 'StudentRegistrations', 'action' => 'reciept'));
                        } else {
                            $this->Session->setFlash(__('The student registration could not be saved. Please, try again.'));
                        }
                    } else {
                        $this->Session->setFlash(__('The Student Registration could not be saved due to duplicate certificate index. Please enter a unique certificate index'));
                    }
                } else {
                    $this->Session->setFlash(__('Please fill properly subjects marks and colleges. Please, try again.'));
                }
            }else {
                $errors = $this->StudentRegistration->validationErrors;
            }
        }


        /* listing all grades */

        $grades = $this->Gradepoint->find('all',array('conditions'=>array('year'=>'2014')));
        $listgrade = array();
        foreach ($grades as $grade) {
            $listgrade[] = $grade['Gradepoint']['gradepoints'];
        }
        /**/
        
        $secstdmarks = $this->StudentSecondarySchDetail->find('all',array('fields'=>array('StudentSecondarySchDetail.subject_code','StudentSecondarySchDetail.marks'),'conditions'=>array('StudentSecondarySchDetail.secondary_certificate_id'=>$certificate_id)));
        if(!empty($secstdmarks) && count($secstdmarks)<=5){
            $this->set('coursestatus','diploma');
        }else if(!empty($secstdmarks) && count($secstdmarks)>5 && $secstdmarks < 7){
            $this->set('coursestatus','diploma');
        }else if(!empty($secstdmarks) && count($secstdmarks)>=7){
            $this->set('coursestatus','degree');
        }else if(!empty($secstdmarks) && count($secstdmarks)<5){
            $this->set('coursestatus','');
        }
        
        
        //$this->set('secstdname',$secstdname);
        
        $courses = $this->StudentRegistration->Course->find('list',array('limit'=>2));
        $religions = $this->StudentRegistration->Religion->find('list');
        $cities = $this->StudentRegistration->City->find('list');
        $states = $this->StudentRegistration->State->find('list');
        $countries = $this->StudentRegistration->Country->find('list');
        $groupSubjects = $this->StudentRegistration->GroupSubject->find('list');
        $employees = $this->StudentRegistration->Employee->find('list');
        $this->loadModel('SecondarySchoolCertificate');
        $certificateData = $this->SecondarySchoolCertificate->find('first', array('fields' => array('id', 'certificate_number', 'certificate_type', 'date_of_birth', 'certificate_date', 'year'), 'conditions' => array('SecondarySchoolCertificate.id' => $certificateId)));
        $certificateData['SecondarySchoolCertificate']['date_of_birth'] = date("d-m-Y", strtotime($certificateData['SecondarySchoolCertificate']['date_of_birth']));
        $certificateData['SecondarySchoolCertificate']['certificate_date'] = date("d-m-Y", strtotime($certificateData['SecondarySchoolCertificate']['certificate_date']));
        $streams = $this->StudentRegistration->getColumnType('stream');
        // extract values in single quotes separated by comma
        preg_match_all("/'(.*?)'/", $streams, $enums);
        $this->set('streams', $enums[1]);
        
        $schooltypes = $this->StudentRegistration->getColumnType('school_type');
        // extract values in single quotes separated by comma
        preg_match_all("/'(.*?)'/", $schooltypes, $enums);
        
        $this->set('schooltypes', $enums[1]);
        
        $marital_status = $this->StudentRegistration->getColumnType('marital_status');
        // extract values in single quotes separated by comma
        preg_match_all("/'(.*?)'/", $marital_status, $enums);
        
        $this->set('marital_status', $enums[1]);
        
//        $nationality = $this->StudentRegistration->getColumnType('nationality');
//        // extract values in single quotes separated by comma
//        preg_match_all("/'(.*?)'/", $nationality, $enums);
//        
//        $this->set('nationalities', $enums[1]);
        
        $this->set(compact('courses', 'religions', 'cities', 'states', 'countries', 'groupSubjects', 'employees', 'certificateData', 'listgrade'));
    }
    
    function getsubmarks() {

        $this->loadModel('StudentSecondarySchDetail');
        $this->loadModel('SecondarySchoolCertificate');
        $subjectid = '';
        $certificate_id = array();
        if (!empty($this->data)) {
            $subjectid = $this->data['SubjectID'];
            $certificateIndex = '';
            if(isset($this->data['CertificateIndex']) && !empty($this->data['CertificateIndex'])){
                $certificateIndex = $this->data['CertificateIndex'];
                $certificate_id = $this->SecondarySchoolCertificate->find('first', array('fields' => array('id'), 'conditions' => array('SecondarySchoolCertificate.certificate_number' => $certificateIndex)));
            }

            /* for portal admission fetching student subject marks */
            $secstdmarks = array();
            $secstdmarks = $this->StudentSecondarySchDetail->find('first', array('fields' => array('marks'), 'conditions' => array('StudentSecondarySchDetail.subject_id' => $subjectid, 'StudentSecondarySchDetail.secondary_certificate_id' => $certificate_id['SecondarySchoolCertificate']['id'])));
           
            if (isset($secstdmarks) && !empty($secstdmarks)) {
                echo $secstdmarks['StudentSecondarySchDetail']['marks'];
            }
        }

        exit;
    }
    
    public function getregsubjectlist(){
        $this->loadModel('Subject');
        $this->loadModel('StudentSubjects');
        $this->loadModel('StudentGrade');
        $this->loadModel('Gradepoint');
        $nationality = '';
        if(isset($this->data['nationality']) && !empty($this->data['nationality'])){
            $nationality = $this->data['nationality'];
            $this->set('nationality',$nationality);
        }
        $admtype = '';
        if(isset($this->data['AdmissionType']) && !empty($this->data['AdmissionType'])){
            $admtype = $this->data['AdmissionType'];
        }
        $course_id = '';
       
        $course_id = $this->request->data['Course'];
       
        
        $this->layout = null;
        $markingtype = ''; //to store either grades or marks are entered on Edit and in add it is of no use///
        $this->loadModel('StudentSecondarySchDetail');
        $this->loadModel('SecondarySchoolCertificate');
        /*for portal admission fetching student subject marks*/
        $certificateindex = '';
        $secstdmarks = array();
        $secondarycert_id = array();
        if(!empty($this->data['certificate_index'])){
            $certificateindex = $this->data['certificate_index'];
            $secondarycert_id = $this->SecondarySchoolCertificate->find('first',array('fields'=>array('id'),'conditions'=>array('SecondarySchoolCertificate.certificate_number'=>$certificateindex)));
    
            $secstdmarks = $this->StudentSecondarySchDetail->find('all',array('fields'=>array('subject_id','marks'),'conditions'=>array('StudentSecondarySchDetail.secondary_certificate_id'=>$secondarycert_id['SecondarySchoolCertificate']['id'])));
    
           $c = 0;
           $studentsubject = array();
            foreach($secstdmarks as $std_data){
                $studentsubject[$c]['subject_id'] = $std_data['StudentSecondarySchDetail']['subject_id']; 
                $studentsubject[$c]['marks'] = $std_data['StudentSecondarySchDetail']['marks']; 
                $c++;
            }
        }
      

        $this->set('studentsubject',$studentsubject);
        
        if (empty($this->data['stdregistrationID'])) {
            

            $coursedetails = $this->StudentRegistration->Course->read(null, $course_id);
            
            $this->set('coursedetails', $coursedetails);
            if (!empty($coursedetails['Course']['compulsary_subject'])) {
                $compulsarysubjectgroup = $coursedetails['Course']['compulsary_subject'];
                $subject = $this->Subject->find('list', array('fields' => array('id', 'name'), 'conditions' => array('Subject.id in (' . $compulsarysubjectgroup . ')', 'Subject.status' => 'Y')));
               
                $mathsarray = array();
                $newsubarray = array();
                foreach($subject as $key=>$value){
                        if($value==trim('BASIC MATHEMATICS') || $value==trim('SPECIALIZED MATHEMATICS')){
                       
                        $mathsarray[$key] = $value;
                        unset($subject[$key]);
                    }elseif($admtype=='P' && $value=='ARABIC'){
                        unset($subject[$key]);
                    }
                   
                }
                
                
                
                $this->set('subject', $subject);
                $this->set('mathsarray', $mathsarray);
                $qualifying_subjects = $this->Subject->find('all', array('fields' => array('id', 'name','subject_code'), 'conditions' => array('Subject.id not in (' . $compulsarysubjectgroup . ')', 'Subject.status' => 'Y')));
                $this->set('qualifying_subjects', $qualifying_subjects);
            } else {
                $subjects_diploma = $this->Subject->find('all', array('fields' => array('id', 'name','subject_code'), 'condition' => array('Subject.status' => 'Y')));
                $this->set('subject', $subjects_diploma);
            }
        }
    }

    public function getsubjectlist() {

//pr($this->passedArgs);
        $this->loadModel('Subject');
        $this->loadModel('StudentSubjects');
        $this->loadModel('StudentGrade');
        $this->loadModel('Gradepoint');
        $nationality = '';
        if(isset($this->data['nationality']) && !empty($this->data['nationality'])){
            $nationality = $this->data['nationality'];
            $this->set('nationality',$nationality);
        }
        $admtype = '';
        if(isset($this->data['AdmissionType']) && !empty($this->data['AdmissionType'])){
            $admtype = $this->data['AdmissionType'];
        }
        $course_id = '';
        if(isset($this->request->data['Course']) && !empty($this->request->data['Course'])){
        $course_id = $this->request->data['Course'];
        }
        if(!empty($admtype) && $admtype=='P' && $course_id =='1'){
            $course_id = '3';
        }
        
        $this->layout = null;
        $markingtype = ''; //to store either grades or marks are entered on Edit and in add it is of no use///
        $this->loadModel('StudentSecondarySchDetail');
        $this->loadModel('SecondarySchoolCertificate');
        /*for portal admission fetching student subject marks*/
        $certificateindex = '';
        $secstdmarks = array();
        $secondarycert_id = array();
        if(!empty($this->data['certificate_index'])){
            $certificateindex = $this->data['certificate_index'];
            $secondarycert_id = $this->SecondarySchoolCertificate->find('first',array('fields'=>array('id'),'conditions'=>array('SecondarySchoolCertificate.certificate_number'=>$certificateindex)));
    
            $secstdmarks = $this->StudentSecondarySchDetail->find('all',array('fields'=>array('subject_id','marks'),'conditions'=>array('StudentSecondarySchDetail.secondary_certificate_id'=>$secondarycert_id['SecondarySchoolCertificate']['id'])));
    
           $c = 0;
           $studentsubject = array();
            foreach($secstdmarks as $std_data){
                $studentsubject[$c]['subject_id'] = $std_data['StudentSecondarySchDetail']['subject_id']; 
                $studentsubject[$c]['marks'] = $std_data['StudentSecondarySchDetail']['marks']; 
                $c++;
            }
        }
        @$this->set('studentsubject',$studentsubject);
        
        if (empty($this->data['stdregistrationID'])) {
            

            $coursedetails = $this->StudentRegistration->Course->read(null, $course_id);
            
            $this->set('coursedetails', $coursedetails);
            if (!empty($coursedetails['Course']['compulsary_subject'])) {
                $compulsarysubjectgroup = $coursedetails['Course']['compulsary_subject'];
                $subject = $this->Subject->find('list', array('fields' => array('id', 'name'), 'conditions' => array('Subject.id in (' . $compulsarysubjectgroup . ')', 'Subject.status' => 'Y')));
               
                $mathsarray = array();
                $newsubarray = array();
                foreach($subject as $key=>$value){
                   if($value==trim('BASIC MATHEMATICS') || $value==trim('SPECIALIZED MATHEMATICS')){
                       
                        $mathsarray[$key] = $value;
                        unset($subject[$key]);
                    }elseif($admtype=='P' && $value=='ARABIC'){
                        unset($subject[$key]);
                    }
                   
                }
                
                $this->set('subject', $subject);
                $this->set('mathsarray', $mathsarray);
                $qualifying_subjects = $this->Subject->find('all', array('fields' => array('id', 'name','subject_code'), 'conditions' => array('Subject.id not in (' . $compulsarysubjectgroup . ')', 'Subject.status' => 'Y')));
                $this->set('qualifying_subjects', $qualifying_subjects);
            } else {
                $subjects_diploma = $this->Subject->find('all', array('fields' => array('id', 'name','subject_code'), 'condition' => array('Subject.status' => 'Y')));
                $this->set('subject', $subjects_diploma);
            }
        } else {
            $markingtype = $this->data['markingtype'];

            $allgradepoints = array();
            $studentsubmarks = array();

            if (!empty($markingtype) && $markingtype == 'G') {
                $studentsSubjects = $this->StudentGrade->find('all', array('fields' => array('StudentGrade.subject_id,StudentGrade.gradepoints_id'), 'conditions' => array('StudentGrade.student_registration_id' => $this->data['stdregistrationID'])));
                foreach ($studentsSubjects as $stdgrdpoint) {

                    $grapointdetails = $this->Gradepoint->find('first',array('conditions'=>array('id'=>$stdgrdpoint['StudentGrade']['gradepoints_id'],'year'=>'2014')));
                    $student['subject_id'] = $stdgrdpoint['StudentGrade']['subject_id'];
                    $student['marks'] = $grapointdetails['Gradepoint']['gradepoints'];
                    $studentsubmarks[] = $student;
                    $student = '';
                }
            } else {

                $studentsSubjects = $this->StudentSubjects->find('all', array('fields' => array('StudentSubjects.subject_id,StudentSubjects.marks'), 'conditions' => array('StudentSubjects.student_registration_id' => $this->data['stdregistrationID'])));

                foreach ($studentsSubjects as $subjectmarks) {

                    $studentsub = $this->Subject->find('all', array('fields' => array('name'), 'conditions' => array('id' => $subjectmarks['StudentSubjects']['subject_id'])));
                    $student['subject_id'] = $subjectmarks['StudentSubjects']['subject_id'];
                   // $student['name']=@$studentsub[0]['Subject']['name'];
                    $student['marks'] = $subjectmarks['StudentSubjects']['marks'];

                    $studentsubmarks[] = $student;
                    $student = '';
                }
            }

            
            $studentTotalsubmarks = $studentsubmarks;
            $this->set('markingtype', $markingtype);
            $this->set('studentTotalsubmarks', $studentTotalsubmarks);


            //pr($studentTotalsubmarks); exit;
            $course_id = $this->request->data['Course'];
            if (!empty($admtype) && $admtype == 'P' && $course_id == '1') {
                $course_id = '3';
            }
            $coursedetails = $this->StudentRegistration->Course->read(null, $course_id);

            $this->set('coursedetails', $coursedetails);
            if (!empty($coursedetails['Course']['compulsary_subject'])) {
                $compulsarysubjectgroup = $coursedetails['Course']['compulsary_subject'];
                $subject = $this->Subject->find('list', array('fields' => array('id', 'name'), 'conditions' => array('Subject.id in (' . $compulsarysubjectgroup . ')', 'Subject.status' => 'Y')));
                
                $mathsarray = array();
                $newsubarray = array();
                foreach($subject as $key=>$value){
                    if(trim($value)==trim('BASIC MATHEMATICS') || trim($value)==trim('SPECIALIZED MATHEMATICS')){
                       
                        $mathsarray[$key] = $value;
                        unset($subject[$key]);
                    }elseif($admtype=='P' && $value=='ARABIC'){
                        unset($subject[$key]);
                    }
                   
                }
                
                
                $this->set('subject', $subject);
                $this->set('mathsarray', $mathsarray);
                
                $qualifying_subjects = $this->Subject->find('all', array('fields' => array('id', 'name'), 'conditions' => array('Subject.id not in (' . $compulsarysubjectgroup . ')', 'Subject.status' => 'Y')));
                $this->set('qualifying_subjects', $qualifying_subjects);
            } else {
                $subjects_diploma = $this->Subject->find('all', array('fields' => array('id', 'name'), 'condition' => array('Subject.status' => 'Y')));
                //pr($subjects_diploma); exit;
                for ($i = 0; $i < count($subjects_diploma); $i++) {

                    for ($j = 0; $j < count($studentTotalsubmarks); $j++) {
                        if ($subjects_diploma[$i]['Subject']['id'] == $studentTotalsubmarks[$j]['subject_id']) {

                            $marks = $studentTotalsubmarks[$j]['marks'];
                            break;
                        } else {
                            $marks = '';
                        }
                    }
                    $subjects_diploma[$i]['Subject']['marks'] = $marks;
                    $marks = '';
                }

                $this->set('subject', $subjects_diploma);
            }
        }
    }

    /**
     * Get State List for a Country
     *
     * @throws NotFoundException
     * @throws MethodNotAllowedException
     * @param string $id
     * @return void
     */
    public function getstatelist() {
        $this->layout = null;
        $country_id = $this->request->data['countryID'];
        $states = $this->StudentRegistration->State->find('list', array('conditions' => array('State.country_id' => $country_id, 'State.status' => 'Y')));
        $this->set('states', $states);
    }

    public function calculatepercentage() {

        $this->loadModel('Gradepoint');
        $this->loadModel('AdminPreference');
        $markslimit = 0;
        $markslimit = $this->AdminPreference->find('all', array('fields' => array('markslimit'), 'conditions' => array('year' => date('Y'))));
        if (!empty($markslimit)) {
            $markslimit = $markslimit[0]['AdminPreference']['markslimit'];
        }

        $markssystem = $this->request->data['markssystem']; /* to track grade or marks percentage has been selected */

        $gradetype = '';
        // if (!empty($this->request->data['gradesystem'])) {
        //$gradetype = $this->request->data['gradesystem'];
        //}

        $checkarray = array('1', '2', '3', '4', '5', '6', '7', '8', '9');
        $studentstatus = array();

        if (!empty($this->request->data['comp_subject'])) {

            $remove = array('');

            $compulsarySub_marks = $this->request->data['comp_subject'];

            $compulsarySub_marks = array_diff($compulsarySub_marks, $remove);

            $compsubtotal = 0;
            $additionalsubtotal = 0;
            $i = 0;
            $marksfromgrade = 0;
            $gradefrom_marks = '';
            $lowerlimit = 0;
            if ($markssystem == 'G') {

                $i = 0;


                foreach ($compulsarySub_marks as $gradepoints) {

                    if (in_array($gradepoints, $checkarray)) {
                        $gradetype = 'points';
                    } else {
                        $gradetype = 'grade';
                    }

                    $marksfromgrade = $this->Gradepoint->find('first', array('fields' => array('lowerlimit'), 'conditions' => array('gradepoints' => $gradepoints, 'markingtype' => $gradetype,'year'=>'2014')));

                    if (!empty($marksfromgrade)) {
                        $lowerlimit = $marksfromgrade['Gradepoint']['lowerlimit'];
                    }
                    if ($lowerlimit <= 49) {
                        $studentstatus[] = 'Fail';
                    }

                    $markspercentage = ($lowerlimit * $markslimit) / 100;
                    $markspercentage = $markspercentage + $lowerlimit;
                    $compsubtotal = $compsubtotal + $markspercentage;

                    $i = $i + 1;
                }
            } else {
                $i = 0;
                foreach ($compulsarySub_marks as $percentageMarks) {
                    if ($percentageMarks <= 49) {
                        $studentstatus[] = 'Fail';
                    }
                    $compsubtotal = $compsubtotal + $percentageMarks;
                    $i = $i + 1;
                }
            }

           $average_percentage = round(($compsubtotal) / $i, 2);
            
            /* calculating grades from total average marks */
            if ($markssystem == 'G') {
                
               $gradefrom_marks = $this->Gradepoint->find('first', array('fields' => array('gradepoints'), 'conditions' => array('lowerlimit <=' . round($average_percentage), 'higherlimit >= ' . round($average_percentage), 'markingtype' => $gradetype,'year'=>'2014')));
           
                if (!empty($gradefrom_marks)) {
                    $average_percentage = $gradefrom_marks['Gradepoint']['gradepoints'];
                }
            } else {
                $average_percentage = $average_percentage;
            }

            if (!empty($average_percentage) && count($studentstatus) < 1) {
                echo $average_percentage;
            } else {
                echo 'Fail';
            }
            exit;
        }
    }

    public function getcollegelist() {
        $this->loadModel('Colleges');
        $this->loadModel('University');
        $allcolleglist = array();
        $this->loadModel('CollegeGroupSubject');
        
        $selectedCollegeData = array();
        $groupcollege = array();

        if (!empty($this->request->data['stdregistrationid'])) {
            $this->loadModel('StudentPreferedColleges');
            $this->StudentPreferedColleges->recursive = 3;
            $groupcollege = $this->StudentPreferedColleges->find('all', array('fields' => array('college_id','college_group_subject_id'), 'conditions' => array('StudentPreferedColleges.student_registration_id' => $this->request->data['stdregistrationid'])));
        }
        
        
        $this->set('selectedCollegeData', $groupcollege);

        $nationality = '';
        if(isset($this->data['nationality']) && !empty($this->data['nationality'])){
            $nationality = $this->data['nationality'];
            
        }
        
        $this->set('nationality',$nationality);
         $grparray = array();
        $totalsubjectId = $this->request->data['GroupSubject'];
        $group_subject = array();
        
        if (!empty($totalsubjectId)) {
            $this->loadModel('GroupSubSubject');

            $group_subject_data = $this->GroupSubSubject->query('select group_concat(subject_id) as subject_code, group_subject_id from group_sub_subjects group by group_subject_id having subject_code="' . $totalsubjectId . '" order by subject_id');

            if (!empty($group_subject_data)) {
                foreach ($group_subject_data as $value) {

                    $group_subject_id[] = $value['group_sub_subjects']['group_subject_id'];
                }
            } else {
                $group_subject_id = '';
            }
         
            $newgrpsubject = array();
            $this->loadModel('StudentAlotment');
            $avaliableseat = 0;
            if (!empty($group_subject_id)) {

                $val = implode(',', $group_subject_id);

                $this->CollegeGroupSubject->recursive = 2;
                $group_subject = $this->CollegeGroupSubject->find('all', 
                        array('fields'=>array('CollegeGroupSubject.id','CollegeGroupSubject.no_of_seat','College.id','College.college_code','College.name','College.university_id'),
                       'conditions' => array('CollegeGroupSubject.group_subjects_id in (' . $val . ')')));
          
              
               $recommended_college = '';
                if(!empty($group_subject)){
                    foreach($group_subject as $grpdata){
                        $grparray[$grpdata['CollegeGroupSubject']['id']]=$grpdata['College']['id'];
                        
                        
                       //array_push($grparray,$temp);
                    }
               //   $recommended_college //
                  $this->set('group_subject',$grparray);
                }
              }
             
                $allcolleglist = $this->Colleges->find('all',array('fields'=>array('Colleges.id','Colleges.no_of_seats','Colleges.college_code','Colleges.name','Colleges.university_id')));
               
                /* check if seats are available or not */
              
           
                foreach ($allcolleglist as $group_subjects_filter) {
                    
            
                    
                    $totalseats = $group_subjects_filter['Colleges']['no_of_seats'];
                        
                        $this->loadModel("StudentAlotmentDetail");
                        
                        $isallocatted = $this->StudentAlotmentDetail->find('first', array('conditions' => array('YEAR(StudentAlotmentDetail.created)' => date('Y'))));
                        if (!empty($isallocatted)) {
                            $avaliableseat = round($totalseats * 25 / 100, 0, PHP_ROUND_HALF_DOWN);
                        } else {
                            $avaliableseat = round($totalseats * 75 / 100, 0, PHP_ROUND_HALF_DOWN);
                        }


                        $allocatedseats = $this->StudentAlotment->find('count', array('conditions' => array('StudentAlotment.college_id' => $group_subjects_filter['Colleges']['id'])));

                        $avaliableseat = (int) $avaliableseat - (int) $allocatedseats;

                        if ($avaliableseat > 0) {
                            $newgrpsubject[] = $group_subjects_filter;
                            continue;
                        } else {
                            
                        }
                    }
                

                /* ends here */
            
            if (!empty($this->request->data['admissiontype'])) {
                if ($this->request->data['admissiontype'] == 'P') {
                    $this->set('admission_type', $this->request->data['admissiontype']);
                }
            }
           
            $this->loadModel("StudentAlotmentDetail");
            $isallocatted = $this->StudentAlotmentDetail->find('first', array('conditions' => array('StudentAlotmentDetail.year' => date('Y'))));
            
            if(!empty($isallocatted)){
                $this->set('allotted','yes');
            }else{
                $this->set('allotted','no');
            }
            
            if(empty($newgrpsubject)){
                $this->set('colleges', $allcolleglist);
            }else{
                $this->set('colleges', $newgrpsubject);
            }
            
        }

        $this->layout = null;
    }

    public function download_document() {

        $id = $this->params['pass'];

        $id = $id[0];

        Configure::write('debug', 1);
        $studentData = $this->StudentRegistration->find('first', array('conditions' => array('StudentRegistration.id' => $id)));
        //  $docname = 'mydoc';
       // print_r($studentData); die;
//        $extension = '';
//        $finfo = new finfo(FILEINFO_MIME);
//        $finfo->buffer($studentData['StudentRegistration']['student_document']) . "\n";
//        //pr($studentData['StudentRegistration']); 
//        if (!empty($finfo)) {
//            $finfo = explode(";", $finfo);
//            $finfo = $finfo[0];
//            $extension = explode("/", $finfo);
//            $extension = $extension[1];
//        }

        // header('Content-type: '.$finfo);
        header('Expires: 0');

        header('Pragma: public');

        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Cache-Control: pre-check=0, post-check=0, max-age=0', false);
        header('Content-length: ' . strlen($studentData['StudentRegistration']['student_document']));
        header('Content-Type: application/x-download');

        header('Content-Disposition: attachement; filename=' . $studentData['StudentRegistration']['applicant_name']);
        header('Content-Transfer-Encoding: binary');

        //echo @fread();
        echo $studentData['StudentRegistration']['student_document'];
        exit();
    }

    public function login() {
        if ($this->request->is('post')) {

            $isregistered = '';
            $newregistration = '';
            $nomatch = '';
            $registeredstudent = array();
            $secondarySchool = array();

            $certificateNumber = $this->request->data['LoginDetails']['certificate_number'];
            $dateOfBirth = date("Y-m-d", strtotime($this->request->data['LoginDetails']['date_of_birth']));
            $admissionYear = $this->request->data['LoginDetails']['admissionYear'];
            
            $this->loadModel('SecondarySchoolCertificate');

            $this->loadModel("AdminPreferences");
            $cutoffdate = $this->AdminPreferences->find("first");

            $registeredstudent = $this->StudentRegistration->find('first', array('fields' => array('id', 'active'), 'conditions' => array('StudentRegistration.certificate_index' => $certificateNumber, 'StudentRegistration.date_of_birth' => $dateOfBirth)));

            $secondarySchool = $this->SecondarySchoolCertificate->find('all', array('fields' => array('id', 'certificate_number', 'certificate_type', 'date_of_birth', 'certificate_date', 'year'), 'conditions' => array('SecondarySchoolCertificate.certificate_number' => $certificateNumber, "SecondarySchoolCertificate.date_of_birth" => $dateOfBirth,"year(SecondarySchoolCertificate.certificate_date)"=>$admissionYear)));
            
            if (!empty($secondarySchool) || !empty($registeredstudent)) {

                if (!empty($registeredstudent['StudentRegistration']['id'])) {
                    if ($registeredstudent['StudentRegistration']['active'] == 'Y') {
                        $this->Session->write('stdregistrationID', $registeredstudent['StudentRegistration']['id']);
                        $this->redirect(array('action' => 'studentinfoboard'));
                    } else {
                        $this->Session->setFlash('Your login account has been disabled by Administrator. Please contact Ministry to enable it');
                        $this->redirect(array('controller' => 'StudentRegistrations', 'action' => 'login'));
                    }
                } else {
                    if (!empty($cutoffdate['AdminPreferences']['cut_off_date']) && $cutoffdate['AdminPreferences']['cut_off_date'] >= date('Y-m-d')) {
                        $this->Session->write('sec_certificate_id', $secondarySchool[0]['SecondarySchoolCertificate']['id']);
                        $this->Session->write('yearofcertificate', $secondarySchool[0]['SecondarySchoolCertificate']['year']);
                        $this->redirect(array('action' => 'registerstudent'));
                    } else {
                        $this->Session->setFlash('Admission has been closed. Please visit college for admission.');
                    }
                }
            } else {

                $this->Session->setFlash('Certificate Number and Date Of Birth or Certificate Year which you selected could not match.');
            }
        }
    }

    public function reciept() {

        $registrationId = $this->Session->read('stdregistrationID');

        $this->StudentRegistration->recursive = 2;

        $options = array('fields' => array('application_number', 'admission_type', 'applicant_name', 'course_id', 'certificate_index', 'date_of_certificate'), 'conditions' => array('StudentRegistration.' . $this->StudentRegistration->primaryKey => $registrationId));


        $studentRegistration = $this->StudentRegistration->find('first', $options);

        $studentRegistration['StudentRegistration']['coursename'] = $studentRegistration['Course']['name'];
        $studentRegistration['StudentRegistration']['date_of_certificate'] = date("d-m-Y", strtotime($studentRegistration['StudentRegistration']['date_of_certificate']));

        $this->loadModel('StudentPreferedColleges');
        $collegeGroupSubjectIdArr = $this->StudentPreferedColleges->find('all', array('fields' => array('college_id'), 'conditions' => array('StudentPreferedColleges.student_registration_id' => $registrationId), 'order' => array('college_preference')));
        //pr($collegeGroupSubjectIdArr);
        $studentRegistration['StudentRegistration']['numberofchoice'] = count($collegeGroupSubjectIdArr);

        $this->loadModel('CollegeGroupSubject');
        $this->loadModel('Colleges');

        
        if (!empty($collegeGroupSubjectIdArr)) {
                foreach ($collegeGroupSubjectIdArr as $value) {
                    $collegeGroupArr = array();
                    $this->Colleges->recursive = 2;
                    $collegeGroupArr = $this->Colleges->read('',$value['StudentPreferedColleges']['college_id']);

                    $finalArr['collegecode'] = $collegeGroupArr['Colleges']['college_code'];
                    $finalArr['collegename'] = $collegeGroupArr['Colleges']['name'];
                    $finalArr['universityid'] = $collegeGroupArr['Colleges']['university_id'];
                    
                    $collegeuniversitydata[] = $finalArr;
                    $finalArr = '';
                }
                $stdselectedcollege = $collegeuniversitydata;
            }

        $this->loadModel('AdminPreference');
        $feestype = '';
        $fees = array();
        $admissiontype = $studentRegistration['StudentRegistration']['admission_type'];
        if (!empty($admissiontype) && $admissiontype == 'P') {
            $feestype = 'international_application_fee';
        } else {
            $feestype = 'domestic_application_fee';
        }
        $signature = $this->AdminPreference->find('first', array('fields' => array($feestype)));
        if (!empty($signature['AdminPreference'][$feestype])) {
            $fees['AdminPreference']['fees'] = $signature['AdminPreference'][$feestype];
        } else {
            $fees['AdminPreference']['fees'] = '';
        }

        $this->set('studentRegistration', $studentRegistration);
        $this->set('collegedata', $stdselectedcollege);
        $this->set('fees', $fees);
    }

    public function Allocation() {

        $allotforyear = $_REQUEST['year'];
        
        $admyear = '';
        
        if(!empty($allotforyear) && $allotforyear=='current'){
            $admyear = date('Y');
        }else if(!empty($allotforyear) && $allotforyear=='lastyear'){
            $admyear = date('Y')-1;
        }
        
        $this->loadModel("StudentAlotmentDetail");
        $isallocatted = $this->StudentAlotmentDetail->find('first', array('conditions' => array('YEAR(StudentAlotmentDetail.year)' => $admyear)));

        $this->loadModel("AdminPreference");
        $lastdate = $this->AdminPreference->find('first', array('fields' => array('AdminPreference.cut_off_date'), 'conditions' => array('AdminPreference.year' => $admyear)));

        if ($lastdate['AdminPreference']['cut_off_date'] > date('Y-m-d')) {

            $this->Session->setFlash('Allocation process cannot be run before admission cut-off date set in Admin preferences.');
            $this->redirect('/StudentRegistrations');
        }

        
       
//        $unallottedstudents = $this->StudentRegistration->find('all',array('fields'=>array('id'),'conditions'=>array('StudentRegistration.nationality'=>'South Sudan','year(StudentRegistration.date_of_certificate)'=>$admyear)));
//        $this->loadModel('StudentAlotment');
//        $c=1;
//        $unalotedstd = array();
//        foreach($unallottedstudents as $unallotted){
//            
//            $aloted = $this->StudentAlotment->find('first', array('fields'=>array('StudentAlotment.student_registration_id'),'conditions'=>array('StudentAlotment.student_registration_id'=>'<>'.$unallotted['StudentRegistration']['id'])));
//            if(!empty($aloted)){
//                $c = $c++;
//            }
//        }
//       
        if (!empty($isallocatted)) {
            $this->Session->setFlash('Allocation process has been run already for the current year.');
            $this->redirect(array('action' => 'index'));
        } else {



            $this->loadModel('StudentPreferedColleges');
            $this->loadModel('StudentAlotment');
            $this->loadModel('CollegeGroupSubjects');
            $data = array();
            $msg = '';
            $status = false;
           // $this->StudentAlotment->deleteAll(array('allocation_year' => date('Y')));
            $groupsubjects = $this->StudentPreferedColleges->find('all', array(
                'fields' => 'DISTINCT college_group_subject_id',
                'conditions'=>array('StudentPreferedColleges.college_group_subject_id <> 0'),
                'order' => 'college_group_subject_id ASC'
            ));
            
            $isnationality = array();
            /* check for payment before allocation: vijay 15-10-2013 */
            $this->loadModel('BankReceipt');
            $receiptnum = array();
            $totalpaidstudent = array();
            $paidstudentID = '';
            $studentcount = 0;
            $collegecount = 0;
            $totalgrpsubject = array();
            $receiptnum = $this->BankReceipt->find('all', array('fields' => array('receipt_no'),'conditions'=>array('year'=>$admyear)));
            $isnationality = array();
            
            if (!empty($receiptnum)) {
                foreach ($receiptnum as $bankreceiptnum) {
                    
                    $isnationality = $this->StudentRegistration->find('first',array('fields'=>array('StudentRegistration.nationality'),'conditions'=>array('StudentRegistration.id'=>$bankreceiptnum['BankReceipt']['receipt_no'])));
                
                    if(!empty($isnationality) && $isnationality['StudentRegistration']['nationality']=='South Sudan'){
                         $totalpaidstudent[] = $bankreceiptnum['BankReceipt']['receipt_no'];
                    }
                    unset($isnationality);
                }

                if (!empty($totalpaidstudent)) {
                    $paidstudentID = implode(',', $totalpaidstudent);
                } else {
                    $paidstudentID = '';
                }
            }
            
            if (!empty($groupsubjects)) {
 //              for all college preferences which is maximum 15 the loop will check and run for student alotment.
               for($a=1;$a<16;$a++) {
//                   $d=1;
                foreach ($groupsubjects as $groupsubject) {
                 
                    $group_subject_id = $groupsubject['StudentPreferedColleges']['college_group_subject_id']; 
                    
                   
                    $studentregistrationlist = $this->StudentPreferedColleges->find('all', array(
                        'fields' => 'StudentPreferedColleges.student_registration_id',
                        'conditions' => array('NOT'=>array('StudentPreferedColleges.college_group_subject_id'=>'0'),
                            'StudentRegistration.nationality'=>'South Sudan','year(StudentRegistration.date_of_certificate)'=>$admyear,
                            'StudentPreferedColleges.college_group_subject_id' => $group_subject_id,'StudentPreferedColleges.college_preference'=>$a)));
                   
                    if (!empty($studentregistrationlist)) {
                        $studentregistrations = $this->getstudentsortedlist($studentregistrationlist);
                    } else {
                        
                        $studentregistrations = '';
                        continue;
                    }
//                    if($d==2){
//                        pr($studentregistrations); die;
//                    }
//                    //pr($studentregistrations[0]['studentregistration']); die;
//                    $d++;
                    /* check ends here: vijay 15-10-2013 */

                    if (!empty($studentregistrations)) {
                        
                        foreach ($studentregistrations as $studentregistration) {
                            $studentId = $studentregistration['studentregistration']; 
                            $student = $this->StudentRegistration->read(null, $studentId);
                            $alloted = $this->StudentAlotment->find('first', array('conditions' => array('StudentAlotment.student_registration_id' => $studentId)));

                            if (empty($alloted)) {

                                if (!empty($student['StudentPreferedColleges'])) {
                                    foreach ($student['StudentPreferedColleges'] as $prefredcollege) {
                                        $collegegroupsubid = $prefredcollege['college_group_subject_id'];
                                        if (!empty($collegegroupsubid) && $collegegroupsubid != '0') {
                                            $collegegroup = $this->CollegeGroupSubjects->read(null, $collegegroupsubid);
                                            if (!empty($collegegroup)) {
                                                $totalseats = $collegegroup['CollegeGroupSubjects']['no_of_seat'];
                                                // pr($collegegroup);
                                                //echo $totalseats;die;
                                                //$avaliableseat = round($totalseats * 75 / 100, 0, PHP_ROUND_HALF_DOWN);
                                                $avaliableseat = round(floor($totalseats * 75) / 100, 0);

                                                $allocatedseats = $this->StudentAlotment->find('count', array('conditions' => array('StudentAlotment.college_group_subject_id' => $collegegroupsubid,'StudentAlotment.college_id'=>$collegegroup['CollegeGroupSubjects']['college_id'],'StudentAlotment.allocation_year' => $admyear)));
                                                $avaliableseat = $avaliableseat - $allocatedseats;
                                                if ($avaliableseat > 0) {
                                                    $studentcount++;
                                                    $collegecount++;
                                                    $totalgrpsubject[] = $collegegroup['CollegeGroupSubjects']['college_id'];

                                                    $grade = $allocatedseats + 1;
                                                    $this->StudentAlotment->create(false);
                                                    $this->StudentAlotment->set(array(
                                                        'id' => NUll,
                                                        'student_registration_id' => $studentId,
                                                        'course_id'=>$student['StudentRegistration']['course_id'],
                                                        'college_id' => $collegegroup['CollegeGroupSubjects']['college_id'],
                                                        'college_group_subject_id' => $collegegroupsubid,
                                                        'grade' => $grade,
                                                        'allocation_year' => $admyear
                                                    ));
                                                    $this->StudentAlotment->save();

                                                    break;
                                                }
                                            } else {
                                                
                                            }
                                        }
                                    } /**/
                                }
                            } else {
                                continue;
                            }
                        }
                    } else {
                        $msg = 'No Student for allocation.';
                    }
                
                }
            }

                $no_college = array();

                if ($studentcount > 0 && $collegecount > 0) {


                    if (!empty($totalgrpsubject)) {
                        $no_college = array_unique($totalgrpsubject);
                    }
                    $no_college = count($no_college);
                    $userid = $this->Session->read('Auth.User.id');

                    $this->StudentAlotmentDetail->create(false);
                    $this->StudentAlotmentDetail->set(array(
                        'id' => NUll,
                        'year' => $admyear,
                        'num_of_colleges' => $no_college,
                        'num_of_students' => $studentcount,
                        'created_by' => $userid
                    ));


                    $this->StudentAlotmentDetail->save();
                }

                $status = true;
                $this->redirect('/StudentAlotments');
            } else {
                $msg = 'No College/Student for allocation.';
                $this->redirect('/StudentAlotments');
            }
        }
    }

    private function getstudentsortedlist($studentregistrationlist) {

        $sortedlist = array();

        $totalmarks = 0;
        $totalqulifingmarks = /* Alloted student information  and cancellation information */
                $allotedcollege = array();
        $cancelledinfo = array();
        /* $allotedcollege = $this->StudentRegistration->StudentAlotment->find('first',array('conditions'=>array('StudentAlotment.student_registration_id'=>$id)));

          if(!empty($allotedcollege) && $allotedcollege['StudentAlotment']['isCancelled']=='Y'){
          $this->loadModel('AdmissionCancellation');

          $cancelledinfo = $this->AdmissionCancellation->find('first',array('conditions'=>array('AdmissionCancellation.student_registration_id'=>$id)));

          }


          /*checked either student get alloted or not */

        $this->set(compact('num_of_choice', 'tdselectedcollege', 'finalsubjectarray', 'allotedcollege', 'cancelledinfo'));
        0;
        $totalcompulsarymarks = 0;
        $dateofbirth = '';
            
        if (!empty($studentregistrationlist)) {
            foreach ($studentregistrationlist as $list) {
                $totalmarks = 0;
                $totalqulifingmarks = 0;
                $totalcompulsarymarks = 0;
                $dateofbirth = '';
                $studentId = $list['StudentPreferedColleges']['student_registration_id'];
                
                $student = $this->StudentRegistration->read(null, $studentId);
                
                if (!empty($student)) {

                    $course = explode(',', $student['Course']['compulsary_subject']);
                    
                    foreach ($student['StudentSubjects'] as $subject) {
                        $issubject = false;
                        
                        if (!empty($course)) {
                            foreach ($course as $c) {
                                if ($subject['subject_id'] == $c) {

                                  $totalcompulsarymarks = (int) $totalcompulsarymarks + (int) $subject['marks']; 
                                }
                            }
                            
                            if(!in_array($subject['subject_id'],$course)){
                             $totalqulifingmarks = (int) $totalqulifingmarks + (int) $subject['marks']; 
                            }
//                            foreach ($course as $c) {
//                                if ($subject['subject_id'] != $c) {
//                                    $totalqulifingmarks = (int) $totalqulifingmarks + (int) $subject['marks'];
//                                }
//                            }
                        } else {
                        
                            $totalqulifingmarks = (int) $totalqulifingmarks + (int) $subject['marks'];
                        }
                    }
                    //echo $totalcompulsarymarks."+".$totalqulifingmarks; echo "<br>";
                    
                    $totalmarks = $totalcompulsarymarks + $totalqulifingmarks; 
                    
                    
                    //$dateofbirth = date('d-m-Y', strtotime($student['StudentRegistration']['date_of_birth']));
                    //$dateofbirth = date('Y-m-d', strtotime($student['StudentRegistration']['date_of_birth']));
                    $localarray = array('studentregistration' => $studentId, 'totalmarks' => $totalmarks, 'totalcompulsarymarks' => $totalcompulsarymarks, 'totalqulifingmarks' => $totalqulifingmarks);
                    $totalqulifingmarks = 0;
                    $totalcompulsarymarks = 0;
                    array_push($sortedlist, $localarray);
                }
            }
        }

         
        foreach ($sortedlist as $key => $row) {
            $tmarks[$key] = $row['totalmarks'];
            $cmarks[$key] = $row['totalcompulsarymarks'];
            $qmarks[$key] = $row['totalqulifingmarks'];
           //    $dob[$key] = $row['dateofbirth'];
            $reg[$key] = $row['studentregistration'];
        }

        array_multisort($tmarks, SORT_DESC, $cmarks, SORT_DESC, $qmarks, SORT_DESC, $sortedlist);
  //      pr($sortedlist); die;
        
        return $sortedlist;
    }

    /**
     * View method for logged and registered students
     *
     * @return void
     */
    public function studentinfoboard() {

        $id = $this->Session->read('stdregistrationID');

        if (!$this->StudentRegistration->exists($id)) {
            throw new NotFoundException(__('Invalid student registration'));
        }
        if (!empty($id)) {
            $this->StudentRegistration->recursive = 3;
            $options = array('conditions' => array('StudentRegistration.' . $this->StudentRegistration->primaryKey => $id));
            $studentRegistrationData = $this->StudentRegistration->find('first', $options);
            //pr($studentRegistrationData); exit;
            $this->set('studentRegistration', $studentRegistrationData);
            
            $this->loadModel('StudentPreferedColleges');
            
            $this->StudentPreferedColleges->recursive = 2;
        $collegeGroupSubjectIdArr = $this->StudentPreferedColleges->find('all', array('fields' => array('college_id','college_group_subject_id','StudentPreferedColleges.college_id'), 'conditions' => array('StudentPreferedColleges.student_registration_id' => $id), 'order' => array('college_preference')));
        
        $num_of_choice = count($collegeGroupSubjectIdArr);

        $this->loadModel('Colleges');
        $this->loadModel('CollegeGroupSubject');
       
        $collegeGroupArr = '';
        $this->loadModel('GroupSubject');
        $stdselectedcollege = array();
        $collegeuniversitydata = array();
        
        if (!empty($collegeGroupSubjectIdArr)) {
            foreach ($collegeGroupSubjectIdArr as $value) {
                $collegeGroupArr = array();
                $this->Colleges->recursive = 2;
                $collegeGroupArr = $this->CollegeGroupSubject->read('',$value['StudentPreferedColleges']['college_group_subject_id']);
                
                $finalArr['collegename'] = $collegeGroupArr['College']['name'];
                $finalArr['university_id'] = $collegeGroupArr['College']['university_id'];
                $finalArr['groupsubjectName'] = $collegeGroupArr['GroupSubjects']['name'];

                $collegeuniversitydata[] = $finalArr;
                $finalArr = '';
            }
            $stdselectedcollege = $collegeuniversitydata;
        }
            //* getting subjects list from student subjects table

            $this->loadModel('StudentSubject');
            $this->loadModel('StudentGrade');
            $studentgrademarks = $this->StudentGrade->find('all', array('conditions' => array('student_registration_id' => $id)));

            $studentsubject = $this->StudentSubjects->find('all', array('conditions' => array('student_registration_id' => $id)));

            $subcollectionarray = array();
            $finalsubjectarray = array();

            $this->loadModel('Subject');

            if (!empty($studentsubject) || !empty($studentgrademarks)) {
                if (!empty($studentgrademarks)) {
                    foreach ($studentgrademarks as $subjects_id) {
                        $subjectID = $subjects_id['StudentGrade']['subject_id'];

                        $subjectsName = $this->Subject->find('all', array('fields' => array('name'), 'conditions' => array('id' => $subjectID)));

                        $studsub['Subjectname'] = $subjectsName[0]['Subject']['name'];


                        $gradeID = $subjects_id['StudentGrade']['gradepoints_id'];
                        $this->loadModel('Gradepoint');
                        $grdmarks = $this->Gradepoint->find('first', array('coditions'=>array('id'=>$gradeID,'year'=>'2014')));
                        $studsub['marks'] = $grdmarks['Gradepoint']['gradepoints'];

                        $subcollectionarray[] = $studsub;
                    }
                } else {
                    foreach ($studentsubject as $subjects_id) {

                        $subjectID = $subjects_id['StudentSubjects']['subject_id'];
                        $subjectsName = $this->Subject->find('all', array('fields' => array('name'), 'conditions' => array('id' => $subjectID)));
                        $studsub['Subjectname'] = $subjectsName[0]['Subject']['name'];
                        $studsub['marks'] = $subjects_id['StudentSubjects']['marks'];
                        $subcollectionarray[] = $studsub;
                    }
                }
                $finalsubjectarray = $subcollectionarray;
            }

            /* Alloted student information  and cancellation information */
            $allotedcollege = array();
            $cancelledinfo = array();
            $allotedcollege = $this->StudentRegistration->StudentAlotment->find('first', array('conditions' => array('StudentAlotment.student_registration_id' => $id)));

            if (!empty($allotedcollege) && $allotedcollege['StudentAlotment']['isCancelled'] == 'Y') {
                $this->loadModel('AdmissionCancellation');

                $cancelledinfo = $this->AdmissionCancellation->find('first', array('conditions' => array('AdmissionCancellation.student_registration_id' => $id)));
            }
            /* Check payment status of Student */
            $this->loadModel("BankReceipt");
            $checkpayment = array();
            $checkpayment = $this->BankReceipt->find("first", array('fields' => array('receipt_no'), 'conditions' => array('BankReceipt.receipt_no' => $id)));

            if (!empty($checkpayment)) {
                $this->set('paymentstatus', true);
            } else {
                $this->set('paymentstatus', false);
            }

            /* checked either student get alloted or not */

            $this->set(compact('num_of_choice', 'stdselectedcollege', 'finalsubjectarray', 'allotedcollege', 'cancelledinfo'));
        } else {
            $this->Session->setFlash('Your Certificate Number or Date Of Birth was incorrect.');
            $this->redirect(array('controller' => 'StudentRegistrations', 'action' => 'login'));
        }
    }

    public function getcitylist() {
        $this->layout = null;
        $state_id = $this->request->data['State'];
        $cities = $this->StudentRegistration->City->find('list', array('conditions' => array('state_id' => $state_id, 'City.status' => 'Y')));
        $this->set('cities', $cities);
    }

    function change_status($id = null) {

        $this->StudentRegistration->id = $id;
        if (!$this->StudentRegistration->exists()) {
            throw new NotFoundException(__('Invalid student registration'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {

            $stdStatus = array();
            $stdStatus = $this->StudentRegistration->find('first', array('fields' => array('active'), 'conditions' => array('StudentRegistration.id' => $id)));
            if ($stdStatus['StudentRegistration']['active'] == 'Y') {
                $status = 'N';
            } else {
                $status = 'Y';
            }

            $this->request->data['StudentRegistration']['active'] = $status;

            if ($this->StudentRegistration->save($this->request->data)) {

                $this->Session->setFlash('Student Status has been changed successfully.', 'default', array('class' => 'successmessage'));
                $this->redirect(array('controller' => 'StudentRegistrations', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Student Status could not be changed. Please try again.');
                $this->redirect(array('controller' => 'StudentRegistrations', 'action' => 'index'));
            }
        }
    }
    function changecollege($id=null,$stdalotmentID=null){
        
        
        $this->loadModel('College');
        $this->loadModel('University');
        $this->loadModel('StudentAmendment');
        $this->set('universities', $this->University->find('list', array('order' => 'University.name ASC')));
        $this->set('colleges', $this->College->find('list'));
        $this->set('editId', $id);
        
        $options = array('conditions' => array('StudentRegistration.' . $this->StudentRegistration->primaryKey => $id));
        $studentRegistrationData = $this->StudentRegistration->find('first', $options);
        
        $this->set('studentRegistration', $studentRegistrationData);
        $this->set('studentalotmentID',$stdalotmentID);
        
        $this->loadModel('StudentSubject');

        $studentsubject = $this->StudentSubjects->find('all', array('conditions' => array('student_registration_id' => $id)));

        $subcollectionarray = array();
        $finalsubjectarray = array();

        $this->loadModel('Subject');
        if (!empty($studentsubject)) {
            foreach ($studentsubject as $subjects_id) {
                $subjectID = $subjects_id['StudentSubjects']['subject_id'];

                $subjectsName = $this->Subject->find('all', array('fields' => array('name'), 'conditions' => array('id' => $subjectID)));
                $studsub['sub_id']= $subjectID;
                $studsub['Subjectname'] = $subjectsName[0]['Subject']['name'];
                $studsub['marks'] = $subjects_id['StudentSubjects']['marks'];

                $subcollectionarray[] = $studsub;
            }
            $finalsubjectarray = $subcollectionarray;
        }
      
        
        $this->set('finalsubjectarray',$finalsubjectarray);
        //pr($studentRegistrationData); die;
       
        if($this->request->is('post') || $this->request->is('put')) {
         
            
          if(!empty($this->request->data['StudentRegistration']['alotmentID'])){
                //print_r($this->request->data['StudentRegistration']['alotmentID']); die;  
                $this->loadModel('StudentAlotment');
                $this->StudentAlotment->data['StudentAlotment']['id']= $this->request->data['StudentRegistration']['alotmentID'];
                //print_r($this->StudentAlotment->data); die;
                $this->StudentAlotment->data['StudentAlotment']['college_id']= $this->request->data['StudentRegistration']['college_id'];
                //print_r($this->StudentAlotment->data['StudentAlotment']); die;
                $this->StudentAlotment->save($this->StudentAlotment->data);
          }
         
          $ifexist = $this->StudentAmendment->find('first',array('fields'=>array('StudentAmendment.id, StudentAmendment.application_number'),'conditions'=>array('StudentAmendment.application_number'=>trim($studentRegistrationData['StudentRegistration']['application_number']))));
          if(!empty($ifexist)){
              $this->StudentAmendment->data['StudentAmendment']['id'] = $ifexist['StudentAmendment']['id'];
          }
          $this->StudentAmendment->data['StudentAmendment']['application_number']= $this->request->data['StudentRegistration']['application_number'];
          $this->StudentAmendment->data['StudentAmendment']['university_id']= $this->request->data['StudentRegistration']['university_id'];
          $this->StudentAmendment->data['StudentAmendment']['college_id']= $this->request->data['StudentRegistration']['college_id'];
          //$this->StudentAmendment->data['StudentAmendment']['created']= date('Y-m-d');
          $this->StudentAmendment->data['StudentAmendment']['created_by']= 1;
          if($this->StudentAmendment->save($this->StudentAmendment->data['StudentAmendment'])){
              
              
                $this->Session->setFlash('Student college has been changed successfully.', 'default', array('class' => 'successmessage'));
                $this->redirect(array('controller' => 'StudentAlotments', 'action' => 'index'));
              
              
              
          }else{
              $this->Session->setFlash('Student college has not been changed. Please try again', 'default', array('class' => 'successmessage'));
                $this->redirect(array('controller' => 'StudentAlotments', 'action' => 'index'));
          }
        }
        
    }
    

}
