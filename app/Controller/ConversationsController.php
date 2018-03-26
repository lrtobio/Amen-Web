<?php
App::uses('AppController', 'Controller');
/**
 * Conversations Controller
 *
 * @property Conversation $Conversation
 * @property PaginatorComponent $Paginator
 */
class ConversationsController extends AppController {
    
    
    public function isAuthorized($user){
        if($user['webuser_profile_id'] == '2'){
            if(in_array($this->action, array('index','view'))){
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
                'Conversation.created' => 'desc'
            )
        );

	public function index() {
		$this->Conversation->recursive = 0;
                $this->paginate['Conversation']['limit'] = 20;               
                $this->paginate['Conversation']['order'] = array('Conversation.created' => 'desc');
		if($this->request->is('post')){
                    $search = $this->request->data['Conversation']['search'];
                    $this->Session->write('search_conversation',$search);
                    $status = $this->request->data['Conversation']['status'];
                    $this->Session->write('status_conversation',$status);
                    $country = $this->request->data['Conversation']['country'];
                    $this->Session->write('country_conversation',$country);
                    $locale = $this->request->data['Conversation']['locale'];
                    $this->Session->write('locale_conversation',$locale);
                }
                else{
                    $search =  $this->Session->read('search_conversation');
                    $status =  $this->Session->read('status_conversation');
                    $country =  $this->Session->read('country_conversation');
                    $locale =  $this->Session->read('locale_conversation');
                }
                $condicionSearch = '';
                $condicionStatus = '';
                if(!empty($search))
                    $condicionSearch  = array('or'=>array('Sender.nombre LIKE' => '%'.$search.'%','Sender.apellido LIKE' => '%'.$search.'%', 'Receiver.nombre LIKE' => '%'.$search.'%', 'Receiver.apellido LIKE' => '%'.$search.'%','Conversation.subject LIKE' => '%'.$search.'%'));
                if(!empty($status))
                    $condicionStatus = array('Conversation.status'=>$status);
                $condicionCountry = '';
                if(!empty($country))
                    $condicionCountry = array('Sender.country_id'=>$country);
                $condicionLocale = '';
                if(!empty($locale))
                    $condicionLocale = array('Sender.locale'=>$locale);
                
                $conditions = array($condicionSearch,$condicionStatus, $condicionCountry, $condicionLocale);
                $this->paginate['Conversation']['conditions'] = $conditions;
                $this->request->data['Conversation']['search'] = $search;
                $this->request->data['Conversation']['status'] = $status;
                $this->request->data['Conversation']['country'] = $country;
                $this->request->data['Conversation']['locale'] = $locale;
                $conversations = $this->paginate(); 
                $this->set('conversations', $conversations);
                $this->set('user', $this->Auth->user('id'));
                $this->set('op_status', $this->Conversation->opcionesStatus);
                $this->set('label_status', $this->Conversation->labelStatus);
                
                $this->loadModel('Country');
                $countries = $this->Country->find('list',array('order'=>'Country.nombre ASC'));
                $this->set('countries',$countries); 
                
                $this->loadModel('MobileUser');
                $this->set('locales', $this->MobileUser->availableLocales);
                
                $this->Conversation->virtualFields['count_items'] = ('COUNT(Conversation.id)');
                $dataCountry = $this->Conversation->find('all', array('fields'=>array('Conversation.id', 'Conversation.count_items', 'Sender.country_id'), 'conditions'=>array('Sender.country_id !='=>'0'), 'group'=>array('country_id'), 'order'=>'Conversation.count_items DESC', 'limit'=>'5'));
                $this->set('dataCountry',$dataCountry);
                $dataLocale = $this->Conversation->find('all', array('fields'=>array('Conversation.id', 'Conversation.count_items', 'Sender.locale'), 'conditions'=>array('Sender.country_id !='=>'0'), 'group'=>array('locale'), 'order'=>'Conversation.count_items DESC', 'limit'=>'5'));
                $this->set('dataLocale',$dataLocale);
	}


	public function view($id = null) {
		if (!$this->Conversation->exists($id)) {
			throw new NotFoundException(__('Invalid conversation'));
		}
		$options = array('conditions' => array('Conversation.' . $this->Conversation->primaryKey => $id));
		$this->set('conversation', $this->Conversation->find('first', $options));
                $this->set('user', $this->Auth->user('id'));
                $this->set('op_status', $this->Conversation->opcionesStatus);
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->Conversation->create();
                        $this->request->data['Conversation']['status'] = 'S';
			if ($this->Conversation->save($this->request->data)) {
				$this->Session->setFlash(__('The conversation has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The conversation could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$senders = $this->Conversation->Sender->find('list',array('conditions'=>array('Sender.mobileuser_profile_id'=>1)) );
		$receivers = $this->Conversation->Receiver->find('list',array('conditions'=>array('Receiver.mobileuser_profile_id'=>2)));
		$this->set(compact('senders', 'receivers'));
	}

	public function edit($id = null) {
		if (!$this->Conversation->exists($id)) {
			throw new NotFoundException(__('Invalid conversation'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Conversation->save($this->request->data)) {
				$this->Session->setFlash(__('The conversation has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The conversation could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Conversation.' . $this->Conversation->primaryKey => $id));
			$this->request->data = $this->Conversation->find('first', $options);
		}
		$senders = $this->Conversation->Sender->find('list',array('conditions'=>array('Sender.mobileuser_profile_id'=>1)) );
		$receivers = $this->Conversation->Receiver->find('list',array('conditions'=>array('Receiver.mobileuser_profile_id'=>2)));
		$this->set(compact('senders', 'receivers'));
	}


	public function delete($id = null) {
		$this->Conversation->id = $id;
		if (!$this->Conversation->exists()) {
			throw new NotFoundException(__('Invalid conversation'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Conversation->delete()) {
			$this->Session->setFlash(__('The conversation has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The conversation could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
