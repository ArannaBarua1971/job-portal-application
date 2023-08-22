@extends('includes.backend.daseboardIncluder')

@section('backend_content')
    <div class="content-wrapper">
        <h1>Add Other Info.</h1>
        <form action="{{ route('info.all') }}" class="form" method="POST">
            @csrf

            <div class="info_name_phone d-flex flex-wrap">
                <div class="name col-lg-6">
                    <label for="company_name">Company Name :</label>
                    <input value="{{ isset(auth()->user()->company_name) ? auth()->user()->company_name : '' }}"
                        type="text" class="form-control" name="company_name" id="company_name">
                </div>
                <div class="phone col-lg-6">
                    <label for="phone">Phone :</label>
                    <input value="{{ isset(auth()->user()->phone) ? auth()->user()->phone : '' }}" type="tel"
                        class="form-control" name="phone" id="phone">
                </div>
            </div>

            <div class="social_links d-flex flex-wrap">
                <div class="facebook col-lg-3 my-2">
                    <label for="facebook">Facebook :</label>
                    <input value="{{ isset(auth()->user()->facebook) ? auth()->user()->facebook : '' }}" type="url"
                        class="form-control" name="facebook" id="facebook">
                </div>
                <div class="linkedin col-lg-3 my-2">
                    <label for="linkedin">Linkedin :</label>
                    <input value="{{ isset(auth()->user()->linkedin) ? auth()->user()->linkedin : '' }}" type="url"
                        class="form-control" name="linkedin" id="linkedin">
                </div>
                <div class="twitter col-lg-3 my-2">
                    <label for="twitter">Twitter :</label>
                    <input value="{{ isset(auth()->user()->twitter) ? auth()->user()->twitter : '' }}" type="url"
                        class="form-control" name="twitter" id="twitter">
                </div>
                <div class="youtube col-lg-3 my-2">
                    <label for="youtube">YouTube :</label>
                    <input value="{{ isset(auth()->user()->youtube) ? auth()->user()->youtube : '' }}" type="url"
                        class="form-control" name="youtube" id="youtube">
                </div>
                <div class="whatsapp col-lg-3 my-2">
                    <label for="whatsapp">Whatsapp :</label>
                    <input value="{{ isset(auth()->user()->whatsapp) ? auth()->user()->whatsapp : '' }}" type="url"
                        class="form-control" name="whatsapp" id="whatsapp">
                </div>
            </div>


            <div class="skills_portfolio_working_Exp d-flex flex-wrap">
                @hasanyrole('user|employer')
                    <div class="skills col-lg-6 my-2">
                        <label for="skills">Skills :</label>
                        <textarea type="text"
                            class="form-control" name="skills" id="skills" style="height: 200px">{{ isset(auth()->user()->skills) ? auth()->user()->skills : '' }}</textarea>
                    </div>
                    <div class="working_exp col-lg-6 my-2">
                        <label for="working_exp">working_exp :</label>
                        <textarea type="text" class="form-control" name="working_exp" id="working_exp" style="height: 200px">{{ isset(auth()->user()->working_exp) ? auth()->user()->working_exp : '' }}</textarea>
                    </div>
                @endhasanyrole
                @hasrole('user')
                    <div class="education col-lg-6 my-2">
                        <label for="education">Education :</label>
                        <textarea type="text" class="form-control" name="education" id="education" style="height: 200px">{{ isset(auth()->user()->education) ? auth()->user()->education : '' }}</textarea>
                    </div>
                    <div class="certificates col-lg-6 my-2">
                        <label for="certificates">certificates :</label>
                        <textarea type="text" class="form-control" name="certificates" id="certificates" style="height: 200px">{{ isset(auth()->user()->certificates) ? auth()->user()->certificates : '' }}</textarea>
                    </div>
                    <div class="portfolio col-lg-12 my-2">
                        <label for="portfolio">Portfolio :</label>
                        <input placeholder="url"
                            value="{{ isset(auth()->user()->portfolio) ? auth()->user()->portfolio : '' }}" type="url"
                            class="form-control" name="portfolio" id="portfolio">
                    </div>
                @endhasrole
            </div>

            <button class="btn btn-sm btn-primary" type="submit">Submit</button>

        </form>
    </div>
    <!-- content-wrapper ends -->
@endsection
