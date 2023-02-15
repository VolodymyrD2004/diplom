<?php

namespace app\modules\admin;

use Yii;
use yii\console\Application;

class Module extends \yii\base\Module
{
    public $layoutPath = '@app/modules/admin/views/layouts';
    public $layout = 'main';

    public function init()
    {
        parent::init();

        $this->setConsoleControllerNamespace();
    }

    protected function setConsoleControllerNamespace()
    {
        if (Yii::$app instanceof Application) {
            $this->controllerNamespace = __NAMESPACE__ . '\commands';
        }
    }
}