<?php
  /**
   * User class represent an User of Blabla't
   */
  //namespace classes\User;
  require_once('PrivateMessage.class.php');

  class User{
  	private $_idUser;
  	private $_username;
  	private $_password;
  	private $_firstName;
  	private $_lastName;
  	private $_birthdate;
  	private $_mail;
  	private $_icon;
  	private $_conversation=array();
  	private $_comments;
  	private $_posts;

# User's constructor
  	public function __construct($idUser,$username,$password,$firstname,$lastname,$birthdate,$mail,$icon){
      $this->_idUser = $idUser;
      $this->_username = $username;
      $this->_password = $password;
      $this->_firstName = $firstname;
      $this->_lastName = $lastname;
      $this->_birthdate = $birthdate;
      $this->_mail = $mail;
      $this->_icon = $icon;

    }
# _idUser's Accessor and Mutator
	public function setIdUser($value) {
    	$this->_idUser = $value;
	}

	 public function getIdUser(){
        return $this->_idUser;
    }

# _Username's Accessor and Mutator
	public function setUserName($value) {
    	$this->_username = $value;
	}

	public function getUsername(){
        return $this->_username;
    }

# _password's Accessor and Mutator
	public function setPassword($value) {
    	$this->_password = $value;
	}

	public function getPassword(){
        return $this->_password;
    }
    
# _firstName's Accessor and Mutator
	public function setFirstname($value) {
    	$this->_firstName = $value;
	}

	public function getFirstname(){
        return $this->_firstName;
    }

# _lastName's Accessor and Mutator
	public function setLastname($value) {
    	$this->_lastName = $value;
	}

	public function getLastname(){
        return $this->_lastName;
    }

    # _birtdate's Accessor and Mutator
	public function setBirthdate($value) {
    	$this->_birthdate = $value;
	}

	public function getBirthdate(){
        return $this->_birthdate;
    }

    # _mail's Accessor and Mutator
	public function setMail($value) {
    	$this->_mail = $value;
	}

	public function getMail(){
        return $this->_mail;
    }

# _icon's Accessor and Mutator
	public function setIcon($value) {
    	$this->_icon = $value;
	}

	public function getIcon(){
        return $this->_icon;
    }

# _conversation's Accessor and Mutator
	public function setConversation($value) {
    	$this->_conversation = $value;
	}

	public function getConversation(){
    $_conversationMessages=array();
    
    foreach ($this->_conversation as $key => $value) {
  
        $_conversationMessages[$this->getIdUser().",".$value->getIdReceiver()]=$value->getPrivateMessage();
    }
        return $_conversationMessages;
    }

# _comments's Accessor and Mutator
	public function setComments($value) {
    	$this->_comments = $value;
	}

	public function getComments(){
        return $this->_comments;
    }

# _posts's Accessor and Mutator
	public function setPost($value) {
    	$this->_posts = $value;
	}

	public function getPost(){
        return $this->_posts;
    }

  }
?>