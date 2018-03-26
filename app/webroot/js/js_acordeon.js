//efecto esconder div
function hideAndShowDiv(div, txt){

    //alert( 'aqui'  + div + ' -- ' + txt);
    var thisdiv = ("#" + div);

    $(thisdiv).next("div.menu_body").slideToggle(300).siblings("div.menu_body").slideUp("slow");

    if($(thisdiv).attr("alt")=="ver"){

        $(thisdiv).html("<center>" + txt + "<br/><string><b><<</b></strong></center>");
        $(thisdiv).attr( "style", "background-color: #7ab5f7; color: #FEFEFE;text-shadow: 0 1px 1px #333;" );                    
        $(thisdiv).attr( "alt", "esconder" );

    }else{

        $(thisdiv).html("<center>" + txt + "<br/><strong><b>>></b></strong></center>");
        $(thisdiv).attr( "style", "background-color: #8aa8ca; color: #FEFEFE;text-shadow: 0 1px 1px #333;" );
        $(thisdiv).attr( "alt", "ver" );

    }
}