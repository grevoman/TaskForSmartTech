<?php

namespace app\modules\parseKgdGovKz\interfaces;

/**
 * Интерфейс для операций с БД
 *
 */
interface DbOperationsInterface
{

    public function saveTaxArrearDataFromSite($taxArrearJsonData);
}