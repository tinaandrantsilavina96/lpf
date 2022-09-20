<?php
  require APPPATH .'/libraries/REST_controller.php';
	define('token', "tikoo");
  use Restserver\Libraries\REST_Controller;
  class Vmcontroller extends REST_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
		$this->load->helper('cookie');
		$this->load->database();
		$this->load->model('VmsqlModel');
    }


	public function testrepay_post()
	{
        $input=$this->input->post();
        $lnr=$input["lnr"];

        $token=$this->VmsqlModel->getToken();
		if($token==token){
            $data=$this->VmsqlModel->testrepay($lnr);
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

      public function impaye_post()
      {
          $input=$this->input->post();
          $date=$input["date"];
          $lnr=$input["lnr"];

          $token=$this->VmsqlModel->getToken();
          if($token==token){
              $data=$this->VmsqlModel->impaye($lnr,$date);
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
//
//
//

      public function benefic_post()
      {
          $input=$this->input->post();
          $cluscode=$input["cluscode"];

          $token=$this->VmsqlModel->getToken();
          if($token==token){
              $data=$this->VmsqlModel->benefic($cluscode);
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
    public function lrb_post()
      {

          $token=$this->VmsqlModel->getToken();
          if($token==token){
              $data=$this->VmsqlModel->lrb();
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
      public function parconsodetaille_post()
      {
          $input=$this->input->post();
          $date=$input["date"];

          $token=$this->VmsqlModel->getToken();
          if($token==token){
              $data=$this->VmsqlModel->parconsodetaille($date);
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


    public function parconsodetaillebenefic_post()
    {
        $input=$this->input->post();
        $date=$input["date"];

        $token=$this->VmsqlModel->getToken();
        if($token==token){
            $data=$this->VmsqlModel->parconsodetaillebenefic($date);
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

    public function parconsoresumer_post()
    {
        $input = $this->input->post();
        $date = $input["date"];

        $token = $this->VmsqlModel->getToken();
        if ($token == token) {
            $data = $this->VmsqlModel->parconsoresumer($date);
            $this->response([
                'status' => 200,
                'data' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => 201,
                'data' => ""
            ], REST_Controller::HTTP_OK);
        }
    }

    public function paragencedetaille_post()
    {
        $input = $this->input->post();
        $date = $input["date"];
        $agence = $input["agence"];

        $token = $this->VmsqlModel->getToken();
        if ($token == token) {
            $data = $this->VmsqlModel->paragencedetaille($date,$agence);
            $this->response([
                'status' => 200,
                'data' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => 201,
                'data' => ""
            ], REST_Controller::HTTP_OK);
        }
    }

    public function paragenceresumer_post()
    {
        $input = $this->input->post();
        $date = $input["date"];
        $agence = $input["agence"];

        $token = $this->VmsqlModel->getToken();
        if ($token == token) {
            $data = $this->VmsqlModel->paragenceresumer($date,$agence);
            $this->response([
                'status' => 200,
                'data' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => 201,
                'data' => ""
            ], REST_Controller::HTTP_OK);
        }
    }


    public function paragencedetaillebenefic_post()
    {
        $input = $this->input->post();
        $date = $input["date"];
        $agence = $input["agence"];

        $token = $this->VmsqlModel->getToken();
        if ($token == token) {
            $data = $this->VmsqlModel->paragencedetaillebenefic($date,$agence);
            $this->response([
                'status' => 200,
                'data' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => 201,
                'data' => ""
            ], REST_Controller::HTTP_OK);
        }
    }

    public function paracall_post()
    {
        $input = $this->input->post();
        $date = $input["date"];
        $token = $this->VmsqlModel->getToken();
        if ($token == token) {
            $data = $this->VmsqlModel->paracall($date);
            $this->response([
                'status' => 200,
                'data' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => 201,
                'data' => ""
            ], REST_Controller::HTTP_OK);
        }
    }


    public function parofficier1all_post()
    {
        $input = $this->input->post();
        $date = $input["date"];
        $token = $this->VmsqlModel->getToken();
        if ($token == token) {
            $data = $this->VmsqlModel->parofficier1all($date);
            $this->response([
                'status' => 200,
                'data' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => 201,
                'data' => ""
            ], REST_Controller::HTTP_OK);
        }
    }


    public function parconsoresumer2_post()
    {
        $input = $this->input->post();
        $date = $input["date"];
        $token = $this->VmsqlModel->getToken();
        if ($token == token) {
            $data = $this->VmsqlModel->parconsoresumer2($date);
            $this->response([
                'status' => 200,
                'data' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => 201,
                'data' => ""
            ], REST_Controller::HTTP_OK);
        }
    }

    public function ep_post()
    {
        $input = $this->input->post();
        $date = $input["date"];
        $produit = $input["produit"];
        $token = $this->VmsqlModel->getToken();
        if ($token == token) {
            $data = $this->VmsqlModel->ep($date,$produit);
            $this->response([
                'status' => 200,
                'data' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => 201,
                'data' => ""
            ], REST_Controller::HTTP_OK);
        }
    }

    public function ep_all_post()
    {
        $input = $this->input->post();
        $date = $input["date"];
        $token = $this->VmsqlModel->getToken();
        if ($token == token) {
            $data = $this->VmsqlModel->ep_all($date);
            $this->response([
                'status' => 200,
                'data' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => 201,
                'data' => ""
            ], REST_Controller::HTTP_OK);
        }
    }


    public function dat_post()
    {
        $input = $this->input->post();
        $date = $input["date"];
        $token = $this->VmsqlModel->getToken();
        if ($token == token) {
            $data = $this->VmsqlModel->dat($date);
            $this->response([
                'status' => 200,
                'data' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => 201,
                'data' => ""
            ], REST_Controller::HTTP_OK);
        }
    }


    public function credit_post()
    {
        $token = $this->VmsqlModel->getToken();
        if ($token == token) {
            $data = $this->VmsqlModel->credit();
            $this->response([
                'status' => 200,
                'data' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => 201,
                'data' => ""
            ], REST_Controller::HTTP_OK);
        }
    }
    public function creditdateconso_post()
    {
        $input = $this->input->post();
        $date1 = $input["date1"];
        $date2 = $input["date2"];
        $token = $this->VmsqlModel->getToken();
        if ($token == token) {
            $data = $this->VmsqlModel->creditdateconso($date1,$date2);
            $this->response([
                'status' => 200,
                'data' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => 201,
                'data' => ""
            ], REST_Controller::HTTP_OK);
        }
    }

    public function creditdateagence_post()
    {
        $input = $this->input->post();
        $date1 = $input["date1"];
        $date2 = $input["date2"];
        $agence = $input["agence"];
        $token = $this->VmsqlModel->getToken();
        if ($token == token) {
            $data = $this->VmsqlModel->creditdateagence($date1,$date2,$agence);
            $this->response([
                'status' => 200,
                'data' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => 201,
                'data' => ""
            ], REST_Controller::HTTP_OK);
        }
    }

    public function creditbeneficdateconso_post()
    {
        $input = $this->input->post();
        $date1 = $input["date1"];
        $date2 = $input["date2"];
        $token = $this->VmsqlModel->getToken();
        if ($token == token) {
            $data = $this->VmsqlModel->creditbeneficdateconso($date1,$date2);
            $this->response([
                'status' => 200,
                'data' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => 201,
                'data' => ""
            ], REST_Controller::HTTP_OK);
        }
    }
    public function creditbeneficdateagence_post()
    {
        $input = $this->input->post();
        $date1 = $input["date1"];
        $date2 = $input["date2"];
        $agence = $input["agence"];
        $token = $this->VmsqlModel->getToken();
        if ($token == token) {
            $data = $this->VmsqlModel->creditbeneficdateagence($date1,$date2,$agence);
            $this->response([
                'status' => 200,
                'data' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => 201,
                'data' => ""
            ], REST_Controller::HTTP_OK);
        }
    }
    public function clientnonapprouverdateconso_post()
    {
        $input = $this->input->post();
        $date = $input["date"];
        $token = $this->VmsqlModel->getToken();
        if ($token == token) {
            $data = $this->VmsqlModel->clientnonapprouverdateconso($date);
            $this->response([
                'status' => 200,
                'data' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => 201,
                'data' => ""
            ], REST_Controller::HTTP_OK);
        }
    }

    public function allHajaryTab1Apimf_post()
    {
        $input = $this->input->post();
        $date = $input["date"];
        $token = $this->VmsqlModel->getToken();
        if ($token == token) {
            $data = $this->VmsqlModel->allHajaryTab1Apimf($date);
            $this->response([
                'status' => 200,
                'data' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => 201,
                'data' => ""
            ], REST_Controller::HTTP_OK);
        }
    }
    public function creditparproduit_post()
    {
        $input = $this->input->post();
        $date1 = $input["date1"];
        $date2 = $input["date2"];
        $token = $this->VmsqlModel->getToken();
        if ($token == token) {
            $data = $this->VmsqlModel->creditparproduit($date1,$date2);
            $this->response([
                'status' => 200,
                'data' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => 201,
                'data' => ""
            ], REST_Controller::HTTP_OK);
        }
    }
    public function creditnonapprouverdateconso_post()
    {
        $input = $this->input->post();
        $date = $input["date"];
        $token = $this->VmsqlModel->getToken();
        if ($token == token) {
            $data = $this->VmsqlModel->creditnonapprouverdateconso($date);
            $this->response([
                'status' => 200,
                'data' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => 201,
                'data' => ""
            ], REST_Controller::HTTP_OK);
        }
    }


    public function budgetallreelconso_post()
    {
        $input = $this->input->post();
        $date1 = $input["date1"];
        $date2 = $input["date2"];
        $token = $this->VmsqlModel->getToken();
        if ($token == token) {
            $data = $this->VmsqlModel->budgetallreelconso($date1,$date2);
            $this->response([
                'status' => 200,
                'data' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => 201,
                'data' => ""
            ], REST_Controller::HTTP_OK);
        }
    }
    public function budgetallreelagence_post()
    {
        $input = $this->input->post();
        $date1 = $input["date1"];
        $date2 = $input["date2"];
        $agence = $input["agence"];
        $token = $this->VmsqlModel->getToken();
        if ($token == token) {
            $data = $this->VmsqlModel->budgetallreelagence($date1,$date2,$agence);
            $this->response([
                'status' => 200,
                'data' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => 201,
                'data' => ""
            ], REST_Controller::HTTP_OK);
        }
    }
    public function budgetreelconso_post()
    {
        $input = $this->input->post();
        $date1 = $input["date1"];
        $date2 = $input["date2"];
        $token = $this->VmsqlModel->getToken();
        if ($token == token) {
            $data = $this->VmsqlModel->budgetreelconso($date1,$date2);
            $this->response([
                'status' => 200,
                'data' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => 201,
                'data' => ""
            ], REST_Controller::HTTP_OK);
        }
    }
    public function budgetreelagence_post()
    {
        $input = $this->input->post();
        $date1 = $input["date1"];
        $date2 = $input["date2"];
        $agence = $input["agence"];
        $token = $this->VmsqlModel->getToken();
        if ($token == token) {
            $data = $this->VmsqlModel->budgetreelagence($date1,$date2,$agence);
            $this->response([
                'status' => 200,
                'data' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => 201,
                'data' => ""
            ], REST_Controller::HTTP_OK);
        }
    }
    public function totalcreditproduitintervalleConso_post()
    {
        $input = $this->input->post();
        $date1 = $input["date1"];
        $date2 = $input["date2"];
        $produit = $input["produit"];
        $token = $this->VmsqlModel->getToken();
        if ($token == token) {
            $data = $this->VmsqlModel->totalcreditproduitintervalleConso($date1,$date2,$produit);
            $this->response([
                'status' => 200,
                'data' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => 201,
                'data' => ""
            ], REST_Controller::HTTP_OK);
        }
    }

    public function totalcreditallproduitintervalleconso_post()
    {
        $input = $this->input->post();
        $date1 = $input["date1"];
        $date2 = $input["date2"];
        $token = $this->VmsqlModel->getToken();
        if ($token == token) {
            $data = $this->VmsqlModel->totalcreditallproduitintervalleconso($date1,$date2);
            $this->response([
                'status' => 200,
                'data' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => 201,
                'data' => ""
            ], REST_Controller::HTTP_OK);
        }
    }
    public function totalcreditproduitintervalleagence_post()
    {
        $input = $this->input->post();
        $date1 = $input["date1"];
        $date2 = $input["date2"];
        $produit = $input["produit"];
        $agence = $input["agence"];
        $token = $this->VmsqlModel->getToken();
        if ($token == token) {
            $data = $this->VmsqlModel->totalcreditproduitintervalleagence($date1,$date2,$agence,$produit);
            $this->response([
                'status' => 200,
                'data' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => 201,
                'data' => ""
            ], REST_Controller::HTTP_OK);
        }
    }


    public function datdetailleconso_post()
    {
        $input = $this->input->post();
        $date = $input["date"];;
        $token = $this->VmsqlModel->getToken();
        if ($token == token) {
            $data = $this->VmsqlModel->datdetailleconso($date);
            $this->response([
                'status' => 200,
                'data' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => 201,
                'data' => ""
            ], REST_Controller::HTTP_OK);
        }
    }


    public function totalcreditallproduitintervalleagence_post()
    {
        $input = $this->input->post();
        $date1 = $input["date1"];
        $date2 = $input["date2"];
        $agence = $input["agence"];
        $token = $this->VmsqlModel->getToken();
        if ($token == token) {
            $data = $this->VmsqlModel->totalcreditallproduitintervalleagence($date1,$date2,$agence);
            $this->response([
                'status' => 200,
                'data' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => 201,
                'data' => ""
            ], REST_Controller::HTTP_OK);
        }
    }

    public function datdetailleagence_post()
    {
        $input = $this->input->post();
        $date = $input["date"];
        $agence = $input["agence"];
        $token = $this->VmsqlModel->getToken();
        if ($token == token) {
            $data = $this->VmsqlModel->datdetailleagence($date,$agence);
            $this->response([
                'status' => 200,
                'data' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => 201,
                'data' => ""
            ], REST_Controller::HTTP_OK);
        }
    }
    public function allhajaryconso_post()
    {
        $input = $this->input->post();
        $date = $input["date"];;
        $token = $this->VmsqlModel->getToken();
        if ($token == token) {
            $data = $this->VmsqlModel->allhajaryconso($date);
            $this->response([
                'status' => 200,
                'data' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => 201,
                'data' => ""
            ], REST_Controller::HTTP_OK);
        }
    }

    public function allhajaryagence_post()
    {
        $input = $this->input->post();
        $date = $input["date"];
        $agence = $input["agence"];
        $token = $this->VmsqlModel->getToken();
        if ($token == token) {
            $data = $this->VmsqlModel->allhajaryagence($date,$agence);
            $this->response([
                'status' => 200,
                'data' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => 201,
                'data' => ""
            ], REST_Controller::HTTP_OK);
        }
    }

    public function totalallhajaryagence_post()
    {
        $input = $this->input->post();
        $date1 = $input["date1"];
        $date2 = $input["date2"];
        $agence = $input["agence"];
        $token = $this->VmsqlModel->getToken();
        if ($token == token) {
            $data = $this->VmsqlModel->totalallhajaryagence($date1, $date2, $agence);
            $this->response([
                'status' => 200,
                'data' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => 201,
                'data' => ""
            ], REST_Controller::HTTP_OK);
        }
    }

    public function totalallhajaryconso_post()
    {
        $input = $this->input->post();
        $date1 = $input["date1"];
        $date2 = $input["date2"];
        $token = $this->VmsqlModel->getToken();
        if ($token == token) {
            $data = $this->VmsqlModel->totalallhajaryconso($date1, $date2);
            $this->response([
                'status' => 200,
                'data' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => 201,
                'data' => ""
            ], REST_Controller::HTTP_OK);
        }
    }

    public function parproduitconso_post()
    {
        $input = $this->input->post();
        $date = $input["date"];
        $token = $this->VmsqlModel->getToken();
        if ($token == token) {
            $data = $this->VmsqlModel->parproduitconso($date);
            $this->response([
                'status' => 200,
                'data' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => 201,
                'data' => ""
            ], REST_Controller::HTTP_OK);
        }
    }

    public function parproduitagence_post()
    {
        $input = $this->input->post();
        $date = $input["date"];
        $agence = $input["agence"];
        $token = $this->VmsqlModel->getToken();
        if ($token == token) {
            $data = $this->VmsqlModel->parproduitagence($date,$agence);
            $this->response([
                'status' => 200,
                'data' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => 201,
                'data' => ""
            ], REST_Controller::HTTP_OK);
        }
    }

    public function parproduitliste2_post()
    {
        $token = $this->VmsqlModel->getToken();
        if ($token == token) {
            $data = $this->VmsqlModel->parproduitliste2();
            $this->response([
                'status' => 200,
                'data' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => 201,
                'data' => ""
            ], REST_Controller::HTTP_OK);
        }
    }

    public function parproduitliste1_post()
    {
        $token = $this->VmsqlModel->getToken();
        if ($token == token) {
            $data = $this->VmsqlModel->parproduitliste1();
            $this->response([
                'status' => 200,
                'data' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => 201,
                'data' => ""
            ], REST_Controller::HTTP_OK);
        }
    }


    public function parproduitconso1_post()
    {
        $input = $this->input->post();
        $date = $input["date"];
        $token = $this->VmsqlModel->getToken();
        if ($token == token) {
            $data = $this->VmsqlModel->parproduitconso1($date);
            $this->response([
                'status' => 200,
                'data' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => 201,
                'data' => ""
            ], REST_Controller::HTTP_OK);
        }
    }


    public function parproduitconso2_post()
    {
        $input = $this->input->post();
        $date = $input["date"];
        $token = $this->VmsqlModel->getToken();
        if ($token == token) {
            $data = $this->VmsqlModel->parproduitconso2($date);
            $this->response([
                'status' => 200,
                'data' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => 201,
                'data' => ""
            ], REST_Controller::HTTP_OK);
        }
    }

    public function parproduitconsoresumer_post()
    {
        $input = $this->input->post();
        $date = $input["date"];
        $token = $this->VmsqlModel->getToken();
        if ($token == token) {
            $data = $this->VmsqlModel->parproduitconsoresumer($date);
            $this->response([
                'status' => 200,
                'data' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => 201,
                'data' => ""
            ], REST_Controller::HTTP_OK);
        }
    }

    public function parproduitagence1_post()
    {
        $input = $this->input->post();
        $date = $input["date"];
        $agence = $input["agence"];
        $token = $this->VmsqlModel->getToken();
        if ($token == token) {
            $data = $this->VmsqlModel->parproduitagence1($date,$agence);
            $this->response([
                'status' => 200,
                'data' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => 201,
                'data' => ""
            ], REST_Controller::HTTP_OK);
        }
    }

    public function parproduitagence2_post()
    {
        $input = $this->input->post();
        $date = $input["date"];
        $agence = $input["agence"];
        $token = $this->VmsqlModel->getToken();
        if ($token == token) {
            $data = $this->VmsqlModel->parproduitagence2($date,$agence);
            $this->response([
                'status' => 200,
                'data' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => 201,
                'data' => ""
            ], REST_Controller::HTTP_OK);
        }
    }

    public function parproduitagenceresumer_post()
    {
        $input = $this->input->post();
        $date = $input["date"];
        $agence = $input["agence"];
        $token = $this->VmsqlModel->getToken();
        if ($token == token) {
            $data = $this->VmsqlModel->parproduitagenceresumer($date,$agence);
            $this->response([
                'status' => 200,
                'data' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => 201,
                'data' => ""
            ], REST_Controller::HTTP_OK);
        }
    }


    public function budgetdetailleagence_post()
    {
        $input = $this->input->post();
        $date1 = $input["date1"];
        $date2 = $input["date2"];
        $account = $input["account"];
        $agence = $input["agence"];
        $token = $this->VmsqlModel->getToken();
        if ($token == token) {
            $data = $this->VmsqlModel->budgetdetailleagence($date1,$date2,$account,$agence);
            $this->response([
                'status' => 200,
                'data' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => 201,
                'data' => ""
            ], REST_Controller::HTTP_OK);
        }
    }

    public function budgetdetailleconso_post()
    {
        $input = $this->input->post();
        $date1 = $input["date1"];
        $date2 = $input["date2"];
        $account = $input["account"];
        $token = $this->VmsqlModel->getToken();
        if ($token == token) {
            $data = $this->VmsqlModel->budgetdetailleconso($date1,$date2,$account);
            $this->response([
                'status' => 200,
                'data' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => 201,
                'data' => ""
            ], REST_Controller::HTTP_OK);
        }
    }


}
?>
