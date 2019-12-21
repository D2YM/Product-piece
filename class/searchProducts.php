<?php
    /**
     * searchProducts
     *
     * @param  string $q
     *
     * @return array data
     */
    function searchProducts($q)
    {
        global $cookie;
        $iso_code = (int)$cookie->id_lang;
        $tableProductName = 'product_lang';
        $tableProducReference = "product"; 
        $sql = 'SELECT '._DB_PREFIX_.$tableProducReference.'.id_product, '._DB_PREFIX_.$tableProducReference.'.reference, '._DB_PREFIX_.$tableProductName.'.id_product, '._DB_PREFIX_.$tableProductName.'.name FROM '._DB_PREFIX_.$tableProductName.' INNER JOIN '._DB_PREFIX_.$tableProducReference.' ON '._DB_PREFIX_.$tableProducReference.'.id_product = '._DB_PREFIX_.$tableProductName.'.id_product WHERE ('._DB_PREFIX_.$tableProducReference.'.reference LIKE \'%'.$q.'%\' or '._DB_PREFIX_.$tableProductName.'.name LIKE \'%'.$q.'%\') and '._DB_PREFIX_.$tableProductName.'.id_lang='.$iso_code;
        $ans = DB::getInstance()->executeS($sql);
        return $ans;
    }