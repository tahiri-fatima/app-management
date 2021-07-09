<!DOCTYPE html>
<html >

<head>
    <title>Dashboard</title>
    <!-- Favicon icon -->
    <!-- Google font-->
    <!-- waves.css -->
    <link rel="stylesheet" href="{{ asset('assets/pages/waves/css/waves.min.css') }}" type="text/css" media="all">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap/css/bootstrap.min.css') }}">
    <!-- waves.css -->
    <link rel="stylesheet" href=" {{ asset('assets/pages/waves/css/waves.min.css') }} " type="text/css" media="all">
    <!-- themify icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/icon/themify-icons/themify-icons.css') }}">
    <!-- font-awesome-n -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome-n.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <!-- scrollbar.css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.mCustomScrollbar.css') }}">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}"  media="screen" >
    <!-- Impression.css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/impression.css') }}" media="print">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


    <script type="text/javascript" src=" {{ asset('assets/js/jquery/jquery.min.js') }} "></script>
    <script type="text/javascript" src=" {{ asset('assets/js/jquery-ui/jquery-ui.min.js') }} "></script>
    <script type="text/javascript" src="{{ asset('assets/js/popper.js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap/js/bootstrap.min.js') }} "></script>
    <!-- waves js -->
    <script src="{{ asset('assets/pages/waves/js/waves.min.js') }}"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="{{ asset('assets/js/jquery-slimscroll/jquery.slimscroll.js') }}"></script>

    <!-- slimscroll js -->
    <script src="{{ asset('assets/js/jquery.mCustomScrollbar.concat.min.js') }} "></script>

    <!-- menu js -->
    <script src="{{ asset('assets/js/pcoded.min.js') }}"></script>
    <script src="{{ asset('assets/js/vertical/vertical-layout.min.js') }} "></script>

    <script type="text/javascript" src="{{ asset('assets/js/script.js') }} "></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>



</head>

<body>
    <!-- Pre-loader start -->
    
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        

            <div class="pcoded-main-container">
 
                        <!-- Page-header start -->
                        <div class="page-header">
                            <div class="page-block">
                                <div class="row align-items-center">
                                    
                                    <div class="col-md-8">
                                    
                                        <div class="page-header-title">
                                            <h5 class="m-b-10 m-l-20">
                                            <?php

                        use App\Models\Personnel;
                        use Illuminate\Support\Facades\Auth;
                        use Illuminate\Support\Facades\Request;

                                        $route = Request::route()->getName();

                                            if($route == ""){
                                                $page = "Page d'accueil";
                                            }
                                            elseif($route == "chantiers.EtatMarche"){
                                                $page = "Etat du Marche";
                                            }
                                            elseif($route == "chaniers.EtatMarchesByChantier"){
                                                $page = "Etat du Marche";
                                            }
                                            elseif($route == "chantiers.DetailFraisGeneraux"){
                                                $page = "Détail des frais généraux";
                                            }
                                            elseif($route == "chaniers.DetailFraisGenerauxChantier"){
                                                $page = "Détail des frais généraux";
                                            }
                                            elseif($route == "chantiers.BilanChantier"){
                                                $page = "Bilan du chantier en cour";
                                            }
                                            elseif($route == "chantiers.BilanChantierCharts"){
                                                $page = "Graphes de Bilan du chantier en cour";
                                            }
                                            elseif($route == "chantiers.getBilan"){
                                                $page = "Bilan du chantier en cour";
                                            }
                                            elseif($route == "fournisseurs.listeCommandesFournisseur"){
                                                $page = "Liste des fournisseurs";
                                            }elseif($route == "chantiers.listeMaterielsChantier"){
                                                $page = "Liste des chantiers";
                                            }elseif($route == "chantiers.listeDecomptesChantier"){
                                                $page = "Liste des chantiers";
                                            }elseif($route == "chantiers.listePersonnelsChantier"){
                                                $page = "Liste des chantiers";
                                            }elseif($route == "chantiers.listeOperationsChantier"){
                                                $page = "Liste des chantiers";
                                            }elseif($route == "commandes.listeMateriauxCommande"){
                                                $page = "Liste des commandes";
                                            }elseif($route == "commandesMateriaus.DetailPrixMateriaux"){
                                                $page = "Détail des prix élémentaires des matériaux consommables";
                                            }
                                            elseif($route == "chantiers.DetailPrixMateriauxByChantier"){
                                                $page = "Liste des chantiers";
                                            }
                                            elseif($route == "chantiers.DetailPrixSalairesChantier"){
                                                $page = "Détail des prix élémentaires des salaires";
                                            }
                                            elseif($route == "chantierMateriels.DetailPrixMateriel"){
                                                $page = "Détail des prix élémentaires des matériels";
                                            }
                                            elseif($route == "chantierMateriels.DetailPrixMaterielChantier"){
                                                $page = "Détail des prix élémentaires des matériels";
                                            }
                                            elseif($route == "chantiers.DetailPrixSalaires"){
                                                $page = "Détail des prix élémentaires des salaires";
                                            }
                                            elseif($route == "chantiers.DetailPrixSalaireCharts"){
                                                $page = "Graphes des Détails des prix élémentaires des salaires";
                                            }
                                            elseif($route == "chantiers.ListeCommandeChantier"){
                                                $page = "Liste des chanties";
                                            }elseif($route == "commandes.listeCommandes"){
                                                    $page = "Liste des commandes";
                                            }elseif($route == "operations.EtatsRealisationOperation"){
                                                $page = "Liste des opérations";
                                            }elseif($route == "chantiers.listeFraisChantier"){
                                                $page = "Liste des chantiers";
                                            }elseif($route == "chantiers.listeFraisEstime"){
                                                $page = "Liste des chantiers";
                                            }elseif($route == "chantiers.getMateriels"){
                                                $page = "Liste des matériels de chantier";
                                            }elseif($route == "chantiers.getDecomptes"){
                                                $page = "Liste des décomptes de chantier";
                                            }elseif($route == "chantiers.getPersonnels"){
                                                $page = "Liste des personnels de chantier";
                                            }elseif($route == "chantiers.getOperations"){
                                                $page = "Liste des opérations de chantier";
                                            }elseif($route == "commandes.getMateriaux"){
                                                $page = "Liste des Matériaux de commande";
                                            }elseif($route == "fournisseurs.getCommandes"){
                                                $page = "Liste des commandes de fournisseur";
                                            }elseif($route == "chantiers.getFrais"){
                                                $page = "Liste des frais de chantier";
                                            }elseif($route == "frais.getFrais"){
                                                $page = "Liste d'estimation des frais de chantier";
                                            }elseif($route == "operations.getEtatsRealisation"){
                                                $page = "Liste des états de la réalisation d'opération";
                                            }
                                            elseif($route == "login"){
                                                $page = "Se connnecter";
                                            }
                                            elseif($route == "register"){
                                                $page = "Inscrire";
                                            }elseif($route == "home"){
                                                $page = "ACCUEIL";
                                            }
                                            elseif($route == "chantierMateriels.DiffDureeEstimeReelMat"){
                                                $page = "La difference entre la durée estimée de service des matériels et la durée réelle";
                                            }elseif($route == "chantierMateriels.ListeChantiersMat"){
                                                $page = "Liste des chantiers";
                                            }
                                            elseif($route == "chantierPersonnels.DiffDureeEstimeReel"){
                                                $page = "La difference entre la durée estimée d'affectation des personnels et la durée réelle";
                                            }elseif($route == "chantierPersonnels.ListeChantiers"){
                                                $page = "Liste des chantiers";
                                            }
                                            elseif($route == "chantierOperations.DiffEstimeReel"){
                                                $page = "La difference entre les valeurs estimées et les valeurs réelles associée des aux opértions";
                                            }elseif($route == "chantierOperations.ListeChantiersOper"){
                                                $page = "Liste des chantiers";
                                            }

                                            ?>
                                            {{$page}}
                                        </h5>
                                            <p class="m-b-0"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="nav-right breadcrumb" >
                                            <li class="breadcrumb-item m-r-15" >
                                                <a href="{{route('home')}}">ACCUEIL <i class="fa fa-home"></i>  </a>
                                            </li>
                                            @guest
                                                @if (Route::has('login'))
                                                    <li class="">
                                                        <a  href="{{ route('login') }}">  {{ __('LOGIN') }} <i class="fa fa-sign-in" ></i></a>
                                                    </li>
                                                @endif
                                       
                                            @else
                                                <li class="  user-profile header-notification">
                                                    <a class=" dropdown-toggle " href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                        <?php $id = Auth::id(); 
                                                        $personnel = Personnel::where('id', '=', $id)->first();
                                                        ?> {{ $personnel->nom_personne }} {{ $personnel->prenom_personne }}
                                                    </a>

                                                    <div class="dropdown-menu dropdown-menu-right" >
                                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                                        onclick="event.preventDefault();
                                                                        document.getElementById('logout-form').submit();">
                                                            Déconnexion
                                                        </a>

                                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                            @csrf
                                                        </form>
                                                    </div>
                                                </li> 
                                            @endguest
                                            
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="page-body">
                        @yield('content') 

                        </div>

            </div>
        </div>
        
    </div>
    <div style="margin-top:50px;">
   

    </div>



</body>

</html>


