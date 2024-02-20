<?php 
$validate=new Classes\ClassUser();

$nomes=$validate->getNome();


echo json_encode($nomes);