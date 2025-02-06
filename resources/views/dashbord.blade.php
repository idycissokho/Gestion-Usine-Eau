<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Sira Application</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/seodashlogo.png" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

</head>
@vite(['resources/js/app.js', 'resources/css/styles.min.css'])

<body>

    <ul>
        @if (session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif
    </ul>
    <ul>
        @if (session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif
    </ul>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
       <!-- Sidebar Start dashbord -->
        <aside class="left-sidebar" >

            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                <a href="#" class="text-nowrap logo-img">
                    <img src="logo.png" alt="" width="200" height="150"/>
                </a>
                <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                    <i class="ti ti-x fs-8"></i>
                </div>
                </div>
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                <ul id="sidebarnav">
                    <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-6"></i>
                    <span class="hide-menu">Acceuil</span>
                    </li>
                    <li class="sidebar-item">
                    <a class="sidebar-link" id="tableaudebord" aria-expanded="false">
                        <span>
                        <iconify-icon icon="solar:home-smile-bold-duotone" class="fs-6"></iconify-icon>
                        </span>
                        <span class="hide-menu">Tableau de bord</span>
                    </a>
                    </li>
                    <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-6"></i>
                    <span class="hide-menu">Vos fonctionnalites</span>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" id="mon_stock" aria-expanded="false">
                            <span>
                            <iconify-icon icon="solar:layers-minimalistic-bold-duotone" class="fs-6"></iconify-icon>
                            </span>
                            <span class="hide-menu">MON STOCK</span>
                        </a>
                        </li>


                    <li class="sidebar-item">
                    <a class="sidebar-link" id="entrer" aria-expanded="false">
                        <span>
                        <iconify-icon icon="solar:layers-minimalistic-bold-duotone" class="fs-6"></iconify-icon>
                        </span>
                        <span class="hide-menu">MES PRODUITS</span>
                    </a>
                    </li>


                    <li class="sidebar-item">
                    <a class="sidebar-link" id="depense" aria-expanded="false">
                        <span>
                        <iconify-icon icon="solar:danger-circle-bold-duotone" class="fs-6"></iconify-icon>
                        </span>
                        <span class="hide-menu">DEPENSE</span>
                    </a>
                    </li>


                    <li class="sidebar-item">
                        <a class="sidebar-link" id="utilisateur" aria-expanded="false">
                            <span>
                            <iconify-icon icon="solar:danger-circle-bold-duotone" class="fs-6"></iconify-icon>
                            </span>
                            <span class="hide-menu">Utilisateur</span>
                        </a>
                        </li>







                </ul>
                @if (Auth::check())
                <div class="unlimited-access hide-menu bg-primary-subtle position-relative rounded-3" style="margin-bottom: 50%;">
                    <div class="d-flex" >
                    <div class="unlimited-access-title me-3">
                        <form action="{{ route('traitementlogout') }}" method="post">
                            @csrf
                            <button
                            type="submit" class="btn btn-primary fs-2 fw-semibold lh-sm">Deconnexion</button>
                        </form>
                    </div>
                    </div>
                </div>
                @endif
                </nav>
                <!-- End Sidebar navigation -->
            </div>
        <!-- End Sidebar scroll-->
        </aside>

         <!-- Modal -->
         <div class="modal fade" id="budgetModal" tabindex="-1" aria-labelledby="budgetModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-slide modal-dialog-end">
                <div class="modal-content">
                    @if(Auth::check() && Auth::user()->role == 1)
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="budgetModalLabel">Résumé du Budget</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Résumé des Dépenses et Gains -->
                        <h6 class="text-muted text-uppercase">Dépenses</h6>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="card border-light shadow-sm p-3 mb-3 bg-body rounded">
                                    <h6 class="text-primary">Matières Premières</h6>
                                    <p>Total : <span class="badge bg-warning text-dark" id="totalPrix_all_type_week">0</span> par semaine </p>
                                    <p>Total : <span class="badge bg-warning text-dark" id="totalPrix_all_type_month">0</span> par mois</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card border-light shadow-sm p-3 mb-3 bg-body rounded">
                                    <h6 class="text-primary">Autres Dépenses</h6>
                                    <p>Total : <span class="badge bg-warning text-dark" id="totalPrix_depense_type_week">0</span> par semaine</p>
                                    <p>Total : <span class="badge bg-warning text-dark" id="totalPrix_depense_type_month">0</span> par mois</p>
                                </div>
                            </div>
                        </div>

                        <h6 class="text-muted text-uppercase">Gains / Revenus</h6>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="card border-light shadow-sm p-3 mb-3 bg-body rounded">
                                    <h6 class="text-success">Gains Totaux</h6>
                                    <p>Total : <span class="badge bg-success" id="prix_produit_finish_week">0</span> par semaine</p>
                                    <p>Total : <span class="badge bg-success" id="prix_produit_finish_month">100,000 FCFA</span> par mois</p>
                                </div>
                            </div>
                        </div>

                        <h6 class="text-muted text-uppercase">Bénéfices</h6>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="card border-light shadow-sm p-3 bg-body rounded">
                                    <h6 class="text-info">Bénéfice Net</h6>
                                    <p>Bénéfice par semaine : <span class="badge bg-info" id="benefice_produit_week">5,000 FCFA</span></p>
                                    <p>Bénéfice par mois : <span class="badge bg-info" id="benefice_produit_month">20,000 FCFA</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                        <div class="m-4 d-flex justify-content-center">
                            Vous n'avais pas les autorisations necessaire
                        </div>
                    @endif
                </div>
            </div>
        </div>


        {{-- <!-- Modal depense  -->
        <div class="modal fade" id="" tabindex="-1" aria-labelledby="budgetModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-slide modal-dialog-end">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="budgetModalLabel">Mon budget</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h1>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="modal fade" id="budgetModaldepense" tabindex="-1" aria-labelledby="budgetModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-end">
                <div class="modal-content shadow-lg">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title fw-bold text-white" id="budgetModalLabel">Résumé des Dépenses</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body p-4">
                        <?php
                            $currentWeekOfYear = now()->week; // Numéro de la semaine dans l'année
                            $currentWeekOfMonth = $currentWeekOfYear % 4; // Calcule le numéro de la semaine dans le mois (1 à 4)

                            // Si le reste est 0, cela signifie que c'est la 4e semaine du mois précédent
                            if ($currentWeekOfMonth == 0) {
                                $currentWeekOfMonth = 4;
                            }
                        ?>
                        <div class="row text-center mb-4">
                            <h3 class="text-success">Dépenses Par Catégorie Semaine Actuelle : {{ $currentWeekOfMonth }}</h3>
                        </div>

                        <div class="row text-center mb-4">
                            <!-- Dépense Preforme -->
                            <div class="col-md-3 mb-3">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <i class="bi bi-bar-chart-line text-success fs-1"></i>
                                        <h5 class="card-title mt-3 text-success">Preforme</h5>
                                        <p class="card-text text-muted">Montant: <strong id="totalPrix_preforme_week">0 FCFA</strong></p>
                                    </div>
                                </div>
                            </div>

                            <!-- Dépense Firm -->
                            <div class="col-md-3 mb-3">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <i class="bi bi-pie-chart-fill text-success fs-1"></i>
                                        <h5 class="card-title mt-3 text-success">Firm</h5>
                                        <p class="card-text text-muted text-success" >Montant: <strong id="totalPrix_firm_week">0 FCFA</strong></p>
                                    </div>
                                </div>
                            </div>

                            <!-- Dépense Etiquette -->
                            <div class="col-md-3 mb-3">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <i class="bi bi-diagram-3-fill text-success fs-1"></i>
                                        <h5 class="card-title mt-3 text-success">Etiquette</h5>
                                        <p class="card-text text-muted text-success">Montant: <strong id="totalPrix_etiquette_week">0 FCFA</strong></p>
                                    </div>
                                </div>
                            </div>

                            <!-- Dépense Bouchon -->
                            <div class="col-md-3 mb-3">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <i class="bi bi-circle-fill text-warning fs-1"></i>
                                        <h5 class="card-title mt-3 text-success">Bouchon</h5>
                                        <p class="card-text text-muted text-success">Montant: <strong id="totalPrix_bouchon_week">0 FCFA</strong></p>
                                    </div>
                                </div>
                            </div>


                            <div class="d-flex justify-content-center">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <i class="bi bi-circle-fill text-warning fs-1"></i>
                                        <h5 class="card-title mt-3 text-success">Autre Depense</h5>
                                        <p class="card-text text-muted text-success">Montant: <strong id="all_prix_depense_week_resume">0 FCFA</strong></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row text-center mt-4">
                            <h4 class="text-success">Dépense Totale: <strong id="for_week">0 FCFA</strong></h4>
                        </div>
                    </div>



                    <div class="modal-body p-4">
                        <div class="row text-center mb-4">
                            <h3 class="text-success">Dépenses Par Catégorie mois : {{ now()->monthName }}</h3>
                        </div>

                        <div class="row text-center mb-4">
                            <!-- Dépense Preforme -->
                            <div class="col-md-3 mb-3">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <i class="bi bi-bar-chart-line text-success fs-1"></i>
                                        <h5 class="card-title mt-3 text-success">Preforme</h5>
                                        <p class="card-text text-muted">Montant: <strong id="preforme_for_month">0 FCFA</strong></p>
                                    </div>
                                </div>
                            </div>

                            <!-- Dépense Firm -->
                            <div class="col-md-3 mb-3">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <i class="bi bi-pie-chart-fill text-success fs-1"></i>
                                        <h5 class="card-title mt-3 text-success">Firm</h5>
                                        <p class="card-text text-muted text-success" >Montant: <strong id="firm_for_month">0 FCFA</strong></p>
                                    </div>
                                </div>
                            </div>

                            <!-- Dépense Etiquette -->
                            <div class="col-md-3 mb-3">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <i class="bi bi-diagram-3-fill text-success fs-1"></i>
                                        <h5 class="card-title mt-3 text-success">Etiquette</h5>
                                        <p class="card-text text-muted text-success">Montant: <strong id="etiquette_for_month">0 FCFA</strong></p>
                                    </div>
                                </div>
                            </div>

                            <!-- Dépense Bouchon -->
                            <div class="col-md-3 mb-3">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <i class="bi bi-circle-fill text-warning fs-1"></i>
                                        <h5 class="card-title mt-3 text-success">Bouchon</h5>
                                        <p class="card-text text-muted text-success">Montant: <strong id="bouchon_for_month">0 FCFA</strong></p>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <i class="bi bi-circle-fill text-warning fs-1"></i>
                                        <h5 class="card-title mt-3 text-success">Autre Depense</h5>
                                        <p class="card-text text-muted text-success">Montant: <strong id="all_prix_depense_month_resume">0 FCFA</strong></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row text-center mt-4">
                            <h4 class="text-success">Dépense Totale: <strong id="for_month">0 FCFA</strong></h4>
                        </div>
                    </div>



                    {{-- <div class="modal-body p-4">
                        <div class="row text-center mb-4">
                            <h3 class="text-success">Autre Dépenses </h3>
                        </div>

                        <div class="row text-center mb-4">
                            <!-- Dépense Preforme -->
                            <div class="col-md-3 mb-3">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <i class="bi bi-bar-chart-line text-success fs-1"></i>
                                        <h5 class="card-title mt-3 text-success">Preforme</h5>
                                        <p class="card-text text-muted">Montant: <strong id="">0 FCFA</strong></p>
                                    </div>
                                </div>
                            </div>

                            <!-- Dépense Firm -->
                            <div class="col-md-3 mb-3">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <i class="bi bi-pie-chart-fill text-success fs-1"></i>
                                        <h5 class="card-title mt-3 text-success">Firm</h5>
                                        <p class="card-text text-muted text-success" >Montant: <strong id="">0 FCFA</strong></p>
                                    </div>
                                </div>
                            </div>

                            <!-- Dépense Etiquette -->
                            <div class="col-md-3 mb-3">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <i class="bi bi-diagram-3-fill text-success fs-1"></i>
                                        <h5 class="card-title mt-3 text-success">Etiquette</h5>
                                        <p class="card-text text-muted text-success">Montant: <strong id="">0 FCFA</strong></p>
                                    </div>
                                </div>
                            </div>

                            <!-- Dépense Bouchon -->
                            <div class="col-md-3 mb-3">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <i class="bi bi-circle-fill text-warning fs-1"></i>
                                        <h5 class="card-title mt-3 text-success">Bouchon</h5>
                                        <p class="card-text text-muted text-success">Montant: <strong id="">0 FCFA</strong></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row text-center mt-4">
                            <h4 class="text-success">Dépense Totale: <strong id="">0 FCFA</strong></h4>
                        </div>
                    </div> --}}



                </div>
            </div>
        </div>


    <!--  Sidebar End -->
    <!--  Main wrapper -->


    <div class="body-wrapper">
        <!--  navbar -->
      <header class="app-header bg-white">
          <nav class="navbar navbar-expand-lg navbar-light">
              @auth
              <div class="user-icon d-flex align-items-center p-3">
                  <i class="fas fa-user-circle fa-3x me-2 text-success"></i>
                  <h3 class="username text-success">{{ Auth::user()->name }}</h3> <!-- Optionnel : Nom de l'utilisateur -->
              </div>
              @endauth

            <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
              <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">

                <a id="budjet" data-bs-toggle="modal" data-bs-target="#budgetModal"
                  class="btn btn-success m-1"><span class="d-none d-md-block">Mon budjet</span>

                  <a  data-bs-toggle="modal" data-bs-target="#budgetModaldepense"
                  class="btn btn-warning m-1"><span class="d-none d-md-block">Resume Depense</span></a>
              </ul>
            </div>
          </nav>

      </header>


      <!--  Portion depense-->
      <div class="d-none container-fluid bg-white" id="indisponible">
        <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-outline-success m-1" id="afficher_formu_depense">Ajouter une nouvelle depense</button>
        </div>

        <div class="d-none card" id="formulaire_depense">
            <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Formulaire pour ajouter une nouvelle depense</h5>
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-outline-success m-1" id="ferme_afficher_formu_depense">Ferme</button>
            </div>
            <div class="card">
                <div class="card-body">
                <form action="{{ route('save_depense') }}" method="post" id="form">
                    @csrf
                    <div class="mb-3">
                    <label for="nombre_produit" class="form-label">Donner le prix du depense effectuer Aujourd'hui</label>
                    <input type="number" name="prix" class="form-control" id="prix" aria-describedby="emailHelp">
                    <div id="depense_value"  class="form-text">Saisir la valeur</div>
                    <div class="mb-3">
                        <label for="" class="form-label">Donner le type</label>
                        <select class="form-select form-select-lg"name="typedepense"id="typedepense">
                            @foreach ($all_type_depense as $depense)
                                <option value="{{$depense->id}}">{{$depense->nom}}</option>
                            @endforeach
                        </select>
                    </div>

                    </div>
                    <button type="submit" class="btn btn-primary" id="saveprouit">Enregistrer</button>
                    <button type="reset" class="btn btn-danger">Annuler</button>
                </form>
                </div>
            </div>
            </div>
        </div>

        <div class="card" id="table_all_depense_today">
            <div class="card-body">
            <h5 class="card-title text-success">Tableau de tous les depenses effectuer {{ now()->dayName }}</h5>
            <div class="table-responsive">
                <table class="table text-nowrap align-middle mb-0">
                <thead>
                    <tr class="border-2 border-bottom border-primary border-0">
                        <th scope="col" class="text-center">type</th>
                        <th scope="col" class="ps-0">prix</th>
                        <th scope="col" class="ps-0">Jour</th>
                        <th scope="col" class="ps-0">semaine</th>
                        <th scope="col" class="ps-0">Mois</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider" id="tableau_stock_finish">
                    @foreach ($depenses_day as $depense)
                    <tr>
                        <td class=" fw-medium">{{ $depense->typedepense ? $depense->typedepense->nom : "Inconnu" }}</td>
                        <td class=" fw-medium">{{ $depense->prix }}</td>
                        <td class=" fw-medium">{{ $depense->created_at->translatedFormat('d') }} {{$depense->created_at->translatedFormat('l') }}</td>
                        <td class=" fw-medium">{{ $depense->week_period }}</td>
                        <td class=" fw-medium">{{ $depense->created_at->translatedFormat('F') }}</td>
                        {{-- <td class=" fw-medium">
                            <button type="button" class="btn btn-outline-success m-1 modifier_stock" id=""
                            data-id="{{ $produit->id }}"  data-type-id="{{$produit->type_id}}" data-nombre="{{$produit->nombre}}"
                            >
                                mise a jour
                            </button>
                        </td> --}}

                    </tr>
                    <tr>
                    @endforeach

                </tbody>
                </table>

            </div>
            </div>
        </div>


        <div class="m-4 col-lg-12">
            <?php
                    $currentWeekOfYear = now()->week; // Numéro de la semaine dans l'année
                    $currentWeekOfMonth = $currentWeekOfYear % 4; // Calcule le numéro de la semaine dans le mois (1 à 4)

                    // Si le reste est 0, cela signifie que c'est la 4e semaine du mois précédent
                    if ($currentWeekOfMonth == 0) {
                        $currentWeekOfMonth = 4;
                    }
            ?>
            <div class="card shadow-lg border-0">
                <div class="card-body p-5">
                    <h2 class="text-center text-muted fw-bold mb-5 animate-title">
                        Détails des depenses effectuer
                    </h2>

                    <div class="row text-center g-4">
                        <div class="col-4">
                            <div class="p-4 border rounded shadow-sm bg-success animate-box">
                                <iconify-icon icon="solar:laptop-minimalistic-line-duotone" class="fs-2 text-primary"></iconify-icon>
                                <h4 class="fw-bold mt-3 text-white">Aujourd'hui <span>{{ now()->dayName }}</span> </h4>
                                <span class="fs-4 fw-semibold text-white" id="all_prix_depense_today">0</span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-4 border rounded shadow-sm bg-warning animate-box">
                                <iconify-icon icon="solar:smartphone-line-duotone" class="fs-2 text-secondary"></iconify-icon>
                                <h4 class="fw-bold mt-3 text-white">Semaine : {{ $currentWeekOfMonth }}</h4>
                                <span class="fs-4 fw-semibold text-white" id="all_prix_depense_week">0</span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-4 border rounded shadow-sm bg-dark animate-box">
                                <iconify-icon icon="solar:tablet-line-duotone" class="fs-2 text-success"></iconify-icon>
                                <h4 class="fw-bold mt-3 text-white">Mois : {{ now()->monthName }}</h4>
                                <span class="fs-4 fw-semibold text-white" id="all_prix_depense_month">0</span>
                            </div>
                        </div>
                    </div>

                    {{-- <h2 class="text-center text-muted fw-bold mt-5 mb-5 animate-title">
                        Détails des prix des produits finis obtenus
                    </h2>

                    <div class="row text-center g-4">
                        <div class="col-4">
                            <div class="p-4 border rounded shadow-sm bg-info animate-box">
                                <iconify-icon icon="solar:laptop-minimalistic-line-duotone" class="fs-2 text-primary"></iconify-icon>
                                <h4 class="fw-bold mt-3 text-white">Aujourd'hui </h4>
                                <span class="fs-4 fw-semibold text-white" id="">0</span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-4 border rounded shadow-sm bg-secondary animate-box">
                                <iconify-icon icon="solar:smartphone-line-duotone" class="fs-2 text-secondary"></iconify-icon>
                                <h4 class="fw-bold mt-3 text-white">Semaine : {{ $currentWeekOfMonth }}</h4>
                                <span class="fs-4 fw-semibold text-white" id="">0</span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-4 border rounded shadow-sm bg-danger animate-box">
                                <iconify-icon icon="solar:tablet-line-duotone" class="fs-2 text-success"></iconify-icon>
                                <h4 class="fw-bold mt-3 text-white">Mois : {{ now()->monthName }}</h4>
                                <span class="fs-4 fw-semibold text-white" id="">0</span>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>


            <div class="card-body p-4">
                <button type="button" class="btn btn-outline-primary m-1" id="view_tab_depense">Voir tous les Depenses</button>

              </div>
        </div>


        <div class="d-none card" id="table_all_depense">
            <div class="card-body">
            <h5 class="card-title text-success">Tableau de tous les depenses effectuer {{ now()->dayName }}</h5>
            <div class="table-responsive">
                <table class="table text-nowrap align-middle mb-0">
                <thead>
                    <tr class="border-2 border-bottom border-primary border-0">
                        <th scope="col" class="text-center">type</th>
                        <th scope="col" class="ps-0">prix</th>
                        <th scope="col" class="ps-0">jour</th>
                        <th scope="col" class="ps-0">semaine</th>
                        <th scope="col" class="ps-0">Mois</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider" id="tableau_stock_finish">
                    @foreach ($depenses as $depense)
                    <tr>
                        <td class=" fw-medium">{{ $depense->typedepense ? $depense->typedepense->nom : "Inconnu" }}</td>
                        <td class=" fw-medium">{{ $depense->prix }}</td>
                        <td class=" fw-medium">{{ $depense->created_at->translatedFormat('d') }} {{$depense->created_at->translatedFormat('l') }}</td>
                        <td class=" fw-medium">{{ $depense->week_period }}</td>
                        <td class=" fw-medium">{{ $depense->created_at->translatedFormat('F') }}</td>

                        {{-- <td class=" fw-medium">
                            <button type="button" class="btn btn-outline-success m-1 modifier_stock" id=""
                            data-id="{{ $produit->id }}"  data-type-id="{{$produit->type_id}}" data-nombre="{{$produit->nombre}}"
                            >
                                mise a jour
                            </button>
                        </td> --}}

                    </tr>
                    <tr>
                    @endforeach

                </tbody>
                </table>

            </div>
            </div>
        </div>



      </div>




      <div class="d-none container-fluid bg-white" id="view_user">
        <div class="container">
            <h1>Liste des Utilisateurs</h1>
            @if(Auth::check() && Auth::user()->role == 1)

            <table class="table table-striped table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Statut</th>
                        <th>Suppression</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($utilisateur as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            @if ($user->role == 2)
                                <form action="{{ route('activer') }}" method="post">
                                    @csrf
                                    <input hidden name="id" type="text" value="{{$user->id}}">
                                        <button class="btn btn-success" id="" >
                                            Activer
                                        </button>
                                </form>
                            @else
                                <form action="{{ route('desactiver') }}" method="post">
                                    @csrf
                                    <input hidden name="id" type="text" value="{{$user->id}}">
                                        <button class="btn btn-danger" id="" >
                                            Desactiver
                                        </button>
                                </form>
                            @endif

                        <td>
                            <form action="{{ route('delete_user') }}" method="post">
                                @csrf
                                <input hidden name="id" type="text" value="{{$user->id}}">
                                <button class="btn btn-success" id="statu" >supprimer</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach


                </tbody>
            </table>

            @else
                <div class="m-4 d-flex justify-content-center">
                    Vous n'avez pas les autorisation neccessaire
                </div>
            @endif
        </div>
      </div>


              <!--  Portion stock-->
      <div class="d-none container-fluid bg-white" id="magasin">
            <div class="d-flex mb-2 justify-content-center">
                <button class="btn btn-success" id="prix_unitaire">Voir le tableau des prix unitaire</button>
            </div>

            <div class="d-none card" id="table_type">
                <div class="card-body">
                <h5 class="card-title text-info">Tableau des prix unitaire de tous les produits</h5>
                <div class="d-flex mb-2 justify-content-end">
                    <button class="btn btn-info" id="ferme_type">Fermer</button>
                </div>
                <div class="table-responsive  bg-info">
                    <table class="table text-nowrap align-middle mb-0">
                    <thead>
                        <tr class="border-2 border-bottom border-primary border-0">
                            <th scope="col" class="text-center">type</th>
                            <th scope="col" class="ps-0">Dernier mis a jour</th>
                            <th scope="col" class="text-center">prix unitaire</th>
                            <th scope="col" class="text-center">Modifier</th>

                        </tr>
                    </thead>
                    <tbody class="table-group-divider" id="tableau_stock">
                        @foreach ($types as $type)
                        <tr>
                            <td class=" fw-medium">{{ $type->type ? $type->type : "Inconnu" }}</td>
                            <td class=" fw-medium">{{ $type->created_at->translatedFormat('l') }}</td>
                            <td class="text-center fw-medium">{{ $type->prix_unitaire }}</td>
                            <td class=" fw-medium">
                                <button type="button" class="btn btn-outline-info m-1 modifier_type"
                                data-id="{{ $type->id }}" data-prix_uni="{{ $type->prix_unitaire }}" data-type="{{ $type->type }}">
                                    mise a jour
                                </button>
                            </td>

                        </tr>
                        <tr>
                        @endforeach

                    </tbody>
                    </table>
                </div>
                </div>
            </div>


            <div class="card" id="table_all_stock">
              <div class="card-body">
              <h5 class="card-title text-success">Tableau des produits en stocks actuel : {{ now()->day }} {{ now()->dayName }}</h5>
              <div class="table-responsive">
                  <table class="table text-nowrap align-middle mb-0">
                  <thead>
                      <tr class="border-2 border-bottom border-primary border-0">
                          <th scope="col" class="text-center">type</th>
                          <th scope="col" class="ps-0">Jour</th>
                          <th scope="col" class="ps-0">Semaine</th>
                          <th scope="col" class="ps-0">Mois</th>
                          <th scope="col" class="text-center">nombre en stock</th>
                          <th scope="col" class="text-center">Modifier</th>

                      </tr>
                  </thead>
                  <tbody class="table-group-divider" id="tableau_stock">
                      @foreach ($stocks as $produit)
                      <tr>
                          <td class=" fw-medium">{{ $produit->type ? $produit->type->type : "Inconnu" }}</td>
                          <td class=" fw-medium">{{ $produit->created_at->translatedFormat('d') }}{{ $produit->created_at->translatedFormat('l') }}</td>
                          <td class=" fw-medium">{{ $produit->week_period }}</td>
                          <td class=" fw-medium">{{ $produit->created_at->translatedFormat('F') }}</td>
                          <td class="text-center fw-medium">{{ $produit->nombre }}</td>
                          <td class=" fw-medium">
                              <button type="button" class="btn btn-outline-success m-1 modifier_stock" id=""
                              data-id="{{ $produit->id }}"  data-type-id="{{$produit->type_id}}" data-nombre="{{$produit->nombre}}"
                              >
                                  mise a jour
                              </button>
                          </td>

                      </tr>
                      <tr>
                      @endforeach

                  </tbody>
                  </table>
                  <div class="d-flex mt-2">
                    <button class="btn btn-outline-success" id="view_all_stock_finish">Voir de tous les derniers stocks</button>
                </div>
              </div>
              </div>
            </div>



            <div class="d-none card" id="table_all_stock_last">
                <div class="card-body">
                <h5 class="card-title text-success">Tableau de tous les derniers stocks</h5>
                <div class="table-responsive">
                    <table class="table text-nowrap align-middle mb-0">
                    <thead>
                        <tr class="border-2 border-bottom border-primary border-0">
                            <th scope="col" class="text-center">type</th>
                            <th scope="col" class="ps-0">Jour</th>
                            <th scope="col" class="ps-0">Semaine</th>
                            <th scope="col" class="ps-0">Mois</th>
                            <th scope="col" class="text-center">nombre en stock</th>

                        </tr>
                    </thead>
                    <tbody class="table-group-divider" id="tableau_stock_finish">
                        @foreach ($all_stock_finish as $produit)
                        <tr>
                            <td class=" fw-medium">{{ $produit->type ? $produit->type->type : "Inconnu" }}</td>
                            <td class=" fw-medium">{{ $produit->created_at->translatedFormat('d') }} {{ $produit->created_at->translatedFormat('l') }}</td>
                            <td class=" fw-medium">{{ $produit->week_period }}</td>
                            <td class=" fw-medium">{{ $produit->created_at->translatedFormat('F') }}</td>
                            <td class="text-center fw-medium">{{ $produit->nombre }}</td>
                            {{-- <td class=" fw-medium">
                                <button type="button" class="btn btn-outline-success m-1 modifier_stock" id=""
                                data-id="{{ $produit->id }}"  data-type-id="{{$produit->type_id}}" data-nombre="{{$produit->nombre}}"
                                >
                                    mise a jour
                                </button>
                            </td> --}}

                        </tr>
                        <tr>
                        @endforeach

                    </tbody>
                    </table>

                </div>
                </div>
            </div>



            <div class="d-none card" id="formulaire_stock">
                <div class="card-body">
                  <h5 class="card-title fw-semibold mb-4">Effectuer un mise a jour du stock</h5>
                  <button class="btn btn-warning" id="ferme">Ferme</button>
                  <div class="card">
                    <div class="card-body">
                      <form action="{{ route('update_stock') }}" method="post" id="form_stock">
                          @csrf
                          <input type="hidden" name="product_id" id="product_id">
                        <div class="mb-3">
                          <label for="nombre" class="form-label">Donner le nombre de produit</label>
                          <input type="number" name="nombre" class="form-control" id="nombre" aria-describedby="emailHelp">
                          <div id="nombe"  class="form-text">Saisir la valeur</div>
                        </div>
                        <div class="mb-3">
                          <label for="type" class="form-label">Le nombre de stock</label>
                          <select id="type" name="type" class="form-select">
                              @foreach ($types as $type)
                              <option value="{{ $type->id }}">{{$type->type}}</option>
                              @endforeach
                          </select>
                        </div>
                        <button type="submit" class="btn btn-primary" id="saveprouit">Modifier</button>
                        <button type="reset" class="btn btn-danger">Annuler</button>
                      </form>
                    </div>
                  </div>
                </div>
            </div>



            <div class="d-none card" id="formulaire_type">
                <div class="card-body">
                  <h5 class="card-title fw-semibold mb-4">Effectuer un mise a jour du prix unitaire</h5>
                  <button class="btn btn-warning" id="ferme_unitaire">Ferme</button>
                  <div class="card">
                    <div class="card-body">
                      <form action="{{ route('update_type_prix') }}" method="post" id="form_type">
                          @csrf
                          <input type="hidden" name="id" id="id">
                        <div class="mb-3">
                          <label for="nombre" class="form-label">Donner le prix unitaire</label>
                          <input type="number" name="prix_uni" class="form-control" id="prix_uni" aria-describedby="emailHelp">
                          <div id="nombe"  class="form-text">Saisir la valeur</div>
                        </div>
                        <div class="mb-3">
                          <label for="type" class="form-label">Le nombre de stock</label>
                          <select id="type_type" name="type" class="form-select">
                              @foreach ($types as $type)
                              <option value="{{ $type->id }}">{{$type->type}}</option>
                              @endforeach
                          </select>
                        </div>
                        <button type="submit" class="btn btn-primary" id="savetype">Modifier</button>
                        <button type="reset" class="btn btn-danger">Annuler</button>
                      </form>
                    </div>
                  </div>
                </div>
            </div>





      </div>


       <!--  Entrer des produit-->
       <div class="d-flex container-fluid bg-white" id="acceuil">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-4">
                  <h5 class="card-title fw-semibold mb-4">Gerer les stocks</h5>
                  <div class="card">
                    {{-- <img src="../assets/images/products/s4.jpg" class="card-img-top" alt="..."> --}}
                    <div class="card-body">
                      <h5 class="card-title">Stocks</h5>
                      <p class="card-text">Ici, vous pouvez gerer vos stocks, a savoir les entrer et la visualisations des stocks
                        the
                        card's content.</p>
                      <a id="go_produit" class="btn btn-primary">Aller maintenant</a>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <h5 class="card-title fw-semibold mb-4">Gerer les produits</h5>
                  <div class="card">
                    {{-- <img src="../assets/images/products/s4.jpg" class="card-img-top" alt="..."> --}}
                    <div class="card-body">
                      <h5 class="card-title">Produits</h5>
                      <p class="card-text">Ici , vous pouvez consulter et voir es details ur tous vos produits effectuer en fonction des secteurs.
                        </p>
                      <a id="go_produit_stock" class="btn btn-primary">Aller maintenant</a>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <h5 class="card-title fw-semibold mb-4">Gerer les depenses</h5>
                  <div class="card">
                    {{-- <img src="../assets/images/products/s4.jpg" class="card-img-top" alt="..."> --}}
                    <div class="card-body">
                      <h5 class="card-title">Depenses</h5>
                      <p class="card-text">les paiement peuvent etre nombreux , avec cette fonctionnalite gerer vos paiement en securite.
                        </p>
                      <a id="go_paiment" class="btn btn-primary">Aller maintenant</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          {{-- <div class="py-6 px-6 text-center">
            <p class="mb-0 fs-4">Design and Developed by <a href="https://adminmart.com/" target="_blank"
                class="pe-1 text-primary text-decoration-underline">AdminMart.com</a> Distributed by <a href="https://themewagon.com/" target="_blank"
                class="pe-1 text-primary text-decoration-underline">ThemeWagon</a></p>
          </div> --}}
        </div>










        <!--  Partie des produits -->
       <div class="d-none container-fluid bg-white" id="entrer_produit">
            <div class="d-flex justify-content-center">
                <button type="button" class="btn btn-outline-success m-1" id="afficher_formu_prod">Ajouter une nouvelle production</button>
            </div>


            <div class="d-none card" id="formulaire_finish">
                <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Formulaire pour la production</h5>
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-outline-info m-1" id="ferme_afficher_formu_prod">Ferme</button>
                </div>
                <div class="card">
                    <div class="card-body">
                    <form action="{{ route('check_produit') }}" method="post" id="form">
                        @csrf
                        <div class="mb-3">
                        <label for="nombre_produit" class="form-label">Donner le nombre de produit</label>
                        <input type="number" name="nombre_produit" class="form-control" id="nombre_produit" aria-describedby="emailHelp">
                        <div id="nombe"  class="form-text">Saisir la valeur</div>
                        </div>
                        <button type="submit" class="btn btn-primary" id="saveprouit">Enregistrer</button>
                        <button type="reset" class="btn btn-danger">Annuler</button>
                    </form>
                    </div>
                </div>
                </div>
            </div>



            <div class="col" id="tab_produit_finish">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h5 class="card-title text-success" style="margin-top: 2%">Visualiser le tableau des produits finis : {{ now()->dayName }} le {{ now()->day }} {{ now()->monthName  }}</h5>
                            <div class="card" id="table_produit_fini">
                                <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table text-nowrap align-middle mb-0">
                                    <thead>
                                        <tr class="border-2 border-bottom border-success border-0">
                                        <th scope="col" class="ps-0">Jour</th>
                                        <th scope="col" class="ps-0">Semaine</th>
                                        <th scope="col" class="ps-0">Mois</th>
                                        <th scope="col" class="text-center">Nombre paquets</th>
                                        <th scope="col" class="text-center">Prix(CFA)</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider" id="tableau_day">
                                        @foreach ($produit_finish as $produit)
                                        <tr>
                                            <td class="text-center fw-medium">{{ $produit->created_at->translatedFormat('l') }}</td>
                                            <td class="text-center fw-medium">{{ $produit->week_period }}</td>
                                            <td class="text-center fw-medium">{{ $produit->created_at->translatedFormat('F') }}</td>
                                            <td class="text-center fw-medium">{{ $produit->nombre }}</td>
                                            <td class="text-center fw-medium">{{ $produit->prix }}</td>
                                        </tr>
                                        <tr>
                                        @endforeach

                                    </tbody>
                                    </table>
                                </div>
                                </div>
                            </div>

                        </div>
                    </div>
            </div>



            <div class="col-lg-12">
                <?php
                        $currentWeekOfYear = now()->week; // Numéro de la semaine dans l'année
                        $currentWeekOfMonth = $currentWeekOfYear % 4; // Calcule le numéro de la semaine dans le mois (1 à 4)

                        // Si le reste est 0, cela signifie que c'est la 4e semaine du mois précédent
                        if ($currentWeekOfMonth == 0) {
                            $currentWeekOfMonth = 4;
                        }
                ?>
                <div class="card shadow-lg border-0">
                    <div class="card-body p-5">
                        <h2 class="text-center text-muted fw-bold mb-5 animate-title">
                            Détails des produits finis obtenus
                        </h2>

                        <div class="row text-center g-4">
                            <div class="col-4">
                                <div class="p-4 border rounded shadow-sm bg-success animate-box">
                                    <iconify-icon icon="solar:laptop-minimalistic-line-duotone" class="fs-2 text-primary"></iconify-icon>
                                    <h4 class="fw-bold mt-3 text-white">Aujourd'hui </h4>
                                    <span class="fs-4 fw-semibold text-white" id="totalByDay">0</span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="p-4 border rounded shadow-sm bg-warning animate-box">
                                    <iconify-icon icon="solar:smartphone-line-duotone" class="fs-2 text-secondary"></iconify-icon>
                                    <h4 class="fw-bold mt-3 text-white">Semaine : {{ $currentWeekOfMonth }}</h4>
                                    <span class="fs-4 fw-semibold text-white" id="totalByWeek">0</span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="p-4 border rounded shadow-sm bg-dark animate-box">
                                    <iconify-icon icon="solar:tablet-line-duotone" class="fs-2 text-success"></iconify-icon>
                                    <h4 class="fw-bold mt-3 text-white">Mois : {{ now()->monthName }}</h4>
                                    <span class="fs-4 fw-semibold text-white" id="totalByMonth">0</span>
                                </div>
                            </div>
                        </div>

                        <h2 class="text-center text-muted fw-bold mt-5 mb-5 animate-title">
                            Détails des prix des produits finis obtenus
                        </h2>

                        <div class="row text-center g-4">
                            <div class="col-4">
                                <div class="p-4 border rounded shadow-sm bg-info animate-box">
                                    <iconify-icon icon="solar:laptop-minimalistic-line-duotone" class="fs-2 text-primary"></iconify-icon>
                                    <h4 class="fw-bold mt-3 text-white">Aujourd'hui </h4>
                                    <span class="fs-4 fw-semibold text-white" id="totalByDayprix">0</span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="p-4 border rounded shadow-sm bg-secondary animate-box">
                                    <iconify-icon icon="solar:smartphone-line-duotone" class="fs-2 text-secondary"></iconify-icon>
                                    <h4 class="fw-bold mt-3 text-white">Semaine : {{ $currentWeekOfMonth }}</h4>
                                    <span class="fs-4 fw-semibold text-white" id="totalByWeekprix">0</span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="p-4 border rounded shadow-sm bg-danger animate-box">
                                    <iconify-icon icon="solar:tablet-line-duotone" class="fs-2 text-success"></iconify-icon>
                                    <h4 class="fw-bold mt-3 text-white">Mois : {{ now()->monthName }}</h4>
                                    <span class="fs-4 fw-semibold text-white" id="totalByMonthprix">0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>







            <div class="col" id="tab_produit_fourni">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                <h5 class="card-title text-success">Visualiser le tableau des produit premiere : {{ now()->dayName }} le {{ now()->day }} {{ now()->monthName  }}</h5>
                                <div class="card" id="table_day">
                                    <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table text-nowrap text-success align-middle mb-0">
                                        <thead>
                                            <tr class="border-2 border-bottom border-success border-0">
                                            <th scope="col" class="text-center">type</th>
                                            <th scope="col" class="ps-0">Jour</th>
                                            <th scope="col" class="ps-0">Semaine</th>
                                            <th scope="col" class="ps-0">Mois</th>
                                            <th scope="col" class="text-center">nombre utiliser</th>
                                            <th scope="col" class="text-center">prix unitaire</th>
                                            <th scope="col" class="text-center">Gain depenser</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-group-divider" id="tableau_day">
                                            @foreach ($produit_day_limite as $produit)
                                            <tr>
                                                <td class="text-center fw-medium">{{ $produit->type ? $produit->type->type : "Inconnu" }}</td>
                                                <td class="text-center fw-medium">{{ $produit->created_at->translatedFormat('l') }}</td>
                                                <td class="text-center fw-medium">{{ $produit->week_period }}</td>
                                                <td class="text-center fw-medium">{{ $produit->created_at->translatedFormat('F') }}</td>
                                                <td class="text-center fw-medium">{{ $produit->nbr_perdu }}</td>
                                                <td class="text-center fw-medium">{{ $produit->type ? $produit->type->prix_unitaire : "Inconnu" }}</td>
                                                <td class="text-center fw-medium">{{ $produit->nbr_gagner }}</td>
                                            </tr>
                                            <tr>
                                            @endforeach

                                        </tbody>
                                        </table>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>


                        {{-- <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <img src="../assets/images/backgrounds/product-tip.png" alt="image" class="img-fluid" width="205">
                                    <h4 class="mt-7">Productivity Tips!</h4>
                                    <p class="card-subtitle mt-2 mb-3">Duis at orci justo nulla in libero id leo
                                        molestie sodales phasellus justo.
                                    </p>
                                    <button class="btn btn-primary mb-3">View All Tips</button>
                                </div>
                            </div>
                        </div> --}}



                    </div>
            </div>




            <div class="col-lg-12">
                <h2 class="m-2 text-muted text-center">Details du jour {{ now()->dayName }} {{ now()->day }} {{ now()->monthName }}
                </h2>
                <h3 class="text-muted" style="margin-left: 3%; margin-top: 10px;">Nombre de produits depenser :</h3>
                <div class="card" >
                    <div class="card-body">

                    {{-- <div class="row" style="margin-left: 5%">
                        <div class="col-3">
                        <iconify-icon icon="solar:laptop-minimalistic-line-duotone" class="fs-7 d-flex text-primary"></iconify-icon>
                        <span class="fs-11 mt-2 d-block text-nowrap fw-bold h3">Preforme</span>
                        <h4 class="mb-0 mt-1 fs-11 mt-2 d-block text-nowrap fw-bold " id="total_today_win_performe">0</h4>
                        </div>
                        <div class="col-3">
                        <iconify-icon icon="solar:smartphone-line-duotone" class="fs-7 d-flex text-secondary"></iconify-icon>
                        <span class="fs-11 mt-2 d-block text-nowrap fw-bold h3">Firm</span>
                        <h4 class="mb-0 mt-1 fs-11 mt-2 d-block text-nowrap fw-bold " id="total_today_win_firme">0</h4>
                        </div>
                        <div class="col-3">
                        <iconify-icon icon="solar:tablet-line-duotone" class="fs-7 d-flex text-success"></iconify-icon>
                        <span class="fs-11 mt-2 d-block text-nowrap fw-bold h3">Etiquette</span>
                        <h4 class="mb-0 mt-1 fs-11 mt-2 d-block text-nowrap fw-bold " id="total_today_win_etiquette">0</h4>
                        </div>

                        <div class="col-3">
                            <iconify-icon icon="solar:tablet-line-duotone" class="fs-7 d-flex text-success"></iconify-icon>
                            <span class="fs-11 mt-2 d-block text-nowrap fw-bold h3">Bouchon</span>
                            <h4 class="mb-0 mt-1 fs-11 mt-2 d-block text-nowrap fw-bold " id="total_today_win_bouchon">0</h4>
                        </div>
                    </div> --}}

                    <div class="row text-center mb-4">
                        <!-- Dépense Preforme -->
                        <div class="col-md-3 mb-3">
                            <div class="card shadow-sm">
                                <div class="card-body bg-success">
                                    <i class="bi bi-bar-chart-line text-success fs-1"></i>
                                    <h5 class="card-title mt-3 text-white">Preforme</h5>
                                    <p class="card-text text-white">Nombre: <strong class="text-white" id="total_today_win_performe">0 FCFA</strong></p>
                                </div>
                            </div>
                        </div>

                        <!-- Dépense Firm -->
                        <div class="col-md-3 mb-3">
                            <div class="card shadow-sm">
                                <div class="card-body bg-info">
                                    <i class="bi bi-pie-chart-fill  fs-1"></i>
                                    <h5 class="card-title mt-3 text-white">Firm</h5>
                                    <p class="card-text text-white" >Nombre: <strong class="text-white" id="total_today_win_firme">0 FCFA</strong></p>
                                </div>
                            </div>
                        </div>

                        <!-- Dépense Etiquette -->
                        <div class="col-md-3 mb-3">
                            <div class="card shadow-sm">
                                <div class="card-body bg-warning">
                                    <i class="bi bi-diagram-3-fill  fs-1"></i>
                                    <h5 class="card-title mt-3 text-white">Etiquette</h5>
                                    <p class="card-text text-white">Nombre: <strong class="text-white" id="total_today_win_etiquette">0 FCFA</strong></p>
                                </div>
                            </div>
                        </div>

                        <!-- Dépense Bouchon -->
                        <div class="col-md-3 mb-3 ">
                            <div class="card shadow-sm ">
                                <div class="card-body bg-danger">
                                    <i class="bi bi-circle-fill text-warning fs-1"></i>
                                    <h5 class="card-title mt-3 text-white">Bouchon</h5>
                                    <p class="card-text text-white">Nombre: <strong class="text-white" id="total_today_win_bouchon">0 FCFA</strong></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h3 class="text-muted" style="margin-top: 10px">Prix de produit depenser :</h3>


                    {{-- <div class="vstack gap-4 mt-7 pt-2">
                        <div>
                        <div class="hstack justify-content-between">
                            <span class="fs-3 fw-bold">Preforme</span>
                            <h3 class="fs-3 fw-bold text-dark lh-base mb-0" id="total_today_prix_performe">0</h3>
                        </div>
                        <div class="progress mt-6" role="progressbar" aria-label="Warning example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar bg-primary" style="width: 100%"></div>
                        </div>
                        </div>

                        <div>
                        <div class="hstack justify-content-between">
                            <span class="fs-3 fw-bold">Firm</span>
                            <h3 class="fs-3 fw-bold text-dark lh-base mb-0" id="total_today_prix_firme">0</h3>
                        </div>
                        <div class="progress mt-6" role="progressbar" aria-label="Warning example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar bg-secondary" style="width: 50%"></div>
                        </div>
                        </div>

                        <div>
                        <div class="hstack justify-content-between">
                            <span class="fs-3 fw-bold">Etiquette</span>
                            <h3 class="fs-3 fw-bold text-dark lh-base mb-0" id="total_today_prix_etiquette">0</h3>
                        </div>
                        <div class="progress mt-6" role="progressbar" aria-label="Warning example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar bg-success" style="width: 35%"></div>
                        </div>
                        </div>


                        <div class="hstack justify-content-between">
                            <span class="fs-3 fw-bold">Bouchon</span>
                            <h3 class="fs-3 fw-bold text-dark lh-base mb-0" ><span id="total_today_prix_bouchon">0</span></h3>
                        </div>
                        <div class="progress mt-6" role="progressbar" aria-label="Warning example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar bg-warning" style="width: 100%"></div>
                        </div>

                    </div> --}}
                    <div class="row text-center mb-4">
                        <!-- Dépense Preforme -->
                        <div class="col-md-3 mb-3">
                            <div class="card shadow-sm">
                                <div class="card-body bg-dark">
                                    <i class="bi bi-bar-chart-line text-success fs-1"></i>
                                    <h5 class="card-title mt-3 text-white">Preforme</h5>
                                    <p class="card-text text-muted">Montant: <strong id="total_today_prix_performe">0 FCFA</strong></p>
                                </div>
                            </div>
                        </div>

                        <!-- Dépense Firm -->
                        <div class="col-md-3 mb-3">
                            <div class="card shadow-sm">
                                <div class="card-body bg-warning">
                                    <i class="bi bi-pie-chart-fill text-success fs-1"></i>
                                    <h5 class="card-title mt-3 text-white">Firm</h5>
                                    <p class="card-text text-white" >Montant: <strong id="total_today_prix_firme">0 FCFA</strong></p>
                                </div>
                            </div>
                        </div>

                        <!-- Dépense Etiquette -->
                        <div class="col-md-3 mb-3">
                            <div class="card shadow-sm">
                                <div class="card-body bg-primary">
                                    <i class="bi bi-diagram-3-fill text-success fs-1"></i>
                                    <h5 class="card-title mt-3 text-white">Etiquette</h5>
                                    <p class="card-text text-white">Montant: <strong id="total_today_prix_etiquette">0 FCFA</strong></p>
                                </div>
                            </div>
                        </div>

                        <!-- Dépense Bouchon -->
                        <div class="col-md-3 mb-3">
                            <div class="card shadow-sm">
                                <div class="card-body bg-secondary">
                                    <i class="bi bi-circle-fill text-warning fs-1"></i>
                                    <h5 class="card-title mt-3 text-white">Bouchon</h5>
                                    <p class="card-text text-white">Montant: <strong id="total_today_prix_bouchon">0 FCFA</strong></p>
                                </div>
                            </div>
                        </div>

                        <div class="row text-center mt-4">
                            <h4 class="text-success">Dépense Totale: <strong id="total_prix_depense">0 FCFA</strong></h4>
                        </div>

                    </div>
                    </div>
                </div>
            </div>






            <div class="card">
                <div class="card-body">

                  <h5 class="card-title fw-semibold mb-4">Voir tous les details</h5>

                  <div class="card mb-0">
                    <div class="card-body p-4">
                      <button type="button" class="btn btn-outline-primary m-1" id="btn_final_produit">Produit final</button>
                      <button type="button" class="btn btn-outline-secondary m-1" id="btn_performe">Preforme</button>
                      <button type="button" class="btn btn-outline-success m-1" id="btn_firme">Firm</button>
                      <button type="button" class="btn btn-outline-danger m-1" id="btn_etiquette">Etiquette</button>
                      <button type="button" class="btn btn-outline-warning m-1" id="btn_bouchon">Bouchon</button>

                    </div>
                  </div>



                  <div class="d-none col-lg" id="view_produit_final">
                    <h5 class="card-title text-primary m-2">Le tableau de tous les produits finis</h5>
                    <div class="card" id="table_produit_fini">
                        <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-nowrap align-middle mb-0">
                            <thead>
                                <tr class="border-2 border-bottom border-primary border-0">
                                <th scope="col" class="ps-0">Jour</th>
                                <th scope="col" class="ps-0">Semaine</th>
                                <th scope="col" class="ps-0">Mois</th>
                                <th scope="col" class="text-center">Nombre paquets</th>
                                <th scope="col" class="text-center">Prix(CFA)</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider" id="tableau_day">
                                @foreach ($produit_finish_all as $produit)
                                <tr>
                                    <td class="text-center fw-medium">{{ $produit->created_at->translatedFormat('l d') }}</td>
                                    <td class="text-center fw-medium">{{ $produit->week_period }}</td>
                                    <td class="text-center fw-medium">{{ $produit->created_at->translatedFormat('F') }}</td>
                                    <td class="text-center fw-medium">{{ $produit->nombre }}</td>
                                    <td class="text-center fw-medium">{{ $produit->nombre * 750 }}</td>
                                </tr>
                                <tr>
                                @endforeach

                            </tbody>
                            </table>
                        </div>
                        </div>
                    </div>

                   </div>



                  </div>



                  <div class="d-none col-lg" id="view_preforme">
                    <h5 class="card-title text-secondary m-2">Le tableau de tous les preformes</h5>
                    <div class="card" id="table_produit_fini">
                        <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-nowrap align-middle mb-0">
                            <thead>
                                <tr class="border-2 border-bottom border-secondary border-0">
                                <th scope="col" class="ps-0">Type</th>
                                <th scope="col" class="ps-0">Jour</th>
                                <th scope="col" class="ps-0">Semaine</th>
                                <th scope="col" class="ps-0">Mois</th>
                                <th scope="col" class="text-center">Nombre preforme</th>
                                <th scope="col" class="text-center">Prix(CFA)</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider" id="tableau_day">
                                @foreach ($all_produit_performe as $produit)
                                <tr>
                                    <td class="text-center fw-medium">{{ $produit->type ? $produit->type->type : "Inconnu" }}</td>
                                    <td class="text-center fw-medium">{{ $produit->created_at->translatedFormat('l d') }}</td>
                                    <td class="text-center fw-medium">{{ $produit->week_period }}</td>
                                    <td class="text-center fw-medium">{{ $produit->created_at->translatedFormat('F') }}</td>
                                    <td class="text-center fw-medium">{{ $produit->nbr_perdu }}</td>
                                    <td class="text-center fw-medium">{{ $produit->nbr_gagner }}</td>
                                </tr>
                                <tr>
                                @endforeach

                            </tbody>
                            </table>
                        </div>
                        </div>
                    </div>

                   </div>



                  </div>


                  <div class="d-none col-lg" id="view_firm">
                    <h5 class="card-title text-success m-2">Le tableau de tous les firms</h5>
                    <div class="card" id="table_produit_fini">
                        <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-nowrap align-middle mb-0">
                            <thead>
                                <tr class="border-2 border-bottom border-success border-0">
                                <th scope="col" class="ps-0">Type</th>
                                <th scope="col" class="ps-0">Jour</th>
                                <th scope="col" class="ps-0">Semaine</th>
                                <th scope="col" class="ps-0">Mois</th>
                                <th scope="col" class="text-center">Nombre firm</th>
                                <th scope="col" class="text-center">Prix(CFA)</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider" id="tableau_day">
                                @foreach ($all_produit_firm as $produit)
                                <tr>
                                    <td class="text-center fw-medium">{{ $produit->type ? $produit->type->type : "Inconnu" }}</td>
                                    <td class="text-center fw-medium">{{ $produit->created_at->translatedFormat('l d') }}</td>
                                    <td class="text-center fw-medium">{{ $produit->week_period }}</td>
                                    <td class="text-center fw-medium">{{ $produit->created_at->translatedFormat('F') }}</td>
                                    <td class="text-center fw-medium">{{ $produit->nbr_perdu }}</td>
                                    <td class="text-center fw-medium">{{ $produit->nbr_gagner }}</td>
                                </tr>
                                <tr>
                                @endforeach

                            </tbody>
                            </table>
                        </div>
                        </div>
                    </div>

                   </div>



                  </div>




                  <div class="d-none col-lg" id="view_etiquette">
                    <h5 class="card-title text-danger m-2">Le tableau de tous les etiquette</h5>
                    <div class="card" id="table_produit_fini">
                        <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-nowrap align-middle mb-0">
                            <thead>
                                <tr class="border-2 border-bottom border-danger border-0">
                                <th scope="col" class="ps-0">Type</th>
                                <th scope="col" class="ps-0">Jour</th>
                                <th scope="col" class="ps-0">Semaine</th>
                                <th scope="col" class="ps-0">Mois</th>
                                <th scope="col" class="text-center">Nombre firm</th>
                                <th scope="col" class="text-center">Prix(CFA)</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider" id="tableau_day">
                                @foreach ($all_produit_etiquette as $produit)
                                <tr>
                                    <td class="text-center fw-medium">{{ $produit->type ? $produit->type->type : "Inconnu" }}</td>
                                    <td class="text-center fw-medium">{{ $produit->created_at->translatedFormat('l d') }}</td>
                                    <td class="text-center fw-medium">{{ $produit->week_period }}</td>
                                    <td class="text-center fw-medium">{{ $produit->created_at->translatedFormat('F') }}</td>
                                    <td class="text-center fw-medium">{{ $produit->nbr_perdu }}</td>
                                    <td class="text-center fw-medium">{{ $produit->nbr_gagner }}</td>
                                </tr>
                                <tr>
                                @endforeach

                            </tbody>
                            </table>
                        </div>
                        </div>
                    </div>

                   </div>



                  </div>



                  <div class="d-none col-lg" id="view_bouchon">
                    <h5 class="card-title text-warning m-2">Le tableau de tous les bouchons</h5>
                    <div class="card" id="table_produit_fini">
                        <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-nowrap align-middle mb-0">
                            <thead>
                                <tr class="border-2 border-bottom border-warning border-0">
                                <th scope="col" class="ps-0">Type</th>
                                <th scope="col" class="ps-0">Jour</th>
                                <th scope="col" class="ps-0">Semaine</th>
                                <th scope="col" class="ps-0">Mois</th>
                                <th scope="col" class="text-center">Nombre firm</th>
                                <th scope="col" class="text-center">Prix(CFA)</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider" id="tableau_day">
                                @foreach ($all_produit_bouchon as $produit)
                                <tr>
                                    <td class="text-center fw-medium">{{ $produit->type ? $produit->type->type : "Inconnu" }}</td>
                                    <td class="text-center fw-medium">{{ $produit->created_at->translatedFormat('l d') }}</td>
                                    <td class="text-center fw-medium">{{ $produit->week_period }}</td>
                                    <td class="text-center fw-medium">{{ $produit->created_at->translatedFormat('F') }}</td>
                                    <td class="text-center fw-medium">{{ $produit->nbr_perdu }}</td>
                                    <td class="text-center fw-medium">{{ $produit->nbr_gagner }}</td>
                                </tr>
                                <tr>
                                @endforeach

                            </tbody>
                            </table>
                        </div>
                        </div>
                    </div>

                   </div>



                  </div>
              </div>

        </div>




    </div>
  {{-- <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="../assets/js/sidebarmenu.js"></script>
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/js/dashboard.js"></script> --}}

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>




</html>
{{-- @endsection --}}




