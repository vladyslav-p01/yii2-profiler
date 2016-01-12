<?php

namespace vad\profiler;
use yii\base\BootstrapInterface;
use yii\web\Application;
use yii\web\Response;

/**
 * This is just an example.
 */
class MyBootstrapClass implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $time = 0;
        $url = 0;
        $app->on(Application::EVENT_BEFORE_REQUEST, function () use (&$time) {
            $time = mktime();
        });

        $app->on(Response::EVENT_AFTER_SEND, function() use (&$time, &$url) {
            $url = \Yii::$app->request->absoluteUrl;
            $time -= mktime();
        });

        \Yii::info($url. " - " .$time);
    }
}
