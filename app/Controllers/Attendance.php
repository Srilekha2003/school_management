<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;

class Attendance extends ResourceController
{
    protected $modelName = 'App\Models\AttendanceModel'; 
    protected $format    = 'json';

    public function index()
    {
        $attendences = $this->model->findAll();

        if (empty($attendences)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'No attendences found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        $response = [
            'status'  => "Success",
            'code'    => 200,
            'message' => 'attendences retrieved successfully',
            'data'    => $attendences,
            'errors'  => null,
        ];
        return $this->respond($response, 200);
    }

    public function view($id)
    {
        $attendence = $this->model->find($id);

        if (empty($attendence)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'attendence not found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        $response = [
            'status'  => "Success",
            'code'    => 200,
            'message' => 'attendence retrieved successfully',
            'data'    => $attendence,
            'errors'  => null,
        ];
        return $this->respond($response, 200);
    }

    public function create()
    {
        $rules = [
            'date'              => 'required',
            'student_id'        => 'required|numeric',
            'teacher_id'        => 'required|numeric',
            'status'            => 'required',
            'remarks'           => 'permit_empty',
            'percentage_report' => 'permit_empty',
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
            'date'              => $this->request->getPost('date'),
            'student_id'        => $this->request->getPost('student_id'),
            'teacher_id'        => $this->request->getPost('teacher_id'),
            'status'            => $this->request->getPost('status'),
            'remarks'           => $this->request->getPost('remarks'),
            'percentage_report' => $this->request->getPost('percentage_report'),
        ];

        if ($this->model->insert($data)) {
            $response = [
                'status'  => "Success",
                'code'    => 201,
                'message' => 'Attendance recorded successfully',
                'data'    => $data,
                'errors'  => null,
            ];
            return $this->respond($response, 201); 
        } else {
            $response = [
                'status'  => "Error",
                'code'    => 500,
                'message' => 'Failed to record attendance',
                'data'    => null,
                'errors'  => $this->model->errors(),
            ];
            return $this->respond($response, 500); 
        }
    }

}
?>