<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subsubserver extends Model
{
    protected $table = 'sub_sub_servers';
    protected $fillable = ['sub_server_id', 'vps_server_id', 'name'];

public function vpsServer()
    {
        return $this->belongsTo(VpsServer::class);
    }
    public function subServer()
    {
        return $this->belongsTo(SubServer::class);
    }
}