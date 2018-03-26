<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
/**
 * WebUser Model
 *
 * @property WebuserProfile $WebuserProfile
 */
class WebUser extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'password' => array(
                    'required' => array(
                        'rule' => array('minLength', 4),
                        'message' => 'Minimo 4 caracteres'
                    ),
                    'matchPasswords' => array(
                                'rule' => array('matchPasswords'),
                                'message' => 'Las contraseñas no coinciden!'
                         )
                ),
                'copiapassword' => array(
                    'required' => array(
                        'rule' => 'notBlank',
                        'message' => 'Se requiere verificación',
                    )
                ) ,
                'webuser_profile_id' => array(
                'numeric' => array(
                        'rule' => array('numeric'),
                        //'message' => 'Your custom message here',
                        //'allowEmpty' => false,
                        //'required' => false,
                        //'last' => false, // Stop validation after this rule
                        //'on' => 'create', // Limit validation to 'create' or 'update' operations
                ),
		),
		'activo' => array(
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
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'WebuserProfile' => array(
			'className' => 'WebuserProfile',
			'foreignKey' => 'webuser_profile_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
        
        public function beforeSave($options = array()) {
            if (isset($this->data[$this->alias]['password'])) {
                $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
            }
            return true;
        }
        public function matchPasswords($data){
            if ($data['password'] == $this->data['WebUser']['copiapassword']){
                  return true;
             }
             $this->invalidate('copiapassword','Las contraseñas no coinciden!');
              return false;
        }
}
