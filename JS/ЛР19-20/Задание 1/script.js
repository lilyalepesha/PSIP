 // Получаем данные из JSON-файла
 const products = fetch('products.json')
 .then(response => response.json())
 .then(data => {
   displayProducts(data);
 });

// Отображение товаров на странице
function displayProducts(products) {
 const productList = document.getElementById('product-list');
 productList.innerHTML = "";
 products.forEach(product => {
   productList.innerHTML += `<li>${product.name} - $${product.price} <button onclick="addToCart(${product.id})">В корзину</button></li>`;
 });
}

// Добавление товара в корзину
function addToCart(productId) {
 // Реализация добавления товара в корзину
 console.log(`Product ${productId} added to cart.`);
}

// Просмотр содержимого корзины
function viewCart() {
 // Реализация просмотра содержимого корзины
 console.log('Viewing cart.');
}