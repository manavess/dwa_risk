<?php
App::uses('StudentPreferedCollege', 'Model');

/**
 * StudentPreferedCollege Test Case
 *
 */
class StudentPreferedCollegeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.student_prefered_college',
		'app.student_registration',
		'app.course',
		'app.religion',
		'app.city',
		'app.state',
		'app.country',
		'app.college',
		'app.university',
		'app.college_group_subject',
		'app.group_subjects',
		'app.group_subject',
		'app.employee',
		'app.student_alotment',
		'app.mature_student',
		'app.student_subjects',
		'app.student_prefered_colleges'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->StudentPreferedCollege = ClassRegistry::init('StudentPreferedCollege');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->StudentPreferedCollege);

		parent::tearDown();
	}

}
