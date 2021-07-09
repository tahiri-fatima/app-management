"use strict";



jQuery(function($) {
    $.fn.select2.amd.require([
    'select2/selection/single',
    'select2/selection/placeholder',
    'select2/selection/allowClear',
    'select2/dropdown',
    'select2/dropdown/search',
    'select2/dropdown/attachBody',
    'select2/utils'
  ], function (SingleSelection, Placeholder, AllowClear, Dropdown, DropdownSearch, AttachBody, Utils) {

        var SelectionAdapter = Utils.Decorate(
      SingleSelection,
      Placeholder
    );

    SelectionAdapter = Utils.Decorate(
      SelectionAdapter,
      AllowClear
    );

    var DropdownAdapter = Utils.Decorate(
      Utils.Decorate(
        Dropdown,
        DropdownSearch
      ),
      AttachBody
    );

        var base_element = $('.select2-multiple')
    $(base_element).select2({
        placeholder: 'Séléctionner des éléments',
      selectionAdapter: SelectionAdapter,
      dropdownAdapter: DropdownAdapter,
      allowClear: true,
      templateResult: function (data) {

        if (!data.id) { return data.text; }

         var $res = $('<div></div>');

        $res.text(data.text);
        $res.addClass('wrap');

        return $res;
      },
      templateSelection: function (data) {
        if (!data.id) { return data.text; }
        var selected = ($(base_element).val() || []).length;
        var total = $('option', $(base_element)).length;
        return "Vous avez séléctionner " + selected + " de " + total;
      }
    })

  });

});

// submit create form
$(document).ready(function(){
    $(".confirmer").click(function(){            
        $("#form").submit();
    });
});



$(document).ready(function(){
    setTimeout(function() {
        $('.message').fadeOut('fast');
    }, 5000); // <-- time in milliseconds
});



$(document).ready(function(){
    $(".search_input").change(function(){
        $(".search_input").css('width', '400px');
        
    }).change();
});


// loading new page
window.onload = function() {

    // get current url
    var currentURL = window.location;
    console.log(' window.location '+currentURL);
    // get parent url
    var parentURL = document.referrer;
    console.log(' parentURL '+parentURL);

// sidebar : activated page
    $('#sidebar ul li ').each(function() {
        var href = $(this).attr("value");
        if(currentURL.toString().indexOf(href) != -1){
            $('#sidebar ul li.active').removeClass("active");
            $(this).addClass("active");    
        }  
        if(currentURL.toString().includes("search")){
            if(parentURL.toString().indexOf(href) != -1){
                $(this).addClass("active");    
            }  
        }
    });
   
   // start edit mode
   // recuperer les elements qui sont déjà sélectionner
    var selectedOptions = [];     
    $('#mySelect option:selected').each(function(i, selected){ 
        selectedOptions[i] = $(selected).val();  
    });
    for(var j = 0; j < selectedOptions.length; j++) { 
        $('#'+selectedOptions[j]).show(200);
    } 

};
// end edit mode


// start home js
$(document).ready(function(){
    $('#gestion').click(function(){
        // show hide paragraph on button click
            // check paragraph once toggle effect is completed
            if($('#gestion-menu').is(":visible")){
                $('#gestion-menu').css({"display" : "none"});
                document.getElementById('gestion').style.removeProperty('text-align')
            } else{
                $('#gestion-menu').css({"display" : "block"});
                $('#gestion').css({"text-align" : "center"});
                if($('#edition-menu').is(":visible")){
                    $('#edition-menu').css({"display" : "none"});
                    
                } 
            }
            
       
    }).change();
});

$(document).ready(function(){
    $('#edition').click(function(){
        // show hide paragraph on button click
            // check paragraph once toggle effect is completed
            
            if($('#edition-menu').is(":visible")){
                $('#edition-menu').css({"display" : "none"});
                document.getElementById('edition').style.removeProperty('text-align')
            } else{
                $('#edition-menu').css({"display" : "block"});
                $('#edition').css({"text-align" : "center"});
                if($('#gestion-menu').is(":visible")){
                    $('#gestion-menu').css({"display" : "none"});
                } 
            }
       
    }).change();
});


// end home js

// start js of printing full page
function PrintPage()
{
   var sOption="height=600, width=800,toolbar=0, menubar=0, scrollbars=1, resizable=1,status=0, location=0, left=10, top=10";
     
   var sWinHTML = document.getElementById('printableArea').innerHTML;
   var winprint=window.open("","",sOption);
       winprint.document.open();
       winprint.document.write('<html><head><style type="text/css">');
       winprint.document.write('img{width:200px;height:100px;margin-left:44%; }');
       winprint.document.write('h5{font-size:15px;text-align:center;}');
       winprint.document.write('.table{border-collapse: collapse; width: 100%; margin-left:50px;}');
       winprint.document.write('.table,td,thead{color:#000000;padding: 10px;width=90px;text-align:center;border: 1px solid black;}');
       winprint.document.write('thead{font-family: "Times New Roman", Times, serif;font-size:15px;}');
       winprint.document.write('</style></head><body onload="window.print();">');

       winprint.document.write(sWinHTML);
       winprint.document.write('</body></html>');
       winprint.document.close();
       winprint.focus();
}
// end js of printing full page

// imprimer div
function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;

}


// chantier_personnels start
function recupValeurPers(valeurChamp, id) {  
    
    console.log('valeurChamp '+ valeurChamp + ' id '+ id);
    // extract the id of personnel
    var newId = id.substring(1, id.length);
    var salaireUnitaire = $("#s"+newId).val();

    console.log('newId '+ newId );
    if(id.indexOf('e') > -1){

        // récuperer la date debut
        var dd = $("#d"+newId).val();
        // récuperer la date final
        var df = $("#f"+newId).val();
        var eff = valeurChamp;
        // verification 
        if(dd !== '' && df !== ''){
            dd = new Date(dd);
            df = new Date(df);
        }
    }
    if(id.indexOf('d') > -1){
        var eff = $("#e"+newId).val();
        // récuperer la date final
        var df = $("#f"+newId).val();
        // récuperer la date debut
        dd = new Date(valeurChamp);
        df = new Date(df);
    }
    if(id.indexOf('f') > -1){
        var eff = $("#e"+newId).val();
        var dd = $("#d"+newId).val();
        // récuperer la date final
        df = new Date(valeurChamp);
        dd = new Date(dd);
    }
    console.log('eff '+eff+' salaireUnitaire '+salaireUnitaire);

    if(eff != '' && dd != '' && df != '' && salaireUnitaire != ''){
        console.log('condition \n ');

    // To calculate the time difference of two dates
    var Difference_In_Time = df.getTime() - dd.getTime();
    // To calculate the no. of days between two dates
    var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);          
   
        // calcule du montant
    var montant = parseFloat(salaireUnitaire*eff*Difference_In_Days);
    montant = Math.round(montant * 100) / 100 ;
    // modifier la valeur du montant
    $('#sr'+newId).val(montant);
    console.log('eff '+eff+' salaireUnitaire '+salaireUnitaire+' Duree '+Difference_In_Days+ ' montant '+montant);

    }
}

 // Calcul de montant total 

$(document).ready(function(){
    $(".effictif_reel,.date_d,.date_f").change(function(){
        var sumSal =  0.0;
     //console.log("hiho");
        $('.salaire_reel').each(function() {
            if($(this).val() != ""){
                sumSal += parseFloat($(this).val());
            }
        });
        sumSal = Math.round(sumSal * 100) / 100 ;
        $('#montant_salaire').val(sumSal); 
           
    }).change();
});
// chantier_personnels end

 // start chantier-materiels js to test dates 
 function testDateF(valeurChamp, id){
    // extract the id of materiel
    var newId = id.substring(1, id.length);

    // récuperer la date debut de service
    var d_debut = $("#d"+newId).val();
   
    if(d_debut  !== ''){
        // verify date 
        if(d_debut > valeurChamp){
            // show alert
            $('#date').fadeIn(200);
            // refresh input values
            if($('#'+id).attr('value') === ''){
                // in create case
               // console.log(d_debut);
                //console.log(d_debut.split("-").reverse().join("/"));
               // $('#d'+newId).val('value', d_debut.split("-").reverse().join("/"));
                $('#'+id).val(''); 
            }else{
                // in edit case
                $('#d'+newId).val($('#d'+newId).attr('value'));
                $('#'+id).val($('#'+id).attr('value'));
            
                console.log('f2 : ' + d_debut + ' ' + valeurChamp);
            }
             
        }else{
            var currentURL = window.location;
           // var href = 'chantierPersonnels';
            if(currentURL.toString().indexOf('chantierPersonnels') != -1){
                recupValeurPers(valeurChamp, id); 
                console.log('recupValeurPers(valeurChamp, id) F '+valeurChamp+' '+ id);
  
            }else if(currentURL.toString().indexOf('chantierMateriels') != -1){
                console.log('recupValeurMat(valeurChamp, id) F '+valeurChamp+' '+ id);
                recupValeurMat(valeurChamp, id);
            }
      
        }
        
          setTimeout(function() {
            $('#date').fadeOut('fast');
        }, 5000); // <-- time in milliseconds
    }  
 }

 function testDateD(valeurChamp, id){
    // extract the id of materiel
    var newId = id.substring(1, id.length);

    // récuperer la date fin de service
    var d_fin = $("#f"+newId).val();
    if(d_fin  !== ''){
        // verify date 
        if(d_fin < valeurChamp){
            // show alert
            $('#date').fadeIn(200);
            // refresh input values
            if($('#'+id).attr('value') === ''){
                // in create case
                console.log('hey');
               // $('#f'+newId).val($("#f"+newId).val('value', $("#f"+newId).val().split("-").reverse().join("/")));
                $('#'+id).val(''); 
            }else{
                // in edit case
                $('#f'+newId).val($("#f"+newId).attr('value'));
                $('#'+id).val($('#'+id).attr('value'));
                console.log('d2 : ' + d_fin + ' ' + valeurChamp);
            }   
        }else{
            var currentURL = window.location;
            // var href = 'chantierPersonnels';
             if(currentURL.toString().indexOf('chantierPersonnels') != -1){
                 recupValeurPers(valeurChamp, id); 
                 console.log('recupValeurPers(valeurChamp, id) F '+valeurChamp+' '+ id);
   
             }else if(currentURL.toString().indexOf('chantierMateriels') != -1){
                 console.log('recupValeurMat(valeurChamp, id) F '+valeurChamp+' '+ id);
                 recupValeurMat(valeurChamp, id);
             }
        }

        setTimeout(function() {
            $('#date').fadeOut('fast');
        }, 5000); // <-- time in milliseconds
    }
 }
  // Calcul de montant net 
  
function recupValeurMat(valeurChamp, id) {  
    console.log('cc from recupValeurMat');
    console.log('valeurChamp '+ valeurChamp + ' id '+ id);
    // extract the id of operation
    var newId = id.substring(1, id.length);
    
    if(id.indexOf('t') > -1){
        // récuperer la date debut
        var dd = $("#d"+newId).val();
        // récuperer la date final
        var df = $("#f"+newId).val();
        // récuperer le prix
        var prix = $("#p"+newId).val();
        // récuperer le taux
        var taux = valeurChamp;
        // verification 
        if(dd !== '' && df !== ''){
            dd = new Date(dd);
            df = new Date(df);
        }
    }
    if(id.indexOf('p') > -1){
        // récuperer le taux
        var taux = $("#t"+newId).val();
        // récuperer la date debut
        var dd = $("#d"+newId).val();
        // récuperer la date final
        var df = $("#f"+newId).val();
        // récuperer le prix
        var prix = valeurChamp;
        if(dd !== '' && df !== ''){
            dd = new Date(dd);
            df = new Date(df);
        }
    }
    if(id.indexOf('d') > -1){
        // récuperer le taux
        var taux = $("#t"+newId).val();
        // récuperer la date final
        var df = $("#f"+newId).val();
        // récuperer le prix
        var prix = $("#p"+newId).val();
        // récuperer la date debut
        dd = new Date(valeurChamp);
        df = new Date(df);
    }

    if(id.indexOf('f') > -1){
        // récuperer le taux
        var taux = $("#t"+newId).val();
        var dd = $("#d"+newId).val();
        // récuperer le prix
        var prix = $("#p"+newId).val();
        // récuperer la date final
        df = new Date(valeurChamp);
        dd = new Date(dd);
    }
    if(taux != '' && dd != '' && df != '' && prix != ''){
        
    // To calculate the time difference of two dates
    var Difference_In_Time = df.getTime() - dd.getTime();
    // To calculate the no. of days between two dates
    var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);          
   
        // calcule du montant
    var montant = parseFloat(prix*Difference_In_Days);
    // calcule du montant net
    var montantNet = montant*(100-taux)/100;
    montantNet = Math.round(montantNet * 100) / 100 ;
    // modifier la valeur du montant
    $('#m'+newId).val(montantNet);
    calculateTotalMat();
    console.log('prix '+prix+' taux '+taux+' Duree '+Difference_In_Days+ ' montant '+montant);

    }
}
function calculateTotalMat(){
    var sum =  0.0;
    $('.montant_net').each(function() {
        if($(this).val() != ""){
            sum += parseFloat($(this).val());
        }
    });
    sum = Math.round(sum * 100) / 100 ;
    $('#total').val(sum); 
    console.log('total = '+sum);
}


    // end chantier-materiels js to test dates 

// start Commande-materiaux
// calcul du montant à partir de la qte 
  function qteMateriau(valeurChamp, id) {
    // extract the id of materiau
    var newId = id.substring(1, id.length);
    // récuperer le prix unitaire
    var prix = $("#prix"+newId).attr('value');
        // calcule du montant
    var montant = parseFloat(prix*valeurChamp);
    montant = Math.round(montant * 100) / 100 ;
    // modifier la valeur du montant
    $('#montant'+newId).val(montant);
 }
 // End Commande-materiaux

 // Calcul de montant total 
 $(document).ready(function(){
    $(".quantite").change(function(){
        var sum =0.0;
        $('.montant').each(function() {
            if($(this).val() != ""){
                sum += parseFloat($(this).val());
            }  
        });
        // modifier la valeur du montant total
        sum = Math.round(sum * 100) / 100 ;
        $('#total').val(sum);    
    }).change();
});
// endd montant total

// start chantier-qualifications
// calcul du montant 
function recupValeurQual(valeurChamp, id) {  
    // extract the id of operation
    var newId = id.substring(1, id.length);
   console.log('hello '+id); 
    if(id.indexOf('d') > -1){
        var effectif = $("#e"+newId).val();
        var duree =valeurChamp;    
    }else if(id.indexOf('e') > -1){
        // récuperer la qte
        var duree = $("#d"+newId).val();
       
        var effectif = valeurChamp;  
    }
    var salaire = $("#s"+newId).val();
    console.log('salaire '+salaire+' effectif '+effectif+' duree '+duree+ ' montant '+salaire_est);

    if(salaire !== '' && effectif !== '' && duree !== ''){
            // calcule du montant
        var salaire_est = parseFloat(salaire*effectif*duree);
        salaire_est = Math.round(salaire_est * 100) / 100 ;
        // modifier la valeur du montant
        $('#montant'+newId).val(salaire_est);
        console.log('prix '+salaire+' taux '+effectif+' qte '+duree+ ' montant '+salaire_est);
    }
 }
 // Calcul de montant total 
 $(document).ready(function(){
    $(".duree,.eff").change(function(){
        var sum =  0.0;
        $('.montant').each(function() {
            if($(this).val() != ""){
                sum += parseFloat($(this).val());
            }
        });
        sum = Math.round(sum * 100) / 100 ;
        $('#total').val(sum);    
    }).change();
});
 // End chantier-qualifications

 // start chantier-operations
// calcul du montant 
function recupValeurOper(valeurChamp, id) {  
    // extract the id of operation
    var newId = id.substring(1, id.length);
    
    if(id.indexOf('q') > -1){
        // récuperer le taux
        var taux = $("#t"+newId).val();
        // récuperer le prix
        var prix = $("#p"+newId).val();   
         // récuperer la qte
         var qte =valeurChamp;    
    }else if(id.indexOf('t') > -1){
        // récuperer la qte
        var qte = $("#q"+newId).val();
        // récuperer le prix
        var prix = $("#p"+newId).val();  
        // récuperer le taux
        var taux = valeurChamp;  
    }else if(id.indexOf('p') > -1){
        // récuperer la qte
        var qte = $("#q"+newId).val();
        // récuperer le taux
        var taux = $("#t"+newId).val();
         // récuperer le prix
         var prix = valeurChamp;
    }

    if(qte !== '' && taux !== '' && prix !== ''){
            // calcule du montant
        var montant = parseFloat(prix*qte);
        // calcule du montant net
        var montantNet = montant*(100-taux)/100;
        montantNet = Math.round(montantNet * 100) / 100 ;
        // modifier la valeur du montant
        $('#montant'+newId).val(montantNet);
        console.log('prix '+prix+' taux '+taux+' qte '+qte+ ' montant '+montant);
    }
 }
 // Calcul de montant total 
 $(document).ready(function(){
    $(".taux,.qantite,.prix").change(function(){
        var sum =  0.0;
        $('.montant').each(function() {
            if($(this).val() != ""){
                sum += parseFloat($(this).val());
            }
        });
        sum = Math.round(sum * 100) / 100 ;
        $('#total').val(sum);    
    }).change();
});
 // End chantier-operations

  // Calcul de montant total Chantier Nature Frais
  $(document).ready(function(){
    $(".montantEst").change(function(){
        var sum =  0.0;
        $('.montantEst').each(function() {
            if($(this).val() != ""){
                sum += parseFloat($(this).val());
            }
        });
        sum = Math.round(sum * 100) / 100 ;
        $('#total').val(sum);    
    }).change();
});



 // start chantier-operations Reel
// calcul du montant 
function recupValeurOperReel(valeurChamp, id) {  
    // extract the id of operation
    var newId = id.substring(1, id.length);
    
    if(id.indexOf('q') > -1){
        // récuperer le prix unit de revient
        var pu_rev = $("#r"+newId).val();
        // récuperer le prix unit de vente
        var pu_vente = $("#v"+newId).val();
         // récuperer la date deb
         var dd = $("#d"+newId).val(); 
        // récuperer la date d'exection
        var de = $("#e"+newId).val();   
         // récuperer la qte
         var qte =valeurChamp;    
    }else if(id.indexOf('e') > -1){
         // récuperer le prix unit de revient
         var pu_rev = $("#r"+newId).val();
         // récuperer le prix unit de vente
         var pu_vente = $("#v"+newId).val();
        // récuperer la qte
        var qte = $("#q"+newId).val(); 
        // récuperer la date deb
        var dd = $("#d"+newId).val();
        // récuperer la date d'exection
        var de = valeurChamp;  
    }

    if(qte !== '' && de !== '' ){
        de = new Date(de);
        dd = new Date(dd);
          // To calculate the time difference of two dates
        var Difference_In_Time = de.getTime() - dd.getTime();
        // To calculate the no. of days between two dates
        var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);          
   
            // calcule du montant
        var montantRev = parseFloat(pu_rev*qte);
        var montantVen = parseFloat(pu_vente*qte);

        montantRev = Math.round(montantRev * 100) / 100 ;
        montantVen = Math.round(montantVen * 100) / 100 ;
        // modifier la valeur du montant
        $('#montantR'+newId).val(montantRev);
        $('#montantV'+newId).val(montantVen);

        calculateTotal();
        console.log('prix rev '+pu_rev+' pu_vente '+pu_vente+' qte '+qte+ ' date '+de);
    }
 }
 // Calcul de montant total 
 function calculateTotal(){
    console.log('heyo');
    var sumR =  0.0;
    var sumV =  0.0;

    $('.montantR').each(function() {
        if($(this).val() != ""){
            sumR += parseFloat($(this).val());
        }
    });
    $('.montantV').each(function() {
        if($(this).val() != ""){
            sumV += parseFloat($(this).val());
        }
    });
   
    sumR = Math.round(sumR * 100) / 100 ;
    $('#totalR').val(sumR); 
    sumV = Math.round(sumV * 100) / 100 ;
    $('#totalV').val(sumV); 
 }
 $(document).ready(function(){
    $(".montantE").change(function(){
        var sum =  0.0;
        $('.montantE').each(function() {
            if($(this).val() != ""){
                sum += parseFloat($(this).val());
            }
        });
        sum = Math.round(sum * 100) / 100 ;
        $('#totalE').val(sum);    
    }).change();
});
 // End chantier-operations Reel



// js to dimiss popover when clicking outside
$('body').on('click', function (e) {
    $('[data-toggle="popover"]').each(function () {
        //the 'is' for buttons that trigger popups
        //the 'has' for icons within a button that triggers a popup
        if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0 && $('.modal').has(e.target).length === 0) {
            $(this).popover('hide');
        }
    });
});

// js to dimiss modal when clickuing outside

window.onclick = function(event) {
    if (!$(this).is(event.target) && $(this).has(event.target).length === 0 && $('.modal').has(event.target).length === 0) {
        $(this).modal('hide');
    }
  }
 
// start check if input not null
// chantier-operations Reel
function verifierChampsOperationReel(){
    var selectedOptions = [];
    $('#mySelect option:selected').each(function(i, selected){
        selectedOptions[i] = $(selected).val();
    });
    for(var j = 0; j < selectedOptions.length; j++) {
    
        var qte = $('#q'+selectedOptions[j]).val();
      //  var montEst = $('#me'+selectedOptions[j]).val();
        var date = $('#e'+selectedOptions[j]).val();
        if(!qte){
            $('#modal2').modal('hide');
            $('#d'+selectedOptions[j]).popover('show');
            $('.popover-body').css("color", "#f70f0f");
            return false;
        }
        if(!date){
            $('#modal2').modal('hide');
            $('#e'+selectedOptions[j]).popover('show');
            $('.popover-body').css("color", "#f70f0f");
            return false;
        }  
       
    }
    
   return true;

}
    //chantier-qualifications
    function verifierChampsQual(){
        var selectedOptions = [];
        $('#mySelect option:selected').each(function(i, selected){
            selectedOptions[i] = $(selected).val();
        });
        for(var j = 0; j < selectedOptions.length; j++) {
        
            var effictif = $('#e'+selectedOptions[j]).val();
          //  var montEst = $('#me'+selectedOptions[j]).val();
            var durree = $('#d'+selectedOptions[j]).val();
            if(!durree){
                $('#modal2').modal('hide');
                $('#d'+selectedOptions[j]).popover('show');
                $('.popover-body').css("color", "#f70f0f");
                return false;
            }
            if(!effictif){
                $('#modal2').modal('hide');
                $('#e'+selectedOptions[j]).popover('show');
                $('.popover-body').css("color", "#f70f0f");
                return false;
            }  
           
        }
        
       return true;
    }
        //End chantier-qualifications

         //chantier-nature Frais
    function verifierChampsNatureFrais(){
        var selectedOptions = [];
        $('#mySelect option:selected').each(function(i, selected){
            selectedOptions[i] = $(selected).val();
        });
        for(var j = 0; j < selectedOptions.length; j++) {
        
            var montant = $('#montant'+selectedOptions[j]).val();
          //  var montEst = $('#me'+selectedOptions[j]).val();
            if(!montant){
                $('#modal2').modal('hide');
                $('#d'+selectedOptions[j]).popover('show');
                $('.popover-body').css("color", "#f70f0f");
                return false;
            }
            
           
        }
        
       return true;
    }
        //End chantier-nature Frais


    // chantier personnels
function verifierChampsPersonnel(){
    console.log('hey');
    var selectedOptions = [];
    $('#mySelect option:selected').each(function(i, selected){
        selectedOptions[i] = $(selected).val();
    });
    for(var j = 0; j < selectedOptions.length; j++) {
        
        var effictif = $('#e'+selectedOptions[j]).val();
      //  var montEst = $('#me'+selectedOptions[j]).val();
        var dd = $('#d'+selectedOptions[j]).val();
        var df = $('#f'+selectedOptions[j]).val();
        if(!dd){
            $('#modal2').modal('hide');
           // alert('Voulez vous remplir tous les champs!');
           console.log('hey2');
            $('#d'+selectedOptions[j]).popover('show');
            $('.popover-body').css("color", "#f70f0f");
            return false;
        }
        if(!df){
            $('#modal2').modal('hide');
            $('#f'+selectedOptions[j]).popover('show');
            $('.popover-body').css("color", "#f70f0f");
            return false;
        }
        if(!effictif){
            $('#modal2').modal('hide');
            $('#e'+selectedOptions[j]).popover('show');
            $('.popover-body').css("color", "#f70f0f");
            return false;
        }  
  
    }
    
   return true;
}
    // Commande-Matériaux
function verifierChampsCommande() {
    var selectedOptions = [];
    $('#mySelect option:selected').each(function(i, selected){       
        selectedOptions[i] = $(selected).val();        
    });
    for(var j = 0; j < selectedOptions.length; j++) {        
        var qte = $('#q'+selectedOptions[j]).val();
        if(!qte){
            $('#modal2').modal('hide')
            $('#q'+selectedOptions[j]).popover('show');
            $('.popover-body').css("color", "#f70f0f");
            // alert("Le champ quantité est obligatoire!");
            return false;
        }
    }
    return true;
}
    // Chantier-Materiels
function verifierChampsMateriel() {
    var selectedOptions = [];
    $('#mySelect option:selected').each(function(i, selected){
        selectedOptions[i] = $(selected).val();
    });
    for(var j = 0; j < selectedOptions.length; j++) {
        var dd = $('#d'+selectedOptions[j]).val();
        var df = $('#f'+selectedOptions[j]).val();
        var prix = $('#p'+selectedOptions[j]).val();
        var taux = $('#t'+selectedOptions[j]).val();
        if(!prix){
            $('#modal2').modal('hide')
            $('#p'+selectedOptions[j]).popover('show');
            $('.popover-body').css("color", "#f70f0f");
            // alert("Le champ date début de service est obligatoire!");
            return false;
        }
        if(!dd){
            $('#modal2').modal('hide')
            $('#d'+selectedOptions[j]).popover('show');
            $('.popover-body').css("color", "#f70f0f");
            // alert("Le champ date début de service est obligatoire!");
            return false;
        }
        if(!df){
            $('#modal2').modal('hide')
            $('#f'+selectedOptions[j]).popover('show');
            $('.popover-body').css("color", "#f70f0f");
            //alert("Le champ date fin de service est obligatoire!");
            return false;
        }
        
        if(!taux){
            $('#modal2').modal('hide')
            $('#t'+selectedOptions[j]).popover('show');
            $('.popover-body').css("color", "#f70f0f");
            //alert("Le champ date fin de service est obligatoire!");
            return false;
        }
        //  console.log(qte);
    }
    return true;
}
    // chantier-operations
function verifierChampsOperation() {
    var selectedOptions = [];
    $('#mySelect option:selected').each(function(i, selected){
        selectedOptions[i] = $(selected).val();
    });
    for(var j = 0; j < selectedOptions.length; j++) {
        
        var qte = $('#q'+selectedOptions[j]).val();
        var taux = $('#t'+selectedOptions[j]).val();
        var dd = $('#d'+selectedOptions[j]).val();
        var df = $('#f'+selectedOptions[j]).val();
        if(!dd){
            $('#modal2').modal('hide')
            $('#d'+selectedOptions[j]).popover('show');
            $('.popover-body').css("color", "#f70f0f");
            // alert("Le champ date début de service est obligatoire!");
            return false;
        }
        if(!df){
            $('#modal2').modal('hide')
            $('#f'+selectedOptions[j]).popover('show');
            $('.popover-body').css("color", "#f70f0f");
            //alert("Le champ date fin de service est obligatoire!");
            return false;
        }
        if(!qte){
            $('#modal2').modal('hide')
            $('#q'+selectedOptions[j]).popover('show');
            $('.popover-body').css("color", "#f70f0f");
            //  $('#col'+selectedOptions[j]).css('border','1px solid #f70f0f');
            //  $('#col'+selectedOptions[j]).css('border-radius','20px');
            //$('#col'+selectedOptions[j]).css('box-shadow','2px 10px red ');
            return false;
        }
        if(!taux){
            $('#modal2').modal('hide')
            // alert("Le champ taux d'ajustement est obligatoire!");
            $('#t'+selectedOptions[j]).popover('show');
            $('.popover-body').css("color", "#f70f0f");
            return false;
        }
    }
    return true;
}
// end check if input not null

// Start js of show row of selected option and hide row of unselected option
$(document).ready(function(){
    $("select").change(function () {
        // aray of selectedOptions
        var selectedOptions = [];
        $('#mySelect option:selected').each(function(i, selected){
            // add selected option to aray of selectedOptions
            selectedOptions[i] = $(selected).val();
        });
        
        for(var j = 0; j < selectedOptions.length; j++) {
            // show row of selected option 
            $('#'+selectedOptions[j]).show(200); 
        }
        // aray of unselectedOptions
        var unSelectedOptions = [];
        $('#mySelect option:not(:selected)').each(function(i, selected){
            // add unselected option to aray of iunselectedOptions
            unSelectedOptions[i] = $(selected).val();
        });
        
        for(var j = 0; j < unSelectedOptions.length; j++) {
            // hide row of selected option 
            $('#'+unSelectedOptions[j]).hide(200);
            var total = $('#total').val();
            var montant = $('#montant'+unSelectedOptions[j]).val();
            total = total - montant;
            total = Math.round(total * 100) / 100 ;
            $('#total').val(total);
            $('#montant'+unSelectedOptions[j]).val('');
            $('#q'+unSelectedOptions[j]).val('');
            $('#t'+unSelectedOptions[j]).val(''); 
        } 
    });
 });
// End js of show row of selected option and hide row of unselected option

$(document).ready(function() {
    // card js start
    $(".card-header-right .close-card").on('click', function() {
        var $this = $(this);
        $this.parents('.card').animate({
            'opacity': '0',
            '-webkit-transform': 'scale3d(.3, .3, .3)',
            'transform': 'scale3d(.3, .3, .3)'
        });

        setTimeout(function() {
            $this.parents('.card').remove();
        }, 800);
    });
    $(".card-header-right .reload-card").on('click', function() {
        var $this = $(this);
        $this.parents('.card').addClass("card-load");
        $this.parents('.card').append('<div class="card-loader"><i class="fa fa-circle-o-notch rotate-refresh"></div>');
        setTimeout(function() {
            $this.parents('.card').children(".card-loader").remove();
            $this.parents('.card').removeClass("card-load");
        }, 3000);
    });
    $(".card-header-right .card-option .open-card-option").on('click', function() {
        var $this = $(this);
        if ($this.hasClass('fa-times')) {
            $this.parents('.card-option').animate({
                'width': '30px',
            });
            $(this).removeClass("fa-times").fadeIn('slow');
            $(this).addClass("fa-wrench").fadeIn('slow');
        } else {
            $this.parents('.card-option').animate({
                'width': '140px',
            });
            $(this).addClass("fa-times").fadeIn('slow');
            $(this).removeClass("fa-wrench").fadeIn('slow');
        }
    });
    $(".card-header-right .minimize-card").on('click', function() {
        var $this = $(this);
        var port = $($this.parents('.card'));
        var card = $(port).children('.card-block').slideToggle();
        $(this).toggleClass("fa-minus").fadeIn('slow');
        $(this).toggleClass("fa-plus").fadeIn('slow');
    });
    $(".card-header-right .full-card").on('click', function() {
        var $this = $(this);
        var port = $($this.parents('.card'));
        port.toggleClass("full-card");
        $(this).toggleClass("fa-window-restore");
    });
    $("#more-details").on('click', function() {
        $(".more-details").slideToggle(500);
    });
    $(".mobile-options").on('click', function() {
        $(".navbar-container .nav-right").slideToggle('slow');
    });
    $(".search-btn").on('click', function() {
        $(".main-search").addClass('open');
        $('.main-search .form-control').animate({
            'width': '200px',
        });
    });
    $(".search-close").on('click', function() {
        $('.main-search .form-control').animate({
            'width': '0',
        });
        setTimeout(function() {
            $(".main-search").removeClass('open');
        }, 300);
    });
    $(document).ready(function(){
        $(".header-notification").click(function(){
            $(this).find(".show-notification").slideToggle(500);
            $(this).toggleClass('active');
        });
    });
    $(document).on("click", function(event){
        var $trigger = $(".header-notification");
        if($trigger !== event.target && !$trigger.has(event.target).length){
            $(".show-notification").slideUp(300);
            $(".header-notification").removeClass('active');
        }
    });

    // card js end
    $.mCustomScrollbar.defaults.axis = "yx";
    $("#styleSelector .style-cont").slimScroll({
        setTop: "1px",
        height:"calc(100vh - 320px)",
    });
    $(".main-menu").mCustomScrollbar({
        setTop: "1px",
        setHeight: "calc(100% - 56px)",
    });
    /*chatbar js start*/
    /*chat box scroll*/
    var a = $(window).height() - 80;
    $(".main-friend-list").slimScroll({
        height: a,
        allowPageScroll: false,
        wheelStep: 5,
        color: '#1b8bf9'
    });

    // search
    $("#search-friends").on("keyup", function() {
        var g = $(this).val().toLowerCase();
        $(".userlist-box .media-body .chat-header").each(function() {
            var s = $(this).text().toLowerCase();
            $(this).closest('.userlist-box')[s.indexOf(g) !== -1 ? 'show' : 'hide']();
        });
    });

    // open chat box
    $('.displayChatbox').on('click', function() {
        var my_val = $('.pcoded').attr('vertical-placement');
        if (my_val == 'right') {
            var options = {
                direction: 'left'
            };
        } else {
            var options = {
                direction: 'right'
            };
        }
        $('.showChat').toggle('slide', options, 500);
    });

    //open friend chat
    $('.userlist-box').on('click', function() {
        var my_val = $('.pcoded').attr('vertical-placement');
        if (my_val == 'right') {
            var options = {
                direction: 'left'
            };
        } else {
            var options = {
                direction: 'right'
            };
        }
        $('.showChat_inner').toggle('slide', options, 500);
    });
    //back to main chatbar
    $('.back_chatBox').on('click', function() {
        var my_val = $('.pcoded').attr('vertical-placement');
        if (my_val == 'right') {
            var options = {
                direction: 'left'
            };
        } else {
            var options = {
                direction: 'right'
            };
        }
        $('.showChat_inner').toggle('slide', options, 500);
        $('.showChat').css('display', 'block');
    });
    $('.back_friendlist').on('click', function() {
        var my_val = $('.pcoded').attr('vertical-placement');
        if (my_val == 'right') {
            var options = {
                direction: 'left'
            };
        } else {
            var options = {
                direction: 'right'
            };
        }
        $('.p-chat-user').toggle('slide', options, 500);
        $('.showChat').css('display', 'block');
    });
    // /*chatbar js end*/

    $('[data-toggle="tooltip"]').tooltip();

    // wave effect js
    Waves.init();
    Waves.attach('.flat-buttons', ['waves-button']);
    Waves.attach('.float-buttons', ['waves-button', 'waves-float']);
    Waves.attach('.float-button-light', ['waves-button', 'waves-float', 'waves-light']);
    Waves.attach('.flat-buttons', ['waves-button', 'waves-float', 'waves-light', 'flat-buttons']);

    $('.form-control').on('blur', function() {
        if ($(this).val().length > 0) {
            $(this).addClass("fill");
        } else {
            $(this).removeClass("fill");
        }
    });
    $('.form-control').on('focus', function() {
        $(this).addClass("fill");
    });
});
$(document).ready(function() {
        $(".theme-loader").animate({
            opacity: "0"
        },1000);
        setTimeout(function() {
            $(".theme-loader").remove();
        }, 1000);

});

// toggle full screen
function toggleFullScreen() {
    var a = $(window).height() - 10;

    if (!document.fullscreenElement && // alternative standard method
        !document.mozFullScreenElement && !document.webkitFullscreenElement) { // current working methods
        if (document.documentElement.requestFullscreen) {
            document.documentElement.requestFullscreen();
        } else if (document.documentElement.mozRequestFullScreen) {
            document.documentElement.mozRequestFullScreen();
        } else if (document.documentElement.webkitRequestFullscreen) {
            document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
        }
    } else {
        if (document.cancelFullScreen) {
            document.cancelFullScreen();
        } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        } else if (document.webkitCancelFullScreen) {
            document.webkitCancelFullScreen();
        }
    }
}

