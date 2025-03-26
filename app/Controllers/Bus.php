<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Bus extends ResourceController
{
    protected $modelName = 'App\Models\BusModel'; 
    protected $format    = 'json';

    public function index()
    {
        $buses = $this->model->findAll();

        if (empty($buses)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'No buses found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        $response = [
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Buses retrieved successfully',
            'data'    => $buses,
            'errors'  => null,
        ];
        return $this->respond($response, 200);
    }

    public function view($id)
    {
        $bus = $this->model->find($id);

        if (empty($bus)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'Bus not found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        $response = [
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Bus retrieved successfully',
            'data'    => $bus,
            'errors'  => null,
        ];
        return $this->respond($response, 200);
    }

    public function create()
    {
        $rules = [
            'bus_number' => 'required',
            'capacity'   => 'required|integer',
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
            'bus_number' => $this->request->getPost('bus_number'),
            'capacity'   => $this->request->getPost('capacity'),
        ];
    
        if ($this->model->insert($data) === false) {
            $response = [
                'status'  => "Error",
                'code'    => 500,
                'message' => 'Failed to create bus record',
                'data'    => null,
                'errors'  => $this->model->errors(),
            ];
            return $this->respond($response, 500);
        }
    
        $response = [
            'status'  => "Success",
            'code'    => 201,
            'message' => 'Bus created successfully',
            'data'    => $data,
            'errors'  => null,
        ];
        return $this->respond($response, 201);
    }
    
    public function edit($id = null)
    {
       
        $bus = $this->model->find($id);
    
        if (empty($bus)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'Bus not found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404); 
        }
    
        $response = [
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Bus data retrieved for editing',
            'data'    => $bus,
            'errors'  => null,
        ];
        return $this->respond($response, 200); 
    }

    public function update($id = null)
    {
        $bus = $this->model->find($id);
    
        if (empty($bus)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'Bus not found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }
    
        $rules = [
            'bus_number' => 'required',
            'capacity'   => 'required|integer',
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
            'bus_number' => $this->request->getPost('bus_number'),
            'capacity'   => $this->request->getPost('capacity'),
        ];
    
        if ($this->model->update($id, $data) === false) {
            $response = [
                'status'  => "Error",
                'code'    => 500,
                'message' => 'Failed to update bus',
                'data'    => null,
                'errors'  => $this->model->errors(),
            ];
            return $this->respond($response, 500);
        }
    
        $response = [
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Bus updated successfully',
            'data'    => $data,
            'errors'  => null,
        ];
        return $this->respond($response, 200);
    }

    public function delete($id = null)
    {
        $bus = $this->model->find($id);

        if (empty($bus)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'Bus not found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        if ($this->model->delete($id)) {
            $response = [
                'status'  => "Success",
                'code'    => 200,
                'message' => 'Bus deleted successfully',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 200);
        } else {
            $response = [
                'status'  => "Error",
                'code'    => 500,
                'message' => 'Failed to delete bus',
                'data'    => null,
                'errors'  => $this->model->errors(),
            ];
            return $this->respond($response, 500);
        }
    }
}