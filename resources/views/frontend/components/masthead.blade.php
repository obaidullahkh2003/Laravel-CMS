<header style="background-color: darkgray;">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            @foreach ($carousels as $index => $carousel)
                <li data-target="#carouselExampleIndicators" data-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}"></li>
            @endforeach
        </ol>

        <div class="carousel-inner">
            @foreach ($carousels as $index => $carousel)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                    <header class="masthead" style="background-image: url('{{ asset('storage/' . $carousel->image_url) }}'); background-size: cover; background-position: center;">
                        <div class="container">
                            <div class="masthead-subheading">{{ $carousel->subheading }}</div>
                            <div class="masthead-heading text-uppercase">{{ $carousel->heading }}</div>
                            <a class="btn btn-warning btn-xl text-uppercase" href="{{ $carousel->button_link }}">{{ $carousel->button_text }}</a>
                        </div>
                    </header>
                </div>
            @endforeach
        </div>

        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</header>
