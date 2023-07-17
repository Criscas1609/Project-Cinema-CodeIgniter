<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="theme-color" content="#bla"  />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
            integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <title>Cineverso</title>
        <!-- CSS only -->
        <link
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl"
          crossorigin="anonymous"
        />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/home.css'); ?>">
      </head>
        <?php if ($message != null): ?>
            <div class="alert alert-primary" role="alert">
                <?= $message ?>
            </div>
        <?php endif; ?>
          <body>
          <!-- As a heading -->
          <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
              <div class="container">
                  <a class="navbar-brand" href="#">
                      <img src="https://user-images.githubusercontent.com/102967338/252713059-16826ea2-06a0-489b-93cd-15af3a764109.png" alt="Logo" width="30" height="30" class="d-inline-block align-top">
                      Cineverso
                  </a>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarNav">
                      <ul class="navbar-nav ml-auto">
                          <li class="nav-item active">
                              <form action="/movies" method="get">
                                  <button type="submit" class="nav-link btn btn-link" name="inicio" value="inicio">Inicio</button>
                              </form>
                          </li>
                          <li class="nav-item active">
                              <form action="/reservation" method="get">
                                  <button type="submit" class="nav-link btn btn-link" name="inicio" value="inicio">Reservas</button>
                              </form>
                              
                          </li>
                          <li class="nav-item">
                              <form action="/update-info" method="get">
                                  <button type="submit" class="nav-link btn btn-link" name="usuario" value="usuario">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                          class="bi bi-person" viewBox="0 0 16 16">
                                          <path
                                              d="M8 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5zm3.5-2a3.5 3.5 0 0 1-3.5 3.5h-1A3.5 3.5 0 0 1 1 6.5a.5.5 0 0 1 1 0A2.5 2.5 0 0 0 5 9h1a2.5 2.5 0 0 0 2.5-2.5z" />
                                      </svg>
                                      Usuario
                                  </button>
                              </form>
                          </li>
                          <li class="nav-item">
                              <form action="/close" method="post">
                                  <button type="submit" class="nav-link btn btn-link" name="cerrar_sesion" value="cerrar_sesion">Cerrar sesión</button>
                              </form>
                          </li>
                      </ul>
                  </div>
              </div>
            </nav>


        
          <br>
          <div class="container mt-5">
            <div class="row row-cols-sm-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4">
              <!-- Peliculas -->
                <?php foreach ($allMovies as $movie): ?>
                  <div class="mb-4 col d-flex justify-content-center">
                    <div class="mb-1 rounded shadow card bg-dark" style="width: 214px; height: 600px">
                        <h5 class="pt-2 text-center card-title" style="color: #eee"><?= $movie->name ?> </h5>
                      <img src=<?= $movie->image ?> class="card-img-top" alt="...">
                      <div class="card-body">
                        <div class="gap-2 d-grid">
                        <div class="mb-4 form-outline">
                            <p class="pt-2 text-center" style="color: #eee">Hora: <?= $movie->schedule ?><br>
                                Sala: <?= $movie->room ?> <br>
                                <?php foreach ($tickets as $ticket): ?>
                              <?php if($ticket->clientName == $client->name && $ticket->movieName == $movie->name): ?>
                                Sillas: <?=$ticket->chair?><br>
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </p>
                            <form method="post" action="/delete-reservation">
                                    <input type="hidden" name="movie" value="<?= $movie->name ?>">
                                    <div class="pt-1 pb-1 mb-5 text-center">
                                    <button type="submit" class="custom-button btn btn-primary">Cancelar Todo</button>
                                    </div>
                                </form>
                                
                                

                              <div class="pt-1 pb-1 mb-5 text-center">
                              </div>
                          </form>
                        </div>
                      </div>
                      </div>
                    </div>
                  </div>
                  <?php endforeach; ?>
  <script
  src="https://code.jquery.com/jquery-3.5.1.js"
  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
  crossorigin="anonymous"
></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
    crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
    integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
    crossorigin="anonymous"></script>
<script
  src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
  crossorigin="anonymous"
></script>
<script src="js/main.js"></script>
</body>
</html>