jQuery(document).ready(function() {
    
    if (document.getElementById('piece-select')) {
        jQuery('#piece-select').select2({
            ajax: {
                url: mp_ajax_search_products,
                dataType: 'json',
                // data: jQuery(this).serialize(),
                method: 'POST',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // search term
                    };
                },
                processResults: function(data) {
                    //console.log(data);
                    return {
                        results: jQuery.map(data, function(obj) {
                            return { id: obj.id, text: obj.text, ref: obj.ref, url_img: obj.url_img };
                        })
                    };
                },
                cache: true
            },
            placeholder: 'Search for a repository',
            minimumInputLength: 1,
            templateResult: formatRepo,
            templateSelection: formatRepoSelection
        });
    }
    if (document.getElementById('piece-select')) {
        jQuery('#piece-select').on("select2:select", function(e) {
            //console.log(e.params.data);
            jQuery('#box-select-items').append('<div id="box_piece_' + e.params.data.id +
                '" class="mt-4 d-flex flex-wrap position-relative box-piece"><div class="box-img-span"><img src="' + e.params.data.url_img +
                '" ></div><div class="data-ref"><span class = "d-none id-piece" data-id = "' + e.params.data.id +
                '" > </span><span class="text-inp d-block">' + e.params.data.text +
                '</span ><span class="ref-inp d-block">Ref: ' + e.params.data.ref +
                '</span ></div><button type="button" data-id="' + e.params.data.id + '"  data-box="box_piece_' + e.params.data.id + '" onclick="eraseProduct(this.dataset.id, this.dataset.box)" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        });
    }

    function formatRepo(repo) {
        if (repo.loading) {
            return repo.text;
        }

        var $container = jQuery(
            "<div class='select2-result-repository clearfix'>" +
            "<div class='select2-result-repository__avatar img__avatar__piece'><img src='" + repo.url_img + "' /></div>" +
            "<div class='select2-result-repository__meta'>" +
            "<div class='select2-result-repository__title img__avatar__text'>" + repo.text + "</div>" +
            "<div class='select2-result-repository__description img__avatar__ref'>" + repo.ref + "</div>" +
            "</div>" +
            "</div>"
        );

        $container.find(".select2-result-repository__title").text(repo.text);
        $container.find(".select2-result-repository__description").text(repo.ref);

        return $container;
    }

    function formatRepoSelection(repo) {
        return repo.text;
    }
    
    jQuery("#save-piece").click(function() {
        var itemPiece = document.querySelectorAll('#box-select-items .box-piece .data-ref .id-piece');
        var textPiece = document.getElementById('notePieces').value;
        //console.log(textPiece);
        //console.log(itemPiece.length);
        var piece = [];
        for (var i = 0; i < itemPiece.length; i++) {
            piece.push(itemPiece[i].dataset.id);
        }
        var jsonString = JSON.stringify(piece);
        var idproduct = document.getElementById('idProductNow').value;
        
        jQuery.ajax({
            type: "POST",
            url: mp_ajax_register_products,
            data: { data: jsonString, idProduct: idproduct, textPiece: textPiece},
            cache: false,

            success: function(entry) {
                console.log(entry);
                jQuery('#alert-request').html(entry);
            }
        });
    });
    
    if( document.getElementById('idProductNow'))
        var idproduct = document.getElementById('idProductNow').value;
        
    if( document.getElementById('image-piece-main'))
        jQuery.ajax({
            type: "POST",
            url: mp_ajax_upload_image_despiece,
            data: { idProduct: idproduct, init: 'go'},
            cache: false,
            success: function(entry) {
                var preview = document.querySelector('#image-piece-main');
                if(entry){
                    preview.src = entry;
                }
                else{
                    preview.style.display = 'none';
                }
                console.log(entry);
            }
        });
    
    jQuery("#upload-img-despiece").click(function() {
        //var imagePiece = document.getElementById("inputFileImgPiece");
        //imagePiece = imagePiece.files[0];
        var idproduct = document.getElementById('idProductNow').value;
        var imagePiece = $('#inputFileImgPiece')[0].files[0];
        var fd = new FormData();
        
        fd.append('imagePiece',imagePiece);
        fd.append('idProduct',idproduct);
        jQuery.ajax({
            type: "POST",
            url: mp_ajax_upload_image_despiece,
            data: fd,
            contentType: false,
            processData: false,
            cache: false,

            success: function(entry) {
                console.log(entry);
                jQuery('#alert-request').html(entry);
            }
        });
        
    });
    if (document.getElementById('piece-select')) {
        var idproduct = document.getElementById('idProductNow').value;
        jQuery.ajax({
            type: "POST",
            url: mp_ajax_list_products,
            data: { idProduct: idproduct },
            cache: false,
            success: function(entry) {
                //console.log(entry.text);
                    
                for (const prop in entry.Json) {
                    listProducts(entry.Json[prop]);
                }
                var textPiece = document.getElementById('notePieces');
                console.log(entry.text.description_content);
                if (entry.text.description_content === undefined ) {
                    textPiece.value = '';
                } else {
                 textPiece.value = entry.text.description_content;   
                }
                
            }
        });
    }
    
    
    if ( document.getElementById('config_piece') ) {
        var nav = document.querySelector('#config_piece .nav');
        
        var elemento = nav.querySelector('a.nav-link');
        
        jQuery('.nav a.nav-link').click(function(){
        	
        	var id_element = $(this).attr('id');
        	$( "#config_piece .tab-pane.active" ).toggleClass('show');
        	$( "#config_piece .tab-pane" ).not( "[aria-labelledby='"+id_element+"']" ).removeClass('show active');
        	//console.log($(this).hasClass('show'));
        	if ( $(this).hasClass('active') ) {
        		$( "#config_piece .tab-pane.active" ).addClass('show');
        	}
        	
        });
    }
    if( document.getElementById('image-piece-main'))
        previewFile();
});
    function previewFile() {
      var preview = document.querySelector('#image-piece-main');
      var file    = document.querySelector('#inputFileImgPiece').files[0];
      var reader  = new FileReader();
    
      reader.onloadend = function () {
        preview.src = reader.result;
      }
    
      if (file) {
        preview.style.display = 'block';
        reader.readAsDataURL(file);
      } else {
        preview.src = "";
      }
    }
function listProducts(piece) {
    jQuery('#box-select-items').append('<div id="box_piece_' + piece.id +
        '" class="mt-4 d-flex flex-wrap position-relative box-piece"><div class="box-img-span"><img src="' + piece.url_img +
        '" ></div><div class="data-ref"><span class = "d-none id-piece" data-id = "' + piece.id +
        '" > </span><span class="text-inp d-block">' + piece.text +
        '</span ><span class="ref-inp d-block">Ref: ' + piece.ref +
        '</span ></div><button type="button" data-id="' + piece.id +
        '" data-box="box_piece_' + piece.id +
        '" onclick="eraseProduct(this.dataset.id, this.dataset.box)" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
}

function eraseProduct(idPiece, idBox) {
    var ans = confirm("Seguro de eliminar la pieza?");
    if (ans == true) {
        var idproduct = document.getElementById('idProductNow').value;
        jQuery.ajax({
            type: "POST",
            url: mp_ajax_delete_products,
            data: { idProduct: idproduct, idPiece: idPiece },
            cache: false,
            success: function(entry) {
                //console.log(entry.ans);
                jQuery('#alert-request').html(entry.alert);
                if (entry.ans == -1) {
                    var ans = confirm("Aun no registras este producto seguro de eliminarlo?");
                    if (ans == true) {
                        jQuery("#" + idBox).remove();
                    }
                } else {
                    if (entry.ans) {
                        jQuery("#" + idBox).remove();
                    }
                }
            }
        });
    }
}