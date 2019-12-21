<?php
    require_once('../../../config/config.inc.php');
    require_once('../../../init.php');
    require_once('../class/listProducts.php');
    $moduleName = 'productpiece';
    header('Content-Type: application/json');
    $module= Module::getInstanceByName($moduleName);
    $idProduct = isset($_POST['idProduct']) ? $_POST['idProduct'] : '';
    if(!empty($idProduct)):
        $ans = listProducts($idProduct);
        $text = setTextPice($idProduct);
        $json = [];
    
        if ( !empty($ans) ) :
            foreach($ans as $anP):
                $an = listDateProducts($anP['id_piece']);
                $image = Image::getCover($an['id_product']);
                $product = new Product($an['id_product'], false, Context::getContext()->language->id);
                $link = new Link;
                $imagePath = 'http://'.$link->getImageLink($product->link_rewrite, $image['id_image'], 'home_default');
                $json[] = array('id'=>$an['id_product'], 'text'=>$an['name'], 'ref'=>$an['reference'], 'url_img'=>$imagePath);
                
            endforeach;
        endif;
        $data = array(
            'Json' => $json,
            'text' => $text
        );
        echo json_encode($data, JSON_FORCE_OBJECT);
        die();
    endif;
        

?>