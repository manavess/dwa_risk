<?php

App::uses('AppModel', 'Model');

/**
 * StudentRegistration Model
 *
 * @property Course $Course
 * @property Religion $Religion
 * @property City $City
 * @property State $State
 * @property Country $Country
 * @property GroupSubject $GroupSubject
 * @property Employee $Employee
 * @property MatureStudent $MatureStudent
 */
class StudentRegistration extends AppModel {

    public $displayField = 'applicant_name';

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'course_id' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Course should not be empty',
            ),
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Course should be numeric',
            ),
        ),
        'applicant_name' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Applicant name should not be empty',
                'allowEmpty' => false,
            ),
            'alpha' => array(
                'rule' => '/^[^%#\/*@+-=;".:&,012456789]+$/',
                'message' => 'Applicant name should be characters.'
            ),
            'maxLength' => array(
                'rule' => array('maxLength', 100),
                'message' => 'Applicant name should not exceed 100 characters'
            ),
        ),
        'religion_id' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Religion should not be empty',
            ),
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Religion ID should be numeric',
            ),
        ),
        'Address1' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Address should not be empty',
            ),
            'maxLength' => array(
                'rule' => array('maxLength', 100),
                'message' => 'Address should not exceed 100 characters'
            )
        ),
        'Address2' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Address should not be empty',
                'allowEmpty' => true,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'maxLength' => array(
                'rule' => array('maxLength', 100),
                'message' => 'Address should not exceed 100 characters'
            )
        ),
        'Address3' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Address should not be empty',
                'allowEmpty' => true,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'maxLength' => array(
                'rule' => array('maxLength', 100),
                'message' => 'Address should not exceed 100 characters'
            )
        ),
        'city_id' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'City should not be empty',
            ),
        ),
        'state_id' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'State should not be empty',
            ),
        ),
        'country_id' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Country should not be empty',
            ),
        ),
        'date_of_birth' => array(
            'date' => array(
                'rule' => array('date', 'd-m-Y'),
                'message' => 'DOB should not be empty',
            ),
        ),
        'date_of_birth' => array(
            'futureDate' => array(
                'rule' => array('futureDate', 'date_of_birth'),
                'message' => 'The date of birth can not be greater than today date.'),
        ),
        'type_of_certificate' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Type of certificate should not be empty',
            ),
            'alpha' => array(
                'rule' => '/^[^%#\/*@!+-=;.:&,012456789]+$/',
                'message' => 'Type of certificate should be characters.'
            ),
        ),
        'place_of_birth' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Place of birth should not be empty',
            ),
        ),
        'certificate_index' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Certificate index number should not be empty',
                'allowEmpty' => false,
            ),
//				'alphaNumeric' =>array(
//                                 'rule'=>array('alphaNumeric'),  
//                                 'message' => 'Certificate Index number should be Alphabets and numbers only',
//				 'allowEmpty' => false,
//                       ),
        ),
        'admission_type' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Admission type should not be empty',
                'allowEmpty' => false,
            ),
        ),
        'date_of_certificate' => array(
            'futureDate' => array(
                'rule' => array('futureDate', 'date_of_certificate'),
                'message' => 'Certificate date can not be greater than today date.'),
        //'currentYearDate'=>array(
        //'rule'=>array('currentYearDate','date_of_certificate'),
        //'message' => 'Date of certificate must be of the current year'),
//				       'currentYearDate' => array(
//							'rule'=>array('currentYearDate','date_of_certificate','admission_type','date_of_birth'),
//							'message' => 'In Normal admission student certificate date should be of current year and in Private admission it should be a date after date of birth and before today.',
//							'allowEmpty' => false,
//			
//						),
        ),
        'school_type' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'School type should not be empty',
                'allowEmpty' => false,
            ),
        ),
        'secondary_school_name' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'School name should not be empty',
                'allowEmpty' => false,
            ),
            'alpha' => array(
                'rule' => '/^[a-zA-Z][a-zA-Z.]+/',
                'message' => 'School name should be characters.'
            ),
        ),
        'nationality' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Nationality should not be empty',
                'allowEmpty' => false,
            ),
        ),
        'nationality_number' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Nationality number should not be empty',
                'allowEmpty' => false,
            ),
            'alphaNumeric' => array(
                'rule' => array('alphaNumeric'),
                'message' => 'Nationality number should be Alphabets and numbers only',
                'allowEmpty' => false,
            ),
            'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'This nationality number already exist'
            ),
        ),
        'nationality_issue_date' => array(
            'date' => array(
                'rule' => array('date'),
                'message' => 'Nationality date should not be empty',
                'allowEmpty' => false,
            ),
        ),
        'nationality_issue_date' => array(
            'startBeforeEnd' => array(
                'rule' => array('startBeforeEnd', 'date_of_birth'),
                'message' => 'The nationality issue date must be after the date of birth.'
            ),
            'futureDate' => array(
                'rule' => array('futureDate', 'nationality_issue_date'),
                'message' => 'The nationality issue date can not be greater than today date.'
            ),
        ),
        'guardian_name' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Guardian name should not be empty',
                'allowEmpty' => false,
            ),
            'alpha' => array(
                'rule' => '/^[^%#\/*@!+-=;.:&,012456789]+$/',
                'message' => 'School name should be characters.'
            ),
        ),
        'guardian_occupation' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Guardian occupation should not be empty',
                'allowEmpty' => false,
            ),
            'alpha' => array(
                'rule' => '/^[^%#\/*@!+-=;.:&,012456789]+$/',
                'message' => 'School name should be characters.'
            ),
        ),
        'guardian_nationality_number' => array(
//            'notempty' => array(
//                'rule' => array('notempty'),
//                'message' => 'Guardian nationality number should not be empty',
//            ),
            'alphaNumeric' => array(
                'rule' => array('alphaNumeric'),
                'message' => 'Guardian Nationality number should be Alphabets and numbers only',
                'allowEmpty' => true,
            ),
            'match' => array(
                'rule' => array('match', 'nationality_number'),
                'message' => 'Nationality number and guardian nationality number cannot be same',
            ),
        ),
        'guardian_nationality_issue_date' => array(
            'date' => array(
                'rule' => array('date'),
                'message' => 'Guardian nationality issue date should not be empty',
                'allowEmpty' => true,
            ),
        ),
        'guardian_nationality_issue_date' => array(
//                'startAfterEnd' => array(
//                        'rule' => array('startAfterEnd', 'nationality_issue_date'),
//                        'message' => 'The Guardian nationality issue date must be before student nationality issue date .'
//                ),
            'futureDate' => array(
                'rule' => array('futureDate', 'guardian_nationality_issue_date'),
                'message' => 'Guardian nationality issue date can not be greater than today date.',
                'allowEmpty' => true,
            ),
        ),
        'stream' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Stream should not be empty',
            ),
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Please select any of the stream',
                'allowEmpty' => false,
            ),
        ),
        'passport_number' => array(
            'isUnique' => array(
                'rule' => 'isUnique',
                'allowEmpty' => true,
                'message' => 'This Passport number already exist',
            ),
        ),
        'passport_issue_date' => array(
            'startBeforeEnd' => array(
                'rule' => array('startBeforeEnd', 'date_of_birth'),
                'message' => 'The Passport issue date must be after the date of birth.',
                'allowEmpty' => true,
            ),
        ),
        'passport_issue_date' => array(
            'futureDate' => array(
                'rule' => array('futureDate', 'passport_issue_date'),
                'message' => 'The Passport issue date can not be greater than today date.',
                'allowEmpty' => true,
            ),
        ),
    );

    //The Associations below have been created with all possible keys, those that are not needed can be removed

    function startBeforeEnd($field = array(), $compare_field = null) {
        foreach ($field as $key => $value) {
            /*  $v1 = $value;
              $v2 = $this->data[$this->name][ $compare_field ]; */
            $date1 = strtotime($value);
            $date2 = strtotime($this->data[$this->name][$compare_field]);
            if ($date1 < $date2) {
                return FALSE;
            } else {
                continue;
            }
        }
        return TRUE;
    }

    function futureDate($data, $field) {
        if (strtotime($data[$field]) > time()) {
            return FALSE;
        }
        return TRUE;
    }

    /* last year */

    function currentYearDate($field = array(), $comparefield = null, $admissiontype, $dob) {


        if (!empty($this->data[$this->name][$admissiontype])) {
            $admissiontype = $this->data[$this->name][$admissiontype];
        } else {

            $admissiontype = 'N';
        }

        $dateofcerticate = date('Y-m-d', strtotime($this->data[$this->name][$comparefield]));
        $dob = date('Y-m-d', strtotime($this->data[$this->name][$dob]));

        $year = date('Y', strtotime($this->data[$this->name][$comparefield]));

        if ($admissiontype == 'P' && $dateofcerticate > $dob) {

            return TRUE;
        } else if ($admissiontype == 'N' && $year == date('Y')) {
            return TRUE;
        } else if ($admissiontype == 'N' && $year == date('Y') - 1) {
            /* Normal Admission can be done only for the student passed in the current year or in the last year. 
             * If the student has passed before the last year then they will be provided admission as private student */
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function startAfterEnd($field = array(), $compare_field = null) {
        foreach ($field as $key => $value) {
            /*  $v1 = $value;
              $v2 = $this->data[$this->name][ $compare_field ]; */
            $date1 = strtotime($value);
            $date2 = strtotime($this->data[$this->name][$compare_field]);
            if ($date1 > $date2) {
                return FALSE;
            } else {
                continue;
            }
        }
        return TRUE;
    }

    function match($check, $with) {
        // Getting the keys of the parent field
        foreach ($check as $k => $v) {
            $$k = $v;
        }

        // Removing blank fields
        $check = trim($$k);
        $with = trim($this->data[$this->name][$with]);

        // If both arent empty we compare and return true or false
        if (!empty($check) && !empty($with)) {
            return $check != $with;
        }

        // Return false, some fields is empty
        return false;
    }

    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Course' => array(
            'className' => 'Course',
            'foreignKey' => 'course_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Religion' => array(
            'className' => 'Religion',
            'foreignKey' => 'religion_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'City' => array(
            'className' => 'City',
            'foreignKey' => 'city_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'State' => array(
            'className' => 'State',
            'foreignKey' => 'state_id',
            'conditions' => '',
            'fields' => array('id', 'name'),
            'order' => ''
        ),
        'Country' => array(
            'className' => 'Country',
            'foreignKey' => 'country_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'GroupSubject' => array(
            'className' => 'GroupSubject',
            'foreignKey' => 'group_subject_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Employee' => array(
            'className' => 'Employee',
            'foreignKey' => 'employee_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'MatureStudent' => array(
            'className' => 'MatureStudent',
            'foreignKey' => 'student_registration_id',
            'dependent' => false
        ),
        'StudentSubjects' => array(
            'className' => 'StudentSubjects',
            'foreignKey' => 'student_registration_id',
            'dependent' => false
        ),
        'StudentPreferedColleges' => array(
            'className' => 'StudentPreferedColleges',
            'foreignKey' => 'student_registration_id',
            'dependent' => false
        ),
        'AdmissionCancellation' => array(
            'className' => 'AdmissionCancellation',
            'foreignKey' => 'student_registration_id',
            'dependent' => false
        ),
        'UpgradedStudent' => array(
            'className' => 'UpgradedStudent',
            'foreignKey' => 'student_registration_id',
            'dependent' => false
        ),
        'StudentAlotment' => array(
            'className' => 'StudentAlotment',
            'foreignKey' => 'student_registration_id',
            'dependent' => false
        ),
        'StudentPreferedColleges' => array(
            'className' => 'StudentPreferedColleges',
            'foreignKey' => 'student_registration_id',
            'dependent' => false
        ),
    );

}
