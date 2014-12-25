<?php

App::uses('AppController', 'Controller');
App::import('Vendor', 'Excel/reader');
App::import('Sanitize');
set_time_limit(240);    //4minutes
ini_set('memory_limit', '64M');

/**
 * SecondarySchoolCertificates Controller
 *
 * @property SecondarySchoolCertificate $SecondarySchoolCertificate
 */
class SecondarySchoolCertificatesController extends AppController {

    /**
     * Helpers
     *
     * @var array
     */
    var $helpers = array('Html', 'Js', 'Form', 'Session'); //Helper

    /**
     * index method
     *
     * @return void
     */

    public function index() {
        $this->SecondarySchoolCertificate->recursive = 0;
        $this->set('secondarySchoolCertificates', $this->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->SecondarySchoolCertificate->exists($id)) {
            throw new NotFoundException(__('Invalid secondary school certificate'));
        }
        $options = array('conditions' => array('SecondarySchoolCertificate.' . $this->SecondarySchoolCertificate->primaryKey => $id));
        $data = $this->SecondarySchoolCertificate->find('first', $options);
        $this->loadModel('User');

        $createdby = $this->User->find('first', array('fields' => array('username'), 'conditions' => array('User.id' => $data['SecondarySchoolCertificate']['created_by'])));
        $modifiedby = $this->User->find('first', array('fields' => array('username'), 'conditions' => array('User.id' => $data['SecondarySchoolCertificate']['modified_by'])));

        $this->set(compact('createdby', 'modifiedby'));

        $this->set('secondarySchoolCertificate', $this->SecondarySchoolCertificate->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        $data = $this->SecondarySchoolCertificate->find('all', array('fields' => array('certificate_number')));
        $existingcertificatenum = '';
        foreach ($data as $certificatenumber) {
            $existingcertificatenum[] = $certificatenumber['SecondarySchoolCertificate']['certificate_number'];
        }

        if ($this->request->is('post')) {

            if (!in_array($this->data['SecondarySchoolCertificate']['certificate_number'], $existingcertificatenum, TRUE)) {
                $this->SecondarySchoolCertificate->create();
                $userid = $this->Session->read('Auth.User.id');
                $this->request->data['SecondarySchoolCertificate']['created_by'] = $userid;
                $this->request->data['SecondarySchoolCertificate']['created'] = date('Y-m-d');
                $this->request->data['SecondarySchoolCertificate']['date_of_birth'] = date('Y-m-d', strtotime($this->request->data['SecondarySchoolCertificate']['date_of_birth']));
                $this->request->data['SecondarySchoolCertificate']['certificate_date'] = date('Y-m-d', strtotime($this->request->data['SecondarySchoolCertificate']['certificate_date']));

                if ($this->SecondarySchoolCertificate->save($this->request->data)) {
                    $this->Session->setFlash('The secondary school certificate has been saved','default',array('class'=>'successmessage'));
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The secondary school certificate could not be saved. Please, try again.'));
                }
            } else {
                $this->Session->setFlash(__('This certificate number already exist. Please enter a unique certificate number'));
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
        if (!$this->SecondarySchoolCertificate->exists($id)) {
            throw new NotFoundException(__('Invalid secondary school certificate'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $userid = $this->Session->read('Auth.User.id');
            $this->request->data['SecondarySchoolCertificate']['modified_by'] = $userid;
            $this->request->data['SecondarySchoolCertificate']['modified'] = date('Y-m-d');
            if ($this->SecondarySchoolCertificate->save($this->request->data)) {
                $this->Session->setFlash('The secondary school certificate has been saved','default',array('class'=>'successmessage'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The secondary school certificate could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('SecondarySchoolCertificate.' . $this->SecondarySchoolCertificate->primaryKey => $id));
            $this->request->data = $this->SecondarySchoolCertificate->find('first', $options);
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
        $this->SecondarySchoolCertificate->id = $id;
        if (!$this->SecondarySchoolCertificate->exists()) {
            throw new NotFoundException(__('Invalid secondary school certificate'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->SecondarySchoolCertificate->delete()) {
            $this->Session->setFlash('Secondary school certificate deleted','default',array('class'=>'successmessage'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Secondary school certificate was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    public function uploadsecondarycertificate() {

        if (!empty($this->data)) {
			

		if ($this->request->data['SecondarySchoolCertificate']['excel']['type']=='application/vnd.ms-excel') {
           			
			
            $data = new Spreadsheet_Excel_Reader();

            // Set output Encoding.
            //$data->setOutputEncoding('CP1251');
            $data->read($this->data['SecondarySchoolCertificate']['excel']['tmp_name']);
            //Excel munupulation

            $headings = array();
            $xls_data = array();

            $datahascode = $this->SecondarySchoolCertificate->find('all', array('fields' => array('certificate_number')));

            foreach ($datahascode as $certificate) {
                $certi_num[] = $certificate['SecondarySchoolCertificate']['certificate_number'];
            }
            if (!empty($certi_num)) {
                $certi_num = $certi_num;
            } else {
                $certi_num = array();
            }
            
            $messag = '';
//pr($data->sheets[0]); die;
if(!empty($data->sheets[0]['cells'][1][1]) && $data->sheets[0]['cells'][1][1]=='certificate_number' && $data->sheets[0]['cells'][1][2]=='certificate_type'){
            $userid = $this->Session->read('Auth.User.id');
            $ifmatched = '';
            
            for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) {
                $row_data = array();

                $certificate_num = '';

                //  $hascode = $data->sheets[0]['cells'][$i][2];
                // $datahascode = $this->SecondarySchoolCertificate->query('select * from tm_policy_hascodes where v_code=' . $hascode9			
                if (!in_array($data->sheets[0]['cells'][$i][1], $certi_num)) {
		            if($data->sheets[0]['cells'][$i][4] <= date('Y-m-d') && ($data->sheets[0]['cells'][$i][4] <= date('Y-m-d'))!='' && $data->sheets[0]['cells'][$i][3]<= date('Y-m-d') && ($data->sheets[0]['cells'][$i][3] <= date('Y-m-d'))!='' && $data->sheets[0]['cells'][$i][5] <= date('Y') && ($data->sheets[0]['cells'][$i][5] <= date('Y'))!=''){
		            
                    $row_data['certificate_number'] = $data->sheets[0]['cells'][$i][1];
                    $row_data['certificate_type'] = $data->sheets[0]['cells'][$i][2];
                    $row_data['date_of_birth'] = isset($data->sheets[0]['cells'][$i][3]) ? $data->sheets[0]['cells'][$i][3] : 0;
                    $row_data['date_of_birth'] = date('Y-m-d', strtotime($row_data['date_of_birth']) - (3600 * 24));

                    $row_data['certificate_date'] = isset($data->sheets[0]['cells'][$i][4]) ? $data->sheets[0]['cells'][$i][4] : 0;
                    $row_data['certificate_date'] = date('Y-m-d', strtotime($row_data['certificate_date']) - (3600 * 24));

                    $row_data['year'] = isset($data->sheets[0]['cells'][$i][5]) ? $data->sheets[0]['cells'][$i][5] : 0;
                    $row_data['created'] = date('Y-m-d');
                    $row_data['created_by'] = $userid;


                    if ($i > 1) {
                        $xls_data[] = $row_data;
                    }
                    }else{
				           $messag = 'Some Invalid Certificate date or Date of birth or Year appear in the excel sheet that could not be imported.';
				           }
                } else {
                    $ifmatched[] = $data->sheets[0]['cells'][$i][1];
                }
            }
            }else{
            $messag .= 'Wrong excel file has been tried to upload';
            }
            $duplicateNumrows = '';
            
            if (!empty($ifmatched)) {
                $duplicateNumrows = count($ifmatched);
                foreach ($ifmatched as $key => $val) {

                    $messag .= 'Certificate Number ' . $val . ' in excel file is duplicate entry. This certificate number already exist in the database<br />';
                }
            }

            if (!empty($xls_data)) {
                if ($this->SecondarySchoolCertificate->saveAll($xls_data, array('validate' => false))) {
                    $this->Session->setFlash('Success. Imported ' . count($xls_data) . ' records. <br />' . $messag,'default',array('class'=>'successmessage'));
                } else {
                    $this->Session->setFlash('Error.  Unable to import records. Please try again.');
                }
            } else {
                $this->Session->setFlash($messag);
            }
        }else{
        $this->Session->setFlash("No file has been selected or invalid file has been tried to upload. Upload excel file only.");
        }
        
       }
    }


//           
}


