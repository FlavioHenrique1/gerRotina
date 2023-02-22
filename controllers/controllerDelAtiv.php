<?php 
$dados = json_decode(file_get_contents('php://input'), true);
$id=$dados['id'];
$ativ=new Classes\ClassValidAtiv();
$ativ->deleteAtiv($id);
echo  json_encode("registro deletado!");