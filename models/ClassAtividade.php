<?php
namespace Models;

class ClassAtividade extends ClassCrud{

    #Realizar a inserção no banco de dados
    public function inserAti($arrAtiv)
    {
        $this->insertDB(
            "atividade",
            "?,?,?,?,?,?,?,?",
            array(
                0,
                $arrAtiv['atividade'],
                $arrAtiv['horario'],
                $arrAtiv['responsavel'],
                "",
                $arrAtiv['observacao'],
                $arrAtiv['dataAtv'],
                $arrAtiv['dataCreate']
            )
        );
    }

    #Retorna os dados da atividade
    public function getAtv($data)
    {
        $dados=[];
        $b=$this->selectDB(
            "*",
            "atividade",
            "WHERE data=?",
            array(
                $data
            )
        );
        $r=0;
        while($f=$b->fetch(\PDO::FETCH_ASSOC)){
            $dados[$r]=$f;
            $r++;
        }
        return $dados;
    }
    #deletar Atividade
    public function deleteAtividade($id){
        $b=$this->deleteDB(
            "atividade",
            "id=?",
            array(
                $id
            )
        );        
    }


}