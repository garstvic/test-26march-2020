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
use App\Core\Components\OpenWeatherAPI;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use PDO;

class GetWeatherCommand extends Command
{
    protected $own;
    protected $weather=[];

    public function __construct(OpenWeatherAPI $own)
    {
        $this->own=$own;
        
        parent::__construct();
    }
    
    public function configure()
    {
        $this->setName('get_weather')
             ->setDescription('Get Data from Openweathermap API.');
    }
    
    public function execute(InputInterface $input,OutputInterface $output)
    {
        $this->getData($output);
        
        return 0;
    }
    
    private function getData(OutputInterface $output)
    {
        $weather_items=[];

        $capitals=Capitals::findAll();
       
        foreach($capitals as $capital) {
            $this->weather[]=$weather=$this->own->getWeatherByCoordinates($capital->latitude,$capital->longitude);

            $temperature_unit=TemperatureUnits::findByAttributes(['sign'=>$weather->temperature->now->getUnit()]);

            $temperature_unit_id=array_shift($temperature_unit)->id;

            $temperature_item_id=TemperatureItems::insert([
                $weather->temperature->now->getValue(),
                $weather->temperature->min->getValue(),
                $weather->temperature->max->getValue(),
                $temperature_unit_id
            ]);
            
            $pressure_item_id=PressureItems::insert([
                $weather->pressure->getValue(),
                $weather->pressure->getUnit(),
            ]);
            
            $humanity_item_id=HumidityItems::insert([
                $weather->pressure->getValue(),
                $weather->pressure->getUnit(),
            ]);
            
            $wind_description_id=WindDirectionItems::insert([
                $weather->wind->direction->getValue(),
                $weather->wind->direction->getUnit(),
                $weather->wind->direction->getDescription(),
            ]);
            
            $wind_item_id=WindItems::insert([
                $weather->wind->speed->getValue(),
                $weather->wind->speed->getUnit(),
                $wind_description_id,
            ]);

            $weather_item_id=WeatherItems::insert([
                $capital->city_id,
                $temperature_item_id,
                $pressure_item_id,
                $humanity_item_id,
                $wind_item_id,
            ]);

            $weather_items[]=WeatherItems::findByPk($weather_item_id,PDO::FETCH_ASSOC);
        }

        $table=new Table($output);
        
        $table->setHeaders(['Id','Country Id','Temperature Item Id','Pressure Item Id','Humanity Item Id','Wind Item Id','Date'])
              ->setRows($weather_items)
              ->render();
    }
}