<?php

namespace app\modules\parseKgdGovKz\models;

use app\modules\parseKgdGovKz\interfaces\ResolveCaptchaInterface;
use app\modules\parseKgdGovKz\interfaces\AntiCaptchaTaskProtocolInterface;

/**
 * Класс получает картинку с captcha с заданного сайта и преобразует её в текст.
 */
class ResolveCaptcha implements ResolveCaptchaInterface
{
    private $api;

    public function __construct(AntiCaptchaTaskProtocolInterface $api) {
        $this->api = $api;
    }

    /**
     * По заданному $url скачивает и сохраняет во временную директорию 
     * картинку с captcha
     * 
     * @param string $url
     * @return string
     */
    public function getCaptchaImage(string $url): string {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
        $raw = curl_exec($ch);
        curl_close($ch);
        $tempFileWithCaptchaImage = tempnam(\Yii::$app->runtimePath, '');
        if (file_exists($tempFileWithCaptchaImage)) {
            unlink($tempFileWithCaptchaImage);
        }
        $fp = fopen($tempFileWithCaptchaImage, 'x');
        fwrite($fp, $raw);
        fclose($fp);
        return $tempFileWithCaptchaImage;
    }

    /**
     * Решает заданную картинку с captcha 
     * 
     * @param string $captchaImageFile
     * @param string $apiKey
     * @param CaptchaImageToText $api
     * @return boolean
     */
    public function getTextOfCaptchaFromImage(string $captchaImageFile, string $apiKey) {
        $this->api->setVerboseMode(false);
        $this->api->setKey($apiKey);
        $this->api->setFile($captchaImageFile);
        if (!$this->api->createTask()) {
            return false;
        }
        $taskId = $this->api->getTaskId();
        if (!$this->api->waitForResult()) {
            return false;
        } else {
            $captchaText = $this->api->getTaskSolution();
            return $captchaText;
        }
    }

}