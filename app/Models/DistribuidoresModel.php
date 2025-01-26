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
              $sql = "SELECT distribuidores.id, CONCAT(distribuidores.nombre,distribuidores.apellidos) AS distribuidor,COUNT(distribuidores.id)as numTalleres
                     FROM distribuidores
                     JOIN talleres ON distribuidores.id = talleres.id_distribuidores
                     GROUP BY distribuidores.id";

              $query = $this->query($sql);
              $datos = array();

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
       public function listaDistribuidoresConTalleres()
       {
              $distribuidoresConTalleres = $this
                     ->join('talleres', 'distribuidores.id = talleres.id_distribuidores', 'LEFT')
                     ->select(
                            'distribuidores.id AS distribuidor_id,
             distribuidores.razon_social,
             distribuidores.nombre,
             distribuidores.apellidos,
             distribuidores.cif_nif_nie,
             talleres.id AS taller_id,
             talleres.provincias,
             talleres.id_localidades,
             talleres.direccion,
             talleres.numero,
             talleres.cp'
                     )
                     ->findAll();

              return $distribuidoresConTalleres;
       }
}
