<?php
/**
 * PrivateMessage Class represent a message from one user. 
 */
class PrivateMessage{
	

	private $_date;
	private $_messageContent;
	private $_idWriter;
	

	function __construct($messageContent,$idWriter){
		$this->_date = date("Y-m-d H:i:s");
		$this->_messageContent = $messageContent;
		$this->_idWriter = $idWriter;
	}
# _date's Accessor and Mutator
	public function setDate() {
    	$this->_idUser = date("Y-m-d H:i:s");
	}

	 public function getDate(){
        return $this->_date;
    }

    # _messageContent's Accessor and Mutator
	public function setMessageContent($value) {
    	$this->_messageContent = $value;
	}

	 public function getMessageContent(){
        return $this->_messageContent;
    }

    # _idWriter's Accessor and Mutator
	public function setIdWriter($value) {
    	$this->_idUser = $value;
	}

	 public function getIdWriter(){
        return $this->_idWriter;
    }

}

?>