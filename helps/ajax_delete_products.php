<?php 
    require_once('../../../config/config.inc.php');
    require_once('../../../init.php');
    require_once('../class/deleteProducts.php');
    $moduleName = 'productpiece';
    $module= Module::getInstanceByName($moduleName);
    $idProduct = $_POST['idProduct'];
    $idPiece = $_POST['idPiece'];
    header('Content-Type: application/json');

    if(!empty($idProduct) && !empty($idPiece)):
        $ans = deleteProduct($idProduct, $idPiece);
        if($ans):
            if($ans<0):               
                $dates = array(
                    'alert' => alertWarning($module),
                    'ans' => $ans
                );
                echo json_encode($dates, JSON_FORCE_OBJECT);
                die;
            else:
                $dates = array(
                    'alert' => alertSucces($module),
                    'ans' => $ans
                );
                echo json_encode($dates, JSON_FORCE_OBJECT);
                die;
            endif;
        else:
            $dates = array(
                'alert' => alertError($module),
                'ans' => $ans
            );
            echo json_encode($dates, JSON_FORCE_OBJECT);
            die;
        endif;
    endif;
    
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
                    '<strong>'.$module->l('Warning', 'CustomModuleClass').'</strong> '.$module->l('Products no register!', 'CustomModuleClass').
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
                    '<strong>'.$module->l('Success', 'CustomModuleClass').'</strong> '.$module->l('Product is delete!.', 'CustomModuleClass').
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'.
                        '<span class="pl-1" aria-hidden="true">&times;</span>'.
                    '</button>'.
                '</div>';
        return $alert;
    }
?>