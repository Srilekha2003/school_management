<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Hostel extends ResourceController
{
    protected $modelName = 'App\Models\HostelModel'; 
    protected $format    = 'json';

    public function index()
    {
        $hostels = $this->model->findAll();

        if (empty($hostels)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'No hostels found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        $response = [
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Hostels retrieved successfully',
            'data'    => $hostels,
            'errors'  => null,
        ];
        return $this->respond($response, 200);
    }

    public function view($id)
    {
        $hostel = $this->model->find($id);

        if (empty($hostel)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'Hostel not found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        $response = [
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Hostel retrieved successfully',
            'data'    => $hostel,
            'errors'  => null,
        ];
        return $this->respond($response, 200);
    }

    public function create()
    {
        $rules = [
            'student_id'    => 'required',
            'hostel_id'     => 'required',
            'room_id'       => 'required',
            'admission_date'=> 'required|valid_date',
            'status'        => 'required',
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
            'student_id'    => $this->request->getPost('student_id'),
            'hostel_id'     => $this->request->getPost('hostel_id'),
            'room_id'       => $this->request->getPost('room_id'),
            'admission_date'=> $this->request->getPost('admission_date'),
            'status'        => $this->request->getPost('status'),
        ];
    
        if ($this->model->insert($data) === false) {
            $response = [
                'status'  => "Error",
                'code'    => 500,
                'message' => 'Failed to create hostel record',
                'data'    => null,
                'errors'  => $this->model->errors(),
            ];
            return $this->respond($response, 500);
        }
    
        $response = [
            'status'  => "Success",
            'code'    => 201,
            'message' => 'Hostel created successfully',
            'data'    => $data,
            'errors'  => null,
        ];
        return $this->respond($response, 201);
    }
}