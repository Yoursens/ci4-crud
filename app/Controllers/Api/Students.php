<?php

namespace App\Controllers\Api;

use App\Models\StudentModel;
use CodeIgniter\RESTful\ResourceController;

class Students extends ResourceController
{
    protected $modelName = 'App\Models\StudentModel';
    protected $format    = 'json';

    // GET /api/students
    public function index()
    {
        $students = $this->model->findAll();

        return $this->respond([
            'status'  => 200,
            'message' => 'Students retrieved successfully.',
            'data'    => $students,
            'count'   => count($students),
        ]);
    }

    // GET /api/students/{id}
    public function show($id = null)
    {
        $student = $this->model->find($id);

        if (! $student) {
            return $this->failNotFound("Student with ID {$id} not found.");
        }

        return $this->respond([
            'status'  => 200,
            'message' => 'Student retrieved successfully.',
            'data'    => $student,
        ]);
    }

    // POST /api/students
    public function create()
    {
        $data = $this->request->getJSON(true) ?? $this->request->getPost();

        if (! $this->validate($this->model->validationRules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $id = $this->model->insert($data);

        return $this->respondCreated([
            'status'  => 201,
            'message' => 'Student created successfully.',
            'data'    => $this->model->find($id),
        ]);
    }

    // PUT /api/students/{id}
    public function update($id = null)
    {
        $student = $this->model->find($id);

        if (! $student) {
            return $this->failNotFound("Student with ID {$id} not found.");
        }

        $data = $this->request->getJSON(true) ?? $this->request->getRawInput();

        if (! $this->validate($this->model->validationRules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $this->model->update($id, $data);

        return $this->respond([
            'status'  => 200,
            'message' => 'Student updated successfully.',
            'data'    => $this->model->find($id),
        ]);
    }

    // DELETE /api/students/{id}
    public function delete($id = null)
    {
        $student = $this->model->find($id);

        if (! $student) {
            return $this->failNotFound("Student with ID {$id} not found.");
        }

        $this->model->delete($id); // soft delete

        return $this->respondDeleted([
            'status'  => 200,
            'message' => "Student ID {$id} soft-deleted successfully.",
        ]);
    }
}
