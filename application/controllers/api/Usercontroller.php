<?php
  require APPPATH .'/libraries/REST_controller.php';
  use Restserver\Libraries\REST_Controller;
  class Usercontroller extends REST_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('cookie');
        $this->load->database();
		$this->load->model('UserModel');
    } 
      /////////// Connexion \\\\\\\\\\\\
      public function getUsertoken_post()
      {
//          $input=$this->input->post();
          $data["token"]=$this->UserModel->getToken();
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
    public function gettoken_get()
    {
        $data['token']=$this->UserModel->getToken();
        $this->response([
            'status'=>200,
            'data'=>$data
        ],REST_Controller::HTTP_OK);
    }


    public function getuserbytoken_post()
    {
        $input=$this->input->post();
        $utilisateur=$this->UserModel->getuserbytoken();

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
            $utilisateur=$this->UserModel->getUser($input["user"],$input["mdp"]);

            //

            if($utilisateur!=null){
                $token=sha1($utilisateur[0]['iduser'].$user);
                $this->UserModel->insertToken($utilisateur[0]['iduser'],$token);

                $data[]=$token;
                $data[]=$this->UserModel->getuserbytoken($token);

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
              $utilisateur=$this->UserModel->getUser($input["user"],$input["mdp"]);
              //
              if($utilisateur!=null){
                  $token=sha1($utilisateur[0]['iduser'].$user);
                  $this->UserModel->insertToken($utilisateur[0]['iduser'],$token);

                  $data[]=$token;
                  $data[]=$this->UserModel->getuserbytoken($token);

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
        $data=$this->UserModel->gettypeuser();
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
            $utilisateur=$this->UserModel->getUser($input["user"],$input["mdp"]);
            $data[]=$this->UserModel->inscription($idtypeuser,$nomuser,$prenomuser,$sex,$user,$pass,$phone,$naissanceuser);

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
//	 	$data["token"]=$this->UserModel->getuserbytoken($input["token"]);
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
//	 	$data[0]=$this->UserModel->getuserbytokenheader();
//         if($data[0]!=null){
//             $data[1]=$this->UserModel->getToken();
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
