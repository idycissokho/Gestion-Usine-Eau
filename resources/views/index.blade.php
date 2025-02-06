{{-- <div class="row">

    <div class="">
        tableau de tous les produit enregistrer aujourd'hui
       <div class="card" id="table_day">
            <div class="card-body">
            <h5 class="card-title text-warning">Tableau des produits enregistrer aujourd'hui {{ now()->dayName }}</h5>
            <div class="table-responsive">
                <table class="table text-nowrap align-middle mb-0">
                <thead>
                    <tr class="border-2 border-bottom border-primary border-0">
                    <th scope="col" class="ps-0">Jour</th>
                    <th scope="col" class="ps-0">Semaine</th>
                    <th scope="col" class="ps-0">Mois</th>
                    <th scope="col" class="text-center">type</th>
                    <th scope="col" class="text-center">nombre gagner</th>
                    <th scope="col" class="text-center">nombre perdu</th>
                    <th scope="col" class="text-center">Prix gagner</th>
                    <th scope="col" class="text-center">Prix perdu</th>
                    <th scope="col" class="text-center">Gain obtenue</th>

                    </tr>
                </thead>
                <tbody class="table-group-divider" id="tableau_day">
                    @foreach ($produit_day as $produit)
                    <tr>

                        <td class="text-center fw-medium">{{ $produit->created_at->translatedFormat('l') }}</td>
                        <td class="text-center fw-medium">{{ $produit->week_period }}</td>
                        <td class="text-center fw-medium">{{ $produit->created_at->translatedFormat('F') }}</td>
                        <td class="text-center fw-medium">{{ $produit->type ? $produit->type->type : "Inconnu" }}</td>
                        <td class="text-center fw-medium">{{ $produit->nbr_gagner }}</td>
                        <td class="text-center fw-medium">{{ $produit->nbr_perdu }}</td>
                        <td class="text-center fw-medium">{{ $produit->nbr_gagner * 10 }}</td>
                        <td class="text-center fw-medium">{{ $produit->nbr_perdu * 10 }}</td>
                        <td class="text-center fw-medium">{{ ($produit->nbr_gagner * 10) -  ($produit->nbr_perdu * 10)}}</td>
                    </tr>
                    <tr>
                    @endforeach

                </tbody>
                </table>
            </div>
            </div>
        </div>
        tableau de tous les produit de type performe
         <div class="d-none card" id="table_performe">
            <div class="card-body">
            <h5 class="card-title text-info">Tableau des produits de Type Performe</h5>
            <div class="table-responsive">
                <table class="table text-nowrap align-middle mb-0">
                <thead>
                    <tr class="border-2 border-bottom border-primary border-0">
                    <th scope="col" class="ps-0">Jour</th>
                    <th scope="col" class="ps-0">Mois</th>
                    <th scope="col" class="text-center">type</th>
                    <th scope="col" class="text-center">nombre gagner</th>
                    <th scope="col" class="text-center">nombre perdu</th>
                    <th scope="col" class="text-center">Prix gagner</th>
                    <th scope="col" class="text-center">Prix perdu</th>
                    <th scope="col" class="text-center">Gain obtenue</th>

                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($all_produit_performe as $produit)
                    <tr>

                        <td class="text-center fw-medium">{{ $produit->created_at->translatedFormat('l') }}</td>
                        <td class="text-center fw-medium">{{ $produit->created_at->translatedFormat('F') }}</td>
                        <td class="text-center fw-medium">{{ $produit->type ? $produit->type->type : "Inconnu" }}</td>
                        <td class="text-center fw-medium">{{ $produit->nbr_gagner }}</td>
                        <td class="text-center fw-medium">{{ $produit->nbr_perdu }}</td>
                        <td class="text-center fw-medium">{{ $produit->nbr_gagner * 10 }}</td>
                        <td class="text-center fw-medium">{{ $produit->nbr_perdu * 10 }}</td>
                        <td class="text-center fw-medium">{{ ($produit->nbr_gagner * 10) -  ($produit->nbr_perdu * 10)}}</td>
                    </tr>
                    <tr>
                    @endforeach

                </tbody>
                </table>
            </div>
            </div>
        </div>

        {{-- tableau de tous les produit de type firme --}}

        <div class="d-none card" id="table_firme">
            <div class="card-body">
            <h5 class="card-title text-secondary">Tableau des produits de Type Firme</h5>
            <div class="table-responsive">
                <table class="table text-nowrap align-middle mb-0 ">
                <thead>
                    <tr class="border-2 border-bottom border-primary border-0">
                    <th scope="col" class="ps-0">Jour</th>
                    <th scope="col" class="ps-0">Mois</th>
                    <th scope="col" class="text-center">type</th>
                    <th scope="col" class="text-center">nombre gagner</th>
                    <th scope="col" class="text-center">nombre perdu</th>
                    <th scope="col" class="text-center">Prix gagner</th>
                    <th scope="col" class="text-center">Prix perdu</th>
                    <th scope="col" class="text-center">Gain obtenue</th>

                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($all_produit_firm as $produit)
                    <tr>

                        <td class="text-center fw-medium">{{ $produit->created_at->translatedFormat('l') }}</td>
                        <td class="text-center fw-medium">{{ $produit->created_at->translatedFormat('F') }}</td>
                        <td class="text-center fw-medium">{{ $produit->type ? $produit->type->type : "Inconnu" }}</td>
                        <td class="text-center fw-medium">{{ $produit->nbr_gagner }}</td>
                        <td class="text-center fw-medium">{{ $produit->nbr_perdu }}</td>
                        <td class="text-center fw-medium">{{ $produit->nbr_gagner * 10 }}</td>
                        <td class="text-center fw-medium">{{ $produit->nbr_perdu * 10 }}</td>
                        <td class="text-center fw-medium">{{ ($produit->nbr_gagner * 10) -  ($produit->nbr_perdu * 10)}}</td>
                    </tr>
                    <tr>
                    @endforeach

                </tbody>
                </table>
            </div>
            </div>
        </div>


         {{-- tableau de tous les produit de type Etiquette --}}

          <div class="d-none card" id="table_etiquette">
            <div class="card-body">
            <h5 class="card-title text-dark">Tableau des produits de Type Etiquette</h5>
            <div class="table-responsive">
                <table class="table text-nowrap align-middle mb-0 ">
                <thead>
                    <tr class="border-2 border-bottom border-primary border-0">
                    <th scope="col" class="ps-0">Jour</th>
                    <th scope="col" class="ps-0">Mois</th>
                    <th scope="col" class="text-center">type</th>
                    <th scope="col" class="text-center">nombre gagner</th>
                    <th scope="col" class="text-center">nombre perdu</th>
                    <th scope="col" class="text-center">Prix gagner</th>
                    <th scope="col" class="text-center">Prix perdu</th>
                    <th scope="col" class="text-center">Gain obtenue</th>

                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($all_produit_etiquette as $produit)
                    <tr>

                        <td class="text-center fw-medium">{{ $produit->created_at->translatedFormat('l') }}</td>
                        <td class="text-center fw-medium">{{ $produit->created_at->translatedFormat('F') }}</td>
                        <td class="text-center fw-medium">{{ $produit->type ? $produit->type->type : "Inconnu" }}</td>
                        <td class="text-center fw-medium">{{ $produit->nbr_gagner }}</td>
                        <td class="text-center fw-medium">{{ $produit->nbr_perdu }}</td>
                        <td class="text-center fw-medium">{{ $produit->nbr_gagner * 10 }}</td>
                        <td class="text-center fw-medium">{{ $produit->nbr_perdu * 10 }}</td>
                        <td class="text-center fw-medium">{{ ($produit->nbr_gagner * 10) -  ($produit->nbr_perdu * 10)}}</td>
                    </tr>
                    <tr>
                    @endforeach

                </tbody>
                </table>
            </div>
            </div>
        </div>

         {{-- tableau de tous les produit de type bouchon --}}

         <div class="d-none card" id="table_bouchon">
            <div class="card-body">
            <h5 class="card-title text-danger">Tableau des produits de Type Bouchon</h5>
            <div class="table-responsive">
                <table class="table text-nowrap align-middle mb-0 ">
                <thead>
                    <tr class="border-2 border-bottom border-primary border-0">
                    <th scope="col" class="ps-0">Jour</th>
                    <th scope="col" class="ps-0">Mois</th>
                    <th scope="col" class="text-center">type</th>
                    <th scope="col" class="text-center">nombre gagner</th>
                    <th scope="col" class="text-center">nombre perdu</th>
                    <th scope="col" class="text-center">Prix gagner</th>
                    <th scope="col" class="text-center">Prix perdu</th>
                    <th scope="col" class="text-center">Gain obtenue</th>

                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($all_produit_bouchon as $produit)
                    <tr>

                        <td class="text-center fw-medium">{{ $produit->created_at->translatedFormat('l') }}</td>
                        <td class="text-center fw-medium">{{ $produit->created_at->translatedFormat('F') }}</td>
                        <td class="text-center fw-medium">{{ $produit->type ? $produit->type->type : "Inconnu" }}</td>
                        <td class="text-center fw-medium">{{ $produit->nbr_gagner }}</td>
                        <td class="text-center fw-medium">{{ $produit->nbr_perdu }}</td>
                        <td class="text-center fw-medium">{{ $produit->nbr_gagner * 10 }}</td>
                        <td class="text-center fw-medium">{{ $produit->nbr_perdu * 10 }}</td>
                        <td class="text-center fw-medium">{{ ($produit->nbr_gagner * 10) -  ($produit->nbr_perdu * 10)}}</td>
                    </tr>
                    <tr>
                    @endforeach

                </tbody>
                </table>
            </div>
            </div>
        </div>

    </div>


