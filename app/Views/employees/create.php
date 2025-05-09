<?= $this->extend('layouts/main') ?>
<?= $this->section('title') ?>Add Employee<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-gradient bg-primary text-white py-3">
                    <h3 class="card-title mb-0 fw-bold"><i class="bi bi-person-plus-fill me-2"></i>Add New Employee</h3>
                </div>
                <div class="card-body p-4">
                    <?php if(session()->getFlashdata('errors')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><i class="bi bi-exclamation-triangle-fill me-2"></i>Error!</strong>
                            <ul class="mb-0 mt-2">
                                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                    <li><?= $error ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    
                    <form method="post" action="<?= site_url('employee/store') ?>" enctype="multipart/form-data" class="needs-validation" novalidate>
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="name" class="form-label fw-semibold"><i class="bi bi-person me-1"></i>Full Name</label>
                                <input type="text" id="name" name="name" class="form-control form-control-lg" value="<?= old('name') ?>" required>
                                <div class="invalid-feedback">Please enter employee name</div>
                            </div>
                            
                            <div class="col-12">
                                <label for="address" class="form-label fw-semibold"><i class="bi bi-geo-alt me-1"></i>Address</label>
                                <textarea id="address" name="address" class="form-control" rows="3" required><?= old('address') ?></textarea>
                                <div class="invalid-feedback">Please enter address</div>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="designation" class="form-label fw-semibold"><i class="bi bi-briefcase me-1"></i>Designation</label>
                                <input type="text" id="designation" name="designation" class="form-control" value="<?= old('designation') ?>" required>
                                <div class="invalid-feedback">Please enter designation</div>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="salary" class="form-label fw-semibold"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-currency-rupee" viewBox="0 0 16 16">
                                <path d="M4 3.06h2.726c1.22 0 2.12.575 2.325 1.724H4v1.051h5.051C8.855 7.001 8 7.558 6.788 7.558H4v1.317L8.437 14h2.11L6.095 8.884h.855c2.316-.018 3.465-1.476 3.688-3.049H12V4.784h-1.345c-.08-.778-.357-1.335-.793-1.732H12V2H4z"/>
                                </svg>Salary</label>
                                <div class="input-group">
                                    <span class="input-group-text">₹</span>
                                    <input type="number" id="salary" step="0.01" name="salary" class="form-control" value="<?= old('salary') ?>" required>
                                    <div class="invalid-feedback">Please enter a valid salary</div>
                                </div>
                            </div>
                            
                            <div class="col-12 mt-3">
                                <label for="picture" class="form-label fw-semibold"><i class="bi bi-image me-1"></i>Profile Picture</label>
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control" id="picture" name="picture" accept="image/*" required>
                                    <label class="input-group-text" for="picture"><i class="bi bi-upload"></i></label>
                                </div>
                            </div>
                            
                            <div class="col-12 mt-4 d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="<?= site_url('employees') ?>" class="btn btn-outline-secondary btn-lg px-4">
                                    <i class="bi bi-x-circle me-2"></i>Cancel
                                </a>
                                <button type="submit" class="btn btn-primary btn-lg px-4">
                                    <i class="bi bi-save me-2"></i>Save Employee
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Enable Bootstrap form validation
(function () {
    'use strict'
    var forms = document.querySelectorAll('.needs-validation')
    Array.prototype.slice.call(forms).forEach(function (form) {
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }
            form.classList.add('was-validated')
        }, false)
    })
})()
</script>
<?= $this->endSection() ?>