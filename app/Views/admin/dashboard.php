<?= $this->extend('admin/template/main_template'); ?>

<?= $this->section('content'); ?>
		<div class="col-md-12 py-5">
			<div class="page-inner mt--5">
			</br><h1>Dashboard</h1></br>
				<div class="row row-card-no-pd mt--2">
					<div class="col-sm-6 col-md-3">
						<div class="card card-stats card-round">
							<div class="card-body">
								<div class="row">
									<div class="col-5">
										<div class="icon-big text-center">
											<i class="fas fa-shopping-cart text-success"></i>
										</div>
									</div>
									<div class="col-7 col-stats">
										<div class="numbers">
											<p class="card-category">Total Pesanan</p>
											<h4 class="card-title"><?= $total_orders ?></h4>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-3">
						<div class="card card-stats card-round">
							<div class="card-body">
								<div class="row">
									<div class="col-5">
										<div class="icon-big text-center">
											<i class="fas fa-users text-warning"></i>
										</div>
									</div>
									<div class="col-7 col-stats">
										<div class="numbers">
											<p class="card-category">Total Users</p>
											<h4 class="card-title"><?= $total_users ?></h4>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-3">
						<div class="card card-stats card-round">
							<div class="card-body">
								<div class="row">
									<div class="col-5">
										<div class="icon-big text-center">
											<i class="fas fa-box text-primary"></i>
										</div>
									</div>
									<div class="col-7 col-stats">
										<div class="numbers">
											<p class="card-category">Total Produk</p>
											<h4 class="card-title"><?= $total_products ?></h4>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-3">
						<div class="card card-stats card-round">
							<div class="card-body">
								<div class="row">
									<div class="col-5">
										<div class="icon-big text-center">
											<i class="fas fa-money-bill text-success"></i>
										</div>
									</div>
									<div class="col-7 col-stats">
										<div class="numbers">
											<p class="card-category">Pendapatan Bulan Ini</p>
											<h4 class="card-title">Rp <?= number_format($monthly_income, 0, ',', '.') ?></h4>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row mt-4">
					<div class="col-md-6">
						<div class="card">
							<div class="card-header">
								<div class="card-title">Pesanan Terbaru</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-hover">
										<thead>
											<tr>
												<th>ID</th>
												<th>Tanggal</th>
												<th>Status</th>
												<th>Total</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($recent_orders as $order): ?>
											<tr>
												<td><?= $order['id'] ?></td>
												<td><?= date('d/m/Y', strtotime($order['order_date'])) ?></td>
												<td>
													<span class="badge badge-<?= $order['status'] == 'pending' ? 'warning' : 'success' ?>">
														<?= ucfirst($order['status']) ?>
													</span>
												</td>
												<td>Rp <?= number_format($order['total_amount'], 0, ',', '.') ?></td>
											</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="card">
							<div class="card-header">
								<div class="card-title">Stok Menipis</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-hover">
										<thead>
											<tr>
												<th>Produk</th>
												<th>Stok</th>
												<th>Status</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($low_stock_products as $product): ?>
											<tr>
												<td><?= $product['name_products'] ?></td>
												<td><?= $product['stock'] ?></td>
												<td>
													<span class="badge badge-danger">Stok Rendah</span>
												</td>
											</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
<?= $this->endSection(); ?>
