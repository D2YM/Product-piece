<?php
    $sqls = array();
    $sqls[] = 'DROP  TABLE IF EXISTS '._DB_PREFIX_.'product_pieces_config';
    $sqls[] = 'DROP  TABLE IF EXISTS '._DB_PREFIX_.'product_pieces_tab';
    $sqls[] = 'DROP  TABLE IF EXISTS '._DB_PREFIX_.'product_pieces';
    $sqls[] = 'DROP  TRIGGER '._DB_PREFIX_.'products__AD';

foreach($sqls as $sql)
{
    if(!DB::getInstance()->execute($sql))
        return false;
}