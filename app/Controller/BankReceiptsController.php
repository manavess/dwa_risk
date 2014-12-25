<?php

App::uses('AppController', 'Controller');
App::import('Vendor', 'Excel/reader');
App::import('Sanitize');
set_time_limit(240);    //4minutes
ini_set('memory_limit', '64M');

/**
 * BankReceipts Controller
 *
 * @property BankReceipt $BankReceipt
 */
class BankReceiptsController extends AppController {

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->BankReceipt->recursive = 0;

        $this->set('bankReceipts', $this->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->BankReceipt->exists($id)) {
            throw new NotFoundException(__('Invalid bank receipt'));
        }
        $options = array('conditions' => array('BankReceipt.' . $this->BankReceipt->primaryKey => $id));
        $data = $this->BankReceipt->find('first', $options);

        $this->loadModel('User');

        $createdby = $this->User->find('all', array('fields' => array('username'), 'conditions' => array('User.id' => $data['BankReceipt']['created_by'])));

        $modifiedby = $this->User->find('first', array('fields' => array('username'), 'conditions' => array('User.id' => $data['BankReceipt']['modified_by'])));

        $this->set(compact('createdby', 'modifiedby'));
        $this->set('bankReceipt', $this->BankReceipt->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        $data = $this->BankReceipt->find('all', array('fields' => array('receipt_no')));
        $existingreceipt_no = '';
        foreach ($data as $receipt) {
            $existingreceipt_no[] = $receipt['BankReceipt']['receipt_no'];
        }
        if ($this->request->is('post')) {
            if (!in_array($this->data['BankReceipt']['receipt_no'], $existingreceipt_no, TRUE)) {
                $this->request->data['BankReceipt']['bank_receipt_date'] = date('Y-m-d', strtotime($this->data['BankReceipt']['bank_receipt_date']));
                $userid = $this->Session->read('Auth.User.id');
                $this->request->data['BankReceipt']['created_by'] = $userid;
                $this->request->data['BankReceipt']['created'] = date('Y-m-d');

                $this->BankReceipt->create();
                if ($this->BankReceipt->save($this->request->data)) {
                    $this->Session->setFlash('The bank receipt has been saved', 'default', array('class' => 'successmessage'));
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The bank receipt could not be saved. Please, try again.'));
                }
            } else {
                $this->Session->setFlash(__('This bank receipt already exist. Please, fill a unique receipt number.'));
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
        if (!$this->BankReceipt->exists($id)) {
            throw new NotFoundException(__('Invalid bank receipt'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $userid = $this->Session->read('Auth.User.id');
            $this->request->data['BankReceipt']['modified_by'] = $userid;
            $this->request->data['BankReceipt']['modified'] = date('Y-m-d');
            $this->request->data['BankReceipt']['bank_receipt_date'] = date('Y-m-d', strtotime($this->data['BankReceipt']['bank_receipt_date']));

            if ($this->BankReceipt->save($this->request->data)) {
                $this->Session->setFlash('The bank receipt has been saved', 'default', array('class' => 'successmessage'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The bank receipt could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('BankReceipt.' . $this->BankReceipt->primaryKey => $id));
            $this->request->data = $this->BankReceipt->find('first', $options);
        }
        //$studentRegistrations = $this->BankReceipt->StudentRegistration->find('list');
        //$this->set(compact('studentRegistrations'));
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
        $this->BankReceipt->id = $id;
        if (!$this->BankReceipt->exists()) {
            throw new NotFoundException(__('Invalid bank receipt'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->BankReceipt->delete()) {
            $this->Session->setFlash('Bank receipt deleted', 'default', array('class' => 'successmessage'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Bank receipt was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    public function uploadbankreceipts() {
        //       print_r($this->data); die;
        if (!empty($this->data)) {
            if ($this->request->data['BankReceipt']['excel']['type'] == 'application/vnd.ms-excel' || $this->request->data['BankReceipt']['excel']['type'] == 'application/download') {

                $data = new Spreadsheet_Excel_Reader();

                // Set output Encoding.
                //$data->setOutputEncoding('CP1251');
                $data->read($this->data['BankReceipt']['excel']['tmp_name']);
                //Excel munupulation

                $headings = array();
                $xls_data = array();
                /* code for duplicacy check */
                $datahascode = $this->BankReceipt->find('all', array('fields' => array('receipt_no')));

                foreach ($datahascode as $receipt_no) {
                    $receipt_num[] = $receipt_no['BankReceipt']['receipt_no'];
                }
                if (!empty($receipt_num)) {
                    $receipt_num = $receipt_num;
                } else {
                    $receipt_num = array();
                }
                $messag = '';
                /**/

                if (!empty($data->sheets[0]['cells'][1][1]) && $data->sheets[0]['cells'][1][1] == 'receipt_no' && $data->sheets[0]['cells'][1][2] == 'application_number') {
                    $userid = $this->Session->read('Auth.User.id');
                    for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) {
                        $row_data = array();

                        if (!in_array($data->sheets[0]['cells'][$i][1], $receipt_num)) {

                            if ($data->sheets[0]['cells'][$i][5] <= date('Y-m-d') && ($data->sheets[0]['cells'][$i][5]) != '') {
                                
                                $row_data['receipt_no'] = $data->sheets[0]['cells'][$i][1];
                                $row_data['application_number'] = isset($data->sheets[0]['cells'][$i][2]) ? $data->sheets[0]['cells'][$i][2] : 0;
                                $row_data['admission_amount'] = isset($data->sheets[0]['cells'][$i][3]) ? $data->sheets[0]['cells'][$i][3] : 0;
                                $row_data['receiving_authority'] = isset($data->sheets[0]['cells'][$i][4]) ? $data->sheets[0]['cells'][$i][4] : 0;
                                $row_data['bank_receipt_date'] = isset($data->sheets[0]['cells'][$i][5]) ? $data->sheets[0]['cells'][$i][5] : 0;
                                $row_data['bank_receipt_date'] = date('Y-m-d', strtotime($row_data['bank_receipt_date']));
                                $row_data['year'] = isset($data->sheets[0]['cells'][$i][6]) ? $data->sheets[0]['cells'][$i][6] : 0;
                                $row_data['status'] = isset($data->sheets[0]['cells'][$i][7]) ? $data->sheets[0]['cells'][$i][7] : 0;
                                $row_data['created'] = date('Y-m-d');
                                $row_data['created_by'] = $userid;

                                if ($i > 1) {
                                    $xls_data[] = $row_data;
                                }
                            } else {
                                $messag = 'Some Invalid Bank receipt date appear in the excel sheet that could not be imported.';
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

                        $messag .= 'Receipt Number ' . $val . ' in excel file is duplicate entry. This Receipt number already exist in the database<br />';
                    }
                }

                if (!empty($xls_data)) {
                    if ($this->BankReceipt->saveAll($xls_data, array('validate' => false))) {
                        $this->Session->setFlash('Success. Imported ' . count($xls_data) . ' records.<br />' . $messag, 'default', array('class' => 'successmessage'));
                    } else {
                        $this->Session->setFlash('Error.  Unable to import records. Please try again.');
                    }
                } else {
                    $this->Session->setFlash($messag);
                }
            } else {
                $this->Session->setFlash("No file has been selected or invalid file has been tried to upload. Upload excel file only.");
            }
        }
//         
    }

    public function download_bankreceipt_template() {

        //$name =  'KM_Document_v2.pdf'; 
        $name = 'bankreceipt.xls';

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

}
