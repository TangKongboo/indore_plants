document.addEventListener('DOMContentLoaded', function() {
    fetchCart();
});

function fetchCart() {
    fetch('/cart')
        .then(response => response.json())
        .then(data => renderCart(data))
        .catch(error => console.error('Error fetching cart:', error));
}

function addToCart(plantId) {
    let qtyInput = document.getElementById('qty-input');
    let qty = qtyInput ? parseInt(qtyInput.value) : 1;

    fetch('/cart/add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': window.csrfToken
        },
        body: JSON.stringify({ plant_id: plantId, quantity: qty })
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            fetchCart();
            // Open the offcanvas drawer
            let cartDrawerEl = document.getElementById('cartDrawer');
            let bsOffcanvas = bootstrap.Offcanvas.getInstance(cartDrawerEl) || new bootstrap.Offcanvas(cartDrawerEl);
            bsOffcanvas.show();
        }
    })
    .catch(error => console.error('Error adding to cart:', error));
}

function updateCartItem(plantId, qty) {
    fetch('/cart/update', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': window.csrfToken
        },
        body: JSON.stringify({ plant_id: plantId, quantity: qty })
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            fetchCart();
        }
    });
}

function removeCartItem(plantId) {
    fetch('/cart/remove', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': window.csrfToken
        },
        body: JSON.stringify({ plant_id: plantId })
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            fetchCart();
        }
    });
}

function renderCart(data) {
    const cartItems = data.cart;
    const total = data.total;
    const count = data.count;

    // Update navbar badge
    const badge = document.getElementById('cart-count-badge');
    if (badge) {
        badge.innerText = count;
        if(count > 0) badge.classList.remove('d-none');
        else badge.classList.add('d-none');
    }

    const emptyMsg = document.getElementById('empty-cart-message');
    const listContainer = document.getElementById('cart-items-list');
    const checkoutBtn = document.getElementById('checkout-btn');
    const subtotalEl = document.getElementById('cart-subtotal');

    subtotalEl.innerText = '$' + total.toFixed(2);

    if (count === 0) {
        emptyMsg.style.display = 'block';
        listContainer.classList.add('d-none');
        checkoutBtn.style.display = 'none';
        listContainer.innerHTML = '';
        return;
    }

    emptyMsg.style.display = 'none';
    listContainer.classList.remove('d-none');
    checkoutBtn.style.display = 'flex';
    
    listContainer.innerHTML = '';
    const template = document.getElementById('cart-item-template').content;

    for (const [id, item] of Object.entries(cartItems)) {
        const clone = document.importNode(template, true);
        
        clone.querySelector('.item-img').src = item.image;
        clone.querySelector('.item-name').innerText = item.name;
        clone.querySelector('.item-price').innerText = '$' + item.price;
        clone.querySelector('.item-qty-input').value = item.quantity;
        
        // Setup event listeners
        clone.querySelector('.item-remove-btn').addEventListener('click', () => removeCartItem(item.id));
        clone.querySelector('.item-inc-btn').addEventListener('click', () => updateCartItem(item.id, item.quantity + 1));
        clone.querySelector('.item-dec-btn').addEventListener('click', () => updateCartItem(item.id, item.quantity - 1));

        listContainer.appendChild(clone);
    }
}
