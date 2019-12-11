<?php

namespace app\modules\parseKgdGovKz\interfaces;

/**
 * Description of DataBehindCaptchaInterface
 *
 */
interface DataBehindCaptchaInterface
{

    public function getData(string $uuid, string $biniin, string $captchaText, string $searchUrl);
}