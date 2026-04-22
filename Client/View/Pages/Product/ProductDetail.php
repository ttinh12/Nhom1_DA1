<div class="site-section">
    <div class="container">
        <div class="row">

        <!-- IMAGE -->
            <div class="col-md-6">
                <div class="item-entry">
                    <a href="#" class="product-item md-height bg-gray d-block">

                        <!-- MAIN IMAGE -->
                        <img id="main-image"
                            src="public/assets/images/<?= $product['images'] ?>"
                            class="img-fluid">

                    </a>

                    <!-- THUMB -->
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
                <!-- NAME -->
                <h2 class="text-black"><?= $product['name'] ?></h2>
                <!-- CATEGORY -->
                <p class="text-muted">
                Danh mục: <?= $product['category_name'] ?? 'Chưa có' ?>
                </p>
                <!-- PRICE -->
                <p>
                <strong class="text-primary h4" id="price">
                    <?= number_format($product['base_price']) ?> đ
                </strong>
                </p>
                <!-- STOCK -->
                <p id="stock" class="text-success">
                Còn hàng: <?= $variants[0]['stock'] ?? 0 ?>
                </p>
                <!-- VARIANT -->
                <div class="mb-3 d-flex flex-wrap">

                    <?php foreach ($variants as $index => $v): ?>
                        <label class="d-flex mr-3 mb-3">
                        <span class="d-inline-block mr-2">
                            <input type="radio"
                                name="variant"
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

                        <input type="text"
                            id="qty"
                            class="form-control text-center"
                            value="1">

                        <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="button" id="plus">+</button>
                        </div>
                    </div>
                </div>

<form action="index.php?page=addtocart" method="POST">

    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">

    <!-- lấy variant -->
    <input type="hidden" name="variant_id"
        value="<?= $variants[0]['id'] ?? '' ?>">

    <!-- lấy số lượng -->
    <input type="hidden" name="qty"
        value="1">

    <button type="submit"
        class="buy-now btn btn-sm height-auto px-4 py-3 btn-primary">
        Thêm vào giỏ
    </button>

</form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="product__details__tab">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#tabs-5"
                            role="tab">Description</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab">Customer
                            Previews(5)</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tabs-5" role="tabpanel">
                        <div class="product__details__tab__content">
                            <p class="note"><?= $product['description'] ?></p>
                        </div>
                    </div>
                    <div class="tab-pane" id="tabs-6" role="tabpanel">
                        <div class="product__details__tab__content">
                            <div class="product__details__tab__content__item">
                                <h5>Products Infomation</h5>
                                <p>A Pocket PC is a handheld computer, which features many of the same
                                    capabilities as a modern PC. These handy little devices allow
                                    individuals to retrieve and store e-mail messages, create a contact
                                    file, coordinate appointments, surf the internet, exchange text messages
                                    and more. Every product that is labeled as a Pocket PC must be
                                    accompanied with specific software to operate the unit and must feature
                                    a touchscreen and touchpad.</p>
                                <p>As is the case with any new technology product, the cost of a Pocket PC
                                    was substantial during it’s early release. For approximately $700.00,
                                    consumers could purchase one of top-of-the-line Pocket PCs in 2003.
                                    These days, customers are finding that prices have become much more
                                    reasonable now that the newness is wearing off. For approximately
                                    $350.00, a new Pocket PC can now be purchased.</p>
                            </div>
                            <div class="product__details__tab__content__item">
                                <h5>Material used</h5>
                                <p>Polyester is deemed lower quality due to its none natural quality’s. Made
                                    from synthetic materials, not natural like wool. Polyester suits become
                                    creased easily and are known for not being breathable. Polyester suits
                                    tend to have a shine to them compared to wool and cotton suits, this can
                                    make the suit look cheap. The texture of velvet is luxurious and
                                    breathable. Velvet is a great choice for dinner party jacket and can be
                                    worn all year round.</p>
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
                                <h2 class="item-title"><a href="#"><?= $item['name'] ?></a></h2>
                                <strong class="item-price"><?= number_format($item['base_price']) ?> đ</strong>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>