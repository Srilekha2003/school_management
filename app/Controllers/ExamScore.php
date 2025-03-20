<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class ExamScore extends ResourceController
{
    protected $modelName = 'App\Models\ExamScoreModel'; 
    protected $format    = 'json';

    public function index()
    {
        $examScores = $this->model->findAll();

        if (empty($examScores)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'No exam scores found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        $response = [
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Exam scores retrieved successfully',
            'data'    => $examScores,
            'errors'  => null,
        ];
        return $this->respond($response, 200);
    }

    public function view($id)
    {
        $examScore = $this->model->find($id);

        if (empty($examScore)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'Exam score not found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        $response = [
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Exam score retrieved successfully',
            'data'    => $examScore,
            'errors'  => null,
        ];
        return $this->respond($response, 200);
    }

    public function create()
    {
        $rules = [
            'exam_id'         => 'required',
            'student_id'      => 'required',
            'marks_obtained'  => 'required|numeric',
            'total_marks'     => 'required|numeric',
            'percentage'      => 'required|numeric',
            'grade'           => 'required',
            'result_status'   => 'required',
            'remarks'         => 'permit_empty',
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
            'exam_id'        => $this->request->getPost('exam_id'),
            'student_id'     => $this->request->getPost('student_id'),
            'marks_obtained' => $this->request->getPost('marks_obtained'),
            'total_marks'    => $this->request->getPost('total_marks'),
            'percentage'     => $this->request->getPost('percentage'),
            'grade'          => $this->request->getPost('grade'),
            'result_status'  => $this->request->getPost('result_status'),
            'remarks'        => $this->request->getPost('remarks'),
        ];
    
        if ($this->model->insert($data) === false) {
            $response = [
                'status'  => "Error",
                'code'    => 500,
                'message' => 'Failed to create exam score record',
                'data'    => null,
                'errors'  => $this->model->errors(),
            ];
            return $this->respond($response, 500);
        }
    
        $response = [
            'status'  => "Success",
            'code'    => 201,
            'message' => 'Exam score created successfully',
            'data'    => $data,
            'errors'  => null,
        ];
        return $this->respond($response, 201);
    }

    public function edit($id = null)
    {
        $examScore = $this->model->find($id);

        if (empty($examScore)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'Exam score not found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        $response = [
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Exam score data retrieved for editing',
            'data'    => $examScore,
            'errors'  => null,
        ];
        return $this->respond($response, 200);
    }

    public function update($id = null)
    {
        $examScore = $this->model->find($id);

        if (empty($examScore)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'Exam score not found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        $rules = [
            'exam_id'         => 'required',
            'student_id'      => 'required',
            'marks_obtained'  => 'required|numeric',
            'total_marks'     => 'required|numeric',
            'percentage'      => 'required|numeric',
            'grade'           => 'required',
            'result_status'   => 'required',
            'remarks'         => 'permit_empty',
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
            'exam_id'        => $this->request->getPost('exam_id'),
            'student_id'     => $this->request->getPost('student_id'),
            'marks_obtained' => $this->request->getPost('marks_obtained'),
            'total_marks'    => $this->request->getPost('total_marks'),
            'percentage'     => $this->request->getPost('percentage'),
            'grade'          => $this->request->getPost('grade'),
            'result_status'  => $this->request->getPost('result_status'),
            'remarks'        => $this->request->getPost('remarks'),
        ];

        if ($this->model->update($id, $data) === false) {
            $response = [
                'status'  => "Error",
                'code'    => 500,
                'message' => 'Failed to update exam score',
                'data'    => null,
                'errors'  => $this->model->errors(),
            ];
            return $this->respond($response, 500);
        }

        $response = [
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Exam score updated successfully',
            'data'    => $data,
            'errors'  => null,
        ];
        return $this->respond($response, 200);
    }

    public function delete($id = null)
    {
        $examScore = $this->model->find($id);

        if (empty($examScore)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'Exam score not found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        if ($this->model->delete($id)) {
            $response = [
                'status'  => "Success",
                'code'    => 200,
                'message' => 'Exam score deleted successfully',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 200);
        } else {
            $response = [
                'status'  => "Error",
                'code'    => 500,
                'message' => 'Failed to delete exam score',
                'data'    => null,
                'errors'  => $this->model->errors(),
            ];
            return $this->respond($response, 500);
        }
    }
}
