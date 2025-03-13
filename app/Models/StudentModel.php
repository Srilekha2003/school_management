<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentModel extends Model
{
    protected $table            = 'students';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [ 'first_name', 
    'last_name', 
    'date_of_birth', 
    'gender', 
    'aadhaar_number', 
    'class_id', 
    'roll_number', 
    'parent_id', 
    'address', 
    'email', 
    'admission_date', 
    'status', 
    'discontinuation_status', 
    'discontinuation_reason', 
    'discontinuation_date', 
    'rejoined', 
    'rejoining_date', 
    'previous_class', 
    'new_class', 
    'blood_group', 
    'emergency_contact', 
    'student_photo', 
    'extra_curricular_participation'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
