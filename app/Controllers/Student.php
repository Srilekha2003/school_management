<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
class Student extends ResourceController
{
    protected $modelName = 'App\Models\StudentModel';
    protected $format = 'json';

    public function index()
    {
        $students = $this->model->findAll();

        if (empty($students)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'No students found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        $response = [
            'status'  => "Success",
            'code'    => 200,
            'message' => 'students retrieved successfully',
            'data'    => $students,
            'errors'  => null,
        ];
        return $this->respond($response, 200);
    }

    public function view($id)
    {
        $student = $this->model->find($id);

        if (empty($student)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'student not found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        $response = [
            'status'  => "Success",
            'code'    => 200,
            'message' => 'student retrieved successfully',
            'data'    => $student,
            'errors'  => null,
        ];
        return $this->respond($response, 200);
    }
    public function create()
    {
        $rules = [
            'first_name'                     => 'required',
            'last_name'                      => 'required',
            'date_of_birth'                  => 'required|valid_date',
            'gender'                         => 'required|in_list[Male,Female,Other]',
            'aadhaar_number'                 => 'required|numeric|exact_length[12]',
            'roll_number'                    => 'required|numeric',
            'address'                        => 'required',
            'email'                          => 'required|valid_email',
            'admission_date'                 => 'required|valid_date',
            'status'                         => 'required|in_list[Active,Inactive]',
            'discontinuation_status'         => 'permit_empty|in_list[0,1]',
            'discontinuation_reason'         => 'permit_empty',
            'discontinuation_date'           => 'permit_empty|valid_date',
            'rejoined'                       => 'permit_empty|in_list[0,1]',
            'rejoining_date'                 => 'permit_empty|valid_date',
            'previous_class'                 => 'permit_empty|string',
            'new_class'                      => 'permit_empty|string',
            'blood_group'                    => 'permit_empty|in_list[A+,A-,B+,B-,O+,O-,AB+,AB-]',
            'emergency_contact'              => 'permit_empty|numeric|min_length[10]|max_length[15]',
            'student_photo'                  => 'permit_empty|valid_url',
            'extra_curricular_participation' => 'permit_empty|string',
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
            'first_name'                     => $this->request->getPost('first_name'),
            'last_name'                      => $this->request->getPost('last_name'),
            'date_of_birth'                  => $this->request->getPost('date_of_birth'),
            'gender'                         => $this->request->getPost('gender'),
            'aadhaar_number'                 => $this->request->getPost('aadhaar_number'),
            'class_id'                       => $this->request->getPost('class_id') ?? null, // Optional field
            'roll_number'                    => $this->request->getPost('roll_number'),
            'parent_id'                      => $this->request->getPost('parent_id') ?? null, // Optional field
            'address'                        => $this->request->getPost('address'),
            'email'                          => $this->request->getPost('email'),
            'admission_date'                 => $this->request->getPost('admission_date'),
            'status'                         => $this->request->getPost('status'),
            'discontinuation_status'         => $this->request->getPost('discontinuation_status') ?? 0,
            'discontinuation_reason'         => $this->request->getPost('discontinuation_reason') ?? null,
            'discontinuation_date'           => $this->request->getPost('discontinuation_date') ?? null,
            'rejoined'                       => $this->request->getPost('rejoined') ?? 0,
            'rejoining_date'                 => $this->request->getPost('rejoining_date') ?? null,
            'previous_class'                 => $this->request->getPost('previous_class') ?? null,
            'new_class'                      => $this->request->getPost('new_class') ?? null,
            'blood_group'                    => $this->request->getPost('blood_group') ?? null,
            'emergency_contact'              => $this->request->getPost('emergency_contact'),
            'student_photo'                  => $this->request->getPost('student_photo') ?? null,
            'extra_curricular_participation' => $this->request->getPost('extra_curricular_participation') ?? null,
        ];
        
    
        // Check if Aadhaar number already exists
        if ($this->model->where('aadhaar_number', $data['aadhaar_number'])->first()) {
            $response = [
                'status'  => "Error",
                'code'    => 409,
                'message' => 'Aadhaar number already exists',
                'data'    => null,
                'errors'  => ['aadhaar_number' => 'This Aadhaar number is already registered'],
            ];
            return $this->respond($response, 409);
        }
    
        if ($this->model->insert($data)) {
            $response = [
                'status'  => "Success",
                'code'    => 201,
                'message' => 'Student created successfully',
                'data'    => $data,
                'errors'  => null,
            ];
            return $this->respond($response, 201);
        } else {
            $response = [
                'status'  => "Error",
                'code'    => 500,
                'message' => 'Failed to create student',
                'data'    => null,
                'errors'  => $this->model->errors(),
            ];
            return $this->respond($response, 500);
        }
    
        return $this->respond($response, 422); 
    }
    
    public function edit($id = null)
    {
        $student = $this->model->find($id);

        if (empty($student)) {
            $response=[
                'status'  => "Error",
                'code'    => 404,
                'message' => 'student not found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404); 
        }

        $response=[
            'status'  => "Success",
            'code'    => 200,
            'message' => 'student retrieved for editing',
            'data'    => $student,
            'errors'  => null,
        ];
        return $this->respond($response, 200); 
    }
  

    public function update($id = null)
{
    $student = $this->model->find($id);

    if (empty($student)) {
        $response = [
            'status'  => "Error",
            'code'    => 404,
            'message' => 'Student not found',
            'data'    => null,
            'errors'  => null,
        ];
        return $this->respond($response, 404);
    }

    // Retrieve updated data
    $data = [
        'first_name'                     => $this->request->getPost('first_name'),
        'last_name'                      => $this->request->getPost('last_name'),
        'date_of_birth'                  => $this->request->getPost('date_of_birth'),
        'gender'                         => $this->request->getPost('gender'),
        'aadhaar_number'                 => $this->request->getPost('aadhaar_number'),
        'class_id'                       => $this->request->getPost('class_id') ?? null,
        'roll_number'                    => $this->request->getPost('roll_number'),
        'parent_id'                      => $this->request->getPost('parent_id') ?? null,
        'address'                        => $this->request->getPost('address'),
        'email'                          => $this->request->getPost('email'),
        'admission_date'                 => $this->request->getPost('admission_date'),
        'status'                         => $this->request->getPost('status'),
        'previous_class'                 => $this->request->getPost('previous_class') ?? null,
        'new_class'                      => $this->request->getPost('new_class') ?? null,
        'blood_group'                    => $this->request->getPost('blood_group') ?? null,
        'student_photo'                  => $this->request->getPost('student_photo') ?? null,
        'extra_curricular_participation' => $this->request->getPost('extra_curricular_participation') ?? null,
    ];

    // Validation rules
    $rules = [
        'first_name'     => 'required',
        'last_name'      => 'required',
        'date_of_birth'  => 'required|valid_date',
        'gender'         => 'required|in_list[Male,Female,Other]',
        'aadhaar_number' => 'required|numeric|exact_length[12]',
        'roll_number'    => 'required|numeric',
        'address'        => 'required',
        'email'          => 'required|valid_email',
        'admission_date' => 'required|valid_date',
        'status'         => 'required|in_list[Active,Inactive]',
    ];

    // Validate input
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

    
    if ($data['aadhaar_number'] !== $student['aadhaar_number']) {
        $existingStudent = $this->model->where('aadhaar_number', $data['aadhaar_number'])
                                       ->where('student_id !=', $id)
                                       ->first();
        if ($existingStudent) {
            $response = [
                'status'  => "Error",
                'code'    => 422,
                'message' => 'Aadhaar number already exists for another student',
                'data'    => null,
                'errors'  => ['aadhaar_number' => 'Duplicate Aadhaar number'],
            ];
            return $this->respond($response, 422);
        }
    }

    
    if ($this->model->update($id, $data)) {
        $response = [
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Student updated successfully',
            'data'    => $data,
            'errors'  => null,
        ];
        return $this->respond($response, 200);
    } else {
        $response = [
            'status'  => "Error",
            'code'    => 500,
            'message' => 'Failed to update student',
            'data'    => null,
            'errors'  => $this->model->errors(),
        ];
        return $this->respond($response, 500);
    }
}

public function delete($id = null)
{
    $student = $this->model->find($id);

    if (empty($student)) {
        $response = [
            'status'  => "Error",
            'code'    => 404,
            'message' => 'Student not found', 
            'data'    => null,
            'errors'  => null,
        ];
        return $this->respond($response, 404);
    }

    if ($this->model->delete($id)) {
        $response = [
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Student deleted successfully', 
            'data'    => null,
            'errors'  => null,
        ];
        return $this->respond($response, 200);
    } else {
        $response = [
            'status'  => "Error",
            'code'    => 500,
            'message' => 'Failed to delete student', 
            'data'    => null,
            'errors'  => $this->model->errors(),
        ];
        return $this->respond($response, 500);
    }
}
}
?>