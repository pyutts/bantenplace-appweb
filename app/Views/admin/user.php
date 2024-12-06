<?= $this->extend('admin/template/main_template'); ?>

<?= $this->section('content'); ?>
<div class="col-md-12 mx-auto py-5">
							<div class="card">
								<div class="card-header">
									<div class="d-flex align-items-center">
										<h4 class="card-title">Daftar User</h4>
										
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<div id="add-row_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"><div class="dataTables_length" id="add-row_length"><label>Show <select name="add-row_length" aria-controls="add-row" class="form-control form-control-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div></div><div class="col-sm-12 col-md-6"><div id="add-row_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="add-row"></label></div></div></div><div class="row"><div class="col-sm-12"><table id="add-row" class="display table table-striped table-hover dataTable" role="grid" aria-describedby="add-row_info">
											<thead>
												<tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="add-row" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 139.078px;">Name</th><th class="sorting" tabindex="0" aria-controls="add-row" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 208.719px;">Position</th><th class="sorting" tabindex="0" aria-controls="add-row" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 105.922px;">Office</th><th style="width: 126.281px;" class="sorting" tabindex="0" aria-controls="add-row" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending">Action</th></tr>
											</thead>											
											<tr role="row" class="odd">
													<td class="sorting_1"></td>
													<td></td>
													<td></td>
													<td>
														<div class="form-button-action">
															<button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
																<i class="fa fa-edit"></i>
															</button>
															<button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove">
																<i class="fa fa-times"></i>
															</button>
														</div>
													</td>
                                            </tbody>
										</table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-5">
                                    <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
											<i class="fa fa-plus"></i>
											Tambah
										</button>
										<button class="btn btn-success btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
											<i class="fa fa-plus"></i>
											Edit
										</button>
										<button class="btn btn-danger btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
											<i class="fa fa-trash"></i>
											Delete
										</button>
                                    </div>
                                    <div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="add-row_paginate">
                                        <ul class="pagination">
                                            <li class="paginate_button page-item previous disabled" id="add-row_previous">
                                            <a href="#" aria-controls="add-row" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
                                            </li>
                                        <li class="paginate_button page-item active"><a href="#" aria-controls="add-row" data-dt-idx="1" tabindex="0" class="page-link">1</a>
                                    </li>
                                    <li class="paginate_button page-item "><a href="#" aria-controls="add-row" data-dt-idx="2" tabindex="0" class="page-link">2</a></li><li class="paginate_button page-item next" id="add-row_next"><a href="#" aria-controls="add-row" data-dt-idx="3" tabindex="0" class="page-link">Next</a></li></ul></div></div></div></div>
									</div>
								</div>
							</div> 
						</div>
<?= $this->endSection(); ?>