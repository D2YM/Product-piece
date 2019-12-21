<?php
    require_once('../../../config/config.inc.php');
    require_once('../../../init.php');
    require_once('../class/updateConfig.php');
    $id = $_POST["id"];    
    $moduleName = 'productpiece';
    $module= Module::getInstanceByName($moduleName);
    header('Content-Type: application/json');

    switch($id)
    {
        case 1:
            configTab($module);
        break;
    }
    
    /**
     * configTab
     *
     * @param  mixed $module
     *
     * @return void
     */    
    function configTab($module)
    {
        $textTab = $_POST["textTab"];
        $textTitle = $_POST["textTitle"];
        $textButton = $_POST["textButton"];
        if(!empty($textTab)||!empty($textTitle)||!empty($textButton)):
            if(upDate($textTab, $textTitle, $textButton)):                
                $datos = array(
                    'ans' => alertSucces($module),
                    'dataNow' => getData()
                );
                echo json_encode($datos, JSON_FORCE_OBJECT);
            else:
                $datos = array(
                    'ans' => alertError($module),
                    'dataNow' => getData()
                );
                echo json_encode($datos, JSON_FORCE_OBJECT);
            endif;
            die();
        else:
            $datos = array(
                'ans' => alertWarning($module),
                'dataNow' => getData()
            );
            echo json_encode($datos, JSON_FORCE_OBJECT);
            die();
        endif;
        $datos = array(
            'ans' => alertError($module),
            'dataNow' => getData()
        );
        echo json_encode($datos, JSON_FORCE_OBJECT);
        die();
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
        $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>'.$module->l('Error', 'CustomModuleClass').'</strong> '.$module->l('Ups! Something has failed, please retry.', 'CustomModuleClass').'
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span class="pl-1" aria-hidden="true">&times;</span>
                    </button>
                  </div>';
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
        $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>'.$module->l('Warning', 'CustomModuleClass').'</strong> '.$module->l('One or more input is empty, at least one must have content.', 'CustomModuleClass').'
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span class="pl-1" aria-hidden="true">&times;</span>
                    </button>
                  </div>';
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
    {;
        $alert ='<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>'.$module->l('Success', 'CustomModuleClass').'</strong> '.$module->l('Your change success!.', 'CustomModuleClass').'
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span class="pl-1" aria-hidden="true">&times;</span>
                    </button>
                </div>';
        return $alert;
    }