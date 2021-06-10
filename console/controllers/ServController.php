<?php
namespace console\controllers;

use frontend\modules\tehpod\controllers\ChatServer;
use yii\console\Controller;

class ServController extends Controller
{
    public function actionStart($port = null)
    {
        $server = new ChatServer();
        if ($port) {
            $server->port = $port;
        }
        $server->start();
    }
}
