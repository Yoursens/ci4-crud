<?php // Feature: Bootstrap UI - Implemented by Student 3 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CI4 Student System</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
          rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
          rel="stylesheet">

    <style>
        body { background-color: #f8f9fa; }
        .navbar-brand { font-weight: 700; letter-spacing: .5px; }
        .table th { font-weight: 600; font-size: .85rem; text-transform: uppercase;
                    letter-spacing: .05em; color: #6c757d; }
        .table td { vertical-align: middle; }
        .badge-year { font-size: .75rem; }
        .card-header-custom { background: linear-gradient(135deg,#0d6efd,#0a58ca);
                               color:#fff; border-radius: .5rem .5rem 0 0; padding:1rem 1.25rem; }
        footer { font-size: .82rem; color: #adb5bd; }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="<?= base_url('/students') ?>">
            <i class="bi bi-mortarboard-fill me-1"></i> CI4 Student System
        </a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('/students') ?>">
                        <i class="bi bi-people me-1"></i>Students
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('/students/create') ?>">
                        <i class="bi bi-person-plus me-1"></i>Add Student
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('/api/students') ?>" target="_blank">
                        <i class="bi bi-braces me-1"></i>REST API
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Flash Messages -->
<div class="container mt-3">
    <?php if (session()->has('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i>
            <?= session('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    <?php if (session()->has('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle me-1"></i>
            <?= session('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
</div>

<!-- Page Content -->
<div class="container my-4">
    <?= $this->renderSection('content') ?>
</div>

<!-- Footer -->
<footer class="text-center py-3 mt-auto border-top">
    <div class="container">
        CI4 Student System &mdash; Laboratory Exercise 4 &bull; BSIT | Advanced Web Development
    </div>
</footer>

<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
