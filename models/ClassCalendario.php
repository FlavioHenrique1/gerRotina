<?php
namespace Models;

class ClassCalendario extends ClassCrud{
    #get eventos do calendario
    public function getEvents($id){
        $b=$this->selectDB(
            "*",
            "events",
            "",
            array(
            )
        );
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
}
