<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Library extends ResourceController
{
    protected $modelName = 'App\Models\LibraryModel'; 
    protected $format    = 'json';

    public function index()
    {
        $books = $this->model->findAll();

        if (empty($books)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'No books found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        $response = [
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Books retrieved successfully',
            'data'    => $books,
            'errors'  => null,
        ];
        return $this->respond($response, 200);
    }

    public function view($id)
    {
        $book = $this->model->find($id);

        if (empty($book)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'Book not found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        $response = [
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Book retrieved successfully',
            'data'    => $book,
            'errors'  => null,
        ];
        return $this->respond($response, 200);
    }

    public function create()
    {
        $rules = [
            'isbn'               => 'required',
            'title'              => 'required',
            'author'             => 'required',
            'total_copies'       => 'required',
            'available_copies'   => 'required',
            'availability_status'=> 'required',
            'issued_to'          => 'permit_empty',
            'borrower_type'      => 'permit_empty',
            'issue_date'         => 'permit_empty',
            'due_date'           => 'permit_empty',
            'return_date'        => 'permit_empty',
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
    
        $data = $this->request->getPost();
    
        if ($this->model->insert($data) === false) {
            $response = [
                'status'  => "Error",
                'code'    => 500,
                'message' => 'Failed to create book record',
                'data'    => null,
                'errors'  => $this->model->errors(),
            ];
            return $this->respond($response, 500);
        }
    
        $response = [
            'status'  => "Success",
            'code'    => 201,
            'message' => 'Book created successfully',
            'data'    => $data,
            'errors'  => null,
        ];
        return $this->respond($response, 201);
    }
    
    public function delete($id = null)
    {
        $book = $this->model->find($id);

        if (empty($book)) {
            $response = [
                'status'  => "Error",
                'code'    => 404,
                'message' => 'Book not found',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 404);
        }

        if ($this->model->delete($id)) {
            $response = [
                'status'  => "Success",
                'code'    => 200,
                'message' => 'Book deleted successfully',
                'data'    => null,
                'errors'  => null,
            ];
            return $this->respond($response, 200);
        } else {
            $response = [
                'status'  => "Error",
                'code'    => 500,
                'message' => 'Failed to delete book',
                'data'    => null,
                'errors'  => $this->model->errors(),
            ];
            return $this->respond($response, 500);
        }
    }
}