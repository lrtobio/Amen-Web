<?php
App::uses('AppController', 'Controller');
/**
 * ScheduleTypes Controller
 *
 * @property ScheduleType $ScheduleType
 * @property PaginatorComponent $Paginator
 */
class ScheduleTypesController extends AppController {

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
		$this->ScheduleType->recursive = 0;
		$this->set('scheduleTypes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ScheduleType->exists($id)) {
			throw new NotFoundException(__('Invalid schedule type'));
		}
		$options = array('conditions' => array('ScheduleType.' . $this->ScheduleType->primaryKey => $id));
		$this->set('scheduleType', $this->ScheduleType->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ScheduleType->create();
			if ($this->ScheduleType->save($this->request->data)) {
				$this->Session->setFlash(__('The schedule type has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The schedule type could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
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
		if (!$this->ScheduleType->exists($id)) {
			throw new NotFoundException(__('Invalid schedule type'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ScheduleType->save($this->request->data)) {
				$this->Session->setFlash(__('The schedule type has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The schedule type could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('ScheduleType.' . $this->ScheduleType->primaryKey => $id));
			$this->request->data = $this->ScheduleType->find('first', $options);
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
		$this->ScheduleType->id = $id;
		if (!$this->ScheduleType->exists()) {
			throw new NotFoundException(__('Invalid schedule type'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ScheduleType->delete()) {
			$this->Session->setFlash(__('The schedule type has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The schedule type could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
