<?php
  if ( ! defined('BASEPATH')) exit ('No direct script acces allowed');

  class MedicamentModel extends CI_Model
  {

      public function getallclasse(){
          $sql="select * from classemedicament";
          $query=$this->db->query($sql);
          return $query->result_array();
      }

      public function getsousclassebyidclasse($id){
          $sql="select * from sousclassemedicament where idclassemedicament=%s";
          $sql=sprintf($sql,$id);
          $query=$this->db->query($sql);
          return $query->result_array();
      }

      public function recherchemedicamentbysousclasse($id){
          $sql="select * from medicamentdetaille where idsousclassemedicament=%s";
          $sql=sprintf($sql,$id);
          $query=$this->db->query($sql);
          return $query->result_array();
      }


      public function getmedicamentdetaillebyid($id){
          $sql="select * from medicamentdetaille where idmedicament=%s";
          $sql=sprintf($sql,$id);
          $query=$this->db->query($sql);
          if($query->result_array()){
              return $query->result_array();
          }
          return ;
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
      public function getimage($id){
          $sql="select * from imagemedicament where idmedicament=%s";
          $sql=sprintf($sql,$id);
          $query=$this->db->query($sql);
          return $query->result_array();
      }
  }

?>
