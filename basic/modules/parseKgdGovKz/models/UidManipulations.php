<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\parseKgdGovKz\models;

use app\modules\parseKgdGovKz\interfaces\UidInterface;

class UidManipulations implements UidInterface
{

    /**
     * Генерирует UID в формате xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx ,
     * где x и y случайные шестнадцатиричные числа
     * 
     * @return string
     */
    public function GenerateUID(): string {
        $currentTime = time();
        $pattern = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx';
        return preg_replace_callback(
                '/[xy]/',
                // Подставляет в паттерн вместо x и y шестнадцатеричные числа
                function ($matches) use ($currentTime) {
            $randomLongNumberLessOne = random_int(10 * pow(10, 14), 10 * pow(10, 15) - 1) / pow(10, 16);
            $randomNumberFrom0To15 = ($currentTime + $randomLongNumberLessOne * 16) % 16 | 0;
            return dechex($matches[0] == 'x' ? $randomNumberFrom0To15 : $randomNumberFrom0To15 & 0x3 | 0x8);
        },
                $pattern
        );
    }

}