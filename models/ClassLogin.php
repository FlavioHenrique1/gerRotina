<?php
namespace Models;

use Traits\TraitGetIp;



class ClassLogin extends ClassCrud{

    private $trait;
    private $dateNow;

    public function __construct()
    {
        $this->trait=TraitGetIp::getUserIp();
        $this->dateNow=date("Y-m-d H:i:s");
    }


    #Retorna os dados do usuário
    public function getDataUser($email)
    {
        $b=$this->selectDB(
            "*",
            "users",
            "where email=?",
            array(
                $email
            )
        );
        $f=$b->fetch(\PDO::FETCH_ASSOC);
        $r=$b->rowCount();
        $this->ultimoAcesso($f);
        return $arrData=[
            "data"=>$f,
            "rows"=>$r
        ];

    }
    
    #Colocar ultimo acesso do usuário
    public function ultimoAcesso($dados){
        $b=$this->updateDB(
            "users",
            "ultimoAcesso=?",
            "email=?",
            array(
                $this->dateNow,
                $dados['email']
            )
        );
    }

    #Conta as tentativas
    public function countAttempt()
    {
        $b=$this->selectDB(
            "*",
            "attempt",
            "where ip=?",
            array(
                $this->trait
            )
        );
        $r=0;
        while($f=$b->fetch(\PDO::FETCH_ASSOC)){
            if(strtotime($f["date"]) > strtotime($this->dateNow)-300){
                $r++;
            }
        }
        return $r;
    }

    #Inseri as tentativas
    public function insertAttempt()
    {
        if($this->countAttempt() < 5){
            $this->insertDB(
                "attempt",
                "?,?,?",
                array(
                    0,
                    $this->trait,
                    $this->dateNow
                )
            );
        }
    }

    #Deleta as tentativas
    public function deleteAttempt()
    {
        $this->deleteDB(
            "attempt",
            "ip=?",
            array(
                $this->trait
            )
        );
    }

}