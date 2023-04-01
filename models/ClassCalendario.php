<?php
namespace Models;

class ClassCalendario extends ClassCrud{
    #get eventos do calendario
    public function getEvents($id=null){
        if($id == null){
            $b=$this->selectDB(
                "*",
                "events",
                "",
                array(
                )
            );
        }else{
            $b=$this->selectDB(
                "*",
                "events",
                "where id=?",
                array(
                    $id
                )
            );
        }
        $f=$b->fetchAll(\PDO::FETCH_ASSOC);
        return $f;
    }

    #inser no calendario
    public function insertCale($arrEvents){
        $b=$this->insertDB(
            "events",
            "?,?,?,?,?,?",
            array(
                0,
                $arrEvents['title'],
                $arrEvents['description'],
                $arrEvents['color'],
                $arrEvents['start'],
                $arrEvents['end']
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
}
