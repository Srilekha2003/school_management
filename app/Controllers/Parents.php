<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
class Parents extends ResourceController
{
    protected $modelName = 'App\Models\ParentModel';
    protected $format = 'json';

    public function index()
    {
        $parents = $this->model->findAll();

        if (empty($parents)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'No parents found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        $response = [
            'status'  => "Success",
            'code'    => 200,
            'message' => 'parents retrieved successfully',
            'data'    => $parents,
            'errors'  => null,
        ];
        return $this->respond($response, 200);
    }

    public function view($id)
    {
        $parent = $this->model->find($id);

        if (empty($parent)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'parent not found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        $response = [
            'status'  => "Success",
            'code'    => 200,
            'message' => 'parent retrieved successfully',
            'data'    => $parent,
            'errors'  => null,
        ];
        return $this->respond($response, 200);
    }
    

    public function create()
{
    $rules = [
        'guardian_name'  => 'required|string',
        'relationship'   => 'required|string',
        'occupation'     => 'permit_empty|string',
        'email'          => 'required|valid_email',
        'contact_number' => 'required|numeric|min_length[10]|max_length[15]',
        'address'        => 'required|string',
        'student_id'     => 'required|numeric',
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
        'guardian_name'  => $this->request->getPost('guardian_name'),
        'relationship'   => $this->request->getPost('relationship'),
        'occupation'     => $this->request->getPost('occupation') ?? null,
        'email'          => $this->request->getPost('email'),
        'contact_number' => $this->request->getPost('contact_number'),
        'address'        => $this->request->getPost('address'),
        'student_id'     => $this->request->getPost('student_id'),
    ];

    // Check if Student ID already has a parent
    if ($this->model->where('student_id', $data['student_id'])->first()) {
        $response = [
            'status'  => "Error",
            'code'    => 409,
            'message' => 'A parent already exists for this student ID',
            'data'    => null,
            'errors'  => ['student_id' => 'This student already has a registered parent'],
        ];
        return $this->respond($response, 409);
    }

    // Check if Contact Number already exists
    if ($this->model->where('contact_number', $data['contact_number'])->first()) {
        $response = [
            'status'  => "Error",
            'code'    => 409,
            'message' => 'Contact number already exists',
            'data'    => null,
            'errors'  => ['contact_number' => 'This contact number is already registered'],
        ];
        return $this->respond($response, 409);
    }

    if ($this->model->insert($data)) {
        $response = [
            'status'  => "Success",
            'code'    => 201,
            'message' => 'Guardian details added successfully',
            'data'    => $data,
            'errors'  => null,
        ];
        return $this->respond($response, 201);
    } else {
        $response = [
            'status'  => "Error",
            'code'    => 500,
            'message' => 'Failed to add guardian details',
            'data'    => null,
            'errors'  => $this->model->errors(),
        ];
        return $this->respond($response, 500);
    }

    return $this->respond($response, 404); 
}

    
    public function edit($id = null)
    {
        $parent = $this->model->find($id);

        if (empty($parent)) {
            $response=[
                'status'  => "Error",
                'code'    => 404,
                'message' => 'parent not found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404); 
        }

        $response=[
            'status'  => "Success",
            'code'    => 200,
            'message' => 'parent retrieved for editing',
            'data'    => $parent,
            'errors'  => null,
        ];
        return $this->respond($response, 200); 
    }
  

      public function update($id = null)
    {
        $parent = $this->model->find($id);
    
        if (!$parent) {
            return $this->respond([
                'status'  => "Error",
                'code'    => 404,
                'message' => 'Parent not found',
                'data'    => null,
                'errors'  => null,
            ], 404);
        }
    
        $data = $this->request->getPost();
    
        if ($data['student_id'] !== $parent['student_id']) {
            $existingGuardian = $this->model->where('student_id', $data['student_id'])->where('id !=', $id)->first();
            if ($existingGuardian) {
                return $this->respond([
                    'status'  => "Error",
                    'code'    => 409,
                    'message' => 'A parent already exists for this student ID',
                    'data'    => null,
                    'errors'  => ['student_id' => 'This student already has a registered parent'],
                ], 409);
            }
        }
    
        if ($data['contact_number'] !== $parent['contact_number']) {
            $existingContact = $this->model->where('contact_number', $data['contact_number'])->where('id !=', $id)->first();
            if ($existingContact) {
                return $this->respond([
                    'status'  => "Error",
                    'code'    => 409,
                    'message' => 'Contact number already exists',
                    'data'    => null,
                    'errors'  => ['contact_number' => 'This contact number is already registered'],
                ], 409);
            }
        }
    
        if ($this->model->update($id, $data)) {
            return $this->respond([
                'status'  => "Success",
                'code'    => 200,
                'message' => 'Guardian details updated successfully',
                'data'    => $data,
                'errors'  => null,
            ], 200);
        }
    
        return $this->respond([
            'status'  => "Error",
            'code'    => 500,
            'message' => 'Failed to update guardian details',
            'data'    => null,
            'errors'  => $this->model->errors(),
        ], 500);
    }

    
public function delete($id = null)
{
    $parent = $this->model->find($id);

    if (empty($parent)) {
        $response = [
            'status'  => "Error",
            'code'    => 404,
            'message' => 'parent not found', 
            'data'    => null,
            'errors'  => null,
        ];
        return $this->respond($response, 404);
    }

    if ($this->model->delete($id)) {
        $response = [
            'status'  => "Success",
            'code'    => 200,
            'message' => 'parent deleted successfully', 
            'data'    => null,
            'errors'  => null,
        ];
        return $this->respond($response, 200);
    } else {
        $response = [
            'status'  => "Error",
            'code'    => 500,
            'message' => 'Failed to delete parent', 
            'data'    => null,
            'errors'  => $this->model->errors(),
        ];
        return $this->respond($response, 500);
    }
}
}
?>