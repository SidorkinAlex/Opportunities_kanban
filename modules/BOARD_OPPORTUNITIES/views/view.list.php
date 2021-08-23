<?php
/**
 * Created by PhpStorm.
 * User: seedteam
 * Date: 18.08.20
 * Time: 14:44
 */

require_once 'modules/BOARD_OPPORTUNITIES/ConfigTables.php';
class BOARD_OPPORTUNITIESViewList extends ViewList
{

    public function listViewProcess()
    {
        $configTables = new \SuiteCRM\Modules\BOARD_OPPORTUNITIES\ConfigTables();
        if(!empty($_REQUEST['recipient_module'])
            && in_array($_REQUEST['recipient_module'],
                        $configTables->getValue('BOARD_OPPORTUNITIES', 'moduleList')
            )
        ){

            $this->processSearchForm();
            $this->lv->searchColumns = $this->searchForm->searchColumns;

            if (!$this->headers) {
                return;
            }
            $seedKanbanBoard = new BOARD_OPPORTUNITIES();
            $seedKanbanBoard->setModule($_REQUEST['recipient_module']);

            $countRecord = $seedKanbanBoard->getCountBean();



            $this->lv->ss->assign("STAGES", $seedKanbanBoard->getStages());
            //stopped hear

            $this->lv->ss->assign("bordConfig", $seedKanbanBoard->getConfig());
            print_array('$seedKanbanBoard->getConfig()');
            print_array($seedKanbanBoard->getConfig());
            $this->lv->ss->assign("countRecord", $countRecord);
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
