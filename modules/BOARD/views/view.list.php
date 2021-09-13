<?php
/**
 * Created by PhpStorm.
 * User: seedteam
 * Date: 18.08.20
 * Time: 14:44
 */

require_once 'modules/BOARD/ConfigTables.php';
class BOARDViewList extends ViewList
{

    public function listViewProcess()
    {
        $configTables = new \SuiteCRM\Modules\BOARD\ConfigTables();
        if(!empty($_REQUEST['recipient_module'])
            && in_array($_REQUEST['recipient_module'],
                        $configTables->getValue('BOARD', 'moduleList')
            )
        ){

            $this->processSearchForm();
            $this->lv->searchColumns = $this->searchForm->searchColumns;

            if (!$this->headers) {
                return;
            }
            $seedKanbanBoard = new BOARD();
            $seedKanbanBoard->setModule($_REQUEST['recipient_module']);

            $countRecord = $seedKanbanBoard->getCountBean();



            $this->lv->ss->assign("STAGES", $seedKanbanBoard->getStages());
            //stopped hear

            $this->lv->ss->assign("bordConfig", $seedKanbanBoard->bordConfModule->getValueArray());
            $this->lv->ss->assign("countRecord", $countRecord);
            $this->lv->ss->assign("RECIPIENT_MODULE", $_REQUEST['recipient_module']);
            if (empty($_REQUEST['search_form_only']) || $_REQUEST['search_form_only'] == false) {
                $this->lv->ss->assign("SEARCH", true);
                $this->lv->ss->assign('savedSearchData', $this->searchForm->getSavedSearchData());
                $this->lv->setup($this->seed, 'modules/BOARD/tpl/table.tpl', $this->where, $this->params);
                $savedSearchName = empty($_REQUEST['saved_search_select_name']) ? '' : (' - ' . $_REQUEST['saved_search_select_name']);
                echo $this->lv->display();
            }
        } else {
            print_array('error');
        }
    }
}
