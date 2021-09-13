<?php

class BoardConfModuleToBeanRequest {
    public static function mainFields2Filter(array $mainFieilds):array {
        $filterArr = [];
        if (empty($mainFieilds)){
            return $filterArr;
        }
        foreach ($mainFieilds as $field){
            $filterArr[$field] = true;
        }
        return $filterArr;
    }

    public static function  stages2request(array $stages):array {
        $stagesRequest = [];
        foreach ($stages as $v) {
            if ($v['show'])
                $stagesRequest[] = $v['name'];
        }
        return $stagesRequest;
    }
}