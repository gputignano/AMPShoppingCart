<?php

namespace App\Models;

use App\Contracts\EAVValue;
use Illuminate\Support\Facades\Log;

class EAVDecimal extends EAVValue
{
    public $table = 'eav_decimals';
}
