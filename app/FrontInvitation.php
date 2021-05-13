<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FrontInvitation extends Model
{
    protected $table = 'front_invitations';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'centre_id', 'token'
    ];


}
