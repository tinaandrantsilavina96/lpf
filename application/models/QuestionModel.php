<?php
  if ( ! defined('BASEPATH')) exit ('No direct script acces allowed');

  class QuestionModel extends CI_Model
  {

      public function insert($iduser,$idspecialite,$titre,$question,$sexe,$taille,$poids,$masquernom,$traitement,$antecedant){
          $sql=" insert into question(iduser,idspecialite,titre,question,sexe,taille,poids,masquernom,traitement,antecedant,datequestion) VALUES
            ( %s,%s,'%s','%s','%s',%s,%s,%s,'%s','%s',now() ) ";
          $sql=sprintf($sql,$iduser,$idspecialite,$titre,$question,$sexe,$taille,$poids,$masquernom,$traitement,$antecedant);
          $query=$this->db->query($sql);
      }
      public function getall(){
          $sql="select * from question ";
          $query=$this->db->query($sql);
          return $query->result_array();
      }

      public function getalldetaille(){
          $sql="select * from v_questiondetaille";
          $query=$this->db->query($sql);
          return $query->result_array();
      }

      public function getdetaillebyid($id){
          $sql="select *  from v_questiondetaille where idquestion=%s";
          $sql=sprintf($sql,$id);
          $query=$this->db->query($sql);
          return $query->result_array();
      }

      public function getbyid($id){
          $sql="select * from question  where idquestion=%s";
          $sql=sprintf($sql,$id);
          $query=$this->db->query($sql);
          return $query->result_array();
      }


      public function getdetaillebyiduser($id){
          $sql="select * from v_questiondetaille where iduser=%s";
          $sql=sprintf($sql,$id);
          $query=$this->db->query($sql);
          return $query->result_array();
      }

      public function getbyiduser($id){
          $sql="select * from question  where iduser=%s";
          $sql=sprintf($sql,$id);
          $query=$this->db->query($sql);
          return $query->result_array();
      }

  }

?>
