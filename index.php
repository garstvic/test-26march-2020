<?php

require 'vendor/autoload.php';

require 'core/bootstrap.php';

use App\Core\Router;
use App\Core\Request;

Router::load('app/routes.php')->direct(Request::uri(),Request::method());

// $curl = curl_init();

// curl_setopt_array($curl, array(
//   CURLOPT_URL => "https://api.privatbank.ua/p24api/pubinfo?exchange&json&coursid=11",
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => "",
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 0,
//   CURLOPT_FOLLOWLOCATION => true,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => "GET",
// ));

// $response = curl_exec($curl);

// curl_close($curl);

// $exchanges=json_decode($response);

// var_dump($exchanges);

// $filter_skill_list=array(
//   'Веб-программирование',
//   'PHP',
//   'Базы данных',
// );

// $curl = curl_init();

// curl_setopt_array($curl, array(
//   CURLOPT_URL => "https://api.freelancehunt.com/v2/skills",
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => "",
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 0,
//   CURLOPT_FOLLOWLOCATION => true,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => "GET",
//   CURLOPT_HTTPHEADER => array(
//     "Authorization: Bearer a47a28f9f19a2be794183cb8da8df781101c5443"
//   ),
// ));

// $response = curl_exec($curl);

// curl_close($curl);

// $skills_from_api=json_decode($response)->data;

// $request_skill_list='';
// foreach($filter_skill_list as $key=>$skill) {
//   $filter_skill_list[$key]=$skills_from_api[array_search($skill,array_column($skills_from_api,'name'))];
//   $request_skill_list.=$filter_skill_list[$key]->id.',';
// }

// $page_number=1;
// $projects=[];
// var_dump('fetching data by api');

// $curl = curl_init();
// do {
//   curl_setopt_array($curl, array(
//     CURLOPT_URL => "https://api.freelancehunt.com/v2/projects?filter[skill_id]={$request_skill_list}&page[number]={$page_number}",
//     CURLOPT_RETURNTRANSFER => true,
//     CURLOPT_ENCODING => "",
//     CURLOPT_MAXREDIRS => 10,
//     CURLOPT_TIMEOUT => 0,
//     CURLOPT_FOLLOWLOCATION => true,
//     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//     CURLOPT_CUSTOMREQUEST => "GET",
//     CURLOPT_HTTPHEADER => array(
//       "Authorization: Bearer a47a28f9f19a2be794183cb8da8df781101c5443"
//     ),
//   ));

//   $response = curl_exec($curl);
  
//   $result=json_decode($response);
//   $projects=array_merge($projects,$result->data);

//   $page_number=$page_number+1;
// // } while(isset($result->links->last));
// } while($page_number<2);

// curl_close($curl);
  
// var_dump($projects[0]);

// require 'index.view.php';
