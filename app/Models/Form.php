<?php

namespace app\Models;

use app\Config\Database;

class Form
{
    private $conn;
    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    /**
     * Create a new record in the database.
     *
     * @param array $data 
     * @return int|false 
     */
    public function create(array $data)
    {
        $sql = 'INSERT INTO fichas 
        (condutor, cpf, rg, telefone, endereco, cnh, selfie, placa, chassi, renavam, uf, marca, modelo, km, nivelCombustivel, fotoPlaca, fotoDianteira, fotoTraseira, fotoHodometro, fotoBancoDianteiro, dataCriacao) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';

        $stmt = $this->conn->prepare($sql);

        extract($data);

        $stmt->bind_param(
            'sssssssssssssdsssssss',
            $condutor,
            $cpf,
            $rg,
            $telefone,
            $endereco,
            $cnh,
            $selfie,
            $placa,
            $chassi,
            $renavam,
            $uf,
            $marca,
            $modelo,
            $km,
            $nivelCombustivel,
            $fotoPlaca,
            $fotoDianteira,
            $fotoTraseira,
            $fotoHodometro,
            $fotoBancoDianteiro,
            $dataCriacao
        );

        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            return $stmt->insert_id;
        } else {
            return false;
        }
    }

    public function update(int $id, array $data)
    {
        $sql = 'UPDATE fichas SET condutor = ?, cpf = ?, rg = ?, telefone = ?, 
        endereco = ?, cnh = ?, selfie = ?, placa = ?, chassi = ?, renavam = ?, uf = ?, marca = ?, modelo = ?, km = ?, nivelCombustivel = ?, 
        fotoPlaca = ?, fotoDianteira = ?, fotoTraseira = ?, fotoHodometro = ?, fotoBancoDianteiro = ? WHERE idFicha = ?';

        $stmt = $this->conn->prepare($sql);

        extract($data);

        $stmt->bind_param(
            'sssssssssssssdssssssi',
            $condutor,
            $cpf,
            $rg,
            $telefone,
            $endereco,
            $cnh,
            $selfie,
            $placa,
            $chassi,
            $renavam,
            $uf,
            $marca,
            $modelo,
            $km,
            $nivelCombustivel,
            $fotoPlaca,
            $fotoDianteira,
            $fotoTraseira,
            $fotoHodometro,
            $fotoBancoDianteiro,
            $id
        );

        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Retrieves all records from the "fichas" table.
     *
     * @return array Returns an array containing all the records from the "fichas" table.
     */
    public function getAll()
    {
        $sql = 'SELECT * FROM fichas';

        $stmt = $this->conn->prepare($sql);

        $stmt->execute();

        $result = $stmt->get_result();

        return ($result->num_rows > 0) ? $result->fetch_all(MYSQLI_ASSOC) : array();
    }

    /**
     * Get a record by its ID from the database.
     *
     * @param int $id The ID of the record to retrieve
     * @return array The record data if found, or an empty array
     */
    public function getById(int $id)
    {
        $sql = 'SELECT * FROM fichas WHERE idFicha = ?';

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param('i', $id);

        $stmt->execute();

        $result = $stmt->get_result();

        return ($result->num_rows > 0) ? $result->fetch_assoc() : array();
    }

    public function delete(int $id)
    {
        $sql = 'DELETE FROM fichas WHERE idFicha = ?';

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param('i', $id);

        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getImagePaths($id)
    {
        $sql = 'SELECT selfie, fotoPlaca, fotoDianteira, fotoTraseira, fotoHodometro, fotoBancoDianteiro FROM fichas WHERE idFicha = ?';

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param('i', $id);

        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $imagePaths = [];

            foreach ($row as $columnName => $path) {
                $imagePaths[] = $path;
            }

            return $imagePaths;
        } else {
            return array();
        }
    }


    public function getPlate($id)
    {
        $sql = 'SELECT placa FROM fichas WHERE idFicha = ?';

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param('i', $id);

        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return isset($row['placa']) ? $row['placa'] : '';
        } else {
            return '';
        }
    }
}
