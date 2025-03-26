<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;

class AdminRegister extends BaseController
{
    protected $adminModel;

    public function __construct()
    {
        helper(['form']);
        $this->adminModel = new AdminModel();
    }

    public function index()
    {
        return view('register');
    }

    public function register()
    {
        $rules = [
            'email' => 'required|min_length[4]|max_length[255]|valid_email|is_unique[admins.email]',
            'password' => 'required|min_length[4]|max_length[15]',
            'confirm_password' => 'matches[password]'
        ];

        if ($this->validate($rules)) {
            $data = [
                'email'    => $this->request->getPost('email'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'role'    => 'Admin',
            ];
            $this->adminModel->insert($data);
            return redirect()->to('/login')->with('success', 'Registration successful!');
        } else {
            return view('register', ['validation' => $this->validator]);
        }
    }
}
