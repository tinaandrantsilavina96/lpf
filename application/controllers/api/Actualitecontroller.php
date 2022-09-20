<?php
  require APPPATH .'/libraries/REST_controller.php';
  use Restserver\Libraries\REST_Controller;
  class Actualitecontroller extends REST_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('cookie');
        $this->load->database();
		$this->load->model('ActualiteModel');
        $this->load->model('UploadModel');
    }



      public function insertimage_post()
      {

          try {
              $input=$this->input->post();
//              $iduser=$input["iduser"];
//              $titre=$input["titre"];
//              $texte=$input["texte"];

              $this->ActualiteModel->insertImage(1);
              $ligneimage = $this->ActualiteModel->getLigneImage()-1;

//              $this->ActualiteModel->insert($iduser,$titre,$texte);
              $this->UploadModel->uploadImage("file", "assets/images/actualite/", "actualite-" . $ligneimage, 1000);
              $this->response([
                  'status' => 200,
                  'data' => $_FILES
              ], REST_Controller::HTTP_OK);
          } catch (Exception $e) {
              $this->response([
                  'status' => 201,
                  'data' => 'Erreur Ajout'
              ], REST_Controller::HTTP_OK);
          }
      }

      public function ligne_get()
      {
          $data=$this->ActualiteModel->getligne();
          $this->response([
              'status'=>200,
              'data'=>$data
          ],REST_Controller::HTTP_OK);
      }
      /////////// Connexion \\\\\\\\\\\\
      public function getall_get()
      {
          $data=$this->ActualiteModel->getall();
          $this->response([
              'status'=>200,
              'data'=>$data
          ],REST_Controller::HTTP_OK);
      }

      public function getalldetaille_get()
      {
          $data=$this->ActualiteModel->getalldetaille();
          $this->response([
              'status'=>200,
              'data'=>$data
          ],REST_Controller::HTTP_OK);
      }


      public function getdetaillebyid_get($id)
      {
          $data=$this->ActualiteModel->getdetaillebyid($id);
          $this->response([
              'status'=>200,
              'data'=>$data
          ],REST_Controller::HTTP_OK);
      }

      public function getbyid_get($id)
      {
          $data=$this->ActualiteModel->getbyid($id);
          $this->response([
              'status'=>200,
              'data'=>$data
          ],REST_Controller::HTTP_OK);
      }




      public function getdetaillebyiduser_get($id)
      {
          $data=$this->ActualiteModel->getdetaillebyiduser($id);
          $this->response([
              'status'=>200,
              'data'=>$data
          ],REST_Controller::HTTP_OK);
      }

      public function getbyiduser_get($id)
      {
          $data=$this->ActualiteModel->getbyiduser($id);
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
              $this->ActualiteModel->insert($iduser,$idspecialite,$titre,$question,$sexe,$taille,$poids,$masquernom,$traitement,$antecedant);
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
          $data=$this->ActualiteModel->getsousclassebyidclasse($id);
          $this->response([
              'status'=>200,
              'data'=>$data
          ],REST_Controller::HTTP_OK);
      }

      public function recherchemedicamentbysousclasse_get($id)
      {
          $data=$this->ActualiteModel->recherchemedicamentbysousclasse($id);
          $this->response([
              'status'=>200,
              'data'=>$data
          ],REST_Controller::HTTP_OK);
      }

      public function  getmedicamentdetaillebyid_get($id)
      {
          $data=$this->ActualiteModel->getmedicamentdetaillebyid($id);
          $this->response([
              'status'=>200,
              'data'=>$data
          ],REST_Controller::HTTP_OK);
      }

      public function recherchemedicament_post()
      {
          $data=$this->ActualiteModel->recherchemedicament($this->input->post()['mot'] );
          $this->response([
              'status'=>200,
              'data'=>$data
          ],REST_Controller::HTTP_OK);
      }

      public function  getimage_get($id)
      {
          $data=$this->ActualiteModel->getimage($id);
          $this->response([
              'status'=>200,
              'data'=>$data
          ],REST_Controller::HTTP_OK);
      }

      public function getUsertoken_post()
      {
//          $input=$this->input->post();
          $data["token"]=$this->ActualiteModel->getToken();
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
        $utilisateur=$this->ActualiteModel->getuserbytoken();

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
            $utilisateur=$this->ActualiteModel->getUser($input["user"],$input["mdp"]);

            //

            if($utilisateur!=null){
                $token=sha1($utilisateur[0]['iduser'].$user);
                $this->ActualiteModel->insertToken($utilisateur[0]['iduser'],$token);

                $data[]=$token;
                $data[]=$this->ActualiteModel->getuserbytoken($token);

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
              $utilisateur=$this->ActualiteModel->getUser($input["user"],$input["mdp"]);

              //

              if($utilisateur!=null){
                  $token=sha1($utilisateur[0]['iduser'].$user);
                  $this->ActualiteModel->insertToken($utilisateur[0]['iduser'],$token);

                  $data[]=$token;
                  $data[]=$this->ActualiteModel->getuserbytoken($token);

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
        $data=$this->ActualiteModel->gettypeuser();
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
            $utilisateur=$this->ActualiteModel->getUser($input["user"],$input["mdp"]);
            $data[]=$this->ActualiteModel->inscription($idtypeuser,$nomuser,$prenomuser,$sex,$user,$pass,$phone,$naissanceuser);

            $this->response([
                'status'=>200,
                'data'=>"ajout reussit"
            ],REST_Controller::HTTP_OK);
        }
    }


}
?>
