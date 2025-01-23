<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
// SELECT `id`, `id_distribuidores`, `provincias`, `id_localidades`, `direccion`, `numero`, `cp`, `created_at`, `updated_at` FROM `talleres` WHERE 1

class TalleresModel extends Model
{
     protected $table = 'talleres';
     protected $allowedFields = ['id_distribuidores', 'provincias', 'id_localidades', 'direccion','numero','cp', 'created_at', 'updated_at'];
}
