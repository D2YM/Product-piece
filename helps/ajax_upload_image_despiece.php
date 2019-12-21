<?php    
    require_once('../../../config/config.inc.php');
    require_once('../../../init.php');
    $moduleName = 'productpiece';
    $module= Module::getInstanceByName($moduleName);
    header('Content-Type: application/json');
    //$idProduct = isset($_POST['idProduct']) ? $_POST['idProduct'] : '';
    $idProduct = $_POST['idProduct'];
    $initGet = isset($_POST['init']) ? $_POST['init'] : 0;
    $errors = array();
    if($initGet):
        $resp =getImagePiece($module,$idProduct);
        echo json_encode($resp, JSON_FORCE_OBJECT);
        die();
    else:
        $imgPiece = $_FILES['imagePiece'];
        $resp =uploadImage($module,$idProduct, $imgPiece);
        echo json_encode($resp, JSON_FORCE_OBJECT);
        die();
    endif;
    
    function uploadImage($module,$idProductNow,$imgPiece)
    {
        $target_dir = "../views/img/products/";
        if(!file_exists($target_dir.'p-'.$idProductNow)):
            if(!mkdir($target_dir.'p-'.$idProductNow, 0755, true)):
                $resp = alertErrorImg($module);
            endif;
        endif;
        if(isset($imgPiece)):
          $errors= array();
          $file_name = $imgPiece['name'];
          $file_size =$imgPiece['size'];
          $file_tmp =$imgPiece['tmp_name'];
          $file_type=$imgPiece['type'];
          $temp = explode('.',$imgPiece['name']);
          
          $file_ext=strtolower(end($temp));
          //print_r(end($temp));die();
          $extensions= array("jpeg","jpg","png");
          
          if(in_array($file_ext,$extensions)=== false):
             $errors[]="extension not allowed, please choose a JPEG or PNG file.";
          endif;
          
          if($file_size > 2097152):
             $errors[]='File size must be excately 2 MB';
          endif;
          
          if(empty($errors)==true):
             move_uploaded_file($file_tmp,$target_dir.'p-'.$idProductNow.'/product-'.$idProductNow.'.'.$file_ext);
             clearstatcache();
             $resp = alertSucces($module);
          else:
             $resp = alertError($module);
          endif;
       endif;
       return $resp;
    }
    
    function getImagePiece($module,$idProductNow){
        $target_dir = "../views/img/products/";
        $target_dir_module = "/modules/productpiece/views/img/products/";
        $nameImageJPG = $target_dir.'p-'.$idProductNow.'/product-'.$idProductNow.'.jpg';
        $nameImageJPEG = $target_dir.'p-'.$idProductNow.'/product-'.$idProductNow.'.jpeg';
        $nameImagePNG = $target_dir.'p-'.$idProductNow.'/product-'.$idProductNow.'.png';
        
        $nameDirImageJPG = $target_dir_module.'p-'.$idProductNow.'/product-'.$idProductNow.'.jpg';
        $nameDirImageJPEG = $target_dir_module.'p-'.$idProductNow.'/product-'.$idProductNow.'.jpeg';
        $nameDirImagePNG = $target_dir_module.'p-'.$idProductNow.'/product-'.$idProductNow.'.png';
        if (file_exists($nameImageJPG)||file_exists($nameImageJPEG)||file_exists($nameImagePNG)):
            if(file_exists($nameImageJPG)):
                return $nameDirImageJPG;
            elseif(file_exists($nameImageJPEG)):
                return $nameDirImageJPEG;
            elseif(file_exists($nameImagePNG)):
                return $nameDirImagePNG;
            else:
                return NULL;
            endif;
        endif;
    }
    
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
                    '<strong>'.$module->l('Success', 'CustomModuleClass').'</strong> '.$module->l('Your upload image, success!.', 'CustomModuleClass').
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'.
                        '<span class="pl-1" aria-hidden="true">&times;</span>'.
                    '</button>'.
                '</div>';
        return $alert;
    }
?>