<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card rounded-0">
    <div class="card-header">
        <div class="d-flex w-100 justify-content-between">
            <div class="col-auto">
                <div class="card-title h4 mb-0 fw-bolder">Add New Employee</div>
            </div>
            <div class="col-auto">
                <a href="<?= base_url('Main/employees') ?>" class="btn btn btn-light bg-gradient border rounded-0"><i class="fa fa-angle-left"></i> Back to List</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <form action="<?= base_url('Main/employee_add') ?>" method="POST">
                <?php if($session->getFlashdata('error')): ?>
                    <div class="alert alert-danger rounded-0">
                        <?= $session->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>
                <?php if($session->getFlashdata('success')): ?>
                    <div class="alert alert-success rounded-0">
                        <?= $session->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>
                <div class="mb-3">
                    <label for="company_code" class="control-label">Company Code</label>
                    <input type="text" class="form-control rounded-0" id="company_code" name="company_code" autofocus placeholder="Company Code" value="<?= !empty($request->getPost('company_code')) ? $request->getPost('company_code') : '' ?>" required="required">
                </div>
                <div class="mb-3">
                    <label for="first_name" class="control-label">First Name</label>
                    <input type="text" class="form-control rounded-0" id="first_name" name="first_name" autofocus placeholder="wahyu" value="<?= !empty($request->getPost('first_name')) ? $request->getPost('first_name') : '' ?>" required="required">
                </div>
                <div class="mb-3">
                    <label for="middle_name" class="control-label">Middle Name</label>
                    <input type="text" class="form-control rounded-0" id="middle_name" name="middle_name" autofocus placeholder="(optional)" value="<?= !empty($request->getPost('middle_name')) ? $request->getPost('middle_name') : '' ?>" >
                </div>
                <div class="mb-3">
                    <label for="last_name" class="control-label">Last Name</label>
                    <input type="text" class="form-control rounded-0" id="last_name" name="last_name" autofocus placeholder="Smith" value="<?= !empty($request->getPost('last_name')) ? $request->getPost('last_name') : '' ?>" required="required">
                </div>
                <div class="mb-3">
                    <label for="department" class="control-label">Department</label>
                    <input type="text" class="form-control rounded-0" id="department" name="department" autofocus placeholder="Department" value="<?= !empty($request->getPost('department')) ? $request->getPost('department') : '' ?>" required="required">
                </div>
                <div class="mb-3">
                    <label for="position" class="control-label">Position</label>
                    <input type="text" class="form-control rounded-0" id="position" name="position" autofocus placeholder="Position" value="<?= !empty($request->getPost('position')) ? $request->getPost('position') : '' ?>" required="required">
                </div>
                
                <div class="d-grid gap-1">
                    <button class="btn rounded-0 btn-primary bg-gradient">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>