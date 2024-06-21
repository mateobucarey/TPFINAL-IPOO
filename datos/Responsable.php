<?php

include_once ('BaseDatos.php');

class Responsable extends Persona{
    private $numeroEmpleado;
    private $numeroLicencia;
    private $msjoperacion;

    public function __construct(){
        parent::__construct();
        $this->numeroEmpleado = 0;
        $this->numeroLicencia = "";
    }

    public function cargar($nombre, $apellido, $nroDoc, $numeroEmpleado, $numeroLicencia){
        parent::cargar($nombre, $apellido, $nroDoc);
        $this->setNumeroEmpleado($numeroEmpleado);
        $this->setNumeroLicencia($numeroLicencia);
    }

    public function getNumeroEmpleado()
    {
        return $this->numeroEmpleado;
    }

    public function setNumeroEmpleado($numeroEmpleado)
    {
        $this->numeroEmpleado = $numeroEmpleado;
    }

    public function getNumeroLicencia()
    {
        return $this->numeroLicencia;
    }

    public function setNumeroLicencia($numeroLicencia)
    {
        $this->numeroLicencia = $numeroLicencia;
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
        if (parent::insertar()) {
            $consultaInsertar = 
            "INSERT INTO responsable(rnumeroempleado, rnumerolicencia, rnombre, rapellido, rnrodocumento)
            VALUES (". $this->getNumeroEmpleado() .",". $this->getNumeroLicencia(). ",". $this->getNombre(). ",". $this->getApellido(). ",". $this->getNroDoc(). ")";
            if ($base->Iniciar()) {

                if ($id = $base->devuelveIDInsercion($consultaInsertar)) {
                    $this->setNumeroEmpleado($id);
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
        "UPDATE responsable
        SET rnumerolicencia=". $this->getNumeroLicencia()." rnombre =". $this->getNombre(). "rapellido =". $this->getApellido(). " rnrodocumento =". $this->getNroDoc()."
        WHERE rnumeroempleado=". $this->getNumeroEmpleado();
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
            "DELETE FROM responsable
            WHERE rnumeroempleado = ". $this->getNumeroEmpleado();
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