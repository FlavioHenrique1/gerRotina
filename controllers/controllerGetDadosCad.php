<?php
$validate=new Classes\ClassValidate();

$ret = $validate->GetDadosCad();
echo json_encode($ret);