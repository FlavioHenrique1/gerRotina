<?php
$objPass=new \Classes\ClassPassword();
if(isset($_POST['nome'])){$nome=filter_input(INPUT_POST,'nome',FILTER_SANITIZE_FULL_SPECIAL_CHARS);}else{$nome=null;}
if(isset($_POST['email'])){$email=filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL);}else{$email=null;}
if(isset($_POST['prontuario'])){$prontuario=filter_input(INPUT_POST,'prontuario',FILTER_SANITIZE_FULL_SPECIAL_CHARS);}else{$prontuario=null;}
if(isset($_POST['dataNascimento'])){$dataNascimento=filter_input(INPUT_POST,'dataNascimento',FILTER_SANITIZE_FULL_SPECIAL_CHARS);}else{$dataNascimento=null;}
if(isset($_POST['senha'])){$senha=$_POST['senha']; $hashSenha=$objPass->passwordHash($senha) ;}else{$senha=null; $hashSenha=null;}
if(isset($_POST['senhaConf'])){$senhaConf=$_POST['senhaConf'];}else{$senhaConf=null;}
$dataCreate=date("Y-m-d H:i:s");
if(isset($_POST['token'])){$token=$_POST['token'];}else{$token=bin2hex(random_bytes(64));}
if(isset($_POST['atividade'])){$atividade=filter_input(INPUT_POST,'atividade',FILTER_SANITIZE_FULL_SPECIAL_CHARS);}else{$atividade=null;}
if(isset($_POST['horario'])){$horario=filter_input(INPUT_POST,'horario',FILTER_SANITIZE_FULL_SPECIAL_CHARS);}else{$horario=null;}
if(isset($_POST['responsavel'])){$responsavel=filter_input(INPUT_POST,'responsavel',FILTER_SANITIZE_FULL_SPECIAL_CHARS);}else{$responsavel=null;}
if(isset($_POST['observacao'])){$observacao=filter_input(INPUT_POST,'observacao',FILTER_SANITIZE_FULL_SPECIAL_CHARS);}else{$observacao=null;}
if(isset($_POST['dataAtv'])){$dataAtv=filter_input(INPUT_POST,'dataAtv',FILTER_SANITIZE_FULL_SPECIAL_CHARS);}else{$dataAtv=null;}

$arrAtiv=[
    "atividade"=>$atividade,
    "horario"=>$horario,
    "responsavel"=>$responsavel,
    "observacao"=>$observacao,
    "dataAtv"=>$dataAtv,
    "dataCreate"=>$dataCreate
];

$arrVar=[
    "nome"=>$nome,
    "email"=>$email,
    "prontuario"=>$prontuario,
    "dataNascimento"=>$dataNascimento,
    "senha"=>$senha,
    "hashSenha"=>$hashSenha,
    "dataCreate"=>$dataCreate,
    "token"=>$token,
];