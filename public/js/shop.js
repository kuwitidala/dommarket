let shopOffset = 0;
let shopLimit = 12;

function shopLoadProducts() {

    fetch(`/load-shop-products?shop_id=${SHOP_ID}&offset=${shopOffset}&limit=${shopLimit}`)
        .then(res => res.json())
        .then(data => {

            console.log(data);

            const container = document.getElementById('shop-products-container');

            data.forEach(product => {
                container.innerHTML += `
                    <div class="card" onclick="window.location='/product/${product.id}'">
                        <div class="card-content">
                            <img src="/images/products/${product.image}" alt="${product.name}">
                            <div class="card-text">
                                <p class="price">${product.price} P</p>
                                <p class="product-name">${product.name}</p>
                                <p class="shop-name">${product.shop?.name ?? 'Магазин'}</p>
                                <p class="rating">⭐️ ${product.rating ?? 0} (${product.reviews_count ?? 0} отзывов)</p>
                            </div>
                        </div>

                        ${
                            isAuth
                            ? `
                            <form action="/cart/add/${product.id}" method="POST" onclick="event.stopPropagation();">
                                <input type="hidden" name="_token" value="${csrfToken}">
                                <button type="submit" class="btn-buy"
                                        onclick="alert('Товар добавлен в корзину')">
                                    Купить
                                </button>
                            </form>`
                            
                            : `
                            <button class="btn-buy"
                                    onclick="event.stopPropagation(); alert('Чтобы добавить товар в корзину, войдите в профиль')">
                                Купить
                            </button>`
                            
                        }
                    </div>`
               ;
            });

            shopOffset += data.length;

            shopLimit = 12;

            if (data.length === 0) {
                const btn = document.getElementById('shop-show-more');
                if (btn) btn.style.display = 'none';
            }
        });
}

document.addEventListener('DOMContentLoaded', () => {

    const btn = document.getElementById('shop-show-more');

    if (btn) {
        btn.addEventListener('click', shopLoadProducts);
    }

    shopLoadProducts();
});