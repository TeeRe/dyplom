$(document).ready(function(){
	$( ".tabs" ).tabs({
      beforeLoad: function( event, ui ) {
        ui.jqXHR.error(function() {
          ui.panel.html(
            "Couldn't load this tab. We'll try to fix this as soon as possible. " +
            "If this wouldn't be a demo." );
        });
      }
    });

    $('.page_center').click(function(){
		scroll(100000, 100000);
		var toCenter = pageYOffset/2;
        scroll(0,toCenter);
    });
});
