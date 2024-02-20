<?php
namespace Models;

use Models\ClassLogin;



class ClassUserCad extends ClassCrud{

    private $login;

    public function __construct()
    {
        $this->login=new ClassLogin();
    }

    public function getUserDados($email){
        $dados=$this->login->getDataUser($email);
        return $dados;
    }

    #Pegar informações no BD do usuário
    public function getUserName($local,$setor){
       $b=$this->selectDB(
            "nome",
            "users",
            "where local=? and setor=?",
            array(
                $local,
                $setor
            )
        );
        $dados=$b->fetchAll(\PDO::FETCH_ASSOC);
        return $dados;
    }

    //Salvar atualizações no BD
    public function salvarImgBD($nomeArquivo,$email,){
        $this->updateDB(
            "users",
            "img=?",
            "email=?",
            array(
                $nomeArquivo,
                $email
            )
        );
    }

    //Salvar atualizações no BD
    public function AtualizarDadosBD($dados,$email,$senhaHash){
        $this->updateDB(
            "users",
            "nome=?, prontuario=?, senha=?, dataNascimento=?, local=?, cargo=?, setor=?",
            "email=?",
            array(
                $dados['nome'],
                $dados['prontuario'],
                $senhaHash,
                $dados['dataNascimento'],
                $dados['local'],
                $dados['cargo'],
                $dados['setor'],
                $email
            )
        );

    }






}