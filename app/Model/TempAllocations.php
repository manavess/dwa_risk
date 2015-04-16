<?php

App::uses('AppModel', 'Model');

class TempAllocations extends AppModel {

    
    public $belongsTo = array(
		'StudentRegistration' => array(
			'className' => 'StudentRegistration',
			'foreignKey' => 'student_registration_id',
		),
        );
                
    
    

}
