<?php

use App\Http\Controllers\DashbordController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;




Route::get('/', [LoginController::class, 'Return_Vieuw_login'])->name('login');
Route::post('/login', [LoginController::class, 'Traitement_Login'])->name('traitementlogin');
Route::post('/logout', [LoginController::class, 'Traitement_Logout'])->name('traitementlogout');
Route::get('/register', [RegisterController::class, 'Return_view_register'])->name('register');
Route::post('/register/traitement', [RegisterController::class, 'Traitement_register'])->name('traitementregister');
Route::get('/dashbord', [DashbordController::class, 'Return_view_dashbord'])->name('dashbord');
Route::post('/dashbord', [ProduitController::class, 'Ajouter_Produit'])->name('ajouter_stock');
Route::get('/dashbord/view', [DashbordController::class, 'View_table'])->name('view_stock');
Route::get('/get_all_time', [DashbordController::class, 'get_all_time'])->name('resume_affiche');
Route::post('/update_stock', [ProduitController::class, 'update'])->name('update_stock');
Route::post('/save_depense', [ProduitController::class, 'save_depense'])->name('save_depense');
Route::post('/update_type', [ProduitController::class, 'update_type'])->name('update_type_prix');
Route::post('/dashbord/check_produit', [ProduitController::class, 'check_produit'])->name('check_produit');
Route::get('/ProductionTotals', [DashbordController::class, 'ProductionTotals'])->name('affiche_fini');
Route::get('/get_all_depense', [DashbordController::class, 'get_all_depense'])->name('resume_affiche');
Route::post('/register/delete_user', [RegisterController::class, 'delete_user'])->name('delete_user');
Route::post('/register/activer', [RegisterController::class, 'activer'])->name('activer');
Route::post('/register/desactiver', [RegisterController::class, 'desactiver'])->name('desactiver');







