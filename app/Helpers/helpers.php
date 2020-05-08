<?php

function price_format($price, int $decimals = 2, string $dec_point = '.', $thousands_sep = '')
{
    return number_format($price, $decimals, $dec_point, $thousands_sep);
}
