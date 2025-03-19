<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Notification extends ResourceController
{
    protected $modelName = 'App\Models\NotificationModel'; 
    protected $format    = 'json';

    public function index()
    {
        $notifications = $this->model->findAll();

        if (empty($notifications)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'No notifications found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        $response = [
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Notifications retrieved successfully',
            'data'    => $notifications,
            'errors'  => null,
        ];
        return $this->respond($response, 200);
    }

    public function view($id)
    {
        $notification = $this->model->find($id);

        if (empty($notification)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'Notification not found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        $response = [
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Notification retrieved successfully',
            'data'    => $notification,
            'errors'  => null,
        ];
        return $this->respond($response, 200);
    }

    public function create()
    {
        $rules = [
            'title'          => 'required',
            'message'        => 'required',
            'date_time'      => 'required',
            'recipient_type' => 'required',
            'status'         => 'required',
            'timetable_id'   => 'permit_empty',
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
            'title'          => $this->request->getPost('title'),
            'message'        => $this->request->getPost('message'),
            'date_time'      => $this->request->getPost('date_time'),
            'recipient_type' => $this->request->getPost('recipient_type'),
            'status'         => $this->request->getPost('status'),
            'timetable_id'   => $this->request->getPost('timetable_id'),
        ];
    
        if ($this->model->insert($data) === false) {
            $response = [
                'status'  => "Error",
                'code'    => 500,
                'message' => 'Failed to create notification',
                'data'    => null,
                'errors'  => $this->model->errors(),
            ];
            return $this->respond($response, 500);
        }
    
        $response = [
            'status'  => "Success",
            'code'    => 201,
            'message' => 'Notification created successfully',
            'data'    => $data,
            'errors'  => null,
        ];
        return $this->respond($response, 201);
    }
    
    public function delete($id = null)
    {
        $notification = $this->model->find($id);

        if (empty($notification)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'Notification not found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        if ($this->model->delete($id)) {
            $response = [
                'status'  => "Success",
                'code'    => 200,
                'message' => 'Notification deleted successfully',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 200);
        } else {
            $response = [
                'status'  => "Error",
                'code'    => 500,
                'message' => 'Failed to delete notification',
                'data'    => null,
                'errors'  => $this->model->errors(),
            ];
            return $this->respond($response, 500);
        }
    }
}
