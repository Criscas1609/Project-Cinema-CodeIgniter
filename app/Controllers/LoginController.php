<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Client;


class LoginController extends BaseController
{

    protected $session;

    public function __construct()
    {
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        return view('index', ['message' => null]);
    }
    public function validateInfo(){
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $clientModel = new Client();
            $user = $clientModel->where('username', $username)->first();
  
         if (!$user) {
             return view('/register', ['message' => 'Usuario no encontrado, crea una cuenta']);
         }
        
         if ($user && password_verify($password, $user->password)) {
            $this->session->set('user', $user);

            return redirect()->to('/movies');
        } else {
             return view('/register');
            }
    }

    public function getInfo(){
        $user = $this->session->get('user');
        return view('update', ['user' => $user]);
    }

    public function logout(){
        $this->session->destroy();
        return redirect()->to('/login');
    }

}
