<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Classes extends ResourceController
{
    protected $modelName = 'App\Models\ClassesModel'; 
    protected $format    = 'json';

    public function index()
    {
        $classes = $this->model->findAll();

        if (empty($classes)) {
            return $this->failNotFound('No classes found');
        }

        return $this->respond([
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Classes retrieved successfully',
            'data'    => $classes
        ], 200);
    }

    public function view($id)
    {
        $class = $this->model->find($id);

        if (empty($class)) {
            return $this->failNotFound('Class not found');
        }

        return $this->respond([
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Class retrieved successfully',
            'data'    => $class
        ], 200);
    }

    public function create()
    {
        $rules = [
            'class_name'       => 'required',
            'class_teacher_id' => 'required|integer',
            'total_students'   => 'required|integer',
            'section'          => 'required',
            'subjects_covered' => 'required',
            'timetable_id'     => 'required|integer',
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = $this->request->getPost();
        $this->model->insert($data);

        return $this->respondCreated([
            'status'  => "Success",
            'code'    => 201,
            'message' => 'Class created successfully',
            'data'    => $data
        ]);
    }

    // public function edit($id)
    // {
    //     $class = $this->model->find($id);

    //     if (empty($class)) {
    //         return $this->failNotFound('Class not found');
    //     }

    //     return $this->respond([
    //         'status'  => "Success",
    //         'code'    => 200,
    //         'message' => 'Class data retrieved for editing',
    //         'data'    => $class
    //     ], 200);
    // }
    public function edit($id = null)
    {
        if ($id === null) {
            return $this->failNotFound('Class ID is required');
        }

        $class = $this->model->where('class_id', $id)->first();

        if (empty($class)) {
            return $this->failNotFound('Class not found');
        }

        return $this->respond([
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Class data retrieved for editing',
            'data'    => $class
        ], 200);
    }

public function update($id = null)
{
    if ($id === null) {
        return $this->failNotFound('Class ID is required');
    }

    $class = $this->model->find($id);

    if (empty($class)) {
        return $this->failNotFound('Class not found');
    }

    $data = $this->request->getRawInput();

    if ($this->model->update($id, $data)) {
        return $this->respond([
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Class updated successfully',
            'data'    => $data
        ], 200);
    } else {
        return $this->fail('Failed to update class', 500);
    }
}

    // public function update($id)
    // {
    //     $class = $this->model->find($id);

    //     if (empty($class)) {
    //         return $this->failNotFound('Class not found');
    //     }

    //     $rules = [
    //         'class_name'       => 'required',
    //         'class_teacher_id' => 'required|integer',
    //         'total_students'   => 'required|integer',
    //         'section'          => 'required',
    //         'subjects_covered' => 'required',
    //         'timetable_id'     => 'required|integer',
    //     ];

    //     if (!$this->validate($rules)) {
    //         return $this->failValidationErrors($this->validator->getErrors());
    //     }

    //     $data = $this->request->getPost();
    //     $this->model->update($id, $data);

    //     return $this->respond([
    //         'status'  => "Success",
    //         'code'    => 200,
    //         'message' => 'Class updated successfully',
    //         'data'    => $data
    //     ], 200);
    // }
    public function delete($id = null)
    {
        if ($id === null) {
            return $this->failNotFound('Class ID is required');
        }
    
        $class = $this->model->where('class_id', $id)->first();
    
        if (!$class) {
            return $this->failNotFound('Class not found');
        }
    
        $this->model->where('class_id', $id)->delete();
    
        return $this->respondDeleted([
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Class deleted successfully'
        ]);
    }
    
    
//     public function delete($id = null)
// {
//     if ($id === null) {
//         return $this->failNotFound('Class ID is required');
//     }

//     $class = $this->model->find($id);

//     if (empty($class)) {
//         return $this->failNotFound('Class not found');
//     }

//     if ($this->model->delete($id)) {
//         return $this->respondDeleted([
//             'status'  => "Success",
//             'code'    => 200,
//             'message' => 'Class deleted successfully',
//             'data'    => null
//         ]);
//     } else {
//         return $this->fail('Failed to delete class', 500);
//     }
// }

}
