<?php
include_once ('BaseDatos.php');

class Persona{
    private $nombre;
    private $apellido;
    private $nroDoc;
    private $msjoperacion;

    public function __construct(){
        $this->nombre = "";
        $this->apellido = "";
        $this->nroDoc = "";
    }

    public function cargar($nombre, $apellido,$nroDoc){
        $this->setNombre($nombre);
        $this->setApellido($apellido);
        $this->setNrodoc($nroDoc);
    }
   
    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    public function getNroDoc()
    {
        return $this->nroDoc;
    }

    public function setNroDoc($nroDoc)
    {
        $this->nroDoc = $nroDoc;
    }

    public function getMsjoperacion()
    {
        return $this->msjoperacion;
    }

    public function setMsjoperacion($msjoperacion)
    {
        $this->msjoperacion = $msjoperacion;
    }

    public function __toString(){
        
    }

    public function insertar(){
        $base = new BaseDatos();
        $msj = false;
        $consultaInsertar = 
        "INSERT INTO persona(nombre, apellido, nrodoc) 
        VALUES (".$this->getNombre().",". $this->getApellido().",".$this->getNroDoc().")";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaInsertar)) {
                $msj = true;
            } else{
                $this->setMsjoperacion($base->getError());
            }
        } else {
            $this->setMsjoperacion($base->getError());
        }
        return $msj;
    }

    public function modificar(){
        $base = new BaseDatos;
        $msj = false;
        $consultaModificar = 
        "UPDATE persona 
        SET nombre = ".$this->getNombre()." apellido = ".$this->getApellido()."
        WHERE nrodoc = ". $this->getNroDoc();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaModificar)) {
                $msj = true;
            } else {
                $this->setMsjoperacion($base->getError());
            }
        } else {
            $this->setMsjoperacion($base->getError());
        }
        return $msj;
    }

    public function eliminar(){
        $base = new BaseDatos;
        $msj = false;
        $consultaError = 
        "DELETE FROM persona
        WHERE nrodoc =". $this->getNroDoc();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaError)) {
                $msj = true;
            } else {
                $this->setMsjoperacion($base->getError());
            }
        } else {
            $this->setMsjoperacion($base->getError());
        }
        return $msj;
    }

}