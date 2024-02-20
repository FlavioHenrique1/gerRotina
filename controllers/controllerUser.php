<?php
$data = json_decode(file_get_contents('php://input'), true);
$validate=new Classes\ClassUser();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $imagem = $_FILES["imagem"];
    $validate->validarImg($imagem);



}elseif($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo json_encode($validate->getUser());
}elseif($_SERVER['REQUEST_METHOD'] === 'DELETE') {

}elseif($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $validate->validateData($data['dataNascimento']);
    $validate->validateSelectCad($data['local'],$data['cargo'],$data['setor']);
    $validate->validateConfSenha($data['senha'],$data['senhaConf']);
    $validate->validateStrongSenha($data['senha']);
    echo $validate->ValidateFinEditUser($data);
    // var_dump($data);
    // $validate->validateFields($_POST);
    // $validate->validateEmail($email);
    // $validate->validateIssetEmail($email);
    // $validate->validateData($dataNascimento);
    // $validate->validateSelectCad($local,$cargo,$setor);
    // $validate->validateConfSenha($senha,$senhaConf);
    // $validate->validateStrongS   enha($senha);

}