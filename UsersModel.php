<?php
/**
 * Created by PhpStorm.
 * User: mario
 * Date: 08/04/2018
 * Time: 01:59 PM
 */
class UsersModel {
    private $connection;
    public function __construct () {
        $server = '127.0.0.1';
        $dataBase = 'latiem';
        try {
            $this->connection = new PDO(
                "mysql:host=$server;dbname=$dataBase",
                "root", "", array(
                PDO::ATTR_PERSISTENT         => false,
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            ));
        } catch (PDOException $e) {
            return false;
        }
    }
    public function getUser($user, $password) {
        $response = [
            'success' => false,
            'error' => ''
        ];
        try {
            $query = "SELECT * FROM conductor where usuario = '{$user}' AND pass = '{$password}'";
            $response['user_data'] = $this->connection->query($query)->fetchAll(PDO::FETCH_ASSOC);
            if (count($response['user_data']) > 0) {
                $response['success'] = true;
            }
        }  catch (Exception $e) {
            $response['error'] = $e->getMessage();
        }
        return $response;
    }
    public function getIdconductor($idconduc) {
        $response = [
            'success' => false,
            'error' => ''
        ];
        try {
            $query = "SELECT * FROM unidades where idcond = '{$idconduc}'";
            $response['user_data'] = $this->connection->query($query)->fetchAll(PDO::FETCH_ASSOC);
            if (count($response['user_data']) > 0) {
                $response['success'] = true;
            }
        }  catch (Exception $e) {
            $response['error'] = $e->getMessage();
        }
        return $response;
    }
    public function getUnidadEdit($unidadact) {
        $response = [
            'success' => false,
            'error' => ''
        ];
        try {
            $query = "SELECT * FROM unidades where unidad = '{$unidadact}'";
            $response['user_data'] = $this->connection->query($query)->fetchAll(PDO::FETCH_ASSOC);
            if (count($response['user_data']) > 0) {
                $response['success'] = true;
            }
        }  catch (Exception $e) {
            $response['error'] = $e->getMessage();
        }
        return $response;
    }
    public function getPlacasEdit($placasact) {
        $response = [
            'success' => false,
            'error' => ''
        ];
        try {
            $query = "SELECT * FROM unidades where placas = '{$placasact}'";
            $response['user_data'] = $this->connection->query($query)->fetchAll(PDO::FETCH_ASSOC);
            if (count($response['user_data']) > 0) {
                $response['success'] = true;
            }
        }  catch (Exception $e) {
            $response['error'] = $e->getMessage();
        }
        return $response;
    }
    public function getUserEdit($user) {
        $response = [
            'success' => false,
            'error' => ''
        ];
        try {
            $query = "SELECT * FROM conductor where usuario = '{$user}'";
            $response['user_data'] = $this->connection->query($query)->fetchAll(PDO::FETCH_ASSOC);
            if (count($response['user_data']) > 0) {
                $response['success'] = true;
            }
        }  catch (Exception $e) {
            $response['error'] = $e->getMessage();
        }
        return $response;
    }
    public function getUpdateConductor($nombre,$apellidop,$apellidom,$cel,$email,$user,$pass,$idcond) {
        $response = [
            'success' => false,
            'error' => ''
        ];
        try {
            $query = "UPDATE conductor SET nombre= '{$nombre}', apellidop='{$apellidop}', apellidom='{$apellidom}',
            telefono='{$cel}',correo='{$email}', usuario='{$user}', pass='{$pass}'
             where id= '{$idcond}' ";
            if ($this->connection->query($query) === TRUE){
                echo "Connected successfully";
            }
        }  catch (Exception $e) {
            echo $e->getMessage();
        }
        return $response;
    }
    public function getUpdateunidad($numuni,$numplacas,$iduni) {
        $response = [
            'success' => false,
            'error' => ''
        ];
        try {
            $query = "UPDATE unidades SET unidad= '{$numuni}', placas='{$numplacas}' 
            where idcond= '{$iduni}' ";
            if ($this->connection->query($query) === TRUE){
                echo "Connected successfully";
            }
        }  catch (Exception $e) {
            echo $e->getMessage();
        }
        return $response;
    }
    public function getDeleteUnidad($numuni) {
        $response = [
            'success' => false,
            'error' => ''
        ];
        try {
            $query = "DELETE FROM unidades where idcond= '{$numuni}'";
            if ($this->connection->query($query) === TRUE){
                echo "Connected successfully";
            }
        }  catch (Exception $e) {
            echo $e->getMessage();
        }
        return $response;
    }
    public function getDeleteConductor($user) {
        $response = [
            'success' => false,
            'error' => ''
        ];
        try {
            $query = "UPDATE conductor SET nombre= '', apellidop='', apellidom ='', telefono = '', 
            correo = '', usuario = '', pass = '' where id= '{$user}' ";
            if ($this->connection->query($query) === TRUE){
                echo "Connected successfully";
            }
        }  catch (Exception $e) {
            echo $e->getMessage();
        }
        return $response;
    }
    public function getCodeExist($cod) {
        $response = [
            'success' => false,
            'error' => ''
        ];
        try {
            $query = "SELECT * FROM conductor where codigov = '{$cod}'";
            $response['user_data'] = $this->connection->query($query)->fetchAll(PDO::FETCH_ASSOC);
            if (count($response['user_data']) > 0) {
                $response['success'] = true;
            }
        }  catch (Exception $e) {
            $response['error'] = $e->getMessage();
        }
        return $response;
    }
    public function getRegisterCond($nombre,$apellidop,$apellidom,$cel,$email,$user,$pass,$cod) {
        $response = [
            'success' => false,
            'error' => ''
        ];
        try {
            $query = "UPDATE conductor SET nombre= '{$nombre}', apellidop='{$apellidop}', apellidom='{$apellidom}',
            telefono='{$cel}',correo='{$email}', usuario='{$user}', pass='{$pass}'
             where codigov= '{$cod}' ";
            if ($this->connection->query($query) === TRUE){
                echo "Connected successfully";
            }
        }  catch (Exception $e) {
            echo $e->getMessage();
        }
        return $response;
    }
   
    public function getRegisterUnit($numuni,$numplacas,$iduni) {
        $response = [
            'success' => false,
            'error' => ''
        ];
        try {
            //Esta es la inserción
            $query = "INSERT INTO unidades(idcond,unidad,placas)
             values('{$iduni}','{$numuni}','{$numplacas}')";
            $response['user_data'] = $this->connection->query($query)->fetchAll(PDO::FETCH_ASSOC);
            if (count($response['user_data']) > 0) {
                $response['success'] = true;

            }
        }  catch (Exception $e) {
            $response['error'] = $e->getMessage();
        }
        return $response;
    }
        
}