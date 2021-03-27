@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $(".select2").select2();

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
                            <a href="{{ route('dashboard') }}" class="text-blue-600">Dashboard</a> <i class="fa fa-chevron-right"></i>
                            <a href="{{ route('applying-grades.all-grades') }}" class="text-blue-600">All Grades / Classes</a> <i class="fa fa-chevron-right"></i>
                            New / Edit Class
                        </div>

                    </div>


                    {!! Form::model($grade, ['url' => route('applying-grades.save'), 'type' => 'post']) !!}

                    @if($grade->exists)
                        <input type="hidden" name="id" value="{{ \Illuminate\Support\Facades\Crypt::encrypt($grade->id) }}">
                    @endif

                    <div class="grid md:grid-cols-1 gap-4">


                        <div class="">
                            {!! Form::label('title', 'Grade / Class Title ', ['class' => 'req']) !!}
                            <span
                                class="help">@if(Session::has('errors')) {!! Session::get('errors')->first('title') !!} @endif</span>
                            {!! Form::text('title', $grade->title ?? NULL, ['class' => 'border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent shadow-sm w-full', 'id' => 'title', 'required' => 'required']) !!}
                        </div>


                    </div>




                    <div class="grid md:grid-cols-1 gap-4 mt-10">
                        <div>
                            <button type="submit" class="py-3 px-4 bg-green-500 text-white shadow-md hover:bg-green-600 mr-2">
                                <i class="fa fa-save"></i> Save Grade
                            </button>

                            <button type="submit" class="py-3 px-4 bg-yellow-500 text-white shadow-md hover:bg-yellow-600">
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

