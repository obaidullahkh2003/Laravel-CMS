<!-- Portfolio Grid -->
<section class="page-section bg-light" id="portfolio">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Portfolio</h2>
            <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
        </div>
        <div class="row">
            @foreach($portfolioItems as $item)
                <div class="col-lg-4 col-sm-6 mb-4">
                    <!-- Portfolio item -->
                    <div class="portfolio-item">
                        <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal{{ $loop->index + 1 }}">
                            <div class="portfolio-hover">
                                <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <!-- Dynamic image -->
                            <img class="img-fluid" src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->title }}" />
                        </a>
                        <div class="portfolio-caption">
                            <div class="portfolio-caption-heading">{{ $item->title }}</div>
                            <div class="portfolio-caption-subheading text-muted">{{ $item->subtitle }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
