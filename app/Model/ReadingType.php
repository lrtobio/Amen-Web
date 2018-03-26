<?php
App::uses('AppModel', 'Model');
/**
 * ReadingType Model
 *
 * @property Reading $Reading
 */
class ReadingType extends AppModel {


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */     public $displayField = 'titulo_es';
	public $hasMany = array(
		'Reading' => array(
			'className' => 'Reading',
			'foreignKey' => 'reading_type_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
