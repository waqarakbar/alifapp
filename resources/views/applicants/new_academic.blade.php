<div id="new_academic_form" class="hidden">

    <h1 class="text-2xl font-semibold">Add new academic</h1>

    {!! Form::open(['route' => 'applicant.save-academic', 'method' => 'post']) !!}

    <input type="hidden" name="applicant_id" value="{{ \Illuminate\Support\Facades\Crypt::encrypt($applicant->id) }}">

    <div class="grid grid-cols-2 gap-4 mt-10">


        <div class="col-span-2">
            {!! Form::label('school', 'School ', ['class' => 'req']) !!}
            <span class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('school') !!} @endif</span>
            {!! Form::text('school', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'school', 'required' => 'required']) !!}
        </div>


        <div class="">
            {!! Form::label('from_date', 'From Date ', ['class' => 'req']) !!}
            <span
                class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('from_date') !!} @endif</span>
            {!! Form::date('from_date', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'from_date', 'required' => 'required']) !!}
        </div>

        <div class="">
            {!! Form::label('to_date', 'To Date ', ['class' => 'req']) !!}
            <span
                class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('to_date') !!} @endif</span>
            {!! Form::date('to_date', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'to_date', 'required' => 'required']) !!}
        </div>


        <div class="col-span-2">
            {!! Form::label('address', 'Address ', ['class' => '']) !!}
            <span
                class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('address') !!} @endif</span>
            {!! Form::textarea('address', NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'address', 'rows' => 2]) !!}
        </div>


    </div>


    <div class="mt-5">
        <button class="px-5 py-2 bg-green-500 text-white" type="submit">
            <i class="fa fa-save"></i> Save Academic
        </button>
    </div>


    {!! Form::close() !!}

</div>
