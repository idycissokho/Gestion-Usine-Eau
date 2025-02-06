<?php

namespace App\Http\Controllers;

use App\Models\Depenses;
use App\Models\Produit;
use App\Models\Produitfini;
use App\Models\Stock;
use App\Models\Type;
use Illuminate\Http\Request;




class ProduitController extends Controller
{

    public function Ajouter_Produit(Request $request)
    {

        $new_prod = $request->validate([
            'nombre' => 'required|integer',
            'type' => 'required|exists:types,id',
        ]);
        $produit = new Stock();
        $produit->nombre = $new_prod['nombre'];
        $produit->type_id = $new_prod['type'];
        $produit->save();
        return response()->json(['success' => true]);

    }
    public function update(Request $request)
    {
    // Récupère le produit à partir de son ID
        $stock = Stock::find($request->product_id);
        $type = $request->type;
        $nombre = $request->nombre;

        if ($stock) {
            $new_stock = new Stock();
            $new_stock->nombre = $stock->nombre + $nombre;
            $new_stock->type_id = $stock->type_id;

            $new_stock->save();


            return redirect()->back()->with('success', 'Le stock a été mis à jour avec succès');
        }

        return redirect()->back()->with('error', 'Le produit n\'a pas été trouvé');
    }
    public function update_type(Request $request)
    {
    // Récupère le produit à partir de son ID
        $type = Type::find($request->id);

        if ($type) {
            // Met à jour les champs
            $type->prix_unitaire = $request->prix_uni;
            $type->save();

            return redirect()->back()->with('success', 'Le prix unitaire a été mis à jour avec succès');
        }

        return redirect()->back()->with('error', 'Le prix unitaire n\'a pas été trouvé');
    }


    public function check_produit(Request $request)
    {
        $nombre = $request->nombre_produit;
        $type_preforme = Type::find(1);
        $type_firm = Type::find(2);
        $type_etiquette = Type::find(3);
        $type_bouchon = Type::find(4);

        // if (!$type) {
        //     return redirect()->back()->with('error', 'Type non trouvé.');
        // }

        $new_finish = new Produitfini();
        $new_finish->nombre = $nombre;
        $new_finish->prix = $nombre*750;
        $new_finish->save();




        $lastStockPreforme = Stock::where('type_id', 1)
                                ->orderBy('created_at', 'desc')
                                ->first();
        $lastStockPreforme->nombre = $lastStockPreforme->nombre - $nombre*12;

        $lastStockPreforme->save();

        $lastStockfirm = Stock::where('type_id', 2)
                                ->orderBy('created_at', 'desc')
                                ->first();
        $lastStockfirm->nombre = $lastStockfirm->nombre - $nombre*12;
        $lastStockfirm->save();


        $lastStocketiquette = Stock::where('type_id', 3)
                                ->orderBy('created_at', 'desc')
                                ->first();
        $lastStocketiquette->nombre = $lastStocketiquette->nombre - $nombre*12;
        $lastStocketiquette->save();

        $lastStockbouchon = Stock::where('type_id', 4)
                                ->orderBy('created_at', 'desc')
                                ->first();
        $lastStockbouchon->nombre = $lastStockbouchon->nombre - $nombre*12;
        $lastStockbouchon->save();






        $produit_preforme = new Produit();
        $produit_preforme->nbr_perdu = $nombre*12;
        $produit_preforme->nbr_gagner = $nombre*12*($type_preforme->prix_unitaire);
        $produit_preforme->type_id = 1;
        $produit_preforme->save();

        $produit_firm = new Produit();
        $produit_firm->nbr_perdu = $nombre*12;
        $produit_firm->nbr_gagner = $nombre*12*($type_firm->prix_unitaire);
        $produit_firm->type_id = 2;
        $produit_firm->save();

        $produit_etiquette = new Produit();
        $produit_etiquette->nbr_perdu = $nombre*12;
        $produit_etiquette->nbr_gagner = $nombre*12*($type_etiquette->prix_unitaire);
        $produit_etiquette->type_id = 3;
        $produit_etiquette->save();

        $produit_bouchon = new Produit();
        $produit_bouchon->nbr_perdu = $nombre*12;
        $produit_bouchon->nbr_gagner = $nombre*12*($type_bouchon->prix_unitaire);
        $produit_bouchon->type_id = 4;
        $produit_bouchon->save();



        if ($produit_preforme and $produit_firm and $produit_etiquette and $produit_bouchon) {
            return redirect()->back()->with('success', 'Nombre'. $nombre . 'a ete ajouter avec succees' . 'le nombre de produit en stock a dimunuer');
        } else {
            return redirect()->back()->with('error', 'Erreur lors de l\'ajout du produit.');
        }

    }
    public function save_depense(Request $request)
    {
        $validate_depense = $request->validate([
            'prix' => 'required|numeric',
            'typedepense' => 'required|exists:typedepense,id',
        ]);

        $depense = new Depenses();

        $depense->prix = $validate_depense['prix'];
        // $depense->depense_id = $validate_depense['typedepense'];
        $depense->typedepense_id = $validate_depense['typedepense'];

        $depense->save();
        $ALL = Depenses::all();

        return redirect(route('dashbord'))->with('success', 'Depense ajouter avec succee');


    }





}
