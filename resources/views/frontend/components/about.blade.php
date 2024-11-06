 <!-- About -->
    <section class="page-section" id="about">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">About</h2>
                <h3 class="section-subheading text-muted">Learn about our journey and milestones</h3>
            </div>

            <ul class="timeline">
                @foreach($timelineEvents as $timelineEvent)
                    <li class="{{ $loop->even ? 'timeline-inverted' : '' }}">
                        <div class="timeline-image">
                            @if($timelineEvent->image)
                                <img class="rounded-circle img-fluid" src="{{ asset('storage/' . $timelineEvent->image) }}" alt="Image" />
                            @else
                                <img class="rounded-circle img-fluid" src="assets/img/about/default.jpg" alt="Image" />
                            @endif
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>{{ $timelineEvent->start_date }} - {{ $timelineEvent->end_date ? $timelineEvent->end_date : 'Present' }}</h4>
                                <h4 class="subheading">{{ $timelineEvent->title }}</h4>
                            </div>
                            <div class="timeline-body">
                                <p class="text-muted">{{ $timelineEvent->subheading }}</p>
                            </div>
                        </div>
                    </li>
                @endforeach
                <li class="timeline-inverted">
                    <div class="timeline-image">
                        <h4>
                            Be Part
                            <br />
                            Of Our
                            <br />
                            Story!
                        </h4>
                    </div>
                </li>
            </ul>
        </div>
    </section>
