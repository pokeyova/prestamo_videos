<?php
require_once 'Controlador.php';

class Login extends Controlador{

    public function __construct(){
        $this->user = $this->modelo('MUser');
    }

    public function index(){
        session_start();
        if(isset($_SESSION['cod_user']) && isset($_SESSION['name']) && isset($_SESSION['type']))
        {
            header('location:/'.APP_NAME.'/borrowing');
        }
        $this->vista('auth/login',[
                                    'empresa' => 'Video club "Media"',
                                ]);
    }

    public function comprueba(){
        $name = '';
        $password = '';
        if(isset($_POST['name']))
        {
            $name = $_POST['name'];
        }
        if(isset($_POST['password']))
        {
            $password = $_POST['password'];
        }

        $user = $this->user->validaLogin($name, $password);
        if($user)
        {
            session_start();
            $_SESSION['cod_user'] = $user->cod_user;
            $_SESSION['name'] = $user->name;
            $_SESSION['type'] = $user->type;
            
            header('location:/'.APP_NAME.'/borrowing');
        }
        else{
            header('location:/'.APP_NAME.'/login?name='.$name);
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header('location:/'.APP_NAME.'');
    }

}