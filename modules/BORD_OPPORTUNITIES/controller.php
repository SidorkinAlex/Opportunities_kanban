<?php

/**
 * Created by PhpStorm.
 * User: seedteam
 * Date: 27.08.20
 * Time: 16:11
 */
class CustomBORD_OPPORTUNITIESController extends SugarController
{
    public function action_getData()
    {
        $seedOpp=new BORD_OPPORTUNITIES();
        $data=$seedOpp->getDataOpp($_REQUEST['where']);
        echo json_encode($data);
    }

    public function action_getCountOpp(){
        $seedOpp=new BORD_OPPORTUNITIES();
        echo $seedOpp->getCountOpp();
    }
    public function action_saveSattings(){
        global $current_user;
        $bordConf=$current_user->getPreference('bordConf');
        unset($bordConf['stages']);
        foreach ($_REQUEST['stage'] as $stage){
            $bordConf['stages'][$stage['sortable']] = array(
                'name'=> $stage['name'],
                'display' => !empty($stage['display']) ? true : false ,
                'show' => !empty($stage['show']) ? true : false ,
            );
        }
        $current_user->setPreference('bordConf',$bordConf);
        header('Location: index.php?module=BORD_OPPORTUNITIES&action=boardSettings');

    }

    public function action_getDataLimit(){
        $whereArr = $_REQUEST['where'];
        $limitIntervalMin = $_REQUEST['limitMin'];
        $limitIntervalMax = $_REQUEST['limitMax'];
        $seedOpp = new BORD_OPPORTUNITIES();
        $seedOpp->getDataOpp($whereArr,$limitIntervalMin,$limitIntervalMax);
    }
}