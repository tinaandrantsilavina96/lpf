<?php
  if ( ! defined('BASEPATH')) exit ('No direct script acces allowed');

  class UserModel extends CI_Model
  {

      public function getUser($user,$mdp){
          $sql="select * from user where user='%s' and pass=(select sha1('%s'))";
          $sql=sprintf($sql,$user,$mdp);
          $query=$this->db->query($sql);
          return $query->result_array();
      }

      public function gettypeuser(){
          $sql="select * from typeuser";
          $query=$this->db->query($sql);
          return $query->result_array();
      }
      public function getuserbyid($id){
          $sql="select * from userdetaille where iduser=%s";
          $sql=sprintf($sql,$id);
          $query=$this->db->query($sql);
          $data=$query->result_array();
          if($data==null){
              $data=0.0;
          }else{
              $data=$query->result_array()[0];
          }
          return $data;
      }

      public function getToken(){
          $auth=$this->input->get_request_header("authorization",true);
          $exploded = explode(' ',$auth);
          if(count($exploded)<2){
              return ;
          }
          return $exploded[1];
      }

      public function getiduserbytokenheader(){ // Raha mbola valider ilay expiration
          $token=$this->getToken();
          $sql="select * from tokenuser where token='%s' and expiration>= now()";
          $sql=sprintf($sql,$token);
          $query=$this->db->query($sql);
          $data=$query->result_array();
          if($data!=null){
              $data=(int)$query->result_array()[0]['iduser'];
          }
          return $data;
//          return null;
      }

      public function getiduserbytoken($token){ // Raha mbola valider ilay expiration
          $sql="select * from tokenuser where token='%s' and expiration>= now()";
          $sql=sprintf($sql,$token);
          $query=$this->db->query($sql);
          $data=$query->result_array();
          if($data!=null){
              $data=(int)$query->result_array()[0]['iduser'];
          }
          return $data;
      }

      public function getuserbytoken($token){
      	$iduser=$this->getiduserbytoken($token);
      	$user=null;
          if($iduser!=null){
              $user=$this->getuserbyid($iduser);
          }
          return $user;
      }

    public function getuserbytokenheader(){
        $iduser=$this->getiduserbytokenheader();
        $user=null;
        if($iduser!=null){
            $user=$this->getuserbyid($iduser);
        }
        return $user;
    }

	public function insertToken($iduser,$token){
		$sql="insert into tokenuser(iduser,token,expiration) values(%s,'%s','2030-01-01 23:59:59')";
		$sql=sprintf($sql,$iduser,$token);
		$query=$this->db->query($sql);
	}


	////////////////// Inscription \\\\\\\\\\\\\\\\\\\\
      public function inscription($idtypeuser,$nomuser,$prenomuser,$sex,$user,$pass,$phone,$naissanceuser){
          $sql="insert into user (idtypeuser,nomuser,prenomuser,sex,user,pass,phone,naissanceuser)
          values (%s,'%s' , '%s', '%s','%s',(select sha1('%s')),'%s' ,'%s' )";
          $sql=sprintf($sql,$idtypeuser,$nomuser,$prenomuser,$sex,$user,$pass,$phone,$naissanceuser);
          $query=$this->db->query($sql);
      }

  }

?>
