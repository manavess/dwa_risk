<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class User extends AppModel {

    // other code.
    public $belongsTo = array('Group');
    public $actsAs = array('Acl' => array('type' => 'requester'));
    public $displayField = 'username';
    var $validate = array(
        'username' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Username should not be empty',
            ),
            'allowedCharacters' => array(
                'rule' => '/^[a-zA-Z]+[0-9]*$/',
                'message' => 'Please enter a valid username'
            ),
            'minLength' => array(
                'rule' => array('minLength', 5),
                'message' => 'Please enter a longer Username'
            ),
            'maxLength' => array(
                'rule' => array('maxLength', 15),
                'message' => 'Please enter a shorter username'
            ),
            'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'This Username is already in use'
            ),
        ),
        'password' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Password should not be empty',
                
            ),
           
            'minLength' => array(
                'rule' => array('minLength', 5),
                'message' => 'Password should be between(5 to 10)characters'
            ),
            'maxLength' => array(
                'rule' => array('maxLength', 10),
                'message' => 'Password should be between(5 to 10)characters'
            ),
           
           
        ),
        
        
        'email' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Email Address should not be empty',
            ),
            'email' => array(
                'rule' => array('email'),
                'message' => 'Please enter a valid email ID',
            ),
        ),
        'group_id' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Select Group Name',
            ),
            ),
    );

    public function parentNode() {
        if (!$this->id && empty($this->data)) {
            return null;
        }
        if (isset($this->data['User']['group_id'])) {
            $groupId = $this->data['User']['group_id'];
        } else {
            $groupId = $this->field('group_id');
        }
        if (!$groupId) {
            return null;
        } else {
            return array('Group' => array('id' => $groupId));
        }
    }

    public function beforeSave($options = array()) {
        if (isset($this->data['User']['password'])) {
            $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
            return true;
        }
    }

    public function bindNode($user) {
        return array('model' => 'Group', 'foreign_key' => $user['User']['group_id']);
    }

    public function check($options = array()) {
    
    
        if (isset($this->data['User']['password_confirm'])) {
        
            if ($this->data['User']['password'] != $this->data['User']['password_confirm']) {
            
            	
              //  echo $this->invalidate('password2', "The passwords don't match.");
                return false;
            } else {
           
                return true;
            }
        } else {
            return true;
        }
    }

}

?>
