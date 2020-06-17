<?php
function formatMacAddress ($value)  {
    $hex = base_convert($value, 10, 16);
    while (strlen($hex) < 12)
    $hex = '0'.$hex;
    return strtoupper(implode(':', str_split($hex,2)));
}
function converToStoreMacAddress ($value) {
    return base_convert(str_replace(':','', $value), 16, 10);
}