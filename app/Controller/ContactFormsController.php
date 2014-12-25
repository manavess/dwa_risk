<?php

App::uses('AppController', 'Controller');

/**
 * ContactForms Controller
 *
 * @property ContactForm $ContactForm
 */
class ContactFormsController extends AppController {

    var $components = array("Email", 'Session', 'Cookie');

    /**
     * Helpers
     *
     * @var array
     */
    public $helpers = array('Html', 'Form', 'Js');
    //public $uses =array('','');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add');
    }

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->ContactForm->recursive = 0;
        $this->set('contactForms', $this->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->ContactForm->exists($id)) {
            throw new NotFoundException(__('Invalid contactForm'));
        }
        $options = array('conditions' => array('ContactForm.' . $this->ContactForm->primaryKey => $id));
        $this->set('contactForm', $this->ContactForm->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {

            if (!empty($this->request->data['ContactForm']['Reset']) && $this->request->data['ContactForm']['Reset'] == 'Reset') {
                $this->redirect(array('action' => 'add'));
            }
            //pr($this->request->data);exit;
            $this->ContactForm->create();
            if ($this->ContactForm->save($this->request->data)) {

                //============Email================//
                /* SMTP Options */
                $this->Email->smtpOptions = array(
                    'port' => '25',
                    'timeout' => '30',
                    'host' => 'mail.essindia.co.in',
                    'username' => 'prakash.joshi@essindia.co.in',
                    'password' => 'prakash.joshi'
                );

                $this->Email->template = 'contactform';
                $this->Email->from = 'prakash.joshi@essindia.co.in';
                $this->Email->to = trim($this->request->data['ContactForm']['email']);
                $this->Email->cc = 'prakash.joshi@essindia.co.in';
                $this->Email->subject = $this->request->data['ContactForm']['subject'];
                $this->Email->sendAs = 'both';

                $this->Email->delivery = 'smtp';
                //$this->Email->send();
                try {
                    if ($this->Email->send()) {
                        // Success
                        $this->Session->setFlash('The contact Form has been submitted successfully.', 'default', array('class' => 'successmessage'));
                    } else {
                        $this->Session->setFlash('The contact Form could not be submitted. Please, check your email id and try again');

                        // Failure, without any exceptions
                    }
                } catch (Exception $e) {
                    $this->Session->setFlash('The contact Form could not be submitted. Please, check your email id and try again');
                }
                $this->redirect(array('action' => 'add'));
                //$this->set('smtp_errors', $this->Email->smtpError);
                //============EndEmail=============//

                $this->redirect(array('action' => 'add'));
            } else {
                $this->Session->setFlash(__('The Contact Form could not be saved. Please, try again.'));
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

    /**
     * delete method
     *
     * @throws NotFoundException
     * @throws MethodNotAllowedException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->ContactForm->id = $id;
        if (!$this->ContactForm->exists()) {
            throw new NotFoundException(__('Invalid contactForm'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->ContactForm->delete()) {
            $this->Session->setFlash(__('ContactForm deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('ContactForm was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

//    public function contactministry() {
//
//        if ($this->request->is('post')) {
//
//            $this->ContactMinistry->create();
//            if ($this->ContactMinistry->save($this->request->data)) {
//                $this->Session->setFlash('Contact Ministry has been saved');
//                $this->redirect(array('action' => 'contactministry'));
//            } else {
//                $this->Session->setFlash('oops! your form could not be saved');
//            }
//        }
//    }
//    public function contact(){
//        if($this->request->is('post')){
//            $this->ContactAuthority->create();
//            if($this->ContactAuthority->save($this->request->data)){
//                $this->Session->setFlash('Contact has been saved');
//                $this->redirect(array('action' => 'contact'));
//            }else{
//                $this->Session->setFlash('Contact could not be saved');
//            }
//        }
//    }

}
