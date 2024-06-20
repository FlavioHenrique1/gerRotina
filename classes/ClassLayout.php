<?php
namespace Classes;

class ClassLayout{

    public static function setHeadRestrito($permition)
    {
        $session=new ClassSessions();
        $session->verifyInsideSession($permition);
    }

    #Setar as tags do head
    public static function setHeader($title,$description, $author='Flávio')
    {

        $html="<!DOCTYPE html>\n";
        $html.="<html lang='pt-br'>\n";
        $html.="<head>\n";
        $html.="    <meta charset='UTF-8'>\n";
        $html.="    <meta http-equiv='X-UA-Compatible' content='IE=edge'>\n";
        $html.="    <meta name='viewport' content='width=device-width, initial-scale=1.0'>\n";
        $html.="    <meta name='author' content='$author'>\n";
        $html.="    <meta name='format-detection' content='telephone=no'>\n";
        $html.="    <meta name='description' content='$description'>\n";
        $html.="    <link rel='shortcut icon' href='#'>\n";
        $html.="    <title>$title</title>\n";
        $html.="    <link rel='icon' href='".DIRIMG."roda-64.png' type='image/x-icon'/>";
        #FAVICONs
        $html.="<link rel='stylesheet' href='".DIRCSS."bootstrap.min.css'>\n";
        $html.="<link rel='stylesheet' href='".DIRCSS."style.css'>\n";
        $html.="</head>\n\n";
        $html.="<body>\n";
        echo $html;

    }
    
    #Setar as tags do footer
    public static function setFooter($js=null)
    {
        $html="<script src='".DIRJS."zepto.min.js'></script>\n";
        $html.="<script src='".DIRJS."vanilla-masker.min.js'></script>\n";
        $html.="<script src='".DIRJS."javascript.js'></script>\n";
        $html.="<script src='".DIRJS."bootstrap.min.js'></script>\n";
        $html.="<script src='".DIRJS."bootstrap.bundle.min.js'></script>\n";
        if($js != null){
            $html.="<script src='".DIRJS.$js."'></script>\n";
        }

        
        #JAVASCRIPT
        $html.="</body>\n";
        $html.="</html>";
        echo $html;
    }
        #Setar as tags do footer
        public static function setNav()
        {
            @session_start();
            $nome= $_SESSION["name"];
            $permition=$_SESSION['permition'];
            $nFoto=$_SESSION['img'];
            //Verificar se a foto existe
            if($nFoto == ""){
                $minhaFoto=DIRIMG.'user2.png';
            }else{
                $minhaFoto=DIRIMG."imgUser/".$nFoto;
            }
            $html="<nav class='navbar navbar-expand-md navbar-dark fixed-top bg-dark'>
                <div class='container-fluid'>
                    <a class='navbar-brand'><img src='".DIRIMG."logo-americanassa-vermelha.png' alt=''></a>
                    <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarCollapse' aria-controls='navbarCollapse' aria-expanded='false' aria-label='Toggle navigation'>
                        <span class='navbar-toggler-icon'></span>
                    </button>
                    <div class='collapse navbar-collapse' id='navbarCollapse'>
                        <ul class='navbar-nav me-auto mb-2 mb-md-0'>
                            <li class='nav-item'>
                                <a class='nav-link active' aria-current='page' href='".DIRPAGE."atividades'>Home</a>
                            </li>
                            <li class='nav-item dropdown'>
                                <a class='nav-link dropdown-toggle' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                    Calendários
                                </a>
                                <ul class='dropdown-menu'>
                                    <li><a class='dropdown-item'  href='".DIRPAGE."calendario'>Calendário</a></li>
                                </ul>
                            </li>";
                            if($permition == 'manager'){
                                $html.="<li class='nav-item dropdown'>
                                <a class='nav-link dropdown-toggle' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                    Opções
                                </a>
                                <ul class='dropdown-menu'>
                                        <li><a class='dropdown-item'  href='".DIRPAGE."atividadesRotina'>Lista de tarefas de rotina</a></li>
                                            ";
                            }

                            $html.="</ul>
                            </li>
                        </ul>
                        <ul class='navbar-nav me-4 mb-2 mb-md-0'>
                            <li class='nav-item dropdown'>
                                <a class='nav-link dropdown-toggle' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                    {$nome}
                                </a>
                                <ul class='dropdown-menu'>
                                    ";
                                    if($permition == 'manager'){
                                        $html.="<li><a class='dropdown-item' aria-current='page' data-bs-toggle='modal'  data-bs-target='#exampleModal2'>Selecionar CD</a></li>
                                            ";
                                    }
                            $html.="<li><a class='dropdown-item' href='".DIRPAGE."EditarUsuario'>Editar</a></li>
                            <li><a class='dropdown-item' href='".DIRCONT."controllerLogout'>Sair</a></li>
                            </ul>
                            </li>
                            <div class='img_user'>
                                <img src='".$minhaFoto."' class='rounded-circle user_img'>
                            </div>
                        </ul>
                    </div>
                </div>
            </nav>";
            $html.="<div class='modal fade modal' id='exampleModal2' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                <div class='modal-dialog'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h1 class='modal-title fs-5' id='exampleModalLabel'>Lista de CD´s</h1>
                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                        </div>
                        <form action='".DIRCONT."controllerTeste' method='post'>
                            <div class='modal-body center'>
                                <select name='local' id='localCD' class='form-select'>
                                    <option disabled selected>Local...</option>
                                    <option value='CDPE'>CDPE</option>
                                    <option value='BELÉM'>BELÉM</option>
                                    <option value='CURITIBA'>CURITIBA</option>
                                    <option value='SALVADOR'>SALVADOR</option>
                                    <option value='CONTAGEM'>CONTAGEM</option>
                                    <option value='REVERSA'>REVERSA</option>
                                    <option value='ITAPEVI'>ITAPEVI</option>
                                    <option value='CDSP'>CDSP</option>
                                    <option value='GRAVATAÍ'>GRAVATAÍ</option>
                                    <option value='SEROPEDICA'>SEROPEDICA</option>
                                    <option value='CDMG'>CDMG</option>
                                    <option value='COMUNICACAO'>COMUNICAÇÃO</option>
                                </select>
                            </div>
                            <div class='modal-footer'>
                                <button type='submit' class='btn btn-primary' data-bs-dismiss='modal' onclick=''>Pesquisar</button>
                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal' onclick='ngOnDestroy()'>Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>";
            echo $html;
        }
}