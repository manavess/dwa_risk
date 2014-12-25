<?php

App::uses('AppController', 'Controller');

/**
 * UpgradedStudents Controller
 *
 * @property UpgradedStudent $UpgradedStudent
 */
class UpgradedStudentsController extends AppController {

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
        $this->UpgradedStudent->recursive = 0;
       // pr($this->paginate()); die;
        $this->set('upgradedStudents', $this->paginate());
        
        
    }
    
    public function download_list(){
    
    	$this->UpgradedStudent->recursive = 0;
       // pr($this->paginate()); die;
        $this->set('upgradedStudents', $this->paginate());
        
        		$year = date('Y');
				$this->layout =NULL;
		        header("Content-Type:application/vnd.ms-excel");
		        header("Content-Disposition: attachment;Filename=listofupgradedstudent_".$year.".xlsx");
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->UpgradedStudent->exists($id)) {
            throw new NotFoundException(__('Invalid upgraded student'));
        }
        $this->UpgradedStudent->recursive = 2;
        $options = array('conditions' => array('UpgradedStudent.' . $this->UpgradedStudent->primaryKey => $id));
        $upgradedStudentData = $this->UpgradedStudent->find('first', $options);
        
        //pr($upgradedStudentData); die;
        $this->loadModel('User');
        $createUserId = $upgradedStudentData['UpgradedStudent']['created_by'];
        $createUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $createUserId)));
        $modifyUserId = $upgradedStudentData['UpgradedStudent']['modified_by'];
        $upgradedStudentData['UpgradedStudent']['created'] = date("d-m-Y", strtotime($upgradedStudentData['UpgradedStudent']['created']));
        $upgradedStudentData['UpgradedStudent']['modified'] = date("d-m-Y", strtotime($upgradedStudentData['UpgradedStudent']['modified']));
        $modifyUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $modifyUserId)));
        $this->set('upgradedStudent', $upgradedStudentData);
        $this->set('createuser', $createUserData['User']['username']);
        $this->set('modifyuser', $modifyUserData['User']['username']);
        $this->loadModel('Subject');
        $subjects = $this->Subject->find('list');
        $this->set('subjects',$subjects);
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->UpgradedStudent->create();
            if ($this->UpgradedStudent->save($this->request->data)) {
                $this->Session->setFlash('The upgraded student has been saved','default',array('class'=>'successmessage'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The upgraded student could not be saved. Please, try again.'));
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
        if (!$this->UpgradedStudent->exists($id)) {
            throw new NotFoundException(__('Invalid upgraded student'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $userid = $this->Session->read('Auth.User.id');
            $this->request->data['UpgradedStudent']['modified_by'] = $userid;
            if ($this->UpgradedStudent->save($this->request->data)) {
                $this->Session->setFlash('The upgraded student has been saved','default',array('class'=>'successmessage'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The upgraded student could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('UpgradedStudent.' . $this->UpgradedStudent->primaryKey => $id));
            $this->request->data = $this->UpgradedStudent->find('first', $options);
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
        $this->UpgradedStudent->id = $id;
        if (!$this->UpgradedStudent->exists()) {
            throw new NotFoundException(__('Invalid upgraded student'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->UpgradedStudent->delete()) {
            $this->Session->setFlash(__('Upgraded student deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Upgraded student was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    public function getsubjectlist() {
        $this->loadModel('Subject');
        $this->loadModel('StudentSubjects');
        $this->loadModel('StudentGrade');
        $this->loadModel('Gradepoint');
        $this->loadModel('Course');
        $course_id = $this->request->data['Course'];
        $coursedetails = $this->Course->read(null, $course_id);

        $this->set('coursedetails', $coursedetails);
        if (!empty($coursedetails['Course']['compulsary_subject'])) {
            $compulsarysubjectgroup = $coursedetails['Course']['compulsary_subject'];
            $subject = $this->Subject->find('list', array('fields' => array('id', 'name'), 'conditions' => array('Subject.id in (' . $compulsarysubjectgroup . ')', 'Subject.status' => 'Y')));
            $this->set('subject', $subject);
            $qualifying_subjects = $this->Subject->find('all', array('fields' => array('id', 'name'), 'conditions' => array('Subject.id not in (' . $compulsarysubjectgroup . ')', 'Subject.status' => 'Y')));
            $this->set('qualifying_subjects', $qualifying_subjects);
        } else {
            $subjects_diploma = $this->Subject->find('all', array('fields' => array('id', 'name'), 'condition' => array('Subject.status' => 'Y')));

            $this->set('subject', $subjects_diploma);
            //pr($this->request->data);
        }
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



                    $marksfromgrade = $this->Gradepoint->find('first', array('fields' => array('lowerlimit'), 'conditions' => array('gradepoints' => $gradepoints)));

                    if (!empty($marksfromgrade)) {
                        $lowerlimit = $marksfromgrade['Gradepoint']['lowerlimit'];
                    }


                    $markspercentage = ($lowerlimit * $markslimit) / 100;
                    $markspercentage = $markspercentage + $lowerlimit;
                    $compsubtotal = $compsubtotal + $markspercentage;

                    $i = $i + 1;
                }
            } else {
                $i = 0;
                foreach ($compulsarySub_marks as $percentageMarks) {
                    $compsubtotal = $compsubtotal + $percentageMarks;
                    $i = $i + 1;
                }
            }

            $average_percentage = round(($compsubtotal) / $i);

            /* calculating grades from total average marks */
            if ($markssystem == 'G') {

                $gradefrom_marks = $this->Gradepoint->find('first', array('fields' => array('gradepoints'), 'conditions' => array('lowerlimit <=' . $average_percentage, 'higherlimit >= ' . $average_percentage, 'markingtype' => $gradetype)));
                //   pr($gradefrom_marks); exit;
                if (!empty($gradefrom_marks)) {
                    $average_percentage = $gradefrom_marks['Gradepoint']['gradepoints'];
                }
            }
            if (!empty($average_percentage)) {
                echo $average_percentage;
            }
            exit;
        }
    }

    public function upgrade_student() {
        $this->UpgradedStudent->layout = 'Upgrade Student';
       
        $coursedata = $this->UpgradedStudent->fromCourse->find('list');
        $this->set('coursedata', $coursedata);
        $this->loadModel('Gradepoint');
        $grades = $this->Gradepoint->find('all');
        $listgrade = array();
        foreach ($grades as $grade) {
            $listgrade[] = $grade['Gradepoint']['gradepoints'];
        }
        $this->set('listgrade', $listgrade);

        // pr($this->request->data); exit;

        /* Load model for calculation of marks on the grade */
        $totalperc = '';
        $lowerlimit = '';
        $markspercentage = '';
        $this->loadModel('AdminPreference');

        $this->loadModel('Gradepoint');

        $markslimit = $this->AdminPreference->find('first', array('fields' => array('markslimit'), 'conditions' => array('year' => date('Y'))));
        $application_num = '';

        if ($this->request->is('post')) {
       if(!empty($this->request->data['UpgradedStudent']['student_registration_id'])){
        	$stdexist = $this->UpgradedStudent->find('first',array('conditions'=>array('UpgradedStudent.student_registration_id'=>$this->request->data['UpgradedStudent']['student_registration_id'])));
        
        	if(empty($stdexist['UpgradedStudent']['student_registration_id'])){
            $userid = $this->Session->read('Auth.User.id');
            $this->request->data['UpgradedStudent']['created_by'] = $userid;
            $this->UpgradedStudent->create();
            if ($this->UpgradedStudent->save($this->request->data)) {
                $this->Session->setFlash(__('The upgraded student has been saved'));

                echo $registrationId = $this->UpgradedStudent->getLastInsertID();
                //  exit;
                // Student Subject option
                $this->loadModel('UpgradedStudentMark');
                $SubjectId = $this->request->data['subjectid'];
                $SubjectPercentage = $this->request->data['percentage'];

                // pr($SubjectPercentage); exit;

                /* getting values out of grade */
                $subjgrade = '';
                if ($this->request->data['marks'] == 'G') {

                    $subjgrade = $this->request->data['percentage'];

                    /* saving in student grade table */
                    $this->loadModel('UpgradedStudentGrade');
                    $gradepointsid = '';
                    $SubjectPercentage = '';
                    foreach ($subjgrade as $subgrade) {
                        $subjectpercentagemarks = $this->Gradepoint->find('first', array('fields' => array('id'), 'conditions' => array('gradepoints' => $subgrade)));
                        if (!empty($subjectpercentagemarks)) {
                            $gradepointsid[] = $subjectpercentagemarks['Gradepoint']['id'];
                        }
                    }
                    for ($i = 0, $j = 0; $i < count($SubjectId), $j < count($gradepointsid); $i++, $j++) {
                        $subjectArr1[$SubjectId[$i]] = $gradepointsid[$j];
                    }

                    foreach ($subjectArr1 as $key => $value) {
                        $data1[] = array('subject_id' => $key, 'upgraded_student_id' => $registrationId, 'gradepoints_id' => $value);
                    }

                    $this->UpgradedStudentGrade->saveAll($data1);


                    /* saved in student grade table now getting marks from grade */


                    foreach ($subjgrade as $subgrade) {
                        $subjectpercentagemarks = $this->Gradepoint->find('first', array('fields' => array('lowerlimit', 'id'), 'conditions' => array('gradepoints' => $subgrade)));

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
                    $data[] = array('subject_id' => $key, 'upgraded_student_id' => $registrationId, 'marks' => $value, 'created_by' => $userid);
                }


                $this->UpgradedStudentMark->saveAll($data);

                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The upgraded student could not be saved. Please, try again.'));
            }
            }else{
            $this->Session->setFlash(__('This Student Admission is already upgraded.'));
            }
            
            }
        }
        
    }

    public function getstudentdetails() {
        $this->UpgradedStudent->layout = null;
        $this->UpgradedStudent->StudentRegistration->recursive = 2;
        $studentdata = $this->UpgradedStudent->StudentRegistration->find('first', array('conditions' => array('StudentRegistration.application_number' => $this->request->data['applicationum'])));
        $applicantname = $studentdata['StudentRegistration']['applicant_name'];
        $studentregistrationID = $studentdata['StudentRegistration']['id'];
        $coursename = $studentdata['Course']['name'];
        $courseID = $studentdata['Course']['id'];

        $data = '{"studentName":"' . $applicantname . '","studentregID":"' . $studentregistrationID . '","coursename":"' . $coursename . '","coursenameid":"' . $courseID . '"}';
        echo $data;
        exit;
    }

}
