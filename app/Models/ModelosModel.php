<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class ModelosModel extends Model
{


     // SELECT `id`, `modelo`, `descripcion`, `precio`, `foto`, `created_at`, `updated_at` FROM `modelos` WHERE 1    
     protected $table = 'modelos';
     protected $allowedFields = ['modelo', 'descripcion', 'precio', 'foto', 'created_at', 'updated_at'];
}
