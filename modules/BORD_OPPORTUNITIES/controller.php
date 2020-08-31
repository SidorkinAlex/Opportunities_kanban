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
        global $db;

        $bordConfig=BORD_OPPORTUNITIES::getBordConfig();
        $order_by='date_entered DESC';
        if($_REQUEST['where']) {
            $in = "'" . implode("','",$_REQUEST['where']) . "'";
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
        $mainFields= '`opportunities`.' . implode(', " " ,`opportunities`.',$bordConfig['mainFields']);
        //print_array($create_new_list_query);
        $create_new_list_query['select']=' SELECT opportunities.`id` as `opportunities_id`, CONCAT(' . $mainFields . ') as `opportunities_name`, opportunities.`sales_stage` as `opportunities_sales_stage`';
        //print_array($create_new_list_query['select'] . $create_new_list_query['from'] . $create_new_list_query['where'] . $create_new_list_query['order_by']);
        $sql=$create_new_list_query['select'] . $create_new_list_query['from'] . $create_new_list_query['where'] . $create_new_list_query['order_by'];

        $result=$db->query($sql,1);
        $data=[];
        while ($row = $db->fetchByAssoc($result)) {
            $data[$row['opportunities_sales_stage']][]=[
                'id' => $row['opportunities_id'],
                'opportunities_name' => $row['opportunities_name'],
                'opportunities_sales_stage' => $row['opportunities_sales_stage'],
            ];
        }
        echo json_encode($data);
    }

    public function action_getCountOpp(){
        $seedOpp=new BORD_OPPORTUNITIES();
        echo $seedOpp->getCountOpp();
    }
}