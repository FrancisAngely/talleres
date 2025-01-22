<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ModelosModel;



class ModelosController extends BaseController
{

    protected $helpers = ['form'];

    public function index()
    {
        $model = new ModelosModel();
        $data['modelos'] = $model->findAll();

        return view('modelosListView', $data);
    }

    public function nuevo()
    {

        return view('modelosNewView');
    }


    public function crear()
    {
        $rules = [
            'modelo' => [
                'rules' => 'required|is_unique[modelos.modelo]',
                'errors' => [
                    'required' => 'Debes introducir un modelo',
                    'is_unique' => 'La modelo ya existe',

                ]
            ],
            'descripcion' => [
                'rules' => 'required|is_unique[modelos.descripcion]',
                'errors' => [
                    'required' => 'Debes introducir una descripcion',
                    'is_unique' => 'La descripcion ya existe',

                ]
            ],
            'precio' => [
                'rules' => 'required|is_unique[modelos.precio]',
                'errors' => [
                    'required' => 'Debes introducir un precio',
                    'is_unique' => 'El precio ya existe',

                ]
            ],
            'foto' => [
                'rules' => 'required|is_unique[modelos.foto]',
                'errors' => [
                    'required' => 'Debes introducir una foto',
                    'is_unique' => 'La foto ya existe',
                ]
            ]
        ];

        $datos = $this->request->getPost(array_keys($rules));

        if (!$this->validateData($datos, $rules)) {
            return redirect()->back()->withInput();
        }

        $model = new ModelosModel();
        $modelo = $this->request->getvar('modelo');
        $descripcion = $this->request->getvar('descripcion');
        $precio = $this->request->getvar('precio');
        $foto = $this->request->getvar('foto');

        $newData = [
            'modelo' => $modelo,
            'descripcion' => $descripcion,
            'precio' => $precio,
            'foto' => $foto
        ];

        $model->save($newData);


        return redirect()->to('/modelos');
    }

    public function editar()
    {
        $model = new ModelosModel();
        $id = $this->request->getvar('id');
        $data["datos"] = $model->where('id', $id)->first();


        return view('modelosEditView', $data);
    }

    public function actualizar()
    {
        $rules = [
            'modelo' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Debes introducir un modelo',

                ]
            ],
            'descripcion' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Debes introducir una descripcion',

                ]
            ],
            'precio' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Debes introducir un precio',

                ]
            ],
            'foto' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Debes introducir una foto',
                ]
            ]
        ];

        $datos = $this->request->getPost(array_keys($rules));

        if (!$this->validateData($datos, $rules)) {
            return redirect()->back()->withInput();
        }

        $model = new ModelosModel();
        $id = $this->request->getvar('id');
        $modelo = $this->request->getvar('modelo');
        $descripcion = $this->request->getvar('descripcion');
        $precio = $this->request->getvar('precio');
        $foto = $this->request->getvar('foto');

        $model->where('id', $id)
            ->set(['modelo' => $modelo, 'descripcion' => $descripcion, 'precio' => $precio, 'foto' => $foto, 'updated_at' => date("Y-m-d h:i:s")])
            ->update();

        return redirect()->to('/modelos');
    }


    public function delete()
    {
        $model = new ModelosModel();
        $id = $this->request->getvar('id');

        $model->where('id', $id)->delete();
        return redirect()->to('/modelos');
    }
}
