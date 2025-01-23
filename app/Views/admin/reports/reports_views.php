<?= $this->extend('admin/template/main_template'); ?>
<?= $this->section('content'); ?>

<div class="col-md-12 py-5">
    <div class="card shadow">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <div>
                <h4 class="card-title mb-0 text-white">Laporan</h4>
            </div>
            <div class="text-right">
                <small>Dokumen Dibuat</small><br>
                <small><?= date('d/m/Y') ?></small>
            </div>
        </div>
        <div class="card-body">
            <form action="<?= base_url('dashboard/reports/generate') ?>" method="post" class="needs-validation" novalidate>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="month" class="font-weight-bold">
                                <i class="fas fa-calendar-alt"></i> Bulan
                            </label>
                            <select class="form-control form-control-lg" id="month" name="month" required>
                                <?php 
                                $bulan = [
                                    1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                                    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                                ];
                                for ($m = 1; $m <= 12; $m++): ?>
                                    <option value="<?= $m ?>" <?= date('n') == $m ? 'selected' : '' ?>><?= $bulan[$m] ?></option>
                                <?php endfor; ?>
                            </select>   
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="year" class="font-weight-bold">
                                <i class="fas fa-calendar-year"></i> Tahun
                            </label>
                            <select class="form-control form-control-lg" id="year" name="year" required>
                                <?php for ($y = date('Y'); $y >= 2000; $y--): ?>
                                    <option value="<?= $y ?>"><?= $y ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success btn-lg px-5">
                        <i class="fas fa-print mr-2"></i> Cetak Laporan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Form validation
(function() {
    'use strict';
    window.addEventListener('load', function() {
        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();
</script>

<?= $this->endSection(); ?>