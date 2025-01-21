<?php
namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class CallejeroModel extends Model
{
    //SELECT `id`, `id_localidades`, `tipo_via`, `denominacion`, `nombre_literal`, `barrio_rural`, `cp`, `created_at`, `updated_at` FROM `callejero` WHERE 1
    protected $table='callejero';
    protected $allowedFields=['id_localidades', 'tipo_via', 'denominacion', 'nombre_literal', 'barrio_rural', 'cp', 'created_at', 'updated_at'];
    


public function datosgrafica(){
      
            $sql=" SELECT `barrio_rural`,COUNT(id) as num FROM `callejero`";
            
            $sql.=" where `barrio_rural`!='' and `barrio_rural` is not null";
            $sql.=" GROUP BY `barrio_rural`";
         
            $query=$this->query($sql);
            $datos=array();
            
            if($query->getResult()){
                $datos=$query->getResultArray();
            }
         
         return $datos;
         
     }
}
?>