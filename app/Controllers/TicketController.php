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

        if($counter <= 4){
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
        }else{
            $error = 'alert';
            $tickets = $ticketModel->findAll();
            return view('movieSeat', ['movie' => $movie, 'tickets' => $tickets, 'error' => $error]);
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

        return redirect()->to('/movies');
        ;
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

}
