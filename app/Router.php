<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Router extends Model
{
    protected $table = 'routers';

    protected $fillable = ['sapid', 'hostname', 'loopback', 'mac_address', 'type'];


    function getMacAddressAttribute ($value) {
        return formatMacAddress($value);
    }

    function setMacAddressAttribute ($value) {
        $this->attributes['mac_address'] = base_convert(str_replace(':','', $value), 16, 10);
    }

    
}
