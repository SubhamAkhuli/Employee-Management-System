<?= $this->extend('layouts/main') ?>
<?= $this->section('title') ?>Edit Employee<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-white py-3">
                    <h3 class="card-title fw-bold text-primary mb-0">Edit Employee</h3>
                </div>
                <div class="card-body p-4">
                    <?php if(session()->getFlashdata('errors')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                <p class="mb-0"><i class="bi bi-exclamation-circle me-2"></i><?= $error ?></p>
                            <?php endforeach; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    
                    <form method="post" action="<?= site_url('employee/update/' . $employee['id']) ?>" enctype="multipart/form-data" class="needs-validation" novalidate>
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label fw-semibold">Name</label>
                                <input type="text" name="name" class="form-control form-control-lg" value="<?= esc(old('name', $employee['name'])) ?>" required>
                                <div class="invalid-feedback">Please enter employee name</div>
                            </div>
                            
                            <div class="col-12">
                                <label class="form-label fw-semibold">Address</label>
                                <textarea name="address" class="form-control" rows="3" required><?= esc(old('address', $employee['address'])) ?></textarea>
                                <div class="invalid-feedback">Please enter address</div>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Designation</label>
                                <input type="text" name="designation" class="form-control" value="<?= esc(old('designation', $employee['designation'])) ?>" required>
                                <div class="invalid-feedback">Please enter designation</div>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Salary</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" step="0.01" name="salary" class="form-control" value="<?= esc(old('salary', $employee['salary'])) ?>" required>
                                    <div class="invalid-feedback">Please enter valid salary</div>
                                </div>
                            </div>
                            
                            <div class="col-12 mt-4">
                                <label class="form-label fw-semibold">Profile Picture</label>
                                <?php if($employee['picture']): ?>
                                    <div class="mb-3">
                                        <div class="position-relative d-inline-block">
                                            <img src="<?= base_url('uploads/' . $employee['picture']) ?>" 
                                                class="rounded-3 border img-thumbnail" style="max-height:150px" alt="Employee Photo">
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="input-group mb-3">
                                    <input type="file" name="picture" class="form-control" accept="image/*" id="pictureInput">
                                    <label class="input-group-text" for="pictureInput">Upload</label>
                                </div>
                                <small class="text-muted">Leave blank to keep current image</small>
                            </div>
                            
                            <div class="col-12 mt-4 d-flex justify-content-between">
                                <a href="<?= site_url('employees') ?>" class="btn btn-outline-secondary px-4">
                                    <i class="bi bi-arrow-left me-2"></i>Back
                                </a>
                                <button type="submit" class="btn btn-primary px-4 py-2">
                                    <i class="bi bi-save me-2"></i>Update Employee
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
// Add client-side form validation
document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('.needs-validation');
    Array.prototype.slice.call(forms).forEach(function(form) {
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });
});
</script>
<?= $this->endSection() ?>