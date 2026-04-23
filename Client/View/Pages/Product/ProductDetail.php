<div class="site-section">
    <div class="container">
        <div class="row">

        <!-- IMAGE -->
            <div class="col-md-6">
                <div class="item-entry">
                    <a href="#" class="product-item md-height bg-gray d-block">

                        <img id="main-image"
                            src="public/assets/images/<?= $product['images'] ?>"
                            class="img-fluid">

                    </a>

                    <div class="mt-3 d-flex gap-2 flex-wrap">

                        <?php
                        $images = [];

                        if (!empty($product['images'])) {
                            $images[] = $product['images'];
                        }

                        foreach ($variants as $v) {
                            if (!empty($v['image']) && !in_array($v['image'], $images)) {
                                $images[] = $v['image'];
                            }
                        }

                        foreach ($images as $index => $img):
                        ?>
                        <img src="public/assets/images/<?= $img ?>"
                            class="thumb <?= $index == 0 ? 'active-thumb' : '' ?>"
                            onclick="changeImage(this)">
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>

            <!-- INFO -->
            <div class="col-md-6">

                <h2 class="text-black"><?= $product['name'] ?></h2>

                <p class="text-muted">
                    Danh mục: <?= $product['category_name'] ?? 'Chưa có' ?>
                </p>

                <p>
                    <strong class="text-primary h4" id="price">
                        <?= number_format($product['base_price']) ?> đ
                    </strong>
                </p>

                <p id="stock" class="text-success">
                    Còn hàng: <?= $variants[0]['stock'] ?? 0 ?>
                </p>

                <!-- FORM -->
                <form id="addToCartForm" action="index.php?page=addtocart" method="POST">

                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">

                    <!-- VARIANT -->
                    <div class="mb-3 d-flex flex-wrap">

                        <?php foreach ($variants as $index => $v): ?>
                            <label class="d-flex mr-3 mb-3">
                                <span class="d-inline-block mr-2">
                                    <input type="radio"
                                        name="variant_id"
                                        value="<?= $v['id'] ?>"
                                        data-price="<?= $v['price'] ?>"
                                        data-image="<?= $v['image'] ?>"
                                        data-stock="<?= $v['stock'] ?>"
                                        <?= $index == 0 ? 'checked' : '' ?>>
                                </span>

                                <span class="text-black">
                                    <?= $v['sku'] ?>
                                </span>
                            </label>
                        <?php endforeach; ?>

                    </div>

                    <!-- QUANTITY -->
                    <div class="mb-4">
                        <div class="input-group mb-3" style="max-width: 120px;">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-primary" type="button" id="minus">−</button>
                            </div>

                            <input type="number"
                                name="qty"
                                id="qty"
                                class="form-control text-center"
                                value="1"
                                min="1">

                            <div class="input-group-append">
                                <button class="btn btn-outline-primary" type="button" id="plus">+</button>
                            </div>
                        </div>
                    </div>

                    <button type="submit"
                        class="buy-now btn btn-sm height-auto px-4 py-3 btn-primary">
                        Thêm vào giỏ
                    </button>

                </form>

            </div>
        </div>
    </div>

    <!-- giữ nguyên phần dưới -->
    <div class="row">
        <div class="col-lg-12">
            <div class="product__details__tab">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#tabs-5">Description</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tabs-6">Customer Previews(5)</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="tabs-5">
                        <div class="product__details__tab__content">
                            <p class="note"><?= $product['description'] ?></p>
                        </div>
                    </div>

                    <div class="tab-pane" id="tabs-6">
                        <div class="product__details__tab__content">
                            <div class="product__details__tab__content__item">
                                <h5>Products Infomation</h5>
                                <p>...</p>
                            </div>
                            <div class="product__details__tab__content__item">
                                <h5>Material used</h5>
                                <p>...</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="site-section block-3 site-blocks-2">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 site-section-heading text-center pt-4">
                <h2>Sản phẩm liên quan</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 block-3">
                <div class="nonloop-block-3 owl-carousel">
                    <?php foreach ($relatedProducts as $item): ?>
                        <div class="item">
                            <div class="item-entry">
                                <a href="index.php?page=product_detail&id=<?= $item['id'] ?>"
                                    class="product-item md-height bg-gray d-block">

                                    <img src="public/assets/images/<?= $item['images'] ?>"
                                        class="img-fluid">
                                </a>

                                <h2 class="item-title">
                                    <a href="#"><?= $item['name'] ?></a>
                                </h2>

                                <strong class="item-price">
                                    <?= number_format($item['base_price']) ?> đ
                                </strong>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

