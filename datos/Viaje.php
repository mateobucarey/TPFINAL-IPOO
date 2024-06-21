<?php

include_once ('BaseDatos.php');

class Viaje{
    private $idViaje;
    private $destino;
    private $cantMaxPasajeros;
    private $objEmpresa;
    private $objResponsable;
    private $importe;
    private $msjoperacion;

    public function __construct(){
        $this->idViaje = 0;
        $this->destino = "";
        $this->cantMaxPasajeros = "";
        $this->objEmpresa = "";
        $this->objResponsable = "";
        $this->importe = "";
    }

    public function getIdViaje()
    {
        return $this->idViaje;
    }

    public function setIdViaje($idViaje)
    {
        $this->idViaje = $idViaje;
    }

    public function getDestino()
    {
        return $this->destino;
    }

    public function setDestino($destino)
    {
        $this->destino = $destino;
    }

    public function getCantMaxPasajeros()
    {
        return $this->cantMaxPasajeros;
    }

    public function setCantMaxPasajeros($cantMaxPasajeros)
    {
        $this->cantMaxPasajeros = $cantMaxPasajeros;
    }

    public function getObjEmpresa()
    {
        return $this->objEmpresa;
    }

    public function setObjEmpresa($objEmpresa)
    {
        $this->objEmpresa = $objEmpresa;
    }

    public function getObjResponsable()
    {
        return $this->objResponsable;
    }

    public function setObjResponsable($objResponsable)
    {
        $this->objResponsable = $objResponsable;
    }

    public function getImporte()
    {
        return $this->importe;
    }

    public function setImporte($importe)
    {
        $this->importe = $importe;
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
        "INSERT INTO viaje(idviaje, vdestino, vcantmaxpasajeros, idempresa, rnumeroempleado, vimporte)
        VALUES (". $this->getIdViaje(). ",". $this->getDestino().",". $this->getCantMaxPasajeros().",". $this->getObjEmpresa(). ",". $this->getObjResponsable().",". $this->getImporte().")";
        if ($base->Iniciar()) {
            if ($id = $base->devuelveIDInsercion($consultaInsertar)) {
                $this->setIdViaje($id);
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
        "UPDATE viaje 
        SET vdestino = ".$this->getDestino()." vcantmaxpasajeros = ".$this->getCantMaxPasajeros()." vimporte =". $this->getImporte()."
        WHERE idviaje = ". $this->getIdViaje();
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
        WHERE idviaje =". $this->getIdViaje();
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