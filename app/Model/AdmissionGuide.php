<?php
App::uses('AppModel', 'Model');
/**
 * AdmissionGuide Model
 *
 */
class AdmissionGuide extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'admission_guide';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'admission_guide' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Admission Guide should not empty ',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
}
