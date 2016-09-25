<?php
class PDOAdmin{
     private $_pdo;
     private $_pdoStat;
     function __construct($host = 'localhost', $dbname = 'test', $user = 'root', $pass = 'prueba', $options = array() ){
          try {
              $this->_pdo = new PDO('mysql:host='$host';dbname='$dbname, $user, $pass, $options);
          }catch (PDOException $e) {
              print "¡Error!: "  $e->getMessage();
              die();
          }
     }
     function execute($query = '', $return_rows = , $array_valores = array(), $array_tipos= array()){
           $this->_pdoStat = $this->_pdo->prepare($query);
           foreach($array_valores as $posicion => &$valor){
                   $tipo_var = 'STR' == $array_tipos[$posicion] ? PDO::PARAM_STR : PDO::PARAM_INT;
                   $this->_pdoStat->bindParam($posicion+, $valor, $tipo_var);
           }
           $result = $this->_pdoStat->execute();
           if(  < $return_rows && $result){
                 return $return_rows ==  ? $this->_pdoStat->fetch() : $this->_pdoStat->fetchAll();
           }
           return $result;
     }
     function mostrar_error(){
         $array = $this->_pdoStat->errorInfo();
         var_dump($array);
     }
     function lastInsertId(){
         return $this->_pdo->lastInsertId();
     }       
	 function disconnect () {
	             $this->_pdoStat->closeCursor();
	             $this->_pdoStat = null;
	             $this->_pdo = null;
	     }
	 }
?>