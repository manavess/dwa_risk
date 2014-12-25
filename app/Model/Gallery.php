<?php

App::uses('AppModel', 'Model');

/**
 * Gallery Model
 *
 * @property StudentRegistration $StudentRegistration
 */
class Gallery extends AppModel {

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'name' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Image should not be empty'
            
            )
        ),
    );

    
}
