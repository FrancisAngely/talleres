<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class DistribuidoresModel extends Model
{
       // SELECT `id`, `razon_social`, `nombre`, `apellidos`, `cif_nif_nie`, `created_at`, `updated_at` FROM `distribuidores` WHERE 1    
       protected $table = 'distribuidores';
       protected $allowedFields = ['razon_social', 'nombre', 'apellidos', 'cif_nif_nie', 'created_at', 'updated_at'];

       public function datosgrafica()
       {
              $sql = "
              SELECT 
                distribuidores.id, 
                CASE 
                    WHEN TRIM(distribuidores.razon_social) != '' THEN distribuidores.razon_social
                    ELSE CONCAT_WS(' ', TRIM(distribuidores.nombre), TRIM(distribuidores.apellidos))
                            END AS distribuidor,
                            COUNT(talleres.id) AS numTalleres
                     FROM distribuidores
                     LEFT JOIN talleres ON distribuidores.id = talleres.id_distribuidores
                     GROUP BY distribuidores.id
                     ORDER BY numTalleres DESC;";

              $query = $this->query($sql);
              $datos = [];

              if ($query->getResult()) {
                     $datos = $query->getResultArray();
              }

              return $datos;
       }

       public function listaDistribuidor()
       {
              $distribuidores = $this
                     ->select(
                            'distribuidores.id,
                            distribuidores.razon_social,
                            distribuidores.nombre,
                            distribuidores.apellidos,
                            distribuidores.cif_nif_nie,
                            IFNULL(NULLIF(distribuidores.razon_social, ""), CONCAT(distribuidores.nombre, " ", distribuidores.apellidos)) as distribuidor'
                     )
                     ->findAll();

              return $distribuidores;
       }
}
