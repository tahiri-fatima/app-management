<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Page d'accuiel</title>
  <meta content="" name="description">
  <meta content="" name="keywords">



<!-- Vendor CSS Files -->
<link href="assets/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/css/boxicons/css/boxicons.min.css" rel="stylesheet">
<link href="assets/css/owl/owl.carousel.min.css" rel="stylesheet">
<link href="assets/css/venobox/venobox.css" rel="stylesheet">
<link href="assets/css/aos.css" rel="stylesheet">

    <!-- Required Fremwork -->
    <!-- waves.css -->
    <!-- themify icon -->
    <!-- font-awesome-n -->
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome-n.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <!-- scrollbar.css -->
  <!-- Template Main CSS File -->
  <link href="assets/css/home.css" rel="stylesheet">
  

  <!-- =======================================================
  * Template Name: Regna - v2.2.1
  * Template URL: https://bootstrapmade.com/regna-bootstrap-onepage-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header-transparent">
    <div class="container" style="margin-top: 0px">

      <div id="logo" class="pull-left" >
        <a href="/home"><img src="assets/images/logo.png" alt="" Style="width: 100px; height:50px; "></a>
        <!-- Uncomment below if you prefer to use a text logo -->
        <!--<h1><a href="#hero">Regna</a></h1>-->
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active"><a href="home">Home</a></li>
          <li><a href="#gestion">Gestion des données</a></li>
          <li><a href="#edition">Gestion des éditions</a></li>
          <li><a href="#tableau">Tableaux de bord</a></li>
          <li><a href="help">Aide</a></li>
          
          <li class="menu-has-children " >
            <a href="#"  >
                <?php
                use App\Models\Personnel;
                use Illuminate\Support\Facades\Auth;

                $id = Auth::id(); 
                $personnel = Personnel::where('id', '=', $id)->first();
                ?> {{ $personnel->nom_personne }} {{ $personnel->prenom_personne }}
            </a>

              <ul class="dropdown-menu dropdown-menu-right" >
                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        Déconnexion
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
              </ul>
          </li> 
       
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- End Header -->


  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div class="hero-container" data-aos="zoom-in" data-aos-delay="100">
      <h1>Welcome </h1>
      <a href="#gestion" class="btn-get-started">Commencer</a>
    </div>
  </section><!-- End Hero Section -->

  <main id="main" >

    <!-- ======= Gestion Section ======= -->
    <section id="gestion" class="sous-menu">
      <div class="container" data-aos="fade-up">
      <div class="section-header">
          <h3 class="section-title">Gestion des données</h3>
          <p class="section-description">Vous pouvez gérer les données de l'application à partir de ce menu.</p>
        </div>
      
          <div class="row justify-content-around" id="gestion-menu" >
          <a href="/acomptes" class="btn btn-primary">Acompte</a>
          <a href="/avenants" class="btn btn-primary">Avenant</a>
          <a href="/chantiers" class="btn btn-primary">Chantier</a>
          <a href="/commandes" class="btn btn-primary">Commande</a>
          <a href="/consommationMateriels" class="btn btn-primary">Consommation matériel</a>
          <a href="/decomptes" class="btn btn-primary">Décompte</a>
          <a href="/factures" class="btn btn-primary">Facture</a>
          <a href="/fournisseurs" class="btn btn-primary">Fournisseur</a>
          <a href="/frais" class="btn btn-primary">Frais</a>
          <a href="/materiaus" class="btn btn-primary">Matériau</a>
          <a href="/materiels" class="btn btn-primary">Matériel</a>
          <a href="/natureFrais" class="btn btn-primary">Nature du frais</a>
          <a href="/operations" class="btn btn-primary">Opération</a>
          <a href="/ordreServices" class="btn btn-primary">Ordre de Service</a>
          <a href="/personnels" class="btn btn-primary">Personnel</a>
          <a href="/qualifications" class="btn btn-primary">Qualification</a>
          @can('role-list')
          <a href="/roles" class="btn btn-primary">Rôle</a>
          @endcan
          <a href="/soutraitances" class="btn btn-primary">Sous traitance</a>
          <a href="/chantierMateriels" class="btn btn-primary">Chantier-Matériels</a>
          <a href="/chantierNatureFrais" class="btn btn-primary">Chantier-Nature du frais</a>
          <a href="/chantierOperations" class="btn btn-primary">Chantier-Opérations</a>
          <a href="/chantierOperationReels" class="btn btn-primary">Exécuton des Opérations </a>
          <a href="/chantierPersonnels" class="btn btn-primary">Chantier-Personnels</a>
          <a href="/chantierQualifications" class="btn btn-primary">Chantier-Qualifications</a>
          <a href="/commandeMateriaus" class="btn btn-primary">Commande-matériaux</a>
        </div>


          
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= edition Section ======= -->
    <section id="edition" class="sous-menu" >
      <div class="container" data-aos="fade-up">
        <div class="section-header">
          <h3 class="section-title">Gestion des éditions</h3>
          <p class="section-description">Vous pouvez accéder à les traces d'application à partir de ce menu</p>
        </div>
        
     
          <div class="row justify-content-around" id="edition-menu">
          <a href=" {{ route('chantiers.ListeCommandeChantier') }} " class="btn btn-primary">Liste des commandes</a>
          <a href="{{ route('commandes.listeMateriauxCommande') }}" class="btn btn-primary">Matériaux des commandes</a>
          <a href="{{ route('chantiers.listeMaterielsChantier') }}" class="btn btn-primary">Matériels des chantiers</a>
          <a href="{{ route('chantiers.listeOperationsChantier') }}" class="btn btn-primary">Opérations des chantiers</a>
          <a href="{{ route('chantiers.listeFraisChantier') }}" class="btn btn-primary">Frais des Chantiers</a>
          <a href="{{ route('chantiers.listeFraisEstime') }}" class="btn btn-primary">Estimation des frais</a>
          <a href="{{ route('chantiers.listePersonnelsChantier') }}" class="btn btn-primary">Personnels des chantiers</a>
          <a href="{{ route('chantiers.listeDecomptesChantier') }}" class="btn btn-primary">Décomptes des chantiers</a>
          <a href="{{ route('chantiers.BilanChantier') }}" class="btn btn-primary">Bilan chantier</a>
          <a href="{{ route('fournisseurs.listeCommandesFournisseur') }}" class="btn btn-primary">Commandes des fournisseurs</a>
          <a href="{{ route('operations.EtatsRealisationOperation') }}" class="btn btn-primary">Etats de réalisation opération</a>
          <a href="{{ route('chaniers.DetailFraisGenerauxChantier') }}" class="btn btn-primary">Détail des frais généraux</a>
          <a href="{{ route('chaniers.EtatMarchesByChantier')}}" class="btn btn-primary">Etat des marches</a>

          <div>
            <a class="btn btn-primary has-children" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Détail des prix élémentaires
            </a>
            <div class="menu-has-children" >
              <ul class="dropdown-menu dropdown-menu-right">
                <li><a class="dropdown-item btn btn-primary"  href=" {{ route('chantierMateriels.DetailPrixMaterielChantier') }}">Des Matériels consommables</a></li>
                <li><a class="dropdown-item btn btn-primary" href=" {{ route('chantiers.DetailPrixSalairesChantier') }}">Des salaires</a></li>
                <li><a class="dropdown-item btn btn-primary" href=" {{ route('chantiers.DetailPrixMateriauxByChantier') }}">Des matériaux consommables</a></li>
              </ul>
            </div>
          </div>

          <div>
            <a class="btn btn-primary " href="#" role="button" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Estimation VS Réelle
            </a>

            <div class="menu-has-children" >
              <ul class="dropdown-menu dropdown-menu-right">
                <li  ><a class="dropdown-item btn btn-primary" style="height: 73px;" href=" {{ route('chantierMateriels.ListeChantiersMat') }}"> <div> Difference Durée </div> <div> de service Matériel </div></a></li>
                <li><a class="dropdown-item btn btn-primary" style="height: 73px;" href="{{ route('chantierPersonnels.ListeChantiers') }}"><div>Difference Durée </div> <div> d'afféctation des personnels </div></a></li>
                <li><a class="dropdown-item btn btn-primary" style="height: 73px;" href="{{ route('chantierOperations.ListeChantiersOper') }} "><div>Quantité de réalisation </div> <div> des opérations </div></a></li>
              </ul>
            </div>
          </div>
          


        </div>

      </div>
    </section><!-- End Facts Section -->

     <!-- ======= Tableau de bord Section ======= -->
     <section id="tableau" class="sous-menu" >
      <div class="container" data-aos="fade-up">
      <div class="section-header">
          <h3 class="section-title">Tableau de bord</h3>
          <p class="section-description"></p>
      </div>

          <div class="row justify-content-around" id="tableau-menu">
            <a href="{{ route('chantiers.BilanChantier') }}" class="btn btn-primary">Graphes du Bilan chantier</a>
            <a  href=" {{ route('chantiers.DetailPrixSalairesChantier') }}" style="width: 450px;" class="btn btn-primary">Détail des prix élémentaires des salaires</a>

          </div>

        </div>
      
    


          
        </section><!-- End tableau Section -->
      </div>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">

      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!--
        All the links in the footer should remain intact.
        You can delete the links only if you purchased the pro version.
        Licensing information: https://bootstrapmade.com/license/
        Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Regna
      -->
        Designed by <a href="">La Route Centrale</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/js/jquery/jquery.min.js"></script>
  <script src="assets/js/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/js/php-email-form/validate.js"></script>
  <script src="assets/js/counterup/counterup.min.js"></script>
  <script src="assets/js/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/js/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/js/superfish/superfish.min.js"></script>
  <script src="assets/js/hoverIntent/hoverIntent.js"></script>
  <script src="assets/js/owl.carousel.min.js"></script>
  <script src="assets/js/venobox/venobox.min.js"></script>
  <script src="assets/js/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>