<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Movie;
use App\Models\Ticket;

class TicketController extends BaseController
{
    protected $session;
    public function __construct()
    {
        $this->session = \Config\Services::session();
    }


    public function createTicket(){
        $movieModel = new Movie();
        $ticketModel = new Ticket();
        $movieName = $this->request->getPost('movieName');
        $movie = $movieModel->where('LOWER(name) LIKE', '%' . strtolower($movieName) . '%')->first();
        $client = $this->session->get('user');
        $counter = $this->validateTicket($ticketModel, $client, $movie);
        $validator = $this->validateChair($ticketModel, $this->request->getPost('chair'), $movie);

        if($counter <= 4 && $validator == false){
         $ticket = [
            'movieName' => $movie->name,
            'schedule' => $movie->schedule,
            'chair' => $this->request->getPost('chair'),
            'price' => '10000',
            'clientName' => $client->name,
            'status' => 'waiting'
        ];
        $ticketModel->insert($ticket);
        return view('movieSeat', ['movie' => $movie, 'tickets' => $ticketModel->findAll(), 'error' => null]);
        }elseif($validator == true){
            $error = 'El asiento que ha seleccionado ya fue reservado';
            return view('movieSeat', ['movie' => $movie, 'tickets' => $ticketModel->findAll(), 'error' => $error]);
        }
        else{
            $error = 'Solo puede seleccionar 4 asientos para hacer la reserva';
            return view('movieSeat', ['movie' => $movie, 'tickets' => $ticketModel->findAll(), 'error' => $error]);
        }
    }

    public function validateChair($ticketModel, $chair, $movie){
        $tickets = $ticketModel->findAll();
        foreach($tickets as $ticket){
            if($ticket->chair == $chair) {
            $validator = true;
            return $validator;
            }
        }
    }

    public function validateTicket($ticketModel, $client, $movie){
        $tickets = $ticketModel->findAll();
        $counter = 1;
        foreach($tickets as $ticket){
            if($ticket->clientName == $client->name && $ticket->movieName == $movie->name){
                $counter++;
            }
        }
        return $counter;
    }



    public function deleteProcess(){
        $movieModel = new Movie();
        $ticketModel = new Ticket();
        $tickets = $ticketModel->findAll();
        $movieName = $this->request->getPost('movieName');
        $movie = $movieModel->where('LOWER(name) LIKE', '%' . strtolower($movieName) . '%')->first();
        $client = $this->session->get('user');

        foreach($tickets as $ticket){
            if($ticket->clientName == $client->name && $ticket->movieName == $movie->name && $ticket->status == 'waiting'){
                $ticketModel->where('id', $ticket->id)->delete();
            }
        }
        $message = 'Reserva cancelada con exito';
        return view('info', ['allMovies' =>  $movieModel->findAll(), 'message' => $message]);
        
    }

    public function showReservation(){
        $movieModel = new Movie();
        $ticketModel = new Ticket();
        $tickets = $ticketModel->findAll();
        $movieName = $this->request->getPost('movieName');
        $movie = $movieModel->where('LOWER(name) LIKE', '%' . strtolower($movieName) . '%')->first();
        $client = $this->session->get('user');
        $clientChair = [];
        $total=0;

        foreach($tickets as $ticket){
            if($ticket->clientName == $client->name && $ticket->movieName == $movie->name){
                $clientChair[] = $ticket->chair; 
                $total = $total + $ticket->price;

            }
        }

        return view('sell', ['movie' => $movie, 'chairs' => $clientChair, 'error' => null, 'total' => $total]);
    }


    public function saveReservation(){
        $movieModel = new Movie();
        $ticketModel = new Ticket();
        $tickets = $ticketModel->findAll();
        $movieName = $this->request->getPost('movieName');
        $movie = $movieModel->where('LOWER(name) LIKE', '%' . strtolower($movieName) . '%')->first();
        $client = $this->session->get('user');

        foreach($tickets as $ticket){
            if($ticket->clientName == $client->name && $ticket->movieName == $movie->name && $ticket->status == 'waiting'){
                $ticket->status = 'complete';
                $ticketModel->save($ticket);
            }
        }

    return redirect()->to('/movies');

    }

    public function showAllReservation(){
        $movieModel = new Movie();
        $ticketModel = new Ticket();
        $client = $this->session->get('user');
        $clientChair = [];
        $total=0;

        foreach($movieModel->findAll() as $movie){
            foreach($ticketModel->findAll() as $ticket){
                if($ticket->clientName == $client->name && $ticket->movieName == $movie->name){
                    $clientChair[] = $ticket->chair; 
                    $total = $total + $ticket->price;

                }
            }
        }

        return view('showReservations', ['allMovies' =>  $movieModel->findAll(),'client'=> $client,'tickets' => $ticketModel->findAll(), 'message' => null]);
    }

    public function deleteAll(){
        $movieModel = new Movie();
        $ticketModel = new Ticket();
        $tickets = $ticketModel->findAll();
        $movieName = $this->request->getPost('movieName');
        $movie = $movieModel->where('LOWER(name) LIKE', '%' . strtolower($movieName) . '%')->first();
        $client = $this->session->get('user');

        foreach($tickets as $ticket){
            if($ticket->clientName == $client->name && $ticket->movieName == $movie->name && $ticket->status == 'complete'){
                $ticketModel->where('id', $ticket->id)->delete();
            }
        }
        $message = 'Reserva cancelada con exito';
        return view('showReservations', ['allMovies' =>  $movieModel->findAll(),'client'=> $client,'tickets' => $ticketModel->findAll(), 'message' => $message]);

    }



}
