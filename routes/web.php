<?php

use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\MaterielController;
use App\Http\Controllers\ConsommationMaterielController;
use App\Http\Controllers\DecompteController;
use App\Http\Controllers\FraisController;
use App\Http\Controllers\OrdreServiceController;
use App\Http\Controllers\SouTraitanceController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\MateriauController;
use App\Http\Controllers\AcompteController;
use App\Http\Controllers\AvenantController;
use App\Http\Controllers\ChantierController;
use App\Http\Controllers\ChantierMaterielController;
use App\Http\Controllers\ChantierNatureFraisController;
use App\Http\Controllers\ChantierOperationController;
use App\Http\Controllers\ChantierOperationReelController;
use App\Http\Controllers\ChantierPersonnelController;
use App\Http\Controllers\ChantierQualificationController;
use App\Http\Controllers\CommandeMateriauController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\NatureFraisController;
use App\Http\Controllers\OperationController;
use App\Http\Controllers\QualificationController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource ('personnels' , PersonnelController::class);
Route::get('personnel/search', [PersonnelController::class, 'search'])->name('personnels.search');
//Route::get('personnel/search', 'PersonnelController@search')->name('personnels.search');

Route::resource ('materiels' , MaterielController::class);
Route::get('materiel/search', [MaterielController::class, 'search'])->name('materiels.search');

Route::resource ('consommationMateriels' , ConsommationMaterielController::class);
Route::get('consommationMateriel/search', [ConsommationMaterielController::class, 'search'])->name('consommationMateriels.search');

Route::resource ('decomptes' , DecompteController::class);
Route::get('decompte/search', [DecompteController::class, 'search'])->name('decomptes.search');

Route::resource ('frais' , FraisController::class);
Route::get('frai/search', [FraisController::class, 'search'])->name('frais.search');

Route::resource ('natureFrais' , NatureFraisController::class);
Route::get('nature/search', [NatureFraisController::class, 'search'])->name('natureFrais.search');

Route::resource ('ordreServices' , OrdreServiceController::class);
Route::get('ordreService/search', [OrdreServiceController::class, 'search'])->name('ordreServices.search');

Route::resource ('soutraitances' , SouTraitanceController::class);
Route::get('soutraitance/search', [SouTraitanceController::class, 'search'])->name('soutraitances.search');

Route::resource ('commandes' , CommandeController::class);
Route::get('commande/search', [CommandeController::class, 'search'])->name('commandes.search');

Route::resource ('materiaus' , MateriauController::class);
Route::get('materiau/search', [MateriauController::class, 'search'])->name('materiaus.search');

Route::resource ('factures' , FactureController::class);
Route::get('facture/search', [FactureController::class, 'search'])->name('factures.search');

Route::resource ('acomptes' , AcompteController::class);
Route::get('acompte/search', [AcompteController::class, 'search'])->name('acomptes.search');

Route::resource ('avenants' , AvenantController::class);
Route::get('avenant/search', [AvenantController::class, 'search'])->name('avenants.search');

Route::resource ('operations' , OperationController::class);
Route::get('operation/search', [OperationController::class, 'search'])->name('operations.search');
Route::get('operation/searchOperationEtat', [OperationController::class, 'searchOperationEtat'])->name('operations.searchOperationEtat');

Route::resource ('qualifications' , QualificationController::class);
Route::get('qualification/search', [QualificationController::class, 'search'])->name('qualifications.search');

Route::resource ('chantierNatureFrais' , ChantierNatureFraisController::class);
Route::get('chantierNatureFrai/search', [ChantierNatureFraisController::class, 'search'])->name('chantierNatureFrais.search');

Route::resource ('chantierQualifications' , ChantierQualificationController::class);
Route::get('chantierQualification/search', [ChantierQualificationController::class, 'search'])->name('chantierQualifications.search');





Route::resource ('fournisseurs' , FournisseurController::class);
Route::get('fournisseur/search', [FournisseurController::class, 'search'])->name('fournisseurs.search');



Route::resource ('chantiers' , ChantierController::class);
Route::get('chantier/search', [ChantierController::class, 'search'])->name('chantiers.search');
Route::get('chantier/searchChantierPersonnels', [ChantierController::class, 'searchChantierPersonnels'])->name('chantiers.searchChantierPersonnels');
Route::get('chantierPersonnels/searchChantierPersonnels', [ChantierPersonnelController::class, 'searchChantierPersonnels'])->name('chantierPersonnels.searchChantierPersonnels');
Route::get('chantierPersonnels/searchPersonnelsByChantier', [ChantierPersonnelController::class, 'searchPersonnelsByChantier'])->name('chantierPersonnels.searchPersonnelsByChantier');


Route::get('chantierMateriel/searchMaterielsByChantier', [ChantierMaterielController::class, 'searchMaterielsByChantier'])->name('chantierMateriels.searchMaterielsByChantier');
Route::get('/getChantierInfo', [ChantierMaterielController::class, 'getChantierInfo'])->name('chantierMateriels.getChantierInfo');

Route::get('searchMateriauxByChantier', [ChantierController::class, 'searchMateriauxByChantier'])->name('chantiers.searchMateriauxByChantier');



Route::resource ('chantierMateriels' , ChantierMaterielController::class);
Route::get('chantierMateriel/search', [ChantierMaterielController::class, 'search'])->name('chantierMateriels.search');

Route::resource ('chantierOperations' , ChantierOperationController::class);
Route::get('chantierOperation/search', [ChantierOperationController::class, 'search'])->name('chantierOperations.search');
Route::get('/searchOperationsByChantier', [ChantierOperationController::class, 'searchOperationsByChantier'])->name('chantierOperations.searchOperationsByChantier');


Route::resource ('chantierOperationReels' , ChantierOperationReelController::class);
Route::get('chantierOperationReel/search', [ChantierOperationReelController::class, 'search'])->name('chantierOperationReels.search');
Route::get('getOperationsExecute/{id}', [ChantierOperationReelController::class, 'getOperationsExecute'])->name('getOperationsExecute');

Route::get('chantierOperationReels/showOperations/{chantier}', [ChantierOperationReelController::class, 'showOperations'])->name('chantierOperationReels.showOperations');
Route::get('chantierOperationReels/editOperations/{chantier}', [ChantierOperationReelController::class, 'editOperations'])->name('chantierOperationReels.editOperations');
Route::get('chantierOperationReels/updateOperations/{chantier}', [ChantierOperationReelController::class, 'updateOperations'])->name('chantierOperationReels.updateOperations');
Route::delete('chantierOperationReels/destroyChantierOperations/{chantier}', [ChantierOperationReelController::class, 'destroyChantierOperations'])->name('chantierOperationReels.destroyChantierOperations');


Route::resource ('chantierPersonnels' , ChantierPersonnelController::class);
Route::get('chantierPersonnel/search', [ChantierPersonnelController::class, 'search'])->name('chantierPersonnels.search');


Route::resource ('commandeMateriaus' , CommandeMateriauController::class);
Route::get('commandeMateriau/search', [CommandeMateriauController::class, 'search'])->name('commandeMateriaus.search');
Route::get('commandeMateriau/searchMateriauxByCommande', [CommandeMateriauController::class, 'searchMateriauxByCommande'])->name('commandeMateriaus.searchMateriauxByCommande');


//Route::get('/chantiersbymateriel/{id}', [ChantierController::class, 'getAllChantierByMateriel'])->name('chantiers.getAllChantierByMateriel');
//Route::get('/materielsbychantier/{id}', [ChantierController::class, 'getAllMaterielByChantier'])->name('chantiers.getAllMaterielByChantier');

//Route::get('/search', [Controller::class, 'search'])->name('sidebar.search');

Route::get('/chantiersbychantiermateriel/{id}', [ChantierMaterielController::class, 'getAllChantierByChantierMateriel'])->name('chantierMateriels.getAllChantierByChantierMateriel');
Route::get('/materielsbychantiermateriel/{id}', [ChantierMaterielController::class, 'getAllMaterielByChantierMateriel'])->name('chantierMateriels.getAllMaterielByChantierMateriel');

Route::get('/getMateriaux/{id}', [CommandeController::class, 'getMateriaux'])->name('commandes.getMateriaux');
Route::get('/listeCommandes/{id}', [CommandeController::class, 'listeCommandes'])->name('commandes.listeCommandes');
Route::get('/ListeCommandeChantier', [ChantierController::class, 'ListeCommandeChantier'])->name('chantiers.ListeCommandeChantier');

Route::get('/getCommandes/{id}', [FournisseurController::class, 'getCommandes'])->name('fournisseurs.getCommandes');

Route::get('/getMateriels/{id}', [ChantierController::class, 'getMateriels'])->name('chantiers.getMateriels');
Route::get('/getOperations/{id}', [ChantierController::class, 'getOperations'])->name('chantiers.getOperations');
Route::get('/getFrais', [ChantierController::class, 'getFrais'])->name('chantiers.getFrais');
Route::get('/getPersonnels/{id}', [ChantierController::class, 'getPersonnels'])->name('chantiers.getPersonnels');

Route::get('/getFrais/{id}', [FraisController::class, 'getFrais'])->name('frais.getFrais');

Route::get('commandeMateriaus/showMateriaux/{commande}', [CommandeMateriauController::class, 'showMateriaux'])->name('commandeMateriaus.showMateriaux');
Route::get('commandeMateriaus/editMateriaux/{commande}', [CommandeMateriauController::class, 'editMateriaux'])->name('commandeMateriaus.editMateriaux');
Route::get('commandeMateriaus/updateMateriaux/{commande}', [CommandeMateriauController::class, 'updateMateriaux'])->name('commandeMateriaus.updateMateriaux');
Route::delete('commandeMateriaus/destroyCommandeMateriaux/{commande}', [CommandeMateriauController::class, 'destroyCommandeMateriaux'])->name('commandeMateriaus.destroyCommandeMateriaux');


Route::get('chantierOperations/showOperations/{chantier}', [ChantierOperationController::class, 'showOperations'])->name('chantierOperations.showOperations');
Route::get('chantierOperations/editOperations/{chantier}', [ChantierOperationController::class, 'editOperations'])->name('chantierOperations.editOperations');
Route::get('chantierOperations/updateOperations/{chantier}', [ChantierOperationController::class, 'updateOperations'])->name('chantierOperations.updateOperations');
Route::delete('chantierOperations/destroyChantierOperations/{chantier}', [ChantierOperationController::class, 'destroyChantierOperations'])->name('chantierOperations.destroyChantierOperations');

Route::get('chantierMateriels/showMateriels/{chantier}', [ChantierMaterielController::class, 'showMateriels'])->name('chantierMateriels.showMateriels');
Route::get('chantierMateriels/editMateriels/{chantier}', [ChantierMaterielController::class, 'editMateriels'])->name('chantierMateriels.editMateriels');
Route::get('chantierMateriels/updateMateriels/{chantier}', [ChantierMaterielController::class, 'updateMateriels'])->name('chantierMateriels.updateMateriels');
Route::delete('chantierMateriels/destroyChantierMateriels/{chantier}', [ChantierMaterielController::class, 'destroyChantierMateriels'])->name('chantierMateriels.destroyChantierMateriels');

Route::get('chantierPersonnels/showPersonnels/{chantier}', [ChantierPersonnelController::class, 'showPersonnels'])->name('chantierPersonnels.showPersonnels');
Route::get('chantierPersonnels/editPersonnels/{chantier}', [ChantierPersonnelController::class, 'editPersonnels'])->name('chantierPersonnels.editPersonnels');
Route::get('chantierPersonnels/updatePersonnels/{chantier}', [ChantierPersonnelController::class, 'updatePersonnels'])->name('chantierPersonnels.updatePersonnels');
Route::delete('chantierPersonnels/destroyChantierPersonnels/{chantier}', [ChantierPersonnelController::class, 'destroyChantierPersonnels'])->name('chantierPersonnels.destroyChantierPersonnels');

Route::get('chantierQualifications/showQualifications/{chantier}', [ChantierQualificationController::class, 'showQualifications'])->name('chantierQualifications.showQualifications');
Route::get('chantierQualifications/editQualifications/{chantier}', [ChantierQualificationController::class, 'editQualifications'])->name('chantierQualifications.editQualifications');
Route::get('chantierQualifications/updateQualifications/{chantier}', [ChantierQualificationController::class, 'updateQualifications'])->name('chantierQualifications.updateQualifications');
Route::delete('chantierQualifications/destroyChantierQualifications/{chantier}', [ChantierQualificationController::class, 'destroyChantierQualifications'])->name('chantierQualifications.destroyChantierQualifications');

Route::get('chantierNatureFrais/showNatureFrais/{chantier}', [ChantierNatureFraisController::class, 'showNatureFrais'])->name('chantierNatureFrais.showNatureFrais');
Route::get('chantierQualifications/editNatureFrais/{chantier}', [ChantierNatureFraisController::class, 'editNatureFrais'])->name('chantierNatureFrais.editNatureFrais');
Route::get('chantierNatureFrais/updateNatureFrais/{chantier}', [ChantierNatureFraisController::class, 'updateNatureFrais'])->name('chantierNatureFrais.updateNatureFrais');
Route::delete('chantierNatureFrais/destroyChantierNatureFrais/{chantier}', [ChantierNatureFraisController::class, 'destroyChantierNatureFrais'])->name('chantierNatureFrais.destroyChantierNatureFrais');



Route::get('/listeMateriauxCommande', [CommandeController::class, 'listeMateriauxCommande'])->name('commandes.listeMateriauxCommande');
Route::get('/listeOperationsChantier', [ChantierController::class, 'listeOperationsChantier'])->name('chantiers.listeOperationsChantier');
Route::get('/listeMaterielsChantier', [ChantierController::class, 'listeMaterielsChantier'])->name('chantiers.listeMaterielsChantier');
Route::get('/listeCommandesFournisseur', [FournisseurController::class, 'listeCommandesFournisseur'])->name('fournisseurs.listeCommandesFournisseur');
Route::get('/listeFraisChantier', [ChantierController::class, 'listeFraisChantier'])->name('chantiers.listeFraisChantier');
Route::get('/listePersonnelsChantier', [ChantierController::class, 'listePersonnelsChantier'])->name('chantiers.listePersonnelsChantier');
Route::get('/listeFraisEstime', [ChantierController::class, 'listeFraisEstime'])->name('chantiers.listeFraisEstime');


Route::get('/EtatsRealisationOperation', [OperationController::class, 'EtatsRealisationOperation'])->name('operations.EtatsRealisationOperation');
Route::get('/getEtatsRealisation', [OperationController::class, 'getEtatsRealisation'])->name('operations.getEtatsRealisation');



Route::get('/listeDecomptesChantier', [ChantierController::class, 'listeDecomptesChantier'])->name('chantiers.listeDecomptesChantier');
Route::get('/getDecomptes/{id}', [ChantierController::class, 'getDecomptes'])->name('chantiers.getDecomptes');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/help', [App\Http\Controllers\HomeController::class, 'help'])->name('help');


Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'authenticate'])->name('login.authenticate');


Route::get('/DetailPrixSalaires', [ChantierController::class, 'DetailPrixSalaires'])->name('chantiers.DetailPrixSalaires');
Route::get('/DetailPrixSalairesChantier', [ChantierController::class, 'DetailPrixSalairesChantier'])->name('chantiers.DetailPrixSalairesChantier');
Route::get('/DetailPrixSalaireCharts/{id}', [ChantierController::class, 'DetailPrixSalaireCharts'])->name('chantiers.DetailPrixSalaireCharts');


Route::get('/DetailPrixMateriel/{id}', [ChantierMaterielController::class, 'DetailPrixMateriel'])->name('chantierMateriels.DetailPrixMateriel');
Route::get('/DetailPrixMaterielChantier', [ChantierMaterielController::class, 'DetailPrixMaterielChantier'])->name('chantierMateriels.DetailPrixMaterielChantier');

Route::get('/DetailPrixMateriaux/{id}', [CommandeMateriauController::class, 'DetailPrixMateriaux'])->name('commandesMateriaus.DetailPrixMateriaux');
Route::get('/DetailPrixMateriauxByChantier', [ChantierController::class, 'DetailPrixMateriauxByChantier'])->name('chantiers.DetailPrixMateriauxByChantier');



Route::get('/DetailFraisGeneraux/{id}', [ChantierController::class, 'DetailFraisGeneraux'])->name('chantiers.DetailFraisGeneraux');
Route::get('/DetailFraisGeneraux', [ChantierController::class, 'DetailFraisGenerauxChantier'])->name('chaniers.DetailFraisGenerauxChantier');


Route::get('/EtatMarche/{id}', [ChantierController::class, 'EtatMarche'])->name('chantiers.EtatMarche');
Route::get('/EtatMarchesByChantier', [ChantierController::class, 'EtatMarchesByChantier'])->name('chaniers.EtatMarchesByChantier');

Route::get('chantier/searchChantier', [ChantierController::class, 'searchChantier'])->name('chantiers.searchChantier');

Route::get('/BilanChantier', [ChantierController::class, 'BilanChantier'])->name('chantiers.BilanChantier');
Route::get('/getBilan', [ChantierController::class, 'getBilan'])->name('chantiers.getBilan');
Route::get('/BilanChantierCharts/{id}', [ChantierController::class, 'BilanChantierCharts'])->name('chantiers.BilanChantierCharts');

Route::resource ('roles' , RoleController::class);

//Route::get('/getOperationsChantier', [DecompteController::class, 'getOperationsChantier'])->name('getOperationsChantier');

Route::get('getOperationsChantier/{id}', [DecompteController::class, 'getOperationsChantier'])->name('decomptes.getOperationsChantier');

Route::get('/DiffDureeEstimeReelMat/{id}', [ChantierMaterielController::class, 'DiffDureeEstimeReelMat'])->name('chantierMateriels.DiffDureeEstimeReelMat');
Route::get('/ListeChantiersMat', [ChantierMaterielController::class, 'ListeChantiersMat'])->name('chantierMateriels.ListeChantiersMat');

Route::get('/DiffDureeEstimeReel/{id}', [ChantierPersonnelController::class, 'DiffDureeEstimeReel'])->name('chantierPersonnels.DiffDureeEstimeReel');
Route::get('/ListeChantiers', [ChantierPersonnelController::class, 'ListeChantiers'])->name('chantierPersonnels.ListeChantiers');

Route::get('/DiffEstimeReel/{id}', [ChantierOperationController::class, 'DiffEstimeReel'])->name('chantierOperations.DiffEstimeReel');
Route::get('/ListeChantiersOper', [ChantierOperationController::class, 'ListeChantiersOper'])->name('chantierOperations.ListeChantiersOper');

