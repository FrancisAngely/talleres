<?php

namespace App\Controllers;

use App\Models\RoleModel;
use App\Models\UsuarioModel;

class Home extends BaseController
{
    protected $helpers = ['form'];

    public function index()
    {
        //      $model=new UsuarioModel();
        //      $usuarios=$model->datosgrafica();
        //      $data["datos"]=$usuarios;
        //      $datalabel=array();
        //      $ticks=array();
        //      if(count($usuarios)>0){
        //          $i=1;
        //          foreach($usuarios as $user){
        //              array_push($datalabel,"[".$i.",".$user["numUsuarios"]."]");
        //              array_push($ticks,"[".$i.",'".$user["role"]."']");
        //              $i++;
        //          }
        //      }
        //     //  $datalabel=implode(",",$datalabel);
        //     //  $ticks=implode(",",$ticks);
        //     //  $data["datalabel"]=$datalabel;
        //     //  $data["ticks"]=$ticks;
        //     //  $data["idGrafBarra"]="id1";
        //     //  $dataC["grafica1"]=view('graf_barraView',$data);
        //     //   $data["idGrafBarra"]="id2";
        //     //  $dataC["grafica2"]=view('graf_barraView',$data);

        //      $xValues=array();
        //       $yValues=array();
        //      $colores='"red", "green","blue","orange","brown"';

        // //"red", "green","blue","orange","brown"
        //      if(count($usuarios)>0){
        //          $i=0;
        //          foreach($usuarios as $user){
        //              array_push($yValues,$user["numUsuarios"]);
        //              array_push($xValues,"'".$user["role"]."'");

        //              $i++;
        //          }
        //      }
        //      $yValues=implode(",",$yValues);
        //      $xValues=implode(",",$xValues);
        //      // $colores=implode(",",$colores);
        //      $data["yValues"]=$yValues;
        //      $data["xValues"]=$xValues;
        //     $data["colores"]=$colores;
        //      $data["idGrafPie"]="id3";
        //    $dataC["grafica3"]=view('graf_pieView',$data);

        //      $data["idGrafLine"]="id4";
        //     $data["datos"]=$yValues;
        //     $dataC["grafica4"]=view('graf_LineView',$data);

        // return view('inicio');
    }
    public function inicio()
    {
        $data["mensaje"] = "Hola,";
        $data["mensaje2"] = "mundo";
        return view('inicio', $data);
    }


    public function inicioGet()
    {
        $id = $this->request->getVar('id');

        $data["mensaje"] = $id;
        $data["mensaje2"] = "";
        return view('inicio', $data);
    }

    public function formulario(): string
    {
        //breadcrumb
        $data["titulo"] = "Formulario";
        $data["item_active"] = "Formulario";

        $data["item1"] = "Roles";
        $data["itemhref1"] = "/roles";

        $data["item2"] = "Inicio";
        $data["itemhref2"] = "/inicio";

        $data["numitem"] = "2";

        return view('formulario', $data);
    }


    public function comprobar()
    {
        $id = $this->request->getVar('id');
        $usuario = $this->request->getVar('usuario');
        $password = $this->request->getVar('password');

        echo $id . "_" . $usuario . "-" . $password;
        return view('formulario');
        return redirect()->to("/inicio");
    }
}
