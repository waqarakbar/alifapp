<div id="new_sibling_form" class="hidden">

    <h1 class="text-2xl font-semibold">Add new sibling</h1>

    {!! Form::open(['route' => 'applicant.save-sibling', 'method' => 'post']) !!}

    <input type="hidden" name="applicant_id" value="{{ \Illuminate\Support\Facades\Crypt::encrypt($applicant->id) }}">

    <div class="grid grid-cols-2 gap-4 mt-10">

        <div class="">
            {!! Form::label('name', 'Name ', ['class' => 'req']) !!}
            <span class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('name') !!} @endif</span>
            {!! Form::text('name', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'name', 'required' => 'required']) !!}
        </div>


        <div class="">
            {!! Form::label('dob', 'Date of Birth ', ['class' => 'req']) !!}
            <span class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('dob') !!} @endif</span>
            {!! Form::date('dob', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'dob', 'required' => 'required']) !!}
        </div>


        <div class="">
            {!! Form::label('class', 'Class ', ['class' => 'req']) !!}
            <span class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('class') !!} @endif</span>
            {!! Form::text('class', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'class', 'required' => 'required']) !!}
        </div>


        <div class="">
            {!! Form::label('session', 'Session ', ['class' => 'req']) !!}
            <span
                class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('session') !!} @endif</span>
            {!! Form::text('session', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'session', 'required' => 'required']) !!}
        </div>

    </div>


    <div class="mt-5">
        <button class="px-5 py-2 bg-green-500 text-white" type="submit">
            <i class="fa fa-save"></i> Save Sibling
        </button>
    </div>


    {!! Form::close() !!}

</div>
