<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\DistribuidoresModel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use Dompdf\Dompdf;
use Dompdf\Options;

class DistribuidoresController extends BaseController
{
    protected $helpers = ['form'];

    public function index()
    {
        $model = new DistribuidoresModel();
        $data['distribuidores'] = $model->findAll();

        return view('distribuidoresListView', $data);
    }

    public function nuevo()
    {
        return view('distribuidoresNewView');
    }

    // Función para validar si un campo es requerido dependiendo de otro
    // public function required_if_other_empty(string $value, string $otherField, array $data): bool
    // {
    //     // Si el otro campo está vacío, el campo actual debe tener un valor
    //     if (empty($data[$otherField])) {
    //         return !empty($value);
    //     }

    //     // Si el otro campo no está vacío, el campo actual no es obligatorio
    //     return true;
    // }

    public function crear()
    {
        // Reglas de validación
        $rules = [
            'razon_social' => [
                'rules' => 'required_if_other_empty[nombre,apellidos]',
                'errors' => [
                    'required_if_other_empty' => 'La razón social es obligatoria si nombre y apellidos están vacíos.',
                ]
            ],
            'nombre' => [
                'rules' => 'required_if_other_empty[razon_social]',
                'errors' => [
                    'required_if_other_empty' => 'El nombre es obligatorio si la razón social está vacía.',
                ]
            ],
            'apellidos' => [
                'rules' => 'required_if_other_empty[razon_social]',
                'errors' => [
                    'required_if_other_empty' => 'Los apellidos son obligatorios si la razón social está vacía.',
                ]
            ],
            'cif_nif_nie' => [
                'rules' => 'required|is_unique[distribuidores.cif_nif_nie]',
                'errors' => [
                    'required' => 'Debes introducir una CIF, NIF o NIE.',
                    'is_unique' => 'El CIF, NIF o NIE ya existe.',
                ]
            ]
        ];

        $datos = $this->request->getPost(array_keys($rules));

        // Validar datos usando las reglas
        if (!$this->validateData($datos, $rules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
        }

        $model = new DistribuidoresModel();
        $razon_social = $this->request->getVar('razon_social');
        $nombre = $this->request->getVar('nombre');
        $apellidos = $this->request->getVar('apellidos');
        $cif_nif_nie = $this->request->getVar('cif_nif_nie');

        $newData = [
            'razon_social' => $razon_social,
            'nombre' => $nombre,
            'apellidos' => $apellidos,
            'cif_nif_nie' => $cif_nif_nie,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ];

        // Guardar datos iniciales
        if ($model->save($newData)) {
            return redirect()->to('/distribuidores')->with('success', 'Distribuidor creado correctamente.');
        }

        return redirect()->back()->with('error', 'No se pudo crear el distribuidor. Intente de nuevo.');
    }



    public function editar()
    {
        $model = new DistribuidoresModel();
        $id = $this->request->getvar('id');
        $data["datos"] = $model->where('id', $id)->first();


        return view('distribuidoresEditView', $data);
    }

    public function actualizar()
    {

        $rules = [
            'razon_social' => [
                'rules' => 'required_if_other_empty[distribuidores.nombre]|required_if_other_empty[distribuidores.apellido]',
                'errors' => [
                    'required_if_other_empty' => 'La razón social es requerido si nombre y apellido esta vacia.',
                ]
            ],
            'nombre' => [
                'rules' => 'required_if_other_empty[distribuidores.razon_social]',
                'errors' => [
                    'required_if_other_empty' => 'El Nombre es requerido si la razón social esta vacia.',
                ]
            ],
            'apellidos' => [
                'rules' => 'required_if_other_empty[distribuidores.razon_social]',
                'errors' => [
                    'required_if_other_empty' => 'El Apellido es requerido si la razón social esta vacia.',

                ]
            ],
            'cif_nif_nie' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Debes introducir una CIF, NIF o NIE',
                ]
            ]

        ];

        $datos = $this->request->getPost(array_keys($rules));

        if (!$this->validateData($datos, $rules)) {
            return redirect()->back()->withInput();
        }

        $model = new DistribuidoresModel();
        $id = $this->request->getvar('id');
        $razon_social = $this->request->getvar('razon_social');
        $nombre = $this->request->getvar('nombre');
        $apellidos = $this->request->getvar('apellidos');
        $cif_nif_nie = $this->request->getvar('cif_nif_nie');

        $model->where('id', $id)
            ->set(['razon_social' => $razon_social, 'nombre' => $nombre, 'apellidos' => $apellidos, 'cif_nif_nie' => $cif_nif_nie, 'updated_at' => date("Y-m-d h:i:s")])
            ->update();


        return redirect()->to('/distribuidores');
    }


    public function delete()
    {
        $model = new DistribuidoresModel();
        $id = $this->request->getvar('id');

        $model->where('id', $id)->delete();
        return redirect()->to('/distribuidores');
    }

    public function exportar()
    {
        $model = new DistribuidoresModel();
        $datos = $model->listaDistribuidor();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // SELECT `id`, `razon_social`, `nombre`, `apellidos`, `cif_nif_nie`, `created_at`, `updated_at` FROM `distribuidores` WHERE 1
        $sheet->setCellValue('A1', 'razon_social');
        $sheet->setCellValue('B1', 'nombre');
        $sheet->setCellValue('C1', 'apellidos');
        $sheet->setCellValue('D1', 'cif_nif_nie');
        $count = 2;
        foreach ($datos as $dato) {

            $sheet->setCellValue('A' . $count, $dato['razon_social']);
            $sheet->setCellValue('B' . $count, $dato['nombre']);
            $sheet->setCellValue('C' . $count, $dato['apellidos']);
            $sheet->setCellValue('D' . $count, $dato['cif_nif_nie']);
            $count++;
        }
        print_r($datos);

        $writer = new Xlsx($spreadsheet);
        $writer->save('distribuidor.xlsx');
        header("Content-Type:   application/vnd.ms-excel");
        header("Content-Disposition:attachment; filename=distribuidor.xlsx");
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate");
        header("Content-Length: " . filesize("distribuidor.xlsx"));
        ob_clean();
        readfile("distribuidor.xlsx");
        exit;
    }

    public function imprimir()
    {
        // Configuración de Dompdf
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);

        // Obtener datos de distribuidores y talleres
        $model = new DistribuidoresModel();
        $data['distribuidoresConTalleres'] = $model->listaDistribuidoresConTalleres();

        // Renderizar la vista con los datos
        $html = view('printView', $data);

        // Generar el PDF
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');

        // Descargar o mostrar el PDF
        $dompdf->stream("distribuidores_talleres.pdf", ['Attachment' => false]);
    }
}
