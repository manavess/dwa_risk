<?php
/**
 * StudentAlotmentFixture
 *
 */
class StudentAlotmentFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'student_registration_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'college_group_subject_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'grade' => array('type' => 'integer', 'null' => false, 'default' => null),
		'allocation_year' => array('type' => 'text', 'null' => false, 'default' => null, 'length' => 4),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'index4' => array('column' => array('student_registration_id', 'college_group_subject_id', 'allocation_year'), 'unique' => 1),
			'fk_student_alotments_2_idx' => array('column' => 'college_group_subject_id', 'unique' => 0),
			'fk_student_alotments_1_idx' => array('column' => 'student_registration_id', 'unique' => 0)
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
			'grade' => 1,
			'allocation_year' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'created' => '2013-08-31 05:57:11'
		),
	);

}
