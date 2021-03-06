@push('scripts')
    <script type="text/javascript">
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
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

                        <div class="text-right">
                            <a href="{{ route('applying-grades.grade-form') }}" class="bg-blue-500 py-2 px-4 text-sm text-white">
                                <i class="fa fa-plus"></i> Create
                            </a>
                        </div>

                    </div>



                    <div class="b-order b-order-red-800 grid grid-cols-1 overflow-y-auto">


                        <table class="border-collapse b-order border-gray-400 text-xs w-full" id="myTable">

                            <thead>
                            <tr>
                                <th class="py-2 px-3 bg-gray-100 border border-gray-300">#</th>
                                <th class="py-2 px-3 bg-gray-100 border border-gray-300">Grade Title</th>
                                <th class="py-2 px-3 bg-gray-100 border border-gray-300">Sections</th>
                                <th class="py-2 px-3 bg-gray-100 border border-gray-300 w-1/6">Action</th>
                            </tr>
                            </thead>


                            <tbody>
                            @php $bg = '' @endphp
                            @foreach($grades as $ap)
                            <tr class="border-b border-gray-200 {{ $bg }} hover:bg-gray-100">
                                <td class="p-2 border border-gray-300">{{ $loop->iteration }}</td>
                                <td class="p-2 border border-gray-300">{{ $ap->title }}</td>
                                <td class="p-2 border border-gray-300">{{ $ap->sections->count() }}</td>
                                <td class="p-2 border border-gray-300 align-center">


                                    <a href="{{ route('applying-grades.grade-form', ['id' => \Illuminate\Support\Facades\Crypt::encrypt($ap->id)]) }}" class="py-1 px-2 bg-yellow-500 text-white inline-block">
                                        <i class="far fa-edit"></i>
                                    </a>

                                    <a href="{{ route('applying-grades.delete', ['id' => \Illuminate\Support\Facades\Crypt::encrypt($ap->id)]) }}" class="py-1 px-2 bg-red-400 text-white inline-block" onclick="return confirm('are you sure to delete? ')">
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                            @php $bg = ($bg == '') ? 'bg-gray-50' : '' @endphp
                            @endforeach



                            </tbody>

                        </table>


                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

