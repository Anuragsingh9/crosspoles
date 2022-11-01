<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersData extends Model
{
    use HasFactory;

    protected $table = 'crosspoles_users';

    protected $fillable = ['name','email','description','filepath','phone','role'];
}
