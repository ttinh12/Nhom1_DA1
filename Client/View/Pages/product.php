<div class="site-blocks-cover inner-page" data-aos="fade">
  <div class="container">
    <div class="row">
      <div class="col-md-6 ml-auto order-md-2 align-self-start">
        <div class="site-block-cover-content">
          <h2 class="sub-title">#Bộ Sưu Tập Mùa Hè Mới 2019</h2>
          <h1>Ưu Đãi Hàng Mới</h1>
          <p><a href="#" class="btn btn-black rounded-0">Mua Ngay</a></p>
        </div>
      </div>
      <div class="col-md-6 order-1 align-self-end">
        <img src="public/assets/images/banner-thoi-trang4.jpg" alt="Image" class="img-fluid">
      </div>
    </div>
  </div>
</div>

<div class="custom-border-bottom py-3">
  <div class="container">
    <div class="row">
      <div class="col-md-12 mb-0">
        <a href="index.html">Trang chủ</a>
        <span class="mx-2 mb-0">/</span>
        <strong class="text-black">Cửa hàng</strong>
      </div>
    </div>
  </div>
</div>

<div class="site-section">
  <div class="container">

    <div class="row mb-5">
      <div class="col-md-9 order-1">

        <div class="row align">
          <div class="col-md-12 mb-5">
            <div class="float-md-left">
              <h2 class="text-black h5">Tất cả sản phẩm</h2>
            </div>
            <div class="d-flex">

              <!-- Lọc -->
              <div class="dropdown mr-1 ml-md-auto">
                <button type="button" class="btn btn-white btn-sm dropdown-toggle px-4" data-toggle="dropdown">
                  Mới nhất
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="#">Nam</a>
                  <a class="dropdown-item" href="#">Nữ</a>
                  <a class="dropdown-item" href="#">Giày Dép</a>
                </div>
              </div>

              <!-- Sắp xếp -->
              <div class="btn-group">
                <button type="button" class="btn btn-white btn-sm dropdown-toggle px-4" data-toggle="dropdown">
                  Sắp xếp
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="#">Liên quan</a>
                  <a class="dropdown-item" href="#">Tên A → Z</a>
                  <a class="dropdown-item" href="#">Tên Z → A</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Giá thấp → cao</a>
                  <a class="dropdown-item" href="#">Giá cao → thấp</a>
                </div>
              </div>

            </div>
          </div>
        </div>

        <!-- PRODUCT -->
        <div class="row mb-5">
          <?php if (!empty($products)): ?>
            <?php foreach ($products as $item): ?>

              <div class="col-lg-4 col-md-6 item-entry mb-4">

                <a href="#" class="product-item md-height bg-gray d-block">
                  <img src="public/assets/images/<?php echo $item['images']; ?>" class="img-fluid">
                </a>

                <h2 class="item-title">
                  <a href="#"><?php echo $item['name']; ?></a>
                </h2>

                <strong class="item-price">
                  <?php echo number_format($item['base_price']); ?> VND
                </strong>

                <div class="mt-3 d-flex gap-2">

                  <form action="index.php?act=addtocart" method="post" class="w-50">
                    <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                    <button type="submit" class="btn btn-outline-dark btn-sm w-100">
                      Thêm giỏ
                    </button>
                  </form>

                  <form action="index.php?act=buynow" method="post" class="w-50">
                    <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                    <button type="submit" class="btn btn-dark btn-sm w-100">
                      Mua ngay
                    </button>
                  </form>

                </div>

              </div>

            <?php endforeach; ?>
          <?php else: ?>
            <p>Không có sản phẩm</p>
          <?php endif; ?>
        </div>

        <!-- PAGINATION -->
        <div class="row">
          <div class="col-md-12 text-center">
            <div class="site-block-27">
              <ul>
                <li><a href="#">&lt;</a></li>
                <li class="active"><span>1</span></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">&gt;</a></li>
              </ul>
            </div>
          </div>
        </div>

      </div>

      <!-- SIDEBAR -->
      <div class="col-md-3 order-2 mb-5 mb-md-0">

        <div class="border p-4 rounded mb-4">
          <h3 class="mb-3 h6 text-uppercase text-black d-block">Danh mục</h3>
          <ul class="list-unstyled mb-0">
            <li><a href="#">Nam</a></li>
            <li><a href="#">Nữ</a></li>
            <li><a href="#">Giày Dép</a></li>
          </ul>
        </div>

        <div class="border p-4 rounded mb-4">

          <h3 class="mb-3 h6 text-uppercase text-black d-block">Lọc theo giá</h3>

          <h3 class="mb-3 h6 text-uppercase text-black d-block">Kích thước</h3>
          <label><input type="checkbox"> Nhỏ</label>
          <label><input type="checkbox"> Trung bình</label>
          <label><input type="checkbox"> Lớn</label>

          <h3 class="mb-3 h6 text-uppercase text-black d-block">Màu sắc</h3>
          <p>Đỏ, Xanh lá, Xanh dương, Tím</p>

        </div>

      </div>

    </div>
  </div>
</div>

<!-- COLLECTION -->
<div class="site-section">
  <div class="container">
    <div class="title-section mb-5">
      <h2 class="text-uppercase">
        <span class="d-block">Khám phá</span> Bộ sưu tập
      </h2>
    </div>

    <div class="row align-items-stretch">
      <div class="col-lg-8">
        <div class="product-item sm-height full-height bg-gray">
          <a href="#" class="product-category">Thời trang nữ <span>25 sản phẩm</span></a>
          <img src="public/assets/images/Banner4.jpg" class="img-fluid">
        </div>
      </div>

      <div class="col-lg-4">
        <div class="product-item sm-height bg-gray mb-4">
          <a href="#" class="product-category">Váy <span>25 sản phẩm</span></a>
          <img src="public/assets/images/Banner5.jpg" class="img-fluid">
        </div>

        <div class="product-item sm-height bg-gray">
          <a href="#" class="product-category">Giày dép <span>25 sản phẩm</span></a>
          <img src="public/assets/images/Banner6.jpg" class="img-fluid">
        </div>
      </div>
    </div>
  </div>
</div>