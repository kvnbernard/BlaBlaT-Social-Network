<?php
/**
 * Conversation Class between two users.
 */

class Conversation{
	
	private $_privateMessage=array();
	private $_idReceiver;
	
	function __construct($privateMessage,$idReceiver){
		$this->_privateMessage = $privateMessage;
		$this->_idReceiver = $idReceiver;
	}

 # _privateMessage's Accessor and Mutator
	public function setPrivateMessage($value) {
    	$this->_privateMessage = $value;
	}

	 public function getPrivateMessage(){
	 	$_conversationMessages=array();
	 	
	 	foreach ($this->_privateMessage as $key => $value) {
   			$_conversationMessages[$key.$value->getIdWriter()." ".$value->getDate()]=$value->getMessageContent();
		}

        return $_conversationMessages;
    }

 # _idReceiver's Accessor and Mutator
	public function setIdReceiver($value) {
    	$this->_idReceiver = $value;
	}

	 public function getIdReceiver(){
        return $this->_idReceiver;
    }
}

?>