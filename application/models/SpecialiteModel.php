<?php
  if ( ! defined('BASEPATH')) exit ('No direct script acces allowed');

  class SpecialiteModel extends CI_Model
  {

      public function getall(){
          $sql="select * from specialite";
          $query=$this->db->query($sql);
          return $query->result_array();
      }

      public function getsousclassebyidclasse($id){
          $sql="select * from sousclassemedicament where idclassemedicament=%s";
          $sql=sprintf($sql,$id);
          $query=$this->db->query($sql);
          return $query->result_array();
      }


      public function recherchemedicament($mot){
          $sql="select * from medicamentdetaille where nommedicament like '%" .$mot."%' or 
          dosage like '%" .$mot."%' or presentation like '%" .$mot."%' or  dci like '%" .$mot."%' or laboratoire like '%" .$mot."%' or
          conditionement like '%" .$mot."%' or specificationmedicament like '%" .$mot."%' or tableau like '%" .$mot."%' or classe like '%" .$mot."%' 
          or sousclasse like '%" .$mot."%'
          ";
          $query=$this->db->query($sql);
          return $query->result_array();
      }
  }

?>
