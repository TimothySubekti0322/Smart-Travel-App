<?php

namespace App\Models;

use CodeIgniter\Model;

class Package extends Model
{
    protected $table            = 'packages';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'description', 'price', 'departure', 'destination'];

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

    public function checkPackageIdExistence($packageId)
    {
        // Query to check if the ID exists in the package table
        $package = $this->find($packageId);

        // If package is found, return true; otherwise, return false
        return ($package !== null);
    }

    public function getAllDestination()
    {
        // Query to get all destinations
        $destinations = $this->select('destination')->findAll();

        // If no destinations found, return an empty array
        if (empty($destinations)) {
            return [];
        }

        // Collect all destinations into an array
        $allDestinations = [];
        foreach ($destinations as $destination) {
            $allDestinations[] = $destination['destination'];
        }

        return $allDestinations;
    }
}
