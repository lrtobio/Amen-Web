<?php
App::uses('AppController', 'Controller');
/**
 * WebUsers Controller
 *
 * @property WebUser $WebUser
 * @property PaginatorComponent $Paginator
 */
class WebUsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
    public function isAuthorized($user){
        if($user['webuser_profile_id'] == '2'){
            if(in_array($this->action, array('index', 'add', 'edit', 'view'))){
                return true;
            }
            else{
                if($this->Auth->user('id')){
                    $this->Session->setFlash('No puede acceder', 'default', array('class' => 'alert alert-danger'));
                    $this->redirect($this->Auth->redirect());
                }
            }
        }
        return parent::isAuthorized($user);
    }
	public $components = array('Paginator');
    public function beforeFilter(){
        parent::beforeFilter();	
    }

/**
 * index method
 *
 * @return void
 */public function login(){
        if($this->request->is('post')){
            if($this->Auth->login()){
                
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Session->setFlash('Usuario y/o contraseña son incorrectos! <br> Por favor valide si su usuario esta activo', 'default', array('class' => 'alert alert-danger'));
        }
    }
	
    public function logout(){
        $this->Session->destroy();
        return $this->redirect($this->Auth->logout());
    }
	public function index() {
		$this->WebUser->recursive = 0;
		$this->set('webUsers', $this->Paginator->paginate());
                $this->set('user',  $this->Auth->user('id'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->WebUser->exists($id)) {
			throw new NotFoundException(__('Invalid web user'));
		}
		$options = array('conditions' => array('WebUser.' . $this->WebUser->primaryKey => $id));
		$this->set('webUser', $this->WebUser->find('first', $options));
                $this->set('user',  $this->Auth->user('id'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->WebUser->create();
			if ($this->WebUser->save($this->request->data)) {
				$this->Session->setFlash(__('The web user has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The web user could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$webuserProfiles = $this->WebUser->WebuserProfile->find('list', array('conditions'=>array('WebuserProfile.id !='=>1)));
		$this->set(compact('webuserProfiles'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->WebUser->exists($id)) {
			throw new NotFoundException(__('Invalid web user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->WebUser->save($this->request->data)) {
				$this->Session->setFlash(__('The web user has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The web user could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('WebUser.' . $this->WebUser->primaryKey => $id));
			$this->request->data = $this->WebUser->find('first', $options);
		}
		$webuserProfiles = $this->WebUser->WebuserProfile->find('list', array('conditions'=>array('WebuserProfile.id !='=>1)));
		$this->set(compact('webuserProfiles'));
                $this->set('user',  $this->Auth->user('id'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->WebUser->id = $id;
		if (!$this->WebUser->exists()) {
			throw new NotFoundException(__('Invalid web user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->WebUser->delete()) {
			$this->Session->setFlash(__('The web user has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The web user could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
