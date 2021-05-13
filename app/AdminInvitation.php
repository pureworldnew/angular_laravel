<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminInvitation extends Model
{
    protected $table = 'admin_invitations';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'centre_id', 'token'
    ];


}
