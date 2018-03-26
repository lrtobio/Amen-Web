<?php
App::uses('AppModel', 'Model');
/**
 * schedule Model
 *
 * @property ScheduleType $ScheduleType
 * @property Church $Church
 */
class Schedule extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'schedule_type_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'church_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'ScheduleType' => array(
			'className' => 'ScheduleType',
			'foreignKey' => 'schedule_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Church' => array(
			'className' => 'Church',
			'foreignKey' => 'church_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
