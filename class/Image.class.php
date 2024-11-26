<?php
class Image{

    	/* _ notation PEAR*/
    	private $_urlImage;

	//deux underscores au début
    	public function __construct($urlImage){
     	 $this->setUrlImage($urlImage);
    	}

    	//accesseur
    	public function getUrlImage(){
     	 return $this->_urlImage;
    	}

    	//mutateur chargé de modifier $_urlImage
    	public function setUrlImage($urlImage){
		//définir des conditions sur la valeur d'entrée ici, vérifier si c'est bien une url
      		$this->_urlImage=$urlImage;
    	}

 }
?>