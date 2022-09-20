<?php
  if ( ! defined('BASEPATH')) exit ('No direct script acces allowed');

  class RdvModel extends CI_Model
  {

      public function insertrdv($iduserdocteur,$iduserclient,$daterdv){
          $sql="insert into rdv(iduserdocteur,iduserclient,daterdv) values (%s,%s,'%s')";
          $sql=sprintf($sql,$iduserdocteur,$iduserclient,$daterdv);
          $query=$this->db->query($sql);
      }
      public function getallrdv(){
          $sql="select * from rdv";
          $query=$this->db->query($sql);
          return $query->result_array();
      }

      public function getallrdvdetaille(){
          $sql="select * from v_rdvdetaille";
          $query=$this->db->query($sql);
          return $query->result_array();
      }

      public function getrdvdetaillebyid($id){
          $sql="select * from v_rdvdetaille where idrdv=%s";
          $sql=sprintf($sql,$id);
          $query=$this->db->query($sql);
          return $query->result_array();
      }

      public function getrdvbyid($id){
          $sql="select * from rdv where idrdv=%s";
          $sql=sprintf($sql,$id);
          $query=$this->db->query($sql);
          return $query->result_array();
      }


      public function getrdvdetaillebyiduser($id){
          $sql="select * from v_rdvdetaille where iduserclient=%s";
          $sql=sprintf($sql,$id);
          $query=$this->db->query($sql);
          return $query->result_array();
      }

      public function getrdvbyiduser($id){
          $sql="select * from rdv where iduserclient=%s";
          $sql=sprintf($sql,$id);
          $query=$this->db->query($sql);
          return $query->result_array();
      }



//      public function getmedecinbyid($id){
//          $sql="select * from v_docteurdetaille where iduser=%s";
//          $sql=sprintf($sql,$id);
//          $query=$this->db->query($sql);
//          return $query->result_array();
//      }
//
//      public function recherchemedcin($mot){
//          $sql="select * from v_docteurdetaille where nom like '%" .$mot."%' or
//          prenom like '%" .$mot."%' or nomspecialite like '%" .$mot."%' or  description like '%" .$mot."%'
//          ";
//          $query=$this->db->query($sql);
//          return $query->result_array();
//      }
  }

?>
