<?php

namespace App\Models;

use CodeIgniter\Model;

class TeacherModel extends Model
{
    protected $table            = 'teachers';
    protected $primaryKey       = 'teacher_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['first_name','last_name','date_of_birth','gender','email','phone_number','address','joining_date','employment_status','retired','resigned','reason_for_leaving','rejoined','rejoining_date'];

 // Dates
 protected $useTimestamps        = true;
 protected $dateFormat           = 'datetime';
 protected $createdField         = 'created_at';
 protected $updatedField         = 'updated_at';
 protected $deletedField         = 'deleted_at';
 // Validation
 protected $validationRules      = [];
 protected $validationMessages   = [];
 protected $skipValidation       = false;
 protected $cleanValidationRules = true;
 // Callbacks
 protected $allowCallbacks       = true;
 protected $beforeInsert         = [];
 protected $afterInsert          = [];
 protected $beforeUpdate         = [];
 protected $afterUpdate          = [];
 protected $beforeFind           = [];
 protected $afterFind            = [];
 protected $beforeDelete         = [];
 protected $afterDelete          = [];

}
