<!-- Contact Section -->
<section class="page-section" id="contact">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Contact Us</h2>
            <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
        </div>

        @if(session('success'))
            <script type="text/javascript">
                alert("{{ session('success') }}");
            </script>
        @endif

        <form id="contactForm" method="POST" action="{{ route('contacts.store') }}" data-sb-form-api-token="API_TOKEN">
            @csrf
            <div class="row align-items-stretch mb-5">
                <div class="col-md-6">
                    <div class="form-group">
                        <input class="form-control" id="name" name="name" type="text" placeholder="Your Name *" required />
                    </div>
                    <div class="form-group">
                        <input class="form-control" id="email" name="email" type="email" placeholder="Your Email *" required />
                    </div>
                    <div class="form-group mb-md-0">
                        <input class="form-control" id="phone" name="phone" type="tel" placeholder="Your Phone *" required />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group form-group-textarea mb-md-0">
                        <textarea class="form-control" id="message" name="message" placeholder="Your Message *" required></textarea>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button class="btn btn-primary btn-xl text-uppercase" id="submitButton" type="submit">Send Message</button>
            </div>
        </form>
    </div>
</section>
