<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notificacion extends CI_Controller {

    public function __construct()
    {
		parent::__construct();
		if (!$this->session->userdata("id")) {
			redirect(base_url());
		}
		$this->load->model(array('notificacion_model'));
 		$this->load->library(array('session','form_validation','encryption'));
 		$this->load->helper(array('url','form'));
		 $this->load->database('default');
		 $this->encryption->initialize(array('driver' => 'mcrypt'));
    }
function index(){
    echo "hola";
}
    function enviar(){
        if($this->input->post('image')){
			$push = new Push(
                $this->input->post('title'),
                $this->input->post('message'),
                $this->input->post('image')
				);
		}else{
			//if the push don't have an image give null in place of image
			$push = new Push(
                $this->input->post('title'),
                $this->input->post('message'),
				null
				);
        }
        $mPushNotification = $push->getPush(); 
 
		//getting the token from database object 
		$devicetoken = $notificacion_model->token();
 
		//creating firebase class object 
		$firebase = new Firebase(); 
 
		//sending push notification and displaying result 
		echo $this->send($devicetoken, $mPushNotification);
    }


    public function send($registration_ids, $message) {
        $fields = array(
            'registration_ids' => $registration_ids,
            'data' => $message,
        );
        return $this->sendPushNotification($fields);
    }

    private function sendPushNotification($fields) {
         
        //importing the constant files
        
        
        //firebase server url to send the curl request
        $url = 'https://fcm.googleapis.com/fcm/send';
 
        //building headers for the request
        $headers = array(
            'Authorization: key=' . "AAAAeZ--NGY:APA91bGfLKk7AbiwV7dpYJMPrY-xvFvTielfUHNvsVnmvh6apSj16tnxXIhGV7ZsF1nhO8pJRKMCYWxxhPwDq2NjRAJQF39tgHpRDfU9ep-yCtIw-qCr1vYcAvG0_XPo5mXmau_SS7Ta",
            'Content-Type: application/json'
        );
 
        //Initializing curl to open a connection
        $ch = curl_init();
 
        //Setting the curl url
        curl_setopt($ch, CURLOPT_URL, $url);
        
        //setting the method as post
        curl_setopt($ch, CURLOPT_POST, true);
 
        //adding headers 
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
        //disabling ssl support
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        //adding the fields in json format 
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
 
        //finally executing the curl request 
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
 
        //Now close the connection
        curl_close($ch);
 
        //and return the result 
        return $result;
    }

}