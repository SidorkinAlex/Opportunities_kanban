<?php
/**
 * Created by PhpStorm.
 * User: seedteam
 * Date: 18.08.20
 * Time: 14:44
 */


class BOARD_OPPORTUNITIESViewList extends ViewList
{

    public function listViewProcess()
    {
        $this->processSearchForm();
        $this->lv->searchColumns = $this->searchForm->searchColumns;

        if (!$this->headers) {
            return;
        }
        $seedBordOpp = new BOARD_OPPORTUNITIES();
        $countOpp=$seedBordOpp->getCountOpp();
        $this->lv->ss->assign("STAGES", $seedBordOpp->getStages());
        $this->lv->ss->assign("bordConfig", $seedBordOpp->getConfig());
        $this->lv->ss->assign("countOpp", $countOpp);
        if (empty($_REQUEST['search_form_only']) || $_REQUEST['search_form_only'] == false) {
            $this->lv->ss->assign("SEARCH", true);
            $this->lv->ss->assign('savedSearchData', $this->searchForm->getSavedSearchData());
            $this->lv->setup($this->seed, 'modules/BOARD_OPPORTUNITIES/tpl/table.tpl', $this->where, $this->params);
            $savedSearchName = empty($_REQUEST['saved_search_select_name']) ? '' : (' - ' . $_REQUEST['saved_search_select_name']);
            echo $this->lv->display();
        }
    }
}
