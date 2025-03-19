<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Driver extends ResourceController
{
    protected $modelName = 'App\Models\DriverModel'; 
    protected $format    = 'json';

    public function index()
    {
        $drivers = $this->model->findAll();

        if (empty($drivers)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'No drivers found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        $response = [
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Drivers retrieved successfully',
            'data'    => $drivers,
            'errors'  => null,
        ];
        return $this->respond($response, 200);
    }

    public function view($id)
    {
        $driver = $this->model->find($id);

        if (empty($driver)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'Driver not found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        $response = [
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Driver retrieved successfully',
            'data'    => $driver,
            'errors'  => null,
        ];
        return $this->respond($response, 200);
    }

    public function create()
    {
        $rules = [
            'driver_name'     => 'required',
            'driver_contact'  => 'required',
            'license_number'  => 'required|is_unique[drivers.license_number]'
        ];
    
        if (!$this->validate($rules)) {
            $response = [
                'status'  => "Error",
                'code'    => 422,
                'message' => 'Validation errors',
                'data'    => null,
                'errors'  => $this->validator->getErrors(),
            ];
            return $this->respond($response, 422);
        }
    
        $data = [
            'driver_name'    => $this->request->getPost('driver_name'),
            'driver_contact' => $this->request->getPost('driver_contact'),
            'license_number' => $this->request->getPost('license_number'),
        ];
    
        if ($this->model->insert($data) === false) {
            $response = [
                'status'  => "Error",
                'code'    => 500,
                'message' => 'Failed to create driver record',
                'data'    => null,
                'errors'  => $this->model->errors(),
            ];
            return $this->respond($response, 500);
        }
    
        $response = [
            'status'  => "Success",
            'code'    => 201,
            'message' => 'Driver created successfully',
            'data'    => $data,
            'errors'  => null,
        ];
        return $this->respond($response, 201);
    }

    public function delete($id = null)
    {
        $driver = $this->model->find($id);

        if (empty($driver)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'Driver not found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        if ($this->model->delete($id)) {
            $response = [
                'status'  => "Success",
                'code'    => 200,
                'message' => 'Driver deleted successfully',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 200);
        } else {
            $response = [
                'status'  => "Error",
                'code'    => 500,
                'message' => 'Failed to delete driver',
                'data'    => null,
                'errors'  => $this->model->errors(),
            ];
            return $this->respond($response, 500);
        }
    }
}