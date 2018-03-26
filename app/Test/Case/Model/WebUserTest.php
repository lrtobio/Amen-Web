<?php
App::uses('WebUser', 'Model');

/**
 * WebUser Test Case
 */
class WebUserTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.web_user',
		'app.webuser_profile'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->WebUser = ClassRegistry::init('WebUser');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->WebUser);

		parent::tearDown();
	}

}
