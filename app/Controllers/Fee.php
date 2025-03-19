<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Fee extends ResourceController
{
    protected $modelName = 'App\Models\FeeModel'; 
    protected $format    = 'json';

    public function index()
    {
        $fees = $this->model->findAll();

        if (empty($fees)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'No fee records found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        $response = [
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Fee records retrieved successfully',
            'data'    => $fees,
            'errors'  => null,
        ];
        return $this->respond($response, 200);
    }

    public function view($id)
    {
        $fee = $this->model->find($id);

        if (empty($fee)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'Fee record not found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        $response = [
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Fee record retrieved successfully',
            'data'    => $fee,
            'errors'  => null,
        ];
        return $this->respond($response, 200);
    }

    public function create()
    {
        $rules = [
            'student_id'       => 'required',
            'fee_type'         => 'required',
            'amount_due'       => 'required|numeric',
            'amount_paid'      => 'required|numeric',
            'discount'         => 'permit_empty|numeric',
            'due_date'         => 'required',
            'late_fee'         => 'permit_empty|numeric',
            'payment_status'   => 'required',
            'payment_method'   => 'required',
            'receipt_number'   => 'permit_empty',
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

        $data = $this->request->getPost();

        if ($this->model->insert($data) === false) {
            $response = [
                'status'  => "Error",
                'code'    => 500,
                'message' => 'Failed to create fee record',
                'data'    => null,
                'errors'  => $this->model->errors(),
            ];
            return $this->respond($response, 500);
        }

        $response = [
            'status'  => "Success",
            'code'    => 201,
            'message' => 'Fee record created successfully',
            'data'    => $data,
            'errors'  => null,
        ];
        return $this->respond($response, 201);
    }

    public function delete($id = null)
    {
        $fee = $this->model->find($id);

        if (empty($fee)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'Fee record not found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        if ($this->model->delete($id)) {
            $response = [
                'status'  => "Success",
                'code'    => 200,
                'message' => 'Fee record deleted successfully',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 200);
        } else {
            $response = [
                'status'  => "Error",
                'code'    => 500,
                'message' => 'Failed to delete fee record',
                'data'    => null,
                'errors'  => $this->model->errors(),
            ];
            return $this->respond($response, 500);
        }
    }
}
