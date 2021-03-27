<div id="upload_photo" class="hidden">

    <h1 class="text-2xl font-semibold">Upload Applicant Photo</h1>

    {!! Form::open(['route' => 'applicant.upload-photo', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}

    <input type="hidden" name="applicant_id" value="{{ \Illuminate\Support\Facades\Crypt::encrypt($applicant->id) }}">

    <div class="grid grid-cols-1 gap-4 mt-10">


        <div class="">
            {!! Form::label('photo', 'Select Applicant Photo ', ['class' => '']) !!}
            <span class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('photo') !!} @endif</span>
            {!! Form::file('photo', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'photo', 'required' => 'required']) !!}
        </div>


    </div>


    <div class="mt-5">
        <button class="px-5 py-2 bg-green-500 text-white" type="submit">
            <i class="fa fa-save"></i> Save Photo
        </button>
    </div>


    {!! Form::close() !!}

</div>
