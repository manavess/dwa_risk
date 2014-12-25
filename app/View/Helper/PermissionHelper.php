<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * CakePHP PermissionHelper
 * @author prakash
 */
class PermissionHelper extends AppHelper {

    public $helpers = array('Session');

    public function __construct(View $View, $settings = array()) {
        parent::__construct($View, $settings);
    }

    public function ispermitted($controller, $action) {   
       
       $userId = $this->Session->read('Auth.User.id');       
        App::import("Model", "UserSubMenu");
        $UserSubMenu=new UserSubMenu();
        $userpemissions = $UserSubMenu->find('all', array('conditions' => array('user_id' => $userId)));
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
        //echo 'hello'.$status;
        return $status;
    }

}
