<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentModel extends Model
{
    protected $table            = 'students';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;

    protected $allowedFields = [
        'first_name',
        'last_name',
        'email',
        'course',
        'year_level',
    ];

    // Timestamps
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'first_name' => 'required|min_length[2]|max_length[100]',
        'last_name'  => 'required|min_length[2]|max_length[100]',
        'email'      => 'required|valid_email|max_length[150]',
        'course'     => 'required|max_length[100]',
        'year_level' => 'required|integer|greater_than[0]|less_than[6]',
    ];

    protected $validationMessages = [
        'email' => [
            'valid_email' => 'Please provide a valid email address.',
        ],
    ];

    /**
     * Search students by keyword across multiple fields.
     */
    public function search(string $keyword): array
    {
        return $this->groupStart()
                    ->like('first_name', $keyword)
                    ->orLike('last_name', $keyword)
                    ->orLike('email', $keyword)
                    ->orLike('course', $keyword)
                    ->groupEnd()
                    ->findAll();
    }
}
