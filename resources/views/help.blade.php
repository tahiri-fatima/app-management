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
    

<style>
    li{
  
  line-height: 30px;
  text-align: justify;
  letter-spacing: 1px;
  font-family: 'Raleway', serif;
}
.s2{list-style-type: circle;}

</style>



</head>

<body>
    <!-- Pre-loader start -->
    
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-container navbar-wrapper">
            <nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">

                    <div class="navbar-logo">
                        <a href="index.html">
                            <img class="img-fluid m-l-50" src="{{url('assets/images/logo.png')}}" alt="Theme-Logo" style="width: 100px; height: 57px;" />
                        </a>
                    </div>

                    <ul class="breadcrumb "   >
                    <li class="breadcrumb-item">
                        <a href="{{route('home')}}"> <i class="fa fa-home"></i> ACCUEIL</a>
                    </li>                               
                </ul> 
                   
                </div>
                 
            </nav>
               

        </div>
    </div>

    <div class="container">
                   <h4>Guide d'utilisation de l'application</h4>
                   <div class="card" style="margin: 100px 0px auto 100px">
                        <div style="margin-top: 20px; margin-left: 40px;margin-left: 40px; font-family: serif; ">
                            <p style="font-size: 16px;" >Quand vous lancez l'application la premiere page c'est l'interface ci-dessous : </p> 
                            <div class="text-center">
                                <img  style="width: 700px; height: 500px; margin-bottom: 20px;" src="{{url('assets/images/help_img/firstPage.png')}}" alt="Theme-Logo"  />
                            </div>

                            <p style="font-size: 16px;" >Pour connectez-vous cliquer sur <span style="font-weight: bold; color:#f19640"  >Se connecter</span> puis une page d'authentification sera affiché : </p> 
                            <div class="text-center">
                                <img  style="width: 700px; height: 500px; margin-bottom: 20px;" src="{{url('assets/images/help_img/login.png')}}" alt="Theme-Logo"  />
                            </div>

                            <p style="font-size: 16px;" >Aprés l'authentification la page d'accueil sera affiché  : </p> 
                            <div class="text-center">
                                <img  style="width: 700px; height: 500px; margin-bottom: 20px;" src="{{url('assets/images/help_img/home.png')}}" alt="Theme-Logo"  />
                            </div>
                            <p style="font-size: 16px;" >  
                                Vous trouverez dans le menu trois éléments important: 
                                <ul class="s2" style="font-size:16px; font-weight: bold; color:#f19640; margin-left: 20px;">
                                    <li>Gestion des données</li>
                                    <li>Gestion des éditions</li>
                                    <li>Tableau de bord</li>
                                </ul>
                            Commençons avec :
                                <h5>Gestion des données</h5>
                            </p> 
                            <div class="text-center">
                                <img  style="width: 700px; height: 500px; margin-bottom: 20px;" src="{{url('assets/images/help_img/donnee_menu.png')}}" alt="Theme-Logo"  />
                            </div>

                            <p style="font-size: 16px;" > Comme exemple de la gestion des données on cliquons sur le boutton <span style="font-weight: bold; color:#f19640"  >Acompte</span> pour accèder à la page de gestion des acomptes </p>
                            <div class="text-center">
                                <img  style="width: 700px; height: 500px; margin-bottom: 20px;" src="{{url('assets/images/help_img/indexAcompte.png')}}" alt="Theme-Logo"  />
                            </div>
                            <p style="font-size: 16px;" >Vous pouvez ajouter un nouveau acompte par le clique sur le boutton <span style="font-weight: bold; color:#f19640"  >Ajouter nouveau Acompte</span>, maintenant séléctionner un acompte pour le consulter  </p>
                            <div class="text-center">
                                <img  style="width: 700px; height: 500px; margin-bottom: 20px;" src="{{url('assets/images/help_img/showAcompte.png')}}" alt="Theme-Logo"  />
                            </div>
                            <p style="font-size: 16px;" >Dans cette il y a un menu qui permet de gérer les acomptes, pour supprimer un acompte cliquer sur le boutton
                            <span style="font-weight: bold; color:#f19640"  >Supprimer</span>, maintenant on va accèder à la page d'ajout d'un nouveau acompte.</p>
                            <div class="text-center">
                                <img  style="width: 700px; height: 500px; margin-bottom: 20px;" src="{{url('assets/images/help_img/createAcompte.png')}}" alt="Theme-Logo"  />
                            </div>

                            <p style="font-size: 16px;" >Pour modifier les données d'un acompte choisissez <span style="font-weight: bold; color:#f19640"  >Modifier</span> à partir de menu.</p>
                            <div class="text-center">
                                <img  style="width: 700px; height: 500px; margin-bottom: 20px;" src="{{url('assets/images/help_img/editAcompte.png')}}" alt="Theme-Logo"  />
                            </div>

                            <p style="font-size: 16px;" >Une autre exemple de la gestion des données c'est la gestion des opérations d'un chantier.</p>
                            <div class="text-center">
                                <img  style="width: 700px; height: 500px; margin-bottom: 20px;" src="{{url('assets/images/help_img/indexAsso.png')}}" alt="Theme-Logo"  />
                            </div>

                            <p style="font-size: 16px;" >Séléctionner un chantier pour afficher ses opérations </p>
                            <div class="text-center">
                                <img  style="width: 700px; height: 500px; margin-bottom: 20px;" src="{{url('assets/images/help_img/showAsso.png')}}" alt="Theme-Logo"  />
                            </div>
                            <p style="font-size: 16px;" >
                             Afin de supprimer tous les opérations associer à ce chantier cliquer sur le boutton <span style="font-weight: bold; color:#f19640"  >Supprimer</span>.
                            </p>
                            <p style="font-size: 16px;" >La page d'ajout des opérations à un chantier est la suivante </p>
                            <div class="text-center">
                                <img  style="width: 700px; height: 500px; margin-bottom: 20px;" src="{{url('assets/images/help_img/createAsso.png')}}" alt="Theme-Logo"  />
                            </div>

                            <p style="font-size: 16px;" >Pour modifier les opérations associés à un chantier accèder à la pgae suivante à partier de boutton
                            <span style="font-weight: bold; color:#f19640"  >Modifier</span> dans la page de la consultation
                            </p>
                            <div class="text-center">
                                <img  style="width: 700px; height: 500px; margin-bottom: 20px;" src="{{url('assets/images/help_img/editAsso.png')}}" alt="Theme-Logo"  />
                            </div>
                            <p style="font-size: 16px;" >  
                            Passons maintenant à la :
                                <h5>Gestion des éditions</h5>
                                <div class="text-center">
                                    <img  style="width: 700px; height: 500px; margin-bottom: 20px;" src="{{url('assets/images/help_img/edition_menu.png')}}" alt="Theme-Logo"  />
                                </div>

                                Il y a des sous menu pour les bouttons <span style="font-weight: bold; color:#f19640"  >Estimation VS Réelle</span>
                                <div class="text-center">
                                    <img  style="width: 700px; height: 500px; margin-bottom: 20px;" src="{{url('assets/images/help_img/editionChild_menu1.png')}}" alt="Theme-Logo"  />
                                </div>
                                 et <span style="font-weight: bold; color:#f19640"  >Détail des prix élémentaires </span>
                                 <div class="text-center">
                                    <img  style="width: 700px; height: 500px; margin-bottom: 20px;" src="{{url('assets/images/help_img/editionChild_menu2.png')}}" alt="Theme-Logo"  />
                                </div>

                                Comme exemple de la gestion des éditions, cliquons sur le boutton <span style="font-weight: bold; color:#f19640"  >Matériels des chantiers </span>
                                la page suivante sera affiché :
                                <div class="text-center">
                                    <img  style="width: 700px; height: 500px; margin-bottom: 20px;" src="{{url('assets/images/help_img/choixChantier.png')}}" alt="Theme-Logo"  />
                                </div>

                                Aprés la séléction du chantier une tableau des informations des matériels correspondant au chantier sera affiché :
                                <div class="text-center">
                                    <img  style="width: 700px; height: 500px; margin-bottom: 20px;" src="{{url('assets/images/help_img/listeMateriels.png')}}" alt="Theme-Logo"  />
                                </div>
                                Le boutton <span style="font-weight: bold; color:#f19640"  >Imprimer</span> vous permet de imprimer ou bien télécharger le tableau en format PDF.
                                <div class="text-center">
                                    <img  style="width: 700px; height: 500px; margin-bottom: 20px;" src="{{url('assets/images/help_img/printList.png')}}" alt="Theme-Logo"  />
                                </div>
                            </p>


                        </div>
                   </div>
    </div>
                   
    <!-- Warning Section Ends -->



</body>

</html>






































