<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\DBController\traits;

trait DBControllerTrait
{
    public static function prepareParams(?array $params = null): array
    {
        if (!is_null($params)) {
            
            $updParams = $params;
            
            foreach($updParams as $params_key => &$params_value) {
                
                $extractedParamsValue[$params_key] = $params_value;
                
                $params_value = "?";
                
            }
            
            unset($params_value);
            
        } else {
            
            $updParams = null;
            
            $extractedParamsValue = null;
        } 
        
        return [$updParams, $extractedParamsValue];
    }
    
    public static function prepareData(object $data): array
    {
        if (!is_null($data)) {
            
            $dataArray = json_decode(json_encode($data), true);
            
            foreach($dataArray as $data_key => &$data_value) {
                
                $extractedDataValue[$data_key] = $data_value;
                
                $data_value = "?";
            }
            
            unset($data_value);
            
        } else {
            
            $dataArray = null;
            
            $extractedDataValue = null;
        }
        
        return [$dataArray, $extractedDataValue];
    }
}