<?php 
$nDia= date("N");

$ativ=new Classes\ClassValidAtiv();
$dados=$ativ->ValidateTarRot($nDia);

var_dump($dados);


