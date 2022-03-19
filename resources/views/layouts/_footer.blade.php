<footer class="bg-dark text-center text-white">
    <div class="container">
        <div class="row p-3">
            <div class="col-lg-6 mb-3 mb-lg-0">
                <h4>{{ __('Contact') }}</h4>
                <div class="contact-item-holder">
                    <div class="contact-item">
                        <div class="info-circle">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <h6 class="ms-3">+36123456789</h6>
                    </div>
                    <div class="contact-item">
                        <div class="info-circle">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <h6 class="ms-3">Fictional Street</h6>
                    </div>
                    <div class="contact-item">
                        <div class="info-circle">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <h6 class="ms-3">support@techzone.com</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-3 mb-lg-0">
                <h4>{{ __('Payment information') }}</h4>
                <p>{{ __('Shipping cost:') }} </p>
                <p>{{ __('Accepted payment methods:') }}</p>
                <div class="payment-methods">
                    <i class="fa-brands fa-cc-mastercard"></i>
                    <i class="fa-solid fa-money-bill-1"></i>
                    <i class="fa-brands fa-cc-visa"></i>
                </div>
            </div>
        </div>
        <div class="social-holder">
            <a href="#" class="social social-facebook">
                <i class="fa-brands fa-facebook-f"></i>
            </a>
            <a href="#" class="social social-instagram">
                <i class="fa-brands fa-instagram"></i>
            </a>
            <a href="#" class="social social-twitter">
                <i class="fa-brands fa-twitter"></i>
            </a>
        </div>
        <div class="text-center p-3">
            Copyright &copy; {{ now()->year  }} {{ config('app.name') }}
        </div>
    </div>
</footer>