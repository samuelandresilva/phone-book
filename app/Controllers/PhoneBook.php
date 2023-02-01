<?php

namespace App\Controllers;

use App\Libraries\ServerSide;
use CodeIgniter\Database\BaseConnection;
use Config\Database;

class PhoneBook extends BaseController {
    private BaseConnection $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function index() {
        return view('phone_book');
    }

    public function getPeoples() {
        try {
            $table = "SELECT P.id, P.name, P.nickname, GROUP_CONCAT(REPLACE(C.number, ' ', '')) AS contacts FROM peoples P LEFT JOIN contacts C ON P.id=C.people_id GROUP BY P.id";
            $table = "(" . $table . ") temp";

            $primaryKey = 'id';

            $columns = array(
                array('db' => 'id', 'dt' => 0),
                array('db' => 'name',  'dt' => 1),
                array('db' => 'nickname',   'dt' => 2),
                array('db' => 'contacts',   'dt' => 3),
            );

            $sql_details = array(
                'user' => getenv('database.default.username'),
                'pass' => getenv('database.default.password'),
                'db'   => getenv('database.default.database'),
                'host' => getenv('database.default.hostname') . ':' . 
                          getenv('database.default.port')
            );

            echo json_encode(
                ServerSide::simple($_GET, $sql_details, $table, $primaryKey, $columns)
            );
        } catch (\Throwable $th) {
            return $this->response->setStatusCode(500, $th->getMessage());
        }
    }

    public function contacts($people_id) {
        $results = $this->db->table('contacts')
            ->where('people_id', $people_id)
            ->get();

        return $this->response->setJSON(json_encode($results->getResultArray()));
    }

    public function saveContact() {
        try {
            $people_id = $this->request->getVar('people_id');
            $number = $this->request->getVar('number');
            $descr = $this->request->getVar('descr');

            $data = [
                'people_id' => $people_id,
                'number'    => $number,
                'descr'     => $descr,
                'active'    => 1
            ];

            $this->db->table('contacts')->insert($data);

            return $this->response->setStatusCode(200, 'Contato salvo com sucesso');
        } catch (\Throwable $th) {
            return $this->response->setStatusCode(500, $th->getMessage());
        }
    }

    public function deleteContact($id) {
        try {
            $builder = $this->db->table('contacts');
            $builder->delete(['id' => $id]);

            return $this->response->setStatusCode(200, 'Contato excluido com sucesso');
        } catch (\Throwable $th) {
            return $this->response->setStatusCode(500, $th->getMessage());
        }
    }

    public function peoples($id) {
        try {
            $result = $this->db->table('peoples')
                ->where('id', $id)
                ->get();

            return $this->response->setJSON(json_encode($result->getResultArray()));
        } catch (\Throwable $th) {
            return $this->response->setStatusCode(500, $th->getMessage());
        }
    }

    public function savePeople() {
        try {
            $id = $this->request->getVar('id');
            $type = $this->request->getVar('type');
            $name = $this->request->getVar('name');
            $nickname = $this->request->getVar('nickname');
            $inscnum = $this->request->getVar('inscnum');
            $obs = $this->request->getVar('obs');

            $data = [
                'id'        => $id,
                'type'      => $type,
                'name'      => $name,
                'nickname'  => $nickname,
                'inscnum'   => $inscnum,
                'obs'       => $obs,
                'unit'      => session()->get('unit'),
            ];


            if ($id != null && trim($id) != '') {
                $this->db->table('peoples')->where('id', $id)->update($data);
            } else {
                $this->db->table('peoples')->insert($data);
                $id = $this->db->insertID();
            }

            echo $id;

            return $this->response->setStatusCode(200, 'Contato salvo com sucesso');
        } catch (\Throwable $th) {
            return $this->response->setStatusCode(500, $th->getMessage());
        }
    }

    public function deletePeople($id) {
        try {
            $this->db->table('peoples')
                ->where('id', $id)
                ->delete();

            return $this->response->setStatusCode(200, 'Contato excluido com sucesso');
        } catch (\Throwable $th) {
            return $this->response->setStatusCode(500, $th->getMessage());
        }
    }
}
