<?php
  require APPPATH .'/libraries/REST_controller.php';
  use Restserver\Libraries\REST_Controller;
  class Reponsecontroller extends REST_Controller
  {
      public function __construct()
      {
          parent::__construct();
          $this->load->library('session');
          $this->load->helper('url');
          $this->load->helper('cookie');
          $this->load->database();
          $this->load->model('ReponseModel');
      }

      /////////// Connexion \\\\\\\\\\\\
      public function getall_get()
      {
          $data = $this->ReponseModel->getall();
          $this->response([
              'status' => 200,
              'data' => $data
          ], REST_Controller::HTTP_OK);
      }

      public function getalldetaille_get()
      {
          $data = $this->ReponseModel->getalldetaille();
          $this->response([
              'status' => 200,
              'data' => $data
          ], REST_Controller::HTTP_OK);
      }


      public function getdetaillebyid_get($id)
      {
          $data = $this->ReponseModel->getdetaillebyid($id);
          $this->response([
              'status' => 200,
              'data' => $data
          ], REST_Controller::HTTP_OK);
      }

      public function getbyid_get($id)
      {
          $data = $this->ReponseModel->getbyid($id);
          $this->response([
              'status' => 200,
              'data' => $data
          ], REST_Controller::HTTP_OK);
      }


      public function getdetaillebyiduser_get($id)
      {
          $data = $this->ReponseModel->getdetaillebyiduser($id);
          $this->response([
              'status' => 200,
              'data' => $data
          ], REST_Controller::HTTP_OK);
      }

      public function getbyiduser_get($id)
      {
          $data = $this->ReponseModel->getbyiduser($id);
          $this->response([
              'status' => 200,
              'data' => $data
          ], REST_Controller::HTTP_OK);
      }


      public function insert_post()
      {
          $input = $this->input->post();
          $idquestion = $input["idquestion"];
          $iduserdocteur = $input["iduserdocteur"];
          $reponse = $input["reponse"];

          if ($idquestion != null && $iduserdocteur != null && $reponse != null ) {
              $this->ReponseModel->insert($idquestion,$iduserdocteur,$reponse);
              $this->response([
                  'status' => 200,
                  'data' => 'Ajout reussit'
              ], REST_Controller::HTTP_OK);
          } else {
              $this->response([
                  'status' => 201,
                  'data' => 'Erreur Ajout'
              ], REST_Controller::HTTP_OK);
          }
      }

      public function getimage_get($id)
      {
          $data = $this->ReponseModel->getimage($id);
          $this->response([
              'status' => 200,
              'data' => $data
          ], REST_Controller::HTTP_OK);
      }
}
?>
