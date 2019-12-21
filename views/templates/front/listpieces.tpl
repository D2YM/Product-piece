{extends file="page.tpl"}
{block name="content"}
    {block name='product_price_and_shipping'}
    {if !$piece}
    
        <div class="row page-piece">
            <div class="col-md-6 col-xs-12 column-img">
                <img src="{$img_dir}img/image-piece.jpg" alt="Imagen de piezas" class="img-fluid">
            </div>
            <!--./column-img-->
            <div class="col-md-6 col-xs-12 column-content column-content-no-piece">
                <div class="list-group piece-content">
                    <div class="list-group-item d-flex align-items-center list-group-horizontal px-1">
                        <div class="title w-10">#</div>
                        <div class="title w-35">Descripción</div>
                        <div class="title w-18">Precio</div>
                        <div class="title w-18">Cantidad</div>
                        <div class="title"></div>
                    </div>
                    <div class="list-group-item list-group-item-content px-1">
                        <span>{l s='The product has no assigned or available parts' mod='productpiece'}</span>
                    </div>
                    <!--./list-group-item-content-->
                </div>
                <!--./piece-content-->
            </div>
            <!--/column-content-->
            <div class="col-xs-6"></div>
            <div class="col-md-6 col-sm- col-xs-12 content-piece-btn">
                <a href="{$single_product}" class="btn btn-success">{l s='Return to product' mod='productpiece'}</a>
            </div>
        </div><!-- ./row-->   
    {else}
    
        <div class="row page-piece">
            <div class="col-md-6 col-xs-12 column-img">
                <img src="{$module_dir_img_piece}" alt="Imagen de piezas" class="img-fluid">
               
            </div>
            <!--./column-img-->
            <div class="col-md-6 col-xs-12 column-content">
                <div class="list-group piece-content">
                    <div class="list-group-item d-flex align-items-center list-group-horizontal px-1">
                        <div class="title w-10">#</div>
                        <div class="title w-35">Descripción</div>
                        <div class="title w-18">Precio</div>
                        <div class="title w-18">Cantidad</div>
                        <div class="title"></div>
                    </div>
                    {foreach from=$products item=$product key=$i}
                    {if $product->show_price}
                    <div class="list-group-item list-group-item-content px-1">
                        
                        <form name="addtocart" id="addtocart_form" method="POST" action="{$urls.pages.cart}">
                            
                                
                                <div class="list-group-piece-id w-10">
                                    <span>{counter}</span>
                                    <a href="javascript:void(0);" class="cambio-de-img" data-img-url="{$piece[$i]['url_img']}" data-img-name="{$piece[$i]['text']}">
                                        <i class="material-icons">visibility</i>
                                    </a>
                                </div>
                                <div class="list-group-piece-title w-35">
                                    <a href="{$urls_piece[$i]}" target="_blank" class="img-new-tab">
                                      <h5 class="h5 m-0 font-weight-bold">{$piece[$i]['text']}</h5>
                                    </a>
                                    <span class="d-block font-weight-normal">{$product->reference}</span>
                                </div>
                                <div class="list-group-piece-price w-18">{$product->price|string_format:"%.2f"}<span class="">{$currency}</span></div>
                                <div class="list-group-piece-qty w-18 clearfix">
                                    <div class="input-group bootstrap-touchspin">
                                        <span class="input-group-addon bootstrap-touchspin-prefix"
                                            style=" display: none; "></span>
                                        <input type="text" name="qty" id="quantity_wanted" value="1" class="input-group form-control qty qty_product qty_product_{$piece[$i]['id_product']} js-cart-line-product-quantity form-control" min="1" aria-label="Cantidad"
                                            style="display: block;" data-min="1">
                                        <span class="input-group-addon bootstrap-touchspin-postfix"
                                            style=" display: none; "></span>
                                        <span class="input-group-btn-vertical">
                                            <button class="btn btn-touchspin js-touchspin bootstrap-touchspin-up"
                                                type="button"><i class="material-icons touchspin-up"></i></button>
                                            <button class="btn btn-touchspin js-touchspin bootstrap-touchspin-down"
                                                type="button"><i class="material-icons touchspin-down"></i></button>
                                        </span>
                                    </div>
                                </div>
                                <div class="list-group-piece-button">
                                    <input type="hidden" name="id_product" id="product_id" value="{$piece[$i]['id_product']}">
                                    <button class="btn btn-primary btn-product add-to-cart leo-bt-cart leo-bt-cart_{$piece[$i]['id_product']} leo-enable" data-button-action="add-to-cart" type="submit">
                                        <span class="leo-loading cssload-speeding-wheel"></span>
                                        <span class="leo-bt-cart-content">
                                            <i class="icon-btn-product icon-cart material-icons shopping-cart"></i>
                                            <span class="name-btn-product">{l s='Add' mod='productpiece'}</span>
                                        </span>
                                    </button>
                                </div>
                            
                            
                        </form>
                    </div>
                    <!--./list-group-item-content-->
                    {/if}
                    {/foreach}
                  
                </div>
                <!--./piece-content-->
            </div>
            <!--/column-content-->
            <div class="col-xs-6"></div>
            <div class="col-md-6 col-sm- col-xs-12 content-piece-btn">
                <a href="{$single_product}" class="btn btn-success">{l s='Return to product' mod='productpiece'}</a>
            </div>
        </div><!-- ./row-->    
        {foreach from=$products item=$product key=$i}
            {if $product->show_price}
                <!--<div class="product-price-and-shipping">
                    <span>{$piece[$i]['text']}</span>
        
                    <span itemprop="price" class="price">{$product->price}</span>
                    <div class="button-container cart">
                        <form name="addtocart" id="addtocart_form" method="POST" action="{$urls.pages.cart}">
                            <input type="hidden" name="id_product" id="product_id" value="{$piece[$i]['id_product']}">                            
                            <input name="qty" type="text" class="input-group form-control qty qty_product qty_product_{$piece[$i]['id_product']}" value="1"  data-min="1">

                            <input type="hidden" name="token" value="{$static_token}">
                            <button class="btn btn-primary btn-product add-to-cart leo-bt-cart leo-bt-cart_{$piece[$i]['id_product']} leo-enable" data-button-action="add-to-cart" type="submit">
                                <span class="leo-loading cssload-speeding-wheel"></span>
                                <span class="leo-bt-cart-content">
                                    <i class="icon-btn-product icon-cart material-icons shopping-cart"></i>
                                    <span class="name-btn-product">Añadir al carrito</span>
                                </span>
                            </button>
                        </form>
                    </div>
                </div>-->
            {/if}
        {/foreach}
    {/if}
    {/block}
{/block}