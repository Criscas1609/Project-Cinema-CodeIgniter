<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Client;

class RegisterController extends BaseController
{

    protected $session;

    public function __construct()
    {
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        return view('register');
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
        return redirect()->to('/login');
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
        return redirect()->to('/movies');    
    }

    
}
