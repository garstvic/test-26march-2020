<?php

require 'vendor/autoload.php';

require 'core/bootstrap.php';

use App\Core\Router;
use App\Core\Request;

use App\Core\Database\QueryBuilder;

use App\Models\Capitals;
use App\Models\Countries;

use Cmfcmf\OpenWeatherMap;
use Cmfcmf\OpenWeatherMap\Exception as OWMException;
use Http\Factory\Guzzle\RequestFactory;
use Http\Adapter\Guzzle6\Client as GuzzleAdapter;

Router::load('app/routes.php')->direct(Request::uri(),Request::method());
