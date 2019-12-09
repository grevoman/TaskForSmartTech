<?php

namespace app\modules\parseKgdGovKz\interfaces;

interface AntiCaptchaTaskProtocolInterface
{

    public function getPostData();

    public function getTaskSolution();
}