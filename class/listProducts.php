<?php
    function setTextPice($idProduct)
    {
        if(!empty($idProduct)):
            $tableProductPieces = 'product_pieces_tab';            
            $sql = 'SELECT description_content FROM '._DB_PREFIX_.$tableProductPieces.' WHERE id_product='.$idProduct;   
            $ans = DB::getInstance()->executeS($sql);
            if($ans):
                return $ans[0];
            else:
                return false;
            endif;
        else:
            return(-1);
        endif;
    }
    function listProducts($idProduct)
    {
        if(!empty($idProduct)):
            $tableConfig = 'product_pieces';            
            $tableProducts = 'products';
            
            $sql = 'SELECT id_piece FROM '._DB_PREFIX_.$tableConfig.' WHERE id_product='.$idProduct;   
            $ans = DB::getInstance()->executeS($sql);
            if($ans):
                return $ans;
            else:
                return false;
            endif;
        else:
            return(-1);
        endif;
    }
    function listDateProducts($idPiece)
    {
        if(!empty($idPiece)):
            $tableProductName = 'product_lang';
            $tableProducReference = "product";
            global $cookie;
            $iso_code = (int)$cookie->id_lang;
            $sql = 'SELECT '._DB_PREFIX_.$tableProducReference.'.id_product, '._DB_PREFIX_.$tableProducReference.'.reference, '._DB_PREFIX_.$tableProductName.'.id_product, '._DB_PREFIX_.$tableProductName.'.name FROM '._DB_PREFIX_.$tableProductName.' INNER JOIN '._DB_PREFIX_.$tableProducReference.' ON '._DB_PREFIX_.$tableProducReference.'.id_product = '._DB_PREFIX_.$tableProductName.'.id_product WHERE ('._DB_PREFIX_.$tableProducReference.'.id_product = '.$idPiece.' AND '._DB_PREFIX_.$tableProductName.'.id_product = '.$idPiece.') and '._DB_PREFIX_.$tableProductName.'.id_lang='.$iso_code;
            $ans = DB::getInstance()->executeS($sql);
            if($ans):
                return $ans[0];
            else:
                return false;
            endif;
        else:
            return(-1);
        endif;
    }
?>