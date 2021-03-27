@push('scripts')
    <script src="/js/app.js"></script>
    <script type="text/javascript">


        @php
            $classes = [];
            $values = [];
            $bgcolors = [];

            $sn = 0;
            foreach($class_wise_count as $cwc){
                $classes[] = $cwc->classTitle;
                $values[] = $cwc->applicantCount;

                if($sn >= count($colors)){
                    $thisColor = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
                    if(in_array($thisColor, $bgcolors)){
                        $thisColor = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
                    }
                    $bgcolors[] = $thisColor;
                }else{
                    $bgcolors[] = $colors[$sn];
                }


                $sn++;
            }
        @endphp

        $(document).ready(function () {

            var ctx = document.getElementById("myChart");
            var myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['<?php echo implode("', '", $classes) ?>'],
                    datasets: [{
                        label: '# of Students',
                        data: [<?php echo implode(", ", $values) ?>],
                        backgroundColor: ['<?php echo implode("', '", $bgcolors) ?>'],
                        borderWidth: 1
                    }]
                },
                options: {
                    //cutoutPercentage: 40,
                    responsive: true,
                    legend: {
                        display: true,
                        position: 'bottom',
                        labels: {
                            boxWidth: 10,
                            fontColor: '#000000'
                        }
                    }



                }
            });

        })

    </script>
@endpush

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 mx-auto">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">



            <div class="grid grid-cols-3 gap-4">


                <div class="col-span-1">

                    <div class="bg-white rounded-md py-6 px-5 mb-5">
                        <h3 class="font-semibold text-xl mb-2">No. of Classes</h3>
                        <h3 class="font-semibold text-4xl font-bold">{{ $class_count }}</h3>
                    </div>

                    <div class="bg-white rounded-md py-6 px-5 mb-5">
                        <h3 class="font-semibold text-xl mb-2">No. of Sections</h3>
                        <h3 class="font-semibold text-4xl font-bold">{{ $section_count }}</h3>
                    </div>

                    <div class="bg-white rounded-md py-6 px-5 mb-5">
                        <h3 class="font-semibold text-xl mb-2">No. of Students</h3>
                        <h3 class="font-semibold text-4xl font-bold">{{ $applicant_count }}</h3>
                    </div>

                </div>

                <div class="col-span-2">

                    <div class="bg-white rounded-md py-6 px-5 mb-5">
                        <h3 class="font-semibold text-xl mb-2 text-center">Students per Class</h3>
                        <canvas id="myChart"></canvas>
                    </div>
                </div>

            </div>



        </div>



    </div>

</x-app-layout>
