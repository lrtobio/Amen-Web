<?php
App::uses('MobileUser', 'Model');

/**
 * MobileUser Test Case
 */
class MobileUserTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.mobile_user',
		'app.mobileuser_profile',
		'app.city',
		'app.country',
		'app.church',
		'app.schedule',
		'app.schedule_type',
		'app.favorite',
		'app.reading',
		'app.reading_type',
		'app.message',
		'app.conversation'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->MobileUser = ClassRegistry::init('MobileUser');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->MobileUser);

		parent::tearDown();
	}

}
