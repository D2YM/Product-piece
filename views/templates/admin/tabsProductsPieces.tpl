<div class="panel piece" id="piece">
   <div id="related-content" class="content pl-3 pr-3 { form.vars.value.data|length == 0 ? 'hide':'' }">
        <div class="col-md-12">
            <div id="alert-request"></div>
            <h2></h2>
        </div>
        <div class="row flex-wrap">
        
            <div class="col-12 image-box mt-4 mb-4 row">
                <div id="image-piece" class="col-md-6">
                    <div id="box-image-piece">
                        <img id="image-piece-main" src="" height="200" width="200" alt="Image preview...">
                    </div>
                </div>
                <div class="input-group col-6">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="inputFileImgPiece" aria-describedby="inputFileImgPiece" onchange="previewFile()">
                    <label class="custom-file-label" for="inputFileImgPiece">{l s='Choose image' mod='productpiece'}</label>
                  </div>
                  <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" id="upload-img-despiece">{l s='Upload' mod='productpiece'}</button>
                  </div>
                </div>
            </div>
            <div class="col-12 box-text-piece">
                <div class="form-group">
                    <label for="notePieces">{l s='Insert your coment for piece' mod='productpiece'}</label>
                    <div class="input-group">
                    <textarea class="form-control" id="notePieces" rows="3"></textarea>
                      <div class="input-group-prepend p-3 text-uppercase">
                        {foreach $languages_items as $item}
                            {$item.language_code}
                        {/foreach}
                          {$languages_items.language_code}
                          <select class="custom-select" id="inputGroupSelect01" style="display:none;">
                          {foreach $languages_items as $item}
                            <option value="{$item.id_lang}" {if $item.active === 1} class="hola" {/if}>{$item.language_code}</option>
                          {/foreach}
                          </select>
                      </div>
                    </div>
                </div>
            </div>
            <div class="col-12 box-piece-select">
                {*<button type="button" class="btn btn-outline-primary sensitive open { form.vars.value.data|length > 0 ? 'hide':'' }" id="add-related-product-button">
                <i class="material-icons">add_circle</i> { l s='Add a related product' mod='productpiece'}
                </button>*}
                <select id="piece-select" class="js-data-example-ajax">{l s='Select the pieces of the list products' mod='productpiece'}</select>
            </div>
            <div data-form="sendPiece" class="col-12">
                
                <div id="box-select-items" class="box-piece-select">
                </div>
                <input id="idProductNow" type="hidden" value="{$product->id}"/>
                <div class="btn-group mt-4">
                    <a id="save-piece" class="btn btn-primary text-white">{l s='Salve' mod='productpiece'}</a>
                </div>
            </div>
        </div>
    </div>
    {*$product|@print_r*}
</div>