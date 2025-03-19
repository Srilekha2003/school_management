<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Teacher extends ResourceController
{
    protected $modelName = 'App\Models\TeacherModel'; 
    protected $format    = 'json';

    public function index()
    {
        $teachers = $this->model->findAll();

        if (empty($teachers)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'No teachers found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        $response = [
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Teachers retrieved successfully',
            'data'    => $teachers,
            'errors'  => null,
        ];
        return $this->respond($response, 200);
    }

    public function view($id)
    {
        $teacher = $this->model->find($id);

        if (empty($teacher)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'Teacher not found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        $response = [
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Teacher retrieved successfully',
            'data'    => $teacher,
            'errors'  => null,
        ];
        return $this->respond($response, 200);
    }

    public function create()
    {
        $rules = [
            'first_name'           => 'required',
            'last_name'            => 'required',
            'date_of_birth'        => 'required',
            'gender'               => 'required',
            'email'                => 'required|valid_email',
            'phone_number'         => 'required',
            'address'              => 'required',
            'joining_date'         => 'required',
            'employment_status'    => 'required',
            'retired'              => 'required',
            'resigned'             => 'required',
            'reason_for_leaving'   => 'permit_empty',
            'rejoined'             => 'required',
            'rejoining_date'       => 'permit_empty',
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
            'first_name'           => $this->request->getPost('first_name'),
            'last_name'            => $this->request->getPost('last_name'),
            'date_of_birth'        => $this->request->getPost('date_of_birth'),
            'gender'               => $this->request->getPost('gender'),
            'email'                => $this->request->getPost('email'),
            'phone_number'         => $this->request->getPost('phone_number'),
            'address'              => $this->request->getPost('address'),
            'joining_date'         => $this->request->getPost('joining_date'),
            'employment_status'    => $this->request->getPost('employment_status'),
            'retired'              => $this->request->getPost('retired'),
            'resigned'             => $this->request->getPost('resigned'),
            'reason_for_leaving'   => $this->request->getPost('reason_for_leaving'),
            'rejoined'             => $this->request->getPost('rejoined'),
            'rejoining_date'       => $this->request->getPost('rejoining_date'),
        ];
    
        // Check if phone number already exists
        $existingTeacher = $this->model->where('phone_number', $data['phone_number'])->first();
    
        if ($existingTeacher) {
            $response = [
                'status'  => "Error",
                'code'    => 409,
                'message' => 'Phone number already exists',
                'data'    => null,
                'errors'  => ['phone_number' => 'This phone number is already registered'],
            ];
            return $this->respond($response, 409);
        }
    
        if ($this->model->insert($data) === false) {
            $response = [
                'status'  => "Error",
                'code'    => 500,
                'message' => 'Failed to create teacher record',
                'data'    => null,
                'errors'  => $this->model->errors(),
            ];
            return $this->respond($response, 500);
        }
    
        $response = [
            'status'  => "Success",
            'code'    => 201,
            'message' => 'teacher created successfully',
            'data'    => $data,
            'errors'  => null,
        ];
        return $this->respond($response, 201);
    }
    
    
public function edit($id = null)
{
   
    $teacher = $this->model->find($id);

    if (empty($teacher)) {
        $response = [
            'status'  => "Error",
            'code'    => 404,
            'message' => 'teacher not found',
            'data'    => null,
            'errors'  => null,
        ];
        return $this->respond($response, 404); 
    }

    $response = [
        'status'  => "Success",
        'code'    => 200,
        'message' => 'teacher data retrieved for editing',
        'data'    => $teacher,
        'errors'  => null,
    ];
    return $this->respond($response, 200); 
}

public function update($id = null)
{
    $employee = $this->model->find($id);

    if (empty($employee)) {
        $response = [
            'status'  => "Error",
            'code'    => 404,
            'message' => 'Employee not found',
            'data'    => null,
            'errors'  => null,
        ];
        return $this->respond($response, 200);
    }

    $rules = [
        'first_name'           => 'required',
        'last_name'            => 'required',
        'date_of_birth'        => 'required',
        'gender'               => 'required',
        'email'                => 'required|valid_email',
        'phone_number'         => 'required',
        'address'              => 'required',
        'joining_date'         => 'required',
        'employment_status'    => 'required',
        'retired'              => 'required',
        'resigned'             => 'required',
        'reason_for_leaving'   => 'permit_empty',
        'rejoined'             => 'required',
        'rejoining_date'       => 'permit_empty',
    ];

    if (!$this->validate($rules)) {
        $response = [
            'status'  => "Error",
            'code'    => 422,
            'message' => 'Validation errors',
            'data'    => null,
            'errors'  => $this->validator->getErrors(),
        ];
        return $this->respond($response, 200);
    }

    $data = [
        'first_name'           => $this->request->getPost('first_name'),
        'last_name'            => $this->request->getPost('last_name'),
        'date_of_birth'        => $this->request->getPost('date_of_birth'),
        'gender'               => $this->request->getPost('gender'),
        'email'                => $this->request->getPost('email'),
        'phone_number'         => $this->request->getPost('phone_number'),
        'address'              => $this->request->getPost('address'),
        'joining_date'         => $this->request->getPost('joining_date'),
        'employment_status'    => $this->request->getPost('employment_status'),
        'retired'              => $this->request->getPost('retired'),
        'resigned'             => $this->request->getPost('resigned'),
        'reason_for_leaving'   => $this->request->getPost('reason_for_leaving'),
        'rejoined'             => $this->request->getPost('rejoined'),
        'rejoining_date'       => $this->request->getPost('rejoining_date'),
    ];

    // Check if phone number already exists for another employee
    $existingTeacher = $this->model->where('phone_number', $data['phone_number'])
                                    ->where('teacher_id !=', $id)
                                    ->first();

    if ($existingTeacher) {
        $response = [
            'status'  => "Error",
            'code'    => 409,
            'message' => 'Phone number already exists for another employee',
            'data'    => null,
            'errors'  => ['phone_number' => 'This phone number is already in use'],
        ];
        return $this->respond($response, 200);
    }

    if ($this->model->update($id, $data) === false) {
        $response = [
            'status'  => "Error",
            'code'    => 500,
            'message' => 'Failed to update teacher',
            'data'    => null,
            'errors'  => $this->model->errors(),
        ];
        return $this->respond($response, 200);
    }

    $response = [
        'status'  => "Success",
        'code'    => 200,
        'message' => 'teacher updated successfully',
        'data'    => $data,
        'errors'  => null,
    ];
    return $this->respond($response, 200);
}


    public function delete($id = null)
    {
        $teacher = $this->model->find($id);

        if (empty($teacher)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'Teacher not found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        if ($this->model->delete($id)) {
            $response = [
                'status'  => "Success",
                'code'    => 200,
                'message' => 'Teacher deleted successfully',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 200);
        } else {
            $response = [
                'status'  => "Error",
                'code'    => 500,
                'message' => 'Failed to delete teacher',
                'data'    => null,
                'errors'  => $this->model->errors(),
            ];
            return $this->respond($response, 500);
        }
    }
}
