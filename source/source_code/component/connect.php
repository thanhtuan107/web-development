<?php


$host ='mysql:host=mysql-server;dbname=hotel_db';
$user = 'root';
$pass = 'root';
$db = 'hotel_db'; 

$conn = new PDO($host, $user, $pass);

   function create_unique_id(){
      $str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
      $rand = array();
      $length = strlen($str) - 1;

      for($i = 0; $i < 20; $i++){
         $n = mt_rand(0, $length);
         $rand[] = $str[$n];
      }
      return implode($rand);
   }

?>