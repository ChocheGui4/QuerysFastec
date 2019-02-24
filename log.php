<?php
/**
 * Created by PhpStorm.
 * User: mario
 * Date: 08/04/2018
 * Time: 01:18 PM
 */
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}
// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers:        
        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    exit(0);
}
require_once 'UsersModel.php';
$errors = [
    'IS_NOT_POST' => 'No es una petición aceptable',
    'OPTION_ERROR' => 'NO es una opción valida',
    'VARS_EMPTY' => 'Datos incompletos',
    'EMPTY_USER' => 'Usuario no encontrado'
];
$response = [
    'success' => false,
    'error' => ''
];
$request = file_get_contents("php://input");
$request = json_decode($request, true);
if (count($request) > 0 ) {
    $option = $request['option'];
    try {
        switch ($option) {
            case 'login':
                if (empty($request['user_email']) || empty($request['user_password'])) {
                    throw new Exception($errors['VARS_EMPTY']);
                }
                $user = $request['user_email'];
                $password = $request['user_password'];
                $model = new UsersModel();
                $user = $model->getUser($user, $password);
                if ($user['success']) {
                    $response['success'] = true;
                    $response['user'] = $user;
                    echo json_encode($response); die();
                } else {
                    throw new Exception($errors['EMPTY_USER']);
                }
            break;
            case 'traerunidad':
                if (empty($request['idcond'])) {
                    throw new Exception($errors['VARS_EMPTY']);
                }
                $user = $request['idcond'];
                
                $model = new UsersModel();
                $user = $model->getIdconductor($user);
                if ($user['success']) {
                    $response['success'] = true;
                    $response['user'] = $user;
                    echo json_encode($response); die();
                } else {
                    throw new Exception($errors['EMPTY_USER']);
                }
            break;
            case 'unidad':
                if (empty($request['unidad'])) {
                    throw new Exception($errors['VARS_EMPTY']);
                }
                $user = $request['unidad'];
                
                $model = new UsersModel();
                $user = $model->getUnidadEdit($user);
                if ($user['success']) {
                    $response['success'] = true;
                    $response['user'] = $user;
                    echo json_encode($response); die();
                } else {
                    throw new Exception($errors['EMPTY_USER']);
                }
            break;
            case 'placas':
                if (empty($request['placas'])) {
                    throw new Exception($errors['VARS_EMPTY']);
                }
                $user = $request['placas'];
                
                $model = new UsersModel();
                $user = $model->getPlacasEdit($user);
                if ($user['success']) {
                    $response['success'] = true;
                    $response['user'] = $user;
                    echo json_encode($response); die();
                } else {
                    throw new Exception($errors['EMPTY_USER']);
                }
            break;
            case 'usuario':
                if (empty($request['user'])) {
                    throw new Exception($errors['VARS_EMPTY']);
                }
                $user = $request['user'];
                
                $model = new UsersModel();
                $user = $model->getUserEdit($user);
                if ($user['success']) {
                    $response['success'] = true;
                    $response['user'] = $user;
                    echo json_encode($response); die();
                } else {
                    throw new Exception($errors['EMPTY_USER']);
                }
            break;
            case 'codigo':
                if (empty($request['cod'])) {
                    throw new Exception($errors['VARS_EMPTY']);
                }
                $cod = $request['cod'];
                
                $model = new UsersModel();
                $user = $model->getCodeExist($cod);
                if ($user['success']) {
                    $response['success'] = true;
                    $response['user'] = $user;
                    echo json_encode($response); die();
                } else {
                    throw new Exception($errors['EMPTY_USER']);
                }
            break;
            case 'registercondactulizar':

                $nombre= $request['user_name'];
                $apellidop = $request['user_app'];
                $apellidom = $request['user_apm'];
                $cel = $request['user_cell'];
                $email = $request['user_email'];
                $user = $request['user_user'];
                $pass = $request['user_pass'];
                $idcond = $request['user_id'];


                $model = new UsersModel();
                $user = $model->getUpdateConductor($nombre,$apellidop,$apellidom,$cel,$email,$user,$pass,$idcond);
                if(!$user){
                    throw new Exception($errors['EMPTY_USER']);
                }
                else{
                    $response['success']=true;
                    echo json_encode($response); die();
                    die();
                }
            break;
            case 'registercond':

                $nombre= $request['user_name'];
                $apellidop = $request['user_app'];
                $apellidom = $request['user_apm'];
                $cel = $request['user_cell'];
                $email = $request['user_email'];
                $user = $request['user_user'];
                $pass = $request['user_pass'];
                $cod = $request['user_cod'];


                $model = new UsersModel();
                $user = $model->getRegisterCond($nombre,$apellidop,$apellidom,$cel,$email,$user,$pass,$cod);
                if(!$user){
                    throw new Exception($errors['EMPTY_USER']);
                }
                else{
                    $response['success']=true;
                    echo json_encode($response); die();
                    die();
                }
            break;
            case 'registeruni':

                $numuni= $request['user_numuni'];
                $numplacas = $request['user_placas'];
                $iduni = $request['iduni'];
                


                $model = new UsersModel();
                $user = $model->getRegisterUnit($numuni,$numplacas,$iduni);
                if(!$user){
                    throw new Exception($errors['EMPTY_USER']);
                }
                else{
                    $response['success']=true;
                    echo json_encode($response); die();
                    die();
                }
            break;
            case 'registeruniact':

                $numuni= $request['user_numuni'];
                $numplacas = $request['user_placas'];
                $iduni = $request['iduni'];
                


                $model = new UsersModel();
                $user = $model->getUpdateunidad($numuni,$numplacas,$iduni);
                if(!$user){
                    throw new Exception($errors['EMPTY_USER']);
                }
                else{
                    $response['success']=true;
                    echo json_encode($response); die();
                    die();
                }
            break;
            case 'eliminaruni':

                $numuni= $request['iduni'];

                $model = new UsersModel();
                $user = $model->getDeleteUnidad($numuni);
                if(!$user){
                    throw new Exception($errors['EMPTY_USER']);
                }
                else{
                    $response['success']=true;
                    echo json_encode($response); die();
                    die();
                }
            break;
            case 'Eliminarcond':

                $idcond= $request['user_id'];

                $model = new UsersModel();
                $user = $model->getDeleteConductor($idcond);
                if(!$user){
                    throw new Exception($errors['EMPTY_USER']);
                }
                else{
                    $response['success']=true;
                    echo json_encode($response); die();
                    die();
                }
            break;
            default:
                throw new Exception($errors['OPTION_ERROR']);
            break;
        }
    } catch (Exception $e) {
        $response['error'] = $e->getMessage();
    } finally {
        echo json_encode($response);
        die();
    }
} else {
    $response['error'] = $errors['IS_NOT_POST'];
    echo json_encode($response);
    die();
}