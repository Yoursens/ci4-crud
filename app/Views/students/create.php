<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-lg-7 col-md-9">

        <div class="card shadow-sm border-0">
            <div class="card-header-custom">
                <h5 class="mb-0"><i class="bi bi-person-plus-fill me-2"></i>Add New Student</h5>
                <small class="opacity-75">Fill in all required fields</small>
            </div>

            <div class="card-body p-4">
                <form action="<?= base_url('/students/store') ?>" method="post" novalidate>
                    <?= csrf_field() ?>

                    <div class="row g-3">
                        <!-- First Name -->
                        <div class="col-sm-6">
                            <label for="first_name" class="form-label fw-semibold">
                                First Name <span class="text-danger">*</span>
                            </label>
                            <input
                                type="text"
                                id="first_name"
                                name="first_name"
                                class="form-control <?= isset($validation) && $validation->hasError('first_name') ? 'is-invalid' : '' ?>"
                                value="<?= old('first_name') ?>"
                                placeholder="e.g. Juan">
                            <?php if (isset($validation) && $validation->hasError('first_name')): ?>
                                <div class="invalid-feedback"><?= $validation->getError('first_name') ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- Last Name -->
                        <div class="col-sm-6">
                            <label for="last_name" class="form-label fw-semibold">
                                Last Name <span class="text-danger">*</span>
                            </label>
                            <input
                                type="text"
                                id="last_name"
                                name="last_name"
                                class="form-control <?= isset($validation) && $validation->hasError('last_name') ? 'is-invalid' : '' ?>"
                                value="<?= old('last_name') ?>"
                                placeholder="e.g. dela Cruz">
                            <?php if (isset($validation) && $validation->hasError('last_name')): ?>
                                <div class="invalid-feedback"><?= $validation->getError('last_name') ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- Email -->
                        <div class="col-12">
                            <label for="email" class="form-label fw-semibold">
                                Email Address <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    class="form-control <?= isset($validation) && $validation->hasError('email') ? 'is-invalid' : '' ?>"
                                    value="<?= old('email') ?>"
                                    placeholder="student@school.edu.ph">
                                <?php if (isset($validation) && $validation->hasError('email')): ?>
                                    <div class="invalid-feedback"><?= $validation->getError('email') ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Course -->
                        <div class="col-sm-8">
                            <label for="course" class="form-label fw-semibold">
                                Course <span class="text-danger">*</span>
                            </label>
                            <select
                                id="course"
                                name="course"
                                class="form-select <?= isset($validation) && $validation->hasError('course') ? 'is-invalid' : '' ?>">
                                <option value="">— Select Course —</option>
                                <?php
                                $courses = ['BSIT','BSCS','BSIS','BSCpE','BSCE','BSEE','BSME','BSBA','BSED','BSN'];
                                $oldCourse = old('course');
                                foreach ($courses as $c):
                                ?>
                                    <option value="<?= $c ?>" <?= $oldCourse === $c ? 'selected' : '' ?>><?= $c ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?php if (isset($validation) && $validation->hasError('course')): ?>
                                <div class="invalid-feedback"><?= $validation->getError('course') ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- Year Level -->
                        <div class="col-sm-4">
                            <label for="year_level" class="form-label fw-semibold">
                                Year Level <span class="text-danger">*</span>
                            </label>
                            <select
                                id="year_level"
                                name="year_level"
                                class="form-select <?= isset($validation) && $validation->hasError('year_level') ? 'is-invalid' : '' ?>">
                                <option value="">— Year —</option>
                                <?php for ($y = 1; $y <= 5; $y++): ?>
                                    <option value="<?= $y ?>" <?= old('year_level') == $y ? 'selected' : '' ?>>
                                        <?= $y ?><?= ['st','nd','rd','th','th'][$y-1] ?> Year
                                    </option>
                                <?php endfor; ?>
                            </select>
                            <?php if (isset($validation) && $validation->hasError('year_level')): ?>
                                <div class="invalid-feedback"><?= $validation->getError('year_level') ?></div>
                            <?php endif; ?>
                        </div>
                    </div><!-- /row -->

                    <hr class="my-4">

                    <div class="d-flex gap-2 justify-content-end">
                        <a href="<?= base_url('/students') ?>" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-1"></i>Cancel
                        </a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-save me-1"></i>Save Student
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<?= $this->endSection() ?>
