<?php

class dashboard extends dbclass {
	


	public function totalCampaignsCount(){
		$query="SELECT COUNT(*) as total FROM `campaigns` "; 
		$responce = $this->fetchRow($query);
		if($responce){
			return $responce['total'];
		} else {
			return 0;
		}
	}
	
	public function totalModuleCount(){
		$query="SELECT COUNT(*) as total FROM `modules`  ";
		$responce = $this->fetchRow($query);
		if($responce){
			return $responce['total'];
		} else {
			return 0;
		}
	}
	
	public function totalStakeHoldersCount(){
		$query="SELECT COUNT(*) as total FROM `stake_holder`"; 
		$responce = $this->fetchRow($query);
		if($responce){
			return $responce['total'];
		} else {
			return 0;
		}
	}
	
	public function totalObserverCount(){
		$query="SELECT COUNT(*) as total FROM `observers`"; 
		$responce = $this->fetchRow($query);
		if($responce){
			return $responce['total'];
		} else {
			return 0;
		}
	}



	
} // END USER CLASS


?>