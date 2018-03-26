<?php

App::uses('Controller', 'Controller');

/*
class AppController extends Controller {    
    //var $helpers = array('Html', 'MainMenu','Js', 'Form' );    
     public $components = array(
        //'DebugKit.Toolbar',//plugin para debug
        'Session',
        //'Auth' => array()
    );      
    public function beforeFilter()
    {
        $this->layout = 'bootstrap';
    }
}*/

class AppController extends Controller {    
    //var $helpers = array('Html', 'MainMenu', 'Js', 'Form' );
    public $components = array(
        'Session',
        'Auth' => array(            
            'loginRedirect' => array( 'controller' => 'churches', 'action' => 'index' ),
            'logoutRedirect' => array( 'controller' => 'web_users', 'action' => 'login' ),
            'authorize' => array('Controller'),
            'authError' => 'Debes estar logueado para ver esta pagina.',
            'loginError' => 'Usuario y/o password invalido, por favor intente de nuevo.',
            'authenticate' => array(
                'Form' => array(
                    'scope' => array('WebUser.activo' => 'SI')//activo = S
                    )
                )
            )
        );
    public function beforeFilter(){
        $this->layout = 'bootstrap';
        $this->Auth->loginAction = array('controller'=>'web_users', 'action'=>'login');        
        $this->Auth->authenticate = array(
            AuthComponent::ALL => array(
                'userModel' => 'WebUser',
                'fields' => array('username' => 'email', 'password' => 'password'),
                'scope' => array('WebUser.activo' => 'SI')
                ),'Basic','Form'
            );        
        $this->set('current_user', $this->Auth->user());
        $this->Auth->allow('login', 'logout');
    }
    
    public function isAuthorized($user){
        //superadmin = 1
        if (isset($user['webuser_profile_id']) && (($user['webuser_profile_id'] === '1'))) {
            return true;
        }
        // Default deny
        return false;
    }
    
    
    
    
}
