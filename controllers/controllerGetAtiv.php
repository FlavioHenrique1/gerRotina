<?php 

$ativ=new Classes\ClassValidAtiv();

$atvidades=$ativ->GetAtividade();


echo json_encode($atvidades);