<!DOCTYPE html>
<html>
<head>
    <title>Sala de Cine - Compra de Boletos</title>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/movieSeat.css'); ?>">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl"
          crossorigin="anonymous"
        />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
            integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<?php if ($error != null): ?>
    <div class="alert alert-primary" role="alert">
        Solo puede seleccionar 4 asientos para hacer la reserva
    </div>
<?php endif; ?>

<body style="background-color: #959595;">

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
                    <p class="pt-2 text-center card-title" style="color: #eee">RESERVA EN PROGRESO</p>
                </ul>
            </div>
        </div>
    </nav>

    <section class="h-100 gradient-form">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center">
                <div class="col-xl-10">
                    <div class="text-black card rounded-3">
                        <div class="row g-0">
                            <div class="col-lg-6 gradient-custom-2">
                                <div class="card-body">


                <?php if ($movie != null): ?>
                  <div class="text-center">
                    <div class="card-body">
                        <div class=" d-flex justify-content-center">
                            <div class="mb-1 rounded shadow card bg-dark" style="width: 214px; height: 425px">
                                <h5 class="pt-2 text-center card-title" style="color: #eee"><?= $movie->name ?></h5>
                                <img src="<?= $movie->image ?>" class="card-img-top" alt="..." style="width: 214px; height: 314.2px">
                                    <div class="gap-2 d-grid">
                                        <div class="mb-4 form-outline">
                                            <p class="pt-2 text-center" style="color: #eee">Hora: <?= $movie->schedule ?> <br> Sala: <?= $movie->room ?></p>
                                            <div class="mt-4 text-center">
                                                <form method="post" action="/movies/reservation/cancel">
                                                    <input type="hidden" name="movieName" value="<?= $movie->name ?>">
                                                    <button type="submit" class="custom-button color-3">Cancelar reserva</button>  
                                                </form>
                                            </div>
                                        </div>
                                  </div>
                            </div>
                        </div>
                    </div>
                  </div>
                  <?php endif; ?>
                </div>
              </div>
              <div class="col-lg-6 d-flex align-items-center">
                <div class="px-3 py-4 text-white p-md-5 mx-md-4">
                    <div class="container">
                        <div class="seating-plan-container">
                            <table class="seating-plan">
                            <button type="submit" class="btn btn-dark btn-block text-white">Pantalla</button>
                                <?php foreach (range('A', 'E') as $letter): ?>
                                    <tr>
                                    <?php foreach (range(1, 4) as $number): ?>
                                            <td>
                                                <?=
                                                    $chair = $letter . $number;
                                                    $occupied = false;
                                                ?>
                                                <?php if ($tickets && $movie): ?>
                                                    <?php foreach ($tickets as $ticket): ?>
                                                        <?php if ($ticket->chair == $chair && $ticket->movieName == $movie->name): ?>
                                                            <?php
                                                                $occupied = true;
                                                            ?>
                                                            <form action="/movies/reservation/save" method="POST">
                                                            <input type="hidden" name="chair" value="{{ $chair }}">
                                                            <button type="submit" class="custom-button color-2"><?= $chair ?></button>
                                                            </form><br>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                                <?php if (!$occupied): ?>
                                                    <form action="/movies/reservation/save" method="POST">
                                                        <?php echo csrf_field(); ?>
                                                        <?php if ($movie): ?>
                                                            <input type="hidden" name="movieName" value="<?= $movie->name ?>">
                                                        <?php endif; ?>
                                                        <input type="hidden" name="chair" value="<?= $chair ?>">
                                                        <button type="submit" class="custom-button color-1"><?= $chair ?></button>
                                                    </form><br>
                                                <?php endif; ?>
                                            </td>
                                        <?php endforeach; ?>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                            <div class="text-center">
                                <form method="post" action="/movies/show">
                                    <input type="hidden" name="movieName" value="<?= $movie->name ?>">
                                    <br><button type="submit" class="custom-button color-3">Realizar reserva</button>  
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
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
</body>
</html>
