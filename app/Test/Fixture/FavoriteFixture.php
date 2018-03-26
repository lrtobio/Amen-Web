<?php
/**
 * Favorite Fixture
 */
class FavoriteFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'mobile_user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'church_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'reading_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'mobile_user_id' => 1,
			'church_id' => 1,
			'reading_id' => 1,
			'created' => '2016-12-21 09:29:40'
		),
	);

}
