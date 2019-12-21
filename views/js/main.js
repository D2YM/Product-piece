jQuery(document).ready(function() {
    jQuery('#configure-form').submit(function(e) {
        e.preventDefault();
        jQuery.ajax({
            url: mp_ajax,
            data: jQuery(this).serialize(),
            method: 'POST',
            success: function(data) {
                if (data) {
                    //console.log(data);
                    jQuery('#boxAlert').html(data['ans']);
                    jQuery('#textTab').val('');
                    jQuery('#textTitle').val('');
                    jQuery('#textButton').val('');
                    jQuery('#labelTab').html(data['dataNow']['name_tab']);
                    jQuery('#labelTitle').html(data['dataNow']['title_content_tab']);
                    jQuery('#labelButton').html(data['dataNow']['title_button_tab']);
                }
            }
        });
    });
    if ( document.querySelector("input[name='qty']") ) {
        jQuery(".list-group-piece-qty input[name='qty']").TouchSpin();
    }
    
    if ( document.querySelector(".list-group.piece-content") ) {
        $(".list-group.piece-content").find('a').click( 
            function(){ 
                $('.column-img img').addClass('new-image').attr('src',$(this).data('img-url')); 
                $('.column-img img').attr('alt', $(this).data('img-name'));
                $("html, body").animate({ scrollTop: jQuery('.page-piece .column-img').offset().top }, 2000); 
                
            }
             
        );
    }
    jQuery('#save-piece').click(function(){ 
    
        $('html, body').animate({
          scrollTop: jQuery('#alert-request').offset().top - 100
        },
        500); 
        
    });
});