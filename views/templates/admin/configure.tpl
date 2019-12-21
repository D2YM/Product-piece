<div id="config_piece" class="piece">
    <div class="panel">
        <div class="panel-heading">
            {l s='Mode use' mod='productpiece'}
        </div>
        <div class="panel-body row">
            <div class="col">
                <h2 class="h2">{l s='Hook use for module' mod='productpiece'}</h2>
                <p class="d-block h4">{l s='The hook use for module, is insert in' mod='productpiece'}: <span class="text-primary"><strong>/themes/YOUR_THEME/templates/sub/product_info/tab.tpl</strong></span></p>
                <br>
                <p class="d-block">{l s='Use two hook in the module, for the tab in product detail.' mod='productpiece'}</p>
                <div class="row col-xs-12 mt-4 border-1">
                    <div class="col-3 pl-0 pr-0 bg-light">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="text-decoration-none border nav-link active" id="title-tab-tab" data-toggle="pill" href="#title-tab" role="tab" aria-controls="title-tab" aria-selected="true">{l s='Tab Title' mod='productpiece'}</a>
                            <a class="text-decoration-none border nav-link" id="content-tab-tab" data-toggle="pill" href="#content-tab" role="tab" aria-controls="content-tab" aria-selected="false">{l s='Tab content' mod='productpiece'}</a>
                        </div>
                    </div>
                    <div class="col-9 pt-2 pb-2 bg-light">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="title-tab" role="tabpanel" aria-labelledby="title-tab-tab">
                                <p>{l s='This hook is use as title of the tab. That is incruste in' mod='productpiece'}: product-tab>nav-tabs</p>
                                <span class="text-primary"><strong>{literal}{hook h='displayTabPiece'}{/literal}</strong></span>
                            </div>
                            <div class="tab-pane fade" id="content-tab" role="tabpanel" aria-labelledby="content-tab-tab">
                                <p>{l s='This hook is use as content of the tab. That is incruste in' mod='productpiece'}: product-tab>tab-pane</p>
                                <span class="text-primary"><strong>{literal}{hook h='displayTabContentPiece'}{/literal}</strong></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <button type="submit" name="post-config" class="btn btn-default pull-right">
                <i class="process-icon-save"></i>
                {l s='Save' mod='productpiece'}
            </button>
        </div>
    </div>

    <form id="configure-form">
        <div class="panel" method="post">
            <div class="panel-heading">
                {l s='Configuration' mod='productpiece'}
            </div>
            <div class="panel-body row">
                <div id="boxAlert"></div>
                <h2 class="h2 col-12 mb-3">{l s='Please, intro information in the input' mod='productpiece'}</h2>
                <div class="form-group col-lg-6 border p-2 border-radius-x2">
                    <div class="panel-heading m-0">
                        <label for="textTab">{l s='Text in tab' mod='productpiece'}</label>
                    </div>
                    <div class="panel-body">
                        <span class="d-block bg-info text-white p-2 mb-2 border-radius-x1"><strong>{l s='Text in tab now: ' mod='productpiece'}</strong><span id="labelTab">{l s=$list_parameters['name_tab'] mod='productpiece'}</span></span>
                        <input name="textTab" type="text" class="form-control" id="textTab" aria-describedby="helpTab" placeholder="Enter text button">
                        <small id="helpTab" class="form-text text-muted">{l s='This text show in title tab.' mod='productpiece'}</small>
                    </div>
                </div>
                <div class="form-group col-lg-6 border p-2 border-radius-x2">
                    <div class="panel-heading m-0">
                        <label for="textTitle">{l s='Title in content tab' mod='productpiece'}</label>
                    </div>
                    <input name="id" type="hidden" value="1">
                    <div class="panel-body">
                        <span class="d-block bg-info text-white p-2 mb-2 border-radius-x1"><strong>{l s='Title in content tab now: ' mod='productpiece'}</strong><span id="labelTitle">{l s=$list_parameters['title_content_tab'] mod='productpiece'}</span></span>                
                        <input name="textTitle" type="text" class="form-control" id="textTitle" aria-describedby="helpTitle" placeholder="Enter title content tab">
                        <small id="helpTitle" class="form-text text-muted">{l s='This title in content tab.' mod='productpiece'}</small>
                    </div>
                </div>
                <div class="form-group col-lg-6 border p-2 border-radius-x2">
                    <div class="panel-heading m-0">
                        <label for="textButton">{l s='Title for button, redirect to pieces' mod='productpiece'}</label>
                    </div>
                    <div class="panel-body">
                        <span class="d-block bg-info text-white p-2 mb-2 border-radius-x1"><strong>{l s='Title for button now: ' mod='productpiece'}</strong><span id="labelButton">{l s=$list_parameters['title_button_tab'] mod='productpiece'}</span></span>                    
                        <input name="textButton" type="text" class="form-control" id="textButton" aria-describedby="helpButton" placeholder="Enter title of button">
                        <small id="helpButton" class="form-text text-muted">{l s='This title in button of redirect.' mod='productpiece'}</small>
                    </div>
                </div>            
            </div>
            <div class="panel-footer">
                <label id="radom_number"></label>
                <button type="submit" name="post-config" class="btn btn-default pull-right">
                    <i class="process-icon-save"></i>
                    {l s='Save' mod='productpiece'}
                </button>
            </div>
        </div>
    </form>
</div>