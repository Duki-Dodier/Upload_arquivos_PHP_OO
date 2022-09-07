<?php

require_once __DIR__.'/vendor/autoload.php';


use \Src\File\Upload;

if(isset($_FILES['arquivo']))
{
    //INSTANCIA DE UPLOAD
    $obUpload = new Upload($_FILES['arquivo']);

    //ALTERA NOME DO ARQUVIO
    //$obUpload->setName('novo-arquivo-nome-alterado');

    //GERANDO NOME ALEATORIO
    $obUpload->generateNewName();


    //MOVE OS ARQUIVOS DE UPLOAD
    $sucesso = $obUpload->upload(__DIR__.'/files',false);
    
    if($sucesso)
    {
        echo "Arquivo <strong> ".$obUpload->getBasename(). "</strong>  enviado com sucesso!";
        exit;
    }
    die("Problemas ao enviar o arquivo");
}


require_once __DIR__.'/includes/formulario.php';