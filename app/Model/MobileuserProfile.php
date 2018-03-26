<?php
App::uses('AppModel', 'Model');
/**
 * MobileuserProfile Model
 *
 * @property MobileUser $MobileUser
 */
class MobileuserProfile extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */     public $displayField = 'titulo_es';
	public $validate = array(
		'titulo_es' => array(
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
		'MobileUser' => array(
			'className' => 'MobileUser',
			'foreignKey' => 'mobileuser_profile_id',
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
