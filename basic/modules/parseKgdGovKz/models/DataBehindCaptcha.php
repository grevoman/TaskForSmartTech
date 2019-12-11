<?php

namespace app\modules\parseKgdGovKz\models;

use app\modules\parseKgdGovKz\interfaces\DataBehindCaptchaInterface;

/**
 * Description of DataBehindCaptcha
 *
 */
class DataBehindCaptcha implements DataBehindCaptchaInterface
{

    public function getData($uuid, $biniin, $captchaValue, $url) {
        $data = array(
            'captcha-id' => $uuid,
            'captcha-user-value' => $captchaValue,
            'iinBin' => $biniin
        );
        $ch = curl_init($url);
        $payload = json_encode($data);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        # Return response instead of printing.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        # Send request.
        $result = curl_exec($ch);
        curl_close($ch);
        # Print response.
        return $result;
    }

}