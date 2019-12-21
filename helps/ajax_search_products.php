<?php
    require_once('../../../config/config.inc.php');
    require_once('../../../init.php');
    require_once('../class/searchProducts.php');
    $moduleName = 'productpiece';
    $module= Module::getInstanceByName($moduleName);
    $search = $_POST['q'];
    $qR = searcSQL($search);
    echo json_encode($qR);
    die();

    /**
     * searcSQL
     *
     * @param  string $q
     *
     * @return json
     */
    function searcSQL($q)
    {
        $ans = searchProducts($q);
        $json = [];
        foreach($ans as $an):
            $image = Image::getCover($an['id_product']);
            $product = new Product($an['id_product'], false, Context::getContext()->language->id);
            $link = new Link;
            $imagePath = 'http://'.$link->getImageLink($product->link_rewrite, $image['id_image'], 'home_default');
            //print_r($imagePath);
            $json[] = array('id'=>$an['id_product'], 'text'=>$an['name'], 'ref'=>$an['reference'], 'url_img'=>$imagePath);
        endforeach;
        return $json;
    }