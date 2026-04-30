<?php

namespace App\Controllers;

use App\Models\StudentModel;
use CodeIgniter\Controller;

class Students extends BaseController
{
    protected StudentModel $model;

    public function __construct()
    {
        $this->model = new StudentModel();
    }

    // ─────────────────────────────────────────
    // INDEX — List with Search + Pagination
    // ─────────────────────────────────────────
    public function index(): string
    {
        $keyword = $this->request->getGet('q');
        $perPage = 10;

        if ($keyword) {
            $students   = $this->model->search($keyword);
            $pager      = null;
            $total      = count($students);
        } else {
            $students   = $this->model->paginate($perPage);
            $pager      = $this->model->pager;
            $total      = $this->model->countAllResults();
        }

        return view('students/index', [
            'students' => $students,
            'pager'    => $pager,
            'keyword'  => $keyword ?? '',
            'total'    => $total,
        ]);
    }

    // ─────────────────────────────────────────
    // CREATE — Show Form
    // ─────────────────────────────────────────
    public function create(): string
    {
        return view('students/create', [
            'validation' => \Config\Services::validation(),
        ]);
    }

    // ─────────────────────────────────────────
    // STORE — Save New Record
    // ─────────────────────────────────────────
    public function store()
    {
        $rules = $this->model->validationRules;

        // Unique email check on insert
        $rules['email'] .= '|is_unique[students.email]';

        if (! $this->validate($rules)) {
            return view('students/create', [
                'validation' => $this->validator,
            ]);
        }

        $this->model->insert([
            'first_name' => $this->request->getPost('first_name'),
            'last_name'  => $this->request->getPost('last_name'),
            'email'      => $this->request->getPost('email'),
            'course'     => $this->request->getPost('course'),
            'year_level' => $this->request->getPost('year_level'),
        ]);

        return redirect()->to('/students')->with('success', 'Student added successfully.');
    }

    // ─────────────────────────────────────────
    // EDIT — Show Edit Form
    // ─────────────────────────────────────────
    public function edit(int $id): string
    {
        $student = $this->model->find($id);

        if (! $student) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Student not found.');
        }

        return view('students/edit', [
            'student'    => $student,
            'validation' => \Config\Services::validation(),
        ]);
    }

    // ─────────────────────────────────────────
    // UPDATE — Save Changes
    // ─────────────────────────────────────────
    public function update(int $id)
    {
        $student = $this->model->find($id);

        if (! $student) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Student not found.');
        }

        $rules = $this->model->validationRules;
        $rules['email'] .= "|is_unique[students.email,id,{$id}]";

        if (! $this->validate($rules)) {
            return view('students/edit', [
                'student'    => $student,
                'validation' => $this->validator,
            ]);
        }

        $this->model->update($id, [
            'first_name' => $this->request->getPost('first_name'),
            'last_name'  => $this->request->getPost('last_name'),
            'email'      => $this->request->getPost('email'),
            'course'     => $this->request->getPost('course'),
            'year_level' => $this->request->getPost('year_level'),
        ]);

        return redirect()->to('/students')->with('success', 'Student updated successfully.');
    }

    // ─────────────────────────────────────────
    // DELETE — Soft Delete
    // ─────────────────────────────────────────
    public function delete(int $id)
    {
        $student = $this->model->find($id);

        if (! $student) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Student not found.');
        }

        // useSoftDeletes = true → sets deleted_at, does NOT remove the row
        $this->model->delete($id);

        return redirect()->to('/students')->with('success', 'Student deleted (soft delete).');
    }
}
