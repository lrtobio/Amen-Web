<?php
App::uses('AppController', 'Controller');
/**
 * DailyMessages Controller
 *
 * @property DailyMessage $DailyMessage
 * @property PaginatorComponent $Paginator
 */
class DailyMessagesController extends AppController {

/**
 * Components
 *
 * @var array
 */
    
    public function isAuthorized($user){
        if($user['webuser_profile_id'] == '2'){
            if(in_array($this->action, array('index','edit', 'delete','view'))){
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
	//public $components = array('Paginator');
        public $paginate = array();


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->DailyMessage->recursive = 0;
                $this->paginate['DailyMessage']['limit'] = 20;               
                $this->paginate['DailyMessage']['order'] = array('DailyMessage.created' => 'desc');
                if($this->request->is('post')&& !empty($this->request->data)){
                    $search = $this->request->data['DailyMessage']['search'];
                    $this->Session->write('search_daily_message',$search);
                    $country = $this->request->data['DailyMessage']['country'];
                    $this->Session->write('country_daily_message',$country);
                    $locale = $this->request->data['DailyMessage']['locale'];
                    $this->Session->write('locale_daily_message',$locale);
                }
                else{
                    $search =  $this->Session->read('search_daily_message');
                    $country =  $this->Session->read('country_daily_message');
                    $locale =  $this->Session->read('locale_daily_message');
                }
                $condicionSearch = '';
                if(!empty($search))
                    $condicionSearch  = array('or'=>array('MobileUser.nombre LIKE' => '%'.$search.'%', 'DailyMessage.message LIKE' => '%'.$search.'%', 'DailyMessage.title LIKE' => '%'.$search.'%'));
                $condicionCountry = '';
                if(!empty($country))
                    $condicionCountry = array('MobileUser.country_id'=>$country);
                $condicionLocale = '';
                if(!empty($locale))
                    $condicionLocale = array('MobileUser.locale'=>$locale);
                
                $this->paginate['DailyMessage']['conditions']= array($condicionSearch, $condicionCountry, $condicionLocale);
                $this->request->data['DailyMessage']['search'] = $search;
                $this->request->data['DailyMessage']['country'] = $country;
                $this->request->data['DailyMessage']['locale'] = $locale;
                $this->set('dailyMessages', $this->paginate());
           
                $this->loadModel('Country');
                $countries = $this->Country->find('list',array('order'=>'Country.nombre ASC'));
                $this->set('countries',$countries); 
                
                $this->loadModel('MobileUser');
                $this->set('locales', $this->MobileUser->availableLocales); 
                
                $this->DailyMessage->virtualFields['count_items'] = ('COUNT(DailyMessage.id)');
                $dataCountries= $this->DailyMessage->find('all', array('fields'=>array('DailyMessage.id', 'DailyMessage.count_items', 'MobileUser.country_id'), 'conditions'=>array('MobileUser.country_id !='=>'0'), 'group'=>array('country_id'), 'order'=>'DailyMessage.count_items DESC', 'limit'=>'5'));
                $this->set('dataCountries',$dataCountries);
                $dataLocale = $this->DailyMessage->find('all', array('fields'=>array('DailyMessage.id', 'DailyMessage.count_items', 'MobileUser.locale'), 'conditions'=>array('MobileUser.country_id !='=>'0'), 'group'=>array('locale'), 'order'=>'DailyMessage.count_items DESC', 'limit'=>'5'));
                $this->set('dataLocale',$dataLocale);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->DailyMessage->exists($id)) {
			throw new NotFoundException(__('Invalid daily message'));
		}
		$options = array('conditions' => array('DailyMessage.' . $this->DailyMessage->primaryKey => $id));
		$this->set('dailyMessage', $this->DailyMessage->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->DailyMessage->create();
			if ($this->DailyMessage->save($this->request->data)) {
				$this->Session->setFlash(__('The daily message has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The daily message could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$mobileUsers = $this->DailyMessage->MobileUser->find('list');
		$this->set(compact('mobileUsers'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->DailyMessage->exists($id)) {
			throw new NotFoundException(__('Invalid daily message'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->DailyMessage->save($this->request->data)) {
				$this->Session->setFlash(__('The daily message has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The daily message could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('DailyMessage.' . $this->DailyMessage->primaryKey => $id));
			$this->request->data = $this->DailyMessage->find('first', $options);
		}
		$mobileUsers = $this->DailyMessage->MobileUser->find('list');
		$this->set(compact('mobileUsers'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->DailyMessage->id = $id;
		if (!$this->DailyMessage->exists()) {
			throw new NotFoundException(__('Invalid daily message'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->DailyMessage->delete()) {
			$this->Session->setFlash(__('The daily message has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The daily message could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
