<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EppSetting extends Model
{
    protected $table = 'epp_settings';

    protected $fillable = ['target', 'host_name', 'port', 'username', 'password', 'ssl_key','ssl_active','is_active'];

    protected $dates = ['deleted_at','updated_at'];
}
