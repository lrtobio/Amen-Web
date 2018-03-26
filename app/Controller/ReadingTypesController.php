<?php
App::uses('AppController', 'Controller');
/**
 * ReadingTypes Controller
 *
 * @property ReadingType $ReadingType
 * @property PaginatorComponent $Paginator
 */
class ReadingTypesController extends AppController {

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
		$this->ReadingType->recursive = 0;
		$this->set('readingTypes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ReadingType->exists($id)) {
			throw new NotFoundException(__('Invalid reading type'));
		}
		$options = array('conditions' => array('ReadingType.' . $this->ReadingType->primaryKey => $id));
		$this->set('readingType', $this->ReadingType->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ReadingType->create();
			if ($this->ReadingType->save($this->request->data)) {
				$this->Session->setFlash(__('The reading type has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The reading type could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
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
		if (!$this->ReadingType->exists($id)) {
			throw new NotFoundException(__('Invalid reading type'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ReadingType->save($this->request->data)) {
				$this->Session->setFlash(__('The reading type has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The reading type could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('ReadingType.' . $this->ReadingType->primaryKey => $id));
			$this->request->data = $this->ReadingType->find('first', $options);
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
		$this->ReadingType->id = $id;
		if (!$this->ReadingType->exists()) {
			throw new NotFoundException(__('Invalid reading type'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ReadingType->delete()) {
			$this->Session->setFlash(__('The reading type has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The reading type could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
