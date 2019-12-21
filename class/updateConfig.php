<?php

    /**
     * upDate
     *
     * @param  string $textTab
     * @param  string $textTitle
     * @param  string $textButton
     *
     * @return { true: success }
     */
    function upDate($textTab = NULL, $textTitle = NULL, $textButton = NULL)
    { 
        $tableConfig = 'product_pieces_config';
        $sql = 'SELECT * FROM '._DB_PREFIX_.$tableConfig;
        $ans = DB::getInstance()->executeS($sql);
        if(empty($ans)):
            if(!empty($textTab)&&!empty($textTitle)&&!empty($textButton)):
                //$sql = 'SELECT * FROM '._DB_PREFIX_.'product_pieces_config';
                $datos = array(
                    'id' => 1,
                    'name_tab' => $textTab,
                    'title_content_tab' => $textTitle, 
                    'title_button_tab' => $textButton
                );
                $ans = DB::getInstance()->insert(
                    $tableConfig,
                    $datos 
                );
                if($ans)
                    return true;
            endif;
        else:
            $where = 'id = 1';
            $ans = array();
            if(!empty($textTab)):
                $datos = array(
                    'name_tab' => $textTab
                );
                $ans[] = DB::getInstance()->update(
                    $tableConfig,
                    $datos,
                    $where
                );
            endif;
            if(!empty($textTitle)):
                $datos = array(
                    'title_content_tab' => $textTitle
                );
                $ans[] = DB::getInstance()->update(
                    $tableConfig,
                    $datos,
                    $where
                );
            endif;
            if(!empty($textButton)):
                $datos = array(
                    'title_button_tab' => $textButton
                );
                $ans[] = DB::getInstance()->update(
                    $tableConfig,
                    $datos,
                    $where
                );
            endif;
            if(!empty($ans))
                return true;            
        endif;
        return false;
    }
    
    /**
     * getData
     *
     * @return array
     */    
    function getData()
    {
        $tableConfig = 'product_pieces_config';
        $sql = 'SELECT name_tab, title_content_tab, title_button_tab FROM '._DB_PREFIX_.$tableConfig.' WHERE id = 1';
        $ans = DB::getInstance()->executeS($sql);
        return $ans[0];
    }