<?php

namespace Console\Commands;

use App\Models\Capitals;
use App\Models\TemperatureUnits;
use App\Models\TemperatureItems;
use App\Models\WeatherItems;
use App\Models\PressureItems;
use App\Models\HumidityItems;
use App\Models\WindItems;
use App\Models\WindDirectionItems;
use App\Models\WeatherConditions;
use App\Models\WeatherDataTypes;
use App\Models\WeatherItemsConformingConditions;
use App\Core\Components\OpenWeatherAPI;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use PDO;

class CompareWeatherWithConditionsCommand extends Command
{
    public function configure()
    {
        $this->setName('compare_weather_with_conditions')
             ->setDescription('Compare weather with condition in DB');
    }
    
    public function execute(InputInterface $input,OutputInterface $output)
    {
        $this->getConditions($output);
        
        return 0;
    }

    private function getConditions(OutputInterface $output)
    {
        $compared_weather_items=[];
        
        $conditions=WeatherConditions::getConditions();
        $weathers=WeatherItems::findAll();

        $temperature_criteria=WeatherConditions::findByAttributes(['weather_data_type_id'=>1]);

        if(count($temperature_criteria)) {
            $temperature_criteria=array_shift($temperature_criteria);
        }
        
        $pressure_criteria=WeatherConditions::findByAttributes(['weather_data_type_id'=>2]);

        if(count($pressure_criteria)) {
            $pressure_criteria=array_shift($pressure_criteria);
        }
        
        $humidity_criteria=WeatherConditions::findByAttributes(['weather_data_type_id'=>3]);

        if(count($humidity_criteria)) {
            $humidity_criteria=array_shift($humidity_criteria);
        }
        
        $wind_criteria=WeatherConditions::findByAttributes(['weather_data_type_id'=>4]);

        if(count($wind_criteria)) {
            $wind_criteria=array_shift($wind_criteria);
        }        

        foreach($weathers as $weather) {
            if($temperature_criteria) {
                $temperature_item=TemperatureItems::findByPk($weather->temperature_item_id);

                $if_string=str_replace('%s','$temperature_item->now',$temperature_criteria->condition_value);

                $if_condition=eval("return {$if_string};");

                if($if_condition) {
                    $insert_id=WeatherItemsConformingConditions::insert([
                        $weather->id,
                        $temperature_criteria->id,
                    ]);

                    $compared_weather_items[]=WeatherItemsConformingConditions::findByPk($insert_id,PDO::FETCH_ASSOC);
                }
            }
            
            if($pressure_criteria) {
                $pressure_item=PressureItems::findByPk($weather->pressure_item_id);

                $if_string=str_replace('%s','$pressure_item->value',$pressure_criteria->condition_value);

                $if_condition=eval("return {$if_string};");

                if($if_condition) {
                    $insert_id=WeatherItemsConformingConditions::insert([
                        $weather->id,
                        $pressure_criteria->id,
                    ]);
                    
                    $compared_weather_items[]=WeatherItemsConformingConditions::findByPk($insert_id,PDO::FETCH_ASSOC);                    
                }
            }
            
            if($humidity_criteria) {
                $humidity_item=HumidityItems::findByPk($weather->humidity_item_id);

                $if_string=str_replace('%s','$humidity_item->value',$humidity_criteria->condition_value);

                $if_condition=eval("return {$if_string};");

                if($if_condition) {
                    $insert_id=WeatherItemsConformingConditions::insert([
                        $weather->id,
                        $humidity_criteria->id,
                    ]);
                    
                    $compared_weather_items[]=WeatherItemsConformingConditions::findByPk($insert_id,PDO::FETCH_ASSOC);                    
                }
            }  
            
            if($wind_criteria) {
                $wind_item=HumidityItems::findByPk($weather->wind_item_id);

                $if_string=str_replace('%s','$wind_item->value',$wind_criteria->condition_value);

                $if_condition=eval("return {$if_string};");

                if($if_condition) {
                    $insert_id=WeatherItemsConformingConditions::insert([
                        $weather->id,
                        $wind_criteria->id,
                    ]);

                    $compared_weather_items[]=WeatherItemsConformingConditions::findByPk($insert_id,PDO::FETCH_ASSOC);
                }
            }             
        }

        $table=new Table($output);

        $table->setHeaders(['Id','Weather Item Id','Weather Condition Id','Date'])
              ->setRows($compared_weather_items)
              ->render();
    }
}