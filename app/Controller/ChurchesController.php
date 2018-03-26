<?php
App::uses('AppController', 'Controller');
App::uses('Folder', 'Utility');

class ChurchesController extends AppController {
    
    public function isAuthorized($user){
        if($user['webuser_profile_id'] == '2'){
            if(in_array($this->action, array('index', 'add', 'edit','view','map','delete'))){
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
            'Church.modified' => 'desc'
        )
    );
       

	public function index() {
            $this->Church->recursive = 0;
            $this->paginate['Church']['limit'] = 20;               
            $this->paginate['Church']['order'] = array('Church.modified' => 'desc');
            if($this->request->is('post')&& !empty($this->request->data)){
                $search = $this->request->data['Church']['search'];
                $this->Session->write('search_church',$search);
                $country = $this->request->data['Church']['country'];
                $this->Session->write('country_church',$country);
            }
            else{
                $search =  $this->Session->read('search_church');
                $country =  $this->Session->read('country_church');
            }
            $condicionSearch = '';
            if(!empty($search))
                $condicionSearch  = array('or'=>array('Church.nombre LIKE' => '%'.$search.'%', 'Church.direccion LIKE' => '%'.$search.'%', 'Church.observaciones LIKE' => '%'.$search.'%'));
            $condicionCountry = '';
            if(!empty($country))
                $condicionCountry = array('Church.country_id'=>$country);
            $this->paginate['Church']['conditions']= array($condicionSearch, $condicionCountry);
            $this->request->data['Church']['search'] = $search;
            $this->request->data['Church']['country'] = $country;
            $churches = $this->paginate(); 
            $this->set('churches', $churches);
            $this->loadModel('Country');
            $countries = $this->Country->find('list',array('order'=>'Country.nombre ASC'));
            $this->Church->virtualFields['count_country'] = ('COUNT(Church.id)');
            $dataChurches = $this->Church->find('all', array('fields'=>array('Church.id', 'Church.count_country', 'Church.country_id', 'Country.nombre'), 'conditions'=>array('Church.country_id !='=>'0'), 'group'=>array('country_id'), 'order'=>'Church.count_country DESC', 'limit'=>'5'));
            $this->set('dataChurches',$dataChurches);
            $this->set('countries',$countries);
	}
        public function map() {
		$this->Church->recursive = 0;
		$this->set('churches', $this->Church->find('all'));
	}
	public function view($id = null) {
		if (!$this->Church->exists($id)) {
			throw new NotFoundException(__('Invalid church'));
		}
		$options = array('conditions' => array('Church.' . $this->Church->primaryKey => $id));
		$this->set('church', $this->Church->find('first', $options));
                $this->set('schedule_list', $this->Church->schedulesList_es);
	}
	public function add() {
		if ($this->request->is('post')) {
                    $this->Church->Country->recursive = -1;
                    $country_short_name = $this->request->data['Church']['country_short_name'];
                    $country_name = $this->request->data['Church']['country_name'];
                    if($country_short_name == NULL || $country_short_name == ''){
                        $lat = $this->request->data['Church']['latitud'];
                        $lng = $this->request->data['Church']['longitud'];
                        $url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.$lat.','.$lng;
                        ini_set($url, 1);
                        $json = file_get_contents($url);
                        $obj = json_decode($json, true);
                        if($obj['status'] ==  "OK"){
                            foreach ($obj['results']['0']['address_components'] as $item){
                                if($item['types']['0'] == 'country'){
                                    $country_name = $item['long_name'];
                                    $country_short_name = $item['short_name'];
                                }
                            }
                        }
                    }
                    $country = $this->Church->Country->find('first', 
                                    array(
                                        'conditions' => array(
                                            'Country.short_name' => trim($country_short_name)                                    
                                          )
                                    )
                                );
                    if( $country!=NULL && count($country)>0 && $country['Country']!=NULL ){
                        $this->request->data['Church']['country_id'] = $country['Country']['id'];
                    }
                    else{
                        $dataCountry = array();
                        $dataCountry['nombre'] = $country_name;
                        $dataCountry['short_name'] = trim($country_short_name);

                        if($this->Church->Country->save($dataCountry)){
                            $this->request->data['Church']['country_id'] = $this->Church->Country->id;
                        }
                    }
			$this->Church->create();
                        
			if ($this->Church->save($this->request->data)) {
				$this->Session->setFlash(__('The church has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'view/'.$this->Church->id));
			} else {
				$this->Session->setFlash(__('The church could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$mobileUsers = $this->Church->MobileUser->find('list');
		$countries = $this->Church->Country->find('list');
		$this->set(compact('mobileUsers', 'countries'));
                $this->set('user',  $this->Auth->user('id'));
	}
	public function edit($id = null) {
		if (!$this->Church->exists($id)) {
			throw new NotFoundException(__('Invalid church'));
		}
		if ($this->request->is(array('post', 'put'))) {
                    
                    $this->Church->Country->recursive = -1;
                    $country_short_name = $this->request->data['Church']['country_short_name'];
                    $country_name = $this->request->data['Church']['country_name'];
                    if($country_short_name == NULL || $country_short_name == ''){
                        $lat = $this->request->data['Church']['latitud'];
                        $lng = $this->request->data['Church']['longitud'];
                        $url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.$lat.','.$lng;
                        ini_set($url, 1);
                        $json = file_get_contents($url);
                        $obj = json_decode($json, true);
                        if($obj['status'] ==  "OK"){
                            foreach ($obj['results']['0']['address_components'] as $item){
                                if($item['types']['0'] == 'country'){
                                    $country_name = $item['long_name'];
                                    $country_short_name = $item['short_name'];
                                }
                            }
                        }
                    }
                    $country = $this->Church->Country->find('first', 
                                    array(
                                        'conditions' => array(
                                            'Country.short_name' => trim($country_short_name)                                    
                                          )
                                    )
                                );
                    if( $country!=NULL && count($country)>0 && $country['Country']!=NULL ){
                        $this->request->data['Church']['country_id'] = $country['Country']['id'];
                    }
                    else{
                        $dataCountry = array();
                        $dataCountry['nombre'] = $country_name;
                        $dataCountry['short_name'] = trim($country_short_name);

                        if($this->Church->Country->save($dataCountry)){
                            $this->request->data['Church']['country_id'] = $this->Church->Country->id;
                        }
                    }
			if ($this->Church->save($this->request->data)) {
				$this->Session->setFlash(__('The church has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'view/'.$this->Church->id));
			} else {
				$this->Session->setFlash(__('The church could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Church.' . $this->Church->primaryKey => $id));
			$this->request->data = $this->Church->find('first', $options);
		}
		$mobileUsers = $this->Church->MobileUser->find('list');
		$countries = $this->Church->Country->find('list');
                
		$this->set(compact('mobileUsers', 'countries'));
	}
	public function delete($id = null) {
		$this->Church->id = $id;
		if (!$this->Church->exists()) {
			throw new NotFoundException(__('Invalid church'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Church->delete()) {
			$this->Session->setFlash(__('The church has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The church could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
