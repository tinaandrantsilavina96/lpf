<?php
  require APPPATH .'/libraries/REST_controller.php';
  use Restserver\Libraries\REST_Controller;
  class Specialitecontroller extends REST_Controller
  {
      public function __construct()
      {
          parent::__construct();
          $this->load->library('session');
          $this->load->helper('url');
          $this->load->helper('cookie');
          $this->load->database();
          $this->load->model('SpecialiteModel');
      }

      /////////// Connexion \\\\\\\\\\\\
      public function getall_get()
      {
          $data = $this->SpecialiteModel->getall();
          $this->response([
              'status' => 200,
              'data' => $data
          ], REST_Controller::HTTP_OK);
      }
//
//      public function getsousclassebyidclasse_get($id)
//      {
//          $data = $this->SpecialiteModel->getsousclassebyidclasse($id);
//          $this->response([
//              'status' => 200,
//              'data' => $data
//          ], REST_Controller::HTTP_OK);
//      }
//
//      public function recherchemedicamentbysousclasse_get($id)
//      {
//          $data = $this->SpecialiteModel->recherchemedicamentbysousclasse($id);
//          $this->response([
//              'status' => 200,
//              'data' => $data
//          ], REST_Controller::HTTP_OK);
//      }
//
//      public function getmedicamentdetaillebyid_get($id)
//      {
//          $data = $this->SpecialiteModel->getmedicamentdetaillebyid($id);
//          $this->response([
//              'status' => 200,
//              'data' => $data
//          ], REST_Controller::HTTP_OK);
//      }
//
//      public function recherchemedicament_post()
//      {
//          $data = $this->SpecialiteModel->recherchemedicament($this->input->post()['mot']);
//          $this->response([
//              'status' => 200,
//              'data' => $data
//          ], REST_Controller::HTTP_OK);
//      }
//
//      public function getimage_get($id)
//      {
//          $data = $this->SpecialiteModel->getimage($id);
//          $this->response([
//              'status' => 200,
//              'data' => $data
//          ], REST_Controller::HTTP_OK);
//      }

  }
?>
