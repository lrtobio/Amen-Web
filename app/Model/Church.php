<?php
App::uses('AppModel', 'Model');
/**
 * church Model
 *
 * @property MobileUser $MobileUser
 * @property Country $Country
 * @property Schedule $Schedule
 */
class Church extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */     
    
    public $displayField = 'nombre';
	public $validate = array(
		'nombre' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'latitud' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Please check a point in the map',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'longitud' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Please check a point in the map',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'country_id' => array(
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
		'MobileUser' => array(
			'className' => 'MobileUser',
			'foreignKey' => 'mobile_user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Country' => array(
			'className' => 'Country',
			'foreignKey' => 'country_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Schedule' => array(
			'className' => 'Schedule',
			'foreignKey' => 'church_id',
			'dependent' => true,
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
        
         public $schedulesList_es = array('1'=>'Eucaristias', '2'=>'Confesiones', '3'=>'Santísimos');
        
}
