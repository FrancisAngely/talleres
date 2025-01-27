<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Files\File;
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
        // Reglas de validación
        $rules = [
            'modelo' => [
                'rules' => 'required|is_unique[modelos.modelo]',
                'errors' => [
                    'required' => 'Debes introducir un modelo',
                    'is_unique' => 'El modelo ya existe',
                ]
            ],
            'descripcion' => [
                'rules' => 'required|is_unique[modelos.descripcion]',
                'errors' => [
                    'required' => 'Debes introducir una descripción',
                    'is_unique' => 'La descripción ya existe',
                ]
            ],
            'precio' => [
                'rules' => 'required|decimal',
                'errors' => [
                    'required' => 'Debes introducir un precio',
                    'decimal' => 'El precio debe ser un número válido',
                ]
            ],
            'foto' => [
                'rules' => 'is_image[foto]|max_dims[foto,1024,768]',
                'errors' => [
                    'is_image' => 'El archivo debe ser una imagen',
                    'max_dims' => 'Las dimensiones de la imagen no deben superar los 1024x768 píxeles',
                ]
            ],
        ];

        // Manejar el archivo subido
        $file = $this->request->getFile('foto');

        // Verifica si se recibió el archivo
        if (!$file) {
            dd('No se recibió el archivo. Asegúrate de que el campo <input> tenga el nombre correcto.');
            return 'No se recibió ningún archivo.';
        }

        // Verifica si es válido
        if (!$file->isValid()) {
            dd('El archivo no es válido: ' . $file->getErrorString());
            return 'El archivo no es válido: ' . $file->getErrorString() . ' (' . $file->getError() . ')';
        }

        $fileName = $file->getRandomName(); // Genera un nombre único
        $uploadPath = FCPATH . 'uploads/';
        //echo  $uploadPath;

        if ($file->isValid() && !$file->hasMoved()) {
            $file->move($uploadPath, $fileName);
        } else {
            return redirect()->back()->with('error', 'Error al subir la imagen.');
        }

        // Guardar los datos en la base de datos
        $model = new ModelosModel();
        $data = [
            'modelo' => $this->request->getPost('modelo'),
            'descripcion' => $this->request->getPost('descripcion'),
            'precio' => $this->request->getPost('precio'),
            'foto' => $fileName, // Guarda el nombre del archivo en la base de datos
        ];

        $model->save($data);

        return redirect()->to('/modelos');
    }


    public function editar()
    {
        $model = new ModelosModel();
        $id = $this->request->getVar('id');

        // Obtiene los datos del modelo
        $data['datos'] = $model->where('id', $id)->first();

        if (!$data['datos']) {
            return redirect()->to('/modelos')->with('error', 'Modelo no encontrado');
        }

        // Carga la vista con los datos
        return view('modelosEditView', $data);
    }


    public function actualizar()
    {
        // Reglas de validación
        $rules = [
            'modelo' => 'required',
            'descripcion' => 'required',
            'precio' => 'required|decimal',
            'foto' => 'permit_empty|is_image[foto]|max_dims[foto,1024,768]', // Permitimos que foto sea opcional
        ];

        // Validar los datos del formulario
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Hubo un error con la validación.');
        }

        // Obtener los datos enviados por el formulario
        $id = $this->request->getVar('id');
        $modelo = $this->request->getVar('modelo');
        $descripcion = $this->request->getVar('descripcion');
        $precio = $this->request->getVar('precio');

        // Recuperar los datos existentes en la base de datos
        $model = new ModelosModel();
        $datosExistentes = $model->where('id', $id)->first();

        if (!$datosExistentes) {
            return redirect()->back()->with('error', 'El modelo no existe.');
        }

        // Preparar los datos para la actualización
        $data = [
            'modelo' => $modelo,
            'descripcion' => $descripcion,
            'precio' => $precio,
            'updated_at' => date("Y-m-d h:i:s"),
        ];

        // Manejo de la foto
        $file = $this->request->getFile('foto');

        if ($file && $file->isValid()) {
            // Generar un nombre único para la imagen
            $fileName = $file->getRandomName();

            // Eliminar la foto anterior si existe
            if (!empty($datosExistentes['foto'])) {
                $oldFile = FCPATH . 'uploads/' . $datosExistentes['foto'];
                if (file_exists($oldFile)) {
                    try {
                        unlink($oldFile);
                    } catch (\Exception $e) {
                        log_message('error', 'Error eliminando el archivo: ' . $e->getMessage());
                    }
                }
            }

            // Mover el archivo al directorio de sub¡idas
            $file->move(FCPATH . 'uploads/', $fileName); // Cambiado a 'uploads/'

            // Agregar la foto al array de datos
            $data['foto'] = $fileName;
        } else {
            // Mantener la foto existente
            $data['foto'] = $datosExistentes['foto'];
        }

        // Actualizar los datos en la base de datos
        $model->update($id, $data);

        return redirect()->to('/modelos')->with('success', 'Modelo actualizado correctamente.');
    }



    public function delete()
    {
        $model = new ModelosModel();
        $id = $this->request->getvar('id');

        $model->where('id', $id)->delete();
        return redirect()->to('/modelos');
    }
}
