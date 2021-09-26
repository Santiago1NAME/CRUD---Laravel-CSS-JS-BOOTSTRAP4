<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolEmp extends Model
{
    use HasFactory;
    protected $table = "empleado_rol";
    public $timestamps = false;
}
