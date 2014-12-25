<?php
App::uses('AppModel', 'Model');
/**
 * Employee Model
 *
 */
class Employee extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'code' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Employee code should not be empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
                    'alphaNumeric' => array(
				'rule' => array('alphaNumeric'),
				'message' => 'Employee code should be alphanumeric characters',
			),
                    'isUnique' => array(
				'rule' => 'isUnique',
				'message' => 'This Employee code already exist'
				)
		),
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Employee name should not be empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
                 'alpha'=>array(
                               'rule' => '/^[^%#\/*@!+-=;:&,012456789]+$/',
                               'message' => 'Employee name should be characters.',
                         )
  
		),
		'date_of_joining' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
               'date_of_joining' => array(
                   'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Date Of Joining should not be empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
                       'startBeforeEnd' => array(
                                 'rule' => array('startBeforeEnd', 'date_of_confirm_joining' ),
                                 'message' => 'The date of joinng must be before the date of confirm joining.'),
                       'futureDate' => array(
                                 'rule' => array('futureDate', 'date_of_joining'),
                                 'message' => 'The date of joinng can not be greater than today date.'),
                ),
		'date_of_confirm_joining' => array(
                    'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Employee name should not be empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
                'date_of_confirm_joining' => array(
                    'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Date Of Confirm Joining should not be empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
                       'startBeforeEnd' => array(
                                 'rule' => array('startBeforeEnd', 'date_of_resignation' ),
                                 'message' => 'The date of confirm joinng must be before the date of resignation.'),
                       'futureDate' => array(
                                 'rule' => array('futureDate', 'date_of_confirm_joining'),
                                 'message' => 'The date of confirm joinng can not be greater than today date.'),
                ),
		'experiance' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Experience should be in number',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
               'date_of_resignation' => array(
                   'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Date Of Resignation should not be empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
                        'futureDate' => array(
                                 'rule' => array('futureDate', 'date_of_resignation'),
                                 'message' => 'The date of resignation can not be greater than today date.'),
                ),
                
              
	);
        
       function startBeforeEnd( $field=array(), $compare_field=null ) {
             foreach( $field as $key => $value ){
                  /*  $v1 = $value;
                    $v2 = $this->data[$this->name][ $compare_field ];*/
                   $v1 = strtotime($value);
                   $v2 = strtotime($this->data[$this->name][ $compare_field ]);
                   if($v1 >= $v2) {
                        return FALSE;
                    } else {
                        continue;
                    }
             }
             return TRUE;
       }
       
       function futureDate($data, $field){
             if (strtotime($data[$field]) > time()){
                return FALSE;
             }
                return TRUE;
       } 

}
