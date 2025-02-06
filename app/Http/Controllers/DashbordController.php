<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Produitfini;
use App\Models\Stock;
use App\Models\Type;
use App\Models\Type_Depense;
use App\Models\Depenses;
use App\Models\User;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DashbordController extends Controller
{
   public function Return_view_dashbord()
   {
    $utilisateur = User::all();
    $produit_day = Produit::whereDate('created_at', Carbon::today())->get();
    $produit_day_limite = Produit::whereDate('created_at', Carbon::today())
                            ->orderBy('created_at', 'desc')
                            ->take(4)
                            ->get();
    $produit_finish = Produitfini::whereDate('created_at', Carbon::today())
                            ->orderBy('created_at', 'desc')
                            ->take(4)
                            ->get();
    $produit_finish_all = Produitfini::all();
    $all_type_depense = Type_Depense::all();

    $depenses = Depenses::with('typedepense')->get();
    $depenses_day = Depenses::whereDate('created_at', Carbon::today())
                            ->with('typedepense')->get();




    $all_stock_finish = Stock::orderBy('created_at', 'desc')->get();



    $produit_day_performe = $produit_day->where('type_id', 1);
    // $produit_day_firme = $produit_day->where('type_id', 2);
    // $produit_day_etiquette = $produit_day->where('type_id', 3);
    // $produit_day_bouchon = $produit_day->where('type_id', 4);

    $all_produit_performe = Produit::where('type_id', 1)->get();
    $all_produit_firm = Produit::where('type_id', 2)->get();
    $all_produit_etiquette = Produit::where('type_id', 3)->get();
    $all_produit_bouchon = Produit::where('type_id', 4)->get();


    $types = Type::all();
    $stocks = Stock::whereIn('id', function ($query) {
        $query->select(DB::raw('MAX(id)'))
            ->from('stocks')
            ->groupBy('type_id'); // ou 'type' selon le nom de la colonne
    })
    ->orderBy('created_at', 'desc')
    ->take(4)
    ->get();

    return view('dashbord', compact('types', 'produit_day' ,'all_produit_performe',
                                    'all_produit_firm', 'all_produit_etiquette' ,
                                    'all_produit_bouchon', 'stocks', 'produit_day_limite',
                                    'produit_finish','produit_finish_all', 'all_stock_finish',
                                    'all_type_depense','depenses','depenses_day','utilisateur'

                                    ));
   }

   public function view_table()
   {
        $all_stock = Stock::with('type')->get();
        return response()->json($all_stock);
    }


    public function get_all_time()
    {


        $produit_day = Produit::whereDate('created_at', Carbon::today())->get();

        $for_month = Produit::whereMonth('created_at', Carbon::now()->month)
                                     ->sum('nbr_gagner');

        $preforme_for_month = Produit::where('type_id', 1)
                                    ->whereMonth('created_at', Carbon::now()->month)
                                    ->sum('nbr_gagner');
        $firm_for_month = Produit::where('type_id', 2)
                                    ->whereMonth('created_at', Carbon::now()->month)
                                    ->sum('nbr_gagner');
        $etiquette_for_month = Produit::where('type_id', 3)
                                    ->whereMonth('created_at', Carbon::now()->month)
                                    ->sum('nbr_gagner');
        $bouchon_for_month = Produit::where('type_id', 4)
                                    ->whereMonth('created_at', Carbon::now()->month)
                                    ->sum('nbr_gagner');


        $startOfWeek = Carbon::now()->startOfWeek(); // Lundi
        $endOfWeek = Carbon::now()->endOfWeek();
        $for_week = Produit::whereBetween('created_at', [$startOfWeek, $endOfWeek])
                                    ->sum('nbr_gagner');
        $total_prix_depense = $produit_day->sum('nbr_gagner');
        $produit_day_performe = $produit_day->where('type_id', 1);
        $produit_day_firme = $produit_day->where('type_id', 2);
        $produit_day_etiquette = $produit_day->where('type_id', 3);
        $produit_day_bouchon = $produit_day->where('type_id', 4);




        $produit_fini_week = Produitfini::whereBetween('created_at', [$startOfWeek, $endOfWeek])
                                    ->sum('prix');




        // le prix gagner et perdu de performe
        $total_today_win_performe = $produit_day_performe->sum(function($produit){
            return $produit->nbr_perdu;
        });
        $total_today_prix_performe = $produit_day_performe->sum(function($produit){
            return $produit->nbr_gagner;
        });


         // le prix gagner et perdu de firme
         $total_today_win_firme = $produit_day_firme->sum(function($produit){
            return $produit->nbr_perdu;
        });
        $total_today_prix_firme = $produit_day_firme->sum(function($produit){
            return $produit->nbr_gagner;
        });


        // le prix gagner et perdu de etiquette
        $total_today_win_etiquette = $produit_day_etiquette->sum(function($produit){
            return $produit->nbr_perdu;
        });
        $total_today_prix_etiquette = $produit_day_etiquette->sum(function($produit){
            return $produit->nbr_gagner;
        });


        // le prix gagner et perdu de bouchon
        $total_today_win_bouchon = $produit_day_bouchon->sum(function($produit){
            return $produit->nbr_perdu;
        });
        $total_today_prix_bouchon = $produit_day_bouchon->sum(function($produit){
            return $produit->nbr_gagner;
        });
        $matiere_premiere = $total_today_prix_performe + $total_today_prix_firme +
                            $total_today_prix_etiquette + $total_today_prix_bouchon;






        //depense
        $depenses = Depenses::with('typedepense')->get();
        $depenses_day = Depenses::whereDate('created_at', Carbon::today())
                            ->with('typedepense')->get();
        $depenses_month = Depenses::whereMonth('created_at', Carbon::now()->month)
                            ->with('typedepense')->get();
        $startOfWeek = Carbon::now()->startOfWeek(); // Lundi
        $endOfWeek = Carbon::now()->endOfWeek();     // Dimanche
        $all_prix_depense_today = $depenses_day->sum(function($depense){
            return $depense->prix;
        });

        $all_prix_depense_month = $depenses_month->sum(function($depense){
            return $depense->prix;
        });
        $depenses_week = Depenses::whereBetween('created_at', [$startOfWeek, $endOfWeek])
                                  ->with('typedepense')->get();
        $all_prix_depense_week = $depenses_week->sum(function($depense) {
                                    return $depense->prix;
                                });
        $depense_total_today = $matiere_premiere + $all_prix_depense_today;


        $produit_finish_week = Produitfini::whereBetween('created_at', [$startOfWeek, $endOfWeek])->get();


        $produit_finish_month = Produitfini::whereMonth('created_at', Carbon::now()->month)->get();



        $prix_produit_finish_week = $produit_finish_week->sum(function($produit) {
                return $produit->prix;
        });

        $prix_produit_finish_month = $produit_finish_month->sum(function($produit) {
            return $produit->prix;
        });

        $benefice_produit_week = $prix_produit_finish_week - $for_week;



        $benefice_produit_month = $prix_produit_finish_month - $for_month;





        return response()->json([

            'total_today_win_performe' => $total_today_win_performe,
            'total_today_prix_performe' => $total_today_prix_performe,
            'total_today_win_firme' => $total_today_win_firme,
            'total_today_prix_firme' => $total_today_prix_firme,
            'total_today_win_etiquette' => $total_today_win_etiquette,
            'total_today_prix_etiquette' => $total_today_prix_etiquette,
            'total_today_win_bouchon' => $total_today_win_bouchon,
            'total_today_prix_bouchon' => $total_today_prix_bouchon,
            'preforme_for_month' => $preforme_for_month,
            'firm_for_month' => $firm_for_month,
            'etiquette_for_month' => $etiquette_for_month,
            'bouchon_for_month' => $bouchon_for_month,
            'for_month' => $for_month,
            'total_prix_depense' => $total_prix_depense,
            'all_prix_depense_today' => $all_prix_depense_today,
            'all_prix_depense_month' => $all_prix_depense_month,
            'all_prix_depense_week' => $all_prix_depense_week,
            'depense_total_today' => $depense_total_today,
            'matiere_premiere' => $matiere_premiere,
            'for_week' => $for_week,
            'prix_produit_finish_week' => $prix_produit_finish_week,
            'prix_produit_finish_month' => $prix_produit_finish_month,
            'benefice_produit_week' => $benefice_produit_week,
            'benefice_produit_month' => $benefice_produit_month

        ]);
    }



    public function ProductionTotals()
    {
        // Récupérer toutes les données de production
        $produit_finish = Produitfini::all();

        $totalByDay = $produit_finish->where('created_at', '>=', now()->startOfDay())->sum('nombre');
        $totalByWeek = $produit_finish->where('created_at', '>=', now()->startOfWeek())->sum('nombre');
        $totalByMonth = $produit_finish->where('created_at', '>=', now()->startOfMonth())->sum('nombre');

        $totalByDayprix = $produit_finish
                            ->where('created_at', '>=', now()->startOfDay())
                            ->map(function ($produit) {
                                return $produit->nombre * 750;
                            })
                            ->sum();
        $totalByWeekprix = $produit_finish
                            ->where('created_at', '>=', now()->startOfWeek())
                            ->map(function ($produit) {
                                return $produit->nombre * 750;
                            })
                            ->sum();
        $totalByMonthprix = $produit_finish
                            ->where('created_at', '>=', now()->startOfMonth())
                            ->map(function ($produit) {
                                return $produit->nombre * 750;
                            })
                            ->sum();


        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        // Récupération des produits créés cette semaine
        $produits_current_week = Produit::whereBetween('created_at', [$startOfWeek, $endOfWeek])->get();

        $totalPrix_preforme_week = Produit::where('type_id', 1)
                                ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
                                ->sum('nbr_gagner');
        $totalPrix_firm_week = Produit::where('type_id', 2)
                                ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
                                ->sum('nbr_gagner');
        $totalPrix_etiquette_week = Produit::where('type_id', 3)
                                ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
                                ->sum('nbr_gagner');
        $totalPrix_bouchon_week = Produit::where('type_id', 3)
                                ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
                                ->sum('nbr_gagner');
        $totalPrix_all_type_week = $totalPrix_preforme_week + $totalPrix_firm_week +
                                    $totalPrix_etiquette_week + $totalPrix_bouchon_week;



        // Passer les résultats aux vues
        return response()->json([
            'totalByDay' => $totalByDay,
            'totalByWeek' => $totalByWeek,
            'totalByMonth' => $totalByMonth,
            'totalByDayprix' => $totalByDayprix,
            'totalByWeekprix' => $totalByWeekprix,
            'totalByMonthprix' => $totalByMonthprix,
            'totalPrix_preforme_week' => $totalPrix_preforme_week,
            'totalPrix_firm_week' => $totalPrix_firm_week,
            'totalPrix_etiquette_week' => $totalPrix_etiquette_week,
            'totalPrix_bouchon_week' => $totalPrix_bouchon_week,
            'totalPrix_all_type_week' => $totalPrix_all_type_week
        ]);
    }




}
