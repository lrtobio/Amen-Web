<?php
App::uses('AppModel', 'Model');
/**
 * conversation Model
 *
 * @property Sender $Sender
 * @property Reciever $Reciever
 * @property Message $Message
 */
class Conversation extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'sender_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'receiver_id' => array(
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
		'Sender' => array(
			'className' => 'MobileUser',
			'foreignKey' => 'sender_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Receiver' => array(
			'className' => 'MobileUser',
			'foreignKey' => 'receiver_id',
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
		'Message' => array(
			'className' => 'Message',
			'foreignKey' => 'conversation_id',
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
        
        public $opcionesStatus = array(
            'I' =>  '[I]  Ingresado, Sin respuesta aún',
            'S' =>  '[S]  Mensaje del Feligrés (Sender)',
            'R' =>  '[R]  Mensaje del Religioso, (Receiver)',
            'TS' => '[TS] Finalizado por el Feligés',
            'TR' => '[TR] Finalizado por el Religioso',
            'D' =>  '[D] Detenida la recepción de mensajes',
         );

        public $labelStatus = array(
            'I' => 'label label-warning',
            'S' => 'label label-info',
            'TS' => 'label label-danger',
            'TR' => 'label label-danger',
            'R' => 'label label-success',
            'D' => 'label label-default',
         );
}
