<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Package;
use CodeIgniter\API\ResponseTrait;

class PackageController extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $package = new Package();
        $packages = $package->findAll();
        return $this->respond($packages);
    }

    public function show($id) {
        $package = new Package();
        $package = $package->find($id);
        return $this->respond($package);
    }

    public function create() {
        try {
            $package = new Package();
            
            $rules = [
                'name' => 'required',
                'description' => 'required',
                'price' => 'required|integer',
                'departure' => 'required',
                'destination' => 'required',
            ];

            if (!$this->validate($rules)) {
                return $this->respond([
                    'status' => 400,
                    'error' => $this->validator->getErrors(),
                ]);
            }

            $data = [
            'name' => $this->request->getVar('name'),
            'description' => $this->request->getVar('description'),
            'price' => $this->request->getVar('price'),
            'departure' => $this->request->getVar('departure'),
            'destination' => $this->request->getVar('destination'),
            ];

            $package->insert($data);
            return $this->respond([
                'status' => 201,
                'message' => 'Package created successfully',
            ]);
        }
        catch (\Exception $e) {
            return $this->respond([
                'status' => 500,
                'error' => $e->getMessage(),
            ]);
        }

    }
}
