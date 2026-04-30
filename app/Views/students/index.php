<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="card shadow-sm border-0">
    <div class="card-header-custom d-flex align-items-center justify-content-between">
        <div>
            <h5 class="mb-0"><i class="bi bi-people-fill me-2"></i>Student List</h5>
            <small class="opacity-75">Total: <?= $total ?> student<?= $total !== 1 ? 's' : '' ?></small>
        </div>
        <a href="<?= base_url('/students/create') ?>" class="btn btn-light btn-sm fw-semibold">
            <i class="bi bi-person-plus me-1"></i> Add Student
        </a>
    </div>

    <div class="card-body p-0">

        <!-- Search Form -->
        <div class="px-4 pt-4 pb-2">
            <form method="get" action="<?= base_url('/students') ?>" class="row g-2 align-items-center">
                <div class="col-sm-8 col-md-6">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="bi bi-search text-muted"></i>
                        </span>
                        <input
                            type="text"
                            name="q"
                            class="form-control border-start-0 ps-0"
                            placeholder="Search by name, email or course…"
                            value="<?= esc($keyword) ?>">
                    </div>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary btn-sm px-3">
                        <i class="bi bi-search me-1"></i>Search
                    </button>
                    <?php if ($keyword): ?>
                        <a href="<?= base_url('/students') ?>" class="btn btn-outline-secondary btn-sm px-3 ms-1">
                            <i class="bi bi-x me-1"></i>Clear
                        </a>
                    <?php endif; ?>
                </div>
            </form>

            <?php if ($keyword): ?>
                <p class="text-muted small mt-2 mb-0">
                    Showing results for <strong>"<?= esc($keyword) ?>"</strong>
                    — <?= $total ?> record<?= $total !== 1 ? 's' : '' ?> found
                </p>
            <?php endif; ?>
        </div>

        <!-- Table -->
        <div class="table-responsive px-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light border-top">
                    <tr>
                        <th class="ps-4" style="width:50px">#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Course</th>
                        <th style="width:100px">Year</th>
                        <th style="width:80px">Added</th>
                        <th class="text-center pe-4" style="width:160px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($students)): ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted py-5">
                                <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                <?= $keyword ? 'No students matched your search.' : 'No students found. Add one!' ?>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($students as $i => $s): ?>
                        <tr>
                            <td class="ps-4 text-muted small"><?= $i + 1 ?></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="rounded-circle bg-primary text-white d-flex align-items-center
                                                justify-content-center fw-bold"
                                         style="width:36px;height:36px;font-size:.8rem;flex-shrink:0">
                                        <?= strtoupper(substr($s['first_name'], 0, 1) . substr($s['last_name'], 0, 1)) ?>
                                    </div>
                                    <div>
                                        <div class="fw-semibold"><?= esc($s['first_name'] . ' ' . $s['last_name']) ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-muted small"><?= esc($s['email']) ?></td>
                            <td><?= esc($s['course']) ?></td>
                            <td>
                                <?php
                                    $labels = ['','1st Year','2nd Year','3rd Year','4th Year','5th Year'];
                                    $colors = ['','primary','success','warning','danger','secondary'];
                                    $yr = (int)$s['year_level'];
                                ?>
                                <span class="badge bg-<?= $colors[$yr] ?? 'secondary' ?> badge-year">
                                    <?= $labels[$yr] ?? 'Year '.$yr ?>
                                </span>
                            </td>
                            <td class="text-muted small">
                                <?= date('M d', strtotime($s['created_at'])) ?>
                            </td>
                            <td class="text-center pe-4">
                                <a href="<?= base_url('/students/edit/' . $s['id']) ?>"
                                   class="btn btn-sm btn-warning px-2 py-1"
                                   title="Edit">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <a href="<?= base_url('/students/delete/' . $s['id']) ?>"
                                   class="btn btn-sm btn-danger px-2 py-1 ms-1"
                                   title="Delete"
                                   onclick="return confirm('Soft-delete this student?')">
                                    <i class="bi bi-trash-fill"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <?php if ($pager && ! $keyword): ?>
            <div class="d-flex justify-content-between align-items-center px-4 py-3 border-top">
                <span class="text-muted small">Showing 10 per page</span>
                <nav>
                    <?= $pager->links('default', 'bootstrap_pagination') ?>
                </nav>
            </div>
        <?php endif; ?>

    </div><!-- /card-body -->
</div>

<?= $this->endSection() ?>
