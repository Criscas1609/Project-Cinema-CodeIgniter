<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Movie;
use App\Models\Ticket;

class MovieController extends BaseController
{
    public function index()
    {
        $movieModel = new Movie();
        return view('info', ['allMovies' => $movieModel->findAll(), 'message' => null]);
    }

    public function reservationView(){
        $movieModel = new Movie();
        $name = $this->request->getVar('movie');
        $movie = $movieModel->where('LOWER(name) LIKE', '%' . strtolower($name) . '%')->first();
        $ticketModel = new Ticket();
        $tickets = $ticketModel->findAll();
        return view('movieSeat', ['movie' => $movie, 'tickets' => $tickets, 'error' => null]);
}
    
}
