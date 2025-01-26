<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\DistribuidoresModel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use CodeIgniter\Files\File;

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


    public function crear()
    {

        $rules = [
            'razon_social' => [
                'rules' => 'is_unique[distribuidores.razon_social]|required_if_other_empty[distribuidores.nombre]|required_if_other_empty[distribuidores.apellido]',
                'errors' => [
                    'is_unique' => 'La razon social ya existe',
                    'required_if_other_empty' => 'La razón social es requerido si nombre y apellido esta vacia.',
                ]
            ],
            'nombre' => [
                'rules' => 'is_unique[distribuidores.nombre]|required_if_other_empty[distribuidores.razon_social]',
                'errors' => [
                    'is_unique' => 'El nombre ya existe',
                    'required_if_other_empty' => 'El Nombre es requerido si la razón social esta vacia.',
                ]
            ],
            'apellidos' => [
                'rules' => 'is_unique[distribuidores.apellidos]|required_if_other_empty[distribuidores.razon_social]',
                'errors' => [
                    'is_unique' => 'Los apellidos ya existe',
                    'required_if_other_empty' => 'El Apellido es requerido si la razón social esta vacia.',

                ]
            ],
            'cif_nif_nie' => [
                'rules' => 'required|is_unique[distribuidores.cif_nif_nie]',
                'errors' => [
                    'required' => 'Debes introducir una CIF, NIF o NIE',
                    'is_unique' => 'El CIF, NIF o NIE ya existe',
                ]
            ],

            'documento' => [
                'rules' => 'mime_in[documento,application/pdf]|ext_in[documento,pdf]',
                'errors' => [
                    'mime_in' => 'No pdf',
                    'ext_in' => 'No pdf',
                ],
            ]
        ];

        $datos = $this->request->getPost(array_keys($rules));

        if (!$this->validateData($datos, $rules)) {
            return redirect()->back()->withInput();
        }

        $model = new DistribuidoresModel();
        $razon_social = $this->request->getvar('razon_social');

        $nombre = $this->request->getvar('nombre');

        $apellidos = $this->request->getvar('apellidos');

        $cif_nif_nie = $this->request->getvar('cif_nif_nie');

        $newData = [
            'razon_social' => $razon_social,
            'nombre' => $nombre,
            'apellidos' => $apellidos,
            'cif_nif_nie' => $cif_nif_nie,
            'documento' => '',
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s")
        ];

        if ($model->save($newData)) {
            if ($this->request->getFile('documento') != "") {
                $uso_id = $model->getInsertID();

                $documento = $this->request->getFile('documento');
                $ext = $documento->guessExtension();

                $nameDocumentoFile = "Uso_" . $uso_id . "." . $ext;
                $documento->move(ROOTPATH . 'public/uploads', $nameDocumentoFile);

                $filepath = 'public/uploads/' . $nameDocumentoFile;

                $model->where('id', $uso_id)
                    ->set(['documento' => $filepath])
                    ->update();

                // $model->save($newData);


                return redirect()->to('/distribuidores');
            }
        }
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
        $model = new DistribuidoresModel(); // Ajusta el nombre del modelo según tu proyecto
        $data['distribuidoresConTalleres'] = $model->listaDistribuidoresConTalleres();

        // Renderizar la vista con los datos
        $html = view('printView', $data);

        // Generar el PDF
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape'); // Configurar tamaño y orientación del papel
        $dompdf->render();

        // Descargar o mostrar el PDF
        $dompdf->stream("distribuidores_talleres.pdf", ['Attachment' => false]);
    }
}
