<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MangInvitation extends Model
{
    protected $table = 'mang_invitations';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'centre_id', 'token'
    ];


}
