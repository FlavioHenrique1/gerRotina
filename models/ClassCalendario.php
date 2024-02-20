<?php
namespace Models;


class ClassCalendario extends ClassCrud{
    #get eventos do calendario
    public function getEvents($cd,$pront,$setor="",$id=null){
        // SELECT * FROM `events` WHERE `cd`='cdpe' AND `tipo`='cd' or `prontuario`='148429'
        if($id != null){
            $b=$this->selectDB(
                "*",
                "events",
                "WHERE id=?",
                array(
                    $id
                )
            );

        }else{
            $b=$this->selectDB(
                "*",
                "events",
                "WHERE cd=? AND tipo=? OR prontuario=?",
                array(
                    $cd,
                    "CD",
                    $pront
                )
            );
        }


        $f=$b->fetchAll(\PDO::FETCH_ASSOC);
        return $f;
    }

    #inser no calendario
    public function insertCale($arrEvents,$cd,$pront,$dataCreate,$tipo){
        if($tipo == "CD"){
            $cor="#000000";
        }else{
            $cor="#060ef9";
        }
        $b=$this->insertDB(
            "events",
            "?,?,?,?,?,?,?,?,?,?,?",
            array(
                0,
                $arrEvents['title'],
                $arrEvents['description'],
                $cor,
                $arrEvents['start'],
                $arrEvents['end'],
                $pront,
                $cd,
                "",
                $dataCreate,
                $tipo
            )
        );
    }
    
    #editar eventos
    public function editCale($arrEvents){
        $b=$this->updateDB(
            "events",
            "title=?, description=? , start=?",
            "id=?",
            array(
                $arrEvents['title'],
                $arrEvents['description'],
                $arrEvents['start'],
                $arrEvents['id']
            )
        );
    }

    #Deletar eventos
    public function deleteCal($id){
        $b=$this->deleteDB(
            "events",
            "id=?",
            array(
                $id
            )
        );    

    }

}
