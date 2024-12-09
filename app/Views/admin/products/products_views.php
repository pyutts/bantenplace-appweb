<?= $this->extend('admin/template/main_template'); ?>

<?= $this->section('content'); ?>
                <div class="col-md-12 py-5">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Daftar Users</h4>
                                <button class="btn btn-success btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                                    <i class="fa fa-plus"></i>
                                    Tambah Users
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Modal Add Formulir -->
                            <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header no-bd">
                                            <h5 class="modal-title">
                                                <span class="fw-mediumbold">New</span> 
                                                <span class="fw-light">Row</span>
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="small">Create a new row using this form, make sure you fill them all</p>
                                            <form>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group form-group-default">
                                                            <label>Name</label>
                                                            <input id="addName" type="text" class="form-control" placeholder="fill name">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 pr-0">
                                                        <div class="form-group form-group-default">
                                                            <label>Position</label>
                                                            <input id="addPosition" type="text" class="form-control" placeholder="fill position">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-group-default">
                                                            <label>Office</label>
                                                            <input id="addOffice" type="text" class="form-control" placeholder="fill office">
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer no-bd">
                                            <button type="button" id="addRowButton" class="btn btn-primary">Add</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end modal add formulir -->

                            <!-- Entri Data -->
                            <div class="table-responsive">
                                <div id="add-row_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="dataTables_length" id="add-row_length">
                                                <label>Tampilkan 
                                                    <select name="add-row_length" aria-controls="add-row" class="form-control form-control-sm">
                                                        <option value="10">10</option>
                                                        <option value="25">25</option>
                                                        <option value="50">50</option>
                                                        <option value="100">100</option>
                                                    </select> Entri
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6"><div id="add-row_filter" class="dataTables_filter">
                                            <label>Cari:
                                                <input type="search" class="form-control form-control-sm" placeholder="" aria-controls="add-row">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            <!-- End Entri Data -->

                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="add-row" class="display table table-striped table-hover dataTable" role="grid" aria-describedby="add-row_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="" tabindex="0" aria-controls="add-row" rowspan="1" colspan="1">Profil Gambar</th>
                                            <th class="" tabindex="0" aria-controls="add-row" rowspan="1" colspan="1">Nama</th>
                                            <th class="" tabindex="0" aria-controls="add-row" rowspan="1" colspan="1">Email</th>
                                            <th class="" tabindex="0" aria-controls="add-row" rowspan="1" colspan="1">Alamat</th>
                                            <th class="" tabindex="0" aria-controls="add-row" rowspan="1" colspan="1">No Telepon</th>
                                            <th class="" tabindex="0" aria-controls="add-row" rowspan="1" colspan="1">Kode Pos</th>
                                            <th class="" tabindex="0" aria-controls="add-row" rowspan="1" colspan="1">Rules</th>
                                            <th class="" tabindex="0" aria-controls="add-row" rowspan="1" colspan="1">Action</th>
                                        </tr>
                                    </thead>
                                        <tbody>
                                        <?php if (!empty($users) && is_array($users)): ?>
                                            <?php foreach ($users as $user): ?>
                                                <tr>
                                                    <td><img class="avatar-img rounded-circle" src="<?= base_url('uploads/' . $user['profil_gambar']) ?>" alt="profilmu" width="50"></td>
                                                    <td><?= $user['nama'] ?></td>
                                                    <td><?= $user['email'] ?></td>
                                                    <td><?= $user['alamat'] ?></td>
                                                    <td><?= $user['no_telepon'] ?></td>
                                                    <td><?= $user['kode_pos'] ?></td>
                                                    <td><?= $user['level'] ?></td>
                                                    <td>
                                                        <div class="form-button-action">
                                                            <button type="button" class="btn btn-link btn-primary btn-lg">
                                                                <i class="fa fa-edit"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-link btn-danger">
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="8" class="text-center">Tidak ada data pengguna</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-5">
                                <div class="dataTables_info" id="add-row_info" role="status" aria-live="polite">Tampilkan 1 dari 10 data</div>
                            </div>
                                <div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="add-row_paginate">
                                    <ul class="pagination">
                                        <li class="paginate_button page-item previous disabled" id="add-row_previous">
                                            <a href="#" aria-controls="add-row" data-dt-idx="0" tabindex="0" class="page-link">Sebelumnya</a>
                                        </li>
                                        <li class="paginate_button page-item active">
                                            <a href="#" aria-controls="add-row" data-dt-idx="1" tabindex="0" class="page-link">1</a>
                                        </li>
                                    <li class="paginate_button page-item next" id="add-row_next">
                                        <a href="#" aria-controls="add-row" data-dt-idx="3" tabindex="0" class="page-link">Selanjutnya</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>