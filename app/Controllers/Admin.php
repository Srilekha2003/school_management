<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Admin extends ResourceController
{
    protected $modelName = 'App\Models\AdminModel'; 
    protected $format    = 'json';

    public function index()
    {
        $admins = $this->model->findAll();

        if (empty($admins)) {
            return $this->respond([
                'status'  => "Error",
                'code'    => 404,
                'message' => 'No admins found',
                'data'    => null,
                'errors'  => null,
            ], 404);
        }

        return $this->respond([
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Admins retrieved successfully',
            'data'    => $admins,
            'errors'  => null,
        ], 200);
    }

    public function view($id)
    {
        $admin = $this->model->find($id);

        if (empty($admin)) {
            return $this->respond([
                'status'  => "Error",
                'code'    => 404,
                'message' => 'Admin not found',
                'data'    => null,
                'errors'  => null,
            ], 404);
        }

        return $this->respond([
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Admin retrieved successfully',
            'data'    => $admin,
            'errors'  => null,
        ], 200);
    }

    public function create()
    {
        $rules = [
            'email'    => 'required|valid_email|is_unique[admins.email]',
            'password' => 'required|min_length[6]',
            'role'     => 'required',
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
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);

        if ($this->model->insert($data) === false) {
            return $this->respond([
                'status'  => "Error",
                'code'    => 500,
                'message' => 'Failed to create admin',
                'errors'  => $this->model->errors(),
            ], 500);
        }

        return $this->respond([
            'status'  => "Success",
            'code'    => 201,
            'message' => 'Admin created successfully',
            'data'    => $data,
        ], 201);
    }

    public function update($id = null)
    {
        $admin = $this->model->find($id);

        if (empty($admin)) {
            return $this->respond([
                'status'  => "Error",
                'code'    => 404,
                'message' => 'Admin not found',
            ], 404);
        }

        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'permit_empty|min_length[6]',
            'role'     => 'required',
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

        if (!empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        } else {
            unset($data['password']);
        }

        if ($this->model->update($id, $data) === false) {
            return $this->respond([
                'status'  => "Error",
                'code'    => 500,
                'message' => 'Failed to update admin',
                'errors'  => $this->model->errors(),
            ], 500);
        }

        return $this->respond([
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Admin updated successfully',
            'data'    => $data,
        ], 200);
    }

    public function delete($id = null)
    {
        $admin = $this->model->find($id);

        if (empty($admin)) {
            return $this->respond([
                'status'  => "Error",
                'code'    => 404,
                'message' => 'Admin not found',
            ], 404);
        }

        if ($this->model->delete($id)) {
            return $this->respond([
                'status'  => "Success",
                'code'    => 200,
                'message' => 'Admin deleted successfully',
            ], 200);
        } else {
            return $this->respond([
                'status'  => "Error",
                'code'    => 500,
                'message' => 'Failed to delete admin',
                'errors'  => $this->model->errors(),
            ], 500);
        }
    }
}