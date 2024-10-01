<div class="contact5 sp">
    <div class="container">
        <div class="row">
            @foreach ($vacancies as $vacancy)
                <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                    <div class="jbs-grid-layout border">
                        <div class="right-tags-capt">
                            @if ($vacancy->featured)
                                <span class="featured-text">Featured</span>
                            @endif
                            @if ($vacancy->urgent)
                                <span class="urgent">Urgent</span>
                            @endif
                        </div>
                        <div class="jbs-grid-emp-head">
                            <div class="jbs-grid-emp-thumb"><a href="job-detail.html">
                                    <figure><img
                                            src="{{ $vacancy->file_path ? asset('storage/' . $vacancy->file_path) : asset('backend/images/bg/default.png') }}"
                                            class="img-fluid" alt=""></figure>
                                </a></div>
                        </div>
                        <div class="jbs-grid-job-caption">
                            <div class="jbs-job-employer-wrap"><span>{{ $vacancy->company }}</span></div>
                            <div class="jbs-job-title-wrap">
                                <h4><a href="job-detail.html" class="jbs-job-title">{{ $vacancy->title }}</a></h4>
                            </div>
                        </div>
                        <div class="jbs-grid-job-info-wrap">
                            <div class="jbs-grid-job-info">
                                <div class="jbs-grid-single-info"><span><i
                                            class="fa-solid fa-location-dot"></i>{{ $vacancy->location }}</span></div>
                                <div class="jbs-grid-single-info"><span><i
                                            class="fa-regular fa-clock"></i>{{ ucfirst(str_replace('-', ' ', $vacancy->job_type)) }}
                                    </span>
                                </div>
                                <div class="jbs-grid-single-info"><span><i class="fa-solid fa-calendar"></i>
                                        @if ($vacancy->experience === 'No')
                                            No Experience Needed
                                        @else
                                            {{ $vacancy->experience }} Years Experience Needed
                                        @endif
                                    </span></div>
                            </div>
                        </div>
                        <div class="jbs-grid-job-description">
                            <p>{{ Str::limit($vacancy->meta_description, 100, '...') }}
                            </p>
                        </div>
                        <div class="jbs-grid-job-edrs">
                            <div class="jbs-grid-job-edrs-group">
                                @foreach(explode(',', $vacancy->tags) as $tag)
                                <span>{{ trim($tag) }}</span>
                            @endforeach
                            </div>
                        </div>
                        <div class="jbs-grid-job-package-info">
                            <div class="jbs-grid-package-title">
                                @if(!empty($vacancy->salary))
                                <h5>£{{ number_format($vacancy->salary, ) }}<span>\Year</span></h5>
                                @endif
                            </div>
                            <div class="jbs-grid-posted"><span>{{ \Carbon\Carbon::parse($vacancy->created_at)->format('d F Y') }}</span></div>
                        </div>
                        <div class="jbs-grid-job-apply-btns mt-2">
                            <div class="jbs-btn-groups">
                                <a href="{{ route('vacancies.show', $vacancy->id) }}" class="btn-md btn-light-primary px-4">View Detail</a>
                                <a href="{{ auth()->check() ? route('/', $vacancy->id) : route('user.login') }}" class="btn-md btn-primary px-4">Quick Apply</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
