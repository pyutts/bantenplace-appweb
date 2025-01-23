<?= $this->extend('homepages/templates/main_template') ?>

<?= $this->section('content'); ?>

<style>
    .pagination {
    margin: 0;
    padding: 0;
    }

    .pagination .page-item {
        margin: 0 2px;
    }

    .pagination .page-link {
        border-radius: 4px !important;
        padding: 8px;
        transition: all 0.3s ease;
    }

    .pagination .page-link:hover {
        background-color: #198754 !important;
        color: white !important;
    }

    .pagination .active .page-link {
        background-color: #198754;
        color: white;
    }
</style>

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Produk Kami</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="<?= base_url('/homes');?>">Beranda</a></li>
        <li class="breadcrumb-item active text-white">Shop</li>
    </ol>
</div>
<!-- Single Page Header End -->

<!-- Fruits Shop Start-->
<div class="container-fluid fruite py-5">
    <div class="container py-5">
        <h1 class="mb-4">Bantenplace Shop</h1>
        <div class="row g-4">
            <div class="col-lg-12">
                <div class="row g-4">
                    <!-- Search dan Sort -->
                    <div class="col-xl-3">
                        <div class="input-group w-100 mx-auto d-flex mb-3">
                            <input type="search" class="form-control p-3" id="searchInput" 
                                   placeholder="Cari Produk..." value="<?= esc($searchTerm); ?>">
                            <span class="input-group-text p-3"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                    <div class="col-6"></div>
                    <div class="col-xl-3">
                        <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between">
                            <label for="sortOrder">Sorting Harga:</label>
                            <select id="sortOrder" class="border-0 form-select-sm bg-light me-3">
                                <option value="asc" <?= $currentSort == 'asc' ? 'selected' : '' ?>>
                                    Harga Terendah
                                </option>
                                <option value="desc" <?= $currentSort == 'desc' ? 'selected' : '' ?>>
                                    Harga Tertinggi
                                </option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row g-4 mt-3">
                    <!-- Kategori Sidebar -->
                    <div class="col-lg-3">
                        <div class="mb-3">
                            <h4>Kategori</h4>
                            <ul class="list-unstyled fruite-categorie">
                                <?php foreach ($categories as $category): ?>
                                    <li>
                                        <div class="d-flex justify-content-between fruite-name">
                                            <a href="#" class="category-link" data-category="<?= $category['id']; ?>">
                                                <?= esc($category['name']); ?>
                                            </a>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>

                    <!-- Products Grid -->
                    <div class="col-lg-9">
                        <div class="row g-4">
                            <?php foreach ($products as $product): ?>
                                <div class="col-md-6 col-lg-6 col-xl-4">
                                    <div class="rounded position-relative fruite-item">
                                        <div class="fruite-img">
                                            <img src="<?= base_url('uploads/products/' . $product['gambar_products']); ?>" 
                                                 class="img-fluid w-100 rounded-top" style="object-fit: cover; width: 400px; height: 350px;"
                                                 alt="<?= $product['name_products']; ?>">
                                        </div>

                                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                            <h4><?= esc($product['name_products']); ?></h4>
                                            <p><?= substr($product['description'], 0, 50) . '...'; ?></p>
                                            <div class="d-flex justify-content-between flex-lg-wrap">
                                                <p class="text-dark fs-5 fw-bold mb-0">
                                                    Rp <?= number_format($product['price'], 0, ',', '.'); ?>
                                                </p>
                                                <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary add-to-cart" 
                                                   data-product-id="<?= $product['id']; ?>">
                                                    <i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- Pagination -->
                        <div class="col-12">
                            <div class="pagination d-flex justify-content-center mt-5">
                                <?php if ($pager) : ?>
                                    <?= $pager->links() ?>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fruits Shop End-->


<script>
$(document).ready(function() {
    // Search functionality
    $('#searchInput').on('input', function() {
        let searchValue = $(this).val();
        let currentUrl = new URL(window.location.href);
        
        if (searchValue) {
            currentUrl.searchParams.set('search', searchValue);
        } else {
            currentUrl.searchParams.delete('search');
        }
        
        window.location.href = currentUrl.toString();
    });

    // Category filter
    $('.category-link').click(function(e) {
        e.preventDefault();
        let categoryId = $(this).data('category');
        let currentUrl = new URL(window.location.href);
        
        if (categoryId) {
            currentUrl.searchParams.set('category', categoryId);
        } else {
            currentUrl.searchParams.delete('category');
        }
        
        window.location.href = currentUrl.toString();
    });

    // Sort functionality
    $('#sortOrder').change(function() {
        let sortValue = $(this).val();
        let currentUrl = new URL(window.location.href);
        
        if (sortValue) {
            currentUrl.searchParams.set('sort', sortValue);
        } else {
            currentUrl.searchParams.delete('sort');
        }
        
        window.location.href = currentUrl.toString();
    });

    // Add to cart functionality
    $('.add-to-cart').click(function() {
        const productId = $(this).data('product-id');
        $.ajax({
            url: '<?= base_url('cart/add'); ?>',
            type: 'POST',
            data: { 
                product_id: productId,
                quantity: 1
            },
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Produk berhasil ditambahkan ke keranjang',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                } else {
                    Swal.fire({
                        title: 'Gagal!',
                        text: response.message || 'Gagal menambahkan produk ke keranjang',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            },
            error: function() {
                Swal.fire({
                    title: 'Error!',
                    text: 'Terjadi kesalahan sistem',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    });
});
</script>
<?php $this->endSection(); ?>