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
            //echo "";
            $this->lv->ss->assign("moduleKanbanList", $configTables->getValue('BOARD', 'moduleList'));
            if (empty($_REQUEST['search_form_only']) || $_REQUEST['search_form_only'] == false) {
                $this->lv->ss->assign("SEARCH", true);
                $this->lv->ss->assign('savedSearchData', $this->searchForm->getSavedSearchData());
                $this->lv->setup($this->seed, 'modules/BOARD/tpl/selectBoard.tpl', $this->where, $this->params);
                $savedSearchName = empty($_REQUEST['saved_search_select_name']) ? '' : (' - ' . $_REQUEST['saved_search_select_name']);
                echo $this->lv->display();
            }
        }
    }

    public function getModuleTitle(
        $show_help = true
    ) {
        global $sugar_version, $sugar_flavor, $server_unique_key, $current_language, $action;

        $theTitle = "<div class='moduleTitle'>\n";

        $module = preg_replace("/ /", "", $this->module);

        $params = $this->_getModuleTitleParams();
        $index = 0;

        if (SugarThemeRegistry::current()->directionality == "rtl") {
            $params = array_reverse($params);
        }
        if (count($params) > 1) {
            array_shift($params);
        }
        $count = count($params);
        $paramString = '';
        foreach ($params as $parm) {
            $index++;
            $paramString .= $parm;
            if ($index < $count) {
                $paramString .= $this->getBreadCrumbSymbol();
            }
        }
        global $app_list_strings;
        $paramString .= " ".$app_list_strings['moduleList'][$_REQUEST['recipient_module']];
        if (!empty($paramString)) {
            $theTitle .= "<h2 class='module-title-text'> $paramString </h2>";

            if ($this->type == "detail") {
                $theTitle .= "<div class='favorite' record_id='" .
                    $this->bean->id .
                    "' module='" .
                    $this->bean->module_dir .
                    "'><div class='favorite_icon_outline'>" .
                    "<span class='suitepicon suitepicon-favorite-star-outline'></span></div>
                                                    <div class='favorite_icon_fill' 'title=\"' . translate('LBL_DASHLET_EDIT', 'Home') . '\" border=\"0\"  align=\"absmiddle\"'>" .

                    "<span class='suitepicon suitepicon-favorite-star'></span></div></div>";
            }
        }

        // bug 56131 - restore conditional so that link doesn't appear where it shouldn't
        if ($show_help || $this->type == 'list') {
            $theTitle .= "<span class='utils'>";
            $createImageURL = SugarThemeRegistry::current()->getImageURL('create-record.gif');
            if ($this->type == 'list') {
                $theTitle .= '<a href="#" class="btn btn-success showsearch"><span class=" glyphicon glyphicon-search" aria-hidden="true"></span></a>';
            }
            $url = ajaxLink("index.php?module=$module&action=EditView&return_module=$module&return_action=DetailView");
            if ($show_help) {
                $theTitle .= <<<EOHTML
&nbsp;
<a id="create_image" href="{$url}" class="utilsLink">
<img src='{$createImageURL}' alt='{$GLOBALS['app_strings']['LNK_CREATE']}'></a>
<a id="create_link" href="{$url}" class="utilsLink">
{$GLOBALS['app_strings']['LNK_CREATE']}
</a>
EOHTML;
            }
            $theTitle .= "</span>";
        }

        $theTitle .= "<div class='clear'></div></div>\n";

        return $theTitle;
    }
}
