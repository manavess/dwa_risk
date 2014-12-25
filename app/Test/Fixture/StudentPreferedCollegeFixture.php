<?php
/**
 * StudentPreferedCollegeFixture
 *
 */
class StudentPreferedCollegeFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'student_registration_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'college_group_subject_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'created_by' => array('type' => 'integer', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified_by' => array('type' => 'integer', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_student_prefered_colleges_1_idx' => array('column' => 'student_registration_id', 'unique' => 0),
			'fk_student_prefered_colleges_2_idx' => array('column' => 'college_group_subject_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'student_registration_id' => 1,
			'college_group_subject_id' => 1,
			'created' => '2013-08-30 09:32:12',
			'created_by' => 1,
			'modified' => '2013-08-30 09:32:12',
			'modified_by' => 1
		),
	);

}
