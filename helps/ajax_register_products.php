<?php    
    require_once('../../../config/config.inc.php');
    require_once('../../../init.php');
    require_once('../class/updateProducts.php');
    $moduleName = 'productpiece';
    $module= Module::getInstanceByName($moduleName);
    header('Content-Type: application/json');
    $idProduct = isset($_POST['idProduct']) ? $_POST['idProduct'] : '';
    $idProductNow = $_POST['idProduct'];
    $pieces = $_POST['data'];
    $textPiece = $_POST['textPiece'];
    $vowels = array("[", "]", "\"");
    $pieces = str_replace($vowels, '', $pieces);
    $pieces = explode(",", $pieces);
    $errors = array();
    
    if(!empty($textPiece)):
        writeText($idProduct, $textPiece);
    endif;
    
    if(!empty($idProduct) && !empty($pieces)):
        foreach ($pieces as $piece):
            $ans = writeProducts($idProduct, $piece);
            if(!$ans):
                $errors[] = array("Error write" => $ans);
            elseif($ans<0):
                if($ans==(-1)):
                    $resp = alertWarning($module);
                    echo json_encode($resp, JSON_FORCE_OBJECT);
                    die();
                elseif($ans==(-2)):
                    $resp = alertWarning2($module);
                    echo json_encode($resp, JSON_FORCE_OBJECT);
                    die();
                endif;
            endif;
        endforeach;
    else:
        $resp = alertWarning($module);
        echo json_encode($resp, JSON_FORCE_OBJECT);
        die();
    endif;
    if(!$errors):
        $resp = alertSucces($module);
        echo json_encode($resp, JSON_FORCE_OBJECT);
        die();
    else:
        $resp = alertError($module);
        echo json_encode($resp, JSON_FORCE_OBJECT);
        die();
    endif;
    $resp = alertError($module);
    echo json_encode($resp, JSON_FORCE_OBJECT);
    die();

    /**
     * alertError
     *
     * @param  mixed $module
     *
     * @return string
     */
    function alertErrorImg($module)
    {
        $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">'.
                    '<strong>'.$module->l('Error', 'CustomModuleClass').'</strong> '.$module->l('Ups! Something has failed to create file image, please retry.', 'CustomModuleClass').
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'.
                        '<span class="pl-1" aria-hidden="true">&times;</span>'.
                    '</button>'.
                  '</div>';
        return $alert;
    }
    
    /**
     * alertError
     *
     * @param  mixed $module
     *
     * @return string
     */
    function alertError($module)
    {
        $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">'.
                    '<strong>'.$module->l('Error', 'CustomModuleClass').'</strong> '.$module->l('Ups! Something has failed, please retry.', 'CustomModuleClass').
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'.
                        '<span class="pl-1" aria-hidden="true">&times;</span>'.
                    '</button>'.
                  '</div>';
        return $alert;
    }
    
    /**
     * alertWarning
     *
     * @param  mixed $module
     *
     * @return string
     */    
    function alertWarning($module)
    {
        $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">'.
                    '<strong>'.$module->l('Warning', 'CustomModuleClass').'</strong> '.$module->l('Select one products for register!', 'CustomModuleClass').
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'.
                        '<span class="pl-1" aria-hidden="true">&times;</span>'.
                    '</button>'.
                  '</div>';
        return $alert;
    }
    /**
     * alertWarning
     *
     * @param  mixed $module
     *
     * @return string
     */    
    function alertWarning2($module)
    {
        $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">'.
                    '<strong>'.$module->l('Warning', 'CustomModuleClass').'</strong> '.$module->l('First Register Product!', 'CustomModuleClass').
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'.
                        '<span class="pl-1" aria-hidden="true">&times;</span>'.
                    '</button>'.
                  '</div>';
        return $alert;
    }
    /**
     * alertSucces
     *
     * @param  mixed $module
     *
     * @return string
     */    
    function alertSucces($module)
    {
        $alert ='<div class="alert alert-success alert-dismissible fade show" role="alert">'.
                    '<strong>'.$module->l('Success', 'CustomModuleClass').'</strong> '.$module->l('Your register success!.', 'CustomModuleClass').
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'.
                        '<span class="pl-1" aria-hidden="true">&times;</span>'.
                    '</button>'.
                '</div>';
        return $alert;
    }
?>