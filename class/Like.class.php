<?php

class Like{
	private $_liked=[];
	private $_numberLikes=0;
	private $_datelike;

	public function __construct($numberLikes){
		
		$this->setNumberLikes($numberLikes);

	}
	
	public function setLiked($liked){

	$this->_liked=$liked;
	
	}
	
	public function setDateLike($date){

	$this->_datelike=$date;
	
	}

	public function setNumberLikes($numberLikes){

		if(!is_int($numberLikes)){
			trigger_error("Cette partie doit s'agir d'un int", E_USER_WARNING);
        		return;
      	}


		$this->_numberLikes=$numberLikes;
	}

	public function getLiked(){
		return $this->_liked;
	}

	public function getDateLike(){
		return $this->_datelike;
	}

	public function getNumberLikes(){
		return $this->_numberLikes;
	}

	public function addLikes(){

      $like = $this->_numberLikes++;
    
    }

    public function removeLikes(){
  
      if ($likeToRemove!=0){
        $this->_numberLikes--;
      }
      else{
        $this->_numberLikes=0;
      }
      
    }


	public function removeLiked($id_user){
		$key = array_search('$id_user', $_liked);
		unset($_liked[$key]);
	}

	function addLike($id_user){
	array_push($this->_liked, $id_user);
	}
}