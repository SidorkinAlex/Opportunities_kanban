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

    public function action_getDataLimit(){
        $whereArr = $_REQUEST['where'];
        $limitIntervalMin = $_REQUEST['limitMin'];
        $limitIntervalMax = $_REQUEST['limitMax'];
        $seedOpp = new BORD_OPPORTUNITIES();
        $seedOpp->getDataOpp($whereArr,$limitIntervalMin,$limitIntervalMax);
    }
}