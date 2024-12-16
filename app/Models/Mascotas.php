<?php
/**
 * Clase Mascotas
 * @author  Carlos Borreguero Redondo
 */

require_once('DBAbstractModel.php');
class Mascotas extends DBAbstractModel
{
    /*CONSTRUCCIÓN DEL MODELO SINGLETON*/
    private static $instancia;
    public static function getInstancia()
    {
        if (!isset(self::$instancia)) {
            $miclase = __CLASS__;
            self::$instancia = new $miclase;
        }
        return self::$instancia;
    }
    public function __clone()
    {
        trigger_error('La clonación no es permitida!.', E_USER_ERROR);
    }

    private $id;
    private $nombre;
    private $peso;
    private $raza;
    private $created_at;
    private $updated_at;

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public function setPeso($peso)
    {
        $this->peso = $peso;
    }
    public function setRaza($raza)
    {
        $this->raza = $raza;
    }
    public function getMensaje()
    {
        return $this->mensaje;
    }

    public function set() {
        $this->query = "INSERT INTO perros(nombre,peso,raza)
        VALUES(:nombre, :peso, :raza)";
        
        //$this->parametros['id']= $id;
        $this->parametros['nombre']= $this->nombre;
        $this->parametros['peso']= $this->peso;
        $this->parametros['raza']= $this->raza;
        $this->get_results_from_query();
        //$this->execute_single_query();
        $this->mensaje = 'Perros añadido.';
        }

        public function get($id = '') {
            if ($id != '') {
                $this->query = "SELECT * FROM perros WHERE id = :id"; // Obtenemos id de la tabla perros
                $this->parametros['id'] = $id;   // Asignamos el id del array parametros
                $this->get_results_from_query(); 
                $this -> mensaje = $id;
                if(count($this->rows) == 1){
                    foreach($this->rows[0] as $propiedad=>$valor){
                        $this->$propiedad = $valor;
                        echo "$propiedad: $valor<br>";
                    }
                    $this->mensaje = 'Perro encontrado';
            } else{
                $this->mensaje = 'Perro no encontrado';
            }
            return $this->rows[0] ?? null;
        }
    }
        public function edit() {
            $fecha = new DateTime();
            $this-> query= "UPDATE perros SET nombre=:nombre, 
                                              peso=:peso, raza=:raza, 
                                              updated_at=:updated_at  
                                        WHERE id=:id"; // now() es una función de mysql que devuelve la fecha actual, update_at=now() es lo mismo que updated_at=2021-05-12 12:00:00
            $this->parametros['id'] = $this->id;
            $this->parametros['nombre'] = $this->nombre;
            $this->parametros['peso'] = $this->peso;
            $this->parametros['raza'] = $this->raza;
            $this->parametros['updated_at'] = date('Y-m-d H:i:s', $fecha->getTimestamp());
            $this->get_results_from_query();
            $this->mensaje = 'Perro modificado';
        }

   /*      public function delete($id = "") {
            $this->query = "DELETE FROM perros WHERE id=:id";
            $this->parametros['id'] = $id;
            $this->get_results_from_query();
            $this->mensaje = 'Perro eliminado';
                }
 */
            public function delete() {
                $this->query = "DELETE FROM perros WHERE id=:id";
                $this->parametros['id'] = $this->id;
                $this->get_results_from_query();
                $this->mensaje = 'Perro eliminado';
            }
        }