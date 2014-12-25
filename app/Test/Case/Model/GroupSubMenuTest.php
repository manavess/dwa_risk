<?php
App::uses('GroupSubMenu', 'Model');

/**
 * GroupSubMenu Test Case
 *
 */
class GroupSubMenuTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.group_sub_menu',
		'app.group',
		'app.sub_menu',
		'app.menu',
		'app.goup_sub_menu'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->GroupSubMenu = ClassRegistry::init('GroupSubMenu');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->GroupSubMenu);

		parent::tearDown();
	}

}
