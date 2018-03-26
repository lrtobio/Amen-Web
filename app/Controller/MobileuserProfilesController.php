<?php
App::uses('AppController', 'Controller');
/**
 * MobileuserProfiles Controller
 *
 * @property MobileuserProfile $MobileuserProfile
 * @property PaginatorComponent $Paginator
 */
class MobileuserProfilesController extends AppController {

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
		$this->MobileuserProfile->recursive = 0;
		$this->set('mobileuserProfiles', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->MobileuserProfile->exists($id)) {
			throw new NotFoundException(__('Invalid mobileuser profile'));
		}
		$options = array('conditions' => array('MobileuserProfile.' . $this->MobileuserProfile->primaryKey => $id));
		$this->set('mobileuserProfile', $this->MobileuserProfile->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->MobileuserProfile->create();
			if ($this->MobileuserProfile->save($this->request->data)) {
				$this->Session->setFlash(__('The mobileuser profile has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mobileuser profile could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
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
		if (!$this->MobileuserProfile->exists($id)) {
			throw new NotFoundException(__('Invalid mobileuser profile'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->MobileuserProfile->save($this->request->data)) {
				$this->Session->setFlash(__('The mobileuser profile has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mobileuser profile could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('MobileuserProfile.' . $this->MobileuserProfile->primaryKey => $id));
			$this->request->data = $this->MobileuserProfile->find('first', $options);
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
		$this->MobileuserProfile->id = $id;
		if (!$this->MobileuserProfile->exists()) {
			throw new NotFoundException(__('Invalid mobileuser profile'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->MobileuserProfile->delete()) {
			$this->Session->setFlash(__('The mobileuser profile has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The mobileuser profile could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
