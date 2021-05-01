@push('scripts')
    <script type="text/javascript">
        $(document).ready( function () {

            $('#print_form').click(function(){
                $("#printable_form").printThis({
                    // debug: true,
                    // importCss: false
                });
            });




        } );

    </script>
@endpush

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <div class="mt-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 b-order border-green-500">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 bg-white border-b border-gray-200">

                    <div class="grid grid-cols-2 gap-4">

                        <div>
                            <h1 class="font-semibold text-2xl">{{ $title }}</h1>
                        </div>


                        <div class="text-right text-sm">
                            <a href="{{ route('dashboard') }}" class="text-blue-600">Dashboard</a> <i class="fa fa-chevron-right"></i>
                            <a href="{{ route('applicant.list') }}" class="text-blue-600">All Applicants</a> <i class="fa fa-chevron-right"></i>
                            Applicant Profile
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>



    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <div class="grid grid-cols-3 gap-4">


                <div class="md:col-span-1 rounded p-10 pt-15 pb-1 bg-white shadow-md">

                    <div class="flex justify-center mb-2">
                        @if(is_null($applicant->photo))
                            <img src="{{ asset('images/np.png') }}" class="rounded-full h-36 w-36 flex items-center justify-center border border-gray-300 p-0.5">
                        @else
                            <img src="{{ asset('uploads/applicants/'.$applicant->photo) }}" class="-rounded-full max-h-60 w-36 flex items-center justify-center border border-gray-300 p-0.5">
                        @endif
                    </div>


                    <div class="flex justify-center mb-2">

                        @include('applicants.upload_photo')

                        <a href="#upload_photo" class="text-xs text-blue-500 mb-5" rel="modal:open">
                            <i class="fa fa-edit"></i> upload photo
                        </a>
                    </div>


                    <div class="flex justify-center mb-2">
                        <h5 class="font-bold text-3xl">{{ $applicant->name }}</h5>
                    </div>

                    <div class="flex justify-center ">
                        <h5 class="text-md">Father: <span class="font-bold">{{ $applicant->father_name }}</span></h5>
                    </div>

                    <div class="flex justify-center mb-5">
                        <h5 class="text-md">Mother: <span class="font-bold">{{ $applicant->mother_name }}</span></h5>
                    </div>


                    <div class="grid grid-cols-1 gap-4">

                        <div>
                            <a href="#" class="py-1 px-2 bg-blue-500 text-white inline-block w-full inline-block text-center rounded" id="print_form">
                                <i class="fas fa-print"></i> Print Form
                            </a>
                        </div>


                        <div>
                            <a href="{{ route('applicant.applicant-form', ['id' => \Illuminate\Support\Facades\Crypt::encrypt($applicant->id)]) }}" class="py-1 px-2 bg-yellow-500 text-white inline-block w-full inline-block text-center rounded">
                                <i class="far fa-edit"></i> Edit Applicant
                            </a>
                        </div>


                        <div>
                            <a href="#" class="py-1 px-2 bg-red-400 text-white inline-block inline-block w-full inline-block text-center rounded">
                                <i class="far fa-trash-alt"></i> Delete Applicant
                            </a>
                        </div>

                    </div>


                </div>



                <div class="md:col-span-2">



                    <div class="rounded p-10 bg-white shadow-md mb-4">

                        @include('applicants.new_academic')

                        <div class="grid grid-cols-2 gap-4 mb-10">

                            <div>
                                <h3 class="font-bold text-xl">Prior School Information</h3>
                            </div>

                            <div class="text-right">

                                @if($applicant->academics->count() == 0)
                                <a href="#new_academic_form" class="px-2 py-1 b-g-green-500 inline-block text-blue-700 rounded text-sm" rel="modal:open">
                                    <i class="fa fa-plus"></i> Add New
                                </a>
                                @endif
                            </div>
                        </div>



                        <div class="grid grid-cols-1 gap-4">

                            <table class="table-fixed border-collapse b-order border-gray-400 text-sm w-full">
                                <thead>
                                <tr>
                                    <th class="py-2 px-3 bg-gray-100 border border-gray-300">#</th>
                                    <th class="py-2 px-3 bg-gray-100 border border-gray-300">School</th>
                                    <th class="py-2 px-3 bg-gray-100 border border-gray-300">From</th>
                                    <th class="py-2 px-3 bg-gray-100 border border-gray-300">To</th>
                                    <th class="py-2 px-3 bg-gray-100 border border-gray-300">Address</th>
                                    <th class="py-2 px-3 bg-gray-100 border border-gray-300">SLC Received</th>
                                    <th class="py-2 px-3 bg-gray-100 border border-gray-300"></th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($applicant->academics as $acd)
                                <tr>
                                    <td class="p-2 border border-gray-300">{{ $loop->iteration }}</td>
                                    <td class="p-2 border border-gray-300">{{ $acd->school }}</td>
                                    <td class="p-2 border border-gray-300">{{ $acd->from_date }}</td>
                                    <td class="p-2 border border-gray-300">{{ $acd->to_date }}</td>
                                    <td class="p-2 border border-gray-300">{{ $acd->address }}</td>
                                    <td class="p-2 border border-gray-300">{{ $acd->slc_received }}</td>
                                    <td class="p-2 border border-gray-300 text-center">
                                        <a href="{{ route('applicant.delete-academic', ['id' => \Illuminate\Support\Facades\Crypt::encrypt($acd->id)]) }}" class="text-red-700" onclick="return confirm('Are you sure you want to delete?')">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>

                            </table>

                        </div>


                    </div>



                    <div class="rounded p-10 bg-white shadow-md mb-4">

                        @include('applicants.new_sibling')

                        <div class="grid grid-cols-2 gap-4 mb-10">

                            <div>
                                <h3 class="font-bold text-xl">Siblings</h3>
                            </div>

                            <div class="text-right">
                                <a href="#new_sibling_form" class="px-2 py-1 b-g-green-500 inline-block text-blue-700 rounded text-sm" rel="modal:open">
                                    <i class="fa fa-plus"></i> News Sibling
                                </a>
                            </div>
                        </div>



                        <div class="grid grid-cols-1 gap-4">

                            <table class="table-fixed border-collapse b-order border-gray-400 text-sm w-full">
                                <thead>
                                <tr>
                                    <th class="py-2 px-3 bg-gray-100 border border-gray-300">#</th>
                                    <th class="py-2 px-3 bg-gray-100 border border-gray-300">Name</th>
                                    <th class="py-2 px-3 bg-gray-100 border border-gray-300">DOB</th>
                                    <th class="py-2 px-3 bg-gray-100 border border-gray-300">Class</th>
                                    <th class="py-2 px-3 bg-gray-100 border border-gray-300">Session</th>
                                    <th class="py-2 px-3 bg-gray-100 border border-gray-300"></th>
                                </tr>
                                </thead>

                                <tbody>

                                @foreach($applicant->siblings as $sib)

                                <tr>
                                    <td class="p-2 border border-gray-300">{{ $loop->iteration }}</td>
                                    <td class="p-2 border border-gray-300">{{ $sib->name }}</td>
                                    <td class="p-2 border border-gray-300">{{ date("d-M-Y", strtotime($sib->dob)) }}</td>
                                    <td class="p-2 border border-gray-300">{{ $sib->class }}</td>
                                    <td class="p-2 border border-gray-300">{{ $sib->session }}</td>
                                    <td class="p-2 border border-gray-300 text-center">
                                        <a href="{{ route('applicant.delete-sibling', ['id' => \Illuminate\Support\Facades\Crypt::encrypt($sib->id)]) }}" class="text-red-700" onclick="return confirm('Are you sure you want to delete?')">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>

                                @endforeach

                                </tbody>

                            </table>

                        </div>


                    </div>



                    <div class="rounded p-10 bg-white shadow-md">

                        <div class="grid grid-cols-2 gap-4 mb-10">

                            <div>
                                <h3 class="font-bold text-xl">Health / Doctor Information</h3>
                            </div>

                        </div>



                        <div class="grid grid-cols-1 gap-4">


                            {!!  Form::open(['route' => 'applicant.save-health-information', 'method' => 'post']) !!}

                            <input type="hidden" name="applicant_id" value="{{ \Illuminate\Support\Facades\Crypt::encrypt($applicant->id) }}">
                            <div>

                                <h4 class="font-semibold mb-5">Select any health conditions that the child is suffering from</h4>

                                <div class="grid md:grid-cols-5 gap-4">


                                    @foreach($diseases as $did => $dtitle)

                                        @php
                                            $diseaseExists = $applicant->applicantDiseases->where('id', $did);
                                            // echo $diseaseExists->count();
                                        @endphp

                                        <div>
                                            <label for="hc_{{ $did }}">
                                                <input type="checkbox" id="hc_{{ $did }}" name="applicant_diseases[]" value="{{ $did }}" @if($diseaseExists->count() > 0) checked @endif> {{ $dtitle }}
                                            </label>
                                        </div>
                                    @endforeach


                                </div>
                            </div>


                            <div class="mt-10">



                                <div class="grid md:grid-cols-2 gap-4">

                                    <div class="col-span-2 mt-5">
                                        {!! Form::label('major_surgeries', 'Please indicate if the student has had any major operations or injuries (specify) ', ['class' => '']) !!}
                                        <span
                                            class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('major_surgeries') !!} @endif</span>
                                        {!! Form::textarea('major_surgeries', $applicant->doctors[0]->major_surgeries ?? NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'major_surgeries', 'rows' => 4]) !!}
                                    </div>


                                    <div class="col-span-2">
                                        {!! Form::label('medications', 'Indicate if the student takes any medication (please explain) ', ['class' => '']) !!}
                                        <span
                                            class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('medications') !!} @endif</span>
                                        {!! Form::textarea('medications', $applicant->doctors[0]->medications ?? NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'medications', 'rows' => 4]) !!}
                                    </div>


                                    <div class="">
                                        {!! Form::label('doctor_name', 'Doctor\'s Name ', ['class' => '']) !!}
                                        <span
                                            class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('doctor_name') !!} @endif</span>
                                        {!! Form::text('doctor_name', $applicant->doctors[0]->doctor_name ?? NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'doctor_name']) !!}
                                    </div>


                                    <div class="">
                                        {!! Form::label('phone_number', 'Doctor\'s Phone ', ['class' => '']) !!}
                                        <span
                                            class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('phone_number') !!} @endif</span>
                                        {!! Form::text('phone_number', $applicant->doctors[0]->phone_number ?? NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'phone_number']) !!}
                                    </div>


                                    <div class="col-span-2">
                                        {!! Form::label('address', 'Doctor\'s Address ', ['class' => '']) !!}
                                        <span
                                            class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('address') !!} @endif</span>
                                        {!! Form::text('address', $applicant->doctors[0]->address ?? NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'address']) !!}
                                    </div>

                                </div>



                            </div>



                            <div class="mt-10">
                                <button class="px-5 py-2 bg-green-500 text-white" type="submit">
                                    <i class="fa fa-save"></i> Save Information
                                </button>
                            </div>


                            {!! Form::close() !!}

                        </div>


                    </div>




                </div>

            </div>


        </div>
    </div>



    @include('applicants.print_form')


</x-app-layout>

