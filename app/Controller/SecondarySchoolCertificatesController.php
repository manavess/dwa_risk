<?php

App::uses('AppController', 'Controller');
App::import('Vendor', 'Excel/reader');
App::import('Sanitize');
set_time_limit(240);    //4minutes
ini_set('memory_limit', -1);

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
    var $uses = array('SecondarySchoolCertificate', 'StudentSecondarySchDetail', 'Subject');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('secondaryschooldata', 'getsubjectid');
    }

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
                    $this->Session->setFlash('The secondary school certificate has been saved', 'default', array('class' => 'successmessage'));
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
                $this->Session->setFlash('The secondary school certificate has been saved', 'default', array('class' => 'successmessage'));
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
            $this->Session->setFlash('Secondary school certificate deleted', 'default', array('class' => 'successmessage'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Secondary school certificate was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    public function uploadsecondarycertificate() {

        if (!empty($this->data)) {


            if ($this->request->data['SecondarySchoolCertificate']['excel']['type'] == 'application/vnd.ms-excel' || $this->request->data['SecondarySchoolCertificate']['excel']['type'] == 'application/download') {


                $data = new Spreadsheet_Excel_Reader();

                // Set output Encoding.
                //$data->setOutputEncoding('CP1251');
                $data->read($this->data['SecondarySchoolCertificate']['excel']['tmp_name']);
                //Excel munupulation

                $headings = array();
                $xls_data = array();
                $xls_detail = array();

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
                if (!empty($data->sheets[0]['cells'][1][1]) && $data->sheets[0]['cells'][1][1] == 'certificate_number' && $data->sheets[0]['cells'][1][2] == 'certificate_type') {
                    $userid = $this->Session->read('Auth.User.id');
                    $ifmatched = '';

                    for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) {
                        $row_data = array();
                        $row_detail = array();
                        $certificate_num = '';
                        $c = 0;

                        //  $hascode = $data->sheets[0]['cells'][$i][2];
                        // $datahascode = $this->SecondarySchoolCertificate->query('select * from tm_policy_hascodes where v_code=' . $hascode9			
                        if (!in_array($data->sheets[0]['cells'][$i][1], $certi_num)) {
                            if ($data->sheets[0]['cells'][$i][4] <= date('Y-m-d') && ($data->sheets[0]['cells'][$i][4] <= date('Y-m-d')) != '' && $data->sheets[0]['cells'][$i][3] <= date('Y-m-d') && ($data->sheets[0]['cells'][$i][3] <= date('Y-m-d')) != '' && $data->sheets[0]['cells'][$i][5] <= date('Y') && ($data->sheets[0]['cells'][$i][5] <= date('Y')) != '') {

                                $row_data['certificate_number'] = $data->sheets[0]['cells'][$i][1];
                                $row_data['certificate_type'] = $data->sheets[0]['cells'][$i][2];
                                $row_data['date_of_birth'] = isset($data->sheets[0]['cells'][$i][3]) ? $data->sheets[0]['cells'][$i][3] : 0;
                                $row_data['date_of_birth'] = date('Y-m-d', strtotime($row_data['date_of_birth']));

                                $row_data['certificate_date'] = isset($data->sheets[0]['cells'][$i][4]) ? $data->sheets[0]['cells'][$i][4] : 0;
                                $row_data['certificate_date'] = date('Y-m-d', strtotime($row_data['certificate_date']));

                                $row_data['year'] = isset($data->sheets[0]['cells'][$i][5]) ? $data->sheets[0]['cells'][$i][5] : 0;
                                $row_data['created'] = date('Y-m-d');
                                $row_data['created_by'] = $userid;
                                /* preparing data for subject marks table */
                                if (!empty($data->sheets[0]['cells'][$i][6]))
                                    $row_detail[$c]['name'] = $data->sheets[0]['cells'][$i][6];

                                if (!empty($data->sheets[0]['cells'][$i][7])) {
                                    $row_detail[$c]['name'] = $data->sheets[0]['cells'][$i][6];
                                    $row_detail[$c]['subject_code'] = 'COMP1';
                                    $row_detail[$c]['subject_id'] = $this->getsubjectid('COMP1');
                                    $row_detail[$c]['marks'] = $data->sheets[0]['cells'][$i][7];
                                } else {
                                    $c = $c - 1;
                                }
                                if (!empty($data->sheets[0]['cells'][$i][8])) {
                                    $c++;
                                    $row_detail[$c]['name'] = $data->sheets[0]['cells'][$i][6];
                                    $row_detail[$c]['subject_code'] = 'COMP2';
                                    $row_detail[$c]['subject_id'] = $this->getsubjectid('COMP2');
                                    $row_detail[$c]['marks'] = $data->sheets[0]['cells'][$i][8];
                                }
                                if (!empty($data->sheets[0]['cells'][$i][9])) {
                                    $c++;
                                    $row_detail[$c]['name'] = $data->sheets[0]['cells'][$i][6];
                                    $row_detail[$c]['subject_code'] = 'COMP3';
                                    $row_detail[$c]['subject_id'] = $this->getsubjectid('COMP3');
                                    $row_detail[$c]['marks'] = $data->sheets[0]['cells'][$i][9];
                                }
                                if (!empty($data->sheets[0]['cells'][$i][10])) {
                                    $c++;
                                    $row_detail[$c]['name'] = $data->sheets[0]['cells'][$i][6];
                                    $row_detail[$c]['subject_code'] = 'COMP4';
                                    $row_detail[$c]['subject_id'] = $this->getsubjectid('COMP4');
                                    $row_detail[$c]['marks'] = $data->sheets[0]['cells'][$i][10];
                                }
                                if (!empty($data->sheets[0]['cells'][$i][11])) {
                                    $c++;
                                    $row_detail[$c]['name'] = $data->sheets[0]['cells'][$i][6];
                                    $row_detail[$c]['subject_code'] = 'COMP5';
                                    $row_detail[$c]['subject_id'] = $this->getsubjectid('COMP5');
                                    $row_detail[$c]['marks'] = $data->sheets[0]['cells'][$i][11];
                                }


                                if (!empty($data->sheets[0]['cells'][$i][12])) {
                                    $c++;
                                    $row_detail[$c]['name'] = $data->sheets[0]['cells'][$i][6];
                                    $row_detail[$c]['subject_code'] = 'OPT1';
                                    $row_detail[$c]['subject_id'] = $this->getsubjectid('OPT1');
                                    $row_detail[$c]['marks'] = $data->sheets[0]['cells'][$i][12];
                                }

                                if (!empty($data->sheets[0]['cells'][$i][13])) {
                                    $c++;
                                    $row_detail[$c]['name'] = $data->sheets[0]['cells'][$i][6];
                                    $row_detail[$c]['subject_code'] = 'OPT2';
                                    $row_detail[$c]['subject_id'] = $this->getsubjectid('OPT2');
                                    $row_detail[$c]['marks'] = $data->sheets[0]['cells'][$i][13];
                                }

                                if (!empty($data->sheets[0]['cells'][$i][14])) {
                                    $c++;
                                    $row_detail[$c]['name'] = $data->sheets[0]['cells'][$i][6];
                                    $row_detail[$c]['subject_code'] = 'OPT3';
                                    $row_detail[$c]['subject_id'] = $this->getsubjectid('OPT3');
                                    $row_detail[$c]['marks'] = $data->sheets[0]['cells'][$i][14];
                                }

                                if (!empty($data->sheets[0]['cells'][$i][15])) {
                                    $c++;
                                    $row_detail[$c]['name'] = $data->sheets[0]['cells'][$i][6];
                                    $row_detail[$c]['subject_code'] = 'OPT4';
                                    $row_detail[$c]['subject_id'] = $this->getsubjectid('OPT4');
                                    $row_detail[$c]['marks'] = $data->sheets[0]['cells'][$i][15];
                                }

                                if (!empty($data->sheets[0]['cells'][$i][16])) {
                                    $c++;
                                    $row_detail[$c]['name'] = $data->sheets[0]['cells'][$i][6];
                                    $row_detail[$c]['subject_code'] = 'OPT5';
                                    $row_detail[$c]['subject_id'] = $this->getsubjectid('OPT5');
                                    $row_detail[$c]['marks'] = $data->sheets[0]['cells'][$i][16];
                                }

                                if (!empty($data->sheets[0]['cells'][$i][17])) {
                                    $c++;
                                    $row_detail[$c]['name'] = $data->sheets[0]['cells'][$i][6];
                                    $row_detail[$c]['subject_code'] = 'OPT6';
                                    $row_detail[$c]['subject_id'] = $this->getsubjectid('OPT6');
                                    $row_detail[$c]['marks'] = $data->sheets[0]['cells'][$i][17];
                                }

                                if (!empty($data->sheets[0]['cells'][$i][18])) {
                                    $c++;
                                    $row_detail[$c]['name'] = $data->sheets[0]['cells'][$i][6];
                                    $row_detail[$c]['subject_code'] = 'OPT7';
                                    $row_detail[$c]['subject_id'] = $this->getsubjectid('OPT7');
                                    $row_detail[$c]['marks'] = $data->sheets[0]['cells'][$i][18];
                                }

                                if (!empty($data->sheets[0]['cells'][$i][19])) {
                                    $c++;
                                    $row_detail[$c]['name'] = $data->sheets[0]['cells'][$i][6];
                                    $row_detail[$c]['subject_code'] = 'OPT8';
                                    $row_detail[$c]['subject_id'] = $this->getsubjectid('OPT8');
                                    $row_detail[$c]['marks'] = $data->sheets[0]['cells'][$i][19];
                                }

                                if (!empty($data->sheets[0]['cells'][$i][20])) {
                                    $c++;
                                    $row_detail[$c]['name'] = $data->sheets[0]['cells'][$i][6];
                                    $row_detail[$c]['subject_code'] = 'OPT9';
                                    $row_detail[$c]['subject_id'] = $this->getsubjectid('OPT9');
                                    $row_detail[$c]['marks'] = $data->sheets[0]['cells'][$i][20];
                                }

                                if (!empty($data->sheets[0]['cells'][$i][21])) {
                                    $c++;
                                    $row_detail[$c]['name'] = $data->sheets[0]['cells'][$i][6];
                                    $row_detail[$c]['subject_code'] = 'OPT10';
                                    $row_detail[$c]['subject_id'] = $this->getsubjectid('OPT10');
                                    $row_detail[$c]['marks'] = $data->sheets[0]['cells'][$i][21];
                                }

                                if (!empty($data->sheets[0]['cells'][$i][22])) {
                                    $c++;
                                    $row_detail[$c]['name'] = $data->sheets[0]['cells'][$i][6];
                                    $row_detail[$c]['subject_code'] = 'OPT11';
                                    $row_detail[$c]['subject_id'] = $this->getsubjectid('OPT11');
                                    $row_detail[$c]['marks'] = $data->sheets[0]['cells'][$i][22];
                                }

                                if (!empty($data->sheets[0]['cells'][$i][23])) {
                                    $c++;
                                    $row_detail[$c]['name'] = $data->sheets[0]['cells'][$i][6];
                                    $row_detail[$c]['subject_code'] = 'OPT12';
                                    $row_detail[$c]['subject_id'] = $this->getsubjectid('OPT12');
                                    $row_detail[$c]['marks'] = $data->sheets[0]['cells'][$i][23];
                                }

                                if (!empty($data->sheets[0]['cells'][$i][24])) {
                                    $c++;
                                    $row_detail[$c]['name'] = $data->sheets[0]['cells'][$i][6];
                                    $row_detail[$c]['subject_code'] = 'OPT13';
                                    $row_detail[$c]['subject_id'] = $this->getsubjectid('OPT13');
                                    $row_detail[$c]['marks'] = $data->sheets[0]['cells'][$i][24];
                                }

                                if (!empty($data->sheets[0]['cells'][$i][25])) {
                                    $c++;
                                    $row_detail[$c]['name'] = $data->sheets[0]['cells'][$i][6];
                                    $row_detail[$c]['subject_code'] = 'OPT14';
                                    $row_detail[$c]['subject_id'] = $this->getsubjectid('OPT14');
                                    $row_detail[$c]['marks'] = $data->sheets[0]['cells'][$i][25];
                                }

                                if (!empty($data->sheets[0]['cells'][$i][26])) {
                                    $c++;
                                    $row_detail[$c]['name'] = $data->sheets[0]['cells'][$i][6];
                                    $row_detail[$c]['subject_code'] = 'OPT15';
                                    $row_detail[$c]['subject_id'] = $this->getsubjectid('OPT15');
                                    $row_detail[$c]['marks'] = $data->sheets[0]['cells'][$i][26];
                                }

                                if (!empty($data->sheets[0]['cells'][$i][27])) {
                                    $c++;
                                    $row_detail[$c]['name'] = $data->sheets[0]['cells'][$i][6];
                                    $row_detail[$c]['subject_code'] = 'OPT16';
                                    $row_detail[$c]['subject_id'] = $this->getsubjectid('OPT16');
                                    $row_detail[$c]['marks'] = $data->sheets[0]['cells'][$i][27];
                                }

                                if (!empty($data->sheets[0]['cells'][$i][28])) {
                                    $c++;
                                    $row_detail[$c]['name'] = $data->sheets[0]['cells'][$i][6];
                                    $row_detail[$c]['subject_code'] = 'OPT17';
                                    $row_detail[$c]['subject_id'] = $this->getsubjectid('OPT17');
                                    $row_detail[$c]['marks'] = $data->sheets[0]['cells'][$i][28];
                                }

                                if (!empty($data->sheets[0]['cells'][$i][29])) {
                                    $c++;
                                    $row_detail[$c]['name'] = $data->sheets[0]['cells'][$i][6];
                                    $row_detail[$c]['subject_code'] = 'OPT18';
                                    $row_detail[$c]['subject_id'] = $this->getsubjectid('OPT18');
                                    $row_detail[$c]['marks'] = $data->sheets[0]['cells'][$i][29];
                                }

                                if (!empty($data->sheets[0]['cells'][$i][30])) {
                                    $c++;
                                    $row_detail[$c]['name'] = $data->sheets[0]['cells'][$i][6];
                                    $row_detail[$c]['subject_code'] = 'OPT19';
                                    $row_detail[$c]['subject_id'] = $this->getsubjectid('OPT19');
                                    $row_detail[$c]['marks'] = $data->sheets[0]['cells'][$i][30];
                                }

                                if (!empty($data->sheets[0]['cells'][$i][31])) {
                                    $c++;
                                    $row_detail[$c]['name'] = $data->sheets[0]['cells'][$i][6];
                                    $row_detail[$c]['subject_code'] = 'OPT20';
                                    $row_detail[$c]['subject_id'] = $this->getsubjectid('OPT20');
                                    $row_detail[$c]['marks'] = $data->sheets[0]['cells'][$i][31];
                                }

                                if (!empty($data->sheets[0]['cells'][$i][32])) {
                                    $c++;
                                    $row_detail[$c]['name'] = $data->sheets[0]['cells'][$i][6];
                                    $row_detail[$c]['subject_code'] = 'OPT21';
                                    $row_detail[$c]['subject_id'] = $this->getsubjectid('OPT21');
                                    $row_detail[$c]['marks'] = $data->sheets[0]['cells'][$i][32];
                                }

                                if (!empty($data->sheets[0]['cells'][$i][33])) {
                                    $c++;
                                    $row_detail[$c]['name'] = $data->sheets[0]['cells'][$i][6];
                                    $row_detail[$c]['subject_code'] = 'OPT22';
                                    $row_detail[$c]['subject_id'] = $this->getsubjectid('OPT22');
                                    $row_detail[$c]['marks'] = $data->sheets[0]['cells'][$i][33];
                                }

                                if (!empty($data->sheets[0]['cells'][$i][34])) {
                                    $c++;
                                    $row_detail[$c]['name'] = $data->sheets[0]['cells'][$i][6];
                                    $row_detail[$c]['subject_code'] = 'OPT23';
                                    $row_detail[$c]['subject_id'] = $this->getsubjectid('OPT23');
                                    $row_detail[$c]['marks'] = $data->sheets[0]['cells'][$i][34];
                                }

                                if (!empty($data->sheets[0]['cells'][$i][35])) {
                                    $c++;
                                    $row_detail[$c]['name'] = $data->sheets[0]['cells'][$i][6];
                                    $row_detail[$c]['subject_code'] = 'OPT24';
                                    $row_detail[$c]['subject_id'] = $this->getsubjectid('OPT24');
                                    $row_detail[$c]['marks'] = $data->sheets[0]['cells'][$i][35];
                                }
                                //pr($data->sheets[0]['cells']);die;
                                $c++;

                                /* subject-marks data end here */
                                if ($i > 1) {
                                    $xls_data = $row_data;
                                    $xls_detail = $row_detail;

                                    if (count($xls_detail) >= 5) {



                                        if (!empty($xls_data) && (!empty($data->sheets[0]['cells'][$i][10]) Xor ! empty($data->sheets[0]['cells'][$i][11])) || (empty($data->sheets[0]['cells'][$i][10]) && empty($data->sheets[0]['cells'][$i][11]))) {


                                            if ($this->SecondarySchoolCertificate->saveAll($xls_data, array('validate' => false))) {
                                                $lastinsertedID = $this->SecondarySchoolCertificate->getLastInsertID();

                                                for ($v = 0; $v < count($row_detail); $v++) {

                                                    $xls_detail[$v]['secondary_certificate_id'] = $lastinsertedID;
                                                    $xls_detail[$v]['name'] = $row_detail[$v]['name'];
                                                    $xls_detail[$v]['subject_code'] = $row_detail[$v]['subject_code'];
                                                    $xls_detail[$v]['subject_id'] = $row_detail[$v]['subject_id'];
                                                    $xls_detail[$v]['marks'] = $row_detail[$v]['marks'];
                                                }
                                                //pr($xls_detail);die;

                                                $this->StudentSecondarySchDetail->saveAll($xls_detail, array('validate' => false));
                                                unset($xls_detail);
                                                unset($row_detail);
                                                $messag .= 'successfully imported!';
                                            } else {
                                                $this->Session->setFlash('Error.  Unable to import records. Please try again.');
                                            }
                                        } else {
                                            $messag .= '</br>For certificate number ' . $data->sheets[0]['cells'][$i][1] . ' you are trying to upload both compulsary subjects COMP4 & COMP5, please fill only one of them.<br />';
                                        }
                                    } else {
                                        $messag .= '</br>For certificate number ' . $data->sheets[0]['cells'][$i][1] . ' there should be minimum five subject marks<br />';
                                    }
                                }
                            } else {
                                $messag .= '</br>For certificate number ' . $data->sheets[0]['cells'][$i][1] . ' Some Invalid Certificate date or Date of birth or Year appear in the excel sheet that could not be imported.';
                            }
                        } else {
                            $ifmatched[] = $data->sheets[0]['cells'][$i][1];
                        }
                    }
                } else {
                    $messag .= 'Wrong excel file has been tried to upload';
                }
                $duplicateNumrows = '';

                if (!empty($ifmatched)) {
                    $duplicateNumrows = count($ifmatched);
                    foreach ($ifmatched as $key => $val) {

                        $messag .= '</br>Certificate Number ' . $val . ' in excel file is duplicate entry. This certificate number already exist in the database<br />';
                    }
                }

                if (!empty($messag)) {
                    $this->Session->setFlash($messag);
                }
            } else {
                $this->Session->setFlash("No file has been selected or invalid file has been tried to upload. Upload excel file only.");
            }
        }
    }

    public function secondaryschooldata() {

        if ($this->request->is('post')) {

            $subjectcode = '';
            $i = 0;
            foreach ($this->data as $key => $value) {

                if (!empty($value)) {
                    $SecondarySchoolCertificate[$key] = $value;
                }
            } //die;

            $this->SecondarySchoolCertificate->create();
            $userid = $this->Session->read('Auth.User.id');

            $this->request->data['SecondarySchoolCertificate']['certificate_number'] = $SecondarySchoolCertificate['certificatenumber'];
            $this->request->data['SecondarySchoolCertificate']['certificate_type'] = $SecondarySchoolCertificate['certificatetype'];
            $this->request->data['SecondarySchoolCertificate']['date_of_birth'] = date('Y-m-d', strtotime($SecondarySchoolCertificate['dateofbirth']));
            $this->request->data['SecondarySchoolCertificate']['certificate_date'] = date('Y-m-d', strtotime($SecondarySchoolCertificate['certificatedate']));
            $this->request->data['SecondarySchoolCertificate']['year'] = date('Y');
            $this->request->data['SecondarySchoolCertificate']['created'] = date('Y-m-d');
            $this->request->data['SecondarySchoolCertificate']['created_by'] = 1;

            $name = $SecondarySchoolCertificate['studentname'];

            unset($SecondarySchoolCertificate['certificatenumber']);
            unset($SecondarySchoolCertificate['certificatetype']);
            unset($SecondarySchoolCertificate['dateofbirth']);
            unset($SecondarySchoolCertificate['certificatedate']);
            unset($SecondarySchoolCertificate['isNewRecord']);
            unset($SecondarySchoolCertificate['studentname']);

            //$this->SecondarySchoolCertificate->create();
            if ($this->SecondarySchoolCertificate->save($this->request->data['SecondarySchoolCertificate'])) {

                $secondaryschID = $this->SecondarySchoolCertificate->getLastInsertID();

                $this->StudentSecondarySchDetail->create();

                $this->loadModel('StudentSecondarySchDetail');

                $this->request->data['StudentSecondarySchDetail']['secondary_certificate_id'] = $secondaryschID;
                $this->request->data['StudentSecondarySchDetail']['name'] = $name;


                $schdetail = array();
                $schfinaldetail = array();
                $i = 0;
                foreach ($SecondarySchoolCertificate as $key => $value) {

                    $schdetail['StudentSecondarySchDetail']['name'] = $name;
                    $schdetail['StudentSecondarySchDetail']['secondary_certificate_id'] = $secondaryschID;
                    $schdetail['StudentSecondarySchDetail']['subject_code'] = $key;
                    $schdetail['StudentSecondarySchDetail']['subject_id'] = $this->getsubjectid($key);
                    $schdetail['StudentSecondarySchDetail']['marks'] = $value;
                    $schdetail['StudentSecondarySchDetail']['created'] = date('Y-m-d');
                    $schdetail['StudentSecondarySchDetail']['created_by'] = 1;

                    $schfinaldetail[] = $schdetail;
                }

                $this->StudentSecondarySchDetail->saveAll($schfinaldetail);

                echo "Student Secondary School Details have been saved";
                exit;
            } else {
                echo "Student Secondary School Details have not been saved";
                exit;
            }
        }
    }

    function getsubjectid($subcode = NULL) {
        $this->loadModel('Subject');
        $subjectID = $this->Subject->find('first', array('fields' => array('Subject.id'), 'conditions' => array('Subject.subject_code' => $subcode)));
        return $subjectID['Subject']['id'];
    }

    public function download_secschool_template() {

        //$name =  'KM_Document_v2.pdf'; 
        $name = 'secondaryCertificateData.xls';

        $filename = 'download/' . $name;

        header('Expires: 0');

        header('Pragma: public');

        header("Content-Type: application/octet-stream");

        header("Content-Type: application/download");

        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');

        header('Content-Disposition: attachment; filename="' . $name . '"');

        header('Content-Transfer-Encoding: binary');

        @readfile($filename);
    }

//           
}
