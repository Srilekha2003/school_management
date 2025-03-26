<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Timetable extends ResourceController
{
    protected $modelName = 'App\Models\TimetableModel'; 
    protected $format    = 'json';

    public function index()
    {
        $timetables = $this->model->findAll();

        if (empty($timetables)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'No timetables found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        $response = [
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Timetables retrieved successfully',
            'data'    => $timetables,
            'errors'  => null,
        ];
        return $this->respond($response, 200);
    }

    public function view($id)
    {
        $timetable = $this->model->find($id);

        if (empty($timetable)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'Timetable not found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        $response = [
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Timetable retrieved successfully',
            'data'    => $timetable,
            'errors'  => null,
        ];
        return $this->respond($response, 200);
    }

    public function create()
    {
        $rules = [
            'class_id'      => 'required',
            'day_of_week'   => 'required',
            'period_number' => 'required',
            'subject_id'    => 'required',
            'teacher_id'    => 'required',
            'start_time'    => 'required',
            'end_time'      => 'required',
            'remarks'       => 'permit_empty',
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
                'message' => 'Failed to create timetable entry',
                'data'    => null,
                'errors'  => $this->model->errors(),
            ];
            return $this->respond($response, 500);
        }

        $response = [
            'status'  => "Success",
            'code'    => 201,
            'message' => 'Timetable entry created successfully',
            'data'    => $data,
            'errors'  => null,
        ];
        return $this->respond($response, 201);
    }

    public function update($id = null)
    {
        $timetable = $this->model->find($id);

        if (empty($timetable)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'Timetable entry not found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        $data = $this->request->getPost();

        if ($this->model->update($id, $data) === false) {
            $response = [
                'status'  => "Error",
                'code'    => 500,
                'message' => 'Failed to update timetable entry',
                'data'    => null,
                'errors'  => $this->model->errors(),
            ];
            return $this->respond($response, 500);
        }

        $response = [
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Timetable entry updated successfully',
            'data'    => $data,
            'errors'  => null,
        ];
        return $this->respond($response, 200);
    }

    public function delete($id = null)
    {
        $timetable = $this->model->find($id);

        if (empty($timetable)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'Timetable entry not found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        if ($this->model->delete($id)) {
            $response = [
                'status'  => "Success",
                'code'    => 200,
                'message' => 'Timetable entry deleted successfully',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 200);
        } else {
            $response = [
                'status'  => "Error",
                'code'    => 500,
                'message' => 'Failed to delete timetable entry',
                'data'    => null,
                'errors'  => $this->model->errors(),
            ];
            return $this->respond($response, 500);
        }
    }
}