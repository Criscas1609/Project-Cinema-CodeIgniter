<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Client;
use App\Models\Movie;

class RegisterController extends BaseController
{

    protected $session;

    public function __construct()
    {
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        return view('register', ['message' => null]);
    }

    public function createClient(){
        $clientModel = new Client();
        $client = [
            'name' => $this->request->getPost('name'),
            'username' => $this->request->getPost('username'),
            'birthdate' => $this->request->getPost('birthdate'),
            'phone' => $this->request->getPost('phone'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];
        $clientModel->insert($client);
        return view('index', ['message' => 'Cuenta creada con éxito']);
    }

    public function updateUser()
    {
        $clientModel = new Client();
        $client = $this->session->get('user');
        $client->name = $this->request->getPost('name');
        $client->username = $this->request->getPost('username');
        $client->birthdate = $this->request->getPost('birthdate');
        $client->phone = $this->request->getPost('phone');
        $client->email = $this->request->getPost('email');
        $clientModel->save($client);
        $movieModel = new Movie();
        return view('info', ['allMovies' => $movieModel->findAll(), 'message' => 'Actualización de datos realizada con exito']);
    }

    
}
