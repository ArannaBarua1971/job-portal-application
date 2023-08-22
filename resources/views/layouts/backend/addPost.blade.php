@extends('includes.backend.daseboardIncluder')

@section('backend_content')
    <div class="content-wrapper">
        <h2>{{ isset($editPost)? 'Update Post ': 'Add Post' }}</h2>
        <hr style="height: 5px">
        <form action="{{  isset($editPost)? route('post.update',$editPost->id) :  route('post.add')  }}" class="form" method="POST">
            @csrf
            {{-- job title & postion title --}}
            <div class="row">
                <div class="jobTitle col-lg-6">
                    <label for="jobTitle">
                        <h4>Job Title :</h4>
                    </label><br />
                    <input value="{{ isset($editPost)? $editPost->job_title : old('jobTitle') }}" type="text" placeholder="Job Title" name="jobTitle"
                        class="form-control" id="jobTitle">
                    @error('jobTitle')
                        <span class="alert alert-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="postionTitle col-lg-6">
                    <label for="positionTitle">
                        <h4>Position Title :</h4>
                    </label><br />
                    <input value="{{ isset($editPost)? $editPost->position_title : old('positionTitle') }}" type="text" placeholder="position Title"
                        name="positionTitle" class="form-control" id="positionTitle">
                    @error('positionTitle')
                        <span class="alert alert-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>

            {{-- job details --}}
            <div class="jobDetails my-3">
                <label for="jobDetails">
                    <h4>Job Details :</h4>
                </label><br />
                <textarea name="jobDetails" class="form-control" id="summernote" >
                    {!! isset($editPost)? $editPost->job_description :  old('jobDetails') !!}</textarea>
                @error('jobDetails')
                    <span class="alert alert-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            {{-- job salary & job location & job type & job seats --}}
            <div class="row">
                <div class="jobSalaryMin col-lg-2">
                    <label for="jobSalaryMin">
                        <h4>Job salary Min :</h4>
                    </label><br />
                    <input value="{{ isset($editPost)? $editPost->job_salary_min :  old('jobSalaryMin') }}" type="number" placeholder="Job Salary Min" name="jobSalaryMin"
                        class="form-control" id="jobSalaryMin">
                </div>
                <div class="jobSalaryMax col-lg-2">
                    <label for="jobSalaryMax">
                        <h4>Job salary Max :</h4>
                    </label><br />
                    <input value="{{ isset($editPost)? $editPost->job_salary_max :  old('jobSalaryMax') }}" type="number" placeholder="Job Salary Max" name="jobSalaryMax"
                        class="form-control" id="jobSalaryMax">
                </div>
                <div class="jobLocation col-lg-3">
                    <label for="jobLocation">
                        <h4>Job Location :</h4>
                    </label><br />
                    <input value="{{ isset($editPost)? $editPost->job_location :  old('jobLocation') }}" type="text" placeholder="Job Location" name="jobLocation"
                        class="form-control" id="jobLocation">
                    @error('jobLocation')
                        <span class="alert alert-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="jobType col-lg-3">
                    <label for="jobType">
                        <h4>Job Type :</h4>
                    </label><br />
                    <input value="{{ isset($editPost)? $editPost->job_location :  old('jobType') }}" type="text" placeholder="Job Type" name="jobType"
                        class="form-control" id="jobType">
                    @error('jobType')
                        <span class="alert alert-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="jobSeats col-lg-2">
                    <label for="jobSeats">
                        <h4>Job Seats :</h4>
                    </label><br />
                    <input value="{{ isset($editPost)? $editPost->seats :  old('jobSeats') }}" type="number" placeholder="Job Seats" name="jobSeats"
                        class="form-control" id="jobSeats">
                </div>
            </div>

            {{-- requirdSkills & Eductational $ work Experiences --}}
            <div class="row my-3">
                <div class="requirdSkills col-lg-6">
                    <label for="requirdSkills">
                        <h4>Requird Skills :</h4>
                    </label><br />
                    <textarea type="text" placeholder="Requird Skills" name="requirdSkills" class="form-control" id="summernote1"
                        style="height: 200px">
                        {!! isset($editPost)? $editPost->required_skills :  old('requirdSkills') !!}</textarea>
                    @error('requirdSkills')
                        <span class="alert alert-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="education col-lg-6">
                    <label for="education">
                        <h4>education qualification :</h4>
                    </label><br />
                    <textarea type="text" placeholder="education Qualication" name="education" class="form-control" id="summernote2"
                        style="height: 200px">
                        {!! isset($editPost)? $editPost->education :  old('education') !!}</textarea>
                </div>
                <div class="workExp col-lg-6 mt-3">
                    <label for="workExp">
                        <h4>Work Experience :</h4>
                    </label><br />
                    <input type="number" value="{{ isset($editPost)? $editPost->work_exp :  old('workExp') }}" placeholder="Work Experience in year" name="workExp"
                        class="form-control" id="workExp" >
                    @error('workExp')
                        <span class="alert alert-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn` btn-primary w-100">{{ isset($editPost)? 'Update Post ': 'Submit' }}</button>

        </form>
    </div>
    <!-- content-wrapper ends -->

    @push('css')
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
            integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
        <link type="stylesheet" href="{{ asset('summernote/summernote-bs4.min.css') }}">
    @endpush
    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
        </script>

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
        </script>
        <script src="{{ asset('summernote/summernote-bs4.min.js') }}"></script>
        <script>
            $('#summernote').summernote({
                tabsize: 2,
                height: 300
            });
            $('#summernote1').summernote({
                tabsize: 2,
                height: 200
            });
            $('#summernote2').summernote({
                tabsize: 2,
                height: 200
            });
        </script>
    @endpush
@endsection
