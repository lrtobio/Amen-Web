<?php

use Parse\ParsePush;
use Parse\ParseInstallation;
use Parse\ParseClient;
/*
use Parse\ParseObject;
use Parse\ParseACL;
use Parse\ParseUser;
use Parse\ParseException;
use Parse\ParseAnalytics;
use Parse\ParseFile;
use Parse\ParseCloud;
use Parse\ParseQuery;*/

/*

 *  CONTROLADOR ORIGINAL REEMPLAZADO PARA REDIRECCIONAR A amenapps.com/backendapp
 * 
 *  */
App::uses('AppController', 'Controller');
App::uses('Folder', 'Utility');

class WebServiceController extends AppController {

    public $components = array('RequestHandler'); 

    
    public function beforeFilter() {
        parent::beforeFilter();
        
        $this->Auth->allow(
            'churches_add','churches_edit', 'churches_view','churches_list',
            'schedules_add','schedules_edit',
            'musers_view','musers_add','musers_login','musers_edit', 'musers_rememberpwd',
            'conversations_list','conversations_add','conversations_question','conversations_response',
            'conversations_view','conversations_finish','conversations_messages','messages_list',
            'mobileUserProfiles_list',                
            'countries_list','cities_list',
            'readings_view', 
            'favorites_add','favorites_list','favorites_delete',
            'daily_message_add', 'daily_message_list',    
            'test','email_prueba', 'test_push','test_forward_question',
                'conversations_question_by_city'
        );
    }
    
    public function churches_add(){        
        $lc = 'es';
        if($this->request->data('locale')!=NULL    && ($this->request->data('locale'))!='')
            $lc = trim($this->request->data('locale'));
                    
        $success = false;
        $message = $this->getMessage($lc, 'init');
        $data = NULL;       
        
        if( ($this->request->data('nombre')!=NULL    && ($this->request->data('nombre'))!='') &&
            ($this->request->data('latitud')!=NULL    && ($this->request->data('latitud'))!='') &&
            ($this->request->data('longitud')!=NULL    && ($this->request->data('longitud'))!='') &&
            ($this->request->data('mobile_user_id')!=NULL && $this->request->data('mobile_user_id')!='')
         ){
            $dataChurches = array();            
            $dataChurches['nombre']          = trim($this->request->data('nombre'));
            $dataChurches['latitud']         = $this->request->data('latitud');
            $dataChurches['longitud']        = $this->request->data('longitud');
            $dataChurches['mobile_user_id']  = $this->request->data('mobile_user_id');
            
            
            $this->loadModel('MobileUser');
            $this->MobileUser->recursive = -1;
            $muser = $this->MobileUser->findById($this->request->data('mobile_user_id'));
            $status = '';
            if($muser != NULL && $muser != ''){
                $nombre = $muser['MobileUser']['nombre'];
                $email = $muser['MobileUser']['email'];
                $lc = $muser['MobileUser']['locale'];
                $status = $muser['MobileUser']['status'];
            }
            
            if($status != ''){
                if($status == 'A' || $status == 'V'){
                    
                    $dataChurches['country_id'] = $this->getCountry($dataChurches['latitud'] , $dataChurches['longitud']);
                    
                    if($this->request->data('email')!=NULL   && ($this->request->data('email'))!='')
                        $dataChurches['email'] = trim($this->request->data('email'));          
                    if ($this->request->data('telefonos')!=NULL && $this->request->data('telefonos')!='')
                        $dataChurches['telefonos']       = trim($this->request->data('telefonos'));
                    if($this->request->data('direccion')!=NULL   && $this->request->data('direccion')!='')
                        $dataChurches['direccion'] = trim($this->request->data('direccion'));            
                    if( $this->request->data('observaciones')!=NULL && $this->request->data('observaciones')!='' )
                        $dataChurches['observaciones'] = trim($this->request->data('observaciones'));
                    if( $this->request->data('email')!=NULL && $this->request->data('email')!='' )
                        $dataChurches['email'] = trim($this->request->data('email'));
                    if( $this->request->data('comunidad')!=NULL && $this->request->data('comunidad')!='' )
                        $dataChurches['comunidad'] = trim($this->request->data('comunidad'));
                    if( $this->request->data('direccion_web')!=NULL && $this->request->data('direccion_web')!='' )
                        $dataChurches['direccion_web'] = trim($this->request->data('direccion_web'));

                    $this->loadModel('Church');
                    if( $this->Church->save($dataChurches) ){
                        $nombre = $this->getMessage($lc, 'dear').' '.$nombre;
                        $array_email = $email . ',info@amenapps.com';
                        $this->correo($nombre,$array_email,'','email_base', $this->getMessage($lc, 'add-success-chr'),$this->getMessage($lc, 'email-add-church'));
                        $this->Church->recursive = -1;
                        $data = $this->Church->findById($this->Church->id);
                        $success = true;
                        $message = $this->getMessage($lc, 'add-success-chr');
                    }else{
                        $success = false;
                        $message = $this->getMessage($lc, 'add-error');
                    }
                }
                else{
                    $success = false;
                    $message = $this->getMessage($lc, 'active-error');
                }
            }
            else{
                $success = false;
                $message = $this->getMessage($lc, 'user-error');
            }
        }else{
            $success = false;
            $message = $this->getMessage($lc, 'fields-error')."; ".$this->getMessage($lc, 'required-fields-church');
        }
        
        $response = array( 'success' => $success, 'message' => $message, 'data' => $data );
        $this->set( array('response' => $response, '_serialize' => array('response') ));
    }
    
    public function churches_edit(){      
        $lc = 'es'; 
        if($this->request->data('locale')!=NULL    && ($this->request->data('locale'))!='')
            $lc = trim($this->request->data('locale'));
               
        $success = false;
        $message = $this->getMessage($lc, 'init');
        $data = NULL;       
        
        if( ($this->request->data('church_id')!=NULL   && $this->request->data('church_id')!='')){
            $dataChurches = array();            
            $dataChurches['id'] = $this->request->data('church_id');
            $dataChurches['mobile_user_id']  = $this->request->data('mobile_user_id');
            
            $this->loadModel('MobileUser');
            $this->MobileUser->recursive = -1;
            $muser = $this->MobileUser->findById($this->request->data('mobile_user_id'));
            $status = '';
            if($muser != NULL && $muser != ''){
                $nombre = $muser['MobileUser']['nombre'];
                $email = $muser['MobileUser']['email'];
                $lc = $muser['MobileUser']['locale'];
                $status = $muser['MobileUser']['status'];
            }            
            if($status != ''){
                if($status == 'A' || $status == 'V'){
                    if($this->request->data('nombre')!=NULL    && ($this->request->data('nombre'))!='')
                        $dataChurches['nombre'] = trim($this->request->data('nombre'));
                    if($this->request->data('direccion')!=NULL    && ($this->request->data('direccion'))!='')
                        $dataChurches['direccion'] = trim($this->request->data('direccion')); 
                    if($this->request->data('latitud')!=NULL    && ($this->request->data('latitud'))!='')
                        $dataChurches['latitud'] = $this->request->data('latitud');
                    if($this->request->data('longitud')!=NULL    && ($this->request->data('longitud'))!='')
                        $dataChurches['longitud'] = $this->request->data('longitud');
                    if($dataChurches['latitud']!=NULL && $dataChurches['longitud']!=NULL && $dataChurches['latitud']!='' && $dataChurches['longitud']!=''){
                        $dataChurches['country_id'] = $this->getCountry($dataChurches['latitud'] , $dataChurches['longitud']);
                    }

                    if ($this->request->data('email')!=NULL   && ($this->request->data('email'))!='')
                        $dataChurches['email'] = trim($this->request->data('email'));  
                    if ($this->request->data('telefonos')!=NULL && $this->request->data('telefonos')!='')
                        $dataChurches['telefonos']       = trim($this->request->data('telefonos'));

                    if( $this->request->data('observaciones')!=NULL && $this->request->data('observaciones')!='' )
                        $dataChurches['observaciones'] = trim($this->request->data('observaciones'));
                    if( $this->request->data('email')!=NULL && $this->request->data('email')!='' )
                        $dataChurches['email'] = trim($this->request->data('email'));
                    if( $this->request->data('comunidad')!=NULL && $this->request->data('comunidad')!='' )
                        $dataChurches['comunidad'] = trim($this->request->data('comunidad'));
                    if( $this->request->data('direccion_web')!=NULL && $this->request->data('direccion_web')!='' )
                        $dataChurches['direccion_web'] = trim($this->request->data('direccion_web'));
                    //if ($this->request->data('country_id')!=NULL    && ($this->request->data('country_id'))!='')
                      //  $dataChurches['country_id']      = trim($this->request->data('country_id'));

                    $this->loadModel('Church');
                    if( $this->Church->save($dataChurches) ){
                        $nombre = $this->getMessage($lc, 'dear').' '.$nombre;
                        $array_email = $email . ',info@amenapps.com';
                        $this->correo($nombre,$array_email,'','email_base', $this->getMessage($lc, 'edit-success-chr-2'),$this->getMessage($lc, 'email-edit-church'));
                        $this->Church->recursive = -1;
                        $data = $this->Church->findById($this->Church->id);
                        $success = true;
                        $message = $this->getMessage($lc, 'edit-success-chr');
                    }else{
                        $success = false;
                        $message = $this->getMessage($lc, 'add-error');
                    }
                }
                else{
                    $success = false;
                    $message = $this->getMessage($lc, 'active-error');
                }
            }
            else{
                $success = false;
                $message = $this->getMessage($lc, 'user-error');
            }          
        }else{
            $success = false;
            $message = $this->getMessage($lc, 'fields-error');
        }
        
        $response = array( 'success' => $success, 'message' => $message, 'data' => $data );
        $this->set( array('response' => $response, '_serialize' => array('response') ));
    }
    
    public function churches_view(){        
        
        $lc = 'es';
        if($this->request->data('locale')!=NULL    && ($this->request->data('locale'))!='')
            $lc = trim($this->request->data('locale'));
        
        
        $success = false;
        $message = $this->getMessage($lc, 'fields-error');
        $data = NULL;
        if($this->request->data('church_id')!=NULL   && $this->request->data('church_id')!=''){
            $church_id = $this->request->data('church_id');
            $this->loadModel('Church');
            $this->Church->recursive = -1;
            $data  = $this->Church->findById($church_id);
            $this->loadModel('Schedule');
            $this->Schedule->recursive = -1;
            $schedules = $this->Schedule->find('all',
                            array( 
                            'conditions'=>array(
                                'Schedule.church_id = '=>$church_id
                                ))
                            );
            if($schedules != NULL){
                for($i = 0; $i < count($schedules); $i++){
                    $data['Church']['Schedule'][] = $schedules[$i]['Schedule'];
                }
            }             
             
            if($data != NULL && $data !=''){
                $success = true;
                $message = $this->getMessage($lc, 'default-success');
            }
            else{
                $success = false;
                $message = $this->getMessage($lc, 'default-error');
            }
        }
        $response = array( 'success' => $success, 'message' => $message, 'data' => $data );
        $this->set( array('response' => $response, '_serialize' => array('response') ));
    }
    
    
    public function churches_list(){
        
        $lc = 'es';
        if($this->request->data('locale')!=NULL    && ($this->request->data('locale'))!='')
            $lc = trim($this->request->data('locale'));
        
        $success = false;
        $message = $this->getMessage($lc, 'fields-error');
        $data = NULL;
        if(($this->request->data('latitud')!=NULL   && $this->request->data('latitud')!='') &&    
            ($this->request->data('longitud')!=NULL   && ($this->request->data('longitud'))!='') ){
            $myLat = $this->request->data('latitud');
            $myLon = $this->request->data('longitud');
            
            $this->loadModel('Church');
            $this->Church->recursive = -1;
            $param = '';
            if($this->request->data('parameter')!=NULL && $this->request->data('parameter')!='')
                $param = $this->request->data('parameter');
            $radio = 20;
            if($this->request->data('radio')!=NULL && $this->request->data('radio')!='')
                $radio = $this->request->data('radio');
            
            $page = 1;
            $limit = 100;
            if (($this->request->data('page') != NULL && $this->request->data('page') != ''))
                $page = $this->request->data('page');
            if (($this->request->data('limit') != NULL && $this->request->data('page') != ''))
                $limit = $this->request->data('limit');
            $offset = ( ($page - 1) * $limit );            
            
            $this->Church->virtualFields['distancia'] = (
                'round(acos(sin(radians(Church.latitud)) * sin(radians('.$myLat.')) + 
                cos(radians(Church.latitud)) * cos(radians('.$myLat.')) * 
                cos(radians(Church.longitud) - radians('.$myLon.'))) * 6371 , 1)'
                        );
            $dataChurches  = $this->Church->find('all',
                array('fields'=>array(
                            'Church.id',
                            'Church.nombre',
                            'Church.latitud',
                            'Church.longitud',
                            'Church.direccion',
                            'Church.distancia'
                        ),
                    'conditions'=>array('Church.nombre like'=>'%'.$param.'%',
                            "(acos(sin(radians(Church.latitud)) * sin(radians(".$myLat.")) + 
                            cos(radians(Church.latitud)) * cos(radians(".$myLat.")) * 
                            cos(radians(Church.longitud) - radians(".$myLon."))) * 6371) <= ".$radio),
                    'order'=>'Church.distancia ASC',
                    'limit' => $limit,
                    'page' => $page,
                    'offset' => $offset
                ));
            if($dataChurches != NULL){
                $this->loadModel('Schedule');
                $this->Schedule->recursive = -1;
                $temp = '';
                
                $data = array();
                
                for($i = 0; $i < count($dataChurches); $i++){  
                    $church_id = $dataChurches[$i]['Church']['id'];
                    $data[$i]['Church'] = $dataChurches[$i]['Church'];
                    $schedule = $this->Schedule->find('first',
                            array('fields'=>array(
                                'Schedule.lunes',
                                'Schedule.martes',
                                'Schedule.miercoles',
                                'Schedule.jueves',
                                'Schedule.viernes',
                                'Schedule.sabado',
                                'Schedule.domingo',
                                'Schedule.festivos'), 
                            'conditions'=>array(
                                'Schedule.church_id = '=>$church_id,
                                'Schedule.schedule_type_id = '=>'1'
                                ))
                            );
                    if($schedule != NULL)
                        //$data[$i]['Church'] = $data[$i]['Church']+ $schedule['Schedule'];
                        $data[$i]['Church']['Schedule'] = $schedule['Schedule'];                    
                }                
            }
            if($data != NULL && $data !=''){
                $success = true;
                $message = $this->getMessage($lc, 'default-success');
            }
            else{
                $success = false;
                $message = $this->getMessage($lc, 'default-error');
            }
        }
        $response = array( 'success' => $success, 'message' => $message, 'data' => $data );
        $this->set( array('response' => $response, '_serialize' => array('response') ));
    }
        
    public function schedules_add(){
        $this->schedules_save('add');        
    }

    public function schedules_edit(){
        $this->schedules_save('edit'); 
    }

    private function schedules_save($action){
        
        $lc = 'es';
        if($this->request->data('locale')!=NULL    && ($this->request->data('locale'))!='')
            $lc = trim($this->request->data('locale'));
        
        $success = false;
        $message = $this->getMessage($lc, 'init');
        $data = NULL;          
        
        if( ($this->request->data('schedule_type_id')!=NULL   && $this->request->data('schedule_type_id')!='') &&    
            ($this->request->data('church_id')!=NULL   && ($this->request->data('church_id'))!='') 
        ){                                
            $dataSchedule = array();
            $dataSch = NULL;
            $this->loadModel('Schedule');
            $this->Schedule->recursive = -1;
            $schedule_type_id   = $this->request->data('schedule_type_id');
            $church_id = $this->request->data('church_id');

            $dataSch = $this->Schedule->find('first', array('conditions'=>array('Schedule.schedule_type_id'=>$schedule_type_id, 'Schedule.church_id'=>$church_id)));
              
            if($dataSch != NULL && $dataSch != ''){
                $dataSchedule['id'] = $dataSch['Schedule']['id'];
                $msg = 'edit-success-sch';
            }
            else{                      
                $dataSchedule['schedule_type_id']   = $this->request->data('schedule_type_id');
                $dataSchedule['church_id']       =$this->request->data('church_id'); 
                $msg = 'add-success-sch';
            }
            
            if ($this->request->data('lunes')!=NULL)
                $dataSchedule['lunes'] = trim($this->request->data('lunes'));
            if ($this->request->data('martes')!=NULL)
                $dataSchedule['martes'] = trim($this->request->data('martes'));
            if( $this->request->data('miercoles')!=NULL )
                $dataSchedule['miercoles'] = trim($this->request->data('miercoles'));
            if( $this->request->data('jueves')!=NULL)
                $dataSchedule['jueves'] = trim($this->request->data('jueves'));
            if( $this->request->data('viernes')!=NULL)
                $dataSchedule['viernes'] = trim($this->request->data('viernes'));
            if( $this->request->data('sabado')!=NULL)
                $dataSchedule['sabado'] = trim($this->request->data('sabado'));
            if( $this->request->data('domingo')!=NULL)
                $dataSchedule['domingo'] = trim($this->request->data('domingo'));
            if( $this->request->data('festivos')!=NULL)
                $dataSchedule['festivos'] = trim($this->request->data('festivos'));

            if( $this->Schedule->save($dataSchedule) ){
                $this->Schedule->recursive = -1;
                $data = $this->Schedule->findById($this->Schedule->id);
                $success = true;
                $message = $this->getMessage($lc, $msg);
            }else{
                $success = false;
                $message = $this->getMessage($lc, 'add-error');
            }
        }else{
            $success = false;
            $message = $this->getMessage($lc, 'fields-error');
        }
        
        $response = array( 'success' => $success, 'message' => $message, 'data' => $data );
        $this->set( array('response' => $response, '_serialize' => array('response') ));
    }
    
    public function musers_add(){
        $lc = 'es';  
        if($this->request->data('locale')!=NULL    && ($this->request->data('locale'))!='')
            $lc = trim($this->request->data('locale'));              
         
        $success = false;
        $message = $this->getMessage($lc, 'init');
        $data = NULL;
        $muserEmail = array();
        
        if( ($this->request->data('email')!=NULL   && ($this->request->data('email'))!='') &&
            ($this->request->data('nombre')!=NULL    && ($this->request->data('nombre'))!='') &&  
            //($this->request->data('apellido')!=NULL    && ($this->request->data('apellido'))!='') && 
            ($this->request->data('password')!=NULL   && $this->request->data('password')!='') &&
            ($this->request->data('mobileuser_profile_id')!=NULL   && $this->request->data('mobileuser_profile_id')!='') &&
            ($this->request->data('locale')!=NULL   && $this->request->data('locale')!='')        
            ){  
                $this->loadModel('MobileUser');
                $this->MobileUser->recursive = - 1;
                $muserEmail = $this->MobileUser->find( 'all', array('conditions' => array('MobileUser.email' => $this->request->data('email'))));
                
                if( $muserEmail!=NULL && count($muserEmail)>0 ){
                    $success = false;
                    $message = $this->getMessage($lc, 'user-warning');
                }else{
                    
                    $dataMobileUser = array();              
                    $dataMobileUser['email'] = $this->request->data('email');
                    $dataMobileUser['nombre'] = trim($this->request->data('nombre'));
                    //$dataMobileUser['apellido'] = trim($this->request->data('apellido'));  
                    $dataMobileUser['mobileuser_profile_id'] = $this->request->data('mobileuser_profile_id');
                    $dataMobileUser['locale'] = trim($this->request->data('locale'));
                    $dataMobileUser['status'] = 'I';
                    $dataMobileUser['password'] = $this->request->data('password');             
                    $sw_lat = '0';
                    $sw_lng = '0';
                    
                    if($this->request->data('latitud')!=NULL   && ($this->request->data('latitud'))!='' && $this->request->data('latitud')!= '0'){
                        $dataMobileUser['latitud'] = trim($this->request->data('latitud'));
                        $sw_lat = '1';
                    }
                    
                    if($this->request->data('longitud')!=NULL   && ($this->request->data('longitud'))!='' && $this->request->data('longitud')!= '0'){
                        $dataMobileUser['longitud'] = trim($this->request->data('longitud')); 
                        $sw_lng = '1';
                    }
                    
                    if($sw_lat != '0' && $sw_lng != '0')
                        $dataMobileUser['country_id'] = $this->getCountry ($dataMobileUser['latitud'], $dataMobileUser['longitud']);
                    
                    if($this->request->data('genero')!=NULL    && ($this->request->data('genero'))!='')
                        $dataMobileUser['gender'] = trim($this->request->data('genero'));
                    
                    if($this->request->data('fechanacimiento')!=NULL   && $this->request->data('fechanacimiento')!='')
                        $dataMobileUser['fechanacimiento'] = trim($this->request->data('fechanacimiento'));
                    
                    if($this->request->data('telefono')!=NULL   && $this->request->data('telefono')!='')
                        $dataMobileUser['telefono'] = trim($this->request->data('telefono'));
                    
                    if($this->request->data('comunidad')!=NULL   && $this->request->data('comunidad')!='')
                        $dataMobileUser['comunidad'] = trim($this->request->data('comunidad'));
                    
                    if($this->request->data('consagracion')!=NULL   && $this->request->data('consagracion')!='')
                        $dataMobileUser['consagracion'] = trim($this->request->data('consagracion'));
                    /*$city_id = $this->getCity($dataMobileUser['latitud'],$dataMobileUser['longitud']);
                    $dataMobileUser['city_id'] = '107'; 
                    if($this->request->data('city_id')!=NULL   && $this->request->data('city_id')!='')
                        $dataMobileUser['city_id'] = $this->request->data('city_id'); */                                        

                    if( $this->MobileUser->save($dataMobileUser) ){
                        
                        $mobile_user_id = $this->MobileUser->id;
                        $success = true;
                        $message = $this->getMessage($lc, 'register-success');
                        $dataM = NULL;
                        $status = 'I';
                        
                        //email para Ciro cada vez que se registre un religioso
                        if( $dataMobileUser['mobileuser_profile_id']=='2' ){//religioso
                            
                            $this->correo('Administrador Amen App', 'info@amenapps.com', '', 'email_base', 'Registro de religioso', 'Te informamos que un reglioso acaba de registrarse, por favor revisa el panel web para validarlo');
                        }
                        
                        if($this->request->data('login_with_facebook') != 'true'){
                            //$this->correo($dataMobileUser['nombre'], $dataMobileUser['email'], $mobile_user_id, 'email_confirm','Confirmación de correo AMEN','');
                            $nombre = $this->getMessage($lc, 'dear').' '.$dataMobileUser['nombre'];
                            $this->correo($nombre,$dataMobileUser['email'],$mobile_user_id,'email_confirm', $this->getMessage($lc, 'confirm-email-subject'),$this->getMessage($lc, 'confirm-message'));
                        
                        }else{
                            $status = 'A';
                            $msj = explode(".", $message);
                            $message =  $msj[0];
                        }

                        if( ($this->request->data('foto')!=NULL && trim($this->request->data('foto'))!='') ){

                            /*$maindir = ('files' . DS . 'mobile_user' . DS . 'foto' . DS);
                            $dir = ( $maindir . $mobile_user_id . DS );
                            $folder = new Folder($dir);
                            $folder->delete();*/

                            $file = str_replace(" ", "+", $this->request->data('foto'));
                            $ext = 'jpg';
                            $maindir = ('files' . DS . 'mobile_user' . DS . 'foto' . DS);
                            $dir = ( $maindir . $mobile_user_id . DS );

                            if (!is_dir($maindir))
                                mkdir($maindir);

                            if (!is_dir($dir))
                                mkdir($dir);

                            $nombrearchivo = date_format(new DateTime(), 'YmdHis');
                            $nombrearchivo = ( $nombrearchivo . '.' . $ext );

                            $guardarArchivo = fopen($dir.$nombrearchivo, 'w');
                            // Decodificar y guardar
                            fwrite($guardarArchivo, base64_decode($file));
                            fclose($guardarArchivo);

                            if( is_file($dir.$nombrearchivo) ){ 

                                $dataM = array(
                                    'id' => $mobile_user_id,
                                    'status' => $status,
                                    'foto' =>  FULL_BASE_URL . $this->webroot . $dir . $nombrearchivo
                                );
                                 $this->MobileUser->save($dataM); 
                                //$data = $dataMobileUser;
                                //$this->loadModel('MobileUser');
                                //$this->MobileUser->save($dataMobileUser);
                                {
                                    $im = imagecreatefromjpeg($dir . $nombrearchivo);
                                    $ox = imagesx($im);
                                    $oy = imagesy($im);
                                    $width = 66;
                                    $height = 42;
                                    $nx = $width;
                                    $ny = $height;
                                    $nm = imagecreatetruecolor($nx, $ny);
                                    imagecopyresized($nm, $im, 0,0,0,0,$nx,$ny,$ox,$oy);
                                    imagejpeg($nm, $dir . 'thumb_'.$nombrearchivo);
                                }

                                {
                                    $im = imagecreatefromjpeg($dir . $nombrearchivo);
                                    $ox = imagesx($im);
                                    $oy = imagesy($im);

                                    $width = 660;
                                    $height = 420;
                                    $nx = $width;
                                    $ny = $height;
                                    $nm = imagecreatetruecolor($nx, $ny);
                                    imagecopyresized($nm, $im, 0,0,0,0,$nx,$ny,$ox,$oy);
                                    imagejpeg($nm, $dir . 'vga_'.$nombrearchivo);

                                }
                            }
                            
                        }else{
                            $dataM = array(
                                'id' => $mobile_user_id,
                                'status' => $status
                            );
                            $this->MobileUser->save($dataM); 
                        }

                        $this->MobileUser->recursive = - 1;
                        $data = $this->MobileUser->findById($mobile_user_id);

                    }else{
                        $success = false;
                        $message = $this->getMessage($lc, 'add-error');
                    }
                    
                } 
            }else{
                $success = false;
                $message = $this->getMessage($lc, 'fields-error'). "; ".$this->getMessage($lc, 'required-fields-muser');
            }
        
        $response = array( 'success' => $success, 'message' => $message, 'data' => $data );
        $this->set( array('response' => $response, '_serialize' => array('response') ));
    }
    
    public function musers_view(){        
        $success = false;
        $message = 'No Id was received';
        $data = NULL;                
        if(($this->request->data('mobile_user_id')!=NULL && $this->request->data('mobile_user_id')!='') ){
            $this->loadModel('MobileUser');
            $this->MobileUser->recursive = -1;
                    $this->MobileUser->Behaviors->load('Containable');
                    $this->MobileUser->contain(array('City'));
            $this->MobileUser->virtualFields['city_name'] = 'City.nombre';
            $this->MobileUser->virtualFields['country_id'] = 'City.country_id';
            //$dataM = $this->MobileUser->find( 'first', array('conditions' => array('MobileUser.id' => $this->request->data('mobile_user_id')), 'fields'=>array('MobileUser.email','MobileUser.city_name', 'MobileUser.status','MobileUser.locale', 'City.nombre')));
            $dataM = $this->MobileUser->findById($this->request->data('mobile_user_id'));
            $data['MobileUser'] = $dataM['MobileUser'];
            if( $data!= NULL ){
                $success = true;
                $message = 'Info Data';
            }else{
                $success = false;
                $message = 'No results found.';
            }
        }       
        $response = array( 'success' => $success, 'message' => $message, 'data' => $data );
        $this->set( array('response' => $response, '_serialize' => array('response') ));
    }
    
    public function musers_edit(){        
        $success = false;
        $message = $this->getMessage('es', 'init');
        $data = NULL;  
        $lc = 'es';
        if( ($this->request->data('id')!=NULL   && ($this->request->data('id'))!='') 
            ){                     
                $this->loadModel('MobileUser');
                //$dataMuser = $this->MobileUser->find( 'all', array('conditions' => array('MobileUser.email' => $this->request->data('email'))));
                $dataMuser = array();
                $this->MobileUser->recursive = - 1;
                $dataMuser = $this->MobileUser->find( 'first', array('conditions' => array('MobileUser.id' => $this->request->data('id')), 'fields'=>array('MobileUser.email', 'MobileUser.status','MobileUser.locale')));
                $data = $dataMuser;                
                //$lc = $this->MobileUser->field('MobileUser.locale', array('MobileUser.id'=>$this->request->data('id')));            
                //$status = $this->MobileUser->field('MobileUser.status', array('MobileUser.id'=>$this->request->data('id')));            
                
                if( $dataMuser!=NULL && $dataMuser != '' && count($dataMuser)>0){
                    $status = $dataMuser['MobileUser']['status'];
                    $lc = $dataMuser['MobileUser']['locale'];
                    
                    if($status != ''){                        
                        if($status == 'A' || $status == 'V'){                            
                            $dataMobileUser = array(); 
                            $dataMobileUser['id'] = $this->request->data('id');
                            
                            if($this->request->data('tokenpush')!=NULL   && ($this->request->data('tokenpush'))!='')
                                $dataMobileUser['tokenpush'] = $this->request->data('tokenpush');

                            if($this->request->data('email')!=NULL   && $this->request->data('email')!='')
                                $dataMobileUser['email'] = trim($this->request->data('email'));

                            if($this->request->data('nombre')!=NULL   && $this->request->data('nombre')!='')
                                $dataMobileUser['nombre'] = trim($this->request->data('nombre'));

                            if($this->request->data('apellido')!=NULL   && $this->request->data('apellido')!='')
                                $dataMobileUser['apellido'] = trim($this->request->data('apellido'));

                            if($this->request->data('password')!=NULL   && $this->request->data('password')!='')
                                $dataMobileUser['password'] = $this->request->data('password');

                            if($this->request->data('genero')!=NULL   && $this->request->data('genero')!='')
                                $dataMobileUser['gender'] = trim($this->request->data('genero'));

                            if($this->request->data('fechanacimiento')!=NULL   && $this->request->data('fechanacimiento')!='')
                                $dataMobileUser['fechanacimiento'] = trim($this->request->data('fechanacimiento'));

                            $sw_lat = '0';
                            $sw_lng = '0';

                            if($this->request->data('latitud')!=NULL   && ($this->request->data('latitud'))!='' && $this->request->data('latitud')!= '0'){
                                $dataMobileUser['latitud'] = trim($this->request->data('latitud'));
                                $sw_lat = '1';
                            }

                            if($this->request->data('longitud')!=NULL   && ($this->request->data('longitud'))!='' && $this->request->data('longitud')!= '0'){
                                $dataMobileUser['longitud'] = trim($this->request->data('longitud')); 
                                $sw_lng = '1';
                            }
                                                             
                            if($sw_lat != '0' && $sw_lng != '0'){
                                $dataMobileUser['country_id'] = $this->getCountry ($dataMobileUser['latitud'], $dataMobileUser['longitud']);
                                //$dataMobileUser['localizadoxusuario'] = 'S';
                            }
                             
                            if($this->request->data('localizadoxusuario')!=NULL   && $this->request->data('localizadoxusuario')!='')
                                $dataMobileUser['localizadoxusuario'] = trim($this->request->data('localizadoxusuario'));
                            
                            //if($this->request->data('city_id')!=NULL   && $this->request->data('city_id')!='')
                            //  $dataMobileUser['city_id'] = trim($this->request->data('city_id'));   
                            
                            if(($this->request->data('locale')!=NULL   && $this->request->data('locale')!='')){
                                $dataMobileUser['locale'] = trim($this->request->data('locale'));
                                $lc = trim($this->request->data('locale'));
                            }                                

                            if($this->request->data('telefono')!=NULL   && $this->request->data('telefono')!='')
                                $dataMobileUser['telefono'] = trim($this->request->data('telefono'));

                            if($this->request->data('comunidad')!=NULL   && $this->request->data('comunidad')!='')
                                $dataMobileUser['comunidad'] = trim($this->request->data('comunidad'));

                            if($this->request->data('consagracion')!=NULL   && $this->request->data('consagracion')!='')
                                $dataMobileUser['consagracion'] = trim($this->request->data('consagracion'));


                            if( $this->MobileUser->save($dataMobileUser) ){

                                $mobile_user_id = $this->request->data('id');
                                $success = true;
                                $message = $this->getMessage($lc, 'edit-success-mus');

                                if( ($this->request->data('foto')!=NULL && trim($this->request->data('foto'))!='') ){

                                    $maindir = ('files' . DS . 'mobile_user' . DS . 'foto' . DS);
                                    $dir = ( $maindir . $mobile_user_id . DS );
                                    $folder = new Folder($dir);
                                    $folder->delete();

                                    $file = str_replace(" ", "+", $this->request->data('foto'));
                                    $ext = 'jpg';
                                    $maindir = ('files' . DS . 'mobile_user' . DS . 'foto' . DS);
                                    $dir = ( $maindir . $mobile_user_id . DS );

                                    if (!is_dir($maindir))
                                        mkdir($maindir);

                                    if (!is_dir($dir))
                                        mkdir($dir);

                                    $nombrearchivo = date_format(new DateTime(), 'YmdHis');
                                    $nombrearchivo = ( $nombrearchivo . '.' . $ext );

                                    $guardarArchivo = fopen($dir.$nombrearchivo, 'w');
                                    // Decodificar y guardar
                                    fwrite($guardarArchivo, base64_decode($file));
                                    fclose($guardarArchivo);

                                    if( is_file($dir.$nombrearchivo) ){

                                        //$this->loadModel('MobileUser');                                            
                                        //$this->MobileUser->setValidationRules('ws');                                           

                                        $dataMobileUser= NULL;
                                        $dataMobileUser = array(
                                            'id' => $mobile_user_id,
                                            'foto' =>  FULL_BASE_URL . $this->webroot . $dir . $nombrearchivo
                                        );
                                        //$data = $dataMobileUser;
                                        $this->MobileUser->save($dataMobileUser);

                                        {
                                            $im = imagecreatefromjpeg($dir . $nombrearchivo);
                                            $ox = imagesx($im);
                                            $oy = imagesy($im);
                                            $width = 66;
                                            $height = 42;
                                            $nx = $width;
                                            $ny = $height;
                                            $nm = imagecreatetruecolor($nx, $ny);
                                            imagecopyresized($nm, $im, 0,0,0,0,$nx,$ny,$ox,$oy);
                                            imagejpeg($nm, $dir . 'thumb_'.$nombrearchivo);
                                        }

                                        {
                                            $im = imagecreatefromjpeg($dir . $nombrearchivo);
                                            $ox = imagesx($im);
                                            $oy = imagesy($im);

                                            $width = 660;
                                            $height = 420;
                                            $nx = $width;
                                            $ny = $height;
                                            $nm = imagecreatetruecolor($nx, $ny);
                                            imagecopyresized($nm, $im, 0,0,0,0,$nx,$ny,$ox,$oy);
                                            imagejpeg($nm, $dir . 'vga_'.$nombrearchivo);

                                        }

                                    }                                    
                                }                             
                            $this->MobileUser->recursive = - 1;
                            /*$this->MobileUser->Behaviors->load('Containable');
                            $this->MobileUser->contain(array('City'));
                            $this->MobileUser->virtualFields['city_name'] = 'City.nombre';
                            $this->MobileUser->virtualFields['country_id'] = 'City.country_id';*/
                            $dataM = $this->MobileUser->findById($mobile_user_id);
                            $data['MobileUser'] = $dataM['MobileUser'];
                            }else{
                                $success = false;
                                $message = $this->getMessage($lc, 'edit-error');
                            }
                        }else{
                                $success = false;
                                $message = $this->getMessage($lc, 'active-error');
                        }
                        
                    }else{
                        $success = false;
                        $message = $this->getMessage($lc, 'user-error');
                    }                    
                }else{                    
                    $success = false;
                    $message = $this->getMessage($lc, 'default-error');
                }                            
        }else{
            $success = false;
            $message = $this->getMessage($lc, 'fields-error');
        }
            
        $response = array( 'success' => $success, 'message' => $message, 'data' => $data );
        $this->set( array('response' => $response, '_serialize' => array('response') ));
    }
    
    public function musers_login(){      
        
        $lc = 'es';
        if($this->request->data('locale')!=NULL    && ($this->request->data('locale'))!='')
            $lc = trim($this->request->data('locale'));
        
        $success = false;
        $message = $this->getMessage($lc, 'init');
        $data = NULL; 
        if( ($this->request->data('email')!=NULL && trim($this->request->data('email'))!='') &&
            ($this->request->data('password')!=NULL && trim($this->request->data('password'))!='')
         ){            
            $this->loadModel('MobileUser');
            $this->MobileUser->recursive = -1; //para quitar todas las clases asociadas 
            $this->MobileUser->Behaviors->load('Containable');
            $this->MobileUser->contain(array('City'));
            //$this->MobileUser->virtualFields['city_name'] = 'City.nombre';
            $muser = $this->MobileUser->find('first', 
                array(
                    'conditions' => array(
                        'MobileUser.email' => trim($this->request->data('email')),
                        'MobileUser.password' => trim($this->request->data('password'))
                      )
                )
            ); 
            if ($muser!=NULL && $muser['MobileUser']!=NULL) {  
                
                if($muser['MobileUser']['locale'] != '')
                    $lc = $muser['MobileUser']['locale'] ;                
                if ($muser['MobileUser']['status'] == 'A' || $muser['MobileUser']['status'] == 'V') {
                    $data['MobileUser'] = $muser['MobileUser'];
                    //$data['Favorite'] = $muser['Favorite'];
                    $this->loadModel('Favorite');
                    $this->Favorite->recursive = -1;
                    $fav = $this->Favorite->find('all', array('conditions'=>array('Favorite.mobile_user_id'=>$muser['MobileUser']['id'])));
                    $data['Favorites'] = $fav;
                    $success = true;
                    $message = $this->getMessage($lc, 'login-success');
                }
                else{
                    $success = false;
                    $message = $this->getMessage($lc, 'active-error');
                }    
                    
            } else {
                $success = false;
                $message = $this->getMessage($lc, 'login-error');
            }
            
        }else{
            $success = false;
            $message = $this->getMessage($lc, 'fields-error');
        }        
        $response = array( 'success' => $success, 'message' => $message, 'data' => $data );
        $this->set( array('response' => $response, '_serialize' => array('response') ));
    }

    public function musers_rememberpwd() {
        $success = false;
        $message = $this->getMessage('es', 'init');
        $data = NULL;
        $lc = $this->request->data('locale');
        if (($this->request->data('email') != NULL && $this->request->data('email') != '')) {
            $this->loadModel('MobileUser');
            $this->MobileUser->recursive = -1;
            $muser = $this->MobileUser->find('first', array('conditions' => array('MobileUser.email' => $this->request->data('email'))));            
            if ($muser!=NULL && $muser['MobileUser']!=NULL ) {                
                /*if ( strtoupper($muser['MobileUser']['status'])=='A'  ||  strtoupper($muser['MobileUser']['status'])=='V') {*/
                    try {
                        $this->correo($muser['MobileUser']['nombre'],$muser['MobileUser']['email'], $muser['MobileUser']['password'], 'email_rmpwd', 'RECORDATORIO DE DATOS','');
                        $success = true;
                        $message = $this->getMessage($lc, 'rmpwd-success');
                        
                    }catch(Exception $e){}                    
                /*} else {
                    $success = false;
                    $message =$this->getMessage($lc, 'active-error');
                }*/
            } else {
                $success = false;
                $message = $this->getMessage($lc, 'user-error');
            }
            
        } else {
            $success = false;
            $message = $this->getMessage($lc, 'fields-error');
        }

        $response = array('success' => $success, 'message' => $message, 'data' => $data);
        $this->set(array('response' => $response, '_serialize' => array('response')));
    }
      
    // busqueda por cuidad - antigua versión de conversación (Pregunta/Respuesta)
    public function conversations_question_by_city(){
        $success = false;
        $message = $this->getMessage('es','init');
        $data = NULL;
        if( ($this->request->data('sender_id')!=NULL && trim($this->request->data('sender_id'))!='') &&
            ($this->request->data('subject')!=NULL && trim($this->request->data('subject'))!='') &&
            ($this->request->data('private_question')!=NULL && trim($this->request->data('private_question'))!='')        
        ){  
            
            if($this->request->data('latitud')!=NULL && trim($this->request->data('latitud'))!='')
                $lat = $this->request->data('latitud');
            if ($this->request->data('longitud')!=NULL && trim($this->request->data('longitud'))!='')
                $lng = $this->request->data('longitud');
            
            $sender_id = $this->request->data('sender_id');
            $this->loadModel('MobileUser');
            $this->MobileUser->recursive = -1;
            $this->MobileUser->Behaviors->load('Containable');
            $this->MobileUser->contain(array('City'));
            $dataMuser = $this->MobileUser->find( 'first', array('conditions' => array('MobileUser.id' => $sender_id), 'fields'=>array('MobileUser.status','MobileUser.locale', 'MobileUser.city_id','City.country_id')));
            $status = '';
            if($dataMuser != NULL && $dataMuser != ''){
                $status = $dataMuser['MobileUser']['status'];
                $lc = $dataMuser['MobileUser']['locale'];
                $city_id = $dataMuser['MobileUser']['city_id'];
                $country_id = $dataMuser['City']['country_id'];
            }
            
            if($status != ''){
                if($status == 'A'){      
                    if( $city_id != NULL && $city_id != '' && $city_id != 0){
                        $this->MobileUser->recursive = -1;
                        $condition_token = array('MobileUser.tokenpush !='=>NULL, 'MobileUser.tokenpush !='=>'');
                        /*$religiuos_on_city = $this->MobileUser->find('all', array('conditions'=>array('MobileUser.city_id'=>$city_id,'MobileUser.mobileuser_profile_id'=>2, 'MobileUser.status' => 'A', $condition_token)));
                        if($religiuos_on_city == NULL || $religiuos_on_city == ''){
                            $this->loadModel('City');
                            $this->City->recursive = -1;
                            $idsCity = array();
                            $idsCity = $this->City->find('list',array('conditions'=>array('City.country_id'=>$country_id)));        
                            $religiuos_on_city = $this->MobileUser->find('all', array('conditions'=>array('MobileUser.city_id'=>$idsCity,'MobileUser.mobileuser_profile_id'=>2, 'MobileUser.status' => 'A', $condition_token)));
                        }*/
                        
                        $this->loadModel('Conversation');
                        $this->Conversation->recursive = -1;
                        $this->Conversation->Behaviors->load('Containable');
                        $this->Conversation->contain(array('Sender'));
                        //$no_disponibles = $this->Conversation->find('list',array('conditions'=>array('Conversation.status '=>'S', 'Sender.city_id'=>$city_id), 'fields'=>array('Conversation.receiver_id'))); 
                        //$dataReceivers = $this->MobileUser->find('all', array('conditions'=>array('MobileUser.id !='=>$no_disponibles ,'MobileUser.city_id'=>$city_id,'MobileUser.mobileuser_profile_id'=> 2, 'MobileUser.status' => 'A', $condition_token)));
                        //$message = 'por ciudad';
                        
                        //$no_disponibles = $this->Conversation->find('list',array('conditions'=>array('Conversation.status' => 'S', 'Sender.city_id'=>$city_id), 'fields'=>array('Conversation.receiver_id'),'group'=>array('Conversation.receiver_id HAVING COUNT(Conversation.status) >= 9'))); 
                        $no_disponibles = $this->Conversation->find('list',array('conditions'=>array('Conversation.status' => 'S', 'Sender.city_id'=>$city_id), 'fields'=>array('Conversation.receiver_id'),'group'=>array('Conversation.receiver_id'))); 
                        if ($no_disponibles != NULL && $no_disponibles != '')
                            $dataReceivers = $this->MobileUser->find('all', array('conditions'=>array('MobileUser.id !='=>$no_disponibles ,'MobileUser.city_id'=>$city_id,'MobileUser.mobileuser_profile_id'=>'2', 'MobileUser.status' => 'V',$condition_token)));
                        else
                            $dataReceivers = $this->MobileUser->find('all', array('conditions'=>array('MobileUser.city_id'=>$city_id,'MobileUser.mobileuser_profile_id'=>'2', 'MobileUser.status' => 'V',$condition_token)));
                        //$message = 'por ciudad';
                        $idsCity = array();
                        if($dataReceivers == NULL || $dataReceivers == '' || count($dataReceivers) == '0'){
                            $this->loadModel('City');
                            $this->City->recursive = -1;
                            //$idsCity = $this->City->find('list',array('conditions'=>array('City.country_id'=>$country_id)));        
                            $idsCity = $this->City->find('list',array('conditions'=>array('City.country_id'=>$country_id, 'City.prioridad'=>'1'), 'fields'=>array('City.id'))); 
                           //$this->Conversation->Behaviors->load('Containable');
                            //$this->Conversation->contain(array('Sender'));
                            //$no_disponibles = $this->Conversation->find('list',array('conditions'=>array('Conversation.status '=>'S', 'Sender.city_id'=>$idsCity), 'fields'=>array('Conversation.receiver_id'))); 
                            //$dataReceivers = $this->MobileUser->find('all', array('conditions'=>array('MobileUser.id !='=>$no_disponibles ,'MobileUser.city_id'=>$idsCity,'MobileUser.mobileuser_profile_id'=> 2, 'MobileUser.status' => 'A', $condition_token)));
                            /*
                            $no_disponibles = $this->Conversation->find('list',array('conditions'=>array('Conversation.status' => 'S', 'Sender.city_id'=>$idsCity), 'fields'=>array('Conversation.receiver_id'),'group'=>array('Conversation.receiver_id HAVING COUNT(Conversation.status) >= 9'))); 
                            if ($no_disponibles != NULL && $no_disponibles != '')
                                $dataReceivers = $this->MobileUser->find('all', array('conditions'=>array('MobileUser.id !='=>$no_disponibles ,'MobileUser.city_id'=>$idsCity,'MobileUser.mobileuser_profile_id'=>'2', 'MobileUser.status' => 'A',$condition_token)));
                            else*/
                                $dataReceivers = $this->MobileUser->find('all', array('conditions'=>array('MobileUser.city_id'=>$idsCity,'MobileUser.mobileuser_profile_id'=>'2', 'MobileUser.status' => 'V',$condition_token)));
                            //$message = 'por pais';
                        }

                        if($dataReceivers != NULL && $dataReceivers!=''){
                            /*$idsReligiuos = array();
                            $cont = 0;
                            for($i = 0; $i < count($religiuos_on_city); $i++ ){
                                $receiver_id = $religiuos_on_city[$i]['MobileUser']['id'];
                                $status_response = $this->Conversation->field('Conversation.status', array('Conversation.receiver_id'=>$receiver_id, 'Conversation.status'=>'S'));
                                if($status_response != 'S'){
                                    $idsReligiuos[$cont]['receiver_id'] = $receiver_id;
                                    $idsReligiuos[$cont]['tokenpush'] = $religiuos_on_city[$i]['MobileUser']['tokenpush'];
                                    $idsReligiuos[$cont]['locale'] = $religiuos_on_city[$i]['MobileUser']['locale'];
                                    $idsReligiuos[$cont]['email'] = $religiuos_on_city[$i]['MobileUser']['email'];
                                    $idsReligiuos[$cont]['nombre'] = $religiuos_on_city[$i]['MobileUser']['nombre'];
                                    if($religiuos_on_city[$i]['MobileUser']['consagracion'] != NULL && $religiuos_on_city[$i]['MobileUser']['email']!= '')
                                        $idsReligiuos[$cont]['nombre'] = $religiuos_on_city[$i]['MobileUser']['consagracion'].' '.$religiuos_on_city[$i]['MobileUser']['nombre'];
                                    
                                    $cont = $cont + 1;
                                }
                            }*/
                            $dataC= array();                  
                            $dataC['sender_id'] = $sender_id;
                            $dataC['status'] = 'S';
                            $dataC['subject'] = $this->request->data('subject'); 
                            $dataC['private_reply_sender'] = $this->request->data('private_question');

                            if($this->Conversation->save($dataC)){
                                $conversation_id = $this->Conversation->id;
                                $n = count($dataReceivers) - 1; 
                                $item = rand(0,$n);

                                CakePlugin::load('ParsePhpSdkMaster');
                                require_once(APP . 'Plugin' . DS . 'ParsePhpSdkMaster' . DS . 'autoload.php');
                                ParseClient::initialize('U43qtycLKALkP6cZpvdcOrwjk1xzs7N6ZONjtcWB', 'x16rTXzopkw5i2oQ8jVLUr6bh8sYf8kuBLqP7xLs', 'CCQiSDmFiJyCti2xv3NpCgB5cDNmLO6ZoQ439WYq');
                                ParseClient::setServerURL('https://parseapi.back4app.com', '/');
                                $dataPush = array(
                                    "alert" => $this->getMessage($dataReceivers[$item]['MobileUser']['locale'],'pushq-success'),
                                    "action" => "conversations_question",
                                    "conversation_id" => $conversation_id,
                                    "badge" => "Increment"
                                );
                                $queryPush = ParseInstallation::query();
                                $queryPush->equalTo("objectId",$dataReceivers[$item]['MobileUser']['tokenpush']);
                                ParsePush::send(array(
                                            "where" => $queryPush,
                                            "data" => $dataPush
                                ), true);                                    

                                $dataActC['id'] = $conversation_id;
                                $dataActC['receiver_id'] = $dataReceivers[$item]['MobileUser']['id'];
                                $this->Conversation->save($dataActC);

                                $hora = strftime("%I:%M %p", time()).' ';
                                $nombre_receiver = $dataReceivers[$item]['MobileUser']['nombre'];
                                if($dataReceivers[$item]['MobileUser']['consagracion'] != NULL && $dataReceivers[$item]['MobileUser']['consagracion']!= '')
                                    $nombre_receiver = $dataReceivers[$item]['MobileUser']['consagracion'].' '.$dataReceivers[$item]['MobileUser']['nombre'];
                                
                                //$this->correo($nombre_receiver,$dataReceivers[$item]['MobileUser']['email'],$hora,'email_question', $this->getMessage( $dataReceivers[$item]['MobileUser']['locale'], 'email-subject-q'),'' );
                                $locale = $dataReceivers[$item]['MobileUser']['locale'];
                                //$body = $this->getMessage($locale, 'email-body-q-1').' '.$hora.' '.$this->getMessage($locale, 'email-body-q-2');
                                $body = $this->getMessage($locale, 'email-body-q');
                                $body = str_replace('%time%', $hora, $body);
                                $this->correo($nombre_receiver,$dataReceivers[$item]['MobileUser']['email'],'','email_base', $this->getMessage($locale, 'email-subject-q'),$body);
                                
                                $success = true;
                                $message = $this->getMessage($lc, 'q-success');
                            }                                         
                            else{
                                $success = false;
                                $message = $this->getMessage($lc, 'q-error');
                            }              
                        }
                        else{
                            $success = false;
                            $message =$this->getMessage($lc, 'q-info1');
                        }
                    }
                    else{
                        $success = false;
                        $message = $this->getMessage($lc, 'location-error');
                    } 
                }else{
                    $success = false;
                    $message = $this->getMessage($lc, 'active-error');
                }
            }
            else{
                $success = false;
                $message = $this->getMessage($lc, 'user-error');
            }
        }
        else{
            $success = false;
            $message = $this->getMessage('es', 'fields-error');
        }
        $response = array( 'success' => $success, 'message' => $message, 'data' => $data );
        $this->set( array('response' => $response, '_serialize' => array('response') ));
    }
    
    //busqueda por gps - antigua version de conversación (pregunta/respuesta)
    public function conversations_question(){
        $success = false;
        $message = $this->getMessage('es','init');
        $data = NULL;
        if( ($this->request->data('sender_id')!=NULL && trim($this->request->data('sender_id'))!='') &&
            ($this->request->data('subject')!=NULL && trim($this->request->data('subject'))!='') &&
            ($this->request->data('private_question')!=NULL && trim($this->request->data('private_question'))!='')        
        ){  
            $lat ='0'; $lng = '0';
            /*if($this->request->data('latitud')!=NULL && trim($this->request->data('latitud'))!='')
                $lat = $this->request->data('latitud');
            if ($this->request->data('longitud')!=NULL && trim($this->request->data('longitud'))!='')
                $lng = $this->request->data('longitud');*/
            
            $sender_id = $this->request->data('sender_id');
            $this->loadModel('MobileUser');
            $this->MobileUser->recursive = -1;
            //$this->MobileUser->Behaviors->load('Containable');
            //$this->MobileUser->contain(array('City'));
            $dataMuser = $this->MobileUser->find( 'first', array('conditions' => array('MobileUser.id' => $sender_id), 'fields'=>array('MobileUser.status','MobileUser.locale', 'MobileUser.country_id','MobileUser.latitud','MobileUser.longitud')));
            $status = '';
            if($dataMuser != NULL && $dataMuser != ''){
                $status = $dataMuser['MobileUser']['status'];
                $lc = $dataMuser['MobileUser']['locale'];
                //$city_id = $dataMuser['MobileUser']['city_id'];
                $country_id = $dataMuser['MobileUser']['country_id'];
                $lat = $dataMuser['MobileUser']['latitud'];
                $lng = $dataMuser['MobileUser']['longitud'];
            }
            
            if($status != ''){
                if($status == 'A'){      
                    if($lat != '0' && $lng != '0' && $lat != '' && $lng != ''){
                        $condition_token = array('MobileUser.tokenpush !='=>NULL, 'MobileUser.tokenpush !='=>'');                      
                        $radio = '20';
                        $this->MobileUser->recursive = -1;
                        $this->MobileUser->virtualFields['distancia'] = (
                            'round(acos(sin(radians(MobileUser.latitud)) * sin(radians('.$lat.')) + 
                            cos(radians(MobileUser.latitud)) * cos(radians('.$lat.')) * 
                            cos(radians(MobileUser.longitud) - radians('.$lng.'))) * 6371 , 1)'
                                    );
                        $dataReceivers  = $this->MobileUser->find('all',
                            array('fields'=>array(
                                        'MobileUser.id',
                                        'MobileUser.nombre',
                                        'MobileUser.email',
                                        'MobileUser.latitud',
                                        'MobileUser.longitud',
                                        'MobileUser.tokenpush',
                                        'MobileUser.locale',
                                        'MobileUser.distancia',
                                        'MobileUser.consagracion'
                                    ),
                                'conditions'=>array('MobileUser.mobileuser_profile_id'=>'2',
                                        'MobileUser.status'=>'V',
                                        'MobileUser.latitud !='=>array('','0'),
                                        'MobileUser.longitud !='=>array('','0'),
                                        "(acos(sin(radians(MobileUser.latitud)) * sin(radians(".$lat.")) + 
                                        cos(radians(MobileUser.latitud)) * cos(radians(".$lat.")) * 
                                        cos(radians(MobileUser.longitud) - radians(".$lng."))) * 6371) <= ".$radio,
                                        $condition_token),
                                'order'=>'MobileUser.distancia ASC',
                            ));
                        $dataR = NULL;
                        if($dataReceivers != NULL && $dataReceivers != '' && count($dataReceivers) > 0){
                            $this->loadModel('Conversation');
                            $this->Conversation->recursive = -1;                            
                            foreach ( $dataReceivers as $receiver){
                                $status_response = $this->Conversation->field('Conversation.status', array('Conversation.receiver_id'=>$receiver['MobileUser']['id'], 'Conversation.status'=>'I'));
                                if($status_response != 'I'){
                                    //$message = $receiver['MobileUser']['nombre'].': '.$status_response;
                                    $dataR['MobileUser'] = $receiver['MobileUser'];
                                    break;
                                }
                            } 
                        }
                        if($dataR == NULL || $dataR == '' || count($dataR) == '0'){
                            $dataReceivers = $this->MobileUser->find('all', array('fields'=>array(
                                        'MobileUser.id',
                                        'MobileUser.nombre',
                                        'MobileUser.email',
                                        'MobileUser.latitud',
                                        'MobileUser.longitud',
                                        'MobileUser.tokenpush',
                                        'MobileUser.locale',
                                        'MobileUser.consagracion'
                                    ),'conditions'=>array(
                                        //'MobileUser.country_id'=>$country_id, /* solo los sacerdotes de ese pais pueden recibir */
                                        'MobileUser.mobileuser_profile_id'=>'2',
                                        'MobileUser.status' => 'V',
                                        $condition_token
                                    )));
                            $n = count($dataReceivers) - 1; 
                            $item = rand(0,$n);
                            $dataR['MobileUser'] = $dataReceivers[$item]['MobileUser'];
                            $message .= ' op2 ';
                        }                        
                        //$data = $dataReceivers;
                        if($dataR != NULL && $dataR!='' && count($dataR) > 0 ){                            
                            $dataC= array();                  
                            $dataC['sender_id'] = $sender_id;
                            $dataC['status'] = 'I';
                            $dataC['subject'] = $this->request->data('subject'); 
                            $dataC['private_reply_sender'] = $this->request->data('private_question');
                            $this->loadModel('Conversation');
                            if($this->Conversation->save($dataC)){
                                $conversation_id = $this->Conversation->id;

                                CakePlugin::load('ParsePhpSdkMaster');
                                require_once(APP . 'Plugin' . DS . 'ParsePhpSdkMaster' . DS . 'autoload.php');
                                ParseClient::initialize('U43qtycLKALkP6cZpvdcOrwjk1xzs7N6ZONjtcWB', 'x16rTXzopkw5i2oQ8jVLUr6bh8sYf8kuBLqP7xLs', 'CCQiSDmFiJyCti2xv3NpCgB5cDNmLO6ZoQ439WYq');
                                ParseClient::setServerURL('https://parseapi.back4app.com', '/');
                                $dataPush = array(
                                    "alert" => $this->getMessage($dataR['MobileUser']['locale'],'pushq-success'),
                                    "action" => "conversations_question",
                                    "conversation_id" => $conversation_id,
                                    "badge" => "Increment"
                                );
                                $queryPush = ParseInstallation::query();
                                $queryPush->equalTo("objectId",$dataR['MobileUser']['tokenpush']);
                                ParsePush::send(array(
                                            "where" => $queryPush,
                                            "data" => $dataPush
                                ), true);                                    

                                $dataActC['id'] = $conversation_id;
                                $dataActC['receiver_id'] = $dataR['MobileUser']['id'];
                                $this->Conversation->save($dataActC);

                                $hora = strftime("%I:%M %p", time()).' ';
                                $nombre_receiver = strtok($dataR['MobileUser']['nombre'], ' ');
                                if($dataR['MobileUser']['consagracion'] != NULL && $dataR['MobileUser']['consagracion']!= '')
                                    $nombre_receiver = $dataR['MobileUser']['consagracion'].' '. strtok($dataR['MobileUser']['nombre'], ' ');
                                
                                //$this->correo($nombre_receiver,$dataR['MobileUser']['email'],$hora,'email_question', $this->getMessage( $dataR['MobileUser']['locale'], 'email-subject-q'),'' );
                                $locale = $dataR['MobileUser']['locale'];
                                //$body = $this->getMessage($locale, 'email-body-q-1').' '.$hora.' '.$this->getMessage($locale, 'email-body-q-2');
                                $body = $this->getMessage($locale, 'email-body-q');
                                $body = str_replace('%time%', $hora, $body);
                                $this->correo($nombre_receiver,$dataR['MobileUser']['email'],'','email_base', $this->getMessage($locale, 'email-subject-q'),$body);
                                
                                $success = true;
                                $message = $this->getMessage($lc, 'q-success');
                            }                                         
                            else{
                                $success = false;
                                $message = $this->getMessage($lc, 'q-error');
                            }              
                        }
                        else{
                            $success = false;
                            $message =$this->getMessage($lc, 'q-info1');
                        }
                    }
                    else{
                        $success = false;
                        $message = $this->getMessage($lc, 'location-error');
                    } 
                }else{
                    $success = false;
                    $message = $this->getMessage($lc, 'active-error');
                }
            }
            else{
                $success = false;
                $message = $this->getMessage($lc, 'user-error');
            }
        }
        else{
            $success = false;
            $message = $this->getMessage('es', 'fields-error');
        }
        $response = array( 'success' => $success, 'message' => $message, 'data' => $data);
        $this->set( array('response' => $response, '_serialize' => array('response') ));
    }
    
    //antigua version de conversación (pregunta/respuesta)
    public function conversations_response(){
        $success = false;
        $message = $this->getMessage('es', 'init');
        $data = NULL;
        if( ($this->request->data('receiver_id')!=NULL && trim($this->request->data('receiver_id'))!='') &&
            ($this->request->data('conversation_id')!=NULL && trim($this->request->data('conversation_id'))!='') &&    
            ($this->request->data('reply')!=NULL && trim($this->request->data('reply'))!='')&&
            ($this->request->data('private_reply')!=NULL && trim($this->request->data('private_reply'))!='')    
        ){            
            /*$this->loadModel('MobileUser');
            $status = $this->MobileUser->field('MobileUser.status', array('MobileUser.id'=>$this->request->data('receiver_id')));            
            $lc = $this->MobileUser->field('MobileUser.locale', array('MobileUser.id'=>$this->request->data('receiver_id')));            */
            $receiver_id = $this->request->data('receiver_id');
            $this->loadModel('MobileUser');
             $this->MobileUser->recursive = -1;
            $dataMuser = $this->MobileUser->find( 'first', array('conditions' => array('MobileUser.id' => $receiver_id), 'fields'=>array('MobileUser.status','MobileUser.locale')));
            $status = '';
            if($dataMuser != NULL && $dataMuser != ''){
                $status = $dataMuser['MobileUser']['status'];
                $lc = $dataMuser['MobileUser']['locale'];
            }
            
            if($status != ''){
                if($status == 'V'){
                    
                    $conversation_id = $this->request->data('conversation_id');
                    $this->loadModel('Conversation');
                    $this->Conversation->recursive = -1;
                    $dataConversation = $this->Conversation->findById($conversation_id);
                    $sender_id = $dataConversation['Conversation']['sender_id'];
                   
                    $dataSender = $this->MobileUser->find('first',
                            array('fields'=>array(
                                    'MobileUser.tokenpush',
                                    'MobileUser.email',
                                    'MobileUser.nombre'), 
                                    'conditions'=>array(
                                        'MobileUser.id = '=>$sender_id
                                        ))
                            );
                    //$tokenpush = $this->MobileUser->field('MobileUser.tokenpush', array('MobileUser.id'=>$sender_id));            
                    $tokenpush = $dataSender['MobileUser']['tokenpush'];
                    $emailSender = $dataSender['MobileUser']['email'];
                    $nombreSender = $dataSender['MobileUser']['nombre'];
                    
                    if($tokenpush != NULL && $tokenpush != '') {
                        $datetime1 = $dataConversation['Conversation']['modified'];
                        $datetime2 = date('Y-m-d H:i:s');
                        $minutos = ceil((strtotime($datetime2)-strtotime($datetime1))/60 );
                        if($dataConversation['Conversation']['status'] != 'R' /*&& $minutos < 60*/){
                            $dataC = array();     
                            $dataC['id'] = $conversation_id;
                            $dataC['receiver_id'] = $receiver_id;
                            $dataC['private_reply_receiver'] = $this->request->data('private_reply');
                            $dataC['status'] = 'R';
                            $dataC['last_reply'] = $this->request->data('reply');
                            if($this->Conversation->save($dataC)){

                                CakePlugin::load('ParsePhpSdkMaster');
                                require_once(APP . 'Plugin' . DS . 'ParsePhpSdkMaster' . DS . 'autoload.php');
                                ParseClient::initialize('U43qtycLKALkP6cZpvdcOrwjk1xzs7N6ZONjtcWB', 'x16rTXzopkw5i2oQ8jVLUr6bh8sYf8kuBLqP7xLs', 'CCQiSDmFiJyCti2xv3NpCgB5cDNmLO6ZoQ439WYq');
                                ParseClient::setServerURL('https://parseapi.back4app.com', '/');
                                $dataPush = array(
                                    "alert" => $this->getMessage($lc,'pushr-success'),
                                    "action" => "conversations_response",
                                    "conversation_id" => $conversation_id,
                                    "badge" => "Increment"
                                );
                                $queryPush = ParseInstallation::query();
                                $queryPush->equalTo("objectId",$tokenpush);
                                ParsePush::send(array(
                                            "where" => $queryPush,
                                            "data" => $dataPush
                                ), true); 
                                //$this->correo($nombreSender,$emailSender,'','email_response', $this->getMessage($lc, 'email-subject-r') ,'');
                                $this->correo($nombreSender,$emailSender,'','email_base', $this->getMessage($lc, 'email-subject-r'),$this->getMessage($lc, 'email-body-r'));
                                $success = true;
                                $message = $this->getMessage($lc, 'r-success');                   
                            }
                            else{
                                $success = false;
                                $message = $this->getMessage($lc, 'r-error');
                            }
                        }
                        else{
                            $success = false;
                            $message = $this->getMessage($lc, 'r-warning');
                        } 
                    }
                    else{
                        $success = false;
                        $message = $this->getMessage($lc, 'active-error');
                    }                        
                }else{
                    $success = false;
                    $message = $this->getMessage($lc, 'active-error');
                }
            }
            else{
                $success = false;
                $message = $this->getMessage($lc, 'user-error');
            }
        }
        else{
            $success = false;
            $message = $this->getMessage('es', 'fields-error');
        }
        $response = array( 'success' => $success, 'message' => $message, 'data' => $data );
        $this->set( array('response' => $response, '_serialize' => array('response') ));
    }
    
    // nueva version de conversación (tipo chat)
    public function conversations_messages(){
        $success = false;
        $message = $this->getMessage('es','init');
        $data = NULL;
        if( ($this->request->data('mobile_user_id')!=NULL && trim($this->request->data('mobile_user_id'))!='') &&
            ($this->request->data('message')!=NULL && trim($this->request->data('message'))!='') &&
            ($this->request->data('private_message')!=NULL && trim($this->request->data('private_message'))!='') 

        ){  
            $lat ='0'; $lng = '0';
            /*if($this->request->data('latitud')!=NULL && trim($this->request->data('latitud'))!='')
                $lat = $this->request->data('latitud');
            if ($this->request->data('longitud')!=NULL && trim($this->request->data('longitud'))!='')
                $lng = $this->request->data('longitud');*/
            $conversation_id = '0';
            if($this->request->data('conversation_id')!=NULL && trim($this->request->data('conversation_id'))!='')
                $conversation_id =  trim($this->request->data('conversation_id'));      
            
            $muser_id = $this->request->data('mobile_user_id');
            $this->loadModel('MobileUser');
            $this->MobileUser->recursive = -1;
            //$this->MobileUser->Behaviors->load('Containable');
            //$this->MobileUser->contain(array('City'));
            $dataMuser = $this->MobileUser->find( 'first', array('conditions' => array('MobileUser.id' => $muser_id), 'fields'=>array('MobileUser.status','MobileUser.locale', 'MobileUser.country_id','MobileUser.latitud','MobileUser.longitud')));
            $status = '';
            if($dataMuser != NULL && $dataMuser != ''){
                $status = $dataMuser['MobileUser']['status'];
                $lc = $dataMuser['MobileUser']['locale'];
                //$city_id = $dataMuser['MobileUser']['city_id'];
                $country_id = $dataMuser['MobileUser']['country_id'];
                $lat = $dataMuser['MobileUser']['latitud'];
                $lng = $dataMuser['MobileUser']['longitud'];
            }
                                        
            $dataC= array(); 
            $dataR = array();
            if($status != ''){
                if($status == 'A' || $status == 'V'){
                    $text_push_success = 'pushq-success';
                    if($conversation_id == 0){
                        if($lat != '0' && $lng != '0' && $lat != '' && $lng != ''){
                            $condition_token = array('MobileUser.tokenpush !='=>NULL, 'MobileUser.tokenpush !='=>'');                      
                            $radio = '20';
                            $this->MobileUser->recursive = -1;
                            $this->MobileUser->virtualFields['distancia'] = (
                                'round(acos(sin(radians(MobileUser.latitud)) * sin(radians('.$lat.')) + 
                                cos(radians(MobileUser.latitud)) * cos(radians('.$lat.')) * 
                                cos(radians(MobileUser.longitud) - radians('.$lng.'))) * 6371 , 1)'
                                        );
                            $dataReceivers  = $this->MobileUser->find('all',
                                array('fields'=>array(
                                            'MobileUser.id',
                                            'MobileUser.nombre',
                                            'MobileUser.email',
                                            'MobileUser.latitud',
                                            'MobileUser.longitud',
                                            'MobileUser.tokenpush',
                                            'MobileUser.locale',
                                            'MobileUser.distancia',
                                            'MobileUser.consagracion',
                                            'MobileUser.mobileuser_profile_id'
                                        ),
                                    'conditions'=>array('MobileUser.mobileuser_profile_id'=>'2',
                                            'MobileUser.status'=>'V',
                                            'MobileUser.locale'=>$lc,
                                            'MobileUser.latitud !='=>array('','0'),
                                            'MobileUser.longitud !='=>array('','0'),
                                            "(acos(sin(radians(MobileUser.latitud)) * sin(radians(".$lat.")) + 
                                            cos(radians(MobileUser.latitud)) * cos(radians(".$lat.")) * 
                                            cos(radians(MobileUser.longitud) - radians(".$lng."))) * 6371) <= ".$radio,
                                            $condition_token),
                                    'order'=>'MobileUser.distancia ASC',
                                ));
                            $dataR = NULL;
                            if($dataReceivers != NULL && $dataReceivers != '' && count($dataReceivers) > 0){
                                $this->loadModel('Conversation');
                                $this->Conversation->recursive = -1;                            
                                foreach ( $dataReceivers as $receiver){
                                    $status_response = $this->Conversation->field('Conversation.status', array('Conversation.receiver_id'=>$receiver['MobileUser']['id'], 'Conversation.status'=>'I'));
                                    if($status_response != 'I'){
                                        //$message = $receiver['MobileUser']['nombre'].': '.$status_response;
                                        $dataR['MobileUser'] = $receiver['MobileUser'];
                                        break;
                                    }
                                } 
                            }
                            if($dataR == NULL || $dataR == '' || count($dataR) == '0'){
                                $dataReceivers = $this->MobileUser->find('all', array('fields'=>array(
                                            'MobileUser.id',
                                            'MobileUser.nombre',
                                            'MobileUser.email',
                                            'MobileUser.latitud',
                                            'MobileUser.longitud',
                                            'MobileUser.tokenpush',
                                            'MobileUser.locale',
                                            'MobileUser.consagracion',
                                            'MobileUser.mobileuser_profile_id'
                                        ),'conditions'=>array(
                                            //'MobileUser.country_id'=>$country_id, /* solo los sacerdotes de ese pais pueden recibir */
                                            'MobileUser.locale'=>$lc, /* solo los sacerdotes que tengan el mismo locale */
                                            'MobileUser.mobileuser_profile_id'=>'2',
                                            'MobileUser.status' => 'V',
                                            $condition_token
                                        )));
                                $n = count($dataReceivers) - 1; 
                                $item = rand(0,$n);
                                $dataR['MobileUser'] = $dataReceivers[$item]['MobileUser'];
                                $message .= ' op2 ';
                            }                        
                            //$data = $dataReceivers;
                            if($dataR != NULL && $dataR!='' && count($dataR) > 0 ){                 
                                $dataC['sender_id'] = $muser_id;
                                $dataC['receiver_id'] = $dataR['MobileUser']['id'];
                                $dataC['status'] = 'I';
                                $dataC['subject'] = trim($this->request->data('message')); 
                                $dataC['private_reply_sender'] = $this->request->data('private_message');
                                             
                            }
                            else{
                                $success = false;
                                $message =$this->getMessage($lc, 'q-info1');
                            }
                        }
                        else{
                            $success = false;
                            $message = $this->getMessage($lc, 'location-error');
                        }
                    }else{

                        $this->loadModel('Conversation');
                        $this->Conversation->recursive = -1;
                        $dataConversation = $this->Conversation->findById($conversation_id);

                        $this->loadModel('MobileUser');
                        $this->MobileUser->recursive = -1;
                        if($dataConversation['Conversation']['sender_id'] == $muser_id){
                            $dataC['status'] = 'S';
                            $dataC['private_reply_sender'] = $this->request->data('private_message');
                            $dataR = $this->MobileUser->findById($dataConversation['Conversation']['receiver_id']);
                           
                        }
                        else{
                            $dataC['status'] = 'R';
                            $dataC['private_reply_receiver'] = $this->request->data('private_message');
                            $dataR = $this->MobileUser->findById($dataConversation['Conversation']['sender_id']);
                            
                            $text_push_success = 'pushr-success';
                        }

                        $dataC['id'] = $conversation_id;
                        $dataC['last_reply'] =  trim($this->request->data('message'));
                        
                    }

                    $this->loadModel('Conversation');
                    if($this->Conversation->save($dataC)){
                        $conversation_id = $this->Conversation->id;
                        $dataMessage = array();
                        $dataMessage['conversation_id'] = $conversation_id;
                        $dataMessage['reply'] = trim($this->request->data('message'));
                        $dataMessage['mobile_user_id'] = $muser_id;
                        $this->loadModel('Message');
                        if($this->Message->save($dataMessage)){
                            $data = $dataMessage;
                            $success = true;
                            $message = $this->getMessage($lc, 'message-success');
                        }
                        else{
                            $success = false;
                            $message = $this->getMessage($lc, 'q-error');
                        }

                        CakePlugin::load('ParsePhpSdkMaster');
                        require_once(APP . 'Plugin' . DS . 'ParsePhpSdkMaster' . DS . 'autoload.php');
                        ParseClient::initialize('U43qtycLKALkP6cZpvdcOrwjk1xzs7N6ZONjtcWB', 'x16rTXzopkw5i2oQ8jVLUr6bh8sYf8kuBLqP7xLs', 'CCQiSDmFiJyCti2xv3NpCgB5cDNmLO6ZoQ439WYq');
                        ParseClient::setServerURL('https://parseapi.back4app.com', '/');
                        $dataPush = array(
                            "alert" => $this->getMessage($dataR['MobileUser']['locale'],$text_push_success),
                            "action" => "conversations_messages",
                            "conversation_id" => $conversation_id,
                            "badge" => "Increment"
                        );
                        $queryPush = ParseInstallation::query();
                        $queryPush->equalTo("objectId",$dataR['MobileUser']['tokenpush']);
                        ParsePush::send(array(
                                    "where" => $queryPush,
                                    "data" => $dataPush
                        ), true);
                        
                        
                        $nombre = strtok($dataR['MobileUser']['nombre'], ' ');
                        $email = $dataR['MobileUser']['email'];
                        $locale = $dataR['MobileUser']['locale'];
                        if($dataR['MobileUser']['mobileuser_profile_id'] == '2'){
                            $hora = strftime("%I:%M %p", time()).' ';
                            if($dataR['MobileUser']['consagracion'] != NULL && $dataR['MobileUser']['consagracion']!= '')
                                $nombre = $dataR['MobileUser']['consagracion'].' '. $nombre;

                            //$this->correo($nombre,$email,$hora,'email_question', $this->getMessage( $locale, 'email-subject-q'),'' );
                                //$body = $this->getMessage($locale, 'email-body-q-1').' '.$hora.' '.$this->getMessage($locale, 'email-body-q-2');
                                $body = $this->getMessage($locale, 'email-body-q');
                                $body = str_replace('%time%', $hora, $body);
                                $this->correo($nombre,$email,'','email_base', $this->getMessage($locale, 'email-subject-q'),$body);
                        }else{
                            //$this->correo($nombre,$email,'','email_response', $this->getMessage($dataR['MobileUser']['locale'], 'email-subject-r') ,'');  
                            $this->correo($nombre,$email,'','email_base', $this->getMessage($locale, 'email-subject-r'),$this->getMessage($locale, 'email-body-r'));
                        }    
                            

                        //$success = true;
                        //$message = $this->getMessage($lc, 'q-success');
                    }                                         
                    else{
                        $success = false;
                        $message = $this->getMessage($lc, 'q-error');
                    }       
             
                }else{
                    $success = false;
                    $message = $this->getMessage($lc, 'active-error');
                }
            }
            else{
                $success = false;
                $message = $this->getMessage($lc, 'user-error');
            }
        }
        else{
            $success = false;
            $message = $this->getMessage('es', 'fields-error');
        }
        $response = array( 'success' => $success, 'message' => $message, 'data' => $data);
        $this->set( array('response' => $response, '_serialize' => array('response') ));
    }
    
    public function conversations_view(){
        $success = false;
        $message = $this->getMessage('es','init');
        $data = NULL;
        if( ($this->request->data('conversation_id')!=NULL && trim($this->request->data('conversation_id'))!='') &&
            ($this->request->data('mobile_user_id')!=NULL && trim($this->request->data('mobile_user_id'))!='')
        ){  
            /*$this->loadModel('MobileUser');
            $status = $this->MobileUser->field('MobileUser.status', array('MobileUser.id'=>$this->request->data('mobile_user_id')));            
            $lc = $this->MobileUser->field('MobileUser.locale', array('MobileUser.id'=>$this->request->data('mobile_user_id'))); */
            $muser_id = $this->request->data('mobile_user_id');
            $this->loadModel('MobileUser');
            $dataMuser = $this->MobileUser->find( 'first', array('conditions' => array('MobileUser.id' => $muser_id), 'fields'=>array('MobileUser.status','MobileUser.locale')));
            $status = $dataMuser['MobileUser']['status'];
            $lc = $dataMuser['MobileUser']['locale'];
            if($status != ''){
                if($status == 'A' || $status == 'V'){
                    $conversation_id = $this->request->data('conversation_id');
                    $this->loadModel('Conversation');
                    $this->Conversation->recursive = -1;
                    $this->Conversation->Behaviors->load('Containable');
                    $this->Conversation->contain(array('Sender', 'Receiver'));
                    $dataC = $this->Conversation->findById($conversation_id); 
                    /*
                    //$muser_id = $this->request->data('mobile_user_id');
                    $this->MobileUser->recursive = -1;
                    $dataM = $this->MobileUser->findById($muser_id);
                    if ($dataC['Conversation']['sender_id'] == $muser_id){
                        $dataM = $this->MobileUser->findById($dataC['Conversation']['receiver_id']);
                    }
                    else{
                        $dataM = $this->MobileUser->findById($dataC['Conversation']['sender_id']);
                    }                        
                    $dataC['MobileUser'] = $dataM['MobileUser'];*/
                    if($dataC != NULL && $dataC['Conversation'] != NULL){
                        $success = true;
                        $message = $this->getMessage($lc, 'default-success');
                        $data = $dataC;                   
                    }
                    else{
                        $success = false;
                        $message = $this->getMessage($lc, 'default-error');
                    } 
                }else{
                    $success = false;
                    $message = $this->getMessage($lc, 'active-error');
                }
            }
            else{
                $success = false;
                $message = $this->getMessage($lc, 'user-error');
            }           
        }
        else{
            $success = false;
            $message = $this->getMessage('es', 'fields-error');
        }
        $response = array( 'success' => $success, 'message' => $message, 'data' => $data );
        $this->set( array('response' => $response, '_serialize' => array('response') ));
    }    
    
    public function conversations_list(){
        $success = false;
        $message = $this->getMessage('es', 'init');
        $data = NULL;
        if( ($this->request->data('mobile_user_id')!=NULL && trim($this->request->data('mobile_user_id'))!='')){
            
            $mobile_user_id =$this->request->data('mobile_user_id');            
            $this->loadModel('MobileUser');
            $this->MobileUser->recursive = -1;
            //$status = $this->MobileUser->field('MobileUser.status', array('MobileUser.id'=>$mobile_user_id));            
            //$muser_profile_id = $this->MobileUser->field('MobileUser.mobileuser_profile_id', array('MobileUser.id'=>$mobile_user_id));
            //$lc = $this->MobileUser->field('MobileUser.locale', array('MobileUser.id'=>$mobile_user_id));            
            $dataMuser = $this->MobileUser->find( 'first', array('conditions' => array('MobileUser.id' => $mobile_user_id), 'fields'=>array('MobileUser.status','MobileUser.locale','MobileUser.mobileuser_profile_id','MobileUser.latitud', 'MobileUser.longitud')));
            $status = '';
            if($dataMuser != NULL && $dataMuser != ''){
                $status = $dataMuser['MobileUser']['status'];
                $lc = $dataMuser['MobileUser']['locale'];
                $muser_profile_id = $dataMuser['MobileUser']['mobileuser_profile_id'];
                $lat = $dataMuser['MobileUser']['latitud'];
                $lng = $dataMuser['MobileUser']['longitud'];
            }                        
            
            $this->loadModel('Conversation');            
            $this->Conversation->recursive = -1;
            $this->Conversation->Behaviors->load('Containable');
            $this->Conversation->contain(array('Sender', 'Receiver'));
            /*if ($muser_profile_id == 1)
                $this->Conversation->contain(array('Receiver'));
            else
                $this->Conversation->contain(array('Sender'));*/
            
            if($status != ''){
                if($status == 'A' || $status == 'V'){
                    $page = 1;
                    $limit = 10;
                    if (($this->request->data('page') != NULL && $this->request->data('page') != ''))
                        $page = $this->request->data('page');
                    if (($this->request->data('limit') != NULL && $this->request->data('page') != ''))
                        $limit = $this->request->data('limit');
                    $offset = ( ($page - 1) * $limit );  
                    
                    if($muser_profile_id == '1')
                        $condition_status = array('T', 'TS');
                    else
                        $condition_status = array('T', 'TR');
                    
                    $dataConversations = $this->Conversation->find('all', 
                        array(
                            'conditions'=>array('Conversation.status !=' => $condition_status, 
                            'or'=>array('Conversation.sender_id '=>$mobile_user_id,'Conversation.receiver_id '=>$mobile_user_id)
                             ),
                            'order'=>'Conversation.modified DESC',
                            'limit' => $limit,
                            'page' => $page,
                            'offset' => $offset
                    ));        
                    if ($dataConversations!=NULL) {                
                        $data = $dataConversations;
                        $success = true;
                        $message = $this->getMessage($lc, 'default-success');                                              
                    } else {
                        $success = false;
                        
                        $message = $this->getMessage($lc, 'nochats-found-f');
                        if($muser_profile_id == '2'){
                            $message = $this->getMessage($lc, 'location-error');
                            if($lat != '0' && $lng != '0' && $lat != '' && $lng != ''){
                                $message = $this->getMessage($lc, 'nochats-found-r');
                            }
                        }
                            
                    }
                }else{
                    $success = false;
                    $message = $this->getMessage($lc, 'active-error');
                }
            }
            else{
                $success = false;
                $message = $this->getMessage($lc, 'user-error');
            }     
        }
        $response = array( 'success' => $success, 'message' => $message, 'data' => $data );
        $this->set( array('response' => $response, '_serialize' => array('response') ));
    }
    
    public function conversations_finish(){
        $success = false;
        $message = $this->getMessage('es', 'init').'¡';
        $data = NULL;
        if( ($this->request->data('mobile_user_id')!=NULL && trim($this->request->data('mobile_user_id'))!='') &&
            ($this->request->data('conversation_id')!=NULL && trim($this->request->data('conversation_id'))!='')
        ){
            
            $disable_messages = false;
            if($this->request->data('disable_messages')!=NULL && trim($this->request->data('disable_messages'))!='')
                $disable_messages = $this->request->data('disable_messages');
            
            
            $conversation_id =$this->request->data('conversation_id');
            $this->loadModel('Conversation');
            $this->Conversation->recursive = -1;
            $status_c = $this->Conversation->field('Conversation.status', array('Conversation.id'=>$conversation_id));
            
            $mobile_user_id =$this->request->data('mobile_user_id');
            $this->loadModel('MobileUser');
            $this->MobileUser->recursive = -1;
            //$status_u = $this->MobileUser->field('MobileUser.status', array('MobileUser.id'=>$mobile_user_id));            
            //$lc = $this->MobileUser->field('MobileUser.locale', array('MobileUser.id'=>$mobile_user_id));            
            //$muser_profile_id = $this->MobileUser->field('MobileUser.mobileuser_profile_id', array('MobileUser.id'=>$mobile_user_id));            
            $status_u = '';
            $muser_profile_id = '';
            $dataMuser = $this->MobileUser->find('first', array('conditions' => array('MobileUser.id' => $mobile_user_id), 'fields'=>array('MobileUser.status','MobileUser.locale','MobileUser.mobileuser_profile_id')));
            if($dataMuser != NULL && $dataMuser != ''){
                $status_u = $dataMuser['MobileUser']['status'];
                $lc = $dataMuser['MobileUser']['locale'];
                $muser_profile_id = $dataMuser['MobileUser']['mobileuser_profile_id'];
            }                          
            
            if($status_u != ''){
                if($status_u == 'A' || $status_u == 'V'){
                    if($status_c != 'I'){
                        $dataC = array(); 
                        $sw_delete = '0';
                        $dataC['id'] = $conversation_id;
                        
                        if($status_c == 'TS' || $status_c == 'TR'){
                            $this->Conversation->id = $conversation_id;
                            if($this->Conversation->delete()){
                                $sw_delete = '1';
                            }
                        }
                        else{
                             $sw_delete = '1';
                            if($muser_profile_id == '1')
                                $dataC['status'] = 'TS';
                            else{
                                if($disable_messages || $disable_messages === 'true'){
                                    $dataC['status'] = 'D';
                                    $sw_delete = '2';
                               
                                }else{
                                    $dataC['status'] = 'TR';
                                }                            
                            }
                            if($this->Conversation->save($dataC)){
                            }
                        }
                        switch ($sw_delete) {    
                            case '1':
                                $success = true;
                                $message = $this->getMessage($lc, 'delete-success');
                            break;
                            case '2':
                                $success = true;
                                $message = $this->getMessage($lc, 'enable-success');
                            break;
                            default:
                                $success = false;
                                $message = $this->getMessage($lc, 'delete-error');
                            break;
                        } 
                    }
                    else{
                        $success = false;
                        $message = $this->getMessage($lc, 'no-answered');
                    }
                }
                else{
                    $success = false;
                    $message = $this->getMessage($lc, 'active-error');
                }
            }
            else{
                $success = false;
                $message = $this->getMessage($lc, 'user-error');
            }
        }
        $response = array( 'success' => $success, 'message' => $message, 'data' => $data );
        $this->set( array('response' => $response, '_serialize' => array('response') ));
    }
    
    public function messages_list(){
        $success = false;
        $message = $this->getMessage('es', 'init');
        $data = NULL;
        $lc = 'es';
        if( ($this->request->data('conversation_id')!=NULL && trim($this->request->data('conversation_id'))!='') &&
            ($this->request->data('mobile_user_id') != NULL && $this->request->data('mobile_user_id') != '')    
        ){
           
            $conversation_id =$this->request->data('conversation_id');            
            $this->loadModel('Message');
            $this->Message->recursive = -1;
            $this->Message->Behaviors->load('Containable');
            $this->Message->contain(array('MobileUser'));
            $page = 1;
            $limit = 10;
            if (($this->request->data('page') != NULL && $this->request->data('page') != ''))
                $page = $this->request->data('page');
            if (($this->request->data('limit') != NULL && $this->request->data('page') != ''))
                $limit = $this->request->data('limit');
            $offset = ( ($page - 1) * $limit );  
            $dataMessages = $this->Message->find( 'all', array('conditions' => array('Message.conversation_id' => $conversation_id), 'fields'=>array('Message.id','Message.reply','Message.created','MobileUser.nombre','MobileUser.foto'), 'order'=>'Message.created ASC',
                            'limit' => $limit,
                            'page' => $page,
                            'offset' => $offset));
            
            
            $mobile_user_id =$this->request->data('mobile_user_id');
            $this->loadModel('MobileUser');
            $this->MobileUser->recursive = -1;
            $muser_profile_id = '';
            $dataMuser = $this->MobileUser->find('first', array('conditions' => array('MobileUser.id' => $mobile_user_id), 'fields'=>array('MobileUser.locale','MobileUser.mobileuser_profile_id')));
            if($dataMuser != NULL && $dataMuser != ''){
                $lc = $dataMuser['MobileUser']['locale'];
                $muser_profile_id = $dataMuser['MobileUser']['mobileuser_profile_id'];
            } 
                            
            if ($dataMessages!=NULL) {                
                $data = $dataMessages;
                $success = true;
                $message = $this->getMessage($lc, 'default-success');                                              
            } else {
                $success = false;
                        
                $message = $this->getMessage($lc, 'nochats-found-f');
                if($muser_profile_id == '2'){
                    $message = $this->getMessage($lc, 'nochats-found-r');  
                }

            }
        }
        $response = array( 'success' => $success, 'message' => $message, 'data' => $data );
        $this->set( array('response' => $response, '_serialize' => array('response') ));
    }
    
    //Mensaje enviado por los religios@s a los feligreses a su alrededor
    public function daily_message_add(){
        $success = false;
        $message = $this->getMessage('es','init');
        $data = NULL;
        if( ($this->request->data('mobile_user_id')!=NULL && trim($this->request->data('mobile_user_id'))!='') &&
            ($this->request->data('message')!=NULL && trim($this->request->data('message'))!='') &&
            ($this->request->data('private_message')!=NULL && trim($this->request->data('private_message'))!='') &&
            ($this->request->data('title')!=NULL && trim($this->request->data('title'))!='')  &&
            ($this->request->data('date')!=NULL && trim($this->request->data('date'))!='')      
        ){  
            $lat ='0'; $lng = '0';
            
            $mobile_user_id = $this->request->data('mobile_user_id');
            $this->loadModel('MobileUser');
            $this->MobileUser->recursive = -1;
            $dataMuser = $this->MobileUser->find( 'first', array('conditions' => array('MobileUser.id' => $mobile_user_id), 'fields'=>array('MobileUser.status','MobileUser.locale', 'MobileUser.country_id','MobileUser.latitud','MobileUser.longitud')));
            $status = '';
            if($dataMuser != NULL && $dataMuser != ''){
                $status = $dataMuser['MobileUser']['status'];
                $lc = $dataMuser['MobileUser']['locale'];
                $country_id = $dataMuser['MobileUser']['country_id'];
                $lat = $dataMuser['MobileUser']['latitud'];
                $lng = $dataMuser['MobileUser']['longitud'];
            }
            
            if($status != ''){
                if($status == 'V'){      
                    if($lat != '0' && $lng != '0' && $lat != '' && $lng != ''){
                                                  
                            $dataMessage= array();                  
                            $dataMessage['mobile_user_id'] = $mobile_user_id;
                            $dataMessage['status'] = 'I';
                            $dataMessage['message'] = trim($this->request->data('message'));
                            $dataMessage['title'] = trim($this->request->data('title'));
                            $dataMessage['latitude'] = $lat;
                            $dataMessage['longitude'] = $lng;
                            $dataMessage['private_message'] = $this->request->data('private_message');
                            $dataMessage['created'] = $this->request->data('date');
                            $this->loadModel('DailyMessage');
                            if($this->DailyMessage->save($dataMessage)){
                                
                                $this->correo('Administrador Amen App', 'info@amenapps.com', '', 'email_base', 'Nuevo mensaje del día', 'Te informamos que un reglioso acaba de agregar un mensaje del día, por favor revisa el panel web para validarlo');

                                $success = true;
                                $message = $this->getMessage($lc, 'q-success');
                            }                                         
                            else{
                                $success = false;
                                $message = $this->getMessage($lc, 'q-error');
                            }              
                        
                    }
                    else{
                        $success = false;
                        $message = $this->getMessage($lc, 'location-error');
                    } 
                }else{
                    $success = false;
                    $message = $this->getMessage($lc, 'active-error');
                }
            }
            else{
                $success = false;
                $message = $this->getMessage($lc, 'user-error');
            }
        }
        else{
            $success = false;
            $message = $this->getMessage('es', 'fields-error');
        }
        $response = array( 'success' => $success, 'message' => $message, 'data' => $data);
        $this->set( array('response' => $response, '_serialize' => array('response') ));
    }
    
    /** Si el mobile_user_id pertenece al feligres lista los mensajes segun la cercania
     *  Si el mobile_user_id es de un religios@ lista los mensajes que ha creado**/
    public function daily_message_list(){
        
        $success = false;
        $message = $this->getMessage('es','init');
        $data = NULL;
        $lc = 'es';
        if( ($this->request->data('mobile_user_id')!=NULL && trim($this->request->data('mobile_user_id'))!='')){  
            $myLat ='0'; $myLon = '0';
            
            $mobile_user_id = $this->request->data('mobile_user_id');
            $this->loadModel('MobileUser');
            $this->MobileUser->recursive = -1;
            $dataMuser = $this->MobileUser->find( 'first', array('conditions' => array('MobileUser.id' => $mobile_user_id), 'fields'=>array('MobileUser.status','MobileUser.locale', 'MobileUser.country_id','MobileUser.latitud','MobileUser.longitud', 'MobileUser.mobileuser_profile_id')));
            $status = '';
            $profile_id = '';
            if($dataMuser != NULL && $dataMuser != ''){
                $status = $dataMuser['MobileUser']['status'];
                $lc = $dataMuser['MobileUser']['locale'];
                $myLat = $dataMuser['MobileUser']['latitud'];
                $myLon = $dataMuser['MobileUser']['longitud'];
                $profile_id = $dataMuser['MobileUser']['mobileuser_profile_id'];
            }else{
                if($mobile_user_id == '0'){
                    $status = 'A';
                    $lc = $this->request->data('locale');
                    $myLat = $this->request->data('latitude');
                    $myLon = $this->request->data('longitude');
                    $profile_id = '1';
                }
            }
            $date = '';
            if($this->request->data('date') != NULL && $this->request->data('date') != '')  
                $date = $this->request->data('date');
            
            if($status != ''){
                if($status == 'A' || $status == 'V'){      
                    if($myLat != '0' && $myLon != '0' && $myLat != '' && $myLon != ''){
                        $this->loadModel('DailyMessage');
                        $this->DailyMessage->recursive = 0;
                        $radio = 20;
                        if($this->request->data('radio')!=NULL && $this->request->data('radio')!='')
                            $radio = $this->request->data('radio');

                        $page = 1;
                        $limit = 100;
                        if (($this->request->data('page') != NULL && $this->request->data('page') != ''))
                            $page = $this->request->data('page');
                        if (($this->request->data('limit') != NULL && $this->request->data('page') != ''))
                            $limit = $this->request->data('limit');
                        $offset = ( ($page - 1) * $limit );            

                        $this->DailyMessage->virtualFields['distancia'] = (
                            'round(acos(sin(radians(DailyMessage.latitude)) * sin(radians('.$myLat.')) + 
                            cos(radians(DailyMessage.latitude)) * cos(radians('.$myLat.')) * 
                            cos(radians(DailyMessage.longitude) - radians('.$myLon.'))) * 6371 , 1)'
                                    );
                        $conditions = array();
                        $order = '';
                        $message_error = '';
                        if($profile_id == '1'){
                            $conditionRadio = array( "(acos(sin(radians(DailyMessage.latitude)) * sin(radians(".$myLat.")) + cos(radians(DailyMessage.latitude)) * cos(radians(".$myLat.")) * cos(radians(DailyMessage.longitude) - radians(".$myLon."))) * 6371) <=".$radio);
                            $conditionDate = array('DailyMessage.created LIKE'=>'%'.$date.'%');
                            $conditions = array($conditionRadio,$conditionDate);
                            $order = 'DailyMessage.distancia ASC'; 
                            $message_error = $this->getMessage($lc, 'nochats-found-r'); 
                            
                        }else{
                            $conditions = array('DailyMessage.mobile_user_id' =>$mobile_user_id);
                            $order = 'DailyMessage.created DESC';
                            $message_error = $this->getMessage($lc, 'nochats-found-f'); 
                        }
                        $data = array();
                        $data  = $this->DailyMessage->find('all',
                            array(
                                'fields'=>array('DailyMessage.*','MobileUser.foto', 'MobileUser.nombre'),
                                'conditions'=>$conditions,
                                'order'=>$order,
                                'limit' => $limit,
                                'page' => $page,
                                'offset' => $offset
                            ));

                        if($data != NULL && $data !=''){
                            $success = true;
                            $message = $this->getMessage($lc, 'default-success');
                        }
                        else{
                            $success = false;
                            $message = $message_error;
                        }          
                    }
                    else{
                        $success = false;
                        $message = $this->getMessage($lc, 'location-error');
                    } 
                }else{
                    $success = false;
                    $message = $this->getMessage($lc, 'active-error');
                }
            }
            else{
                $success = false;
                $message = $this->getMessage($lc, 'user-error');
            }
        }
        else{
            $success = false;
            $message = $this->getMessage('es', 'fields-error');
        }
        $response = array( 'success' => $success, 'message' => $message, 'data' => $data );
        $this->set( array('response' => $response, '_serialize' => array('response') ));
    }
    
    public function mobileUserProfiles_list(){        
        $success = false;
        $message = $this->getMessage('es', 'init');
        $data = NULL;              
        if(($this->request->data('locale')!=NULL && trim($this->request->data('locale'))!='')){
            $locale = $this->request->data('locale');
            $this->loadModel('MobileuserProfile');
            $this->MobileuserProfile->recursive = -1;
            if ($locale == 'es' || $locale == 'es' || $locale == 'pt'){
                $this->MobileuserProfile->virtualFields['titulo'] = 'MobileuserProfile.titulo_'.$locale;
            }
            else{
                $this->MobileuserProfile->virtualFields['titulo'] = 'MobileuserProfile.titulo_en';
            }
            $data = $this->MobileuserProfile->find('all', array('fields' =>  array('MobileuserProfile.id','MobileuserProfile.titulo')));
            $success = true;
            $message = $this->getMessage($locale, 'default-success'); 
                                
        }else{
            $success = false;
            $message =  $this->getMessage('es', 'fields-error');
        }
        
        $response = array( 'success' => $success, 'message' => $message, 'data' => $data);
        $this->set( array('response' => $response, '_serialize' => array('response') ));
    }
    
    public function countries_list(){        
        $success = false;
        $message = 'No countries were found';
        $data = NULL;        
        if( $this->request->data('mobile_user_id')!=NULL && trim($this->request->data('mobile_user_id'))!='' ){           
            $this->loadModel('MobileUser');
            //$status = $this->MobileUser->field('MobileUser.status', array('MobileUser.id'=>$this->request->data('mobile_user_id')));            
            //$lc = $this->MobileUser->field('MobileUser.locale', array('MobileUser.id'=>$this->request->data('mobile_user_id')));            
            
            $mobile_user_id = $this->request->data('mobile_user_id');
            $dataMuser = $this->MobileUser->find( 'first', array('conditions' => array('MobileUser.id' => $mobile_user_id), 'fields'=>array('MobileUser.status','MobileUser.locale')));
            $status = '';
            if($dataMuser != NULL && $dataMuser != ''){
                $status = $dataMuser['MobileUser']['status'];
                $lc = $dataMuser['MobileUser']['locale'];
            }            
            
            if($status == 'A' || $status == 'V'){
                $this->loadModel('Country');
                $this->Country->recursive = -1;                
                $data = $this->Country->find('all', array('order'=>'Country.nombre ASC'));                
                if ($data != NULL) {                    
                    $success = true;
                    $message = 'Country list';
                } 
                else{                    
                    $success = false;
                    $message = 'Countries not found';                    
                }                              
            }else{
                $success = false;
                $message = 'The user is not enabled';
            }      
        }
        else{
            $success = false;
            $message = 'Please, send all the information';
        }
        $response = array( 'success' => $success, 'message' => $message, 'data' => $data );
        $this->set( array('response' => $response, '_serialize' => array('response') ));
    }
    
    public function cities_list(){   
        $lc = 'es';        
        if($this->request->data('locale')!=NULL && trim($this->request->data('locale'))!='' )
            $lc = $this->request->data('locale');
        
        $success = false;
        $message = 'No cities were found';
        $data = NULL;        
        
        if( ($this->request->data('country_id')!=NULL && trim($this->request->data('country_id'))!='' )&&
            ($this->request->data('mobile_user_id')!=NULL && trim($this->request->data('mobile_user_id'))!='')            
        ){     
             $this->loadModel('MobileUser');
            $lc = $this->MobileUser->field('MobileUser.locale', array('MobileUser.id'=>$this->request->data('mobile_user_id')));            
            if($lc == NULL || $lc = '')
                $lc = 'es';
            
            $this->loadModel('City');
            $this->City->recursive = -1;                
            $data = $this->City->find('all', array('conditions'=>array('City.country_id'=>$this->request->data('country_id')),'order'=>'City.prioridad DESC'));                
            if ($data != NULL) {                    
                $success = true;
                $message = 'City list';
            } 
            else{                    
                $success = false;
                $message = $this->getMessage($lc, 'cities_error');                   
            }    
        }
        else{
            $success = false;
            $message = 'Please, send all the information';
        }
        $response = array( 'success' => $success, 'message' => $message, 'data' => $data );
        $this->set( array('response' => $response, '_serialize' => array('response') ));
    }
    
    public function readings_view(){
        $lc = 'es';        
        if( $this->request->data('locale')!=NULL && trim($this->request->data('locale'))!='' )
            $lc = trim($this->request->data('locale'));
        
        $success = false;
        $message = 'No information aviable';
        $data = NULL;
        
        if(($this->request->data('mobile_user_id')!=NULL && trim($this->request->data('mobile_user_id'))!='' )){
            $this->loadModel('MobileUser');
            $locale = $this->MobileUser->field('MobileUser.locale', array('MobileUser.id'=>$this->request->data('mobile_user_id'))); 
            $dataLocales = array_keys($this->MobileUser->availableLocales);        
            if(in_array($locale, $dataLocales)){
                $lc = $locale;
            } 
        }
        
        if((($this->request->data('date')!=NULL && trim($this->request->data('date'))!='' )&&
           ($this->request->data('reading_type_id')!=NULL && trim($this->request->data('reading_type_id'))!='')) || 
                (($this->request->data('reading_id')!=NULL && trim($this->request->data('reading_id'))!='' ))){
            
            $this->loadModel('Reading');
            $this->Reading->recursive = -1;
            $fecha = $this->request->data('date');
            $fecha = "_____".date('m-d',  strtotime($fecha));
            $type = $this->request->data('reading_type_id');
            $reading_id = $this->request->data('reading_id');
            
            $mainCondition = array('Reading.fecha LIKE' => $fecha,'Reading.reading_type_id'=>$type);        
            if($reading_id!= NULL && $reading_id != '')
                $mainCondition = array('Reading.id'=> $reading_id);
            
            $this->Reading->virtualFields['titulo'] = 'Reading.titulo_es';
            $this->Reading->virtualFields['descripcion'] = 'Reading.descripcion_es';
            $secondCondition = '';
            //$secondCondition = array('Reading.titulo_es is NOT NULL', 'Reading.descripcion_es is NOT NULL');
            
            $this->Reading->virtualFields['titulo'] = 'Reading.titulo_'.$lc;
            $this->Reading->virtualFields['descripcion'] = 'Reading.descripcion_'.$lc;
                
                //$secondCondition = array('Reading.titulo_'.$lc.' is NOT NULL', 'Reading.descripcion_'.$lc.' is NOT NULL');
                
            $data = $this->Reading->find('first',
                array(
                    'fields' => array(
                        'Reading.id','Reading.titulo','Reading.descripcion','Reading.fecha','Reading.reading_type_id','Reading.created'
                    ),
                    'conditions' => array($mainCondition, $secondCondition), 
                )
            ); 

            if ($data != NULL) {   
                
                if( $data['Reading']!=NULL && 
                        ($data['Reading']['titulo']!=NULL && $data['Reading']['descripcion']!=NULL) ){
                 
                    $success = true;
                    $message = $this->getMessage($lc, 'default-success');
                    
                }else{ 
                    $data = NULL;
                    $success = false;
                    $message = $this->getMessage($lc, 'default-error');                    
                } 
                
            }else{                    
                $success = false;
                $message = $this->getMessage($lc, 'default-error');                    
            } 
        }else{
            $success = false;
            $message = $this->getMessage($lc, 'fields-error'); 
        }        
        
        $response = array( 'success' => $success, 'message' => $message, 'data' => $data/*, 'lc' => $lc, 'vf' => json_encode($this->Reading->virtualFields)*/ );
        $this->set( array('response' => $response, '_serialize' => array('response') ));
    }
    
    public function favorites_add(){
        $lc = 'es';
        $success = false;
        $message = $this->getMessage($lc,'init');
        $data = NULL;
        
        if(($this->request->data('mobile_user_id')!=NULL && trim($this->request->data('mobile_user_id'))!='' ) &&
                ($this->request->data('type_id')!=NULL && trim($this->request->data('type_id'))!='' ) &&
                ($this->request->data('favorite_id')!=NULL && trim($this->request->data('favorite_id'))!='' )){
            $this->loadModel('MobileUser');
            $this->MobileUser->recursive = -1;            
            $mobile_user_id = $this->request->data('mobile_user_id');
            $dataMuser = $this->MobileUser->find( 'first', array('conditions' => array('MobileUser.id' => $mobile_user_id), 'fields'=>array('MobileUser.status','MobileUser.locale')));
            $status = '';
            if($dataMuser != NULL && $dataMuser != ''){
                $status = $dataMuser['MobileUser']['status'];
                $lc = $dataMuser['MobileUser']['locale'];
            }
            if($status == 'A' || $status == 'V'){
                $dataFav = array();
                $dataFav['mobile_user_id'] = $mobile_user_id;
                $dataFav['type_id'] = $this->request->data('type_id');
                $dataFav['favorite_id'] = $this->request->data('favorite_id');
                if($this->request->data('titulo')!=NULL && trim($this->request->data('titulo'))!='' )
                    $dataFav['titulo'] = $this->request->data('titulo');
                
                $this->loadModel('Favorite');
                if($this->Favorite->save($dataFav)){
                    $success = true;
                    $message = $this->getMessage($lc,'add-favorite');
                }else{
                    $success = true;
                    $message = $this->getMessage($lc,'add-error');
                }
            }else{
                $message = $this->getMessage($lc,'active-error');
            }            
        }        
        $response = array( 'success' => $success, 'message' => $message, 'data' => $data );
        $this->set( array('response' => $response, '_serialize' => array('response') ));
    }

    public function favorites_list(){
        $lc = 'es';
        $success = false;
        $message = $this->getMessage($lc,'init');
        $data = NULL;
        
        if(($this->request->data('mobile_user_id')!=NULL && trim($this->request->data('mobile_user_id'))!='' )){
            $this->loadModel('MobileUser');            
            $mobile_user_id = $this->request->data('mobile_user_id');
            $dataMuser = $this->MobileUser->find( 'first', array('conditions' => array('MobileUser.id' => $mobile_user_id)));
            $status = '';
            if($dataMuser != NULL && $dataMuser != ''){
                $status = $dataMuser['MobileUser']['status'];
                $lc = $dataMuser['MobileUser']['locale'];
            }
            if($status == 'A' || $status == 'V'){
                $tab = $this->request->data('tab');
                
                $this->loadModel('Favorite');
                $this->Favorite->recursive = -1;
                //$this->Favorite->Behaviors->load('Containable');
                //$this->Favorite->contain(array('Church'));
                $dataFav = $this->Favorite->find('all', array('conditions'=>array('Favorite.mobile_user_id'=>$mobile_user_id)));
                    
                if($dataFav != NULL){
                    $success = true;
                    $message = $this->getMessage($lc,'default-success');
                    $data = $dataFav;
                }else{
                    $success = true;
                    $message = $this->getMessage($lc,'default-error');
                }
            }else{
                $this->getMessage($lc,'active-error');
            }            
        }        
        $response = array( 'success' => $success, 'message' => $message, 'data' => $data );
        $this->set( array('response' => $response, '_serialize' => array('response') ));
    }
    
   
    public function favorites_delete(){
        $lc = 'es';
        $success = false;
        $message = $this->getMessage($lc,'init');
        $data = NULL;
        
        if(($this->request->data('mobile_user_id')!=NULL && trim($this->request->data('mobile_user_id'))!='' ) &&
           ($this->request->data('favorite_id')!=NULL && trim($this->request->data('favorite_id'))!='' ) &&
           ($this->request->data('type_id')!=NULL && trim($this->request->data('type_id'))!='' )){
            $this->loadModel('MobileUser');            
            $mobile_user_id = $this->request->data('mobile_user_id');
            $dataMuser = $this->MobileUser->find( 'first', array('conditions' => array('MobileUser.id' => $mobile_user_id)));
            $status = '';
            if($dataMuser != NULL && $dataMuser != ''){
                $status = $dataMuser['MobileUser']['status'];
                $lc = $dataMuser['MobileUser']['locale'];
            }
            if($status == 'A' || $status == 'V'){
                $fav_id = $this->request->data('favorite_id');
                $type_id = $this->request->data('type_id');
                
                $this->loadModel('Favorite');
                $id = $this->Favorite->field('Favorite.id', array('Favorite.favorite_id'=>$fav_id, 'Favorite.type_id'=>$type_id));
                $this->Favorite->id = $id;
                 
                if($this->Favorite->delete()){
                    $success = true;
                    $message = $this->getMessage($lc,'delete-favorite');
                }else{
                    $success = false;
                    $message = $this->getMessage($lc,'default-error');
                }
            }else{
                $this->getMessage($lc,'active-error');
            }            
        }        
        $response = array( 'success' => $success, 'message' => $message, 'data' => $data );
        $this->set( array('response' => $response, '_serialize' => array('response') ));
    }
    
    public function correo($nombre, $email, $item1, $email_body, $subject, $body){        
        App::uses('CakeEmail', 'Network/Email');
        $array_email = explode(',', $email);
        $correo = new CakeEmail('amenapps'); 
        $correo      
          ->template($email_body,'plantilla')               
          ->emailFormat('html')       
          //->to(array($email,'info@amenapps.com'))        
          ->to($array_email)    
          ->from('info@amenapps.com')
          ->subject($subject) 
          ->viewVars([ 
                'nombre' => $nombre.', ', 
                'body' => $body,
                'item1' => $item1,
                'url_img' => (FULL_BASE_URL . $this->webroot),
                'url_ws_confirmar' => (FULL_BASE_URL.$this->webroot.'mobile_users'.DS.'activateaccount'.DS.base64_encode($item1)),
          ]);        
        $correo->send();
    }
    
    public function getCity($lat, $lng){
        $this->loadModel('City');
        $this->City->recursive = -1;
        $city_id = '';
        $city_name = $this->getZoneName($lat, $lng, 'LN', 'locality');
        if($city_name != '' && $city_name != NULL){
            $city = $this->City->find('first', 
                    array(
                        'conditions' => array(
                            'City.nombre' => trim($city_name)                                    
                          )
                    )
                );
            if( $city !=NULL && count($city)>0 && $city['City']!=NULL ){
                $city_id = $city['City']['id'];
            }
            else{
                $this->loadModel('Country');
                $this->Country->recursive = -1;
                $country_short_name = $this->getZoneName($lat, $lng, 'SN', 'country');
                $country = $this->Country->find('first', 
                        array(
                            'conditions' => array(
                                'Country.short_name' => trim($country_short_name)                                    
                              )
                        )
                    );
                $country_id = '';
                if( $country!=NULL && count($country)>0 && $country['Country']!=NULL ){
                    $country_id = $country['Country']['id'];
                }
                else{
                    $dataCountry = array();
                    $dataCountry['nombre'] = $this->getZoneName($lat, $lng, 'LN', 'country');
                    $dataCountry['short_name'] = $country_short_name;                        
                    if($this->Country->save($dataCountry)){
                        $country_id = $this->Country->id;
                    }
                }
                $dataCity = array();
                $dataCity['name'] = $this->getZoneName($lat, $lng, 'LN', 'locality');
                $dataCity['country_id'] = $country_id;                        
                if($this->City->save($dataCity)){
                    $city_id = $this->City->id;
                }
            }
        }                
        return $city_id;
    }
    
    public function getCountry($lat, $lng){
        $this->loadModel('Country');
        $this->Country->recursive = -1;
        $country_id = '';
        $country_short_name = $this->getZoneName($lat, $lng, 'SN', 'country');
        $country = $this->Country->find('first', 
                        array(
                            'conditions' => array(
                                'Country.short_name' => trim($country_short_name)                                    
                              )
                        )
                    );
        if( $country!=NULL && count($country)>0 && $country['Country']!=NULL ){
            $country_id = $country['Country']['id'];
        }
        else{
            $dataCountry = array();
            $dataCountry['nombre'] = $this->getZoneName($lat, $lng, 'LN', 'country');
            $dataCountry['short_name'] = $country_short_name;

            if($this->Country->save($dataCountry)){
                $country_id = $this->Country->id;
            }
        }
        return $country_id;
    }
    
    public function getZoneName($lat, $lng, $item, $type){
        $url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.$lat.','.$lng;
        ini_set($url, 1);
        $json = file_get_contents($url);
        $obj = json_decode($json, true);
        $array = $obj['results']['0']['address_components'];
        if($obj['status'] ==  "OK"){
            foreach($array as $key=>$value){
                if($value['types'][0] == $type){
                    if ($item == 'SN')
                        $result = $value['short_name'];
                    else
                        $result = $value['long_name'];
                }
            }
        }
        
        return $result;
    }
    
    public function getMessage($locale, $message){
        $url = FULL_BASE_URL . $this->webroot . 'app/webroot/in18_messages.json';
        ini_set($url, 1);
        $json = file_get_contents($url);
        $obj = json_decode($json, true);
        //$array = $obj['results']['0']['address_components'];
        $lc = 'es';
        $this->loadModel('MobileUser');
        $dataLocales = array_keys($this->MobileUser->availableLocales);        
        if(in_array($locale, $dataLocales)){
            $lc = $locale;
        }           
        return $obj[$lc][$message];
    } 
    
    public function test(){
        $success = false;
        $message = $this->getMessage('es','init');
        $data = NULL;
        $lc = $this->request->data('lc');
        
        $this->loadModel('MobileUser');
        $dataLocales = array_keys($this->MobileUser->availableLocales);
        //$dataLocales =  array('es', 'en', 'pt', 'fr', 'it');
        
        if(in_array($locale, $dataLocales)){
            $message = "encontrado";
        }else{
            $message = "no encontrado";
        }        
        
        $data = $dataLocales;
        $response = array( 'success' => $success, 'message' => $message, 'data' => $data );
        $this->set( array('response' => $response, '_serialize' => array('response') ));
    }

    /*
    public function test_push(){
        
        $success = false;
        $message = 'TESTING push failed';
        $data = NULL;
        
        //$lat = $this->request->data('latitud');
        //$lng = $this->request->data('longitud');
        $lat = '10.9518449';
        $lng= '-74.7999972';
        $token = $this->request->data('token');

        $city_id = $this->getCity($lat, $lng);
        
        if($city_id != '' && $city_id != NULL){
            $this->loadModel('MobileUser');// temp
            $this->MobileUser->recursive = -1;// temp
            $this->MobileUser->virtualFields['distancia'] = (
                'round(acos(sin(radians(MobileUser.latitud)) * sin(radians('.$lat.')) + 
                cos(radians(MobileUser.latitud)) * cos(radians('.$lat.')) * 
                cos(radians(MobileUser.longitud) - radians('.$lng.'))) * 6371 , 1)'
                        );
            $religiuos_on_city = $this->MobileUser->find('all', array('conditions'=>array('MobileUser.city_id'=>$city_id,'MobileUser.mobileuser_profile_id'=>2, 'MobileUser.status' => 'A'), 'order'=>'MobileUser.distancia ASC'));
            if($religiuos_on_city!='' && $religiuos_on_city != NULL){
                $idsReligiuos = array();
                $this->loadModel('Conversation');//temp
                $this->Conversation->recursive = -1;//temp
                for($i = 0; $i < count($religiuos_on_city); $i++ ){
                    $receiver_id = $religiuos_on_city[$i]['MobileUser']['id'];
                    $status_response = $this->Conversation->field('Conversation.status', array('Conversation.receiver_id'=>$receiver_id, 'Conversation.status'=>'S'));
                    if($status_response != 'S'){
                        //$idsReligiuos[]['receiver_id'] = $receiver_id;
                            $idsReligiuos[$i]['tokenpush'] = $religiuos_on_city[$i]['MobileUser']['tokenpush'];
                            $idsReligiuos[$i]['receiver_id'] = $receiver_id;
                    }
                }
                if($idsReligiuos!= NULL && !empty($idsReligiuos) && count($idsReligiuos) >0 ){
                    CakePlugin::load('ParsePhpSdkMaster');
                    require_once(APP . 'Plugin' . DS . 'ParsePhpSdkMaster' . DS . 'autoload.php');
                    ParseClient::initialize('U43qtycLKALkP6cZpvdcOrwjk1xzs7N6ZONjtcWB', 'x16rTXzopkw5i2oQ8jVLUr6bh8sYf8kuBLqP7xLs', 'CCQiSDmFiJyCti2xv3NpCgB5cDNmLO6ZoQ439WYq');
                    ParseClient::setServerURL('https://parseapi.back4app.com', '/');
                    $dataPush = array(
                        "alert" => (" Tienes una consulta de un feligrés"),
                        "action" => "conversations_question",
                        "conversation_id" => '1'
                    );
                    $queryPush = ParseInstallation::query();
                    $queryPush->equalTo("objectId",$token);
                     $res =ParsePush::send(array(
                                "where" => $queryPush,
                                "data" => $dataPush
                    ), true); 
                    $data = json_encode($res);     
                    //$data = $idsReligiuos;
                    $success = true;
                    $message = 'Info data : '.$token;
                }else{
                    $success = false;
                    $message = 'En este momento ningun religioso puede responder';
                }                
            }
            else{
                $success = false;
                $message = 'No hay religiosos disponibles';
            }
        }
        else{
            $success = false;
            $message = 'la ubicacion no es válida';
        }
        
        $response = array( 'success' => $success, 'message' => $message, 'data' => $data );
        $this->set( array('response' => $response, '_serialize' => array('response') ));
    }
    
    public function test_forward_question(){
        $success = false;
        $message = 'TESTING...';
        $data = NULL;

        $this->loadModel('Conversation');
        $this->Conversation->recursive = -1;

        $this->Conversation->virtualFields['lapso'] = (
                    'EXTRACT(hour FROM TIMEDIFF(NOW(), Conversation.modified))'
                );
        $dataConversations = $this->Conversation->find('all', array('conditions'=>array('status'=>'S', 'lapso >='=>1 )));
        if($dataConversations != NULL && count($dataConversations)>0){
            foreach($dataConversations as $conversation){
                $sender_id = $conversation['Conversation']['sender_id'];
                $conversation_id = $conversation['Conversation']['id'];
                $this->loadModel('MobileUser');
                $this->MobileUser->recursive = -1;
                $this->MobileUser->Behaviors->load('Containable');
                $this->MobileUser->contain(array('City'));
                $dataMuser = $this->MobileUser->find( 'first', array('conditions' => array('MobileUser.id' => $sender_id), 'fields'=>array('MobileUser.status','MobileUser.locale', 'MobileUser.city_id','City.country_id')));
                $city_id = '';
                if($dataMuser != NULL && $dataMuser != ''){
                     $city_id = $dataMuser['MobileUser']['city_id'];
                     $country_id = $dataMuser['City']['country_id'];
                     $lc = $dataMuser['MobileUser']['locale'];
                }               

                if( $city_id != NULL && $city_id != '' && $city_id != 0){
                    $condition_token = array('MobileUser.tokenpush !='=>NULL, 'MobileUser.tokenpush !='=>'');
                    
                    $this->Conversation->Behaviors->load('Containable');
                    $this->Conversation->contain(array('Sender'));
                    $no_disponibles = $this->Conversation->find('list',array('conditions'=>array('Conversation.status '=>'S', 'Sender.city_id'=>$city_id), 'fields'=>array('Conversation.receiver_id'))); 
                    $dataReceivers = $this->MobileUser->find('all', array('conditions'=>array('MobileUser.id !='=>$no_disponibles ,'MobileUser.city_id'=>$city_id,'MobileUser.mobileuser_profile_id'=> 2, 'MobileUser.status' => 'A', $condition_token)));
                    //$message = 'por ciudad';
                    $idsCity = array();
                    if($dataReceivers == NULL || $dataReceivers == ''){
                        $this->loadModel('City');
                        $this->City->recursive = -1;

                        $idsCity = $this->City->find('list',array('conditions'=>array('City.country_id'=>$country_id)));        
                        $this->Conversation->Behaviors->load('Containable');
                        $this->Conversation->contain(array('Sender'));
                        $no_disponibles = $this->Conversation->find('list',array('conditions'=>array('Conversation.status '=>'S', 'Sender.city_id'=>$idsCity), 'fields'=>array('Conversation.receiver_id'))); 
                        $dataReceivers = $this->MobileUser->find('all', array('conditions'=>array('MobileUser.id !='=>$no_disponibles ,'MobileUser.city_id'=>$idsCity,'MobileUser.mobileuser_profile_id'=> 2, 'MobileUser.status' => 'A', $condition_token)));
                        //$message = 'por pais';
                    }
                    if($dataReceivers != NULL && $dataReceivers!=''){
                        $n = count($dataReceivers) - 1; 
                        $item = rand(0,$n);

                        $dataC= array();                  
                        $dataC['id'] = $conversation_id;
                        $dataC['receiver_id'] = $dataReceivers[$item]['MobileUser']['id'];

                        if($this->Conversation->save($dataC)){

                            CakePlugin::load('ParsePhpSdkMaster');
                            require_once(APP . 'Plugin' . DS . 'ParsePhpSdkMaster' . DS . 'autoload.php');
                            ParseClient::initialize('U43qtycLKALkP6cZpvdcOrwjk1xzs7N6ZONjtcWB', 'x16rTXzopkw5i2oQ8jVLUr6bh8sYf8kuBLqP7xLs', 'CCQiSDmFiJyCti2xv3NpCgB5cDNmLO6ZoQ439WYq');
                            ParseClient::setServerURL('https://parseapi.back4app.com', '/');
                            $dataPush = array(
                                "alert" => $this->getMessage($dataReceivers[$item]['MobileUser']['locale'],'pushq-success'),
                                "action" => "conversations_question",
                                "conversation_id" => $conversation_id
                            );
                            $queryPush = ParseInstallation::query();
                            $queryPush->equalTo("objectId",$dataReceivers[$item]['MobileUser']['tokenpush']);
                            ParsePush::send(array(
                                        "where" => $queryPush,
                                        "data" => $dataPush
                            ), true);      

                            $hora = strftime("%I:%M %p", time()).' ';
                            $nombre_receiver = $dataReceivers[$item]['MobileUser']['nombre'];
                            if($dataReceivers[$item]['MobileUser']['consagracion'] != NULL && $dataReceivers[$item]['MobileUser']['email']!= '')
                                $nombre_receiver = $dataReceivers[$item]['MobileUser']['consagracion'].' '.$dataReceivers[$item]['MobileUser']['nombre'];

                            $this->correo($nombre_receiver,$dataReceivers[$item]['MobileUser']['email'],$hora,'email_question', $this->getMessage( $dataReceivers[$item]['MobileUser']['locale'], 'email-subject-q'), '' );

                            $success = true;
                            $message = $this->getMessage($lc, 'q-success');
                        }                                         
                        else{
                            $success = false;
                            $message = $this->getMessage($lc, 'q-error');
                        }              
                    }
                    else{
                        $success = false;
                        $message =$this->getMessage($lc, 'q-info1');
                    }               
                }
                else{
                    $success = false;
                    $message = $this->getMessage($lc, 'location-error');
                } 
            } 
        }
        else{
            $message = 'no hay conversaciones sin responder';
        }
        $response = array( 'success' => $success, 'message' => $message, 'data' => $data  );
        $this->set( array('response' => $response, '_serialize' => array('response') ));
    }
    
    public function test(){        
        $success = false;
        $message = 'TESTING...';
        $data = NULL;
        if($this->request->data('param') != NULL && $this->request->data('param') != '')
        {
            $id = $this->request->data('id');
            $this->loadModel('MobileUser');
            $this->MobileUser->recursive = -1;
            $this->MobileUser->Behaviors->load('Containable');
            $this->MobileUser->contain(array('City'));
          
            $dataMuser = $this->MobileUser->find( 'first', array('conditions' => array('MobileUser.id' => $id), 'fields'=>array('MobileUser.status','MobileUser.locale', 'MobileUser.city_id','City.country_id')));
            
            $status = $dataMuser['MobileUser']['status'];
            $lc = $dataMuser['MobileUser']['locale'];
            $country_id = $dataMuser['City']['country_id'];
            $city_id = $this->request->data('param');
            
           
            $this->loadModel('Conversation');
            $this->Conversation->recursive = -1;
            $this->Conversation->Behaviors->load('Containable');
            $this->Conversation->contain(array('Sender'));
            $list_no_disponibles = $this->Conversation->find('list',array('conditions'=>array('Conversation.status '=>'S', 'Sender.city_id'=>$city_id), 'fields'=>array('Conversation.receiver_id'))); 
            $religiuos_on_city = $this->MobileUser->find('all', array('conditions'=>array('MobileUser.id !='=>$list_no_disponibles ,'MobileUser.city_id'=>$city_id,'MobileUser.mobileuser_profile_id'=> 2, 'MobileUser.status' => 'A')));
            $message = 'por ciudad';
            $idsCity = array();
            if($religiuos_on_city == NULL || $religiuos_on_city == ''){
                $this->loadModel('City');
                $this->City->recursive = -1;
                
                $idsCity = $this->City->find('list',array('conditions'=>array('City.country_id'=>$country_id)));        
                $this->Conversation->Behaviors->load('Containable');
                $this->Conversation->contain(array('Sender'));
                $list_no_disponibles = $this->Conversation->find('list',array('conditions'=>array('Conversation.status '=>'S', 'Sender.city_id'=>$idsCity), 'fields'=>array('Conversation.receiver_id'))); 
                $religiuos_on_city = $this->MobileUser->find('all', array('conditions'=>array('MobileUser.id !='=>$list_no_disponibles ,'MobileUser.city_id'=>$idsCity,'MobileUser.mobileuser_profile_id'=> 2, 'MobileUser.status' => 'A')));
                $message = 'por pais';
            }
            
            
            $data = $religiuos_on_city;
            $data2 = $list_no_disponibles;
            $success = true;
            $message = 'Result: '.$message;            
        }
        else{
            $success = false;
            $message = 'out';
        }   
        $response = array( 'success' => $success, 'message' => $message, 'data' => $data , 'ids' => $data2 );
        $this->set( array('response' => $response, '_serialize' => array('response') ));
    }*/
}
