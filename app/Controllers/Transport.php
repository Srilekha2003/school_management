<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Transport extends ResourceController
{
    protected $modelName = 'App\Models\TransportModel'; 
    protected $format    = 'json';

    public function index()
    {
        $transports = $this->model->findAll();

        if (empty($transports)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'No transport records found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        $response = [
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Transport records retrieved successfully',
            'data'    => $transports,
            'errors'  => null,
        ];
        return $this->respond($response, 200);
    }

    public function view($id)
    {
        $transport = $this->model->find($id);

        if (empty($transport)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'Transport record not found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        $response = [
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Transport record retrieved successfully',
            'data'    => $transport,
            'errors'  => null,
        ];
        return $this->respond($response, 200);
    }

    public function create()
    {
        $rules = [
            'student_id'      => 'required',
            'route_id'        => 'required',
            'bus_id'          => 'required',
            'driver_id'       => 'required',
            'pickup_location' => 'required',
            'drop_location'   => 'required',
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
            'student_id'      => $this->request->getPost('student_id'),
            'route_id'        => $this->request->getPost('route_id'),
            'bus_id'          => $this->request->getPost('bus_id'),
            'driver_id'       => $this->request->getPost('driver_id'),
            'pickup_location' => $this->request->getPost('pickup_location'),
            'drop_location'   => $this->request->getPost('drop_location'),
        ];
    
        if ($this->model->insert($data) === false) {
            $response = [
                'status'  => "Error",
                'code'    => 500,
                'message' => 'Failed to create transport record',
                'data'    => null,
                'errors'  => $this->model->errors(),
            ];
            return $this->respond($response, 500);
        }
    
        $response = [
            'status'  => "Success",
            'code'    => 201,
            'message' => 'Transport record created successfully',
            'data'    => $data,
            'errors'  => null,
        ];
        return $this->respond($response, 201);
    }
    
    public function edit($id = null)
    {
        $transport = $this->model->find($id);

        if (empty($transport)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'Transport record not found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        $response = [
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Transport record retrieved for editing',
            'data'    => $transport,
            'errors'  => null,
        ];
        return $this->respond($response, 200);
    }

    public function update($id = null)
    {
        $transport = $this->model->find($id);

        if (empty($transport)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'Transport record not found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        $rules = [
            'student_id'      => 'required',
            'route_id'        => 'required',
            'bus_id'          => 'required',
            'driver_id'       => 'required',
            'pickup_location' => 'required',
            'drop_location'   => 'required',
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
            'student_id'      => $this->request->getPost('student_id'),
            'route_id'        => $this->request->getPost('route_id'),
            'bus_id'          => $this->request->getPost('bus_id'),
            'driver_id'       => $this->request->getPost('driver_id'),
            'pickup_location' => $this->request->getPost('pickup_location'),
            'drop_location'   => $this->request->getPost('drop_location'),
        ];

        if ($this->model->update($id, $data) === false) {
            $response = [
                'status'  => "Error",
                'code'    => 500,
                'message' => 'Failed to update transport record',
                'data'    => null,
                'errors'  => $this->model->errors(),
            ];
            return $this->respond($response, 500);
        }

        $response = [
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Transport record updated successfully',
            'data'    => $data,
            'errors'  => null,
        ];
        return $this->respond($response, 200);
    }

    public function delete($id = null)
    {
        $transport = $this->model->find($id);

        if (empty($transport)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'Transport record not found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        if ($this->model->delete($id)) {
            $response = [
                'status'  => "Success",
                'code'    => 200,
                'message' => 'Transport record deleted successfully',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 200);
        } else {
            $response = [
                'status'  => "Error",
                'code'    => 500,
                'message' => 'Failed to delete transport record',
                'data'    => null,
                'errors'  => $this->model->errors(),
            ];
            return $this->respond($response, 500);
        }
    }
}
