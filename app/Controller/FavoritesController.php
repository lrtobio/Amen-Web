<?php
App::uses('AppController', 'Controller');
/**
 * Favorites Controller
 *
 * @property Favorite $Favorite
 * @property PaginatorComponent $Paginator
 */
class FavoritesController extends AppController {

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
		$this->Favorite->recursive = 0;
		$this->set('favorites', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Favorite->exists($id)) {
			throw new NotFoundException(__('Invalid favorite'));
		}
		$options = array('conditions' => array('Favorite.' . $this->Favorite->primaryKey => $id));
		$this->set('favorite', $this->Favorite->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Favorite->create();
			if ($this->Favorite->save($this->request->data)) {
				$this->Session->setFlash(__('The favorite has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The favorite could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$mobileUsers = $this->Favorite->MobileUser->find('list');
		$types = $this->Favorite->Type->find('list');
		$favorites = $this->Favorite->Favorite->find('list');
		$this->set(compact('mobileUsers', 'types', 'favorites'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Favorite->exists($id)) {
			throw new NotFoundException(__('Invalid favorite'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Favorite->save($this->request->data)) {
				$this->Session->setFlash(__('The favorite has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The favorite could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Favorite.' . $this->Favorite->primaryKey => $id));
			$this->request->data = $this->Favorite->find('first', $options);
		}
		$mobileUsers = $this->Favorite->MobileUser->find('list');
		$types = $this->Favorite->Type->find('list');
		$favorites = $this->Favorite->Favorite->find('list');
		$this->set(compact('mobileUsers', 'types', 'favorites'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Favorite->id = $id;
		if (!$this->Favorite->exists()) {
			throw new NotFoundException(__('Invalid favorite'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Favorite->delete()) {
			$this->Session->setFlash(__('The favorite has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The favorite could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
