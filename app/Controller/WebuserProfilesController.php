<?php
App::uses('AppController', 'Controller');
/**
 * WebuserProfiles Controller
 *
 * @property WebuserProfile $WebuserProfile
 * @property PaginatorComponent $Paginator
 */
class WebuserProfilesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->WebuserProfile->recursive = 0;
		$this->set('webuserProfiles', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->WebuserProfile->exists($id)) {
			throw new NotFoundException(__('Invalid webuser profile'));
		}
		$options = array('conditions' => array('WebuserProfile.' . $this->WebuserProfile->primaryKey => $id));
		$this->set('webuserProfile', $this->WebuserProfile->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->WebuserProfile->create();
			if ($this->WebuserProfile->save($this->request->data)) {
				$this->Session->setFlash(__('The webuser profile has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The webuser profile could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->WebuserProfile->exists($id)) {
			throw new NotFoundException(__('Invalid webuser profile'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->WebuserProfile->save($this->request->data)) {
				$this->Session->setFlash(__('The webuser profile has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The webuser profile could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('WebuserProfile.' . $this->WebuserProfile->primaryKey => $id));
			$this->request->data = $this->WebuserProfile->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->WebuserProfile->id = $id;
		if (!$this->WebuserProfile->exists()) {
			throw new NotFoundException(__('Invalid webuser profile'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->WebuserProfile->delete()) {
			$this->Session->setFlash(__('The webuser profile has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The webuser profile could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
