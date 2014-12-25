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
    public $helpers = array('Html', 'Form', 'Js');
    public $uses = array('StudentRegistration','StudentSubjects','StudentPreferedCollege');
    public $components = array('Email');
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('admissionstatement');
       
    }
    
   		public function index(){
	
		
		}
    
		public function student_admisson_statement(){
	
		
		}
    
    	public function admissionstatement(){
    	$application_num = '';
		$application_num = $this->Session->read('stdregistrationID'); /*Registration id in session for enrolled student*/
		$groupcollege = array();
		$allotedcollege = array();
		$collegedata = array();
		$this->loadModel('StudentPreferedColleges');
		$this->loadModel('StudentRegistration');
		$this->loadModel('StudentAlotment');
		$this->loadModel('StudentGrade');
	if(!empty($application_num)){
		$this->StudentRegistration->recursive = 0;
		$registrationid = $this->StudentRegistration->find('first',array('conditions'=>array('StudentRegistration.id'=>$application_num)));
		
	if(!empty($registrationid['StudentRegistration']['id'])){
		/*Checking marks exitst also in grade table*/
		
		
		if(!empty($registrationid['StudentRegistration']['total_percentage'])){
		
		$studentgrade = $this->StudentGrade->find('first',array('conditions'=>array('StudentGrade.student_registration_id'=>$registrationid['StudentRegistration']['id'])));
			
			if(!empty($studentgrade)){
					$marksinpercentage = $this->getPercentageofGrade($registrationid['StudentRegistration']['total_percentage']);
					$registrationid['totalmarks']=$marksinpercentage;
			}
		
		}
		
		$this->set('totalpercentage',$registrationid);
            $this->StudentPreferedColleges->recursive = 3;
        
        if(!empty($registrationid['StudentRegistration']['id'])){
        $groupcollege = $this->StudentPreferedColleges->find('all', array('fields' => array('college_group_subject_id'), 'conditions' => array('StudentPreferedColleges.student_registration_id' => $registrationid['StudentRegistration']['id'])));
	
	
		$this->StudentAlotment->recursive = 3;
			$allotedcollege = $this->StudentAlotment->find('first',array('conditions'=>array('StudentAlotment.student_registration_id'=>$registrationid['StudentRegistration']['id'])));
			
			if(!empty($allotedcollege)){
				$this->set('grade',$allotedcollege['StudentAlotment']['grade']);
				}
			
			if(!empty($allotedcollege)){
			$collegedata = $this->StudentPreferedColleges->CollegeGroupSubject->find('first',array('conditions'=>array('CollegeGroupSubject.id'=>$allotedcollege['StudentAlotment']['college_group_subject_id'])));
			}
		
		}
		
		
		if(!empty($collegedata)){
		$this->set('allotedcollege',$collegedata);
		}
		
		//$this->set('groupcollege',$groupcollege);
		
		$collegegroupsubjcts = array();
				
				if(!empty($collegedata)){
					foreach($groupcollege as $collegegroup){
						if(!empty($collegegroup['CollegeGroupSubject']['id'])){
							$collegegroupsubjcts[] = $collegegroup['CollegeGroupSubject']['id'];
						}
					} 
				}
				
								
				if(!empty($collegegroupsubjcts)){
				$collegegroupsubjcts = implode(',',$collegegroupsubjcts);
				}
				
				/**/
					$db = $this->StudentAlotment->getDataSource();

					$this->paginate = array(
					'conditions'=>array('StudentAlotment.college_group_subject_id in ('.$collegegroupsubjcts.')'),
					'fields'=>array('max(StudentAlotment.grade) as grade ','StudentAlotment.allocation_year','StudentAlotment.college_group_subject_id',
					'(SELECT total_percentage
					FROM student_registrations
					WHERE id = (select a.student_registration_id from ' . $db->fullTableName($this->StudentAlotment) . ' a WHERE StudentAlotment.college_group_subject_id = a.college_group_subject_id AND a.grade = max(StudentAlotment.grade)))as total_percentage'),
					'group' => array('StudentAlotment.college_group_subject_id'),
					'order' => array('StudentAlotment.allocation_year')
					); 
					
				/**/
				//pr($this->paginate('StudentAlotment')); exit;
				$this->set('studentallocation',$this->paginate('StudentAlotment')); 
				}
			}
		
		}
		
		public function getcourse_year(){
			$registrationid = array();
			if(!empty($this->request->data)){
		
			$this->loadModel('StudentRegistration');
			$this->StudentRegistration->recursive = 3;
			$registrationid = $this->StudentRegistration->find('first',array('conditions'=>array('StudentRegistration.application_number'=>$this->request->data['applicationNum'])));
					
		}
		//pr($registrationid); exit;
			if(!empty($registrationid)){
			echo '{"studentID":"'.$registrationid['StudentRegistration']['applicant_name'].'","year":"'.date('Y',strtotime($registrationid['StudentRegistration']['created'])).'"}';
			}else{
			echo '{"studentID":"","year":""}';
			}
		exit;
			
		}
		
		public function getstudentdetails(){
		
		$this->layout = null;
		$groupcollege = array();
		$allotedcollege = array();
		$collegedata = array();
		$this->loadModel('StudentPreferedColleges');
		$this->loadModel('StudentRegistration');
		$this->loadModel('StudentAlotment');
	
		if(!empty($this->request->data['applicationNum'])){
				$this->StudentRegistration->recursive = 0;

				$registrationid = $this->StudentRegistration->find('first',array('conditions'=>array('StudentRegistration.application_number'=>$this->request->data['applicationNum'])));

		
				$this->set('totalpercentage',$registrationid);

				$this->StudentPreferedColleges->recursive = 3;
				if(!empty($registrationid['StudentRegistration']['id'])){
				$groupcollege = $this->StudentPreferedColleges->find('all', array('fields' => array('college_group_subject_id'), 'conditions' => array('StudentPreferedColleges.student_registration_id' => $registrationid['StudentRegistration']['id'])));
				$this->set('groupcollege',$groupcollege);

				$this->StudentAlotment->recursive = 3;
				$allotedcollege = $this->StudentAlotment->find('first',array('conditions'=>array('StudentAlotment.student_registration_id'=>$registrationid['StudentRegistration']['id'])));
				if(!empty($allotedcollege)){
				$this->set('grade',$allotedcollege['StudentAlotment']['grade']);
				}
				if(!empty($allotedcollege)){
				$collegedata = $this->StudentPreferedColleges->CollegeGroupSubject->find('first',array('conditions'=>array('CollegeGroupSubject.id'=>$allotedcollege['StudentAlotment']['college_group_subject_id'])));
				
				}
				
				}


				if(!empty($collegedata)){
				$this->set('allotedcollege',$collegedata);
				}
				$collegegroupsubjcts = array();
				
				if(!empty($collegedata)){
					foreach($groupcollege as $collegegroup){
						if(!empty($collegegroup['CollegeGroupSubject']['id'])){
							$collegegroupsubjcts[] = $collegegroup['CollegeGroupSubject']['id'];
						}
					} 
				}
				
								
				if(!empty($collegegroupsubjcts)){
				$collegegroupsubjcts = implode(',',$collegegroupsubjcts);
				}
				
				/**/
					$db = $this->StudentAlotment->getDataSource();

					$this->paginate = array(
					'conditions'=>array('StudentAlotment.college_group_subject_id in ('.$collegegroupsubjcts.')'),
					'fields'=>array('max(StudentAlotment.grade) as grade ','StudentAlotment.allocation_year','StudentAlotment.college_group_subject_id',
					'(SELECT total_percentage
					FROM student_registrations
					WHERE id = (select a.student_registration_id from ' . $db->fullTableName($this->StudentAlotment) . ' a WHERE StudentAlotment.college_group_subject_id = a.college_group_subject_id AND a.grade = max(StudentAlotment.grade)))as total_percentage'),
					'group' => array('StudentAlotment.college_group_subject_id'),
					'order' => array('StudentAlotment.allocation_year')
					); 
					
				/**/
				//pr($this->paginate('StudentAlotment')); exit;
				if(!empty($collegegroupsubjcts)){
				$this->set('studentallocation',$this->paginate('StudentAlotment')); 
				}

			}
		}
		
		private function getPercentageofGrade($gradeval){
				
				$this->loadModel('Gradepoint');
				$this->loadModel('AdminPreference');
				
				$markslimit = $this->AdminPreference->find('first', array('fields' => array('markslimit'), 'conditions' => array('year' => date('Y'))));
				
				if(!empty($gradeval)){
					$subjectpercentagemarks= $this->Gradepoint->find('first', array('fields' => array('lowerlimit', 'id'), 'conditions' => array('gradepoints' => $gradeval)));

					if (!empty($subjectpercentagemarks)) {
					$lowerlimit = $subjectpercentagemarks['Gradepoint']['lowerlimit'];
					}

					$markspercentage = ($lowerlimit * $markslimit['AdminPreference']['markslimit']) / 100;

						return $percentagemarks = $markspercentage + $lowerlimit;
				}else{
					return false;
				}
		}
    
    }
