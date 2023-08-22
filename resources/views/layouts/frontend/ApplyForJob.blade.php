@extends('includes.frontend.frontendIncluder')

@section('frontend_contnet')
    <!-- Header End -->
    <div class="container-xxl py-5 bg-dark page-header mb-5">
        <div class="container my-5 pt-5 pb-4">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Job Detail</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb text-uppercase">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Job Detail</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Header End -->


    <!-- Job Detail Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="row gy-5 gx-4">
                <div class="col-lg-8">
                    <div class="d-flex align-items-center mb-5">
                        <img class="flex-shrink-0 img-fluid border rounded" src="img/com-logo-2.jpg" alt=""
                            style="width: 80px; height: 80px;">
                        <div class="text-start ps-4">
                            <h3 class="mb-3">{{ $findJob->position_title }}</h3>
                            <span class="text-truncate me-3"><i
                                    class="fa fa-map-marker-alt text-primary me-2"></i>{{ $findJob->job_location }}</span>
                            <span class="text-truncate me-3">
                                <span class="text-success">Type:</span>
                                {{ $findJob->job_type }}
                            </span>
                            <span class="text-truncate me-0"><i
                                    class="far fa-money-bill-alt text-primary me-2"></i>{{ $findJob->job_salary_min }}K TK
                                - {{ $findJob->job_salary_max }}k TK</span>
                        </div>
                    </div>

                    <div class="mb-5">
                        <h4 class="mb-3">Job description</h4>
                        <p>{!! $findJob->job_description !!}</p>
                        <h4 class="mb-3">Required Skills</h4>
                        <p>
                            {!! $findJob->required_skills !!}
                        </p>
                        <h4 class="mb-3">Qualifications</h4>
                        <p>
                            {!! $findJob->education !!}
                        </p>
                    </div>


                    @hasrole('user')

                    @if (!$applied)
                        <div class="">
                            <h4 class="mb-4">Apply For The Job</h4>
                            <form  action="{{ route('applied') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="number" hidden value="{{ $findJob->id }}" name="job_post_id">
                                <div class="row g-3">
                                    <div class="col-12 col-sm-6">
                                        <input type="text" class="form-control" placeholder="Your Name" name="name" value="{{ old('name') }}">
                                        @error('name')
                                            <span>
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <input type="email" class="form-control" placeholder="Your Email" name="email" value="{{ old('email') }}">
                                        @error('email')
                                            <span>
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <input type="tel" class="form-control" placeholder="Your Phone Number"
                                            name="phone_number" value="phone_number">
                                        @error('phone_number')
                                            <span>
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <input type="file" class="form-control bg-white" name="cv" >
                                        @error('cv')
                                            <span>
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <input class="form-control" rows="5" name="Current_working"
                                            placeholder="Current Working Company if working" name="company_name" value="{{ old('company_name') }}">
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit">Apply Now</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @else
                    <button class="btn btn-primary w-100 text-white" type="submit">Already Applied</button>
                    @endif
                    @endhasrole
                </div>

                <div class="col-lg-4">
                    <div class="bg-light rounded p-5 mb-4 wow slideInUp" data-wow-delay="0.1s">
                        <h4 class="mb-4">Job Summery</h4>
                        <p><i class="fa fa-angle-right text-primary me-2"></i>Published On:
                            {{ \carbon\carbon::parse($findJob->created_at)->format('d M y') }}</p>
                        <p><i class="fa fa-angle-right text-primary me-2"></i>Vacancy: {{ $findJob->seats }}Position</p>
                        {{-- <p><i class="fa fa-angle-right text-primary me-2"></i>Job Nature: Full Time</p> --}}
                        <p><i class="fa fa-angle-right text-primary me-2"></i>Salary: {{ $findJob->job_salary_min }}K TK
                            - {{ $findJob->job_salary_max }}k TK</p>
                        <p><i class="fa fa-angle-right text-primary me-2"></i>Location: {{ $findJob->job_location }}</p>
                        {{-- <p class="m-0"><i class="fa fa-angle-right text-primary me-2"></i>Date Line: 01 Jan, 2045
                        </p> --}}
                    </div>
                    {{-- <div class="bg-light rounded p-5 wow slideInUp" data-wow-delay="0.1s">
                            <h4 class="mb-4">Company Detail</h4>
                            <p class="m-0">Ipsum dolor ipsum accusam stet et et diam dolores, sed rebum sadipscing elitr
                                vero dolores. Lorem dolore elitr justo et no gubergren sadipscing, ipsum et takimata
                                aliquyam et rebum est ipsum lorem diam. Et lorem magna eirmod est et et sanctus et, kasd
                                clita labore.</p>
                        </div> --}}
                </div>
            </div>
        </div>
    </div>
    <!-- Job Detail End -->


    </div>
@endsection
