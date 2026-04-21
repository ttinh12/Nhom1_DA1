<div class="site-blocks-cover" data-aos="fade">
  <div class="container">
    <div class="row">
      <div class="col-md-6 ml-auto order-md-2 align-self-center">
        <div class="site-block-cover-content">
          <h2 class="sub-title">#Bộ Sưu Tập Mùa Hè Mới 2019</h2>
          <h1>Sản Phẩm Mới Giảm Giá</h1>
          <p><a href="#" class="btn btn-black rounded-0">Mua Ngay</a></p>
        </div>
      </div>
      <div class="col-md-6 order-1 align-self-end">
        <img src="public/assets/images/banner-thoi-trang4.jpg" class="img-fluid" alt="Slider">
      </div>
    </div>
  </div>
</div>
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
          <a href="#" class="product-category">
            Nữ <span>25 sản phẩm</span>
          </a>
          <img src="public/assets/images/Banner1.jpg" alt="Image" class="img-fluid">
        </div>
      </div>
      <div class="col-lg-4">
        <div class="product-item sm-height bg-gray mb-4">
          <a href="#" class="product-category">
            Áo <span> sản phẩm</span>
          </a>
          <img src="public/assets/images/Banner2.jpg" alt="Image" class="img-fluid">
        </div>
        <div class="product-item sm-height bg-gray">
          <a href="#" class="product-category">
            Giày <span>25 sản phẩm</span>
          </a>
          <img src="public/assets/images/Banner6.jpg" alt="Image" class="img-fluid">
        </div>
      </div>
    </div>
  </div>
</div>
<div class="site-section">
  <div class="container">
    <div class="row">
      <div class="title-section mb-5 col-12">
        <h2 class="text-uppercase">Popular Products</h2>
      </div>
    </div>
    <div class="row">
      <div class="row">
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

              <!--  BUTTON -->
              <div class="mt-3 d-flex gap-2">

                <!-- Thêm giỏ hàng -->
                <form action="index.php?page=addtocart" method="post">
                  <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                  <button type="submit" class="btn btn-outline-dark btn-sm w-100">
                    Thêm giỏ
                  </button>
                </form>

                <!-- Mua ngay -->
                <form action="index.php?act=buynow" method="post">
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
    </div>
  </div>
</div>
<div class="site-blocks-cover inner-page py-5 aos-init aos-animate" data-aos="fade">
  <div class="container">
    <div class="row">
      <div class="col-md-6 ml-auto order-md-2 align-self-start">
        <div class="site-block-cover-content">
          <h2 class="sub-title">#Bộ Sưu Tập Mùa Hè Mới 2019</h2>
          <h1>Giày Mới</h1>
          <p><a href="#" class="btn btn-black rounded-0">Mua Ngay</a></p>
        </div>
      </div>
      <div class="col-md-6 order-1 align-self-end">
        <img src="public/assets/images/Banner6.jpg" alt="Image" class="img-fluid">
      </div>
    </div>
  </div>
</div>