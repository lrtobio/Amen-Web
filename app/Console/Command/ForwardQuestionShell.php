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
use Parse\ParseQuery;
*/
//App::uses('CakeEmail', 'Network/Email');
App::uses('Folder', 'Utility');

class ForwardQuestionShell extends AppShell {
    
    public $uses = array('MobileUser','Conversation','City');
    var $helpers = array('Html');
    //private $imgServerUrl = 'http://www.mobolapps.com/desarrollos/amen/';
    private $imgServerUrl = 'http://www.amenapps.com/backendapp/';
    
    /*
    public function prueba(){
        
        $fichero = WWW_ROOT.'prueba.txt';
        $actual = file_get_contents($fichero);
        file_put_contents($fichero, ($actual."\n".  WWW_ROOT .' '.FULL_BASE_URL.' '.ROOT.' '.Router::url().' '.' '.Configure::read('Defaults.domain').' '.$_SERVER['HTTP_HOST']).' '.Configure::read('Defaults.shellBaseUrl'));
    }
    */
 
    public function forward_question(){
        $success = false;
        $message = 'No hay conversaciones sin responder / el laspo no se ha cumplido';
        $data = NULL;
        
        $this->loadModel('Conversation');
        $this->Conversation->recursive = -1;        
        $this->Conversation->virtualFields['lapso'] = (
                    "EXTRACT(hour FROM TIMEDIFF('".date('Y-m-j H:i:s')."', Conversation.modified))"
                );
        $dataConversations = $this->Conversation->find('all', array('conditions'=>array('status'=>'I', 'lapso >='=>1 )));
        
        //$message .= (FULL_BASE_URL.' './*$this->webroot.*/' '.Router::url('/', true).' '.Router::url('/', false).' '.DS/*.$this->base.' '.$this->Html->url('/')*/);        
        //$message .= (' '.ROOT.' '.WWW_ROOT.' '.WEBROOT_DIR.' '.FULL_BASE_URL);
        //$message .= json_encode($dataConversations);
        
        if($dataConversations != NULL && count($dataConversations)>0){
            foreach ($dataConversations as $conversation) {                
                //$sender_id = $dataConversations[$i]['Conversation']['sender_id'];
                //$conversation_id = $dataConversations[$i]['Conversation']['id'];
                $sender_id = $conversation['Conversation']['sender_id'];
                $conversation_id = $conversation['Conversation']['id'];
                $receiver_id = $conversation['Conversation']['receiver_id'];
                $fecha_creacion = $conversation['Conversation']['created'];
                $forwarding_count = $conversation['Conversation']['forwarding'];
                $message .= '\nid:'.$conversation_id.'-';
                $filtro = "0";
                
                $this->Conversation->id = $conversation_id;
                $this->Conversation->saveField('forwarding', ($forwarding_count + 1));
                
                $this->loadModel('MobileUser');
                $this->MobileUser->recursive = -1;
                //$this->MobileUser->Behaviors->load('Containable');
                //$this->MobileUser->contain(array('City'));
                $dataMuser = $this->MobileUser->find( 'first', array('conditions' => array('MobileUser.id' => $sender_id), 'fields'=>array('MobileUser.nombre','MobileUser.status','MobileUser.locale', 'MobileUser.country_id', 'MobileUser.latitud', 'MobileUser.longitud')));

                //$city_id = '';
                $lat ='0'; $lng = '0';
                if($dataMuser != NULL && $dataMuser != ''){
                    //$city_id = $dataMuser['MobileUser']['city_id'];
                    $country_id = $dataMuser['MobileUser']['country_id'];
                    $lc = $dataMuser['MobileUser']['locale'];
                    $lat = $dataMuser['MobileUser']['latitud'];
                    $lng = $dataMuser['MobileUser']['longitud'];
                }  
                
                if(($lat != '0' && $lng != '0') && ($lat != '' && $lng != '')){                    
                    $condition_token = array('MobileUser.tokenpush !='=>NULL, 'MobileUser.tokenpush !='=>'');
                    $dataR = NULL;
                    if($forwarding_count < 10){
                        $filtro = "1";
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
                                        'MobileUser.locale'=>$lc,
                                        'MobileUser.latitud !='=>array('','0'),
                                        'MobileUser.longitud !='=>array('','0'),
                                        "(acos(sin(radians(MobileUser.latitud)) * sin(radians(".$lat.")) + 
                                        cos(radians(MobileUser.latitud)) * cos(radians(".$lat.")) * 
                                        cos(radians(MobileUser.longitud) - radians(".$lng."))) * 6371) <= ".$radio,
                                        $condition_token),
                                'order'=>'MobileUser.distancia ASC',
                            ));
                        if($dataReceivers != NULL && $dataReceivers != '' && count($dataReceivers) > 0){
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
                                    'MobileUser.locale'=>$lc, /* solo los sacerdotes que tengan el mismo locale */
                                    'MobileUser.mobileuser_profile_id'=>'2',
                                    'MobileUser.status' => 'V',
                                    $condition_token
                                )));
                        $n = count($dataReceivers) - 1; 
                        $item = rand(0,$n);
                        $dataR['MobileUser'] = $dataReceivers[$item]['MobileUser'];
                        $filtro = "2";
                    }
                    if($dataR != NULL && $dataR!='' && count($dataR) > 0 ){
                        //$n = count($dataReceivers) - 1; 
                        //$item = rand(0,$n);
                        $dataC= array();                  
                        $dataC['id'] = $conversation_id;
                        $dataC['receiver_id'] = $dataR['MobileUser']['id'];

                        if($this->Conversation->save($dataC)){

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

                            $time_1 = strtotime($fecha_creacion);
                            $hora = strftime("%I:%M %p", $time_1).' ';
                            $nombre_receiver = strtok($dataR['MobileUser']['nombre'], ' ');
                            if($dataR['MobileUser']['consagracion'] != NULL && $dataR['MobileUser']['email']!= '')
                                $nombre_receiver = $dataR['MobileUser']['consagracion'].' '.$nombre_receiver;

                            $this->correo($nombre_receiver,$dataR['MobileUser']['email'],$hora,'email_question', $this->getMessage( $dataR['MobileUser']['locale'], 'email-subject-q') );

                            $success = true;
                            $message = $this->getMessage($lc, 'q-success').', Id: '.$conversation_id.', Sender: '.$dataMuser['MobileUser']['nombre'].', Receiver: '. $dataR['MobileUser']['nombre'].', forwarding:'.($forwarding_count + 1).', Filtro: '.$filtro;
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
        
        $fichero = WWW_ROOT.'ForwardQuestionShell.txt';
        $actual = file_get_contents($fichero);
        file_put_contents($fichero, ($actual.chr(13).chr(10). date('Y-m-j H:i:s').' '.$message));
        //$response = array( 'success' => $success, 'message' => $message, 'data' => $data  );
        //$this->set( array('response' => $response, '_serialize' => array('response') ));
    }
    
    private function getMessage($locale, $message){
        //$url = FULL_BASE_URL . $this->webroot . 'app/webroot/in18_messages.json';
        //$url = FULL_BASE_URL . DS . 'app/webroot/in18_messages.json';
        //$url = ROOT . DS . 'app/webroot/in18_messages.json';
        $url = WWW_ROOT . 'in18_messages.json';
        ini_set($url, 1);
        $json = file_get_contents($url);
        $obj = json_decode($json, true);
        //$array = $obj['results']['0']['address_components'];
        $lc = 'en';
        if($locale == 'en' || $locale == 'es' || $locale == 'fr')
            $lc = $locale;            
        return $obj[$lc][$message];
    }
    
    public function correo($nombre, $email, $item1, $email_body, $subject){        
        App::uses('CakeEmail', 'Network/Email');
        $correo = new CakeEmail('amenapps'); 
        $correo      
          ->template($email_body,'plantilla')               
          ->emailFormat('html')       
          ->to(array($email))      
          ->from('info@amenapps.com')
          ->subject($subject) 
          ->viewVars([ 
                'nombre' => $nombre.', ', 
                'item1' => $item1,
                //'url_img' => (WWW_ROOT)
                'url_img' => ($this->imgServerUrl)
                //'url_ws_confirmar' => (FULL_BASE_URL.$this->webroot.'mobile_users'.DS.'activateaccount'.DS.base64_encode($item1)),
              //'url_ws_confirmar' => (FULL_BASE_URL.DS.'mobile_users'.DS.'activateaccount'.DS.base64_encode($item1)),
          ]);        
        $correo->send();
    }
}