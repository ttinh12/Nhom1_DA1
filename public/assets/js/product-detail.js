document.addEventListener("DOMContentLoaded", function () {

    const radios = document.querySelectorAll('input[name="variant"]');
    const priceEl = document.getElementById('price');
    const imageEl = document.getElementById('main-image');
    const stockEl = document.getElementById('stock');
    const qtyEl = document.getElementById('qty');
    const form = document.querySelector("form");

    function updateVariant(radio) {
        const price = radio.dataset.price;
        const image = radio.dataset.image;
        const stock = parseInt(radio.dataset.stock);

        // giá
        priceEl.innerText = Number(price).toLocaleString('vi-VN') + ' đ';

        // ảnh
        imageEl.src = "public/assets/images/" + image;

        // highlight thumb
        document.querySelectorAll('.thumb').forEach(t => {
            t.classList.remove('active-thumb');
            if (t.src.includes(image)) {
                t.classList.add('active-thumb');
            }
        });

        // tồn kho
        if (stock > 0) {
            stockEl.innerText = "Còn hàng: " + stock;
            stockEl.classList.remove('text-danger');
            stockEl.classList.add('text-success');
        } else {
            stockEl.innerText = "Hết hàng";
            stockEl.classList.remove('text-success');
            stockEl.classList.add('text-danger');
        }

        // giới hạn qty
        if (qtyEl.value > stock) {
            qtyEl.value = stock > 0 ? stock : 1;
        }
    }

    // load mặc định
    const checked = document.querySelector('input[name="variant"]:checked');
    if (checked) updateVariant(checked);

    // change variant
    radios.forEach(r => {
        r.addEventListener('change', function () {
            updateVariant(this);
        });
    });

    // + -
    document.getElementById('plus').onclick = () => {
        let current = parseInt(qtyEl.value);
        let stock = parseInt(document.querySelector('input[name="variant"]:checked').dataset.stock);

        if (current < stock) qtyEl.value = current + 1;
    };

    document.getElementById('minus').onclick = () => {
        let current = parseInt(qtyEl.value);
        if (current > 1) qtyEl.value = current - 1;
    };

    // ✅ SUBMIT FORM (DUY NHẤT 1 CHỖ)
    form.addEventListener("submit", function (e) {

        const selected = document.querySelector('input[name="variant"]:checked');

        if (!selected) {
            alert("Vui lòng chọn biến thể");
            e.preventDefault();
            return;
        }

        document.getElementById('variantInput').value = selected.value;
        document.getElementById('qtyInput').value = qtyEl.value;
    });

});

// GLOBAL
function changeImage(el) {
    const main = document.getElementById('main-image');

    main.src = el.src;

    document.querySelectorAll('.thumb').forEach(t => t.classList.remove('active-thumb'));
    el.classList.add('active-thumb');
}