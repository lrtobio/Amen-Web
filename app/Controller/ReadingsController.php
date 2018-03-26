<?php
App::uses('AppController', 'Controller');
/**
 * Readings Controller
 *
 * @property Reading $Reading
 * @property PaginatorComponent $Paginator
 */
class ReadingsController extends AppController {

//public $helpers = array('TinyMCE.TinyMCE');
public function isAuthorized($user){
        if($user['webuser_profile_id'] == '2'){
            if(in_array($this->action, array('index', 'add', 'edit','view','delete'))){
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
	public $components = array('Session', 'RequestHandler');
        public $paginate = array(
            'limit' => 20,
            'order' => array(
                'Reading.created' => 'desc'
            )
        );
        

/**
 * index method
 *
 * @return void
 */
	public function index() {
            $this->Reading->recursive = 0;
            $this->paginate['Reading']['limit'] = 20;               
            $this->paginate['Reading']['order'] = array('Reading.modified' => 'desc');
            /*if($this->request->is('post')){
                $search = $this->request->data['Church']['search'];
                $this->Session->write('search_church',$search);
            }
            else{
                $search =  $this->Session->read('search_church');
            }
            $condicionSearch = '';
            if(!empty($search))
                $condicionSearch  = array('or'=>array('Church.nombre LIKE' => '%'.$search.'%', 'Church.direccion LIKE' => '%'.$search.'%', 'Church.observaciones LIKE' => '%'.$search.'%'));
            $this->paginate['Church']['conditions']=$condicionSearch;
            $this->request->data['Church']['search'] = $search;*/
            $readings = $this->paginate(); 
            $this->set('readings', $readings);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Reading->exists($id)) {
			throw new NotFoundException(__('Invalid reading'));
		}
		$options = array('conditions' => array('Reading.' . $this->Reading->primaryKey => $id));
		$this->set('reading', $this->Reading->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Reading->create();
                        $fecha = $this->request->data['Reading']['fecha'];
                        $fecha = "_____".date('m-d',  strtotime($fecha));
                        $type = $this->request->data['Reading']['reading_type_id'];
                        $dataR = $this->Reading->find('first',array('conditions'=>array('Reading.fecha LIKE'=>$fecha,'Reading.reading_type_id'=>$type))); 
                        if($dataR != NULL && $dataR != ''){
                            $this->Session->setFlash(__('The reading is already exist!. Sorry.'), 'default', array('class' => 'alert alert-danger'));
                        }else{
                            if ($this->Reading->save($this->request->data)) {
				$this->Session->setFlash(__('The reading has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
                            } else {
                                    $this->Session->setFlash(__('The reading could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
                            }
                        }			
		}
		$readingTypes = $this->Reading->ReadingType->find('list');
		$this->set(compact('readingTypes'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Reading->exists($id)) {
			throw new NotFoundException(__('Invalid reading'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Reading->save($this->request->data)) {
				$this->Session->setFlash(__('The reading has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The reading could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Reading.' . $this->Reading->primaryKey => $id));
			$this->request->data = $this->Reading->find('first', $options);
		}
		$readingTypes = $this->Reading->ReadingType->find('list');
		$this->set(compact('readingTypes'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Reading->id = $id;
		if (!$this->Reading->exists()) {
			throw new NotFoundException(__('Invalid reading'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Reading->delete()) {
			$this->Session->setFlash(__('The reading has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The reading could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
