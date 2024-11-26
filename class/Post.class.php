<?php 
class Post{
      /* _ notation PEAR
     préférable aux elts privés
  valeur donnée par defaut
      doit être une expression scalaire statique
      donc pas d'appel de fonction, ou d'une variable
      superglobale ou non*/

      private $_textPost;
      private $_imagePost;
      private $_like;
      private $_user;
      private $_date;
      private $_idPost;

  //deux underscores au début
      public function __construct($id,$textPost,$imagePost,$like,$user,$date){

       //$this->_textPost=$textPost ou
      $this->setTextPost($textPost);
      $this->setImagePost($imagePost);
      $this->setLike($like);
      $this->setUser($user);
      $this->setDate($date);
      $this->setPostId($id);
      }

      //Accesseurs pour chaque attribut
      public function getUser(){
        return $this->_user;
      }

       public function getPostId(){
        return $this->_idPost;
      }

      public function getTextPost(){
        return $this->_textPost;
      }

      public function getImagePost(){
       return $this->_imagePost;
      }

      public function getLike(){
        return $this->_like;
     }

     public function getDatePost(){
        return $this->_date;
      }

      //mutateur chargé de modifier $_textPost
      public function setTextPost($textPost){
          if (!is_string($textPost)){
              trigger_error("Cette partie doit s'agir de texte", E_USER_WARNING);
            return;
          }

          //on récupère la longueur de l'entrée
          $textPostLength=strlen($textPost);

          if($textPostLength>300){
              trigger_error("Un post ne fait pas plus de 300 caractères", E_USER_WARNING);
            return;
          }

          $this->_textPost=$textPost;
      }

      public function setImagePost($imagePost){

         /*eventuelles definition sur image, rechercher comment check
          si c'est une url ou si null*/
         //rappel : il y avait un exercice similaire l'année derniere

         $this->_imagePost=$imagePost;
      }

      public function setLike($like){
          $this->_like=$like;
     }

     public function setUser($user){
      $this->_user=$user;
     }

     public function setDate($date){
        $this->_date=$date;
      }

       public function setPostId($id){
        $this->_idPost=$id;
      }
}
?>