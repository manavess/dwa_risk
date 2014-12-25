<?php

App::uses('AppModel', 'Model');

/**
 * StudentSecondarySchDetail Model
 *
 * @property StudentSecondarySchDetail $StudentSecondarySchDetail
 */
class StudentSecondarySchDetail extends AppModel {

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'name';
    public $validate = array(
        'marks' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Marks should not be empty',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Marks uploaded should be numeric',
            ),
        )
    );

    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'SecondarySchoolCertificate' => array(
            'className' => 'SecondarySchoolCertificate',
            'foreignKey' => 'secondary_certificate_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

}
