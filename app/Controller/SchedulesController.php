<?php
App::uses('AppController', 'Controller');
/**
 * Schedules Controller
 *
 * @property Schedule $Schedule
 * @property PaginatorComponent $Paginator
 */
class SchedulesController extends AppController {

/**
 * Components
 *
 * @var array
 */
    
    public function isAuthorized($user){
        if($user['webuser_profile_id'] == '2'){
            if(in_array($this->action, array( 'add', 'edit','view'))){
                return true;
            }
            else {
                if($this->Auth->user('id')){
                    $this->Session->setFlash('No puede acceder', 'default', array('class' => 'alert alert-danger'));
                    $this->redirect($this->Auth->redirect());
                }
            }
        }
        return parent::isAuthorized($user);
    }
    
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Schedule->recursive = 0;
		$this->set('schedules', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Schedule->exists($id)) {
			throw new NotFoundException(__('Invalid schedule'));
		}
		$options = array('conditions' => array('Schedule.' . $this->Schedule->primaryKey => $id));
		$this->set('schedule', $this->Schedule->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($church_id = 0) {
		if ($this->request->is('post')) {
			$this->Schedule->create();
                        $dataSch = $this->Schedule->find('first', array('conditions'=>array('Schedule.schedule_type_id'=>$this->request->data['Schedule']['schedule_type_id'], 'Schedule.church_id'=>$this->request->data['Schedule']['church_id'])));
                        if($dataSch != NULL && $dataSch != ''){
                            $this->Session->setFlash(__('This schedule is already exist!.'), 'default', array('class' => 'alert alert-danger'));
                        }else{
                            if ($this->Schedule->save($this->request->data)) {
				$this->Session->setFlash(__('The schedule has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('controller' => 'churches', 'action' => 'view/'.$this->request->data['Schedule']['church_id']));
                            } else {
                                    $this->Session->setFlash(__('The schedule could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
                            }
                        }			
		}
		$scheduleTypes = $this->Schedule->ScheduleType->find('list');
		$churches = $this->Schedule->Church->find('list');
		$this->set(compact('scheduleTypes', 'churches'));
                $this->set('church_id', $church_id);
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Schedule->exists($id)) {
			throw new NotFoundException(__('Invalid schedule'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Schedule->save($this->request->data)) {
				$this->Session->setFlash(__('The schedule has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('controller' => 'churches', 'action' => 'view/'.$this->request->data['Schedule']['ch_id']));
			} else {
				$this->Session->setFlash(__('The schedule could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Schedule.' . $this->Schedule->primaryKey => $id));
			$this->request->data = $this->Schedule->find('first', $options);
		}
		$scheduleTypes = $this->Schedule->ScheduleType->find('list');
		$churches = $this->Schedule->Church->find('list');
		$this->set(compact('scheduleTypes', 'churches'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Schedule->id = $id;
		if (!$this->Schedule->exists()) {
			throw new NotFoundException(__('Invalid schedule'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Schedule->delete()) {
			$this->Session->setFlash(__('The schedule has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The schedule could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
