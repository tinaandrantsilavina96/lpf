<?php
  require APPPATH .'/libraries/REST_controller.php';
  use Restserver\Libraries\REST_Controller;
  class Rdvcontroller extends REST_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('cookie');
        $this->load->database();
		$this->load->model('RdvModel');
    } 
      /////////// Connexion \\\\\\\\\\\\
      public function getallrdv_get()
      {
          $data=$this->RdvModel->getallrdv();
          $this->response([
              'status'=>200,
              'data'=>$data
          ],REST_Controller::HTTP_OK);
      }

      public function getallrdvdetaille_get()
      {
          $data=$this->RdvModel->getallrdvdetaille();
          $this->response([
              'status'=>200,
              'data'=>$data
          ],REST_Controller::HTTP_OK);
      }


      public function getrdvdetaillebyid_get($id)
      {
          $data=$this->RdvModel->getrdvdetaillebyid($id);
          $this->response([
              'status'=>200,
              'data'=>$data
          ],REST_Controller::HTTP_OK);
      }

      public function getrdvbyid_get($id)
      {
          $data=$this->RdvModel->getrdvbyid($id);
          $this->response([
              'status'=>200,
              'data'=>$data
          ],REST_Controller::HTTP_OK);
      }




      public function getrdvdetaillebyiduser_get($id)
      {
          $data=$this->RdvModel->getrdvdetaillebyiduser($id);
          $this->response([
              'status'=>200,
              'data'=>$data
          ],REST_Controller::HTTP_OK);
      }

      public function getrdvbyiduser_get($id)
      {
          $data=$this->RdvModel->getrdvbyiduser($id);
          $this->response([
              'status'=>200,
              'data'=>$data
          ],REST_Controller::HTTP_OK);
      }



      public function insertrdv_post()
      {
          $input=$this->input->post();
          $iduserdocteur=$input["iduserdocteur"];
          $iduserclient=$input["iduserclient"];
          $daterdv=$input["daterdv"];

          if($iduserdocteur!=null && $iduserclient!=null && $daterdv!=null){
              $this->RdvModel->insertrdv($iduserdocteur,$iduserclient,$daterdv);
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
          $data=$this->RdvModel->getsousclassebyidclasse($id);
          $this->response([
              'status'=>200,
              'data'=>$data
          ],REST_Controller::HTTP_OK);
      }

      public function recherchemedicamentbysousclasse_get($id)
      {
          $data=$this->RdvModel->recherchemedicamentbysousclasse($id);
          $this->response([
              'status'=>200,
              'data'=>$data
          ],REST_Controller::HTTP_OK);
      }

      public function  getmedicamentdetaillebyid_get($id)
      {
          $data=$this->RdvModel->getmedicamentdetaillebyid($id);
          $this->response([
              'status'=>200,
              'data'=>$data
          ],REST_Controller::HTTP_OK);
      }

      public function recherchemedicament_post()
      {
          $data=$this->RdvModel->recherchemedicament($this->input->post()['mot'] );
          $this->response([
              'status'=>200,
              'data'=>$data
          ],REST_Controller::HTTP_OK);
      }

      public function  getimage_get($id)
      {
          $data=$this->RdvModel->getimage($id);
          $this->response([
              'status'=>200,
              'data'=>$data
          ],REST_Controller::HTTP_OK);
      }

      public function getUsertoken_post()
      {
//          $input=$this->input->post();
          $data["token"]=$this->RdvModel->getToken();
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
        $utilisateur=$this->RdvModel->getuserbytoken();

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
            $utilisateur=$this->RdvModel->getUser($input["user"],$input["mdp"]);

            //

            if($utilisateur!=null){
                $token=sha1($utilisateur[0]['iduser'].$user);
                $this->RdvModel->insertToken($utilisateur[0]['iduser'],$token);

                $data[]=$token;
                $data[]=$this->RdvModel->getuserbytoken($token);

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
              $utilisateur=$this->RdvModel->getUser($input["user"],$input["mdp"]);

              //

              if($utilisateur!=null){
                  $token=sha1($utilisateur[0]['iduser'].$user);
                  $this->RdvModel->insertToken($utilisateur[0]['iduser'],$token);

                  $data[]=$token;
                  $data[]=$this->RdvModel->getuserbytoken($token);

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
        $data=$this->RdvModel->gettypeuser();
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
            $utilisateur=$this->RdvModel->getUser($input["user"],$input["mdp"]);
            $data[]=$this->RdvModel->inscription($idtypeuser,$nomuser,$prenomuser,$sex,$user,$pass,$phone,$naissanceuser);

            $this->response([
                'status'=>200,
                'data'=>"ajout reussit"
            ],REST_Controller::HTTP_OK);
        }
    }
}




//	 public function getUsertoken_post()
//	 {
//	 	$input=$this->input->post();
//	 	$data["token"]=$this->RdvModel->getuserbytoken($input["token"]);
//	 	if(!empty($data))
//	 	{
//	 		$this->response([
//	 				'status'=>200,
//	 				'data'=>$data
//	 			],REST_Controller::HTTP_OK);
//	 	}
//	 	else
//	 	{
//	 		$this->response([
//	 			'status'=>201,
//	 			'data'=>$data
//	 		],REST_Controller::HTTP_OK);
//	 	}
//
//         $this->response([
//             'status'=>200,
//             'data'=>$this->input->post('token')
//         ],REST_Controller::HTTP_OK);
//	 }


//	 public function gettoken_get()
//	 {
//	 	$data[0]=$this->RdvModel->getuserbytokenheader();
//         if($data[0]!=null){
//             $data[1]=$this->RdvModel->getToken();
//             $this->response([
//                 'status'=>200,
//                 'data'=>$data
//             ],REST_Controller::HTTP_OK);
//         }
//         else{
//             $this->response([
//                 'status'=>201,
//                 'data'=>''
//             ],REST_Controller::HTTP_OK);
//         }
//	 }
?>
