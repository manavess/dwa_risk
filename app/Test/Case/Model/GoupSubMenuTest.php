<?php
App::uses('GoupSubMenu', 'Model');

/**
 * GoupSubMenu Test Case
 *
 */
class GoupSubMenuTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.goup_sub_menu',
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
		$this->GoupSubMenu = ClassRegistry::init('GoupSubMenu');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->GoupSubMenu);

		parent::tearDown();
	}

}
