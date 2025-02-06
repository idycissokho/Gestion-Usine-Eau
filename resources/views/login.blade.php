<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Se connecter</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/seodashlogo.png" />
  <link rel="stylesheet" href="{{ asset('css/styles.min.css') }}" />
</head>

@vite(['resources/js/app.js', 'resources/css/styles.min.css'])

<body>
  <!--  Body Wrapper -->

  {{-- @extends('base')
  @section('title') Se Connerter @endsection

  @section('content') --}}
  <ul>
    @if (session('error'))
        <div class="alert alert-warning">
            {{session('error')}}
        </div>
    @endif
</ul>

  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                  <img style="margin-left: 120px" src="logo.png" alt="" width="300" height="120">
                <p class="text-center">Veuillez vous-connecter</p>
                <form action="{{ route('traitementlogin') }}" method="post">
                    @csrf
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nom utilisateur</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    @error('email')
                        {{ $message }}
                    @enderror
                  </div>
                  <div class="mb-4">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                    @error('password')
                        {{ $message }}
                    @enderror
                  </div>
                  <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="form-check">
                      <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" checked>
                      <label class="form-check-label text-dark" for="flexCheckChecked">
                        Remeber this Device
                      </label>
                    </div>
                    <a class="text-primary fw-bold" href="./index.html">Mot de passe oublie ?</a>
                  </div>
                  <button type="submit"  class="btn btn-primary w-100 py-8 fs-4 mb-4">Se Connecter</button>
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">Nouveau dans SIRA?</p>
                    <a class="text-primary fw-bold ms-2" href="{{ route('register') }}">Creer un compte</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div aria-live="polite" aria-atomic="true" class="position-relative">
        <!-- Position it in the center -->
        <div id="toastContainer" class="toast-container position-fixed top-50 start-50 translate-middle" style="z-index: 1050;">
            <div id="customToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true" style="min-width: 300px;">
                <div class="d-flex">
                    <div class="toast-body" id="toastMessage">
                        <!-- Message affiché ici -->
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>

  </div>




</body>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const alertSuccess = document.querySelector('.alert-success');

        if (alertSuccess) {
            setTimeout(() => {
                alertSuccess.classList.add('show');
            }, 100);

            // Cacher le message après 5 secondes
            setTimeout(() => {
                alertSuccess.classList.remove('show');
            }, 3000);
        }
        const alertwarning = document.querySelector('.alert-warning');

        if (alertwarning) {
            setTimeout(() => {
                alertwarning.classList.add('show');
            }, 100);

            // Cacher le message après 5 secondes
            setTimeout(() => {
                alertwarning.classList.remove('show');
            }, 3000);
        }
    });
</script>



</html>
