<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\LocalidadModel;



class LocalidadesController extends BaseController
{

    protected $helpers = ['form'];

    public function index()
    {
        if (!isAdmin()) {
            return redirect()->to('/');
        }
        $model = new LocalidadModel();
        $data['localidades'] = $model->findAll();

        return view('localidadListView', $data);
    }

    public function nuevo()
    {

        return view('localidadesNewView');
    }


    public function crear()
    {

        $rules = [
            'id_provincias' => [
                'rules' => 'required|is_unique[localidades.id_provincias]',
                'errors' => [
                    'required' => 'Debes introducir un id de provincia',
                    'is_unique' => 'El id de la provincia ya existe',

                ]
            ],
            'cmun' => [
                'rules' => 'required|is_unique[localidades.cmun]',
                'errors' => [
                    'required' => 'Debes introducir un cmun',
                    'is_unique' => 'El nombre cmun ya existe',

                ]
            ],
            'dc' => [
                'rules' => 'required|is_unique[localidades.dc]',
                'errors' => [
                    'required' => 'Debes introducir un dc',
                    'is_unique' => 'El nombre dc ya existe',

                ]
            ],
            'localidad' => [
                'rules' => 'required|is_unique[localidades.localidad]',
                'errors' => [
                    'required' => 'Debes introducir una localidad',
                    'is_unique' => 'El nombre de la localidad ya existe',
                ]
            ],


        ];

        $datos = $this->request->getPost(array_keys($rules));

        if (!$this->validateData($datos, $rules)) {
            return redirect()->back()->withInput();
        }

        $model = new LocalidadModel();
        $id_provincias = $this->request->getvar('id_provincias');

        $cmun = $this->request->getvar('cmun');

        $dc = $this->request->getvar('dc');

        $localidad = $this->request->getvar('localidad');

        $newData = [
            'id_provincias' => $id_provincias,
            'cmun' => $cmun,
            'dc' => $dc,
            'localidad' => $localidad
        ];

        $model->save($newData);


        return redirect()->to('/localidades');
    }

    public function editar()
    {
        $model = new LocalidadModel();
        $id = $this->request->getvar('id');
        $data["datos"] = $model->where('id', $id)->first();

        return view('localidadesEditView', $data);
    }

    public function actualizar()
    {

        $rules = [
            'id_provincias' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Debes introducir un id de provincia',

                ]
            ],
            'cmun' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Debes introducir un cmun',

                ]
            ],
            'dc' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Debes introducir un dc',

                ]
            ],
            'localidad' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Debes introducir una localidad',

                ]
            ],


        ];

        $datos = $this->request->getPost(array_keys($rules));

        if (!$this->validateData($datos, $rules)) {
            return redirect()->back()->withInput();
        }

        $model = new LocalidadModel();
        $id = $this->request->getvar('id');
        $id_provincias = $this->request->getvar('id_provincias');
        $cmun = $this->request->getvar('cmun');
        $dc = $this->request->getvar('dc');
        $localidad = $this->request->getvar('localidad');

        $model->where('id', $id)
            ->set(['id_provincias' => $id_provincias, 'cmun' => $cmun, 'dc' => $dc, 'localidad' => $localidad, 'updated_at' => date("Y-m-d h:i:s")])
            ->update();

        return redirect()->to('/localidades');
    }


    public function delete()
    {
        $model = new LocalidadModel();
        $id = $this->request->getvar('id');

        $model->where('id', $id)->delete();
        return redirect()->to('/localidades');
    }
}
