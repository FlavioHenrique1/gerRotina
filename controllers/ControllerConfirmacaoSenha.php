<?php
$validate=new \Classes\ClassValidate();
$confirmation=new \Models\ClassCadastro();

    if($validate->validateConfSenha($senha,$senhaConf)) {
        if($validate->validateStrongSenha($senha)) {
            if($confirmation->alterarSenha($email,$hashSenha,$dataNascimento)) {
                echo "<script> alert('Senha foi alterada com sucesso!');</script>";
            }else {
                echo "<script> alert('Não foi possível verificar seus dados!');</script>";
            }
        }else{
            echo "<script> alert('Senha fraca!');</script>";
        }
    }else{
        echo "<script> alert('Senha diferente de confirmação de senha!');</script>";
    }

echo "<script> window.location.href='".DIRPAGE."';</script>";