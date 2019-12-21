<?php
class ProductpieceListpieceModuleFrontController extends ModuleFrontController{
    public function __construct()
    {
        parent::__construct();
    }
    public function init()
    {
        parent::init();
    }
    public function initContent()
    {
        parent::initContent();

        $data = $this->getData(Tools::getValue('id'));
        $product = $this->getProduct(Tools::getValue('id'));
        $urls_piece = $this->getProductsURL(Tools::getValue('id')) ;
        $productoUrl = new Product((int)Tools::getValue('id'));			
        $link = new Link();
        $url = $url = $link->getProductLink($productoUrl);
        $module_dir_img_piece = '';
        
        if(file_exists(_PS_MODULE_DIR_.'productpiece/views/img/products/p-'.Tools::getValue('id').'/product-'.Tools::getValue('id').'.jpg')):
            $module_dir_img_piece = _PS_BASE_URL_.'/modules/productpiece/views/img/products/p-'.Tools::getValue('id').'/product-'.Tools::getValue('id').'.jpg';
        elseif(file_exists(_PS_MODULE_DIR_.'productpiece/views/img/products/p-'.Tools::getValue('id').'/product-'.Tools::getValue('id').'.jpeg')):
            $module_dir_img_piece = _PS_BASE_URL_.'/modules/productpiece/views/img/products/p-'.Tools::getValue('id').'/product-'.Tools::getValue('id').'.jpeg';
        elseif(file_exists(_PS_MODULE_DIR_.'productpiece/views/img/products/p-'.Tools::getValue('id').'/product-'.Tools::getValue('id').'.png')):
            $module_dir_img_piece = _PS_BASE_URL_.'/modules/productpiece/views/img/products/p-'.Tools::getValue('id').'/product-'.Tools::getValue('id').'.png';
        else:
            $module_dir_img_piece = _PS_BASE_URL_.__PS_BASE_URI__.'img/image-piece.jpg';
        endif;
        global $cookie;
        $currency = new CurrencyCore($cookie->id_currency);
        $my_currency_iso_code = $currency->iso_code;
        $this->context->smarty->assign(
            array(
              'product_id' => Tools::getValue('id'),
              'piece' => $data,
              'products' => $product,
              'urls_piece' => $urls_piece, 
              'single_product' => $url,
              'static_token' => Tools::getToken(false),
              'img_dir' => _PS_BASE_URL_.__PS_BASE_URI__,
              'module_dir_img_piece' => $module_dir_img_piece,
              'currency' =>  $my_currency_iso_code
            ));
            
        $this->setTemplate('module:productpiece/views/templates/front/listpieces.tpl');
    }

    // @overwriting of the frontController method
    protected function getBreadcrumbLinks()
    {
        // Obtenemos el producto
        $producto= new Product((int)Tools::getValue('id'), (int)$this->context->language->id);
        
        // obtememos la categoria
        $category = new Category((int)$producto->id_category_default, (int)$this->context->language->id);
        
        $breadcrumb = parent::getBreadcrumbLinks(); /* Get the Breadcrumb array from the parent function which is situated in the FrontController.php */
        
         $breadcrumb['links'][] = array(
         'title' => $this->module->l('Products', 'productpiece') , /* Title which you want to give to the location */
         'url' => $this->context->link->getCategoryLink((int)2),
         );
          
         $breadcrumb['links'][] = array(
         'title' => $category->name , /* Title which you want to give to the location */
         'url' => $this->context->link->getCategoryLink((int)$producto->id_category_default),  /* URL which you want to provide for a location */
         );
         
        $breadcrumb['links'][] = array(
         'title' => $this->module->l('Spare parts', 'productpiece') , /* Title which you want to give to the location */
         'url' => '' /* URL which you want to provide for a location */
         );     
          
         $breadcrumb['links'][] = array(
         'title' => $producto->name[1] , /* Title which you want to give to the location */
         'url' => '' /* URL which you want to provide for a location */
         );
          
         return $breadcrumb;
    } 
     
    public function getData($idProduct)
    {
        include_once(_PS_MODULE_DIR_.'productpiece/class/listProducts.php');
        
        $productPieces = (listProducts($idProduct)) ? listProducts($idProduct) : false;
        
        if ( $productPieces ) {
        foreach ($productPieces as $piece) {
            $an = listDateProducts($piece['id_piece']);
            $image = Image::getCover($an['id_product']);
            $product = new Product($an['id_product'], false, Context::getContext()->language->id);
            $link = new Link;
            $imagePath = 'http://'.$link->getImageLink($product->link_rewrite, $image['id_image'], 'large_default');
            $json[] = array('id_product'=>$an['id_product'], 'text'=>$an['name'], 'ref'=>$an['reference'], 'url_img'=>$imagePath);
        }
        return $json;
        }
    }
    public function getProduct($idProduct)
    {
        include_once(_PS_MODULE_DIR_.'productpiece/class/listProducts.php');
        $productPieces = (listProducts($idProduct)) ? listProducts($idProduct) : false;
        if ( $productPieces ) {
        foreach ($productPieces as $piece) {
            $an = listDateProducts($piece['id_piece']);
            $image = Image::getCover($an['id_product']);
            $product = new Product($an['id_product'], false, Context::getContext()->language->id);
            $url = $this->context->link->getProductLink($product);
            $json[] = $product;
        }
        return $json;
        }
    }
    
    public function getProductsURL($idProduct)
    {
        include_once(_PS_MODULE_DIR_.'productpiece/class/listProducts.php');
        $productPieces = (listProducts($idProduct)) ? listProducts($idProduct) : false;
        if ( $productPieces ) {
        foreach ($productPieces as $piece) {
            $an = listDateProducts($piece['id_piece']);
            $image = Image::getCover($an['id_product']);
            $product = new Product($an['id_product'], false, Context::getContext()->language->id);
            $url = $this->context->link->getProductLink($product);
            $json[] = $url;
        }
        return $json;
        }
    }
    public function getToSingleProduct( $id )
    {
        $json = new Product($id, false, Context::getContext()->language->id);
        return $json;
    }
}
?>