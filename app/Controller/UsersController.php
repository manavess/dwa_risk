<?php

App::uses('AppController', 'Controller');

/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

    var $uses = array('User', 'Aros');
    var $components = array("Email", 'Session', 'Cookie');
    var $helpers = array("Html", "Form", "Session");

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login', 'logout', 'reset', 'forgotpassword', 'student_login');
        $group_id = $this->Session->read('Auth.User.group_id');
        if (isset($group_id) && $this->action == 'login')
            $this->deshboard($this->Session->read('Auth.User.group_id'));
    }

    public function login() {
        if ($this->request->is('post')) {

            $data = $this->User->find('first', array('fields' => array('active', 'username', 'password'),
                'conditions' => array(
                    'User.username' => $this->request->data['User']['username'], 
                    'User.password' => $this->Auth->password($this->request->data['User']['password']))));


            if (!empty($data) && $data['User']['active'] == 'Y') {

                if ($this->Auth->login()) {
                    if ($this->request->data['User']['remember_me'] == 1) {
                        // remove "remember me checkbox"
                        unset($this->request->data['User']['remember_me']);

                        // hash the user's password
                        $this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['password']);
                        // write the cookie
                        $this->Cookie->write('remember_me_cookie', $this->request->data['User'], true, '2 weeks');
                    }
                    $this->redirect("/");
                    //$this->redirect($this->Auth->redirect());
                } else {
                    $this->redirect(array('action' => 'login'));

                    $this->Session->setFlash('Your username or password is incorrect.');
                }
            } else if (!empty($data) && $data['User']['active'] == 'N') {
                $this->Session->setFlash('Your Account has been disabled by Administrator. Please contact to Ministry.');
            } else {

                $this->Session->setFlash('Your username or password is incorrect.');
            }
        }
    }

    public function logout() {
        $this->Cookie->delete('remember_me_cookie');
        $this->redirect($this->Auth->logout());
    }

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
        $userData = $this->User->find('first', $options);
        $this->loadModel('User');
        $createUserId = $userData['User']['created_by'];
        $createUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $createUserId)));
        $modifyUserId = $userData['User']['modified_by'];
        $userData['User']['created'] = date("d-m-Y", strtotime($userData['User']['created']));
        $userData['User']['modified'] = date("d-m-Y", strtotime($userData['User']['modified']));
        $modifyUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $modifyUserId)));
        $this->set('user', $userData);
        $this->set('createuser', $createUserData['User']['username']);
        $this->set('modifyuser', $modifyUserData['User']['username']);
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        $this->set('groups', $this->User->Group->find('list'));
        if ($this->request->is('post')) {
            $userid = $this->Session->read('Auth.User.id');
            $this->request->data['User']['created_by'] = $userid;
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash('The user has been saved', 'default', array('class' => 'successmessage'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
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
        $this->set('groups', $this->User->Group->find('list'));
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $userid = $this->Session->read('Auth.User.id');
            $this->request->data['User']['modified_by'] = $userid;
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash('The user has been saved', 'default', array('class' => 'successmessage'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
            $this->request->data = $this->User->find('first', $options);
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
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $admin = $this->User->find('first', array('fields' => array('id'), 'conditions' => array('User.id' => 1)));



        if ($id == $this->Session->read('Auth.User.id') || $admin['User']['id'] == $id) {

            $this->Session->setFlash("Logged User and Admin can't be deleted");
            $this->redirect(array('action' => 'index'));
        } else {
            $this->request->onlyAllow('post', 'delete');
            if ($this->User->delete()) {
                $this->Session->setFlash('User deleted', 'default', array('class' => 'successmessage'));
                $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash('User was not deleted', 'default', array('class' => 'successmessage'));
            $this->redirect(array('action' => 'index'));
        }
    }

    public function forgotpassword() {
        $this->User->recursive = -1;
        if (!empty($this->data)) {
            if (empty($this->data['User']['email'])) {

                $this->Session->setFlash('Email ID should not be empty');
            } else {
                $email = $this->data['User']['email'];
                $fu = $this->User->find('first', array('conditions' => array('User.email' => $email)));
                if ($fu) {
                    //debug($fu);
                    if ($fu['User']['active'] == 'Y') {
                        $key = Security::hash(String::uuid(), 'sha512', true);
                        $hash = sha1($fu['User']['username'] . rand(0, 100));
                        $url = Router::url(array('controller' => 'users', 'action' => 'reset'), true) . '/' . $key . '#' . $hash;
                        $ms = $url;
                        $ms = wordwrap($ms, 1000);
                        //debug($url);
                        $fu['User']['tokenhash'] = $key;
                        $this->User->id = $fu['User']['id'];
                        $this->Session->setFlash(__('<span class="IL_AD" id="IL_AD8">Check Your</span> Email To <span class="IL_AD" id="IL_AD1">Reset your password</span>', true));
                        if ($this->User->saveField('tokenhash', $fu['User']['tokenhash'])) {

                            //============Email================//
                            /* SMTP Options */
                            $this->Email->smtpOptions = array(
                                'port' => '25',
                                'timeout' => '30',
                                'host' => 'smtp.essindia.com',
                                'username' => 'manav.pandey@essindia.com',
                                'password' => 'Manav.pandey24'
                            );
                            $this->Email->template = 'resetpw';
                            $this->Email->from = 'manav.pandey@essindia.com';
                            $this->Email->to = $fu['User']['username'] . '<' . $fu['User']['email'] . '>';
                            $this->Email->subject = 'Reset Your Password';
                            $this->Email->sendAs = 'both';

                            $this->Email->delivery = 'smtp';
                            $this->set('ms', $ms);
                            // $this->Email->send($ms);

                            try {
                                if ($this->Email->send($ms)) {
                                    // Success
                                    $this->Session->setFlash(__('<span class="IL_AD" id="IL_AD8">Check Your</span> Email To <span class="IL_AD" id="IL_AD1">Reset your password</span>', true));
                                } else {
                                    $this->Session->setFlash(__('<span class="IL_AD" id="IL_AD8">Check Your</span> Email and <span class="IL_AD" id="IL_AD1">try again</span>', true));
                                }
                            } catch (Exception $e) {
                                $this->Session->setFlash(__('<span class="IL_AD" id="IL_AD8">Check Your</span> Email and <span class="IL_AD" id="IL_AD1">try again</span>', true));
                            }

                            //$this->set('smtp_errors', $this->Email->smtpError);
                            //============EndEmail=============//
                        } else {
                            $this->Session->setFlash("Error Generating Reset link");
                        }
                    } else {
                        $this->Session->setFlash('This Account is not Active yet.Check Your mail to activate it');
                    }
                } else {
                    $this->Session->setFlash('Email ID does Not <span class="IL_AD" id="IL_AD11">Exist</span>');
                }
            }
        }
    }

    function reset($token = null) {
        //$this->layout="Login";
        $this->User->recursive = -1;
        if (!empty($token)) {
            $u = $this->User->findBytokenhash($token);
            if ($u) {
                $this->User->id = $u['User']['id'];

                if (!empty($this->data)) {
                    $this->User->set($this->request->data);


                    $this->User->data = $this->data;
                    $this->User->data['User']['username'] = $u['User']['username'];
                    $new_hash = sha1($u['User']['username'] . rand(0, 100)); //created token
                    $this->User->data['User']['tokenhash'] = $new_hash;


                    if (!empty($this->data['User']['password']) && strlen(trim($this->data['User']['password'])) > 5) {
                        if ($this->User->check(array('fieldList' => array('password', 'password_confirm')))) {

                            if ($this->User->save($this->User->data)) {
                                $this->Session->setFlash('Password Has been Updated', 'default', array('class' => 'successmessage'));
                                $this->redirect(array('controller' => 'users', 'action' => 'login'));
                            }
                        } else {
                            $this->Session->setFlash('New password and confirm password did not match. Please try again');
                        }
                    } else {
                        $this->Session->setFlash('Password must be 6 to 10 characters long');
                    }

                    //else {
                    //  $this->set('errors', $this->User->invalidFields());
                    //}
                }
            } else {
                $this->Session->setFlash('Token Corrupted,Please Retry.the reset link work only for once.');
            }
        } else {
            $this->redirect('/');
        }
    }

    public function initDB() {
        $group = $this->User->Group;
        //Allow admins to everything
        $group->id = 1;
        $this->Acl->allow($group, 'controllers');

        //allow managers to posts and widgets
        $group->id = 2;
        $this->Acl->deny($group, 'controllers');
        $this->Acl->allow($group, 'controllers/Posts');
        $this->Acl->allow($group, 'controllers/Widgets');

        //allow users to only add and edit on posts and widgets
        $group->id = 3;
        $this->Acl->deny($group, 'controllers');
        $this->Acl->allow($group, 'controllers/Posts/add');
        $this->Acl->allow($group, 'controllers/Posts/edit');
        $this->Acl->allow($group, 'controllers/Widgets/add');
        $this->Acl->allow($group, 'controllers/Widgets/edit');
        //we add an exit to avoid an ugly "missing views" error message
        echo "all done";
        exit;
    }

    public function deshboard($groupId) {
        switch ($groupId) {
            case '1':
                $this->render('admindeshboard');
                break;
            case '2':
                $this->render('ministrydeshboard');
                break;
            case '3':
        }
    }

    public function pass() {
        if ($this->Auth->user('id')) {   // Just to  make sure User is logged
            $this->User->id = $this->Auth->user('id');  // Set User Id 

            $usersdata = $this->User->read('', $this->User->id);
            $this->set('userdata', $usersdata);

            if (!$this->User->exists()) {
                throw new NotFoundException(__('Invalid user'));
            }



            if ($this->request->is('post')) {
                if (isset($this->request->data['Reset'])) {
                    $this->redirect("/Users/pass");
                }
                $userdata = '';
                $currentpass = '';
                $currentpassdata = '';
                $userdata = $this->User->find('first', array('conditions' => array('User.id' => $this->User->id)));

                $currentpass = AuthComponent::password($this->data['User']['current_password']);

                $currentpassdata = $userdata['User']['password'];
                if ($currentpassdata == $currentpass) {

                    $this->User->data = $this->data;
                    if (!empty($this->data['User']['password']) && !empty($this->data['User']['password_confirm'])) {

                        if ($this->User->check(array('fieldList' => array('password', 'password_confirm')))) {
                            $changedpass = AuthComponent::password($this->data['User']['password']);

                            $updatePassword = array('password' => "'$changedpass'");


                            if ($this->User->updateAll($updatePassword, array('User.id' => $this->Auth->user('id')))) {
                                $this->Session->setFlash('Password has been changed', 'default', array('class' => 'successmessage'));
                                $this->redirect(array('controller' => 'users', 'action' => 'login'));
                            } else {
                                $this->Session->setFlash('Password could not be changed.');
                            }
                        } else {
                            $this->Session->setFlash('New password and confirm password did not match. Please try again');
                        }
                    } else {
                        $this->Session->setFlash('Please enter both new password and confirm password properly');
                    }
                } else {
                    $this->Session->setFlash('Old password is not correct.');
                }
            } else {
//                $this->data = $this->User->findById($this->Auth->user('id'));
            }
        }
    }

}
