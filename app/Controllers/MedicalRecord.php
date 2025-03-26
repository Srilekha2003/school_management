<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class MedicalRecord extends ResourceController
{
    protected $modelName = 'App\Models\MedicalRecordModel'; 
    protected $format    = 'json';

    public function index()
    {
        $records = $this->model->findAll();

        if (empty($records)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'No medical records found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        $response = [
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Medical records retrieved successfully',
            'data'    => $records,
            'errors'  => null,
        ];
        return $this->respond($response, 200);
    }

    public function view($id)
    {
        $record = $this->model->find($id);

        if (empty($record)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'Medical record not found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        $response = [
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Medical record retrieved successfully',
            'data'    => $record,
            'errors'  => null,
        ];
        return $this->respond($response, 200);
    }

    public function create()
    {
        $rules = [
            'medical_id'        => 'required',
            'student_id'        => 'required',
            'medical_issues'    => 'required',
            'guardian_notified' => 'required',
            'first_aid_given'   => 'required',
            'remarks'           => 'permit_empty',
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
            'medical_id'        => $this->request->getPost('medical_id'),
            'student_id'        => $this->request->getPost('student_id'),
            'medical_issues'    => $this->request->getPost('medical_issues'),
            'guardian_notified' => $this->request->getPost('guardian_notified'),
            'first_aid_given'   => $this->request->getPost('first_aid_given'),
            'remarks'           => $this->request->getPost('remarks'),
        ];
    
        if ($this->model->insert($data) === false) {
            $response = [
                'status'  => "Error",
                'code'    => 500,
                'message' => 'Failed to create medical record',
                'data'    => null,
                'errors'  => $this->model->errors(),
            ];
            return $this->respond($response, 500);
        }
    
        $response = [
            'status'  => "Success",
            'code'    => 201,
            'message' => 'Medical record created successfully',
            'data'    => $data,
            'errors'  => null,
        ];
        return $this->respond($response, 201);
    }

    public function delete($id = null)
    {
        $record = $this->model->find($id);

        if (empty($record)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'Medical record not found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        if ($this->model->delete($id)) {
            $response = [
                'status'  => "Success",
                'code'    => 200,
                'message' => 'Medical record deleted successfully',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 200);
        } else {
            $response = [
                'status'  => "Error",
                'code'    => 500,
                'message' => 'Failed to delete medical record',
                'data'    => null,
                'errors'  => $this->model->errors(),
            ];
            return $this->respond($response, 500);
        }
    }
}
