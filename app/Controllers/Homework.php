<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Homework extends ResourceController
{
    protected $modelName = 'App\Models\HomeworkModel'; 
    protected $format    = 'json';

    public function index()
    {
        $homeworks = $this->model->findAll();

        if (empty($homeworks)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'No homework records found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        $response = [
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Homework records retrieved successfully',
            'data'    => $homeworks,
            'errors'  => null,
        ];
        return $this->respond($response, 200);
    }

    public function view($id)
    {
        $homework = $this->model->find($id);

        if (empty($homework)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'Homework record not found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        $response = [
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Homework record retrieved successfully',
            'data'    => $homework,
            'errors'  => null,
        ];
        return $this->respond($response, 200);
    }

    public function create()
    {
        $rules = [
            'subject_id'        => 'required',
            'class_id'          => 'required',
            'assigned_by'       => 'required',
            'assigned_date'     => 'required',
            'due_date'          => 'required',
            'submission_status' => 'required',
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
            'subject_id'        => $this->request->getPost('subject_id'),
            'class_id'          => $this->request->getPost('class_id'),
            'assigned_by'       => $this->request->getPost('assigned_by'),
            'assigned_date'     => $this->request->getPost('assigned_date'),
            'due_date'          => $this->request->getPost('due_date'),
            'submission_status' => $this->request->getPost('submission_status'),
            'remarks'           => $this->request->getPost('remarks'),
        ];
    
        if ($this->model->insert($data) === false) {
            $response = [
                'status'  => "Error",
                'code'    => 500,
                'message' => 'Failed to create homework record',
                'data'    => null,
                'errors'  => $this->model->errors(),
            ];
            return $this->respond($response, 500);
        }
    
        $response = [
            'status'  => "Success",
            'code'    => 201,
            'message' => 'Homework record created successfully',
            'data'    => $data,
            'errors'  => null,
        ];
        return $this->respond($response, 201);
    }

    public function delete($id = null)
    {
        $homework = $this->model->find($id);

        if (empty($homework)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'Homework record not found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        if ($this->model->delete($id)) {
            $response = [
                'status'  => "Success",
                'code'    => 200,
                'message' => 'Homework record deleted successfully',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 200);
        } else {
            $response = [
                'status'  => "Error",
                'code'    => 500,
                'message' => 'Failed to delete homework record',
                'data'    => null,
                'errors'  => $this->model->errors(),
            ];
            return $this->respond($response, 500);
        }
    }
}
