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
            'conversations_view','conversations_finish',
            'mobileUserProfiles_list',                
            'countries_list','cities_list',
            'readings_view', 
            'favorites_add','favorites_list','favorites_delete',
                
            'test','email_prueba', 'test_push','test_forward_question',
                'conversations_question_by_city'
        );
    }
    
    public function churches_add(){
        
        $ch = curl_init('http://www.amenapps.com/backendapp/web_service/churches_add.json');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($_POST));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $redirect_data = curl_exec($ch); //Este cÛdigo genera la data en el nuevo servidor y recibe la respuesta en formato json
        
        $response = json_decode($redirect_data)->{'response'}; //redireccionando la data respuesnta desde amenapps.com
        $this->set( array('response' => $response, '_serialize' => array('response') ));
    }
    
    public function churches_edit(){      
        $ch = curl_init('http://www.amenapps.com/backendapp/web_service/churches_edit.json');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($_POST));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $redirect_data = curl_exec($ch); //Este cÛdigo genera la data en el nuevo servidor y recibe la respuesta en formato json
        
        $response = json_decode($redirect_data)->{'response'}; //redireccionando la data respuesnta desde amenapps.com
        $this->set( array('response' => $response, '_serialize' => array('response') ));
    }
    
    public function churches_view(){        
        
        $ch = curl_init('http://www.amenapps.com/backendapp/web_service/churches_view.json');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($_POST));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $redirect_data = curl_exec($ch); //Este cÛdigo genera la data en el nuevo servidor y recibe la respuesta en formato json
        
        $response = json_decode($redirect_data)->{'response'}; //redireccionando la data respuesnta desde amenapps.com
        $this->set( array('response' => $response, '_serialize' => array('response') ));
    }
    
    
    public function churches_list(){
        
        $ch = curl_init('http://www.amenapps.com/backendapp/web_service/churches_list.json');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($_POST));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $redirect_data = curl_exec($ch); //Este cÛdigo genera la data en el nuevo servidor y recibe la respuesta en formato json
        
        $response = json_decode($redirect_data)->{'response'}; //redireccionando la data respuesnta desde amenapps.com
        $this->set( array('response' => $response, '_serialize' => array('response') ));
    }
        
    public function schedules_add(){
        $ch = curl_init('http://www.amenapps.com/backendapp/web_service/schedules_add.json');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($_POST));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $redirect_data = curl_exec($ch); //Este cÛdigo genera la data en el nuevo servidor y recibe la respuesta en formato json
        
        $response = json_decode($redirect_data)->{'response'}; //redireccionando la data respuesnta desde amenapps.com
        $this->set( array('response' => $response, '_serialize' => array('response') ));       
    }

    public function schedules_edit(){
        $ch = curl_init('http://www.amenapps.com/backendapp/web_service/schedules_edit.json');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($_POST));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $redirect_data = curl_exec($ch); //Este cÛdigo genera la data en el nuevo servidor y recibe la respuesta en formato json
        
        $response = json_decode($redirect_data)->{'response'}; //redireccionando la data respuesnta desde amenapps.com
        $this->set( array('response' => $response, '_serialize' => array('response') ));       
    }

    
    public function musers_add(){
        $ch = curl_init('http://www.amenapps.com/backendapp/web_service/musers_add.json');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($_POST));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $redirect_data = curl_exec($ch); //Este cÛdigo genera la data en el nuevo servidor y recibe la respuesta en formato json
        
        $response = json_decode($redirect_data)->{'response'}; //redireccionando la data respuesnta desde amenapps.com
        $this->set( array('response' => $response, '_serialize' => array('response') ));       
    }
    
    public function musers_view(){        
        $ch = curl_init('http://www.amenapps.com/backendapp/web_service/musers_view.json');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($_POST));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $redirect_data = curl_exec($ch); //Este cÛdigo genera la data en el nuevo servidor y recibe la respuesta en formato json
        
        $response = json_decode($redirect_data)->{'response'}; //redireccionando la data respuesnta desde amenapps.com
        $this->set( array('response' => $response, '_serialize' => array('response') )); 
    }
    
    public function musers_edit(){        
        $ch = curl_init('http://www.amenapps.com/backendapp/web_service/musers_edit.json');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($_POST));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $redirect_data = curl_exec($ch); //Este cÛdigo genera la data en el nuevo servidor y recibe la respuesta en formato json
        
        $response = json_decode($redirect_data)->{'response'}; //redireccionando la data respuesnta desde amenapps.com
        $this->set( array('response' => $response, '_serialize' => array('response') )); 
    }
    
    public function musers_login(){        
        $ch = curl_init('http://www.amenapps.com/backendapp/web_service/musers_login.json');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($_POST));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $redirect_data = curl_exec($ch); //Este cÛdigo genera la data en el nuevo servidor y recibe la respuesta en formato json
        
        $response = json_decode($redirect_data)->{'response'}; //redireccionando la data respuesnta desde amenapps.com
        $this->set( array('response' => $response, '_serialize' => array('response') )); 
    }

    public function musers_rememberpwd(){        
        $ch = curl_init('http://www.amenapps.com/backendapp/web_service/musers_rememberpwd.json');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($_POST));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $redirect_data = curl_exec($ch); //Este cÛdigo genera la data en el nuevo servidor y recibe la respuesta en formato json
        
        $response = json_decode($redirect_data)->{'response'}; //redireccionando la data respuesnta desde amenapps.com
        $this->set( array('response' => $response, '_serialize' => array('response') )); 
    }
    
    public function conversations_add(){        
        $ch = curl_init('http://www.amenapps.com/backendapp/web_service/conversations_add.json');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($_POST));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $redirect_data = curl_exec($ch); //Este cÛdigo genera la data en el nuevo servidor y recibe la respuesta en formato json
        
        $response = json_decode($redirect_data)->{'response'}; //redireccionando la data respuesnta desde amenapps.com
        $this->set( array('response' => $response, '_serialize' => array('response') )); 
    }   
    // searching by city no se utiliza por ahora
    public function conversations_question_by_city(){        
        $ch = curl_init('http://www.amenapps.com/backendapp/web_service/conversations_add.json');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($_POST));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $redirect_data = curl_exec($ch); //Este cÛdigo genera la data en el nuevo servidor y recibe la respuesta en formato json
        
        $response = json_decode($redirect_data)->{'response'}; //redireccionando la data respuesnta desde amenapps.com
        $this->set( array('response' => $response, '_serialize' => array('response') )); 
    }
    
    //searching by gps
    public function conversations_question(){        
        $ch = curl_init('http://www.amenapps.com/backendapp/web_service/conversations_question.json');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($_POST));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $redirect_data = curl_exec($ch); //Este cÛdigo genera la data en el nuevo servidor y recibe la respuesta en formato json
        
        $response = json_decode($redirect_data)->{'response'}; //redireccionando la data respuesnta desde amenapps.com
        $this->set( array('response' => $response, '_serialize' => array('response') )); 
    }
    
    public function conversations_response(){        
        $ch = curl_init('http://www.amenapps.com/backendapp/web_service/conversations_response.json');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($_POST));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $redirect_data = curl_exec($ch); //Este cÛdigo genera la data en el nuevo servidor y recibe la respuesta en formato json
        
        $response = json_decode($redirect_data)->{'response'}; //redireccionando la data respuesnta desde amenapps.com
        $this->set( array('response' => $response, '_serialize' => array('response') )); 
    }
    
    public function conversations_view(){        
        $ch = curl_init('http://www.amenapps.com/backendapp/web_service/conversations_view.json');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($_POST));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $redirect_data = curl_exec($ch); //Este cÛdigo genera la data en el nuevo servidor y recibe la respuesta en formato json
        
        $response = json_decode($redirect_data)->{'response'}; //redireccionando la data respuesnta desde amenapps.com
        $this->set( array('response' => $response, '_serialize' => array('response') )); 
    }
    
    public function conversations_list(){        
        $ch = curl_init('http://www.amenapps.com/backendapp/web_service/conversations_list.json');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($_POST));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $redirect_data = curl_exec($ch); //Este cÛdigo genera la data en el nuevo servidor y recibe la respuesta en formato json
        
        $response = json_decode($redirect_data)->{'response'}; //redireccionando la data respuesnta desde amenapps.com
        $this->set( array('response' => $response, '_serialize' => array('response') )); 
    }
    
    public function conversations_finish(){        
        $ch = curl_init('http://www.amenapps.com/backendapp/web_service/conversations_finish.json');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($_POST));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $redirect_data = curl_exec($ch); //Este cÛdigo genera la data en el nuevo servidor y recibe la respuesta en formato json
        
        $response = json_decode($redirect_data)->{'response'}; //redireccionando la data respuesnta desde amenapps.com
        $this->set( array('response' => $response, '_serialize' => array('response') )); 
    }
    

    public function mobileUserProfiles_list(){        
        $ch = curl_init('http://www.amenapps.com/backendapp/web_service/mobileUserProfiles_list.json');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($_POST));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $redirect_data = curl_exec($ch); //Este cÛdigo genera la data en el nuevo servidor y recibe la respuesta en formato json
        
        $response = json_decode($redirect_data)->{'response'}; //redireccionando la data respuesnta desde amenapps.com
        $this->set( array('response' => $response, '_serialize' => array('response') )); 
    }
    
    
    public function countries_list(){        
        $ch = curl_init('http://www.amenapps.com/backendapp/web_service/countries_list.json');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($_POST));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $redirect_data = curl_exec($ch); //Este cÛdigo genera la data en el nuevo servidor y recibe la respuesta en formato json
        
        $response = json_decode($redirect_data)->{'response'}; //redireccionando la data respuesnta desde amenapps.com
        $this->set( array('response' => $response, '_serialize' => array('response') )); 
    }
    
    public function cities_list(){        
        $ch = curl_init('http://www.amenapps.com/backendapp/web_service/cities_list.json');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($_POST));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $redirect_data = curl_exec($ch); //Este cÛdigo genera la data en el nuevo servidor y recibe la respuesta en formato json
        
        $response = json_decode($redirect_data)->{'response'}; //redireccionando la data respuesnta desde amenapps.com
        $this->set( array('response' => $response, '_serialize' => array('response') )); 
    }
    
    public function readings_view(){        
        $ch = curl_init('http://www.amenapps.com/backendapp/web_service/readings_view.json');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($_POST));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $redirect_data = curl_exec($ch); //Este cÛdigo genera la data en el nuevo servidor y recibe la respuesta en formato json
        
        $response = json_decode($redirect_data)->{'response'}; //redireccionando la data respuesnta desde amenapps.com
        $this->set( array('response' => $response, '_serialize' => array('response') )); 
    }
    
    public function favorites_add(){        
        $ch = curl_init('http://www.amenapps.com/backendapp/web_service/favorites_add.json');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($_POST));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $redirect_data = curl_exec($ch); //Este cÛdigo genera la data en el nuevo servidor y recibe la respuesta en formato json
        
        $response = json_decode($redirect_data)->{'response'}; //redireccionando la data respuesnta desde amenapps.com
        $this->set( array('response' => $response, '_serialize' => array('response') )); 
    }
    
    public function favorites_list(){        
        $ch = curl_init('http://www.amenapps.com/backendapp/web_service/favorites_list.json');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($_POST));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $redirect_data = curl_exec($ch); //Este cÛdigo genera la data en el nuevo servidor y recibe la respuesta en formato json
        
        $response = json_decode($redirect_data)->{'response'}; //redireccionando la data respuesnta desde amenapps.com
        $this->set( array('response' => $response, '_serialize' => array('response') )); 
    }

    public function favorites_delete(){        
        $ch = curl_init('http://www.amenapps.com/backendapp/web_service/favorites_delete.json');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($_POST));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $redirect_data = curl_exec($ch); //Este cÛdigo genera la data en el nuevo servidor y recibe la respuesta en formato json
        
        $response = json_decode($redirect_data)->{'response'}; //redireccionando la data respuesnta desde amenapps.com
        $this->set( array('response' => $response, '_serialize' => array('response') )); 
    }    
   
    
    public function correo($nombre, $email, $item1, $email_body, $subject, $body){        
        App::uses('CakeEmail', 'Network/Email');
        $correo = new CakeEmail('amenapps'); 
        $correo      
          ->template($email_body,'plantilla')               
          ->emailFormat('html')       
          //->to(array($email,'info@amenapps.com'))      
          ->to(array($email))    
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
        if($locale == 'en' || $locale == 'es' || $locale == 'fr' || $locale == 'pt')
            $lc = $locale;            
        return $obj[$lc][$message];
    } 
    
}
