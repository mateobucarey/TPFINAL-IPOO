<?php

include_once ('BaseDatos.php');

class Pasajero extends Persona{
    private $telefono;
    private $objViaje;
    private $msjoperacion;

    public function __construct(){
        parent::__construct();
        $this->telefono = "";
        $this->objViaje = "";
    }

    public function cargar($nombre, $apellido, $nrodoc, $telefono, $objViaje){
        parent::cargar($nombre, $apellido, $nrodoc);
        $this->setTelefono($telefono);
        $this->setObjViaje($objViaje);
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    public function getObjViaje()
    {
        return $this->objViaje;
    }

    public function setObjViaje($objViaje)
    {
        $this->objViaje = $objViaje;
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
        $base = new BaseDatos;
        $msj = false;
        if (parent::insertar()) {
            $consultaInsertar = 
            "INSERT INTO pasajero(pdocumento, pnombre, papellido, ptelefono, idviaje)
            VALUES (". $this->getNroDoc() .",". $this->getNombre(). ",". $this->getApellido(). ",". $this->getTelefono(). ",". $this->getObjViaje(). ")";
            if ($base->Iniciar()) {
                if ($base->Ejecutar($consultaInsertar)) {
                    $msj = true;
                } else {
                    $this->setMsjoperacion($base->getError());
                }
            } else{
                $this->setMsjoperacion($base->getError());
            }
        }
        return $msj;
    }

    public function modificar(){
      $base = new BaseDatos;
      $msj = false;
      if (parent::modificar()) {
        $consultaModificar = 
        "UPDATE pasajero
        SET ptelefono=". $this->getTelefono()."
        WHERE pdocumento=". $this->getNroDoc();
        if($base->Iniciar()){
            if($base->Ejecutar($consultaModificar)){
                $msj=  true;
            }else{
                $this->setMsjoperacion($base->getError());
                
            }
        }else{
            $this->setMsjoperacion($base->getError());
            
        }
    }
    return $msj;
    }

    public function eliminar(){
        $base = new BaseDatos;
        $msj = false;
        if ($base->Iniciar()) {
            $consultaEliminar = 
            "DELETE FROM pasajero
            WHERE pdocumento = ". $this->getNroDoc();
            if ($base->Ejecutar($consultaEliminar)) {
                if (parent::eliminar()) {
                    $msj = true;
                }
            } else {
                $this->setMsjoperacion($base->getError());
            }
        } else{
            $this->setMsjoperacion($base->getError());
        }
        return $msj;
    }


}