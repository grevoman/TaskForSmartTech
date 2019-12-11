<?php

namespace app\modules\parseKgdGovKz;

/**
 * parseKgdGovKz module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\parseKgdGovKz\controllers';
    public $layout = 'main.php';

    /**
     * URL страницы, на котором надо решить капчу
     * 
     * @var string
     */
    public $searchUrl;
    public $getCaptchaUrl;
    public $apiKey;

    /**
     * {@inheritdoc}
     */
    public function init() {
        parent::init();

        // custom initialization code goes here
    }

}