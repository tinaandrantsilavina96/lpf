<?php
  if ( ! defined('BASEPATH')) exit ('No direct script acces allowed');

  class ActualiteModel extends CI_Model
  {

      public function insert($iduser,$titre,$texte){
          $sql=" insert into actualite( iduser, titre, texte, dateactualite) VALUES (%s,'%s','%s', now() ) ";
          $sql=sprintf($sql,$iduser,$titre,$texte);
          $query=$this->db->query($sql);
      }
      public function getall(){
          $sql="select * from question ";
          $query=$this->db->query($sql);
          return $query->result_array();
      }
      public function getLigne(){ // Hakana an ilay anaran le image par rapport am ilay ligne
          $instance = &get_instance();
          $instance->load->database();//nom Db
          $sql="SELECT (`AUTO_INCREMENT`) as nbre FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '%s' 
              AND   TABLE_NAME   = '%s' ";
          $sql=sprintf($sql,(string)$instance->db->database, "actualite");
          $query=$this->db->query($sql);
          return (int)$query->result_array()[0]["nbre"];
      }
      public function insertimage($idactualite){
          $sql=" insert into imageactualite( idactualite) VALUES (%s) ";
          $sql=sprintf($sql,$idactualite);
          $query=$this->db->query($sql);
      }

      public function getLigneImage(){ // Hakana an ilay anaran le image par rapport am ilay ligne
          $instance = &get_instance();
          $instance->load->database();//nom Db
          $sql="SELECT (`AUTO_INCREMENT`) as nbre FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '%s' 
              AND   TABLE_NAME   = '%s' ";

          $sql=sprintf($sql,(string)$instance->db->database, "imageactualite");
          $query=$this->db->query($sql);
          return (int)$query->result_array()[0]["nbre"];
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
