<?php
/**
 *
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.
 *
 * SuiteCRM is an extension to SugarCRM Community Edition developed by SalesAgility Ltd.
 * Copyright (C) 2011 - 2018 SalesAgility Ltd.
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU Affero General Public License for more
 * details.
 *
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 *
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 *
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo and "Supercharged by SuiteCRM" logo. If the display of the logos is not
 * reasonably feasible for technical reasons, the Appropriate Legal Notices must
 * display the words "Powered by SugarCRM" and "Supercharged by SuiteCRM".
 */


class BOARD_OPPORTUNITIES extends Basic
{
    public $new_schema = true;
    public $module_dir = 'BOARD_OPPORTUNITIES';
    public $object_name = 'BOARD_OPPORTUNITIES';
    public $table_name = 'board_opportunities';
    public $importable = false;

    public $id;
    public $name;
    public $date_entered;
    public $date_modified;
    public $modified_user_id;
    public $modified_by_name;
    public $created_by;
    public $created_by_name;
    public $description;
    public $deleted;
    public $created_by_link;
    public $modified_user_link;
    public $assigned_user_id;
    public $assigned_user_name;
    public $assigned_user_link;
    public $SecurityGroups;
    public $boardForModuleBeanName;
    public SugarBean $recipientBean;
    public string $boardForModuleKey;
    public \SuiteCRM\Modules\BOARD_OPPORTUNITIES\ModuleConfig $bordConfModule;
    const STAP_LIMIT=30;
	
    public function bean_implements($interface)
    {
        switch($interface)
        {
            case 'ACL':
                return true;
        }

        return false;
    }

    public function setModule(string $moduleName){
        global $beanList;
        global $beanFiles;
        $this->boardForModuleKey = $moduleName;
        $this->initRecipientBeanName($moduleName);
        $this->initRecipientBeanObect();
    }
    /**
     * @return JSON Sales Stage from Opportunities
     */
    public function getStages()
    {
        global $app_list_strings;
        $this->checkOrInitBordFonfModule();
        $stages = [];
        if (!empty($this->bordConfModule->stages) && count($this->bordConfModule->stages) == count($app_list_strings[$this->recipientBean->field_defs->{$this->bordConfModule->stages_field}->options])) {
            for ($i = 0; $i < count($this->bordConfModule->stages); $i++) {
                if($this->bordConfModule->stages[$i]['display']) {
                    $stages[$this->bordConfModule->stages[$i]['name']] = $app_list_strings[$this->recipientBean->field_defs->{$this->bordConfModule->stages_field}->options][$this->bordConfModule->stages[$i]['name']];
                }
            }
        } else{
            header('Location: index.php?module=BOARD_OPPORTUNITIES&action=boardSettings');
        }
        return json_encode($stages);
    }

    public function getOppData(){

    }

    public function getConfig()
    {
        global $current_user;
        $bordConf=$current_user->getPreference('bordConf');
    return $bordConf;
    }

    static function getBordConfig(){
        global $current_user;
        $bordConf=$current_user->getPreference('bordConf');
        return $bordConf;
    }

    private function checkOrInitBordFonfModule(){
        global $current_user;
        if(!isset($this->bordConfModule)) {
            $bordConf = new \SuiteCRM\Modules\BOARD_OPPORTUNITIES\BOARD_USER_CONFIG($current_user);
            $this->bordConfModule = $bordConf->getConfigFromModule($this->boardForModuleKey);
        }
}

    public function getCountBean(){
        global $db;
        global $current_user;
        $sow_stage=[];
        $this->checkOrInitBordFonfModule();

        foreach ($this->bordConfModule->stages as $stage) {
            if($stage['show'] === true){
                $sow_stage[]=$stage['name'];
            }
        }
        $order_by="{$this->bordConfModule->order_by} DESC";
        $order_by="{$this->bordConfModule->stages_field} DESC";
        if($sow_stage) {
            $in = "'" . implode("','",$sow_stage) . "'";
            $where = "({$this->recipientBean->table_name}.{$this->bordConfModule->stages_field} in ({$in}))";
        }
        $filter=array (
            $this->bordConfModule->stages_field => true,
        );
        $params=array (
            //'massupdate' => true,
            //'orderBy' => strtoupper(),
          //  'overrideOrder' => true,
          //  'sortOrder' => 'DESC',
        );
        $show_deleted=0;
        $join_type='';
        $return_array=true;
        $singleSelect=true;
        $ifListForExport=false;


        $create_new_list_query=$this->recipientBean->create_new_list_query(
            $order_by,
            $where,
            $filter,
            $params,
            $show_deleted,
            $join_type,
            $return_array,
            $this->recipientBean,
            $singleSelect,
            $ifListForExport
        );

        $sql=$create_new_list_query['select'] . $create_new_list_query['from'] . $create_new_list_query['where'] . $create_new_list_query['order_by'];
        $count = $this->recipientBean->create_list_count_query($sql);
        $result = $db->getOne($sql,1);
        return $result;
    }

    /** delete after release
     * @return array|false
     */
    public function getCountOpp(){
        global $db;
        $stage=[];
        $bordConf=self::getBordConfig();
        foreach ($bordConf['stages'] as $v) {
            if($v['show'] === true){
                $stage[]=$v['name'];
            }
        }


        $order_by='date_entered DESC';
        if($stage) {
            $in = "'" . implode("','",$stage) . "'";
            $where = '(opportunities.sales_stage in (' . $in . '))';
        }
        $filter=array (
            'sales_stage' => true,
        );
        $params=array (
            'massupdate' => true,
            'orderBy' => 'DATE_ENTERED',
            'overrideOrder' => true,
            'sortOrder' => 'DESC',
        );
        $show_deleted=0;
        $join_type='';
        $return_array=true;
        $singleSelect=true;
        $ifListForExport=false;
        $parentbean= new Opportunity();
        $been= new Opportunity();
        $create_new_list_query=$been->create_new_list_query(
            $order_by,
            $where,
            $filter,
            $params,
            $show_deleted,
            $join_type,
            $return_array,
            $parentbean,
            $singleSelect,
            $ifListForExport
        );
        $create_new_list_query['select']='SELECT COUNT(opportunities.`id`)';
        $sql=$create_new_list_query['select'] . $create_new_list_query['from'] . $create_new_list_query['where'] . $create_new_list_query['order_by'];

        $result = $db->getOne($sql,1);
        return $result;
    }

    /**
     * get data Oportiunities from kanbanbord
     * @param array $whereArr
     * @return array
     */
    public function getDataOpp($whereArr,$limitMin=null,$limitMax= null){

        global $db;

        $bordConfig=BOARD_OPPORTUNITIES::getBordConfig();
        $order_by='date_entered DESC';
        if($whereArr) {
            $in = "'" . implode("','",$whereArr) . "'";
            $where = '(opportunities.sales_stage in (' . $in . '))';
        } else {
            $stagesDefault=[];
            foreach ($bordConfig['stages'] as $v){
                if($v['show'])
                    $stagesDefault[]=$v['name'];
            }
            $in = "'" . implode("','",$stagesDefault) . "'";
            $where = '(opportunities.sales_stage in (' . $in . '))';
        }
        $LIMIT='';
        if(!empty($limitMax)){
            if(!empty($limitMin) ) {
                $limitDiff=$limitMax - $limitMin;
                $LIMIT = "LIMIT {$limitMin},{$limitDiff}";
            } else {
                $LIMIT = "LIMIT {$limitMax}";
            }
        }
        $filter=array (
            'sales_stage',
        );
        $filter=array_merge($filter,$bordConfig['mainFields']);
        $params=array (
            'massupdate' => true,
            'orderBy' => 'DATE_ENTERED',
            'overrideOrder' => true,
            'sortOrder' => 'DESC',
        );
        $show_deleted=0;
        $join_type='';
        $return_array=true;
        $singleSelect=true;
        $ifListForExport=false;
        $parentbean= new Opportunity();
        $been= new Opportunity();
        $create_new_list_query=$been->create_new_list_query(
            $order_by,
            $where,
            $filter,
            $params,
            $show_deleted,
            $join_type,
            $return_array,
            $parentbean,
            $singleSelect,
            $ifListForExport
        );
        //$mainFields= '`opportunities`.' . implode(', " " ,`opportunities`.',$bordConfig['mainFields']);
        //print_array($create_new_list_query);
        //$create_new_list_query['select']=' SELECT opportunities.`id` as `opportunities_id`, CONCAT(' . $mainFields . ') as `opportunities_name`, opportunities.`sales_stage` as `opportunities_sales_stage`';
        //print_array($create_new_list_query['select'] . $create_new_list_query['from'] . $create_new_list_query['where'] . $create_new_list_query['order_by']);
        $sql=$create_new_list_query['select'] . $create_new_list_query['from'] . $create_new_list_query['where'] . $create_new_list_query['order_by'];
        $sql=$sql . "\n {$LIMIT}";
        $result=$db->query($sql,1);
        $data=[];
        while ($row = $db->fetchByAssoc($result)) {
            $name='';
            foreach ($bordConfig['mainFields'] as $key => $fieldName){
                if(!empty($row[$fieldName])){
                    $name .= ' '.$row[$fieldName];
                }
                else{
                    $name.='';
                }
            }
            $data[$row['sales_stage']][]=[
                'id' => $row['id'],
                'opportunities_name' => $name,
                'opportunities_sales_stage' => $row['sales_stage'],
            ];
        }
        return $data;
    }

    /**
     * @param string $moduleName
     * @throws Exception
     */
    private function initRecipientBeanName(string $moduleName):void
    {
        if(!empty($beanList[$moduleName])) {
            $this->boardForModuleBeanName = $beanList[$moduleName];
        } else {
            throw new Exception('not found in $beanList key '. $moduleName, 500);
        }
    }

    /**
     * @throws Exception
     */
    private function initRecipientBeanObect():void
    {
        global $beanFiles;
        if(file_exists($beanFiles[$this->boardForModuleBeanName])){
            require_once $beanFiles[$this->boardForModuleBeanName];
        } else {
            throw new Exception('$beanFiles from object '.$this->boardForModuleBeanName. 'not found',500);
        }
        $this->recipientBean = new $this->boardForModuleBeanName();
    }
}