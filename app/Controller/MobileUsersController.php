<?php
App::uses('AppController', 'Controller');
/**
 * MobileUsers Controller
 *
 * @property MobileUser $MobileUser
 * @property PaginatorComponent $Paginator
 */
class MobileUsersController extends AppController {

    public function isAuthorized($user){
        if($user['webuser_profile_id'] == '2'){
            if(in_array($this->action, array('index', 'edit','view'))){
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
                'MobileUser.created' => 'desc'
            )
        );

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->MobileUser->recursive = 0;
                $this->paginate['MobileUser']['limit'] = 20;               
                $this->paginate['MobileUser']['order'] = array('MobileUser.created' => 'desc');
                if($this->request->is('post') && !empty($this->request->data)){
                    $search = $this->request->data['MobileUser']['search'];
                    $this->Session->write('search_muser_amen',$search);
                    $status = $this->request->data['MobileUser']['estado'];
                    $this->Session->write('status_muser_amen',$status);
                    $profile = $this->request->data['MobileUser']['perfil'];
                    $this->Session->write('profile_muser_amen',$profile);
                }
                else{
                    $search =  $this->Session->read('search_muser_amen');
                    $status =  $this->Session->read('status_muser_amen');
                    $profile =  $this->Session->read('profile_muser_amen');
                }
                $condicionSearch = '';
                $condicionStatus = '';
                $condicionProfile = '';
                if(!empty($search))
                    $condicionSearch  = array('or'=>array('MobileUser.nombre LIKE' => '%'.$search.'%','MobileUser.apellido LIKE' => '%'.$search.'%','MobileUser.email LIKE' => '%'.$search.'%'));
                if(!empty($status))
                    $condicionStatus = array('MobileUser.status'=>$status);
                if(!empty($profile))
                    $condicionProfile = array('MobileUser.mobileuser_profile_id'=>$profile);
                
                $conditions = array($condicionSearch, $condicionStatus, $condicionProfile);
                $this->paginate['MobileUser']['conditions'] = $conditions;
                $this->request->data['MobileUser']['search'] = $search;
                $this->request->data['MobileUser']['estado'] = $status;
                $this->request->data['MobileUser']['perfil'] = $profile;
                
                $mobileUsers = $this->paginate(); 
		$this->set('mobileUsers', $mobileUsers);
                $this->set('opciones_status', $this->MobileUser->opcionesStatus);
                
                $this->MobileUser->virtualFields['items'] = ('COUNT(MobileUser.id)');
                $dataStatus = $this->MobileUser->find('all', array('fields'=>array('MobileUser.id', 'MobileUser.items', 'MobileUser.status'), 'group'=>array('status'), 'order'=>'MobileUser.items DESC'));
                $this->set('dataStatus',$dataStatus);
                $dataProfile = $this->MobileUser->find('all', array('fields'=>array('MobileUser.id', 'MobileUser.items', 'MobileUser.mobileuser_profile_id', 'MobileuserProfile.titulo_es'), 'group'=>array('mobileuser_profile_id'), 'order'=>'MobileUser.items DESC'));
                $this->set('dataProfile',$dataProfile);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->MobileUser->exists($id)) {
			throw new NotFoundException(__('Invalid mobile user'));
		}
		$options = array('conditions' => array('MobileUser.' . $this->MobileUser->primaryKey => $id));
		$this->set('mobileUser', $this->MobileUser->find('first', $options));
                $this->set('opciones_status', $this->MobileUser->opcionesStatus);
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->MobileUser->create();
			if ($this->MobileUser->save($this->request->data)) {
				$this->Session->setFlash(__('The mobile user has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mobile user could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$mobileuserProfiles = $this->MobileUser->MobileuserProfile->find('list');
		$cities = $this->MobileUser->City->find('list', array('order'=>array('City.prioridad'=>'DESC')));
                $countries = $this->MobileUser->Country->find('list', array('order'=>array('Country.nombre'=>'ASC')));
		$this->set(compact('mobileuserProfiles', 'cities', 'countries'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->MobileUser->exists($id)) {
			throw new NotFoundException(__('Invalid mobile user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->MobileUser->save($this->request->data)) {
				$this->Session->setFlash(__('The mobile user has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mobile user could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('MobileUser.' . $this->MobileUser->primaryKey => $id));
			$this->request->data = $this->MobileUser->find('first', $options);
		}
		$mobileuserProfiles = $this->MobileUser->MobileuserProfile->find('list');
		$cities = $this->MobileUser->City->find('list', array('order'=>array('City.prioridad'=>'DESC')));
                $countries = $this->MobileUser->Country->find('list', array('order'=>array('Country.nombre'=>'ASC')));
                $opStatus = array('A'=>'Activo','I'=>'Inactivo');
                if($this->request->data['MobileUser']['mobileuser_profile_id'] == '2')
                    $opStatus = array('A'=>'Activo','I'=>'Inactivo','V'=>'Verificado');
                    
		$this->set(compact('mobileuserProfiles', 'cities', 'countries','opStatus'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->MobileUser->id = $id;
		if (!$this->MobileUser->exists()) {
			throw new NotFoundException(__('Invalid mobile user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->MobileUser->delete()) {
			$this->Session->setFlash(__('The mobile user has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The mobile user could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
        
        public function activateaccount($muser_id) {
            $message = '';
            if( ($muser_id != NULL && $muser_id != '') ){
                $muser_id = base64_decode($muser_id);
                $this->MobileUser->recursive = -1;//para quitar todas las clases asociadas
                $muser = $this->MobileUser->findById($muser_id);
                $lc = $muser['MobileUser']['locale'];
                if( $muser!=NULL && $muser['MobileUser']!=NULL ){
                    if( $muser['MobileUser']['status']=='A' || $muser['MobileUser']['status']=='V')
                        $message = $this->MobileUser->getMessage($lc, 'account-warning');
                    else{
                        $dataMobileUser = array( "id" => $muser_id, "status" => 'A' );
                        if( $this->MobileUser->save($dataMobileUser) ){
                            $nombre = strtok($muser['MobileUser']['nombre'],' ');
                            if($muser['MobileUser']['mobileuser_profile_id'] == '1'){
                                $nombre = $this->MobileUser->getMessage($lc, 'dear').' '.$nombre;
                                $body = $this->MobileUser->getMessage($lc, 'email-welcome-f');
                            }
                            else{
                                if($muser['MobileUser']['consagracion'] != NULL && $muser['MobileUser']['consagracion'] != '')
                                    $nombre = $this->MobileUser->getMessage($lc, 'dear').' '.$muser['MobileUser']['consagracion'].' '.$nombre;
                                    $body = $this->MobileUser->getMessage($lc, 'email-welcome-r');
                            }                            
                            
                            $message = $this->MobileUser->getMessage($lc, 'account-success');
                            $subject = $this->MobileUser->getMessage($lc, 'email-subject');
                            
                            App::uses('CakeEmail', 'Network/Email');
                            $correo = new CakeEmail('amenapps'); 
                            $correo      
                              ->template('email_welcome_r','plantilla')               
                              ->emailFormat('html')       
                              ->to(array($muser['MobileUser']['email']))      
                              ->from('info@amenapps.com')
                              ->subject($subject) 
                              ->viewVars([ 
                                    'nombre' => $nombre.' ¡ '.$subject.' ! ',
                                    'body' => $body,
                                    'url_img' => (FULL_BASE_URL . $this->webroot),
                              ]);        
                            $correo->send();
                        }                            
                        else{
                            $message = $this->MobileUser->getMessage($lc, 'account-danger');
                        }
                    }
                }else
                    $message = $this->MobileUser->getMessage($lc, 'login-error');
            }else
                $message = $this->MobileUser->getMessage('en', 'init');

        $this->set('message', $message);
        $this->layout = null ;
    }
    
    public function beforeFilter() {
        parent::beforeFilter('mobile_users');

        $this->Auth->allow('activateaccount');

        if ($this->request->params['action'] == 'activateaccount')
            $this->layout = null;
        else {
            if (!$this->isAuthorized(AuthComponent::user())) {
                $this->Auth->deny('*');
                //parent::redirectFilter();
                $this->redirect($this->Auth->redirect());
            } else {
                //$this->Auth->allow('*');
                $this->layout = 'bootstrap';
            }
        }
    }
}
