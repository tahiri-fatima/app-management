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
Route::get('personnel/gotoIndex', [PersonnelController::class, 'gotoIndex'])->name('personnels.gotoIndex');
Route::get('personnel/gestionForm', [PersonnelController::class, 'gestionForm'])->name('personnels.gestionForm');
Route::get('personnel/destroyPersonnel/{personnel}', [PersonnelController::class, 'destroyPersonnel'])->name('personnels.destroyPersonnel');
//Route::get('personnel/search', 'PersonnelController@search')->name('personnels.search');

Route::resource ('materiels' , MaterielController::class);
Route::get('materielmateriel/gotoIndex', [MaterielController::class, 'gotoIndex'])->name('materiels.gotoIndex');
Route::get('materielmateriel/gestionForm', [MaterielController::class, 'gestionForm'])->name('materiels.gestionForm');
Route::get('materielmateriel/destroyMateriel/{materielmateriel}', [MaterielController::class, 'destroyMateriel'])->name('materiels.destroyMateriel');

Route::resource ('consommationMateriels' , ConsommationMaterielController::class);
Route::get('consommationMateriel/gotoIndex', [ConsommationMaterielController::class, 'gotoIndex'])->name('consommationMateriels.gotoIndex');
Route::get('consommationMateriel/gestionForm', [ConsommationMaterielController::class, 'gestionForm'])->name('consommationMateriels.gestionForm');
Route::get('consommationMateriel/destroyConsommationMateriel/{consommationMateriel}', [ConsommationMaterielController::class, 'destroyConsommationMateriel'])->name('consommationMateriels.destroyConsommationMateriel');

Route::resource ('decomptes' , DecompteController::class);
Route::get('decompte/gotoIndex', [DecompteController::class, 'gotoIndex'])->name('decomptes.gotoIndex');
Route::get('decompte/gestionForm', [DecompteController::class, 'gestionForm'])->name('decomptes.gestionForm');
Route::get('decompte/destroyDecompte/{decompte}', [DecompteController::class, 'destroyDecompte'])->name('decomptes.destroyDecompte');

Route::resource ('frais' , FraisController::class);
Route::get('frai/gotoIndex', [FraisController::class, 'gotoIndex'])->name('frais.gotoIndex');
Route::get('frai/gestionForm', [FraisController::class, 'gestionForm'])->name('frais.gestionForm');
Route::get('frai/destroyFrais/{frai}', [FraisController::class, 'destroyFrais'])->name('frais.destroyFrais');

Route::resource ('natureFrais' , NatureFraisController::class);
Route::get('natureFrai/gotoIndex', [NatureFraisController::class, 'gotoIndex'])->name('natureFrais.gotoIndex');
Route::get('natureFrai/gestionForm', [NatureFraisController::class, 'gestionForm'])->name('natureFrais.gestionForm');
Route::get('natureFrai/destroyNatureFrais/{natureFrai}', [NatureFraisController::class, 'destroyNatureFrais'])->name('natureFrais.destroyNatureFrais');

Route::resource ('ordreServices' , OrdreServiceController::class);
Route::get('ordreService/gotoIndex', [OrdreServiceController::class, 'gotoIndex'])->name('ordreServices.gotoIndex');
Route::get('ordreService/gestionForm', [OrdreServiceController::class, 'gestionForm'])->name('ordreServices.gestionForm');
Route::get('ordreService/destroyOrdreService/{ordreService}', [OrdreServiceController::class, 'destroyOrdreService'])->name('ordreServices.destroyOrdreService');

Route::resource ('soutraitances' , SouTraitanceController::class);
Route::get('soutraitance/gotoIndex', [SouTraitanceController::class, 'gotoIndex'])->name('soutraitances.gotoIndex');
Route::get('soutraitance/gestionForm', [SouTraitanceController::class, 'gestionForm'])->name('soutraitances.gestionForm');
Route::get('soutraitance/destroySoutraitance/{soutraitance}', [SouTraitanceController::class, 'destroySoutraitance'])->name('soutraitances.destroySoutraitance');


Route::resource ('commandes' , CommandeController::class);
Route::get('commande/gotoIndex', [CommandeController::class, 'gotoIndex'])->name('commandes.gotoIndex');
Route::get('commande/gestionForm', [CommandeController::class, 'gestionForm'])->name('commandes.gestionForm');
Route::get('commande/destroyCommande/{commande}', [CommandeController::class, 'destroyCommande'])->name('commandes.destroyCommande');

Route::resource ('materiaus' , MateriauController::class);
Route::get('materiau/gotoIndex', [MateriauController::class, 'gotoIndex'])->name('materiaus.gotoIndex');
Route::get('materiau/gestionForm', [MateriauController::class, 'gestionForm'])->name('materiaus.gestionForm');
Route::get('materiau/destroyMateriau/{materiau}', [MateriauController::class, 'destroyMateriau'])->name('materiaus.destroyMateriau');

Route::resource ('factures' , FactureController::class);
Route::get('facture/gotoIndex', [FactureController::class, 'gotoIndex'])->name('factures.gotoIndex');
Route::get('facture/gestionForm', [FactureController::class, 'gestionForm'])->name('factures.gestionForm');
Route::get('facture/destroyFacture/{facture}', [FactureController::class, 'destroyFacture'])->name('factures.destroyFacture');

Route::resource ('acomptes' , AcompteController::class);
Route::get('acompte/gotoIndex', [AcompteController::class, 'gotoIndex'])->name('acomptes.gotoIndex');
Route::get('acompte/gestionForm', [AcompteController::class, 'gestionForm'])->name('acomptes.gestionForm');
Route::get('acompte/destroyAcompte/{acompte}', [AcompteController::class, 'destroyAcompte'])->name('acomptes.destroyAcompte');


Route::resource ('avenants' , AvenantController::class);
Route::get('avenant/gotoIndex', [AvenantController::class, 'gotoIndex'])->name('avenants.gotoIndex');
Route::get('avenant/gestionForm', [AvenantController::class, 'gestionForm'])->name('avenants.gestionForm');
Route::get('avenant/destroyAvenant/{avenant}', [AvenantController::class, 'destroyAvenant'])->name('avenants.destroyAvenant');

Route::resource ('operations' , OperationController::class);
Route::get('operation/gotoIndex', [OperationController::class, 'gotoIndex'])->name('operations.gotoIndex');
Route::get('operation/gestionForm', [OperationController::class, 'gestionForm'])->name('operations.gestionForm');
Route::get('operation/destroyOperation/{operation}', [OperationController::class, 'destroyOperation'])->name('operations.destroyOperation');
Route::get('operation/searchOperationEtat', [OperationController::class, 'searchOperationEtat'])->name('operations.searchOperationEtat');

Route::resource ('qualifications' , QualificationController::class);
Route::get('qualification/gotoIndex', [QualificationController::class, 'gotoIndex'])->name('qualifications.gotoIndex');
Route::get('qualification/gestionForm', [QualificationController::class, 'gestionForm'])->name('qualifications.gestionForm');
Route::get('qualification/destroyQualification/{qualification}', [QualificationController::class, 'destroyQualification'])->name('qualifications.destroyQualification');

Route::resource ('chantierNatureFrais' , ChantierNatureFraisController::class);
Route::get('chantierNatureFrai/search', [ChantierNatureFraisController::class, 'search'])->name('chantierNatureFrais.search');
Route::get('chantierNatureFrai/gotoIndex', [ChantierNatureFraisController::class, 'gotoIndex'])->name('chantierNatureFrais.gotoIndex');
Route::get('chantierNatureFrai/gestionForm', [ChantierNatureFraisController::class, 'gestionForm'])->name('chantierNatureFrais.gestionForm');
Route::get('chantierNatureFrai/destroychantierNatureFrais/{chantier}', [ChantierNatureFraisController::class, 'destroychantierNatureFrais'])->name('chantierNatureFrais.destroychantierNatureFrais');

Route::resource ('chantierQualifications' , ChantierQualificationController::class);
Route::get('chantierQualification/search', [ChantierQualificationController::class, 'search'])->name('chantierQualifications.search');
Route::get('chantierQualification/gotoIndex', [ChantierQualificationController::class, 'gotoIndex'])->name('chantierQualifications.gotoIndex');
Route::get('chantierQualification/gestionForm', [ChantierQualificationController::class, 'gestionForm'])->name('chantierQualifications.gestionForm');
Route::get('chantierQualification/destroyChantierQualification/{chantier}', [ChantierQualificationController::class, 'destroyChantierQualification'])->name('chantierQualifications.destroyChantierQualification');




Route::resource ('fournisseurs' , FournisseurController::class);
Route::get('fournisseur/gotoIndex', [FournisseurController::class, 'gotoIndex'])->name('fournisseurs.gotoIndex');
Route::get('fournisseur/gestionForm', [FournisseurController::class, 'gestionForm'])->name('fournisseurs.gestionForm');
Route::get('fournisseur/destroyFournisseur/{fournisseur}', [FournisseurController::class, 'destroyFournisseur'])->name('fournisseurs.destroyFournisseur');



Route::resource ('chantiers' , ChantierController::class);
Route::get('chantier/gotoIndex', [ChantierController::class, 'gotoIndex'])->name('chantiers.gotoIndex');
Route::get('chantier/gestionForm', [ChantierController::class, 'gestionForm'])->name('chantiers.gestionForm');
Route::get('chantier/destroyChantier/{chantier}', [ChantierController::class, 'destroyChantier'])->name('chantiers.destroyChantier');
Route::get('chantier/searchChantierPersonnels', [ChantierController::class, 'searchChantierPersonnels'])->name('chantiers.searchChantierPersonnels');
Route::get('chantierPersonnels/searchChantierPersonnels', [ChantierPersonnelController::class, 'searchChantierPersonnels'])->name('chantierPersonnels.searchChantierPersonnels');
Route::get('chantierPersonnels/searchPersonnelsByChantier', [ChantierPersonnelController::class, 'searchPersonnelsByChantier'])->name('chantierPersonnels.searchPersonnelsByChantier');


Route::get('chantierMateriel/searchMaterielsByChantier', [ChantierMaterielController::class, 'searchMaterielsByChantier'])->name('chantierMateriels.searchMaterielsByChantier');
Route::get('/getChantierInfo', [ChantierMaterielController::class, 'getChantierInfo'])->name('chantierMateriels.getChantierInfo');

Route::get('searchMateriauxByChantier', [ChantierController::class, 'searchMateriauxByChantier'])->name('chantiers.searchMateriauxByChantier');



Route::resource ('chantierMateriels' , ChantierMaterielController::class);
Route::get('chantierMateriel/search', [ChantierMaterielController::class, 'search'])->name('chantierMateriels.search');
Route::get('chantierMateriel/gotoIndex', [ChantierMaterielController::class, 'gotoIndex'])->name('chantierMateriels.gotoIndex');
Route::get('chantierMateriel/gestionForm', [ChantierMaterielController::class, 'gestionForm'])->name('chantierMateriels.gestionForm');


Route::resource ('chantierOperations' , ChantierOperationController::class);
Route::get('chantierOperation/search', [ChantierOperationController::class, 'search'])->name('chantierOperations.search');
Route::get('/searchOperationsByChantier', [ChantierOperationController::class, 'searchOperationsByChantier'])->name('chantierOperations.searchOperationsByChantier');
Route::get('chantierOperation/gotoIndex', [ChantierOperationController::class, 'gotoIndex'])->name('chantierOperations.gotoIndex');
Route::get('chantierOperation/gestionForm', [ChantierOperationController::class, 'gestionForm'])->name('chantierOperations.gestionForm');

Route::resource ('chantierOperationReels' , ChantierOperationReelController::class);
Route::get('chantierOperationReel/search', [ChantierOperationReelController::class, 'search'])->name('chantierOperationReels.search');
Route::get('chantierOperationReel/gotoIndex', [ChantierOperationReelController::class, 'gotoIndex'])->name('chantierOperationReels.gotoIndex');
Route::get('chantierOperationReel/gestionForm', [ChantierOperationReelController::class, 'gestionForm'])->name('chantierOperationReels.gestionForm');
Route::get('getOperationsExecute/{id}', [ChantierOperationReelController::class, 'getOperationsExecute'])->name('getOperationsExecute');

Route::get('chantierOperationReels/showOperations/{chantier}', [ChantierOperationReelController::class, 'showOperations'])->name('chantierOperationReels.showOperations');
Route::get('chantierOperationReels/editOperations/{chantier}', [ChantierOperationReelController::class, 'editOperations'])->name('chantierOperationReels.editOperations');
Route::get('chantierOperationReels/updateOperations/{chantier}', [ChantierOperationReelController::class, 'updateOperations'])->name('chantierOperationReels.updateOperations');
Route::get('chantierOperationReels/destroyChantierOperations/{chantier}', [ChantierOperationReelController::class, 'destroyChantierOperations'])->name('chantierOperationReels.destroyChantierOperations');


Route::resource ('chantierPersonnels' , ChantierPersonnelController::class);
Route::get('chantierPersonnel/search', [ChantierPersonnelController::class, 'search'])->name('chantierPersonnels.search');
Route::get('chantierPersonnel/gotoIndex', [ChantierPersonnelController::class, 'gotoIndex'])->name('chantierPersonnels.gotoIndex');
Route::get('chantierPersonnel/gestionForm', [ChantierPersonnelController::class, 'gestionForm'])->name('chantierPersonnels.gestionForm');



Route::resource ('commandeMateriaus' , CommandeMateriauController::class);
Route::get('commandeMateriau/searchMateriauxByCommande', [CommandeMateriauController::class, 'searchMateriauxByCommande'])->name('commandeMateriaus.searchMateriauxByCommande');
Route::get('commandeMateriau/gotoIndex', [CommandeMateriauController::class, 'gotoIndex'])->name('commandeMateriaus.gotoIndex');
Route::get('commandeMateriau/gestionForm', [CommandeMateriauController::class, 'gestionForm'])->name('commandeMateriaus.gestionForm');


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
Route::get('commandeMateriaus/destroyCommandeMateriaux/{commande}', [CommandeMateriauController::class, 'destroyCommandeMateriaux'])->name('commandeMateriaus.destroyCommandeMateriaux');


Route::get('chantierOperations/showOperations/{chantier}', [ChantierOperationController::class, 'showOperations'])->name('chantierOperations.showOperations');
Route::get('chantierOperations/editOperations/{chantier}', [ChantierOperationController::class, 'editOperations'])->name('chantierOperations.editOperations');
Route::get('chantierOperations/updateOperations/{chantier}', [ChantierOperationController::class, 'updateOperations'])->name('chantierOperations.updateOperations');
Route::get('chantierOperations/destroyChantierOperations/{chantier}', [ChantierOperationController::class, 'destroyChantierOperations'])->name('chantierOperations.destroyChantierOperations');

Route::get('chantierMateriels/showMateriels/{chantier}', [ChantierMaterielController::class, 'showMateriels'])->name('chantierMateriels.showMateriels');
Route::get('chantierMateriels/editMateriels/{chantier}', [ChantierMaterielController::class, 'editMateriels'])->name('chantierMateriels.editMateriels');
Route::get('chantierMateriels/updateMateriels/{chantier}', [ChantierMaterielController::class, 'updateMateriels'])->name('chantierMateriels.updateMateriels');
Route::get('chantierMateriels/destroyChantierMateriels/{chantier}', [ChantierMaterielController::class, 'destroyChantierMateriels'])->name('chantierMateriels.destroyChantierMateriels');

Route::get('chantierPersonnels/showPersonnels/{chantier}', [ChantierPersonnelController::class, 'showPersonnels'])->name('chantierPersonnels.showPersonnels');
Route::get('chantierPersonnels/editPersonnels/{chantier}', [ChantierPersonnelController::class, 'editPersonnels'])->name('chantierPersonnels.editPersonnels');
Route::get('chantierPersonnels/updatePersonnels/{chantier}', [ChantierPersonnelController::class, 'updatePersonnels'])->name('chantierPersonnels.updatePersonnels');
Route::get('chantierPersonnels/destroyChantierPersonnels/{chantier}', [ChantierPersonnelController::class, 'destroyChantierPersonnels'])->name('chantierPersonnels.destroyChantierPersonnels');

Route::get('chantierQualifications/showQualifications/{chantier}', [ChantierQualificationController::class, 'showQualifications'])->name('chantierQualifications.showQualifications');
Route::get('chantierQualifications/editQualifications/{chantier}', [ChantierQualificationController::class, 'editQualifications'])->name('chantierQualifications.editQualifications');
Route::get('chantierQualifications/updateQualifications/{chantier}', [ChantierQualificationController::class, 'updateQualifications'])->name('chantierQualifications.updateQualifications');
Route::get('chantierQualifications/destroyChantierQualifications/{chantier}', [ChantierQualificationController::class, 'destroyChantierQualifications'])->name('chantierQualifications.destroyChantierQualifications');

Route::get('chantierNatureFrais/showNatureFrais/{chantier}', [ChantierNatureFraisController::class, 'showNatureFrais'])->name('chantierNatureFrais.showNatureFrais');
Route::get('chantierQualifications/editNatureFrais/{chantier}', [ChantierNatureFraisController::class, 'editNatureFrais'])->name('chantierNatureFrais.editNatureFrais');
Route::get('chantierNatureFrais/updateNatureFrais/{chantier}', [ChantierNatureFraisController::class, 'updateNatureFrais'])->name('chantierNatureFrais.updateNatureFrais');
Route::get('chantierNatureFrais/destroyChantierNatureFrais/{chantier}', [ChantierNatureFraisController::class, 'destroyChantierNatureFrais'])->name('chantierNatureFrais.destroyChantierNatureFrais');



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

