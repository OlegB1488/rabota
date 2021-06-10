<?php
namespace app\commands;

use app\daemons\EchoServer;
use yii\console\Controller;

class ServController extends Controller
{
    public function actionStart($port = null)
    {
        $server = new EchoServer();
        if ($port) {
            $server->port = $port;
        }
        $server->start();
    }
}
