<?php
namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class DistribuidoresModel extends Model
{
       // SELECT `id`, `razon_social`, `nombre`, `apellidos`, `cif_nif_nie`, `created_at`, `updated_at` FROM `distribuidores` WHERE 1    
       protected $table='distribuidores';
       protected $allowedFields=['razon_social','nombre','apellidos','cif_nif_nie', 'created_at', 'updated_at'];
}
?>