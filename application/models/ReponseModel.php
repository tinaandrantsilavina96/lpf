<?php
  if ( ! defined('BASEPATH')) exit ('No direct script acces allowed');

  class ReponseModel extends CI_Model
  {

      public function insert($idquestion,$iduserdocteur,$reponse){
          $sql=" insert into reponse(idquestion,iduserdocteur,reponse,datereponse) VALUES
            ( %s,%s,'%s', now() );";
          $sql=sprintf($sql,$idquestion,$iduserdocteur,$reponse);
          $query=$this->db->query($sql);
      }
      public function getall(){
          $sql="select * from reponse ";
          $query=$this->db->query($sql);
          return $query->result_array();
      }

      public function getalldetaille(){
          $sql="select * from v_reponsedetaille";
          $query=$this->db->query($sql);
          return $query->result_array();
      }

      public function getdetaillebyid($id){
          $sql="select *  from v_reponsedetaille where idquestion=%s";
          $sql=sprintf($sql,$id);
          $query=$this->db->query($sql);
          return $query->result_array();
      }

      public function getbyid($id){
          $sql="select * from reponse  where idquestion=%s";
          $sql=sprintf($sql,$id);
          $query=$this->db->query($sql);
          return $query->result_array();
      }


      public function getdetaillebyiduser($id){
          $sql="select * from v_reponsedetaille where iduserdocteur=%s";
          $sql=sprintf($sql,$id);
          $query=$this->db->query($sql);
          return $query->result_array();
      }

      public function getbyiduser($id){
          $sql="select * from reponse  where iduserdocteur=%s";
          $sql=sprintf($sql,$id);
          $query=$this->db->query($sql);
          return $query->result_array();
      }




  }

?>
