<?php

namespace App\Core\Components;

use App\Core\App;
use App\Core\Interfaces\iWeatherAPI;
use Cmfcmf\OpenWeatherMap;
use Cmfcmf\OpenWeatherMap\Exception as OWMException;
use Http\Factory\Guzzle\RequestFactory;
use Http\Adapter\Guzzle6\Client as GuzzleAdapter;

use Exception;

class OpenWeatherAPI implements iWeatherAPI
{
    protected $http_equest_factory;
    protected $http_client;
    protected $own;
    protected $api_key;
    
    public function __construct(RequestFactory $http_equest_factory,GuzzleAdapter $http_client)
    {
        $this->http_request_factory=$http_equest_factory;
        $this->http_client=$http_client;
        $this->api_key=App::get('config')['api']['openweathermap']['api_key'];
        $this->owm=new OpenWeatherMap($this->api_key,$this->http_client,$this->http_request_factory);;
    }
    
    public function getWeatherByCoordinates($lat,$lon)
    {
        try {
            $weather=$this->owm->getWeather(['lat'=>$lat,'lon'=>$lon],'metric','en');
        } catch(OWMException $e) {
            echo 'OpenWeatherMap exception: '.$e->getMessage().' (Code '.$e->getCode().').';
        } catch(Exception $e) {
            echo 'General exception: '.$e->getMessage().' (Code '.$e->getCode().').';
        }

        return $weather;
    }
}