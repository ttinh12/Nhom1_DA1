document.addEventListener("DOMContentLoaded", function () {

    const radios = document.querySelectorAll('input[name="variant_id"]');
    const priceEl = document.getElementById('price');
    const imageEl = document.getElementById('main-image');
    const stockEl = document.getElementById('stock');
    const qtyEl = document.getElementById('qty');
    const form = document.getElementById('addToCartForm');

    function updateVariant(radio) {
        const price = radio.dataset.price || 0;
        const image = radio.dataset.image || '';
        const stock = parseInt(radio.dataset.stock) || 0;

        if (priceEl) {
            priceEl.innerText = Number(price).toLocaleString('vi-VN') + ' đ';
        }

        if (imageEl && image) {
            imageEl.src = "public/assets/images/" + image;
        }

        document.querySelectorAll('.thumb').forEach(t => {
            t.classList.remove('active-thumb');
            if (t.src.includes(image)) {
                t.classList.add('active-thumb');
            }
        });

        if (stockEl) {
            if (stock > 0) {
                stockEl.innerText = "Còn hàng: " + stock;
                stockEl.classList.remove('text-danger');
                stockEl.classList.add('text-success');
            } else {
                stockEl.innerText = "Hết hàng";
                stockEl.classList.remove('text-success');
                stockEl.classList.add('text-danger');
            }
        }

        if (qtyEl && qtyEl.value > stock) {
            qtyEl.value = stock > 0 ? stock : 1;
        }
    }

    const checked = document.querySelector('input[name="variant_id"]:checked');
    if (checked) updateVariant(checked);

    radios.forEach(r => {
        r.addEventListener('change', function () {
            updateVariant(this);
        });
    });

    const plus = document.getElementById('plus');
    const minus = document.getElementById('minus');

    if (plus) {
        plus.onclick = function () {
            const current = parseInt(qtyEl.value) || 1;
            const selected = document.querySelector('input[name="variant_id"]:checked');
            const stock = selected ? parseInt(selected.dataset.stock) : 0;

            if (current < stock) {
                qtyEl.value = current + 1;
            }
        };
    }

    if (minus) {
        minus.onclick = function () {
            const current = parseInt(qtyEl.value) || 1;
            if (current > 1) {
                qtyEl.value = current - 1;
            }
        };
    }

    if (form) {
        form.addEventListener("submit", function (e) {

            const selected = document.querySelector('input[name="variant_id"]:checked');

            if (!selected) {
                alert("Vui lòng chọn biến thể");
                e.preventDefault();
            }
        });
    }

});

function changeImage(el) {
    const main = document.getElementById('main-image');

    if (main) {
        main.src = el.src;
    }

    document.querySelectorAll('.thumb').forEach(t => {
        t.classList.remove('active-thumb');
    });

    el.classList.add('active-thumb');
}