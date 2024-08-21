<?php
function getMoneyFormat($currency, $value)
{
	return $currency . number_format($value, 2, ".", ',');
}

function getService($serviceID)
{
    $db = \Config\Database::connect();

    $query = $db->table('services')
        ->select('
        services.id,
        services.name,
        services.price,
        services.description
    ')
        ->where('id', $serviceID)
        ->where('services.deleted', 0);

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
