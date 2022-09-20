<?php
  require APPPATH .'/libraries/REST_controller.php';
  use Restserver\Libraries\REST_Controller;
  class Questioncontroller extends REST_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('cookie');
        $this->load->database();
		$this->load->model('QuestionModel');
    } 
      /////////// Connexion \\\\\\\\\\\\
      public function getall_get()
      {
          $data=$this->QuestionModel->getall();
          $this->response([
              'status'=>200,
              'data'=>$data
          ],REST_Controller::HTTP_OK);
      }

      public function getalldetaille_get()
      {
          $data=$this->QuestionModel->getalldetaille();
          $this->response([
              'status'=>200,
              'data'=>$data
          ],REST_Controller::HTTP_OK);
      }


      public function getdetaillebyid_get($id)
      {
          $data=$this->QuestionModel->getdetaillebyid($id);
          $this->response([
              'status'=>200,
              'data'=>$data
          ],REST_Controller::HTTP_OK);
      }

      public function getbyid_get($id)
      {
          $data=$this->QuestionModel->getbyid($id);
          $this->response([
              'status'=>200,
              'data'=>$data
          ],REST_Controller::HTTP_OK);
      }




      public function getdetaillebyiduser_get($id)
      {
          $data=$this->QuestionModel->getdetaillebyiduser($id);
          $this->response([
              'status'=>200,
              'data'=>$data
          ],REST_Controller::HTTP_OK);
      }

      public function getbyiduser_get($id)
      {
          $data=$this->QuestionModel->getbyiduser($id);
          $this->response([
              'status'=>200,
              'data'=>$data
          ],REST_Controller::HTTP_OK);
      }


      public function insert_post()
      {
          $input=$this->input->post();
          $iduser=$input["iduser"];
          $idspecialite=$input["idspecialite"];
          $titre=$input["titre"];
          $question=$input["question"];
          $sexe=$input["sexe"];
          $taille=$input["taille"];
          $poids=$input["poids"];
          $masquernom=$input["masquernom"];
          $traitement=$input["traitement"];
          $antecedant=$input["antecedant"];
          if($iduser !=null && $idspecialite !=null && $titre !=null && $question  !=null && $sexe  !=null && $taille !=null && $poids  !=null && $masquernom  !=null && $traitement  !=null && $antecedant  !=null){
              $this->QuestionModel->insert($iduser,$idspecialite,$titre,$question,$sexe,$taille,$poids,$masquernom,$traitement,$antecedant);
              $this->response([
                  'status'=>200,
                  'data'=>'Ajout reussit'
              ],REST_Controller::HTTP_OK);
          }else{
              $this->response([
                  'status'=>201,
                  'data'=>'Erreur Ajout'
              ],REST_Controller::HTTP_OK);
          }
      }
      public function getsousclassebyidclasse_get($id)
      {
          $data=$this->QuestionModel->getsousclassebyidclasse($id);
          $this->response([
              'status'=>200,
              'data'=>$data
          ],REST_Controller::HTTP_OK);
      }

      public function recherchemedicamentbysousclasse_get($id)
      {
          $data=$this->QuestionModel->recherchemedicamentbysousclasse($id);
          $this->response([
              'status'=>200,
              'data'=>$data
          ],REST_Controller::HTTP_OK);
      }

      public function  getmedicamentdetaillebyid_get($id)
      {
          $data=$this->QuestionModel->getmedicamentdetaillebyid($id);
          $this->response([
              'status'=>200,
              'data'=>$data
          ],REST_Controller::HTTP_OK);
      }

      public function recherchemedicament_post()
      {
          $data=$this->QuestionModel->recherchemedicament($this->input->post()['mot'] );
          $this->response([
              'status'=>200,
              'data'=>$data
          ],REST_Controller::HTTP_OK);
      }

      public function  getimage_get($id)
      {
          $data=$this->QuestionModel->getimage($id);
          $this->response([
              'status'=>200,
              'data'=>$data
          ],REST_Controller::HTTP_OK);
      }

      public function getUsertoken_post()
      {
//          $input=$this->input->post();
          $data["token"]=$this->QuestionModel->getToken();
          if(!empty($data))
          {
              $this->response([
                  'status'=>200,
                  'data'=>$data
              ],REST_Controller::HTTP_OK);
          }
          else
          {
              $this->response([
                  'status'=>201,
                  'data'=>$data
              ],REST_Controller::HTTP_OK);
          }

          $this->response([
              'status'=>200,
              'data'=>$this->input->post('token')
          ],REST_Controller::HTTP_OK);
      }



    public function getuserbytoken_post()
    {
        $input=$this->input->post();
        $utilisateur=$this->QuestionModel->getuserbytoken();

        if($utilisateur!=null){
            $data["user"]=$utilisateur;
            $this->response([
                'status'=>200,
                'data'=>$data
            ],REST_Controller::HTTP_OK);
        }
        else{
            $this->response([
                'status'=>201,
                'data'=>''
            ],REST_Controller::HTTP_OK);
        }
    }
///// Test an ilay tut ftsn

    public function login_post()
    {
        $input=$this->input->post();
//	 	var_dump($input);
        $user=$input["user"];
        if(!empty($user)){
            $utilisateur=$this->QuestionModel->getUser($input["user"],$input["mdp"]);

            //

            if($utilisateur!=null){
                $token=sha1($utilisateur[0]['iduser'].$user);
                $this->QuestionModel->insertToken($utilisateur[0]['iduser'],$token);

                $data[]=$token;
                $data[]=$this->QuestionModel->getuserbytoken($token);

                $this->response([
                    'status'=>200,
                    'data'=>$data
                ],REST_Controller::HTTP_OK);
            }
            else{
                $this->response([
                    'status'=>201,
                    'data'=>""
                ],REST_Controller::HTTP_OK);
            }
        }
    }

	  public function connexion_post()
	 {
         $input=$this->input->post();
//	 	var_dump($input);
          $user=$input["user"];
          if(!empty($user)){
              $utilisateur=$this->QuestionModel->getUser($input["user"],$input["mdp"]);

              //

              if($utilisateur!=null){
                  $token=sha1($utilisateur[0]['iduser'].$user);
                  $this->QuestionModel->insertToken($utilisateur[0]['iduser'],$token);

                  $data[]=$token;
                  $data[]=$this->QuestionModel->getuserbytoken($token);

                  $this->response([
                      'status'=>200,
                      'data'=>$data
                  ],REST_Controller::HTTP_OK);
              }
              else{
                  $this->response([
                      'status'=>201,
                      'data'=>""
                  ],REST_Controller::HTTP_OK);
              }
          }
	 }




    /////////// Inscription \\\\\\\\\\\\

    public function gettypeuser_get()
    {
        $data=$this->QuestionModel->gettypeuser();
        $this->response([
            'status'=>200,
            'data'=>$data
        ],REST_Controller::HTTP_OK);
    }

    public function inscription_post()
    {
        $input=$this->input->post();
        $idtypeuser=$input["idtypeuser"];
        $nomuser=$input["nom"];
        $prenomuser=$input["prenom"];
        $sex=$input["sexe"];
        $user=$input["user"];
        $pass=$input["mdp"];
        $phone=$input["phone"];
        $naissanceuser=$input["naissance"];
//	 	var_dump($input);
//        $user=$input["user"];
        if(!empty($input)){
            $utilisateur=$this->QuestionModel->getUser($input["user"],$input["mdp"]);
            $data[]=$this->QuestionModel->inscription($idtypeuser,$nomuser,$prenomuser,$sex,$user,$pass,$phone,$naissanceuser);

            $this->response([
                'status'=>200,
                'data'=>"ajout reussit"
            ],REST_Controller::HTTP_OK);
        }
    }
}
?>
