<?php
//ini_set('allow_call_time_pass_reference','Off');
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $actsAs = array('Containable');
    
    public $components = array(
        'Acl',
        'Auth',
        'Session',
        'Cookie'

    );
    public $helpers = array('Html', 'Form', 'Session');

    public function beforeFilter() {
        $this->Cookie->key = 'qSI232qs*&sXOw!adre@34SAv!@*(XSL#$%)asGb$@11~_+!@#HKis~#^';
        $this->Cookie->httpOnly = true;

        if (!$this->Auth->loggedIn() && $this->Cookie->read('remember_me_cookie')) {
            $cookie = $this->Cookie->read('remember_me_cookie');

            $user = $this->User->find('first', array(
                'conditions' => array(
                    'User.username' => $cookie['username'],
                    'User.password' => $cookie['password']
                )
            ));
            if ($user && !$this->Auth->login($user)) {
                $this->redirect('/users/logout'); // destroy session & cookie
            }
        }

        $this->set('loggedIn', $this->Auth->loggedIn());
        $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
        $this->Auth->logoutRedirect = array('controller' => 'users', 'action' => 'login');

        switch ($this->Session->read('Auth.User.group_id')) {
            case '1':
                $this->Auth->loginRedirect = array('controller' => 'colleges', 'action' => 'add');
                break;
            case '2':
                $this->Auth->loginRedirect = array('controller' => 'users', 'action' => 'index');
                break;
            case '3':
                $this->Auth->loginRedirect = array('controller' => 'users', 'action' => 'add');
                break;
            default:
                break;
        }
    }

    public function checkpagepermission() {
        $userId = $this->Session->read('Auth.User.id');
        $controller = $this->name;
        $this->loadModel("UserSubMenu");
        $userpemissions = $this->UserSubMenu->find('all', array('conditions' => array('user_id' => $userId)));
        $status = false;
        foreach ($userpemissions as $userpemission) {
            if (!empty($userpemission)) {
                if (empty($userpemission['Menu']['url'])) {
                    if ($userpemission['SubMenu']['url'] == $controller) {
                        $status = true;
                        break;
                    } else {
                        $status = false;
                    }
                } else {
                    if ($userpemission['Menu']['url'] == $controller) {
                        $status = true;
                        break;
                    } else {
                        $status = false;
                    }
                }
            } else {
                $status = false;
            }
        }
        if (!$status)
            $this->redirect("/Errors/error404/");
        else
            return $status;
    }

    public function checkactionpermission() {
        $userId = $this->Session->read('Auth.User.id');
        $action = $this->action;
        $controller = $this->name;
        $this->loadModel("UserSubMenu");
        $userpemissions = $this->UserSubMenu->find('all', array('conditions' => array('user_id' => $userId)));
        $status = false;
        foreach ($userpemissions as $userpemission) {
            if (!empty($userpemission)) {
                if (empty($userpemission['Menu']['url'])) {
                    if ($userpemission['SubMenu']['url'] == $controller) {
                        if (!empty($userpemission['MenuAction'])) {
                            if ($userpemission['MenuAction']['action'] == $action) {
                                $status = true;
                                break;
                            } else {
                                $status = false;
                            }
                        } else {
                            $status = true;
                            break;
                        }
                    } else {
                        $status = false;
                    }
                } else {
                    if ($userpemission['Menu']['url'] == $controller) {
                        $status = true;
                        break;
                    } else {
                        $status = false;
                    }
                }
            } else {
                $status = false;
            }
        }
        if (!$status)
            $this->redirect("/Errors/error404/");
        else
            return $status;
    }

    public function isvalidaction($controller, $action) {
        $userId = $this->Session->read('Auth.User.id');
        $this->loadModel("UserSubMenu");
        $userpemissions = $this->UserSubMenu->find('all', array('conditions' => array('user_id' => $userId)));
        $status = false;
        foreach ($userpemissions as $userpemission) {
            if (!empty($userpemission)) {
                if (empty($userpemission['Menu']['url'])) {
                    if ($userpemission['SubMenu']['url'] == $controller) {
                        if (!empty($userpemission['MenuAction'])) {
                            if ($userpemission['MenuAction']['action'] == $action) {
                                $status = true;
                                break;
                            } else {
                                $status = false;
                            }
                        } else {
                            $status = true;
                            break;
                        }
                    } else {
                        $status = false;
                    }
                } else {
                    if ($userpemission['Menu']['url'] == $controller) {
                        $status = true;
                        break;
                    } else {
                        $status = false;
                    }
                }
            } else {
                $status = false;
            }
        }
        return $status;
    }

}
