<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
// SELECT `id`, `id_distribuidores`, `provincias`, `id_localidades`, `direccion`, `numero`, `cp`, `created_at`, `updated_at` FROM `talleres` WHERE 1

class TalleresModel extends Model
{
     protected $table = 'talleres';
     protected $allowedFields = ['id_distribuidores', 'provincias', 'id_localidades', 'direccion', 'numero', 'cp', 'created_at', 'updated_at'];


     public function listaTalleres()
     {
          $distribuidores = $this
               ->select(
                    'talleres.id,
                    talleres.direccion,
                    talleres.numero,
                    talleres.cp,
                    distribuidores.nombre AS nombre_distribuidor,
                    localidades.nombre AS nombre_localidad'
               )
               ->join('distribuidores', 'talleres.id_distribuidores = distribuidores.id', 'left')
               ->join('localidades', 'talleres.id_localidades = localidades.id', 'left')
               ->where('talleres.id', 'talleres.id')
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
