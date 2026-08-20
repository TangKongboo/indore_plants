<footer class="bg-yellow">
  <div class="container footer">
    <div class="row g-4">
      <!-- Brand Info -->
      <div class="col-lg-4 col-md-6">
        <div class="pe-lg-4">
          <i class="fa-solid fa-seedling seeding-icon"></i><br>
          <span class="footer-brand">IndorePlants</span>
          <p class="footer-description">Bringing vibrant green life into your home and workspace with curated plants, sustainable pots, and expert botanical care services.</p>
          <div class="d-flex gap-3">
            <a href="#" class="icon-color" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="#" class="icon-color" aria-label="X Twitter"><i class="fa-brands fa-x-twitter"></i></a>
            <a href="#" class="icon-color" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
            <a href="#" class="icon-color" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
          </div>
        </div>
      </div>

      <!-- Quick Links -->
      <div class="col-lg-2 col-md-6">
        <h5 class="footer-title">Quick Links</h5>
        <ul class="footer-list">
          <li class="footer-list-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="footer-list-item"><a href="#about">About Us</a></li>
          <li class="footer-list-item"><a href="#popular">Popular Plants</a></li>
          <li class="footer-list-item"><a href="#reviews">Customer Reviews</a></li>
          <li class="footer-list-item"><a href="#">Shipping Policy</a></li>
        </ul>
      </div>

      <!-- Our Services -->
      <div class="col-lg-3 col-md-6">
        <h5 class="footer-title">Our Services</h5>
        <ul class="footer-list">
          <li class="footer-list-item"><a href="#"><i class="fa-solid fa-leaf text-success me-2"></i> Indoor Plant Design</a></li>
          <li class="footer-list-item"><a href="#"><i class="fa-solid fa-tree text-success me-2"></i> Tree Planting & Care</a></li>
          <li class="footer-list-item"><a href="#"><i class="fa-solid fa-scissors text-success me-2"></i> Landscape Maintenance</a></li>
          <li class="footer-list-item"><a href="#"><i class="fa-solid fa-droplet text-success me-2"></i> Irrigation Solutions</a></li>
        </ul>
      </div>

      <!-- Contact & Newsletter -->
      <div class="col-lg-3 col-md-6">
        <h5 class="footer-title">Contact Us</h5>
        <ul class="footer-list mb-4">
          <li class="footer-list-item"><i class="fa-solid fa-phone me-2 text-success"></i> +855 61 913 865</li>
          <li class="footer-list-item"><i class="fa-solid fa-envelope me-2 text-success"></i> kongbootang@gmail.com</li>
          <li class="footer-list-item"><i class="fa-solid fa-location-dot me-2 text-success"></i> Phnom Penh, Cambodia</li>
        </ul>

        <h5 class="footer-title fs-6 mb-2">Subscribe for Plant Tips</h5>
        <form action="#" method="POST" class="newsletter-input-group" onSubmit="return false;">
          <input type="email" class="newsletter-input" placeholder="Your email..." required>
          <button type="submit" class="btn-subscribe"><i class="fa-solid fa-paper-plane"></i></button>
        </form>
      </div>
    </div>

    <div class="row pt-5 mt-4 border-top">
      <div class="col-12 text-center text-muted small">
        <p class="mb-0">&copy; {{ date('Y') }} IndorePlants. All rights reserved. Crafted with care in Cambodia.</p>
      </div>
    </div>
  </div>
</footer>
