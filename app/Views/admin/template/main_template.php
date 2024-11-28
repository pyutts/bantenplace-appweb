<?= $this->include('admin/template/header'); ?>
<?= $this->include('admin/template/sidebar'); ?>
<div class="main-panel">
    <div class="content">
        <?= $this->renderSection('content'); ?>
    </div>
</div>
<?= $this->include('admin/template/footer'); ?>
