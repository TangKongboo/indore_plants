<!-- Slide-out Cart Drawer -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="cartDrawer" aria-labelledby="cartDrawerLabel" style="background: var(--primary-green); border-left: 1px solid rgba(255,255,255,0.1); width: 400px; max-width: 100vw;">
    <div class="offcanvas-header border-bottom border-secondary border-opacity-25 pb-3">
        <h5 class="offcanvas-title font-outfit text-white fw-bold d-flex align-items-center gap-2" id="cartDrawerLabel">
            <i class="fa-solid fa-cart-shopping text-gold"></i> Your Cart
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    
    <div class="offcanvas-body d-flex flex-column p-0">
        <!-- Cart Items List -->
        <div id="cart-items-container" class="flex-grow-1 overflow-auto p-3">
            <div class="text-center text-muted py-5" id="empty-cart-message">
                <i class="fa-solid fa-basket-shopping fs-1 text-secondary opacity-50 mb-3"></i>
                <h6>Your cart is empty</h6>
                <p class="small">Add some beautiful plants to get started!</p>
            </div>
            <!-- Dynamic Cart Items injected here via JS -->
            <div id="cart-items-list" class="d-none"></div>
        </div>

        <!-- Cart Footer / Summary -->
        <div class="border-top border-secondary border-opacity-25 p-4 bg-dark bg-opacity-50">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-soft">Subtotal</span>
                <span class="fs-4 fw-bold text-white" id="cart-subtotal">$0.00</span>
            </div>
            <p class="small text-muted mb-4"><i class="fa-solid fa-truck-fast text-info me-1"></i> Shipping & taxes calculated at checkout.</p>
            
            <a href="{{ route('checkout.index') }}" class="auth-btn-submit w-100 text-decoration-none" id="checkout-btn" style="display: none;">
                <i class="fa-solid fa-credit-card me-2"></i> Proceed to Checkout
            </a>
            
            <button class="btn btn-outline-light w-100 mt-2 rounded-3" data-bs-dismiss="offcanvas">
                Continue Shopping
            </button>
        </div>
    </div>
</div>

<!-- Template for a single cart item -->
<template id="cart-item-template">
    <div class="d-flex gap-3 mb-3 pb-3 border-bottom border-secondary border-opacity-25 cart-item-row">
        <img src="" class="item-img rounded-3 object-fit-cover border border-secondary border-opacity-25" width="70" height="70" alt="Plant">
        <div class="flex-grow-1">
            <div class="d-flex justify-content-between align-items-start">
                <h6 class="text-white fw-semibold mb-1 item-name font-outfit">Name</h6>
                <button class="btn btn-link text-danger p-0 item-remove-btn" title="Remove item"><i class="fa-solid fa-trash-can small"></i></button>
            </div>
            <div class="text-gold fw-bold small mb-2 item-price">$0.00</div>
            
            <div class="d-flex align-items-center border border-secondary border-opacity-50 rounded-pill overflow-hidden bg-dark" style="width: 100px; height: 32px;">
                <button class="btn btn-link text-white p-0 text-center flex-fill item-dec-btn" style="width: 30px;"><i class="fa-solid fa-minus" style="font-size: 10px;"></i></button>
                <input type="number" class="form-control bg-transparent border-0 text-center text-white p-0 fw-bold item-qty-input" value="1" min="1" readonly style="box-shadow: none; font-size: 0.9rem;">
                <button class="btn btn-link text-white p-0 text-center flex-fill item-inc-btn" style="width: 30px;"><i class="fa-solid fa-plus" style="font-size: 10px;"></i></button>
            </div>
        </div>
    </div>
</template>
