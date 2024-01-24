<?php

namespace app\Controllers;

use app\Models\Form;

class FormController
{
    private $model;

    public function __construct()
    {
        $this->model = new Form();
    }

    public function getAllJson()
    {
        $data = $this->model->getAll();

        $formatedItems = [];

        if (!empty($data)) {
            foreach ($data as $item) {
                $formatedItens[] = [
                    'id' => $item['idFicha'],
                    'condutor' => $item['condutor'],
                    'cpf' => $item['cpf'],
                    'veiculo' => $item['marca'] . ' - ' . $item['modelo'],
                    'placa' => $item['placa'],
                    'data' => date("d/m/Y", strtotime($item['dataCriacao'])),
                ];
            }
        } else {
            $formatedItens = [
                'id' => '',
                'condutor' => '',
                'cpf' => '',
                'veiculo' => '',
                'placa' => '',
                'data' => '',
            ];
        }


        header('Content-Type: application/json');
        echo json_encode(['data' => $formatedItens]);
    }

    public function index()
    {
        return Controller::view('home');
    }

    public function newForm()
    {
        return Controller::view('main_form');
    }

    public function editForm(int $id)
    {
        $data = $this->model->getById($id);

        return Controller::view('main_form', [
            'data' => $data,
            'edit' => true
        ]);
    }

    /**
     * Creates a new record with the submitted data and handles file uploads.
     *
     * Does not take any parameters.
     * 
     * Throws no exceptions.
     * 
     * Returns nothing.
     */
    public function create()
    {
        $errorMessages = [];

        $requiredFields = [
            'nome',
            'cpf',
            'rg',
            'tel',
            'end',
            'cnh',
            'placa',
            'chassi',
            'renavam',
            'uf',
            'marca',
            'modelo',
            'km',
            'combustivel',
        ];

        foreach ($requiredFields as $field) {
            if (empty($_POST[$field])) {
                $errorMessages[] = "O campo {$field} é obrigatório.";
            }
        }

        foreach ($_FILES as $fileField) {
            if ($fileField['error'] != UPLOAD_ERR_OK) {
                $errorMessages[] = "Erro no upload do arquivo {$fileField['name']}. Código de erro: {$fileField['error']}.";
            }
        }

        if (!empty($errorMessages)) {
            return Controller::view('main_form', [
                'data' => $_POST,
                'errorMessage' => 'Todos os campos precisam ser preenchidos.',
            ]);
        } else {
            $selfieUrl = $this->uploadImg('selfie', preg_replace("/[^A-Za-z0-9]/", "", $_POST['placa']));
            $plateUrl = $this->uploadImg('fotoPlaca', preg_replace("/[^A-Za-z0-9]/", "", $_POST['placa']));
            $frontUrl = $this->uploadImg('dianteira', preg_replace("/[^A-Za-z0-9]/", "", $_POST['placa']));
            $backUrl = $this->uploadImg('traseira', preg_replace("/[^A-Za-z0-9]/", "", $_POST['placa']));
            $hoodUrl = $this->uploadImg('hodometro', preg_replace("/[^A-Za-z0-9]/", "", $_POST['placa']));
            $seatUrl = $this->uploadImg('banco', preg_replace("/[^A-Za-z0-9]/", "", $_POST['placa']));

            $data = [
                'condutor' => $_POST['nome'],
                'cpf' => preg_replace("/[^0-9]/", "", $_POST['cpf']),
                'rg' => strtoupper(preg_replace("/[^A-Za-z0-9]/", "", $_POST['rg'])),
                'telefone' => preg_replace("/[^0-9]/", "", $_POST['tel']),
                'endereco' => $_POST['end'],
                'cnh' => preg_replace("/[^0-9]/", "", $_POST['cnh']),
                'selfie' => $selfieUrl,
                'placa' => preg_replace("/[^A-Za-z0-9]/", "", $_POST['placa']),
                'chassi' => strtoupper(preg_replace("/[^A-Za-z0-9]/", "", $_POST['chassi'])),
                'renavam' => strtoupper(preg_replace("/[^A-Za-z0-9]/", "", $_POST['renavam'])),
                'uf' => $_POST['uf'],
                'marca' => $_POST['marca'],
                'modelo' => $_POST['modelo'],
                'km' => $_POST['km'],
                'nivelCombustivel' => $_POST['combustivel'],
                'fotoPlaca' => $plateUrl,
                'fotoDianteira' => $frontUrl,
                'fotoTraseira' => $backUrl,
                'fotoHodometro' => $hoodUrl,
                'fotoBancoDianteiro' => $seatUrl,
                'dataCriacao' => date("Y-m-d H:i:s"),
            ];

            $insertedId = $this->model->create($data);

            if ($insertedId) {
                header("Location: imprimir/$insertedId");
                exit();
            }
        }
    }

    /**
     * Updates a record in the database based on the given ID.
     *
     * @param int $id The ID of the record to be updated
     */
    public function update(int $id)
    {
        $oldData = $this->model->getById($id);
        $errorMessages = [];

        $requiredFields = [
            'nome',
            'cpf',
            'rg',
            'tel',
            'end',
            'cnh',
            'placa',
            'chassi',
            'renavam',
            'uf',
            'marca',
            'modelo',
            'km',
            'combustivel',
        ];

        foreach ($requiredFields as $field) {
            if (empty($_POST[$field])) {
                $errorMessages[] = "O campo {$field} é obrigatório.";
            }
        }

        if (!empty($errorMessages)) {
            return Controller::view('main_form', [
                'data' => $_POST,
                'errorMessage' => 'Todos os campos precisam ser preenchidos.',
            ]);
        } else {

            if ($_FILES) {
                $selfieUrl = $_FILES['selfie']['name'] != "" ? $this->uploadImg('selfie', $_POST['placa']) : $oldData['selfie'];
                $plateUrl = $_FILES['fotoPlaca']['name'] != "" ? $this->uploadImg('fotoPlaca', $_POST['placa']) : $oldData['fotoPlaca'];
                $frontUrl = $_FILES['dianteira']['name'] != "" ? $this->uploadImg('dianteira', $_POST['placa']) : $oldData['fotoDianteira'];
                $backUrl = $_FILES['traseira']['name'] != "" ? $this->uploadImg('traseira', $_POST['placa']) : $oldData['fotoTraseira'];
                $hoodUrl = $_FILES['hodometro']['name'] != "" ? $this->uploadImg('hodometro', $_POST['placa']) : $oldData['fotoHodometro'];
                $seatUrl = $_FILES['banco']['name'] != "" ? $this->uploadImg('banco', $_POST['placa']) : $oldData['fotoBancoDianteiro'];
            }

            $data = [
                'condutor' => $_POST['nome'],
                'cpf' => preg_replace("/[^0-9]/", "", $_POST['cpf']),
                'rg' => strtoupper(preg_replace("/[^A-Za-z0-9]/", "", $_POST['rg'])),
                'telefone' => preg_replace("/[^0-9]/", "", $_POST['tel']),
                'endereco' => $_POST['end'],
                'cnh' => preg_replace("/[^0-9]/", "", $_POST['cnh']),
                'selfie' => $selfieUrl,
                'placa' => preg_replace("/[^A-Za-z0-9]/", "", $_POST['placa']),
                'chassi' => strtoupper(preg_replace("/[^A-Za-z0-9]/", "", $_POST['chassi'])),
                'renavam' => strtoupper(preg_replace("/[^A-Za-z0-9]/", "", $_POST['renavam'])),
                'uf' => $_POST['uf'],
                'marca' => $_POST['marca'],
                'modelo' => $_POST['modelo'],
                'km' => $_POST['km'],
                'nivelCombustivel' => $_POST['combustivel'],
                'fotoPlaca' => $plateUrl,
                'fotoDianteira' => $frontUrl,
                'fotoTraseira' => $backUrl,
                'fotoHodometro' => $hoodUrl,
                'fotoBancoDianteiro' => $seatUrl,
            ];

            $updated = $this->model->update($id, $data);

            if ($updated) {
                $redirectUrl = BASE_URL . '/imprimir/' . $id;

                header("Location: $redirectUrl");
                exit();
            }
        }
    }

    /**
     * Show a specific item by its ID.
     *
     * @param int $id The ID of the item to show
     * @return View The view for displaying the item
     */
    public function show(int $id)
    {
        $data = $this->model->getById($id);

        return Controller::view('ficha', ['data' => $data]);
    }

    public function delete($id)
    {
        try {
            $imagePaths = $this->model->getImagePaths($id);
            $plate = $this->model->getPlate($id);

            $deleted = $this->model->delete($id);

            if ($deleted) {
                foreach ($imagePaths as $imagePath) {
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }

                $imageDirectory = "assets/img/fichas/{$plate}/";
                if (is_dir($imageDirectory)) {
                    $files = glob("$imageDirectory/*");
                    foreach ($files as $file) {
                        unlink($file);
                    }
                    rmdir($imageDirectory);
                }

                header('Content-Type: application/json');
                echo json_encode(['message' => 'Registro excluído com sucesso']);
                exit();
            } else {
                throw new Exception('Erro ao excluir o registro');
            }
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode(['error' => $e->getMessage()]);
            exit();
        }
    }


    /**
     * A description of the entire PHP function.
     *
     * @param int $id 
     * @return View The view for displaying the item
     */
    public function print(int $id)
    {
        $data = $this->model->getById($id);

        return Controller::view('print_form', ['data' => $data]);
    }

    /**
     * Uploads an image file and returns the file path.
     *
     * @param string $inputName The name of the input field.
     * @param string $plate The plate for the image file.
     * @throws Exception File type not supported or upload failed.
     * @return string The file path on successful upload.
     */
    function uploadImg($inputName, $plate)
    {
        try {
            $basePath = 'assets/img/fichas/';
            $finalPath = $basePath . $plate . '/';

            if (!is_dir($finalPath)) {
                mkdir($finalPath, 0777, true);
            }

            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'jfif'];
            $extension = strtolower(pathinfo($_FILES[$inputName]['name'], PATHINFO_EXTENSION));

            if (!in_array($extension, $allowedExtensions)) {
                throw new \Exception('File type not supported');
            }

            $newName = $plate . '_' . $inputName . '.' . $extension;

            if (move_uploaded_file($_FILES[$inputName]['tmp_name'], $finalPath . $newName)) {
                return "/" .  $finalPath . $newName;
            } else {
                throw new \Exception('Upload failed');
                return false;
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
