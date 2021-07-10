<!DOCTYPE html>
<html >

<head>
    <title></title>
    <meta charset="utf-8">
 
    <!-- ajax js -->
    
    <!-- Favicon icon -->
    <link rel="icon" href="#" type="image/x-icon">
    <!-- waves.css -->
    <link rel="stylesheet" href="{{ asset('assets/pages/waves/css/waves.min.css') }}" type="text/css" media="all">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap/css/bootstrap.min.css') }}">
    <!-- waves.css -->
    <link rel="stylesheet" href="{{ asset('assets/pages/waves/css/waves.min.css') }}" type="text/css" media="all">
    <!-- themify icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/icon/themify-icons/themify-icons.css') }}">
    <!-- font-awesome-n -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome-n.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <!-- scrollbar.css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.mCustomScrollbar.css') }}">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    
   
  
 <!-- Required Jquery -->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery-ui/jquery-ui.min.js')}} "></script>
    <script type="text/javascript" src="{{ asset('assets/js/popper.js/popper.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap/js/bootstrap.min.js ')}}"></script>
    <!-- waves js -->
    <script src="{{ asset('assets/pages/waves/js/waves.min.js')}}"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="{{ asset('assets/js/jquery-slimscroll/jquery.slimscroll.js')}}"></script>

    <!-- slimscroll js -->
    <script src="{{ asset('assets/js/jquery.mCustomScrollbar.concat.min.js')}} "></script>

    <!-- menu js -->
    <script src="{{ asset('assets/js/pcoded.min.js')}}"></script>
    <script src="{{ asset('assets/js/vertical/vertical-layout.min.js')}} "></script>

    <script type="text/javascript" src="{{asset ('assets/js/script.js')}} "></script>

    <!-- select2 js -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    





</head>

<body>
    <!-- Pre-loader start -->
    
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            <nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">
                    <div class="navbar-logo">
                        <a class="mobile-menu waves-effect waves-light" id="mobile-collapse" type="get" >
                            <i class="ti-menu"></i>
                        </a>
                        <div class="mobile-search waves-effect waves-light">
                            <div class="header-search">
                                <div class="main-search morphsearch-search">
                                    <div class="input-group">
                                        <span class="input-group-prepend search-close"><i class="ti-close input-group-text"></i></span>
                                        <input type="text" class="form-control" placeholder="Enter Keyword" name="page"  type="search">
                                        <span class="input-group-append search-btn"><i class="ti-search input-group-text"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <a href="{{route('home')}}">
                            <img class="img-fluid m-l-50" src="{{url('assets/images/logo.png')}}" alt="Theme-Logo" style="width: 100px; height: 57px;" />
                        </a>
                        <a class="mobile-options waves-effect waves-light">
                            <i class="ti-more"></i>
                        </a>
                    </div>
                    <div class="navbar-container container-fluid">
                        <ul class="nav-left">
                            <li>
                                <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a></div>
                            </li>
                        </ul>
                        
                    </div>
                </div>
                <ul class="breadcrumb "   >
                            <li class="breadcrumb-item">
                                <a href="{{route('home')}}"> <i class="fa fa-home"></i> ACCUEIL</a>
                            </li>                               
                        </ul>  
            </nav>
           
           

            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <nav class="pcoded-navbar">
                        <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
                        <div class="pcoded-inner-navbar main-menu">
                        <div class="">
                                <div class="main-menu-header">
                                    <div class="user-details">
                                    <?php
                                    use App\Models\Personnel;
                                    use Illuminate\Support\Facades\Auth;
                                    $id = Auth::id(); $personnel = Personnel::where('id', '=', $id)->first();?>  
<br><br>
                                        <span id="more-details">  {{ $personnel->nom_personne }} {{ $personnel->prenom_personne }} <i class="fa fa-caret-down"></i></span>
                                    </div>
                                </div>
                                <div class="main-menu-content">
                                    <ul>
                                        <li class="more-details">
                                            <a href="user-profile.html"><i class="ti-user"></i>View Profile</a>
                                            <a href="#!"><i class="ti-settings"></i>Settings</a>
                                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();"><i class="ti-layout-sidebar-left"></i>Déconnexion</a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            
                            
                                
                            

                            <div class="pcoded-navigation-label" >Navigation</div>
                            <div id="sidebar">
                            
                            <ul class="pcoded-item pcoded-left-item">
                                <li value="/acomptes">
                                    <a href="/acomptes" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i ></i><b>AC</b></span>
                                        <span class="pcoded-mtext">Acompte</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                            </ul>

                            <ul class="pcoded-item pcoded-left-item">
                                <li value="/avenants">
                                    <a href="/avenants" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i ></i><b>AV</b></span>
                                        <span class="pcoded-mtext">Avenant</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                            </ul>

                            <ul class="pcoded-item pcoded-left-item">
                                <li value="/chantiers">
                                    <a href="/chantiers" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i ></i><b>CA</b></span>
                                        <span class="pcoded-mtext">Chantier</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                            </ul>

                            <ul class="pcoded-item pcoded-left-item">
                                <li value="/chantierMateriels" >
                                    <a href="/chantierMateriels" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i ></i><b>CM</b></span>
                                        <span class="pcoded-mtext">Chantier-Matériel</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                            </ul>

                            <ul class="pcoded-item pcoded-left-item">
                                <li value="/chantierNatureFrais">
                                    <a href="/chantierNatureFrais" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i ></i><b>CNF</b></span>
                                        <span class="pcoded-mtext">Chantier-Nature Frais</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                            </ul>

                            <ul class="pcoded-item pcoded-left-item">
                                <li value="/chantierOperations">
                                    <a href="/chantierOperations" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i ></i><b>CO</b></span>
                                        <span class="pcoded-mtext">Chantier-Opération</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                            </ul>

                            <ul class="pcoded-item pcoded-left-item">
                                <li value="/chantierOperationReels">
                                    <a href="/chantierOperationReels" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i ></i><b>CQ</b></span>
                                        <span class="pcoded-mtext">Exécution des Opérations</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                            </ul>

                            <ul class="pcoded-item pcoded-left-item">
                                <li value="/chantierPersonnels">
                                    <a href="/chantierPersonnels" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i ></i><b>CP</b></span>
                                        <span class="pcoded-mtext">Chantier-Personnel</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                            </ul>

                            <ul class="pcoded-item pcoded-left-item">
                                <li value="/chantierQualifications">
                                    <a href="/chantierQualifications" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i ></i><b>CQ</b></span>
                                        <span class="pcoded-mtext">Chantier-Qualification</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                            </ul>

                            <ul class="pcoded-item pcoded-left-item">
                                <li value="/commandes">
                                    <a href="/commandes" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i ></i><b>CO</b></span>
                                        <span class="pcoded-mtext">Commande</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                            </ul>

                            <ul class="pcoded-item pcoded-left-item">
                                <li value="/commandeMateriaus">
                                    <a href="/commandeMateriaus" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i ></i><b>CM</b></span>
                                        <span class="pcoded-mtext">Commande-matériau</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                            </ul>

                            <ul class="pcoded-item pcoded-left-item">
                                <li value="/consommationMateriels">
                                    <a href="/consommationMateriels" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i ></i><b>CM</b></span>
                                        <span class="pcoded-mtext">Consommation matériel</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                            </ul>

                            <ul class="pcoded-item pcoded-left-item">
                                <li value="/decomptes">
                                    <a href="/decomptes" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i ></i><b>D</b></span>
                                        <span class="pcoded-mtext">Décompte </span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                            </ul>

                           

                        
                            <ul class="pcoded-item pcoded-left-item">
                                <li value="/factures">
                                    <a href="/factures" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i ></i><b>FA</b></span>
                                        <span class="pcoded-mtext">Facture </span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                            </ul>

                            <ul class="pcoded-item pcoded-left-item">
                                <li value="/fournisseurs">
                                    <a href="/fournisseurs" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i ></i><b>FO</b></span>
                                        <span class="pcoded-mtext">Fournisseur </span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                            </ul>

                            <ul class="pcoded-item pcoded-left-item">
                                <li value="/frais" >
                                    <a href="/frais" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i ></i><b>FR</b></span>
                                        <span class="pcoded-mtext">Frais </span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                            </ul>

                            <ul class="pcoded-item pcoded-left-item">
                                <li value="/materiaus">
                                    <a href="/materiaus" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i ></i><b>MU</b></span>
                                        <span class="pcoded-mtext">Matériau </span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                            </ul>

                            <ul class="pcoded-item pcoded-left-item">
                                <li value="/materiels">
                                    <a href="/materiels" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i ></i><b>ML</b></span>
                                        <span class="pcoded-mtext">Matériel </span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                            </ul>      

                            <ul class="pcoded-item pcoded-left-item">
                                <li value="/natureFrais">
                                    <a href="/natureFrais" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i ></i><b>NF</b></span>
                                        <span class="pcoded-mtext">Nature du frais </span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                            </ul>


                            <ul class="pcoded-item pcoded-left-item">
                                <li value="/operations">
                                    <a href="/operations" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i ></i><b>OP</b></span>
                                        <span class="pcoded-mtext">Opération </span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                            </ul>

                           

                            <ul class="pcoded-item pcoded-left-item">
                                <li value="/ordreServices">
                                    <a href="/ordreServices" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i ></i><b>OR</b></span>
                                        <span class="pcoded-mtext">Ordre de service </span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                            </ul>

                         

                            <ul class="pcoded-item pcoded-left-item">
                                <li value="/personnels">
                                    <a href="/personnels" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i ></i><b>P</b></span>
                                        <span class="pcoded-mtext">Personnel </span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                            </ul>

                            <ul class="pcoded-item pcoded-left-item">
                                <li value="/qualifications">
                                    <a href="/qualifications" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i ></i><b>Q</b></span>
                                        <span class="pcoded-mtext">Qualification </span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                            </ul>

                            @can('role-list')
                            <ul class="pcoded-item pcoded-left-item">
                                <li value="/roles">
                                    <a href="/roles" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i ></i><b>R</b></span>
                                        <span class="pcoded-mtext">Rôle </span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                            </ul>
                            @endcan

                            <ul class="pcoded-item pcoded-left-item">
                                <li value="/soutraitances">
                                    <a href="/soutraitances" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i ></i><b>S</b></span>
                                        <span class="pcoded-mtext">Sous traitance </span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                            </ul>
                            </div>
                            </div>
                        
                    </nav>

                    <div class="pcoded-content">
                        @yield('content') 

                        </div>

                </div>

            </div>
                   
    <!-- Warning Section Ends -->



</body>

</html>






































