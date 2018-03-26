<?php
App::uses('Country', 'Model');

/**
 * Country Test Case
 */
class CountryTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.country',
		'app.church',
		'app.mobile_user',
		'app.mobileuser_profile',
		'app.conversation',
		'app.message',
		'app.schedule',
		'app.schedule_type',
		'app.city'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Country = ClassRegistry::init('Country');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Country);

		parent::tearDown();
	}

}
