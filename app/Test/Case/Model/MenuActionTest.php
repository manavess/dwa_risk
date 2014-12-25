<?php
App::uses('MenuAction', 'Model');

/**
 * MenuAction Test Case
 *
 */
class MenuActionTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.menu_action',
		'app.sub_menu',
		'app.menu',
		'app.group_sub_menu',
		'app.group',
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->MenuAction = ClassRegistry::init('MenuAction');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->MenuAction);

		parent::tearDown();
	}

}
