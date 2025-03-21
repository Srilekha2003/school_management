<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class ProgressCard extends ResourceController
{
    protected $modelName = 'App\Models\ProgressCardModel'; 
    protected $format    = 'json';

    public function index()
    {
        $progressCards = $this->model->findAll();

        if (empty($progressCards)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'No progress cards found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        $response = [
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Progress cards retrieved successfully',
            'data'    => $progressCards,
            'errors'  => null,
        ];
        return $this->respond($response, 200);
    }

    public function view($id)
    {
        $progressCard = $this->model->find($id);

        if (empty($progressCard)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'Progress card not found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        $response = [
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Progress card retrieved successfully',
            'data'    => $progressCard,
            'errors'  => null,
        ];
        return $this->respond($response, 200);
    }

    public function create()
    {
        $rules = [
            'student_id'          => 'required',
            'exam_id'             => 'required',
            'total_marks'         => 'required|numeric',
            'obtained_marks'      => 'required|numeric',
            'percentage'          => 'required|numeric',
            'rank'                => 'permit_empty|numeric',
            'grade'               => 'required',
            'result_status'       => 'required',
            'overall_remarks'     => 'permit_empty',
            'teacher_signature'   => 'required',
            'principal_signature' => 'required',
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
                'message' => 'Failed to create progress card',
                'data'    => null,
                'errors'  => $this->model->errors(),
            ];
            return $this->respond($response, 500);
        }

        $response = [
            'status'  => "Success",
            'code'    => 201,
            'message' => 'Progress card created successfully',
            'data'    => $data,
            'errors'  => null,
        ];
        return $this->respond($response, 201);
    }

    public function edit($id = null)
    {
        $progressCard = $this->model->find($id);

        if (empty($progressCard)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'Progress card not found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        $response = [
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Progress card data retrieved for editing',
            'data'    => $progressCard,
            'errors'  => null,
        ];
        return $this->respond($response, 200);
    }

    public function update($id = null)
    {
        $progressCard = $this->model->find($id);

        if (empty($progressCard)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'Progress card not found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        $rules = [
            'student_id'          => 'required',
            'exam_id'             => 'required',
            'total_marks'         => 'required|numeric',
            'obtained_marks'      => 'required|numeric',
            'percentage'          => 'required|numeric',
            'rank'                => 'permit_empty|numeric',
            'grade'               => 'required',
            'result_status'       => 'required',
            'overall_remarks'     => 'permit_empty',
            'teacher_signature'   => 'required',
            'principal_signature' => 'required',
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

        if ($this->model->update($id, $data) === false) {
            $response = [
                'status'  => "Error",
                'code'    => 500,
                'message' => 'Failed to update progress card',
                'data'    => null,
                'errors'  => $this->model->errors(),
            ];
            return $this->respond($response, 500);
        }

        $response = [
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Progress card updated successfully',
            'data'    => $data,
            'errors'  => null,
        ];
        return $this->respond($response, 200);
    }

    public function delete($id = null)
    {
        $progressCard = $this->model->find($id);

        if (empty($progressCard)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'Progress card not found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        if ($this->model->delete($id)) {
            $response = [
                'status'  => "Success",
                'code'    => 200,
                'message' => 'Progress card deleted successfully',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 200);
        } else {
            $response = [
                'status'  => "Error",
                'code'    => 500,
                'message' => 'Failed to delete progress card',
                'data'    => null,
                'errors'  => $this->model->errors(),
            ];
            return $this->respond($response, 500);
        }
    }
}
