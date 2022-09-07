<?php

namespace Src\File;

class Upload
{
    private $name;
    private $extension;
    private $type;
    private $tmpName;
    private $error;
    private $size;
    private $duplicates = 0;


    public function __construct($file)
    {
            $this->type = $file['type'];
            $this->tmpName = $file['tmp_name'];
            $this->error = $file['error'];
            $this->size = $file['size'];

            $info = pathinfo($file['name']);
            $this->name = $info['filename'];
            $this->extension = $info['extension'];
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function generateNewName()
    {
            $this->name = time().'-'.rand(0,9999);
    }

    public function getBasename()
    {
        //VALIDA EXTENSÃO
        $extension = strlen($this->extension) ? '.'.$this->extension : '';
        
        //VALIDA DUPLICACAO
        $duplicates = $this->duplicates > 0 ? '-'.$this->duplicates :"";
        
        
        //RETORNA O NOME COMPLETO
        return $this->name.$duplicates.$extension;
    }

    public function getPossibleBasename($dir,$overwrite)
    {
        //SOBRESCREVER ARQUIVO  
        if($overwrite) return $this->getBasename();

        //NAO PODE SOBRESCREVER ARQUIVO
        $basename = $this->getBasename();

        //VERIFICA DUPLICACAO
        if(!file_exists($dir.'/'.$basename))
        {
            return $basename;
        }
        //INCREMENTAR DUPLICACOES
        $this->duplicates++;

        //RETORNA O PROPRIO METODO
        return $this->getPossibleBasename($dir,$overwrite);
    }


    public function upload($dir,$overwrite = true)
    {
        //verifica erro
            if($this->error !=0) return false;

            //CAMINHO COMPLETO DE DESTINO
            $path = $dir.'/'.$this->getPossibleBasename($dir,$overwrite = true);
            return move_uploaded_file($this->tmpName,$path);
    }
}