<!-- Portfolio Modals -->
@foreach($portfolioItems as $item)
    <div class="portfolio-modal modal fade" id="portfolioModal{{ $loop->index + 1 }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-bs-dismiss="modal">
                    <img src="{{ asset('assets/img/close-icon.svg') }}" alt="Close modal" />
                </div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="modal-body">
                                <!-- Project details-->
                                <h2 class="text-uppercase">{{ $item->title }}</h2>
                                <p class="item-intro text-muted">{{ $item->subtitle }}</p>
                                <!-- Dynamic Image -->
                                <img class="img-fluid d-block mx-auto" src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->title }}" />
                                <p>{{ $item->description }}</p>
                                <ul class="list-inline">
                                    <li>
                                        <strong>Client:</strong>
                                        {{ $item->client_name }}
                                    </li>
                                    <li>
                                        <strong>Category:</strong>
                                        {{ $item->category }}
                                    </li>
                                </ul>
                                <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                    <i class="fas fa-xmark me-1"></i>
                                    Close Project
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
