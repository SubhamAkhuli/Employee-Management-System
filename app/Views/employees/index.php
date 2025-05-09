<?= $this->extend('layouts/main') ?>
<?= $this->section('title') ?>Employee List<?= $this->endSection() ?>
<?= $this->section('content') ?>

<!-- Header Section with Search -->
<div class="container-fluid py-4">
    <div class="row g-3 align-items-center mb-4">
        <div class="col-12 col-md-6">
            <h2 class="fw-bold">Employee Directory</h2>
        </div>
        <div class="col-12 col-md-6">
            <div class="d-flex flex-column flex-md-row gap-2 justify-content-md-end">
                <div class="input-group" style="width: 300px !important;">
                    <input type="text" class="form-control" placeholder="Search employees..." id="searchInput">
                    <button class="btn btn-outline-secondary" type="button"><i class="bi bi-search"></i></button>
                </div>
                <a href="<?= site_url('employee/create') ?>" class="btn btn-success">
                    <i class="bi bi-person-plus-fill me-1"></i>Add Employee
                </a>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i><?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    
    <!-- Employee Cards for Mobile View -->
    <div class="d-md-none">
        <?php if (!empty($employees)): foreach ($employees as $emp): ?>
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <?php if ($emp['picture']): ?>
                            <div class="me-3">
                                <img src="<?= base_url('uploads/' . $emp['picture']) ?>" 
                                     class="rounded-circle" width="50" height="50" 
                                     alt="<?= esc($emp['name']) ?>" style="object-fit: fill;">
                            </div>
                        <?php endif; ?>
                        <div>
                            <h5 class="card-title mb-0"><?= esc($emp['name']) ?></h5>
                            <span class="badge bg-info"><?= esc($emp['designation']) ?></span>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush mb-3">
                        <li class="list-group-item"><strong>Address:</strong> <?= esc($emp['address']) ?></li>
                        <li class="list-group-item"><strong>Salary:</strong> <?= esc($emp['salary']) ?></li>
                    </ul>
                    <div class="d-flex gap-2">
                        <a href="<?= site_url('employee/edit/' . $emp['id']) ?>" class="btn btn-primary">
                            <i class="bi bi-pencil-fill me-1"></i>Edit
                        </a>
                        <a href="<?= site_url('employee/delete/' . $emp['id']) ?>" class="btn btn-danger" 
                           onclick="return confirm('Are you sure you want to delete this employee?')">
                            <i class="bi bi-trash-fill me-1"></i>Delete
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; else: ?>
            <div class="card shadow-sm">
                <div class="card-body text-center py-5">
                    <i class="bi bi-people fs-1 text-muted"></i>
                    <p class="mt-3">No employees found.</p>
                    <a href="<?= site_url('employee/create') ?>" class="btn btn-primary">Add First Employee</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
    
    <!-- Table for Desktop View -->
    <div class="d-none d-md-block">
        <div class="card shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Designation</th>
                            <th>Salary</th>
                            <th>Picture</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="employeeTableBody">
                    <?php if (!empty($employees)): foreach ($employees as $emp): ?>
                        <tr>
                            <td><?= esc($emp['id']) ?></td>
                            <td class="fw-medium"><?= esc($emp['name']) ?></td>
                            <td><?= esc($emp['address']) ?></td>
                            <td><span class="badge bg-info text-dark"><?= esc($emp['designation']) ?></span></td>
                            <td><?= esc($emp['salary']) ?></td>
                            <td>
                                <?php if ($emp['picture']): ?>
                                    <img src="<?= base_url('uploads/' . $emp['picture']) ?>" 
                                         class="rounded-circle image-preview-trigger" width="40" height="40" alt="Photo" 
                                         style="object-fit: fill; cursor: pointer;"
                                         data-bs-toggle="modal" data-bs-target="#imagePreviewModal"
                                         data-image-url="<?= base_url('uploads/' . $emp['picture']) ?>"
                                         data-employee-name="<?= esc($emp['name']) ?>">
                                <?php else: ?>
                                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" 
                                         style="width: 40px; height: 40px;">
                                        <i class="bi bi-person text-secondary"></i>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="<?= site_url('employee/edit/' . $emp['id']) ?>" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <a href="<?= site_url('employee/delete/' . $emp['id']) ?>" class="btn btn-sm btn-outline-danger" 
                                       onclick="return confirm('Are you sure you want to delete this employee?')">
                                        <i class="bi bi-trash-fill"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; else: ?>
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <i class="bi bi-people fs-1 text-muted d-block mb-2"></i>
                                No employees found.
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <?php if (!empty($employees) && count($employees) > 10): ?>
            <div class="card-footer">
                <nav aria-label="Employee pagination">
                    <ul class="pagination justify-content-center mb-0">
                        <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Image Preview -->
<div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-labelledby="imagePreviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imagePreviewModalLabel">Employee Picture</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="" id="imagePreview" class="img-fluid" alt="">
                <p id="employeeName" class="mt-2"></p>
            </div>
        </div>
    </div>
</div>

<!-- Simple JavaScript for search functionality -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('keyup', function() {
            const filter = searchInput.value.toLowerCase();
            const tableBody = document.getElementById('employeeTableBody');
            const rows = tableBody.getElementsByTagName('tr');
            
            for (let i = 0; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName('td');
                let found = false;
                
                for (let j = 0; j < cells.length; j++) {
                    const cellText = cells[j].textContent || cells[j].innerText;
                    if (cellText.toLowerCase().indexOf(filter) > -1) {
                        found = true;
                        break;
                    }
                }
                
                rows[i].style.display = found ? '' : 'none';
            }
        });
    }
    
    // Image preview modal functionality
    const imageTriggers = document.querySelectorAll('.image-preview-trigger');
    imageTriggers.forEach(function(trigger) {
        trigger.addEventListener('click', function() {
            const imageUrl = this.getAttribute('data-image-url');
            const employeeName = this.getAttribute('data-employee-name');
            
            document.getElementById('imagePreview').src = imageUrl;
            document.getElementById('employeeName').textContent = employeeName;
            
            const modal = new bootstrap.Modal(document.getElementById('imagePreviewModal'));
            modal.show();
        });
    });
});
</script>
<?= $this->endSection() ?>