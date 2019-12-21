<?php
    $sqls = array();
    $sqls[] = 'CREATE TABLE IF NOT EXISTS '._DB_PREFIX_.'product_pieces_config (
        id INT(10) AUTO_INCREMENT,
        name_tab VARCHAR(50),
        title_content_tab VARCHAR(200),
        title_button_tab VARCHAR(50),
        PRIMARY KEY(id)
    ) ENGINE ='._MYSQL_ENGINE_.' DEFAULT CHARSET=UTF8';
    $sqls[] = 'CREATE TABLE IF NOT EXISTS '._DB_PREFIX_.'product_pieces_tab (
        id INT(10) AUTO_INCREMENT,
        id_product INT(10),
        description_content VARCHAR(500),
        id_lang INT(10),
        PRIMARY KEY(id)
    ) ENGINE ='._MYSQL_ENGINE_.' DEFAULT CHARSET=UTF8';
    $sqls[] = 'CREATE TABLE IF NOT EXISTS '._DB_PREFIX_.'product_pieces (
        id INT(10) AUTO_INCREMENT,
        id_product INT(10),
        id_piece INT(10),
        PRIMARY KEY(id)
    ) ENGINE ='._MYSQL_ENGINE_.' DEFAULT CHARSET=UTF8';
    $sqls[] = 'CREATE TRIGGER '._DB_PREFIX_.'products__AD BEFORE DELETE ON '._DB_PREFIX_.'product
        FOR EACH ROW DELETE FROM '._DB_PREFIX_.'product_pieces
        WHERE '._DB_PREFIX_.'product_pieces.id_piece = old.id_product OR
	          '._DB_PREFIX_.'product_pieces.id_product = old.id_product';
    foreach($sqls as $sql)
    {
        if(!DB::getInstance()->execute($sql))
            return false;
    }