let offset = 0;
let limit = 6;
function loadProducts() {
    fetch(`/load-more-products?offset=${offset}&limit=${limit}`)
        .then(res => res.json())
        .then(data => {
console.log(data);

            const container = document.getElementById('products-container');

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

            offset += data.length;
            limit = 12;
            if (data.length === 0) {
                document.getElementById('show-more').style.display = 'none';
            }
        });
}
document.getElementById('show-more')
    .addEventListener('click', loadProducts);
loadProducts();

let popularOffset = 0;
let popularLimit = 4;

let shopsOffset = 0;
let shopsLimit = 3;

function loadPopular() {

    fetch(`/load-popular-products?offset=${popularOffset}&limit=${popularLimit}`)
        .then(r => r.json())
        .then(data => {

            const container = document.getElementById('popular-container');

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

            popularOffset += data.length;
            popularLimit = 8;
        });

    fetch(`/load-popular-shops?offset=${shopsOffset}&limit=${shopsLimit}`)
        .then(r => r.json())
        .then(data => {

            const container = document.getElementById('shops-container');

            data.forEach(s => {
                container.innerHTML += `
                    <div class="brand-card" onclick="window.location='/shop/${s.id}'" >
                        <img src="/images/shops/${s.image}">
                        <p>${s.name}</p>
                    </div>
                `;
            });

            shopsOffset += data.length;
            shopsLimit = 6;
        });
}

document.getElementById('load-more-popular')
    .addEventListener('click', loadPopular);

loadPopular();
