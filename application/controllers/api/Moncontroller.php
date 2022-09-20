<?php
  require APPPATH .'/libraries/REST_controller.php';
	define('token', "tikoo");
  use Restserver\Libraries\REST_Controller;
  class Moncontroller extends REST_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
		$this->load->helper('cookie');
		$this->load->database();
		$this->load->model('VmsqlModel');
    }


	public function sql_get()
	{
        $date1="2021-06-01 00:00:00";
		$date2="2021-06-30 23:59:59";
		$agence="FI";
        $account="1";
        $token=$this->VmsqlModel->getToken();
		if($token==token){
            $data=$this->VmsqlModel->parconsodetaille($date2);
//		$data=$this->VmsqlModel->parconsodetaille($date1);
            $this->response([
                'status'=>200,
                'data'=>$data
            ],REST_Controller::HTTP_OK);
		}else{
            $this->response([
                'status'=>201,
                'data'=>""
            ],REST_Controller::HTTP_OK);
		}
	}

    }
?>
