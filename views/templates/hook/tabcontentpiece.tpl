<div class="tab-pane fade in" id="product-pieces">
    <h3 class="h3">{l s=$list_parameters['title_content_tab'] mod='productpiece'}</h3>
    <p>{if isset($datos[0]['description_content'])} {$datos[0]['description_content']} {/if}</p>
    <a clas="btn btn-primary" href="/lista-de-piezas?id={$idProductValue}">{l s=$list_parameters['title_button_tab'] mod='productpiece'}</a>
</div>