<?php

namespace App\Models;

use App\Core\Abstracts\aModel;
use App\Models\WeatherCriterias;
use App\Models\WeatherDataTypes;
use App\Models\WeatherThresholdCriterias;

class WeatherConditions extends aModel
{
    static protected $table_name='weather_conditions';
    static protected $column_names=[
        'condition_value',
        'weather_data_type_id',
    ];

    public static function getConditions()
    {
        $conditions=[];
        
        $criterias=WeatherCriterias::findAll();
        
        $data_types=WeatherDataTypes::findAll();
        
        $criterias_by_data_types=[];
        
        foreach($data_types as $data_type) {
            $criterias_by_data_types[$data_type->value]=WeatherCriterias::findByAttributes(['weather_data_type_id'=>$data_type->id]);
        }
 
        foreach($criterias_by_data_types as $data_type=>$criterias) {
            if(count($criterias)) {
                $condition=WeatherConditions::getCondition($criterias);
                if(WeatherConditions::findByAttributes(['condition_value'=>$condition['value']])==null) {
                    WeatherConditions::insert([
                        $condition['value'],
                        WeatherDataTypes::findByAttributes(['value'=>$data_type])[0]->id,
                    ]);
                }               
                
                $conditions[]=$condition;
            }
        }
      
        return $conditions;
    }
    
    private function getCondition($criterias)
    {
        $conditions=[
            'and'=>[],
            'or'=>[],
            ];

        foreach($criterias as $index=>$criteria){
            $data_type=WeatherDataTypes::findByPk($criteria->weather_data_type_id);
            $threshold_criteria=WeatherThresholdCriterias::findByPK($criteria->weather_threshold_criteria_id);

            if($threshold_criteria->sign=='=') {
                // $conditions['or'][]=$data_type->value.' '.$threshold_criteria->sign.' '.$criteria->value;
                $conditions['and'][]='%s '.$threshold_criteria->sign.' '.$criteria->value;
            }

            if($threshold_criteria->sign=='=' xor true) {
                // $conditions['and'][]=$data_type->value.' '.$threshold_criteria->sign.' '.$criteria->value;
                $conditions['and'][]='%s '.$threshold_criteria->sign.' '.$criteria->value;
            }
        }

        $and_conditions=implode(' and ',$conditions['and']);
        $and_conditions=strlen($and_conditions) ? "({$and_conditions})" : '';
        $or_conditions=implode(' or ',$conditions['or']);

        return [
            'data_type'=>$data_type->value,
            'value'=>$and_conditions.((strlen($and_conditions) and strlen($or_conditions)) ? ' or ' : '').$or_conditions
        ];
    }
}