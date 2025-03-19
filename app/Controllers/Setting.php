<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Setting extends ResourceController
{
    protected $modelName = 'App\Models\SettingModel'; 
    protected $format    = 'json';

    public function index()
    {
        $settings = $this->model->findAll();

        if (empty($settings)) {
            return $this->respond([
                'status'  => "Error",
                'code'    => 404,
                'message' => 'No settings found',
                'data'    => null,
                'errors'  => null,
            ], 404);
        }

        return $this->respond([
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Settings retrieved successfully',
            'data'    => $settings,
            'errors'  => null,
        ], 200);
    }

    public function view($id)
    {
        $setting = $this->model->find($id);

        if (empty($setting)) {
            return $this->respond([
                'status'  => "Error",
                'code'    => 404,
                'message' => 'Setting not found',
                'data'    => null,
                'errors'  => null,
            ], 404);
        }

        return $this->respond([
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Setting retrieved successfully',
            'data'    => $setting,
            'errors'  => null,
        ], 200);
    }

    public function create()
    {
        $rules = [
            'school_name'             => 'required',
            'academic_year'           => 'required',
            'grading_system'          => 'required',
            'attendance_rules'        => 'required',
            'exam_policies'           => 'required',
            'notification_preferences'=> 'required',
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

        $data = $this->request->getPost();

        if ($this->model->insert($data) === false) {
            return $this->respond([
                'status'  => "Error",
                'code'    => 500,
                'message' => 'Failed to create setting',
                'errors'  => $this->model->errors(),
            ], 500);
        }

        return $this->respond([
            'status'  => "Success",
            'code'    => 201,
            'message' => 'Setting created successfully',
            'data'    => $data,
        ], 201);
    }

    public function update($id = null)
    {
        $setting = $this->model->find($id);

        if (empty($setting)) {
            return $this->respond([
                'status'  => "Error",
                'code'    => 404,
                'message' => 'Setting not found',
            ], 404);
        }

        $rules = [
            'school_name'             => 'required',
            'academic_year'           => 'required',
            'grading_system'          => 'required',
            'attendance_rules'        => 'required',
            'exam_policies'           => 'required',
            'notification_preferences'=> 'required',
        ];

        if (!$this->validate($rules)) {
            return $this->respond([
                'status'  => "Error",
                'code'    => 422,
                'message' => 'Validation errors',
                'errors'  => $this->validator->getErrors(),
            ], 422);
        }

        $data = $this->request->getPost();

        if ($this->model->update($id, $data) === false) {
            return $this->respond([
                'status'  => "Error",
                'code'    => 500,
                'message' => 'Failed to update setting',
                'errors'  => $this->model->errors(),
            ], 500);
        }

        return $this->respond([
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Setting updated successfully',
            'data'    => $data,
        ], 200);
    }

    public function delete($id = null)
    {
        $setting = $this->model->find($id);

        if (empty($setting)) {
            return $this->respond([
                'status'  => "Error",
                'code'    => 404,
                'message' => 'Setting not found',
            ], 404);
        }

        if ($this->model->delete($id)) {
            return $this->respond([
                'status'  => "Success",
                'code'    => 200,
                'message' => 'Setting deleted successfully',
            ], 200);
        } else {
            return $this->respond([
                'status'  => "Error",
                'code'    => 500,
                'message' => 'Failed to delete setting',
                'errors'  => $this->model->errors(),
            ], 500);
        }
    }
}
