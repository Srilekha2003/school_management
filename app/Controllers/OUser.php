<?php
 
namespace App\Controllers;
 
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\OwnerModel;
 
class OUser extends BaseController
{
    use ResponseTrait;
     
    public function index()
    {
        $owners = new OwnerModel();
        return $this->respond(['owners' => $owners->findAll()], 200);
    }
}