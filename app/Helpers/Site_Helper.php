<?php
function getMoneyFormat($currency, $value)
{
	return $currency . number_format($value, 2, ".", ',');
}
