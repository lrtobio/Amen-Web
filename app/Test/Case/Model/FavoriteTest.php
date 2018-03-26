<?php
App::uses('Favorite', 'Model');

/**
 * Favorite Test Case
 */
class FavoriteTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.favorite',
		'app.mobile_user',
		'app.mobileuser_profile',
		'app.city',
		'app.country',
		'app.church',
		'app.schedule',
		'app.schedule_type',
		'app.message',
		'app.conversation',
		'app.reading',
		'app.reading_type'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Favorite = ClassRegistry::init('Favorite');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Favorite);

		parent::tearDown();
	}

}
