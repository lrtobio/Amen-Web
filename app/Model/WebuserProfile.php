<?php
App::uses('AppModel', 'Model');
/**
 * WebuserProfile Model
 *
 * @property WebUser $WebUser
 */
class WebuserProfile extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */     public $displayField = 'nombre';
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
	);

	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'WebUser' => array(
			'className' => 'WebUser',
			'foreignKey' => 'webuser_profile_id',
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
