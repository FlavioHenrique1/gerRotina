<?php 

$ativRot=new Classes\ClassValidRot();

$ret=$ativRot->validateRequisicaoDiaria();
echo json_encode($ret);
// var_dump($ret);