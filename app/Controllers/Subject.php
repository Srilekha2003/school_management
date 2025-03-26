<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Subject extends ResourceController
{
    protected $modelName = 'App\Models\SubjectModel';
    protected $format    = 'json';

    // Retrieve all subjects
    public function index()
    {
        $subjects = $this->model->findAll();

        if (empty($subjects)) {
            return $this->respond([
                'status'  => "Error",
                'code'    => 404,
                'message' => 'No subjects found',
                'data'    => null,
                'errors'  => null,
            ], 404);
        }

        return $this->respond([
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Subjects retrieved successfully',
            'data'    => $subjects,
            'errors'  => null,
        ], 200);
    }

    // Retrieve a single subject by ID
    public function view($id)
    {
        $subject = $this->model->find($id);

        if (empty($subject)) {
            return $this->respond([
                'status'  => "Error",
                'code'    => 404,
                'message' => 'Subject not found',
                'data'    => null,
                'errors'  => null,
            ], 404);
        }

        return $this->respond([
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Subject retrieved successfully',
            'data'    => $subject,
            'errors'  => null,
        ], 200);
    }

    // Create a new subject
    public function create()
    {
        $rules = [
            'subject_name' => 'required',
            'teacher_id'   => 'required|numeric',
            'syllabus'     => 'permit_empty',
        ];

        if (!$this->validate($rules)) {
            return $this->respond([
                'status'  => "Error",
                'code'    => 422,
                'message' => 'Validation errors',
                'data'    => null,
                'errors'  => $this->validator->getErrors(),
            ], 422);
        }

        $data = [
            'subject_name' => $this->request->getPost('subject_name'),
            'teacher_id'   => $this->request->getPost('teacher_id'),
            'syllabus'     => $this->request->getPost('syllabus'),
        ];

        if ($this->model->insert($data) === false) {
            return $this->respond([
                'status'  => "Error",
                'code'    => 500,
                'message' => 'Failed to create subject',
                'data'    => null,
                'errors'  => $this->model->errors(),
            ], 500);
        }

        return $this->respond([
            'status'  => "Success",
            'code'    => 201,
            'message' => 'Subject created successfully',
            'data'    => $data,
            'errors'  => null,
        ], 201);
    }

    // Edit a subject (get data for update)
    public function edit($id = null)
    {
        $subject = $this->model->find($id);

        if (empty($subject)) {
            return $this->respond([
                'status'  => "Error",
                'code'    => 404,
                'message' => 'Subject not found',
                'data'    => null,
                'errors'  => null,
            ], 404);
        }

        return $this->respond([
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Subject data retrieved for editing',
            'data'    => $subject,
            'errors'  => null,
        ], 200);
    }

    // Update a subject
    public function update($id = null)
    {
        $subject = $this->model->find($id);

        if (empty($subject)) {
            return $this->respond([
                'status'  => "Error",
                'code'    => 404,
                'message' => 'Subject not found',
                'data'    => null,
                'errors'  => null,
            ], 404);
        }

        $rules = [
            'subject_name' => 'required',
            'teacher_id'   => 'required|numeric',
            'syllabus'     => 'permit_empty',
        ];

        if (!$this->validate($rules)) {
            return $this->respond([
                'status'  => "Error",
                'code'    => 422,
                'message' => 'Validation errors',
                'data'    => null,
                'errors'  => $this->validator->getErrors(),
            ], 422);
        }

        $data = [
            'subject_name' => $this->request->getPost('subject_name'),
            'teacher_id'   => $this->request->getPost('teacher_id'),
            'syllabus'     => $this->request->getPost('syllabus'),
        ];

        if ($this->model->update($id, $data) === false) {
            return $this->respond([
                'status'  => "Error",
                'code'    => 500,
                'message' => 'Failed to update subject',
                'data'    => null,
                'errors'  => $this->model->errors(),
            ], 500);
        }

        return $this->respond([
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Subject updated successfully',
            'data'    => $data,
            'errors'  => null,
        ], 200);
    }

    // Delete a subject
    public function delete($id = null)
    {
        $subject = $this->model->find($id);

        if (empty($subject)) {
            return $this->respond([
                'status'  => "Error",
                'code'    => 404,
                'message' => 'Subject not found',
                'data'    => null,
                'errors'  => null,
            ], 404);
        }

        if ($this->model->delete($id)) {
            return $this->respond([
                'status'  => "Success",
                'code'    => 200,
                'message' => 'Subject deleted successfully',
                'data'    => null,
                'errors'  => null,
            ], 200);
        } else {
            return $this->respond([
                'status'  => "Error",
                'code'    => 500,
                'message' => 'Failed to delete subject',
                'data'    => null,
                'errors'  => $this->model->errors(),
            ], 500);
        }
    }
}
