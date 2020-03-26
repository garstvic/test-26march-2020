#! /usr/bin/env php

<?php

use App\Core\Components\OpenWeatherAPI;
use Console\Commands\GetWeatherCommand;
use Console\Commands\CompareWeatherWithConditionsCommand;
use Symfony\Component\Console\Application;
use Http\Factory\Guzzle\RequestFactory;
use Http\Adapter\Guzzle6\Client as GuzzleAdapter;

require '../vendor/autoload.php';

require '../core/bootstrap.php';

$app=new Application('Task App','1.0');

$app->add(new GetWeatherCommand(new OpenWeatherAPI(new RequestFactory,GuzzleAdapter::createWithConfig([]))));
$app->add(new CompareWeatherWithConditionsCommand);

$app->run();