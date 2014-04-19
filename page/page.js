$(document).ready(function(){
    $( '#temp' ).button();

	var topic = $('#add-feed-topic');
	var text = $('#add-feed-text');

$( '#add-feed' ).hide();

$( "#add-feed-visible" )
    .button({     
        text: false,
        icons:{                
        primary: 'ui-icon-plus'               
        }
    }) //end button();
    .click(function() {    
        var options;        
        if ( $( this ).text() === "Добавить новость" ) 
        {           
            options = {    
                label: "Не добавлять новость",            
                icons:{                 
                    primary: 'ui-icon-minus'             
                },              
                text: false         
            };   
            $( '#add-feed' ).fadeIn();
        } 
        else 
        {           
            options = {             
                label: "Добавить новость",               
                icons:{                 
                    primary: 'ui-icon-plus'               
                },              
                text: false         
            };          

            $( '#add-feed' ).fadeOut();

        }       

        $( this ).button( "option", options );
        topic.focus();
}); //end click(); event


$('#add-feed-text').sceditor({
        plugins: "xhtml",
        style: "sce/minified/themes/modern.min.css",
        // toolbar: "bold,italic,underline|source", //TODO
        locale: "ru",
        autoExpand: true,
        resizeWidth: false,
        width: "99.6%"
    }); 

$('#add-feed-form').ajaxForm({
    beforeSubmit: function(){
        if (topic.val().length <= 2)
        {
            $().toastmessage('showErrorToast', 'Длина заголовка должна быть не менее 3 символов!');
            topic.focus();
            return false;
        }
        else
        {

        }
        
    },
    success: function(){
		// topic.val('');
		// text.val('');
		// tag.val('');
		// errorMessage('Запись <b>успешно</b> добавлена!');
        document.location.href = "page.php";
        //TODO ajax-вывод нового сообщения
    } //end beforeSubmit
}); //end ajaxForm

}); //end ready


     




$('#add-feed-submit').button();
// $('#add-feed-text').autosize();

$( "#radio" ).buttonset();
$('.details-post, .edit-post, .tags').button();

$(".autocomplete").autocomplete({
	source: "page/source.php",
	minLength: 1
});