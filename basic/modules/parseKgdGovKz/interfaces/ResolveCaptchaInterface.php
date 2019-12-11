<?php

namespace app\modules\parseKgdGovKz\interfaces;

use app\modules\parseKgdGovKz\interfaces\AntiCaptchaTaskProtocolInterface;

/**
 * Description of ResolveCaptchaInterface
 *
 */
interface ResolveCaptchaInterface
{

    public function getCaptchaImage(string $url): string;

    public function getTextOfCaptchaFromImage(string $captchaImageFile, string $apiKey);
}