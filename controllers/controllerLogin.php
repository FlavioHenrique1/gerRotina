<?php

$validate=new Classes\ClassValidate();
$validate->validateFields($_POST);
$validate->validateEmail($email);
$valid=$validate->validateIssetEmail($email,"login");
#$validate->validateStrongSenha($senha);
if($valid == true){
    $validate->validateSenha($email,$senha);
}
#$validate->validateUserActive($email);
$validate->validateAttemptLogin();
echo $validate->validateFinalLogin($email);
