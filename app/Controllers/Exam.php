<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Exam extends ResourceController
{
    protected $modelName = 'App\Models\ExamModel'; 
    protected $format    = 'json';

    public function index()
    {
        $exams = $this->model->findAll();

        if (empty($exams)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'No exams found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        $response = [
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Exams retrieved successfully',
            'data'    => $exams,
            'errors'  => null,
        ];
        return $this->respond($response, 200);
    }

    public function view($id)
    {
        $exam = $this->model->find($id);

        if (empty($exam)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'Exam not found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        $response = [
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Exam retrieved successfully',
            'data'    => $exam,
            'errors'  => null,
        ];
        return $this->respond($response, 200);
    }

    public function create()
    {
        $rules = [
            'exam_name'      => 'required',
            'exam_date'      => 'required',
            'start_time'     => 'required',
            'end_time'       => 'required',
            'total_marks'    => 'required|numeric',
            'passing_marks'  => 'required|numeric',
            'subject_id'     => 'required|integer',
            'class_id'       => 'required|integer',
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
            'exam_name'      => $this->request->getPost('exam_name'),
            'exam_date'      => $this->request->getPost('exam_date'),
            'start_time'     => $this->request->getPost('start_time'),
            'end_time'       => $this->request->getPost('end_time'),
            'total_marks'    => $this->request->getPost('total_marks'),
            'passing_marks'  => $this->request->getPost('passing_marks'),
            'subject_id'     => $this->request->getPost('subject_id'),
            'class_id'       => $this->request->getPost('class_id'),
        ];

        if ($this->model->insert($data) === false) {
            $response = [
                'status'  => "Error",
                'code'    => 500,
                'message' => 'Failed to create exam record',
                'data'    => null,
                'errors'  => $this->model->errors(),
            ];
            return $this->respond($response, 500);
        }

        $response = [
            'status'  => "Success",
            'code'    => 201,
            'message' => 'Exam created successfully',
            'data'    => $data,
            'errors'  => null,
        ];
        return $this->respond($response, 201);
    }

    public function edit($id = null)
    {
        $exam = $this->model->find($id);

        if (empty($exam)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'Exam not found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        $response = [
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Exam data retrieved for editing',
            'data'    => $exam,
            'errors'  => null,
        ];
        return $this->respond($response, 200);
    }

    public function update($id = null)
    {
        $exam = $this->model->find($id);

        if (empty($exam)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'Exam not found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        $rules = [
            'exam_name'      => 'required',
            'exam_date'      => 'required',
            'start_time'     => 'required',
            'end_time'       => 'required',
            'total_marks'    => 'required|numeric',
            'passing_marks'  => 'required|numeric',
            'subject_id'     => 'required|integer',
            'class_id'       => 'required|integer',
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
            'exam_name'      => $this->request->getPost('exam_name'),
            'exam_date'      => $this->request->getPost('exam_date'),
            'start_time'     => $this->request->getPost('start_time'),
            'end_time'       => $this->request->getPost('end_time'),
            'total_marks'    => $this->request->getPost('total_marks'),
            'passing_marks'  => $this->request->getPost('passing_marks'),
            'subject_id'     => $this->request->getPost('subject_id'),
            'class_id'       => $this->request->getPost('class_id'),
        ];

        if ($this->model->update($id, $data) === false) {
            $response = [
                'status'  => "Error",
                'code'    => 500,
                'message' => 'Failed to update exam',
                'data'    => null,
                'errors'  => $this->model->errors(),
            ];
            return $this->respond($response, 500);
        }

        $response = [
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Exam updated successfully',
            'data'    => $data,
            'errors'  => null,
        ];
        return $this->respond($response, 200);
    }

    public function delete($id = null)
    {
        $exam = $this->model->find($id);

        if (empty($exam)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'Exam not found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        if ($this->model->delete($id)) {
            $response = [
                'status'  => "Success",
                'code'    => 200,
                'message' => 'Exam deleted successfully',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 200);
        } else {
            $response = [
                'status'  => "Error",
                'code'    => 500,
                'message' => 'Failed to delete exam',
                'data'    => null,
                'errors'  => $this->model->errors(),
            ];
            return $this->respond($response, 500);
        }
    }
}
