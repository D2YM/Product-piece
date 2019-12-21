<?php

use PrestaShop\PrestaShop\Adapter\Image\ImageRetriever;
use PrestaShop\PrestaShop\Adapter\Product\PriceFormatter;
use PrestaShop\PrestaShop\Core\Product\ProductListingPresenter;
use PrestaShop\PrestaShop\Adapter\Product\ProductColorsRetriever;
use Symfony\Component\VarDumper\VarDumper;

class Productpiece extends Module
{
    public function __construct()
    {
        $this->name = 'productpiece';
        $this->author = 'Arigato';
        $this->version = '1.0.0';
        $this->bootstrap = true;
        parent:: __construct();
        $this->displayName = $this->l('Product Piece');
        $this->description = $this->l('This is Module for prestashop, use for select piece of product');
        $this->ps_versions_compliancy = array('min'=> '1.7.0.0', 'max'=>'1.7.9.9');
        
        
    }
    public function install()
    {
        include_once($this->local_path.'class/install.php');
        return parent::install() &&
                $this->registerHook('header') &&
                $this->registerHook('displayHeader') &&
                $this->registerHook('displayTabPiece') &&
                $this->registerHook('displayTabContentPiece') &&
                $this->registerHook('displayAdminProductsExtra') &&
                $this->registerHook('displayBackOfficeHeader');
    }
    public function uninstall()
    {
        include_once($this->local_path.'class/uninstall.php');
        return parent::uninstall();
    }
    public function hookDisplayTabPiece()
    {
        $this->context->smarty->assign(array(
            'list_parameters' => $this->getDataConfig()
        ));
        return $this->display(__FILE__,'views/templates/hook/tabpiece.tpl');
    }
    public function hookDisplayTabContentPiece($params)
    {
        /*global $cookie, $link;
        $product = new Product((int)Tools::getValue('id_product'), false, (int)$cookie->id_lang);
        $productLink = $link->getProductLink($product);*/
        $this->context->smarty->assign(array(
            'idShopProduct' =>  '',
            'datos' => $this->getTabContentDiscrption(),
            'list_parameters' => $this->getDataConfig(),
            'idProductValue' =>(int)Tools::getValue('id_product')
        ));
        return $this->display(__FILE__,'views/templates/hook/tabcontentpiece.tpl');
    }
    public function hookDisplayHeader($params)
    {
        Media::addJsDef(array(
            'mp_ajax' => $this->_path.'ajax.php'
        ));
        $this->context->controller->addCSS(array(
            $this->_path.'views/css/style.css'
        ));
        $this->context->controller->addJS(array(
            $this->_path.'views/js/main.js'
        ));
    }
    public function hookHeader($params)
    {
        Media::addJsDef(array(
            'mp_ajax' => $this->_path.'helps/ajax.php'
        ));
        $this->context->controller->addCSS(array(
            $this->_path.'views/css/style.css'
        ));
        $this->context->controller->addJS(array(
            $this->_path.'views/js/main.js'
        ));
    }
    public function getContent()
    {
        Media::addJsDef(array(
            'mp_ajax' => $this->_path.'helps/ajax.php'
        ));
        $this->context->controller->addCSS(array(
            $this->_path.'views/css/style.css'
        ));
        $this->context->controller->addJS(array(
            $this->_path.'views/js/bootstrap.bundle.min.js'
        ));
        $this->context->controller->addJS(array(           
            $this->_path.'views/js/main.js'
        ));
        $this->context->smarty->assign(array(
            'list_parameters' => $this->getDataConfig()
        ));
        return $this->display(__FILE__, 'views/templates/admin/configure.tpl');
    }
    public function getDataConfig()
    {
        $tableConfig = 'product_pieces_config';
        $ans = Db::getInstance()->executeS('SELECT name_tab, title_content_tab, title_button_tab FROM '._DB_PREFIX_.$tableConfig.' WHERE id = 1');
        
        if(!empty($ans)):
            return $ans[0];
        else:
            return $ans = array(
                'name_tab' => 'Piece',
                'title_content_tab' =>'Title content pieces',
                'title_button_tab' => 'Go to piece'
            );
        endif;
    }
    
    public function getTabContentDiscrption()
    {
        global $cookie, $link;
        $product = new Product((int)Tools::getValue('id_product'), false, (int)$cookie->id_lang);
        $productLink = $link->getProductLink($product);
        $id_shop = Context::getContext()->shop->id;
        $sentenceSql = 'SELECT * FROM `ps_product_pieces_tab` WHERE `id_product` = '. $product->id .'';
        $results = Db::getInstance()->ExecuteS($sentenceSql);
        return $results;
    }

    public function hookDisplayBackOfficeHeader()
    {
        apPageHelper::autoUpdateModule();
        if (method_exists($this->context->controller, 'addJquery')) {
            // validate module
            $this->context->controller->addJquery();
        }                   
        Media::addJsDef(array(
            'mp_ajax_search_products' => $this->_path.'helps/ajax_search_products.php',
            'mp_ajax_register_products' => $this->_path.'helps/ajax_register_products.php',
            'mp_ajax_delete_products' => $this->_path.'helps/ajax_delete_products.php',
            'mp_ajax_list_products' => $this->_path.'helps/ajax_list_products.php',
            'mp_ajax_upload_image_despiece' => $this->_path.'helps/ajax_upload_image_despiece.php'
        ));
        $this->context->controller->addCSS(array(
            $this->_path.'views/css/style.css'
        ));
        $this->context->controller->addCSS(array(
            $this->_path.'views/libs/select2/css/select2.css'
        ));
        $this->context->controller->addJS(array(
            $this->_path.'views/js/bootstrap.bundle.min.js'
        ));
        $this->context->controller->addJS(array(
            $this->_path.'views/libs/select2/js/select2.full.js'
        ));
        $this->context->controller->addJS(array(              
            $this->_path.'views/js/main.js'
        ));
        $this->context->controller->addJS(array(             
            $this->_path.'views/js/selectProducts.js'
        ));
    }

    public function hookDisplayAdminProductsExtra($params)
    {
        if (Validate::isLoadedObject($product = new Product((int)$params['id_product']))) {
            // validate module
            //unset($product);  
            
            $id_shop = Context::getContext()->shop->id;
            //$languages = $this->context->controller->getLanguages();
            $this->context->smarty->assign(array(
                'product' => $product,
                'languages_items' => Language::getLanguages(false, $this->context->shop->id)
            ));
            
            return $this->display(__FILE__, 'views/templates/admin/tabsProductsPieces.tpl');
        }
    }
}