<?php

App::uses('AppController', 'Controller');

/**
 * AdmissionCancellations Controller
 *
 * @property AdmissionCancellation $AdmissionCancellation
 */
class AdmissionCancellationsController extends AppController {

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
		$this->AdmissionCancellation->recursive = 0;
		$this->set('admissionCancellations', $this->paginate());
	}
	public function download_cacellationreport(){
		$data = $this->AdmissionCancellation->find('all');
		
		$this->layout = null;
		
		if(!empty($data)){
		$this->set('cancelledreport', $data);
		$year = Date('Y');
		$this->layout =NULL;
		header("Content-Type:application/vnd.ms-excel");
		header("Content-Disposition: attachment;Filename=CancelledAdmission_".$year.".xlsx");
		}else{
			$this->flash(__('No data is there to download.'), array('action' => 'index'));

		//$this->Session->setFlash(__('No data is there to download'));
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
        if (!$this->AdmissionCancellation->exists($id)) {
            throw new NotFoundException(__('Invalid admission cancellation'));
        }
        $options = array('conditions' => array('AdmissionCancellation.' . $this->AdmissionCancellation->primaryKey => $id));
        $admissionCancellation = $this->AdmissionCancellation->find('first', $options);
        $this->loadModel('User');
        $createUserId = $admissionCancellation['AdmissionCancellation']['created_by'];
        $createUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $createUserId)));
        $modifyUserId = $admissionCancellation['AdmissionCancellation']['modified_by'];
        $admissionCancellation['AdmissionCancellation']['created'] = date("d-m-Y", strtotime($admissionCancellation['AdmissionCancellation']['created']));
        $admissionCancellation['AdmissionCancellation']['modified'] = date("d-m-Y", strtotime($admissionCancellation['AdmissionCancellation']['modified']));
        $modifyUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $modifyUserId)));
        $this->set('admissionCancellation', $admissionCancellation);
        $this->set('createuser', $createUserData['User']['username']);
        $this->set('modifyuser', $modifyUserData['User']['username']);
    }

    public function cancel_admission() {

        $existingcancelledid = array();
        $existingcancelledid = $this->AdmissionCancellation->find('all', array('fields' => array('AdmissionCancellation.student_registration_id')));

        $existingregistrationID = array();

        foreach ($existingcancelledid as $data) {
            $existingregistrationID[] = $data['AdmissionCancellation']['student_registration_id'];
        }
        if (!empty($existingregistrationID)) {
            $existingregistrationID[] = implode(',', $existingregistrationID);
        }


        if ($this->request->is('post')) {
            $this->loadModel('StudentRegistration');
            $this->loadModel('StudentAlotment');
            $userid = $this->Session->read('Auth.User.id');
            $cancelled_data = array('student_registration_id' => $this->request->data['AdmissionCancellation']['studentID'], 'remarks' => $this->request->data['AdmissionCancellation']['remarks'], 'created_by' => $userid);

            if (in_array($this->request->data['AdmissionCancellation']['studentID'], $existingregistrationID)) {
                $this->Session->setFlash(__('This admission has been already cancelled'));
            } else {
                $this->AdmissionCancellation->create();
                if ($this->AdmissionCancellation->save($cancelled_data)) {

                    $stdregistercancelStatus = array('StudentRegistration.isCancelled' => '"Y"');

                    $this->StudentRegistration->updateAll($stdregistercancelStatus, array('StudentRegistration.id' => $this->request->data['AdmissionCancellation']['studentID']), true);

                    $stdalotmentID = $this->StudentAlotment->find('first', array('fields' => array('id'), 'conditions' => array('StudentAlotment.student_registration_id' => $this->request->data['AdmissionCancellation']['studentID'])));
                    if (!empty($stdalotmentID)) {
                        $stdalotmentcancelStatus = array('StudentAlotment.isCancelled' => '"Y"');
                        $this->StudentAlotment->updateAll($stdalotmentcancelStatus, array('StudentAlotment.id' => $stdalotmentID['StudentAlotment']['id']), true);
                    }
                    $this->Session->setFlash('This admission has been cancelled successfully', 'default', array('class' => 'successmessage'));
                    $this->redirect(array('action' => 'index'));
                }
            }
        }
    }

    function getcancellationdetails() {

        $this->AdmissionCancellation->layout = null;
        if (!empty($this->request->data)) {
            $this->loadModel('StudentPreferedColleges');
            $this->loadModel('CollegeGroupSubject');
            $this->loadModel('StudentAlotment');

            $admissionDetails = array();
            $collegegroupsubject_id = array();
            $collegeUniversity = array();

            $admissionDetails = $this->AdmissionCancellation->StudentRegistration->find('first', array('conditions' => array('StudentRegistration.application_number' => $this->request->data['application_number'])));
            $checkforalotment = array();
            if (!empty($admissionDetails['StudentRegistration']['id'])) {
                $checkforalotment = $this->StudentAlotment->find('first', array('fields' => array('student_registration_id'), 'conditions' => array('StudentAlotment.student_registration_id' => $admissionDetails['StudentRegistration']['id'])));

                if (!empty($checkforalotment)) {
                    
                } else {

                    echo "{'status':'0'}";
                    exit;
                }
            }
            $data = '';
            if (!empty($checkforalotment)) {
                $collegegroupsubject_id = $this->StudentPreferedColleges->find('first', array('fields' => array('college_group_subject_id'), 'conditions' => array('StudentPreferedColleges.student_registration_id' => $admissionDetails['StudentRegistration']['id'])));

                $this->CollegeGroupSubject->recursive = 2;
                $collegeUniversity = $this->CollegeGroupSubject->read('', $collegegroupsubject_id['StudentPreferedColleges']['college_group_subject_id']);

                $app_number = '';
                $app_number = $admissionDetails['StudentRegistration']['application_number'];

                $applicant_name = '';
                $applicant_name = $admissionDetails['StudentRegistration']['applicant_name'];

                $university_name = '';
                $university_name = $collegeUniversity['College']['University']['name'];

                $college_name = '';
                $college_name = $collegeUniversity['College']['name'];

                $student_registration_id = '';
                $student_registration_id = $admissionDetails['StudentRegistration']['id'];

                $dateofapplication = '';
                $dateofapplication = date('d-m-Y', strtotime($admissionDetails['StudentRegistration']['created']));

                $courseName = '';
                $courseName = $admissionDetails['Course']['name'];

                //$contactNum = $admissionDetails['StudentRegistration']['id'];
                $data = '{"app_number":"' . $app_number . '","applicant_name":"' . $applicant_name . '","university_name":"' . $university_name . '","college_name":"' . $college_name . '","student_registration_id":"' . $student_registration_id . '","dateofapplication":"' . $dateofapplication . '","courseName":"' . $courseName . '"}';
            } else {
                $data = false;
            }

            echo $data;
            exit;
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
        if (!$this->AdmissionCancellation->exists($id)) {
            throw new NotFoundException(__('Invalid admission cancellation'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->AdmissionCancellation->save($this->request->data)) {
                $this->flash(__('The admission cancellation has been saved.'), array('action' => 'index'));
            } else {
                
            }
        } else {
            $options = array('conditions' => array('AdmissionCancellation.' . $this->AdmissionCancellation->primaryKey => $id));
            $this->request->data = $this->AdmissionCancellation->find('first', $options);
        }
        $studentRegistrations = $this->AdmissionCancellation->StudentRegistration->find('list');
        $this->set(compact('studentRegistrations'));
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
        $this->AdmissionCancellation->id = $id;
        if (!$this->AdmissionCancellation->exists()) {
            throw new NotFoundException(__('Invalid admission cancellation'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->AdmissionCancellation->delete()) {
            $this->flash('Admission cancellation deleted', 'default', array('class' => 'successmessage'));
            $this->redirect(array('action' => 'index'));
        }
        $this->flash(__('Admission cancellation was not deleted'), array('action' => 'index'));
        $this->redirect(array('action' => 'index'));
    }

}
