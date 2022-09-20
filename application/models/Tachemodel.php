<?php
  if ( ! defined('BASEPATH')) exit ('No direct script acces allowed');

  class Tachemodel extends CI_Model
  {
    
		
		public function getUtilisateur($user,$mdp){
			$sql="select * from utilisateur where user='%s' and mdp='%s' ";
			$sql=sprintf($sql,$user,$mdp);
			//echo $sql;
			$query=$this->db->query($sql);
		 return $query->result_array();
		}
		
		public function getToken()
		{
			$auth=$this->input->get_request_header("authorization",true);
			$exploded = explode(' ',$auth);
			if(count($exploded)<2)
			{
				return ;
			}
			return $exploded[1];
		}
		public function getIdUtilisateurByToken($token)
		{
			$sql="select idUtilisateur from token where token='%s' ";
			$sql=sprintf($sql,$token);
			//echo $sql;
			$query=$this->db->query($sql);
			if(empty($query->result_array()[0]["idEtudiant"]))
			{
				return ;
			}
			else
			{
				 return $query->result_array()[0]["idEtudiant"];
			}
		
		}
			public function getAllTache(){
			$sql="select * from tache ";
			$query=$this->db->query($sql);
		 return $query->result_array();
		}

		public function getTacheUtilisateur($idUtilisateur){
			$sql="select * from platF where idUtilisateur=%s";
			$sql=sprintf($sql,$idEtudiant);
			//echo $sql;
			$query=$this->db->query($sql);
		 return $query->result_array();
		}
		public function insertToken($user,$token)
		{
			$sql="insert into token values(%s,'%s')";
			$sql=sprintf($sql,$user,$token);
			//echo $sql;
			$query=$this->db->query($sql);
		}
		public function insertUtilisateur($nom,$user,$pwd)
		{
			$sql="insert into utilisateur(nom,user,mdp) values('%s','%s','%s')";
			$sql=sprintf($sql,$nom,$numETU,$pwd);
			//echo $sql;
			$query=$this->db->query($sql);
		}
		
		public function getCoutUtilisateur($idUtilisateur){
			$sql="select cout from coutUtilisateur where idUtilisateur='%s'";
			$sql=sprintf($sql,$idUtilisateur);
			$query=$this->db->query($sql);
		 return $query->result_array();
		}
		public function getEstimation($idTache){
			$sql="select cout from estimation where idTache='%s'";
			$sql=sprintf($sql,$idTache);
			$query=$this->db->query($sql);
		 return $query->result_array();
		}
		
		
		public function getResteAFaire($idTache){
			$sql="select cout from resteAFaire where idTache='%s'";
			$sql=sprintf($sql,$idTache);
			$query=$this->db->query($sql);
		 return $query->result_array();
		}
		public function getDescritionPlat($idPlat){
			$sql="select * from platDescription where idPlat=%s";
			$sql=sprintf($sql,$idPlat);
			$query=$this->db->query($sql);
		 return $query->result_array();
		}
  }

?>
