<?php

    /**
     * writeText
     *
     * @param  mixed $idProduct
     * @param  mixed $textPiece
     *
     * @return {true: Success, (-1): Warning, false: error}
     */
    function writeText($idProduct, $textPiece)
    {
        if(!empty($idProduct) && !empty($textPiece)):
            $tablePieces = 'product_pieces_tab';
            $tableProducts = 'product';
            $issetProduct = 'SELECT id_product FROM ' . _DB_PREFIX_.$tableProducts . ' WHERE id_product = ' . $idProduct;
            
            if ( !empty(DB::getInstance()->executeS($issetProduct)) ):
                $sql = 'SELECT id_product FROM '._DB_PREFIX_.$tablePieces.' WHERE id_product='.$idProduct;   
                $ans = DB::getInstance()->executeS($sql);
                if(!$ans):
                    $datos = array(
                        'id_product' => $idProduct,
                        'description_content' => $textPiece
                    );
                    $ans = DB::getInstance()->insert(
                        $tablePieces,
                        $datos 
                    );
                    return $ans;
                else:
                    $datos = array(
                        'id_product' => $idProduct,
                        'description_content' => $textPiece
                    );
                    $where = 'id_product = '.$idProduct;
                    $ans = DB::getInstance()->update(
                        $tablePieces,
                        $datos,
                        $where
                    );
    
                endif;
                return true;
            endif;
        else:
            return(-1);
        endif;
    }
    
    /**
     * writeProducts
     *
     * @param  mixed $idProduct
     * @param  mixed $idPiece
     *
     * @return {true: Success, (-1): Warning, false: error}
     */    
    function writeProducts($idProduct, $idPiece)
    {
        if(!empty($idPiece) && !empty($idProduct)):
            $tableConfig = 'product_pieces';
            $tableProducts = 'product';
            $issetProduct = 'SELECT id_product FROM ' . _DB_PREFIX_.$tableProducts . ' WHERE id_product = ' . $idProduct;
            if ( !empty(DB::getInstance()->executeS($issetProduct)) ):
                $sql = 'SELECT id_product, id_piece FROM '._DB_PREFIX_.$tableConfig.' WHERE id_product='.$idProduct.' AND id_piece='.$idPiece;   
                $ans = DB::getInstance()->executeS($sql);
                if(!$ans):
                    $datos = array(
                        'id_product' => $idProduct, 
                        'id_piece' => $idPiece
                    );
                    $ans = DB::getInstance()->insert(
                        $tableConfig,
                        $datos 
                    );
                    return $ans;
                endif;
                return true;
            else:
                return(-2);
            endif;
        else:
            return(-1);
        endif;
    }
?>