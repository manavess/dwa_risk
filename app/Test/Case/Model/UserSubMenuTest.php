<?php
App::uses('UserSubMenu', 'Model');

/**
 * UserSubMenu Test Case
 *
 */
class UserSubMenuTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.user_sub_menu',
		'app.user',
		'app.group',
		'app.sub_menu',
		'app.menu'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->UserSubMenu = ClassRegistry::init('UserSubMenu');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->UserSubMenu);

		parent::tearDown();
	}

}
