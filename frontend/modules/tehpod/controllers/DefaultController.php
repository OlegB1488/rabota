<?php

namespace app\modules\tehpod\controllers;

use yii\helpers\ArrayHelper;
use yii\log\Dispatcher;
use yii\queue\Queue;
use yii\web\Controller;

/**
 * Default controller for the `tehpod` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */

    public function actionIndex()
    {
        return $this->render('index');
    }

}
