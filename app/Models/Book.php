<?php

namespace App\Models;

use CodeIgniter\Model;

class Book extends Model
{
    protected $table            = 'books';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['userId','name','email', 'telephone', 'date', 'time', 'packageId', 'seat', 'ticket', 'total'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getOrderQuantityPerDestination($number)
    {

        $data = [];
        for ($i = 1; $i <= $number; $i++) {
            $count = 0;
            $query = $this->select('ticket')->where('packageId', $i)->findAll();
            foreach ($query as $row) {
                $count += $row['ticket'];
            }
            $data[] = $count;
        }
        return $data;
    }

    public function orderHistory($id) {
        $builder = $this->table('books');
        $builder->select('books.id, books.total, books.date, books.time, books.seat, books.ticket, packages.destination, packages.departure');
        $builder->join('packages', 'packages.id = books.packageId');
        $builder->where('userId', $id);
        $query = $builder->get()->getResultArray();
        return $query;
    }

    public function getBookTable() {
        $builder = $this->table('books');
        $builder->select('books.id, books.email, books.date, books.time, packages.destination, packages.departure, books.ticket, books.total');
        $builder->join('packages', 'packages.id = books.packageId');
        $query = $builder->get()->getResultArray();
        return $query;
    }
}
