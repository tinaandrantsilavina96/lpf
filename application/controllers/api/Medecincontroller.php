<?php
  require APPPATH .'/libraries/REST_controller.php';
  use Restserver\Libraries\REST_Controller;
  class Medecincontroller extends REST_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('cookie');
        $this->load->database();
		$this->load->model('MedecinModel');
    } 
      /////////// Connexion \\\\\\\\\\\\
      public function getall_get()
      {
          $data=$this->MedecinModel->getall();
          $this->response([
              'status'=>200,
              'data'=>$data
          ],REST_Controller::HTTP_OK);
      }

      public function getmedecinbyidspecialite_get($id)
      {
          $data=$this->MedecinModel->getmedecinbyidspecialite($id);
          $this->response([
              'status'=>200,
              'data'=>$data
          ],REST_Controller::HTTP_OK);
      }

      public function getmedecinbyid_get($id)
      {
          $data=$this->MedecinModel->getmedecinbyid($id);
          $this->response([
              'status'=>200,
              'data'=>$data
          ],REST_Controller::HTTP_OK);
      }


      public function recherchemedcin_post()
      {
          $data=$this->MedecinModel->recherchemedcin($this->input->post()['mot'] );
          $this->response([
              'status'=>200,
              'data'=>$data
          ],REST_Controller::HTTP_OK);
      }

      public function  getimage_get($id)
      {
          $data=$this->MedecinModel->getimage($id);
          $this->response([
              'status'=>200,
              'data'=>$data
          ],REST_Controller::HTTP_OK);
      }
}

?>
