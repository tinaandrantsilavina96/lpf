<?php
  if ( ! defined('BASEPATH')) exit ('No direct script acces allowed');

  class FitahianaModel extends CI_Model
  {
    

    	
		public function getAllFitahiana(){
			$sql="select * from fitahiana";
			$query=$this->db->query($sql);
			return $query->result_array();
		}
		public function getAllFitahianaPage($page,$limit)
		{
			$sql="select * from fitahiana  order by dateFitahiana desc limit %s , %s ";
			$sql=sprintf($sql,$page,$limit);
			$query=$this->db->query($sql);
			return $query->result_array();
		}
		public function getFahafolonkarenaActuelle(){
			$sql="select sommeMouvement as somme from mouvementFahafolonKarena order by idMouvement  desc limit 1";
			$query=$this->db->query($sql);
			$data=$query->result_array();	
			if($data==null){
				$data=0.0;	
			}else{
				$data=$query->result_array()[0]["somme"];
			}
			return $data;	
		}
		public function getSuggestionDesignation(){
			$sql="select distinct(designationFitahiana) as suggestion from fitahiana";
			$query=$this->db->query($sql);
			$val=array();$i=0;
			$query = $this->db->query($sql);
			foreach ($query->result() as $row){
			    $val[$i]=$row->suggestion;
			     $i++;
			}
			return $val;
		}
		// public function getSuggestionFahafolonkarena(){
		// 	$sql="select (sommeMouvement) as suggestion from fitahiana";
		// 	$query=$this->db->query($sql);
		// 	$val=array();$i=0;
		// 	$query = $this->db->query($sql);
		// 	foreach ($query->result() as $row){
		// 	    $val[$i]=$row->suggestion;
		// 	     $i++;
		// 	}
		// 	return $val;
		// }
		
		public function insertFitahiana($designation,$vola){
			date_default_timezone_set("Africa/Nairobi");
			$sql="insert into fitahiana(designationFitahiana,sommeFitahiana,dateFitahiana) values('%s',%s,now())";
			$sql=sprintf($sql,$designation,$vola);
			$query=$this->db->query($sql);
		}
		public function insertMouvementFahafolonkarena($vol){
			date_default_timezone_set("Africa/Nairobi");
			$vo=$this->pourcentage($vol,10);
			$vola=$this->getFahafolonkarenaActuelle() + $vo;
			$sql="insert into mouvementFahafolonKarena(sommeMouvement,dateMouvement) values(%s,now())";
			$sql=sprintf($sql,$vola);
			$query=$this->db->query($sql);
		}
		
		// public function insertFahafolonKarena($somme){
		// 	date_default_timezone_set("Africa/Nairobi");
		// 	$mbola=$this->getFahafolonkarenaActuelle();
		// 	$vola=$mbola-$somme;
		// 	$sql="insert into mouvementFahafolonkarena(sommeMouvement,dateMouvement) values(%s,now())";
		// 	$sql=sprintf($sql,$vola);
		// 	$query=$this->db->query($sql);
		// }

		public function insertFF($fanatitra,$fahafolonkarena){
			date_default_timezone_set("Africa/Nairobi");
			$sql="insert into fanatitraFahafolonkarena(fanatitra,fahafolonkarena,datePayement) values(%s,%s,now())";
			$sql=sprintf($sql,$fanatitra,$fahafolonkarena);
			$query=$this->db->query($sql);
		}
		public function insertFanatitraFahafolonkarena($fanatitra, $fahafolonkarena){
			$this->insertFF($fanatitra,$fahafolonkarena);
			$vola=$this->getFahafolonkarenaActuelle() - $fahafolonkarena;
			$sql="insert into mouvementFahafolonKarena(sommeMouvement,dateMouvement) values(%s,now())";
			$sql=sprintf($sql,$vola);
			$query=$this->db->query($sql);
		}
		
		public function pourcentage($vola,$pourcentage){
			return ($vola*$pourcentage)/100;
		}
	function upload($nom_post,$dossier,$newsnom){
		$fichier = basename($_FILES[$nom_post]['name']);
		$extensions = array('.png', '.gif', '.JPG','.jpg', '.jpeg','.png','.PNG');
		$erreur_taille="trop gros";
		$erreur_extension="extension refuser";
		$taille_max=5000000000000000;
		$taille_fichier=filesize($_FILES[$nom_post]['tmp_name']);
		$extension = strrchr($_FILES[$nom_post]['name'], '.');
		if(in_array($extension, $extensions)){
		  if($taille_fichier>$taille_max){
			throw new Exception("Fichier Trop Gros");
			}else{
				move_uploaded_file($_FILES[$nom_post]['tmp_name'], $dossier . $newsnom.".jpg");
				$fichier = strtr($fichier,     '???????????????????????????????',     'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
				$fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);

				$image=imagecreatefromjpeg($dossier.$newsnom.".jpg");
				//echo $dossier.$newsnom.".jpg";
				imagejpeg($image,$dossier.$newsnom.".jpg",4);
		  }
		}else{
		   throw  new Exception("Extension Invalide");
		}
	}


		// public function insertToken($user,$token){
		// 	$sql="insert into token values(%s,'%s')";
		// 	$sql=sprintf($sql,$user,$token);
		// 	//echo $sql;
		// 	$query=$this->db->query($sql);
		// }
		// public function insertToken($user,$token){
		// 	$sql="insert into token values(%s,'%s')";
		// 	$sql=sprintf($sql,$user,$token);
		// 	//echo $sql;
		// 	$query=$this->db->query($sql);
		// }
		// public function insertToken($user,$token){
		// 	$sql="insert into token values(%s,'%s')";
		// 	$sql=sprintf($sql,$user,$token);
		// 	//echo $sql;
		// 	$query=$this->db->query($sql);
		// }







		// public function getUtilisateur($user,$mdp){
		// 	$sql="select * from utilisateur where user='%s' and mdp='%s' ";
		// 	$sql=sprintf($sql,$user,$mdp);
		// 	//echo $sql;
		// 	$query=$this->db->query($sql);
		//  return $query->result_array();
		// }
		
		// public function getToken()
		// {
		// 	$auth=$this->input->get_request_header("authorization",true);
		// 	$exploded = explode(' ',$auth);
		// 	if(count($exploded)<2)
		// 	{
		// 		return ;
		// 	}
		// 	return $exploded[1];
		// }
		// public function getIdUtilisateurByToken($token)
		// {
		// 	$sql="select idUtilisateur from token where token='%s' ";
		// 	$sql=sprintf($sql,$token);
		// 	//echo $sql;
		// 	$query=$this->db->query($sql);
		// 	if(empty($query->result_array()[0]["idEtudiant"]))
		// 	{
		// 		return ;
		// 	}
		// 	else
		// 	{
		// 		 return $query->result_array()[0]["idEtudiant"];
		// 	}
		
		// }
		// 	public function getAllTache(){
		// 	$sql="select * from tache ";
		// 	$query=$this->db->query($sql);
		//  return $query->result_array();
		// }

		// public function getTacheUtilisateur($idUtilisateur){
		// 	$sql="select * from platF where idUtilisateur=%s";
		// 	$sql=sprintf($sql,$idEtudiant);
		// 	//echo $sql;
		// 	$query=$this->db->query($sql);
		//  return $query->result_array();
		// }
		// public function insertToken($user,$token)
		// {
		// 	$sql="insert into token values(%s,'%s')";
		// 	$sql=sprintf($sql,$user,$token);
		// 	//echo $sql;
		// 	$query=$this->db->query($sql);
		// }
		// public function insertUtilisateur($nom,$user,$pwd)
		// {
		// 	$sql="insert into utilisateur(nom,user,mdp) values('%s','%s','%s')";
		// 	$sql=sprintf($sql,$nom,$numETU,$pwd);
		// 	//echo $sql;
		// 	$query=$this->db->query($sql);
		// }
		
		// public function getCoutUtilisateur($idUtilisateur){
		// 	$sql="select cout from coutUtilisateur where idUtilisateur='%s'";
		// 	$sql=sprintf($sql,$idUtilisateur);
		// 	$query=$this->db->query($sql);
		//  return $query->result_array();
		// }
		// public function getEstimation($idTache){
		// 	$sql="select cout from estimation where idTache='%s'";
		// 	$sql=sprintf($sql,$idTache);
		// 	$query=$this->db->query($sql);
		//  return $query->result_array();
		// }
		
		
		// public function getResteAFaire($idTache){
		// 	$sql="select cout from resteAFaire where idTache='%s'";
		// 	$sql=sprintf($sql,$idTache);
		// 	$query=$this->db->query($sql);
		//  return $query->result_array();
		// }
  }

?>
