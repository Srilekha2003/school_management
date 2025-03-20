<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class TransportRoutes extends ResourceController
{
    protected $modelName = 'App\Models\TransportRoutesModel';
    protected $format    = 'json';

    public function index()
    {
        $routes = $this->model->findAll();

        if (empty($routes)) {
            return $this->respond([
                'status'  => "Error",
                'code'    => 404,
                'message' => 'No transport routes found',
                'data'    => null,
                'errors'  => null,
            ], 404);
        }

        return $this->respond([
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Transport routes retrieved successfully',
            'data'    => $routes,
            'errors'  => null,
        ], 200);
    }

    public function view($id)
    {
        $route = $this->model->find($id);

        if (empty($route)) {
            return $this->respond([
                'status'  => "Error",
                'code'    => 404,
                'message' => 'Transport route not found',
                'data'    => null,
                'errors'  => null,
            ], 404);
        }

        return $this->respond([
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Transport route retrieved successfully',
            'data'    => $route,
            'errors'  => null,
        ], 200);
    }

    public function create()
    {
        $rules = [
            'route_number'  => 'required|is_unique[transport_routes.route_number]',
            'starting_point' => 'required',
            'destination'    => 'required',
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

        $data = [
            'route_number'  => $this->request->getPost('route_number'),
            'starting_point' => $this->request->getPost('starting_point'),
            'destination'    => $this->request->getPost('destination'),
        ];

        if ($this->model->insert($data) === false) {
            return $this->respond([
                'status'  => "Error",
                'code'    => 500,
                'message' => 'Failed to create transport route',
                'data'    => null,
                'errors'  => $this->model->errors(),
            ], 500);
        }

        return $this->respond([
            'status'  => "Success",
            'code'    => 201,
            'message' => 'Transport route created successfully',
            'data'    => $data,
            'errors'  => null,
        ], 201);
    }

    public function edit($id = null)
    {
        $route = $this->model->find($id);

        if (empty($route)) {
            return $this->respond([
                'status'  => "Error",
                'code'    => 404,
                'message' => 'Transport route not found',
                'data'    => null,
                'errors'  => null,
            ], 404);
        }

        return $this->respond([
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Transport route retrieved for editing',
            'data'    => $route,
            'errors'  => null,
        ], 200);
    }

    public function update($id = null)
    {
        $route = $this->model->find($id);

        if (empty($route)) {
            return $this->respond([
                'status'  => "Error",
                'code'    => 404,
                'message' => 'Transport route not found',
                'data'    => null,
                'errors'  => null,
            ], 404);
        }

        $rules = [
            'route_number'  => 'required',
            'starting_point' => 'required',
            'destination'    => 'required',
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

        $data = [
            'route_number'  => $this->request->getPost('route_number'),
            'starting_point' => $this->request->getPost('starting_point'),
            'destination'    => $this->request->getPost('destination'),
        ];

        if ($this->model->update($id, $data) === false) {
            return $this->respond([
                'status'  => "Error",
                'code'    => 500,
                'message' => 'Failed to update transport route',
                'data'    => null,
                'errors'  => $this->model->errors(),
            ], 500);
        }

        return $this->respond([
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Transport route updated successfully',
            'data'    => $data,
            'errors'  => null,
        ], 200);
    }

    public function delete($id = null)
    {
        $route = $this->model->find($id);

        if (empty($route)) {
            return $this->respond([
                'status'  => "Error",
                'code'    => 404,
                'message' => 'Transport route not found',
                'data'    => null,
                'errors'  => null,
            ], 404);
        }

        if ($this->model->delete($id)) {
            return $this->respond([
                'status'  => "Success",
                'code'    => 200,
                'message' => 'Transport route deleted successfully',
                'data'    => null,
                'errors'  => null,
            ], 200);
        } else {
            return $this->respond([
                'status'  => "Error",
                'code'    => 500,
                'message' => 'Failed to delete transport route',
                'data'    => null,
                'errors'  => $this->model->errors(),
            ], 500);
        }
    }
}
