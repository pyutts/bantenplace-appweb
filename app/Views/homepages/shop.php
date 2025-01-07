<?= $this->extend('homepages/templates/main_template'); ?>

<?= $this->section('content'); ?>
<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Shop</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="<?= base_url('/user');?>">Beranda</a></li>
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
                    <div class="col-xl-3">
                        <form id="filterForm" action="<?= base_url('shop'); ?>" method="get">
                            <input type="hidden" name="hash" id="hashInput">
                            <div class="input-group w-100 mx-auto d-flex">
                                <input type="search" class="form-control p-3" id="searchInput" name="xptdk" placeholder="Cari Produk..." value="<?= esc($searchTerm); ?>" aria-describedby="search-icon-1">
                                <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                            </div>
                            <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between mb-4">
                                <label for="category_id">Kategori:</label>
                                <select id="category_id" name="shop_cate" class="border-0 form-select-sm bg-light me-3">
                                    <option value="">Semua Kategori</option>
                                    <?php foreach ($categories as $category): ?>
                                    <option value="<?= $category['id']; ?>" <?= $categoryId == $category['id'] ? 'selected' : '' ?>><?= esc($category['name']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </form>
                    </div>
                    <div class="col-6"></div>
                    <div class="col-xl-3">
                        <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between mb-4">
                            <label for="sortKategori">Sorting Harga:</label>
                            <select id="sortKategori" name="sort_order" class="border-0 form-select-sm bg-light me-3" onchange="document.getElementById('filterForm').submit()">
                                <option value="asc" <?= $sortOrder == 'asc' ? 'selected' : '' ?>>Harga Terendah</option>
                                <option value="desc" <?= $sortOrder == 'desc' ? 'selected' : '' ?>>Harga Tertinggi</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-lg-3">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <h4>Kategori</h4>
                                    <ul class="list-unstyled fruite-categorie">
                                     
                                        <?php foreach ($categories as $category): ?>
                                        <li>
                                            <div class="d-flex justify-content-between fruite-name">
                                                <a href="#" class="category-link" data-category="<?= $category['id']; ?>"><?= esc($category['name']); ?></a>
                                            </div>
                                        </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <h4 class="mb-2">Price</h4>
                                    <input type="range" class="form-range w-100" id="rangeInput" name="rangeInput" min="0" max="500" value="0" oninput="amount.value=rangeInput.value">
                                    <output id="amount" name="amount" min-velue="0" max-value="500" for="rangeInput">0</output>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <!-- Sorting Produk -->
                        <div class="row g-4 justify-content-center" id="productContainer">
                            <?php foreach ($products as $product): ?>
                            <div class="col-md-6 col-lg-6 col-xl-4">
                                <div class="rounded position-relative fruite-item" data-category="<?= $product['category_id']; ?>" data-price="<?= $product['price']; ?>">
                                    <div class="fruite-img">
                                        <img src="<?= base_url('uploads/products/' . $product['gambar_products']); ?>" class="img-fluid w-100 rounded-top" alt="">
                                    </div>
                                    <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;"><?= esc($product['name_products']); ?></div>
                                    <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                        <h4><?= esc($product['name_products']); ?></h4>
                                        <p>
                                            <?php
                                                $text = $product['description'];
                                                $max_length = 100; 
                                                if (strlen($text) > $max_length) {
                                                    echo esc(substr($text, 0, $max_length)) . '...';
                                                } else {
                                                    echo esc($text);
                                                }
                                            ?>
                                        </p>
                                        <div class="d-flex justify-content-between flex-lg-wrap">
                                            <p class="text-dark fs-5 fw-bold mb-0">Rp.<?= number_format($product['price'], 0, ',', '.'); ?></p>
                                            <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <!-- End Sorting Produk -->
                        <div class="col-12">
                            <div class="pagination d-flex justify-content-center mt-5">
                                <?php if (isset($pager)) : ?>
                                    <?= $pager->links() ?>
                                <?php endif; ?>
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
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const categoryLinks = document.querySelectorAll('.category-link');
    const filterForm = document.getElementById('filterForm');
    const hashInput = document.getElementById('hashInput');

    // Update URL hash without reloading the page
    function updateHash(categoryId, searchTerm) {
        let hash = '';
        if (categoryId) {
            hash += `shop_cate=${categoryId}`;
        }
        if (searchTerm) {
            if (hash) {
                hash += '&';
            }
            hash += `xptdk=${searchTerm}`;
        }
        hashInput.value = hash;
        history.replaceState(null, null, `#${hash}`);
    }

    // Search input handler
    searchInput.addEventListener('input', function(e) {
        const searchTerm = e.target.value;
        updateHash(window.location.hash.split('shop_cate=')[1]?.split('&')[0], searchTerm);
    });

    // Category link handler
    categoryLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const categoryId = this.dataset.category;
            updateHash(categoryId, searchInput.value);
            filterForm.submit();
        });
    });

    // Initial load
    const hashParams = new URLSearchParams(window.location.hash.substring(1));
    const initialCategory = hashParams.get('shop_cate');
    const initialSearch = hashParams.get('xptdk');
    if (initialCategory) {
        document.getElementById('category_id').value = initialCategory;
    }
    if (initialSearch) {
        searchInput.value = initialSearch;
    }
});
</script>

<?= $this->endSection(); ?>