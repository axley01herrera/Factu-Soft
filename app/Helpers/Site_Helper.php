<?php
function getMoneyFormat($currency, $value)
{
    return $currency . number_format($value, 2, ".", ',');
}

function getService($serviceID)
{
    $db = \Config\Database::connect();

    $query = $db->table('services')
        ->where('id', $serviceID);

    $data = $query->get()->getResult();

    return $data;
}

function getDateLabel($lang)
{
    if ($lang == 'es')
        return "d-m-Y";
    else
        return "m-d-Y";
}


