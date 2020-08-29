<?php
/**
 * Created by PhpStorm.
 * User: seedteam
 * Date: 18.08.20
 * Time: 14:44
 */


class BORD_OPPORTUNITIESViewList extends ViewList
{

    public function listViewProcess()
    {
        $this->processSearchForm();
        $this->lv->searchColumns = $this->searchForm->searchColumns;

        if (!$this->headers) {
            return;
        }
        $seedBordOpp = new BORD_OPPORTUNITIES();
        $countOpp=$seedBordOpp->getCountOpp();
        if($countOpp > 100){

        }
        $this->lv->ss->assign("STAGES", $seedBordOpp->getStages());
        $this->lv->ss->assign("bordConfig", json_encode($seedBordOpp->getConfig()));
        $this->lv->ss->assign("countOpp", $countOpp);
        print_r($seedBordOpp->getStages());
        if (empty($_REQUEST['search_form_only']) || $_REQUEST['search_form_only'] == false) {
            $this->lv->ss->assign("SEARCH", true);
            $this->lv->ss->assign('savedSearchData', $this->searchForm->getSavedSearchData());
            $this->lv->setup($this->seed, 'modules/BORD_OPPORTUNITIES/tpl/table.tpl', $this->where, $this->params);
            $savedSearchName = empty($_REQUEST['saved_search_select_name']) ? '' : (' - ' . $_REQUEST['saved_search_select_name']);
            echo $this->lv->display();
        }
    }
}
