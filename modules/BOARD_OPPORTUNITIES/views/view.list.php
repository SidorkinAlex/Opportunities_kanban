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
        if(!empty($_REQUEST['recipient_module']) ){

            $this->processSearchForm();
            $this->lv->searchColumns = $this->searchForm->searchColumns;

            if (!$this->headers) {
                return;
            }
            $seedKanbanBoard = new BOARD_OPPORTUNITIES();
            //stopped hear
            /* далее нужно ввести переменную с наименованием модуля и адаптировать формирование запросов для выбранного модуля */
            $countOpp = $seedKanbanBoard->getCountOpp();
            print_array($countOpp);
            print_array('$countOpp');
            $this->lv->ss->assign("STAGES", $seedKanbanBoard->getStages());
            print_array('$seedKanbanBoard->getStages()');
            print_array($seedKanbanBoard->getStages());
            $this->lv->ss->assign("bordConfig", $seedKanbanBoard->getConfig());
            print_array('$seedKanbanBoard->getConfig()');
            print_array($seedKanbanBoard->getConfig());
            $this->lv->ss->assign("countOpp", $countOpp);
            if (empty($_REQUEST['search_form_only']) || $_REQUEST['search_form_only'] == false) {
                $this->lv->ss->assign("SEARCH", true);
                $this->lv->ss->assign('savedSearchData', $this->searchForm->getSavedSearchData());
                print_array('$this->searchForm->getSavedSearchData()');
                print_array($this->searchForm->getSavedSearchData());
                $this->lv->setup($this->seed, 'modules/BOARD_OPPORTUNITIES/tpl/table.tpl', $this->where, $this->params);
                $savedSearchName = empty($_REQUEST['saved_search_select_name']) ? '' : (' - ' . $_REQUEST['saved_search_select_name']);
                echo $this->lv->display();
            }
        } else {

        }
    }
}
