@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $(".select2").select2();

            // get districts by province
            $(document).on('change', '.province_list', function () {
                var p = $(this);
                var d = p.closest(".grid").find('.district_list');
                // console.log(p.val())
                $.ajax({
                    url: '{{ route('districts-by-province-id') }}',
                    type: 'post',
                    data: {
                        province_id: p.val(),
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (res) {
                        var options = "<option>Select a district</option>";
                        $.each(res, function (i, j) {
                            options += "<option value='" + i + "'>" + j + "</option>";
                        });
                        d.html(options)
                    }
                })

            });


            $(document).on('change', '#applying_grade_id', function () {
                var g = $(this).val();
                $.ajax({
                    type: 'post',
                    url: '{{ route('sections.sections-by-grade-id') }}',
                    data: {
                        grade_id: g,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (res) {

                        /*g.removeClass('col-span-2');
                        $(".section_cont").show()*/

                        var options = "<option>Select a section</option>";
                        $.each(res, function (i, j) {
                            options += "<option value='" + i + "'>" + j + "</option>";
                        });
                        $("#section_id").html(options)

                    }
                })
            });


            var cnic_im = new Inputmask("99999-9999999-9");
            cnic_im.mask(document.getElementById("father_cnic"));
            cnic_im.mask(document.getElementById("mother_cnic"));
            cnic_im.mask(document.getElementById("eme_cnic"));

            var mobile_im = new Inputmask("0999 9999999");
            mobile_im.mask(document.getElementById("mobile_number"));
            mobile_im.mask(document.getElementById("father_cell_phone"));
            mobile_im.mask(document.getElementById("mother_cell_phone"));
            mobile_im.mask(document.getElementById("eme_cell_phone"));


        });


    </script>
@endpush

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 bg-white border-b border-gray-200">

                    <div class="grid grid-cols-2 gap-4 py-8">

                        <div>
                            <h1 class="font-semibold text-2xl">{{ $title }}</h1>
                        </div>


                        <div class="text-right text-sm">
                            <a href="{{ route('dashboard') }}" class="text-blue-600">Dashboard</a> <i
                                class="fa fa-chevron-right"></i>
                            <a href="{{ route('applicant.list') }}" class="text-blue-600">All Applicants</a> <i
                                class="fa fa-chevron-right"></i>
                            New Applicant
                        </div>

                    </div>


                    {!! Form::model($applicant, ['url' => route('applicant.save'), 'type' => 'post']) !!}

                    @if($applicant->exists)
                        <input type="hidden" name="id"
                               value="{{ \Illuminate\Support\Facades\Crypt::encrypt($applicant->id) }}">
                    @endif

                    <div class="grid md:grid-cols-2 gap-4">


                        <div>

                            <div class="grid md:grid-cols-2  gap-4">

                                {{--<div class="">
                                    {!! Form::label('form_number', 'Form Number ', ['class' => '']) !!}
                                    <span
                                        class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('form_number') !!} @endif</span>
                                    {!! Form::text('form_number', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'form_number']) !!}
                                </div>--}}


                                <div class="applying_grade_cont">
                                    {!! Form::label('applying_grade_id', 'Applying Grade ', ['class' => 'req']) !!}
                                    <span
                                        class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('applying_grade_id') !!} @endif</span>
                                    {!! Form::select('applying_grade_id', [null=>'Select Applying Grade']+$applying_grades, NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'applying_grade_id', 'required' => 'required']) !!}
                                </div>


                                <div class="section_cont">
                                    {!! Form::label('section_id', 'Select Section ', ['class' => '']) !!}
                                    <span
                                        class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('section_id') !!} @endif</span>
                                    {!! Form::select('section_id', [null=>'Select Section']+$sections, NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'section_id']) !!}
                                </div>

                            </div>

                        </div>


                        <div class="">
                            {!! Form::label('session', 'Session ', ['class' => 'req']) !!}
                            <span
                                class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('session') !!} @endif</span>
                            {!! Form::text('session', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'session', 'required' => 'required']) !!}
                        </div>


                    </div>


                    <div class="grid md:grid-cols-2 gap-4 mt-5">


                        <div class="">
                            {!! Form::label('need_transportation', 'Need Transportation ', ['class' => 'req']) !!}
                            <span
                                class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('need_transportation') !!} @endif</span>
                            {!! Form::select('need_transportation', ['yes'=>'Yes', 'no' => 'No'], NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'need_transportation', 'required' => 'required']) !!}
                        </div>


                        <div class="grid md:grid-cols-2 gap-4">

                            <div class="">
                                {!! Form::label('how_hear_about_us', 'How did you hear about us? ', ['class' => '']) !!}
                                <span
                                    class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('how_hear_about_us') !!} @endif</span>
                                {!! Form::select('how_hear_about_us', ['newspaper' => 'Newspaper','television'=>'TV','internet'=>'Internet','references'=>'References'], NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'how_hear_about_us']) !!}
                            </div>

                            <div class="">
                                {!! Form::label('source_name', 'Name of the Source ', ['class' => '']) !!}
                                <span
                                    class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('source_name') !!} @endif</span>
                                {!! Form::text('source_name', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'source_name']) !!}
                            </div>

                        </div>

                    </div>


                    <div class="grid md:grid-cols-4 gap-4 mt-5">

                        <div class="col-span-2">
                            {!! Form::label('name', 'Applicant Name ', ['class' => 'req']) !!}
                            <span
                                class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('name') !!} @endif</span>
                            {!! Form::text('name', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'name', 'required' => 'required']) !!}
                        </div>


                        <div class="">
                            {!! Form::label('gender', 'Gender ', ['class' => '']) !!}
                            <span
                                class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('gender') !!} @endif</span>
                            {!! Form::select('gender', ['male'=>'Male', 'female' => 'Female'], NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'gender']) !!}
                        </div>


                        <div class="">
                            {!! Form::label('dob', 'Date of Birth ', ['class' => 'req']) !!}
                            <span
                                class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('dob') !!} @endif</span>
                            {!! Form::date('dob', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'dob', 'required' => 'required']) !!}
                        </div>


                        {{--<div class="">
                            {!! Form::label('dob_words', 'DOB Words ', ['class' => '']) !!}
                            <span
                                class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('dob_words') !!} @endif</span>
                            {!! Form::text('dob_words', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'dob_words']) !!}
                        </div>--}}

                    </div>


                    <div class="grid md:grid-cols-2 gap-4 mt-5">

                        <div class="">
                            {!! Form::label('address', 'Address ', ['class' => 'req']) !!}
                            <span
                                class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('address') !!} @endif</span>
                            {!! Form::text('address', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'address', 'required' => 'required']) !!}
                        </div>


                        <div class="grid md:grid-cols-3 gap-4">

                            <div class="">
                                {!! Form::label('pobox', 'PO Box ', ['class' => '']) !!}
                                <span
                                    class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('pobox') !!} @endif</span>
                                {!! Form::text('pobox', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'pobox']) !!}
                            </div>


                            <div class="">
                                {!! Form::label('village', 'Village / City ', ['class' => 'req']) !!}
                                <span
                                    class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('village') !!} @endif</span>
                                {!! Form::text('village', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'village', 'required' => 'required']) !!}
                            </div>


                            <div class="">
                                {!! Form::label('tehsil', 'Tehsil ', ['class' => '']) !!}
                                <span
                                    class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('tehsil') !!} @endif</span>
                                {!! Form::text('tehsil', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'tehsil']) !!}
                            </div>

                        </div>


                    </div>


                    <div class="grid md:grid-cols-4 gap-4 mt-5">

                        <input type="hidden" name="country_id" value="168">


                        <div class="">
                            {!! Form::label('province_id', 'Select province ', ['class' => 'req']) !!}
                            <span
                                class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('province_id') !!} @endif</span>
                            {!! Form::select('province_id', [null=>'Select Province']+$provinces, NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full select2 province_list', 'id' => 'province_id', 'required' => 'required']) !!}
                        </div>


                        <div class="">
                            {!! Form::label('district_id', 'Select district  ', ['class' => 'req']) !!}
                            <span
                                class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('district_id') !!} @endif</span>
                            {!! Form::select('district_id', [null=>'Select District ']+$districts, NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full select2 district_list', 'id' => 'district_id', 'required' => 'required']) !!}
                        </div>


                        <div class="">
                            {!! Form::label('home_phone_number', 'Home phone number ', ['class' => '']) !!}
                            <span
                                class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('home_phone_number') !!} @endif</span>
                            {!! Form::text('home_phone_number', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'home_phone_number']) !!}
                        </div>


                        <div class="">
                            {!! Form::label('mobile_number', 'Mobile number ', ['class' => 'req']) !!}
                            <span
                                class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('mobile_number') !!} @endif</span>
                            {!! Form::text('mobile_number', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'mobile_number', 'required' => 'required']) !!}
                        </div>

                    </div>


                    <div class="grid md:grid-cols-1 gap-4 mt-5">
                        <div class="">
                            {!! Form::label('email_address', 'Email Address ', ['class' => '']) !!}
                            <span
                                class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('email_address') !!} @endif</span>
                            {!! Form::email('email_address', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'email_address']) !!}
                        </div>
                    </div>


                    <div class="grid md:grid-cols-1 gap-4 mt-10">
                        <h2 class="text-lg font-bold">Father's / Guardian's Information</h2>
                        <hr>
                    </div>


                    <div class="grid md:grid-cols-4 gap-4 mt-5">

                        <div class="">
                            {!! Form::label('father_name', 'Father name ', ['class' => 'req']) !!}
                            <span
                                class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('father_name') !!} @endif</span>
                            {!! Form::text('father_name', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'father_name', 'required' => 'required']) !!}
                        </div>

                        <div class="">
                            {!! Form::label('father_cnic', 'Father CNIC ', ['class' => '']) !!}
                            <span
                                class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('father_cnic') !!} @endif</span>
                            {!! Form::text('father_cnic', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full cnic', 'id' => 'father_cnic']) !!}
                        </div>

                        <div class="">
                            {!! Form::label('father_cast', 'Father cast ', ['class' => '']) !!}
                            <span
                                class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('father_cast') !!} @endif</span>
                            {!! Form::text('father_cast', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'father_cast']) !!}
                        </div>

                        <div class="">
                            {!! Form::label('father_tribe', 'Father tribe ', ['class' => '']) !!}
                            <span
                                class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('father_tribe') !!} @endif</span>
                            {!! Form::text('father_tribe', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'father_tribe']) !!}
                        </div>

                    </div>


                    <div class="grid md:grid-cols-2 gap-4 mt-5">

                        <div>
                            <div class="grid md:grid-cols-2 gap-4">

                                <div class="">
                                    {!! Form::label('father_occupation', 'Father Occupation ', ['class' => '']) !!}
                                    <span
                                        class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('father_occupation') !!} @endif</span>
                                    {!! Form::text('father_occupation', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'father_occupation']) !!}
                                </div>

                                <div class="">
                                    {!! Form::label('father_designation', 'Father Designation ', ['class' => '']) !!}
                                    <span
                                        class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('father_designation') !!} @endif</span>
                                    {!! Form::text('father_designation', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'father_designation']) !!}
                                </div>

                            </div>
                        </div>

                        <div class="">
                            {!! Form::label('father_department', 'Father Department ', ['class' => '']) !!}
                            <span
                                class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('father_department') !!} @endif</span>
                            {!! Form::text('father_department', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'father_department']) !!}
                        </div>

                    </div>


                    <div class="grid md:grid-cols-2 gap-4 mt-5">

                        <div class="">
                            {!! Form::label('father_pobox', 'PO Box ', ['class' => '']) !!}
                            <span
                                class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('father_pobox') !!} @endif</span>
                            {!! Form::text('father_pobox', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'father_pobox']) !!}
                        </div>


                        <div class="grid md:grid-cols-2 gap-4">


                            <div class="">
                                {!! Form::label('father_village', 'Village / City ', ['class' => 'req']) !!}
                                <span
                                    class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('father_village') !!} @endif</span>
                                {!! Form::text('father_village', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'father_village', 'required' => 'required']) !!}
                            </div>


                            <div class="">
                                {!! Form::label('father_tehsil', 'Tehsil ', ['class' => 'req']) !!}
                                <span
                                    class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('father_tehsil') !!} @endif</span>
                                {!! Form::text('father_tehsil', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'father_tehsil', 'required' => 'required']) !!}
                            </div>

                        </div>


                    </div>


                    <div class="grid md:grid-cols-4 gap-4 mt-5">

                        <input type="hidden" name="father_country_id" value="168">


                        <div class="">
                            {!! Form::label('father_province_id', 'Select province ', ['class' => 'req']) !!}
                            <span
                                class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('father_province_id') !!} @endif</span>
                            {!! Form::select('father_province_id', [null=>'Select Province']+$provinces, NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full select2 province_list', 'id' => 'father_province_id', 'required' => 'required']) !!}
                        </div>


                        <div class="">
                            {!! Form::label('father_district_id', 'Select district  ', ['class' => 'req']) !!}
                            <span
                                class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('father_district_id') !!} @endif</span>
                            {!! Form::select('father_district_id', [null=>'Select District ']+$districts, NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full select2 district_list', 'id' => 'father_district_id', 'required' => 'required']) !!}
                        </div>


                        <div class="">
                            {!! Form::label('father_work_phone', 'Work phone number ', ['class' => '']) !!}
                            <span
                                class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('father_work_phone') !!} @endif</span>
                            {!! Form::text('father_work_phone', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'father_work_phone']) !!}
                        </div>


                        <div class="">
                            {!! Form::label('father_cell_phone', 'Mobile number ', ['class' => 'req']) !!}
                            <span
                                class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('father_cell_phone') !!} @endif</span>
                            {!! Form::text('father_cell_phone', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'father_cell_phone', 'required' => 'required']) !!}
                        </div>

                    </div>


                    <div class="grid md:grid-cols-1 gap-4 mt-5">
                        <div class="">
                            {!! Form::label('father_email', 'Email Address ', ['class' => '']) !!}
                            <span
                                class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('father_email') !!} @endif</span>
                            {!! Form::email('father_email', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'father_email']) !!}
                        </div>
                    </div>


                    <div class="grid md:grid-cols-1 gap-4 mt-10">
                        <h2 class="text-lg font-bold">Mother's Information</h2>
                        <hr>
                    </div>


                    <div class="grid md:grid-cols-4 gap-4 mt-5">

                        <div class="">
                            {!! Form::label('mother_name', 'Mother name ', ['class' => 'req']) !!}
                            <span
                                class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('mother_name') !!} @endif</span>
                            {!! Form::text('mother_name', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'mother_name', 'required' => 'required']) !!}
                        </div>

                        <div class="">
                            {!! Form::label('mother_cnic', 'Mother CNIC ', ['class' => '']) !!}
                            <span
                                class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('mother_cnic') !!} @endif</span>
                            {!! Form::text('mother_cnic', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full cnic', 'id' => 'mother_cnic']) !!}
                        </div>

                        <div class="">
                            {!! Form::label('mother_cast', 'Mother cast ', ['class' => '']) !!}
                            <span
                                class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('mother_cast') !!} @endif</span>
                            {!! Form::text('mother_cast', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'mother_cast']) !!}
                        </div>

                        <div class="">
                            {!! Form::label('mother_tribe', 'Mother tribe ', ['class' => '']) !!}
                            <span
                                class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('mother_tribe') !!} @endif</span>
                            {!! Form::text('mother_tribe', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'mother_tribe']) !!}
                        </div>

                    </div>


                    <div class="grid md:grid-cols-2 gap-4 mt-5">

                        <div>
                            <div class="grid md:grid-cols-2 gap-4">

                                <div class="">
                                    {!! Form::label('mother_occupation', 'Mother Occupation ', ['class' => '']) !!}
                                    <span
                                        class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('mother_occupation') !!} @endif</span>
                                    {!! Form::text('mother_occupation', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'mother_occupation']) !!}
                                </div>

                                <div class="">
                                    {!! Form::label('mother_designation', 'Mother Designation ', ['class' => '']) !!}
                                    <span
                                        class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('mother_designation') !!} @endif</span>
                                    {!! Form::text('mother_designation', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'mother_designation']) !!}
                                </div>

                            </div>
                        </div>

                        <div class="">
                            {!! Form::label('mother_department', 'Mother Department ', ['class' => '']) !!}
                            <span
                                class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('mother_department') !!} @endif</span>
                            {!! Form::text('mother_department', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'mother_department']) !!}
                        </div>

                    </div>


                    <div class="grid md:grid-cols-2 gap-4 mt-5">

                        <div class="">
                            {!! Form::label('mother_pobox', 'PO Box ', ['class' => '']) !!}
                            <span
                                class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('mother_pobox') !!} @endif</span>
                            {!! Form::text('mother_pobox', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'mother_pobox']) !!}
                        </div>


                        <div class="grid md:grid-cols-2 gap-4">


                            <div class="">
                                {!! Form::label('mother_village', 'Village / City ', ['class' => '']) !!}
                                <span
                                    class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('mother_village') !!} @endif</span>
                                {!! Form::text('mother_village', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'mother_village']) !!}
                            </div>


                            <div class="">
                                {!! Form::label('mother_tehsil', 'Tehsil ', ['class' => '']) !!}
                                <span
                                    class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('mother_tehsil') !!} @endif</span>
                                {!! Form::text('mother_tehsil', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'mother_tehsil']) !!}
                            </div>

                        </div>


                    </div>


                    <div class="grid md:grid-cols-4 gap-4 mt-5">

                        <input type="hidden" name="mother_country_id" value="168">


                        <div class="">
                            {!! Form::label('mother_province_id', 'Select province ', ['class' => 'req']) !!}
                            <span
                                class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('mother_province_id') !!} @endif</span>
                            {!! Form::select('mother_province_id', [null=>'Select Province']+$provinces, NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full select2 province_list', 'id' => 'mother_province_id', 'required' => 'required']) !!}
                        </div>


                        <div class="">
                            {!! Form::label('mother_district_id', 'Select district  ', ['class' => 'req']) !!}
                            <span
                                class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('mother_district_id') !!} @endif</span>
                            {!! Form::select('mother_district_id', [null=>'Select District ']+$districts, NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full select2 district_list', 'id' => 'mother_district_id', 'required' => 'required']) !!}
                        </div>


                        <div class="">
                            {!! Form::label('mother_work_phone', 'Work phone number ', ['class' => '']) !!}
                            <span
                                class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('mother_work_phone') !!} @endif</span>
                            {!! Form::text('mother_work_phone', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'mother_work_phone']) !!}
                        </div>


                        <div class="">
                            {!! Form::label('mother_cell_phone', 'Mobile number ', ['class' => '']) !!}
                            <span
                                class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('mother_cell_phone') !!} @endif</span>
                            {!! Form::text('mother_cell_phone', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'mother_cell_phone']) !!}
                        </div>

                    </div>


                    <div class="grid md:grid-cols-1 gap-4 mt-5">
                        <div class="">
                            {!! Form::label('mother_email', 'Email Address ', ['class' => '']) !!}
                            <span
                                class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('mother_email') !!} @endif</span>
                            {!! Form::text('mother_email', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'mother_email']) !!}
                        </div>
                    </div>


                    <div class="grid md:grid-cols-1 gap-4 mt-10">
                        <h2 class="text-lg font-bold">Emergency Contact Information</h2>
                        <hr>
                    </div>


                    <div class="grid md:grid-cols-4 gap-4 mt-5">

                        <div class="">
                            {!! Form::label('eme_name', 'Emergency name ', ['class' => '']) !!}
                            <span
                                class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('eme_name') !!} @endif</span>
                            {!! Form::text('eme_name', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'eme_name']) !!}
                        </div>

                        <div class="">
                            {!! Form::label('eme_cnic', 'Emergency CNIC ', ['class' => '']) !!}
                            <span
                                class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('eme_cnic') !!} @endif</span>
                            {!! Form::text('eme_cnic', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full cnic', 'id' => 'eme_cnic']) !!}
                        </div>

                        <div class="">
                            {!! Form::label('eme_cast', 'Emergency cast ', ['class' => '']) !!}
                            <span
                                class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('eme_cast') !!} @endif</span>
                            {!! Form::text('eme_cast', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'eme_cast']) !!}
                        </div>

                        <div class="">
                            {!! Form::label('eme_tribe', 'Emergency tribe ', ['class' => '']) !!}
                            <span
                                class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('eme_tribe') !!} @endif</span>
                            {!! Form::text('eme_tribe', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'eme_tribe']) !!}
                        </div>

                    </div>


                    <div class="grid md:grid-cols-2 gap-4 mt-5">

                        <div>
                            <div class="grid md:grid-cols-2 gap-4">

                                <div class="">
                                    {!! Form::label('eme_occupation', 'Emergency Occupation ', ['class' => '']) !!}
                                    <span
                                        class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('eme_occupation') !!} @endif</span>
                                    {!! Form::text('eme_occupation', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'eme_occupation']) !!}
                                </div>

                                <div class="">
                                    {!! Form::label('eme_designation', 'Emergency Designation ', ['class' => '']) !!}
                                    <span
                                        class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('eme_designation') !!} @endif</span>
                                    {!! Form::text('eme_designation', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'eme_designation']) !!}
                                </div>

                            </div>
                        </div>

                        <div class="">
                            {!! Form::label('eme_department', 'Emergency Department ', ['class' => '']) !!}
                            <span
                                class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('eme_department') !!} @endif</span>
                            {!! Form::text('eme_department', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'eme_department']) !!}
                        </div>

                    </div>


                    <div class="grid md:grid-cols-2 gap-4 mt-5">

                        <div class="">
                            {!! Form::label('eme_pobox', 'PO Box ', ['class' => '']) !!}
                            <span
                                class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('eme_pobox') !!} @endif</span>
                            {!! Form::text('eme_pobox', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'eme_pobox']) !!}
                        </div>


                        <div class="grid md:grid-cols-2 gap-4">


                            <div class="">
                                {!! Form::label('eme_village', 'Village / City ', ['class' => '']) !!}
                                <span
                                    class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('eme_village') !!} @endif</span>
                                {!! Form::text('eme_village', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'eme_village']) !!}
                            </div>


                            <div class="">
                                {!! Form::label('eme_tehsil', 'Tehsil ', ['class' => '']) !!}
                                <span
                                    class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('eme_tehsil') !!} @endif</span>
                                {!! Form::text('eme_tehsil', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'eme_tehsil']) !!}
                            </div>

                        </div>


                    </div>


                    <div class="grid md:grid-cols-4 gap-4 mt-5">

                        <input type="hidden" name="eme_country_id" value="168">


                        <div class="">
                            {!! Form::label('eme_province_id', 'Select province ', ['class' => '']) !!}
                            <span
                                class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('eme_province_id') !!} @endif</span>
                            {!! Form::select('eme_province_id', [null=>'Select Province']+$provinces, NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full select2 province_list', 'id' => 'eme_province_id']) !!}
                        </div>


                        <div class="">
                            {!! Form::label('eme_district_id', 'Select district  ', ['class' => '']) !!}
                            <span
                                class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('eme_district_id') !!} @endif</span>
                            {!! Form::select('eme_district_id', [null=>'Select District ']+$districts, NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full select2 district_list', 'id' => 'eme_district_id']) !!}
                        </div>


                        <div class="">
                            {!! Form::label('eme_work_phone', 'Work phone number ', ['class' => '']) !!}
                            <span
                                class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('eme_work_phone') !!} @endif</span>
                            {!! Form::text('eme_work_phone', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'eme_work_phone']) !!}
                        </div>


                        <div class="">
                            {!! Form::label('eme_cell_phone', 'Mobile number ', ['class' => '']) !!}
                            <span
                                class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('eme_cell_phone') !!} @endif</span>
                            {!! Form::text('eme_cell_phone', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'eme_cell_phone']) !!}
                        </div>

                    </div>


                    <div class="grid md:grid-cols-1 gap-4 mt-5">
                        <div class="">
                            {!! Form::label('eme_email', 'Email Address ', ['class' => '']) !!}
                            <span
                                class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('eme_email') !!} @endif</span>
                            {!! Form::text('eme_email', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'eme_email']) !!}
                        </div>
                    </div>


                    <div class="grid md:grid-cols-1 gap-4 mt-10">
                        <div>
                            <button type="submit"
                                    class="py-3 px-4 bg-green-500 text-white shadow-md hover:bg-green-600 mr-2">
                                <i class="fa fa-save"></i> Save Applicant
                            </button>

                            <button type="submit"
                                    class="py-3 px-4 bg-yellow-500 text-white shadow-md hover:bg-yellow-600">
                                <i class="fa fa-undo"></i> Reset
                            </button>

                        </div>
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

