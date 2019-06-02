<?php
declare(strict_types=1);

if (file_exists(ROOT_PATH.'/vendor/autoload.php') === false) {
    echo "run this command first: composer install";
    exit();
}
require_once ROOT_PATH.'/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Silex\Application;

$app = new Application();
$app->after(function (Request $request, Response $response) {
    $response->headers->set('Access-Control-Allow-Origin', '*');
});
//$app['debug'] = true;
$app->get('/', function () use ($app) {
    return 'Status OK';
});

$surveyController = new \IWD\JOBINTERVIEW\Controller\SurveysController();
/*stage1*/
$app->get('/surveys', function() use ($app, $surveyController){
    return $surveyController->surveyList();
});

/*stage2*/
$app->get('/surveys-aggregate', function () use ($app, $surveyController) {
    return $surveyController->surveyGetAnswers();
});
$app->run();

return $app;
