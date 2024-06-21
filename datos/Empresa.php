<?php

include_once ('BaseDatos.php');

class Empresa{
    private $idEmpresa;
    private $nombre;
    private $direccion;
    private $msjoperacion;

    public function __construct(){
        $this->idEmpresa = 0;
        $this->nombre = "";
        $this->direccion = "";
    }

    public function cargar($idEmpresa, $nombre, $direccion){
        $this->setIdEmpresa($idEmpresa);
        $this->setNombre($nombre);
        $this->setDireccion($direccion);
    }
    
    public function getIdEmpresa()
    {
        return $this->idEmpresa;
    }

    public function setIdEmpresa($idEmpresa)
    {
        $this->idEmpresa = $idEmpresa;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    public function getMsjoperacion()
    {
        return $this->msjoperacion;
    }

    public function setMsjoperacion($msjoperacion)
    {
        $this->msjoperacion = $msjoperacion;
    }

    public function __toString()
    {
        
    }

    public function insertar(){
        $base = new BaseDatos;
        $msj = false;
        $consultaInsertar = 
        "INSERT INTO empresa(idempresa, enombre, edireccion)
        VALUES (". $this->getIdEmpresa(). ",". $this->getNombre().",". $this->getDireccion().")";
        if ($base->Iniciar()) {
            if ($id = $base->devuelveIDInsercion($consultaInsertar)) {
                $this->setIdEmpresa($id);
                $msj = true;
            } else {
                $this->setMsjoperacion($base->getError());
            }
        } else{ 
            $this->setMsjoperacion($base->getError());
        }
        return $msj;
    }

    public function modificar(){
        $base = new BaseDatos;
        $msj = false;
        $consultaModificar = 
        "UPDATE empresa 
        SET enombre = ".$this->getNombre()." edireccion = ".$this->getDireccion()."
        WHERE idempresa = ". $this->getIdEmpresa();
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
        "DELETE FROM empresa
        WHERE idempresa =". $this->getIdEmpresa();
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