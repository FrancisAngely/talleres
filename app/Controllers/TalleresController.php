<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\TalleresModel;
use App\Models\ProvinciaModel;
use App\Models\LocalidadModel;
use App\Models\DistribuidoresModel;






class TalleresController extends BaseController
{

    protected $helpers = ['form'];

    public function index()
    {
        $talleres = new TalleresModel();
        $data['talleres'] = $talleres->findAll();

        return view('talleresListView', $data);
    }

    public function nuevo()
    {
        $options = array();
        $options[''] = "--Select--";

        $modelprovincia = new ProvinciaModel();
        $provincias = $modelprovincia->findAll();
        foreach ($provincias as $provincia) {
            if ($provincia["activo"] == 1) {
                $options[$provincia["id"]] = $provincia["provincia"];
            }
        }
        $data["optionsProvincias"] = $options;

        $options1 = array();
        $options1[''] = "--Select--";

        $modellocalidades = new LocalidadModel();
        $localidades = $modellocalidades->findAll();
        foreach ($localidades as $localidad) {
            if ($localidad["activo"] == 1)
                $options1[$localidad["id"]] = $localidad["localidad"];
        }
        $data["optionsLocalidades"] = $options1;

        return view('talleresNewView', $data);
    }

    public function crear()
    {
        $rules = [
            'id_distribuidores' => [
                'rules' => 'required|is_unique[talleres.id_distribuidores]',
                'errors' => [
                    'required' => 'Debes introducir un id de distribuidores',
                    'is_unique' => 'El id de distribuidor ya existe',

                ]
            ],
            'provincias' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Debes introducir una provincia',

                ]
            ],
            'id_localidades' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Debes introducir un id de la localidad',

                ]
            ],
            'direccion' => [
                'rules' => 'required|is_unique[talleres.direccion]',
                'errors' => [
                    'required' => 'Debes introducir una direccion',
                    'is_unique' => 'La direccion ya existe',
                ]
            ],
            'numero' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Debes introducir un numero'
                ]
            ],
            'cp' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Debes introducir un codigo postal',

                ]
            ]
        ];

        $datos = $this->request->getPost(array_keys($rules));

        if (!$this->validateData($datos, $rules)) {
            return redirect()->back()->withInput();
        }

        $talleres = new TalleresModel();
        $id_distribuidores = $this->request->getvar('id_distribuidores');
        $provincias = $this->request->getvar('provincias');
        $id_localidades = $this->request->getvar('id_localidades');
        $direccion = $this->request->getvar('direccion');
        $numero = $this->request->getvar('numero');
        $cp = $this->request->getvar('cp');


        $newData = [
            'id_distribuidores' => $id_distribuidores,
            'provincias' => $provincias,
            'id_localidades' => $id_localidades,
            'direccion' => $direccion,
            'numero' => $numero,
            'cp' => $cp
        ];

        $talleres->save($newData);


        return redirect()->to('/talleres');
    }
    //SELECT `id`, `id_distribuidores`, `provincias`, `id_localidades`, `direccion`, `numero`, `cp`, `created_at`, `updated_at` FROM `talleres` WHERE 1

    public function editar()
    {
        $talleres = new TalleresModel();
        $id = $this->request->getvar('id');
        $data["datos"] = $talleres->where('id', $id)->first();

        $options = array();
        $options[''] = "--Select--";

        $modelprovincia = new ProvinciaModel();
        $provincias = $modelprovincia->findAll();
        foreach ($provincias as $provincia) {
            if ($provincia["activo"] == 1) {
                $options[$provincia["id"]] = $provincia["provincia"];
            }
        }
        $data["optionsProvincias"] = $options;

        $options1 = array();
        $options1[''] = "--Select--";

        $modellocalidades = new LocalidadModel();
        $localidades = $modellocalidades->findAll();
        foreach ($localidades as $localidad) {
            if ($localidad["activo"] == 1)
                $options1[$localidad["id"]] = $localidad["localidad"];
        }
        $data["optionsLocalidades"] = $options1;


        return view('talleresEditView', $data);
    }

    public function actualizar()
    {
        $rules = [
            'id_distribuidores' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Debes introducir un id de distribuidores',
                ]
            ],
            'provincias' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Debes introducir una provincia',
                ]
            ],
            'id_localidades' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Debes introducir un id de la localidad',

                ]
            ],
            'direccion' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Debes introducir una direccion',
                ]
            ],
            'numero' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Debes introducir un numero',
                ]
            ],
            'cp' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Debes introducir un codigo postal',
                ]
            ]
        ];

        $datos = $this->request->getPost(array_keys($rules));

        if (!$this->validateData($datos, $rules)) {
            return redirect()->back()->withInput();
        }

        $talleres = new TalleresModel();
        $id = $this->request->getvar('id');
        $id_distribuidores = $this->request->getvar('id_distribuidores');
        $provincias = $this->request->getvar('provincias');
        $id_localidades = $this->request->getvar('id_localidades');
        $direccion = $this->request->getvar('direccion');
        $numero = $this->request->getvar('numero');
        $cp = $this->request->getvar('cp');

        $talleres->where('id', $id)
            ->set(['id_distribuidores' => $id_distribuidores, 'provincias' => $provincias, 'id_localidades' => $id_localidades, 'direccion' => $direccion, 'numero' => $numero, 'cp' => $cp, 'updated_at' => date("Y-m-d h:i:s")])
            ->update();

        return redirect()->to('/talleres');
    }


    public function delete()
    {
        $talleres = new TalleresModel();
        $id = $this->request->getvar('id');

        $talleres->where('id', $id)->delete();
        return redirect()->to('/talleres');
    }

    public function graficas()
    {
        $model = new DistribuidoresModel();
        $talleres = $model->datosgrafica();
        $data["datos"] = $talleres;
        $xValues = array();
        $yValues = array();
        $colores = '"red", "green", "blue", "orange", "brown"';

        if (count($talleres) > 0) {
            foreach ($talleres as $taller) {
                array_push($yValues, $taller["numTalleres"]);
                array_push($xValues, "'" . $taller["distribuidor"] . "'");
            }
        }

        $yValues = implode(",", $yValues);
        $xValues = implode(",", $xValues);

        $data["yValues"] = $yValues;
        $data["xValues"] = $xValues;
        $data["colores"] = $colores;
        $data["idGrafBarra"] = "id1";
        $data["datalabel"] = "label";

        $datalabel = array();
        $ticks = array();
        $datalabel = implode(",", $datalabel);
        $ticks = implode(",", $ticks);
        $data["datalabel"] = $datalabel;
        $data["ticks"] = $ticks;
        return view('graficaView', $data);
    }
}
