<?php
namespace Models;

class ClassCadastro extends ClassCrud{

    #Realizar a inserção no banco de dados
    public function inserCad($arrVar)
    {
        $this->insertDB(
            "users",
            "?,?,?,?,?,?,?,?,?,?,?,?,?,?",
            array(
                0,
                $arrVar['nome'],
                $arrVar['prontuario'],
                $arrVar['email'],
                $arrVar['hashSenha'],
                $arrVar['dataNascimento'],
                $arrVar['local'],
                $arrVar['dataCreate'],
                'user',
                'confirmation',
                $arrVar['cargo'],
                $arrVar['setor'],
                "",
                ""
            )
        );
        $this->insConfirmation($arrVar);
    }

    #Inserção de confirmação
    public function insConfirmation($arrVar){
        $this->insertDB(
            "confirmation",
            "?,?,?",
            array(
                0,
                $arrVar['email'],
                $arrVar['token']
            )
        );
    }
    
    #Veriricar se já existe o mesmo email cadastro no db
    public function getIssetEmail($email)
    {
        $b=$this->selectDB(
            "*",
            "users",
            "where email=?",
            array(
                $email
            )
        );

        return $r=$b->rowCount();
    }

    #Verificar a confirmação de cadastro pelo email
    public function confirmationCad($email,$token)
    {
        $b=$this->selectDB(
            "*",
            "confirmation",
            "WHERE email=? and token=?",
            array(
                $email,
                $token
            )
        );
        $r=$b->rowCount();
        if($r >0){
            $this->deleteDB(
                "confirmation",
                "email=?",
                array($email)
            );
        
            $this->updateDB(
                "users",
                "status=?",
                "email=?",
                array(
                    "active",
                    $email
                )
            );
            return true;
        }else{
            return false;
        }
    }

    #Verificar a confirmação de senha
    public function confirmationSen($email,$token,$hashSenha)
    {
        $b=$this->selectDB(
            "*",
            "confirmation",
            "where email=? and token=?",
            array(
                $email,
                $token
            )
        );
        $r=$b->rowCount();

        if($r >0){
            $this->deleteDB(
                "confirmation",
                "email=?",
                array($email)
            );

            $this->updateDB(
                "users",
                "senha=?",
                "email=?",
                array(
                    $hashSenha,
                    $email
                )
            );
            return true;
        }else{
            return false;
        }
    }

    #Verificar a confirmação de senha
    public function alterarSenha($email,$hashSenha,$dataN)
    {
        $b=$this->selectDB(
            "*",
            "users",
            "where email=? and dataNascimento=?",
            array(
                $email,
                $dataN
            )
        );
        $r=$b->rowCount();
            if($r >0){
                $this->updateDB(
                    "users",
                    "senha=?",
                    "email=?",
                array(
                    $hashSenha,
                    $email
                    )
                );
                return true;
            }else{
                return false;
            }

    }

    #Retorna os dados do usuário
    public function getDataCad()
    {
        $b=$this->selectDB(
            "*",
            "cargo",
            "",
            array(
            )
        );
        $f=$b->fetchAll(\PDO::FETCH_ASSOC);
        
        $t=$this->selectDB(
            "*",
            "setor",
            "",
            array(
            )
        );
        $g=$t->fetchAll(\PDO::FETCH_ASSOC);

        $C=$this->selectDB(
            "*",
            "cd",
            "",
            array(
            )
        );
        $CC=$C->fetchAll(\PDO::FETCH_ASSOC);

        return $arrData=[
            "cargo"=>$f,
            "setor"=>$g,
            "cd"=>$CC
        ];
    }


}