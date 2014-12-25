<?php
App::uses('AppModel', 'Model');
/**
 * Gradepoint Model
 *
 */
class Gradepoint extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'gradepoints' => array(
			'notempty' => array(
				'rule' => array('notempty')				
			),
                    'checkgrades'=>array(
                               'rule' => array('checkgrades','gradepoints'), 
                               'message' => 'Enter grade (A, A+, A- to E) or points(1-9). Please select Marking Type properly from the below dropdown for the Gradepoints value'
                         ),
		),
		'lowerlimit' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				
			),
                        'numeric' => array(
				'rule' => array('numeric'),
				
			),
		),
                'higherlimit' => array(
                       'numeric' => array(
				'rule' => array('numeric'),
				
			),
                       'checklimit' => array(
                           'rule' => array('checklimit', 'higherlimit', 'lowerlimit'),
                           'message' => 'Higher limit cannot be less than lower limit.',
                           'allowEmpty' => false,
                       )
                   ),
		'remarks' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'created_by' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'modified_by' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
        
        public function checkgrades($fields = array(),$grades){
            $gradespoints = array('1','2','3','4','5','6','7','8','9','A','B','C','D','E','A+','B+','C+','D+','E+','A-','B-','C-','D-','E');
            
            $g = array('A','B','C','D','E','A+','B+','C+','D+','E+','A-','B-','C-','D-','E');
            $p = array('1','2','3','4','5','6','7','8','9');
            
            if(in_array($fields['gradepoints'],$gradespoints)){
                if($this->data['Gradepoint']['markingtype']=='grades'){
                    if(!in_array($fields['gradepoints'],$g)){
                        return false;
                    }else{
                        return true;
                    }
                }else if($this->data['Gradepoint']['markingtype']=='points'){
                    
                    if(!in_array($fields['gradepoints'],$p)){
                        return false;
                    }else{
                        return true;
                    }
                }
                return true;
            }else{
                return false;
            }
            //return false;
            //if(in_array($gradespoints, $haystack))
        }
        
        public function checklimit($field=array(),$higherlimit = null,$lowerlimit){
            
            if($this->data['Gradepoint']['higherlimit']!='' && $this->data['Gradepoint']['lowerlimit']!='' ){
                if($this->data['Gradepoint']['higherlimit']>$this->data['Gradepoint']['lowerlimit']){
                    return true;
                }else{
                    return false;
                }
            }
        }
        
        public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'created_by',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
            'User' => array(
			'className' => 'User',
			'foreignKey' => 'modified_by',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
        
        
}
