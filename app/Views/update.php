<!DOCTYPE html>
<html>
<head>
    <title>Sala de Cine - Compra de Boletos</title>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/movieSeat.css'); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
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
<body>
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
<section class="h-100 gradient-form" style="background-color: #eee;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-10">
                <div class="text-black card rounded-3">
                    <div class="row g-0">
                        <div class="col-lg-6">
                            <div class="card-body p-md-5 mx-md-4">
                                <div class="text-center">
                                    <img src="https://user-images.githubusercontent.com/102967338/252713059-16826ea2-06a0-489b-93cd-15af3a764109.png" style="width: 185px;" alt="logo">
                                    <h4 class="pb-1 mt-1 mb-5">Actualizar información</h4>
                                </div>
      
                                <form method="POST" action="/update-info/complete" onsubmit="return validateForm()">
                                    <div class="mb-4 form-outline">
                                        <label for="name">Nombre:</label>
                                        <input type="text" id="name" name="name" class="form-control" value="<?= $user->name ?>" required autocomplete="off">
                                        <div class="invalid-feedback">Por favor, ingrese su nombre.</div>
                                    </div>
      
                                    <div class="mb-4 form-outline">
                                        <label for="username">Nombre de usuario:</label>
                                        <input type="text" id="username" name="username" class="form-control" value="<?= $user->username ?>" required autocomplete="off">
                                        <div class="invalid-feedback">Por favor, ingrese su usuario.</div>
                                    </div>
      
                                    <div class="mb-4 form-outline">
                                        <label for="birthdate">Fecha de nacimiento:</label>
                                        <input type="date" id="birthdate" name="birthdate" class="form-control" value="<?=  $user->birthdate ?>" required autocomplete="off">
                                        <div class="invalid-feedback">Por favor, ingrese su fecha de nacimiento.</div>
                                    </div>
      
                                    <div class="mb-4 form-outline">
                                        <label for="phone">Teléfono:</label>
                                        <input type="tel" id="phone" name="phone" class="form-control" value="<?=  $user->phone ?>" required autocomplete="off">
                                        <div class="invalid-feedback">Por favor, ingrese su número de teléfono.</div>
                                    </div>
      
                                    <div class="mb-4 form-outline">
                                        <label for="email">Email:</label>
                                        <input type="email" id="email" name="email" class="form-control" value="<?= $user->email ?>" required autocomplete="off">
                                        <div class="invalid-feedback">Por favor, ingrese un correo electrónico válido.</div>
                                    </div>
      
                                    <button type="submit" class="btn btn-primary">Actualizar</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                            <div class="px-3 py-4 text-white p-md-5 mx-md-4">
                                <img src="https://media1.giphy.com/media/iFn4KACWTYcx6CmVHl/source.gif" style="width: 450px;" alt="logo">  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    function validateForm() {
        var name = document.getElementById('name').value;
        var username = document.getElementById('username').value;
        var birthdate = document.getElementById('birthdate').value;
        var phone = document.getElementById('phone').value;
        var email = document.getElementById('email').value;
      
        // Validar campos vacíos
        if (name.trim() === '') {
            showInvalidFeedback('name', 'Por favor, ingrese su nombre.');
            return false;
        }
      
        if (username.trim() === '') {
            showInvalidFeedback('username', 'Por favor, ingrese su usuario.');
            return false;
        }
      
        if (birthdate.trim() === '') {
            showInvalidFeedback('birthdate', 'Por favor, ingrese su fecha de nacimiento.');
            return false;
        }
      
        if (phone.trim() === '') {
            showInvalidFeedback('phone', 'Por favor, ingrese su número de teléfono.');
            return false;
        }
      
        if (email.trim() === '') {
            showInvalidFeedback('email', 'Por favor, ingrese un correo electrónico válido.');
            return false;
        }
      
        return true;
    }
  
    function showInvalidFeedback(inputId, message) {
        var input = document.getElementById(inputId);
        input.classList.add('is-invalid');
        var feedback = input.nextElementSibling;
        feedback.innerText = message;
    }
</script>
<script src="<?= base_url('js/Validate.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
