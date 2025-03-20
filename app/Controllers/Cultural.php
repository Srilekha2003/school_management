<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Cultural extends ResourceController
{
    protected $modelName = 'App\Models\CulturalModel'; 
    protected $format    = 'json';

    public function index()
    {
        $events = $this->model->findAll();

        if (empty($events)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'No cultural events found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        $response = [
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Cultural events retrieved successfully',
            'data'    => $events,
            'errors'  => null,
        ];
        return $this->respond($response, 200);
    }

    public function view($id)
    {
        $event = $this->model->find($id);

        if (empty($event)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'Cultural event not found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        $response = [
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Cultural event retrieved successfully',
            'data'    => $event,
            'errors'  => null,
        ];
        return $this->respond($response, 200);
    }

    public function create()
    {
        $rules = [
            'event_name'           => 'required',
            'date_time'            => 'required',
            'venue'                => 'required',
            'category'             => 'required',
            'event_coordinator_id' => 'required|integer',
            'awards_recognitions'  => 'permit_empty',
            'remarks'              => 'permit_empty',
            'description'          => 'permit_empty',
            'participants'         => 'required',
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
            'event_name'           => $this->request->getPost('event_name'),
            'date_time'            => $this->request->getPost('date_time'),
            'venue'                => $this->request->getPost('venue'),
            'category'             => $this->request->getPost('category'),
            'event_coordinator_id' => $this->request->getPost('event_coordinator_id'),
            'awards_recognitions'  => $this->request->getPost('awards_recognitions'),
            'remarks'              => $this->request->getPost('remarks'),
            'description'          => $this->request->getPost('description'),
            'participants'         => $this->request->getPost('participants'),
        ];
    
        if ($this->model->insert($data) === false) {
            $response = [
                'status'  => "Error",
                'code'    => 500,
                'message' => 'Failed to create cultural event',
                'data'    => null,
                'errors'  => $this->model->errors(),
            ];
            return $this->respond($response, 500);
        }
    
        $response = [
            'status'  => "Success",
            'code'    => 201,
            'message' => 'Cultural event created successfully',
            'data'    => $data,
            'errors'  => null,
        ];
        return $this->respond($response, 201);
    }
    
    public function edit($id = null)
    {
        $event = $this->model->find($id);

        if (empty($event)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'Cultural event not found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404); 
        }

        $response = [
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Cultural event data retrieved for editing',
            'data'    => $event,
            'errors'  => null,
        ];
        return $this->respond($response, 200); 
    }

    public function update($id = null)
    {
        $event = $this->model->find($id);

        if (empty($event)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'Cultural event not found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        $rules = [
            'event_name'           => 'required',
            'date_time'            => 'required',
            'venue'                => 'required',
            'category'             => 'required',
            'event_coordinator_id' => 'required|integer',
            'awards_recognitions'  => 'permit_empty',
            'remarks'              => 'permit_empty',
            'description'          => 'permit_empty',
            'participants'         => 'required',
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
            'event_name'           => $this->request->getPost('event_name'),
            'date_time'            => $this->request->getPost('date_time'),
            'venue'                => $this->request->getPost('venue'),
            'category'             => $this->request->getPost('category'),
            'event_coordinator_id' => $this->request->getPost('event_coordinator_id'),
            'awards_recognitions'  => $this->request->getPost('awards_recognitions'),
            'remarks'              => $this->request->getPost('remarks'),
            'description'          => $this->request->getPost('description'),
            'participants'         => $this->request->getPost('participants'),
        ];

        if ($this->model->update($id, $data) === false) {
            $response = [
                'status'  => "Error",
                'code'    => 500,
                'message' => 'Failed to update cultural event',
                'data'    => null,
                'errors'  => $this->model->errors(),
            ];
            return $this->respond($response, 500);
        }

        $response = [
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Cultural event updated successfully',
            'data'    => $data,
            'errors'  => null,
        ];
        return $this->respond($response, 200);
    }

    public function delete($id = null)
    {
        $event = $this->model->find($id);

        if (empty($event)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'Cultural event not found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        if ($this->model->delete($id)) {
            $response = [
                'status'  => "Success",
                'code'    => 200,
                'message' => 'Cultural event deleted successfully',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 200);
        } else {
            $response = [
                'status'  => "Error",
                'code'    => 500,
                'message' => 'Failed to delete cultural event',
                'data'    => null,
                'errors'  => $this->model->errors(),
            ];
            return $this->respond($response, 500);
        }
    }
}
