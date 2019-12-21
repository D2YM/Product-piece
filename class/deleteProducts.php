<?php
    /**
     * deleteProduct
     *
     * @param  mixed $idProduct
     * @param  mixed $idPiece
     *
     * @return void
     */
    function deleteProduct($idProduct, $idPiece){
        
        if(!empty($idPiece) && !empty($idProduct)):
            $tableConfig = 'product_pieces';            
            $sql = 'SELECT id_product, id_piece FROM '._DB_PREFIX_.$tableConfig.' WHERE id_product='.$idProduct.' AND id_piece='.$idPiece;   
            $ans = DB::getInstance()->executeS($sql);            
            if($ans):
                $where = 'id_product = '.$idProduct.' AND id_piece='.$idPiece;
                $ans = DB::getInstance()->delete(
                    $tableConfig,
                    $where 
                );
                return $ans;
            else:
                return (-1);
            endif;
            return true;
        else:
            return false;
        endif; 
    }
?>