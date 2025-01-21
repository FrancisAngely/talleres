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
        $data['distribuidores'] = $model->findAll();

        return view('distribuidoresListView', $data);
    }

    public function nuevo()
    {

        return view('distribuidoresNewView');
    }


    public function crear()
    {

        $rules = [
            'razon_social' => [
                'rules' => 'required|is_unique[distribuidores.razon_social]',
                'errors' => [
                    'required' => 'Debes introducir una razon social',
                    'is_unique' => 'La razon social ya existe',

                ]
            ],
            'nombre' => [
                'rules' => 'required|is_unique[distribuidores.nombre]',
                'errors' => [
                    'required' => 'Debes introducir un nombre',
                    'is_unique' => 'El nombre ya existe',

                ]
            ],
            'apellidos' => [
                'rules' => 'required|is_unique[distribuidores.apellidos]',
                'errors' => [
                    'required' => 'Debes introducir un apellido',
                    'is_unique' => 'Los apellidos ya existe',

                ]
            ],
            'cif_nif_nie' => [
                'rules' => 'required|is_unique[distribuidores.cif_nif_nie]',
                'errors' => [
                    'required' => 'Debes introducir una CIF, NIF o NIE',
                    'is_unique' => 'El CIF, NIF o NIE ya existe',
                ]
           ]

        ];

        $datos = $this->request->getPost(array_keys($rules));

        if (!$this->validateData($datos, $rules)) {
            return redirect()->back()->withInput();
        }

        $model = new ModelosModel();
        $razon_social = $this->request->getvar('razon_social');

        $nombre = $this->request->getvar('nombre');

        $apellidos = $this->request->getvar('apellidos');

        $cif_nif_nie = $this->request->getvar('cif_nif_nie');

        $newData = [
            'razon_social' => $razon_social,
            'nombre' => $nombre,
            'apellidos' => $apellidos,
            'cif_nif_nie' => $cif_nif_nie
        ];

        $model->save($newData);


        return redirect()->to('/distribuidores');
    }

    public function editar()
    {
        $model = new ModelosModel();
        $id = $this->request->getvar('id');
        $data["datos"] = $model->where('id', $id)->first();


        return view('distribuidoresEditView', $data);
    }

    public function actualizar()
    {

        $rules = [
            'razon_social' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Debes introducir una razon social',

                ]
            ],
            'nombre' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Debes introducir un nombre',

                ]
            ],
            'apellidos' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Debes introducir un apellido',

                ]
            ],
            'cif_nif_nie' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Debes introducir una CIF, NIF o NIE',

                ]
            ],


        ];

        $datos = $this->request->getPost(array_keys($rules));

        if (!$this->validateData($datos, $rules)) {
            return redirect()->back()->withInput();
        }

        $model = new ModelosModel();
        $id = $this->request->getvar('id');
        $razon_social = $this->request->getvar('razon_social');
        $nombre = $this->request->getvar('nombre');
        $apellidos = $this->request->getvar('apellidos');
        $cif_nif_nie = $this->request->getvar('cif_nif_nie');

        $model->where('id', $id)
        ->set(['razon_social'=>$razon_social,'nombre'=>$nombre,'apellidos'=>$apellidos,'cif_nif_nie'=>$cif_nif_nie,'updated_at'=>date("Y-m-d h:i:s")])
        ->update();


        return redirect()->to('/distribuidores');
    }


    public function delete()
    {
        $model = new ModelosModel();
        $id = $this->request->getvar('id');

        $model->where('id', $id)->delete();
        return redirect()->to('/distribuidores');
    }
}
