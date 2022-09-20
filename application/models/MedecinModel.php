<?php
  if ( ! defined('BASEPATH')) exit ('No direct script acces allowed');

  class MedecinModel extends CI_Model
  {

      public function getall(){
          $sql="select * from v_docteurdetaille";
          $query=$this->db->query($sql);
          return $query->result_array();
      }

      public function getmedecinbyidspecialite($id){
          $sql="select * from v_docteurdetaille where idspecialite=%s";
          $sql=sprintf($sql,$id);
          $query=$this->db->query($sql);
          return $query->result_array();
      }

      public function getmedecinbyid($id){
          $sql="select * from v_docteurdetaille where iduser=%s";
          $sql=sprintf($sql,$id);
          $query=$this->db->query($sql);
          return $query->result_array();
      }

      public function recherchemedcin($mot){
          $sql="select * from v_docteurdetaille where nom like '%" .$mot."%' or 
          prenom like '%" .$mot."%' or nomspecialite like '%" .$mot."%' or  description like '%" .$mot."%'
          ";
          $query=$this->db->query($sql);
          return $query->result_array();
      }
  }

?>
