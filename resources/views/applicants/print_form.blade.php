<div id="printable_form">

    <style type="text/css">

        #print_body {
            font-size: 10px !important
        }

        #print_body * {
            margin: 0 !important;
            padding-top: 1px !important;
            padding-bottom: 2px !important;
            --border: 0 !important;
            outline: 0 !important;
        }

        .visibility-hidden {
            -visibility: hidden;
        }

        .border-ccc{
            border: 1px solid #ccc !important;
            padding-top: 1px !important;
            padding-bottom: 0px !important;
        }

        .border-ccc td {
            padding-left: 5px !important;
        }

        .no-border-f{
            border: none !important;
        }

        table {
            width: 96% !important;
            margin: 0px auto !important;
        }

        .checkbox-boxy{
            border: 1px solid #cccccc !important;
            padding: 0px 2px !important;
            box-shadow: 2px 2px #000 !important;
            display: inline-block !important;
            margin-right: 4px !important;
            font-size: 9px !important;
        }
        .empty-box{
            padding: 3px 5px !important;
        }

        .pwn{
            border: 1px solid black ;
            display: inline-block !important;
            padding: 0px 5px !important;
        }

        .newpage{
            page-break-before: always !important;
        }

        .ou_box{
            display: inline-block !important;
            border: 1px solid #444480 !important;
            display: inline-block !important;
            padding: 2px 8px !important;
            background: #c5e7ea !important;
            color: #36367c !important;
            margin-bottom: -4px !important;
        }

        .border-b-ou{
            border-bottom: 1px dotted #444480 !important;
        }
    </style>

    <script type="text/javascript">
        $(document).ready(function () {
            var btext= $(".bordered-text");

            $.each(btext, function(i, v){
                var text = $(v).html()
                $(v).html('')

                console.log(text.length)
                for(i=0; i<=text.length-1; i++)
                {
                    var html = text.substr(i,1);
                    var sp="<span style='text-align: center !important' class='pwn'>" + html
                    sp+=" </span>";
                    $(v).append(sp);
                }
            })
        })

    </script>


    <div id="print_body">


        <div id="page1-header" style="background: #5098E4;">
            <table class="border-ccc no-border-f" style="margin: 0 auto !important">
                <tr>

                    <td style="-text-align:center !important; width: 400px">
                        <img src="{{ asset('images/alif_logo_transparent_w.png') }}" alt="" style="width: 70%">
                    </td>

                    <td style="">
                        <h2 style="text-align:center; font-weight: bold; color: #fff; font-size: 20px; line-height: 20px; font-family: Arial; b-order-left: 10px solid white">Admission Form</h2>
                        <h3 class="text-white font-bold text-md text-center">Form No. {{ $applicant->form_number }}</h3>
                    </td>

                    <td class="border-ccc no-border-f"
                        style="width: 110px; height: 60px; max-height: 60px; text-align: center; position: relative; padding: 0px !important">
                        <div style="width: 110px; height: 120px; position: absolute; top: 0px; left: 0px; background-color: #fff; overflow: hidden">
                            @if(is_null($applicant->photo))
                                PHOTO
                            @else
                                <img src="{{ asset('uploads/applicants/'.$applicant->photo) }}" alt="" style="width:95%; display: inline-block; margin: 0px auto;">
                            @endif
                        </div>
                    </td>
                </tr>
            </table>
        </div>


        <h5 class="visibility-hidden"
            style="background: #5098E4; color: white; text-transform: uppercase; font-weight: bold; text-align: center; padding: 3px 0px; margin-top: 2px !important; margin-bottom: 0px !important;">
            General Information</h5>


        <div id="general-information">
            <table class="border-ccc" style="margin: 0 auto !important">
                <tr>
                    <td class="border-ccc" style="width: 400px">
                        <span class="visibility-hidden">Which grade are you applying for: </span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $applicant->applyingGrade->title }}
                            @if($applicant->section)
                                ({{ $applicant->section->title }})
                            @endif
                    </td>

                    <td class="border-ccc">
                        <span class="visibility-hidden">Need transportation? </span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <span class="checkbox-boxy">
                            @if($applicant->need_transportation == 'yes')
                                <i class="fa fa-check"></i>
                            @else
                                <i class="empty-box"></i>
                            @endif
                        </span>
                        &nbsp;&nbsp;<span class="visibility-hidden">Yes</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        <span class="checkbox-boxy">
                           @if($applicant->need_transportation == 'no')
                                <i class="fa fa-check"></i>
                            @else
                                <i class="empty-box"></i>
                            @endif
                        </span>
                        &nbsp;&nbsp;<span class="visibility-hidden">No</span>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <span
                            class="visibility-hidden">How did you hear about us (Please mark one and name the source):</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <span class="checkbox-boxy">
                            @if($applicant->how_hear_about_us == "newspaper")
                                <i class="fa fa-check"></i>
                            @else
                                <i class="empty-box"></i>
                            @endif
                        </span> &nbsp;&nbsp;<span class="visibility-hidden">Newspaper</span>

                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        <span class="checkbox-boxy">
                            @if($applicant->how_hear_about_us == "television")
                                <i class="fa fa-check"></i>
                            @else
                                <i class="empty-box"></i>
                            @endif
                        </span> &nbsp;&nbsp;<span class="visibility-hidden">Television</span>

                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        <span class="checkbox-boxy">
                            @if($applicant->how_hear_about_us == "internet")
                                <i class="fa fa-check"></i>
                            @else
                                <i class="empty-box"></i>
                            @endif
                        </span> &nbsp;&nbsp;<span class="visibility-hidden">Internet</span>

                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        <span class="checkbox-boxy">
                            @if($applicant->how_hear_about_us == "references")
                                <i class="fa fa-check"></i>
                            @else
                                <i class="empty-box"></i>
                            @endif
                        </span> &nbsp;&nbsp;<span class="visibility-hidden">Reference</span>

                    </td>
                </tr>

            </table>

            <table class="border-ccc" style="margin: 0 auto !important">
                <tr>
                    <td>
                        <span class="visibility-hidden">Session: </span>{{ $applicant->session }}
                    </td>

                    <td>
                        <span
                            class="visibility-hidden">Admission No.: </span>{{ $applicant->admission_number }}
                    </td>

                    <td class="border-ccc" style="width: 450px">
                        <span
                            class="visibility-hidden">Name of Source:</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $applicant->source_name }}
                    </td>
                </tr>

                {{--<tr>
                    <td class="border-ccc">
                        <span
                            class="visibility-hidden">Session: </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $applicant->session }}
                    </td>
                    <td>
                        <span
                            class="visibility-hidden">Admission No.: </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $applicant->admission_number }}
                    </td>
                </tr>--}}
            </table>
        </div>


        <div id="student_information">

            <h5 class="visibility-hidden"
                style="background: #5098E4; color: white; text-transform: uppercase; font-weight: bold; text-align: center; padding: 3px 0px; margin-top: 0px !important; margin-bottom: 0px !important;">
                Student's Information</h5>

            <table class="border-ccc" style="margin: 0 auto !important">
                <tr>

                    <td class="border-ccc" style="width: 75px;">
                        <span class="visibility-hidden">Name: </span>
                    </td>

                    <td class="border-ccc">
                        &nbsp;&nbsp;&nbsp;{{ $applicant->name }}
                    </td>

                    <td class="border-ccc" style="width: 230px;">
                        <span class="visibility-hidden">Gender: </span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <span class="checkbox-boxy">
                            @if($applicant->gender == "male")
                                <i class="fa fa-check"></i>
                            @else
                                <i class="empty-box"></i>
                            @endif
                        </span>
                        &nbsp;&nbsp;<span class="visibility-hidden">Male</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <span class="checkbox-boxy">
                            @if($applicant->gender == "female")
                            <i class="fa fa-check"></i>
                            @else
                                <i class="empty-box"></i>
                            @endif
                        </span>
                        &nbsp;&nbsp;<span class="visibility-hidden">Female</span>
                    </td>
                </tr>
            </table>


            <table class="border-ccc" style="margin: 0 auto !important">
                <tr>

                    <td class="border-ccc" style="width: 75px;">
                        <span class="visibility-hidden">Date of Birth: </span>
                    </td>

                    <td class="border-ccc" style="width: 250px;">
                        &nbsp;&nbsp;&nbsp;<span class="visibility-hidden">in Figure</span>&nbsp;&nbsp;
                        <span class="bordered-text">{{ date("d", strtotime($applicant->dob)) }}</span>&nbsp;&nbsp;&nbsp;&nbsp;
                        <span class="bordered-text">{{ date("m", strtotime($applicant->dob)) }}</span>&nbsp;&nbsp;&nbsp;&nbsp;
                        <span class="bordered-text">{{ date("Y", strtotime($applicant->dob)) }}</span>&nbsp;&nbsp;
                    </td>

                    <td class="border-ccc">
                        &nbsp;&nbsp;&nbsp;<span class="visibility-hidden">in words: </span>&nbsp;&nbsp;
                        @php
                            $dob = \Carbon\Carbon::create($applicant->dob);
                            echo $dob->format('l jS \\of F Y');
                        @endphp
                    </td>

                </tr>


                {{--<tr>
                    <td class="border-cc" colspan="3">
                        <p style="padding: 8px 0px !important"></p>
                    </td>
                </tr>--}}

            </table>


            {{--<table class="border-ccc" style="margin: 0 auto !important">

                <tr>
                    <td colspan="4" class="border-ccc"><span
                            class="visibility-hidden">Address: </span>{{ $applicant->address }}</td>
                    <td class="border-ccc" style="width: 230px"></td>
                </tr>

                <tr>
                    <td class="border-ccc" style="width:165px"><span class="visibility-hidden">P.O. </span></td>
                    <td class="border-ccc"><span class="visibility-hidden">Village: </span></td>
                    <td class="border-ccc"><span class="visibility-hidden">Tehsil: </span></td>
                    <td class="border-ccc"><span class="visibility-hidden">District: </span></td>
                    <td class="border-ccc" style="width: 230px"><span class="visibility-hidden">Country: </span></td>
                </tr>

                <tr>
                    <td class="border-ccc">{{ $applicant->pobox }}</td>
                    <td class="border-ccc">{{ $applicant->village }}</td>
                    <td class="border-ccc">{{ $applicant->tehsil }}</td>
                    <td class="border-ccc">{{ $applicant->district->title ?? '' }}</td>
                    <td class="border-ccc" style="width: 230px">{{ $applicant->country->title ?? '' }}</td>
                </tr>
            </table>


            <table class="border-ccc" style="margin: 0 auto !important">
                <tr>
                    <td class="border-ccc"><span class="visibility-hidden">Home Phone No: </span></td>
                    <td class="border-ccc"><span class="visibility-hidden">Cell Phone No: </span></td>
                    <td class="border-ccc"><span class="visibility-hidden">Email Address: </span></td>
                </tr>

                <tr>
                    <td class="border-ccc">{{ $applicant->home_phone_number }}</td>
                    <td class="border-ccc">{{ $applicant->mobile_number }}</td>
                    <td class="border-ccc">{{ $applicant->email_address }}</td>
                </tr>
            </table>--}}


        </div>


        <div id="father_information">

            <h5 class="visibility-hidden"
                style="background: #5098E4; color: white; text-transform: uppercase; font-weight: bold; text-align: center; padding: 3px 0px; margin-top: 0px">
                Father / Guardian's Information</h5>

            <table class="border-ccc" style="margin: 0 auto !important;">
                <tr>

                    <td class="border-ccc" style="width: 140px; text-align: center">
                        <span class="visibility-hidden">Father/Guardian's Name: </span>
                    </td>

                    <td class="border-ccc">
                        &nbsp;&nbsp;&nbsp;{{ $applicant->father_name }}
                    </td>

                    <td class="border-ccc" style="width: 330px;">
                        <span class="visibility-hidden">CNIC: </span>
                        &nbsp;&nbsp;&nbsp;
                        <span class="bordered-text">{{ $applicant->father_cnic }}</span>
                    </td>
                </tr>
            </table>


            <table class="border-ccc" style="margin: 0 auto !important">
                <tr>

                    <td class="border-ccc" style="width: 80px;">
                        <span class="visibility-hidden">Cast: </span>
                    </td>

                    <td class="border-ccc" style="width: 280px;">
                        {{ $applicant->father_cast }}
                    </td>

                    <td class="border-ccc">
                        <span class="visibility-hidden">Tribe: </span>&nbsp;&nbsp;&nbsp;{{ $applicant->father_tribe }}
                    </td>

                </tr>


            </table>


            <table class="border-ccc" style="margin: 0 auto !important">
                <tr>

                    <td class="border-ccc" style="width: 80px;">
                        <span class="visibility-hidden">Occupation: </span>
                    </td>

                    <td class="border-ccc" style="width: 120px;">
                        {{ $applicant->father_occupation }}
                    </td>

                    <td class="border-ccc" style="width: 160px;">
                        <span class="visibility-hidden">Designation: </span>{{ $applicant->father_designation }}
                    </td>

                    <td class="border-ccc">
                        <span
                            class="visibility-hidden">Department: </span>&nbsp;&nbsp;&nbsp;{{ $applicant->father_department }}
                    </td>

                </tr>


            </table>


            <table class="border-ccc" style="margin: 0 auto !important">


                <tr>
                    <td class="border-ccc" style="width:200px"><span class="visibility-hidden">P. O. Box </span></td>
                    <td class="border-ccc" style="width:160px"><span class="visibility-hidden">City/ Village: </span>
                    </td>
                    <td class="border-ccc"><span class="visibility-hidden">Tehsil& District: </span></td>
                    <td class="border-ccc"><span class="visibility-hidden">Country: </span></td>
                </tr>

                <tr>
                    <td class="border-ccc">{{ $applicant->father_pobox }}</td>
                    <td class="border-ccc">{{ $applicant->father_village }}</td>
                    <td class="border-ccc">{{ $applicant->father_tehsil }} {{ $applicant->fatherDistrict->title ?? '' }}</td>
                    <td class="border-ccc" style="width: 230px">{{ $applicant->fatherCountry->title ?? '' }}</td>
                </tr>
            </table>


            <table class="border-ccc" style="margin: 0 auto !important">
                <tr>
                    <td class="border-ccc"><span class="visibility-hidden">Work Phone/whatsapp No: </span></td>
                    <td class="border-ccc"><span class="visibility-hidden">Cell Phone No: </span></td>
                    <td class="border-ccc" style="width:240px"><span class="visibility-hidden">Email Address: </span>
                    </td>
                </tr>

                <tr>
                    <td class="border-ccc">{{ $applicant->father_work_phone }}</td>
                    <td class="border-ccc">{{ $applicant->father_cell_phone }}</td>
                    <td class="border-ccc">{{ $applicant->father_email }}</td>
                </tr>
            </table>


        </div>


        <div id="mother_information">

            <h5 class="visibility-hidden"
                style="background: #5098E4; color: white; text-transform: uppercase; font-weight: bold; text-align: center; padding: 3px 0px; margin-top: 0px">
                Mother's/Guardian Information</h5>

            <table class="border-ccc" style="margin: 0 auto !important">
                <tr>

                    <td class="border-ccc" style="width: 25%">
                        <span class="visibility-hidden">Mother's/Guardian Name: </span>
                    </td>

                    <td class="border-ccc" style="width: 25%">
                        &nbsp;&nbsp;&nbsp;{{ $applicant->mother_name }}
                    </td>


                    <td class="border-ccc" style="width: 25%">
                        <span class="visibility-hidden">In-case of emergency phone number: </span>
                    </td>

                    <td class="border-ccc" style="width: 25%">
                        &nbsp;&nbsp;&nbsp;{{ $applicant->mother_cell_phone }}
                    </td>

                    {{--<td class="border-ccc" style="width: 330px;">
                        <span class="visibility-hidden">CNIC: </span>
                        &nbsp;&nbsp;&nbsp;
                        <span class="bordered-text">{{ $applicant->mother_cnic }}</span>
                    </td>--}}
                </tr>
            </table>


            {{--<table class="border-ccc" style="margin: 0 auto !important">
                <tr>

                    <td class="border-ccc" style="width: 80px;">
                        <span class="visibility-hidden">Cast: </span>
                    </td>

                    <td class="border-ccc" style="width: 280px;">
                        {{ $applicant->mother_cast }}
                    </td>

                    <td class="border-ccc">
                        <span class="visibility-hidden">Tribe: </span>&nbsp;&nbsp;&nbsp;{{ $applicant->mother_tribe }}
                    </td>

                </tr>


            </table>--}}


            <table class="border-ccc" style="margin: 0 auto !important">
                <tr>

                    <td class="border-ccc" style="width: 80px;">
                        <span class="visibility-hidden">Occupation: </span>
                    </td>

                    <td class="border-ccc" style="width: 120px;">
                        {{ $applicant->mother_occupation }}
                    </td>

                    <td class="border-ccc" style="width: 160px;">
                        <span class="visibility-hidden">Designation: </span>{{ $applicant->mother_designation }}
                    </td>

                    <td class="border-ccc">
                        <span
                            class="visibility-hidden">Department: </span>&nbsp;&nbsp;&nbsp;{{ $applicant->mother_department }}
                    </td>

                </tr>


            </table>


            {{--<table class="border-ccc" style="margin: 0 auto !important">


                <tr>
                    <td class="border-ccc" style="width:200px"><span class="visibility-hidden">P. O. Box </span></td>
                    <td class="border-ccc" style="width:160px"><span class="visibility-hidden">City/ Village: </span>
                    </td>
                    <td class="border-ccc"><span class="visibility-hidden">Tehsil& District: </span></td>
                    <td class="border-ccc"><span class="visibility-hidden">Country: </span></td>
                </tr>

                <tr>
                    <td class="border-ccc">{{ $applicant->mother_pobox }}</td>
                    <td class="border-ccc">{{ $applicant->mother_village }}</td>
                    <td class="border-ccc">{{ $applicant->mother_tehsil }} {{ $applicant->motherDistrict->title ?? '' }}</td>
                    <td class="border-ccc" style="width: 230px">{{ $applicant->motherCountry->title ?? '' }}</td>
                </tr>
            </table>--}}


            {{--<table class="border-ccc" style="margin: 0 auto !important">
                <tr>
                    <td class="border-ccc"><span class="visibility-hidden">Work Phone No: </span></td>
                    <td class="border-ccc"><span class="visibility-hidden">In-case of emergency phone number: </span></td>
                    <td class="border-ccc" style="width:240px"><span class="visibility-hidden">Email Address: </span>
                    </td>
                </tr>

                <tr>
                    <td class="border-ccc">{{ $applicant->mother_work_phone }}</td>
                    <td class="border-ccc">{{ $applicant->mother_cell_phone }}</td>
                    <td class="border-ccc">{{ $applicant->mother_email }}</td>
                </tr>
            </table>--}}


        </div>


        <div id="siblings_information">

           <h5 class="visibility-hidden"
                    style="background: #5098E4; color: white; text-transform: uppercase; font-weight: bold; text-align: center; padding: 3px 0px; padding-bottom: 0px; margin-top: 0px; margin-bottom: 0px; line-height: 10px">
                    Sibling's Information<br>
               <span style="text-transform: none; ">Does your child has a brother or sister attending this school? if YES then complete details below</span>
           </h5>





            <table class="border-ccc" style="margin: 0 auto !important">
                <tr>
                    <td class="border-ccc" style="width: 253px"><span class="visibility-hidden">NAME </span></td>
                    <td class="border-ccc" style="width: 225px"><span class="visibility-hidden">DATE OF BIRTH</span></td>
                    <td class="border-ccc"><span class="visibility-hidden">CLASS</span></td>
                    <td class="border-ccc"><span class="visibility-hidden">SESSION</span></td>
                </tr>


                @php
                    $total_fields = 5;
                @endphp
                @foreach($applicant->siblings as $sib)
                    <tr>
                        <td class="border-ccc">{{ $sib->name }}</td>
                        <td class="border-ccc">{{ date("d-M-Y", strtotime($sib->dob)) }}</td>
                        <td class="border-ccc">{{ $sib->class }}</td>
                        <td class="border-ccc">{{ $sib->session }}</td>
                    </tr>
                    @php $total_fields-- @endphp
                @endforeach


                @for($i = $total_fields; $i > 0; $i--)
                    <tr>
                        <td class="border-ccc"><p style="padding: 8px 0px !important"></p></td>
                        <td class="border-ccc"><p style="padding: 8px 0px !important"></p></td>
                        <td class="border-ccc"><p style="padding: 8px 0px !important"></p></td>
                        <td class="border-ccc"><p style="padding: 8px 0px !important"></p></td>
                    </tr>
                @endfor

            </table>


        </div>


        {{--<div id="eme_information">

            <h5 class="visibility-hidden"
                style="background: #5098E4; color: white; text-transform: uppercase; font-weight: bold; text-align: center; padding: 3px 0px; margin-top: 0px">
                Emergency Contact Information <span style="text-transform: none">(This person will be contacted if the parent or guardian is unable to be reached)</span></h5>

            <table class="border-ccc" style="margin: 0 auto !important">
                <tr>

                    <td class="border-ccc" style="width: 50px;">
                        <span class="visibility-hidden">Name: </span>
                    </td>

                    <td class="border-ccc">
                        &nbsp;&nbsp;&nbsp;{{ $applicant->eme_name }}
                    </td>

                    <td class="border-ccc" style="width: 330px;">
                        <span class="visibility-hidden">CNIC: </span>
                        &nbsp;&nbsp;&nbsp;
                        <span class="bordered-text">{{ $applicant->eme_cnic }}</span>
                    </td>
                </tr>
            </table>




            <table class="border-ccc" style="margin: 0 auto !important">
                <tr>

                    <td class="border-ccc" style="width: 80px;">
                        <span class="visibility-hidden">Occupation: </span>
                    </td>

                    <td colspan="2" class="border-ccc" style="width: 120px;">
                        {{ $applicant->eme_occupation }}
                    </td>



                    <td class="border-ccc"></td>

                </tr>


                <tr>

                    <td class="border-ccc" style="width: 80px;">
                        <span class="visibility-hidden">Designation: </span>
                    </td>

                    <td class="border-ccc" style="width: 120px;">
                        {{ $applicant->eme_designation }}
                    </td>

                    <td class="border-ccc" style="width: 160px;">

                    </td>

                    <td class="border-ccc">
                        <span
                            class="visibility-hidden">Department: </span>&nbsp;&nbsp;&nbsp;{{ $applicant->eme_department }}
                    </td>

                </tr>


            </table>


            <table class="border-ccc" style="margin: 0 auto !important">


                <tr>
                    <td class="border-ccc" style="width:200px"><span class="visibility-hidden">P. O. Box </span></td>
                    <td class="border-ccc" style="width:160px"><span class="visibility-hidden">City/ Village: </span>
                    </td>
                    <td class="border-ccc"><span class="visibility-hidden">Tehsil& District: </span></td>
                    <td class="border-ccc"><span class="visibility-hidden">Country: </span></td>
                </tr>

                <tr>
                    <td class="border-ccc">{{ $applicant->eme_pobox }}</td>
                    <td class="border-ccc">{{ $applicant->eme_village }}</td>
                    <td class="border-ccc">{{ $applicant->eme_tehsil }} {{ $applicant->emeDistrict->title ?? '' }}</td>
                    <td class="border-ccc" style="width: 230px">{{ $applicant->emeCountry->title ?? '' }}</td>
                </tr>
            </table>


            <table class="border-ccc" style="margin: 0 auto !important">
                <tr>
                    <td class="border-ccc"><span class="visibility-hidden">Work Phone No: </span></td>
                    <td class="border-ccc"><span class="visibility-hidden">Cell Phone No: </span></td>
                    <td class="border-ccc" style="width:240px"><span class="visibility-hidden">Email Address: </span>
                    </td>
                </tr>

                <tr>
                    <td class="border-ccc">{{ $applicant->eme_work_phone }}</td>
                    <td class="border-ccc">{{ $applicant->eme_cell_phone }}</td>
                    <td class="border-ccc">{{ $applicant->eme_email }}</td>
                </tr>
            </table>


        </div>--}}


        {{--<div class="newpage"></div>--}}


        <div id="academic_information">

            <h5 class="visibility-hidden"
                style="background: #5098E4; color: white; text-transform: uppercase; font-weight: bold; text-align: center; padding: 3px 0px; padding-bottom: 0px; margin-top: 0px; margin-bottom: 0px; line-height: 10px">Prior School Information
                {{--<span style="text-transform: none; ">Please use an extra sheet if needed</span>--}}
            </h5>





            <table class="border-ccc" style="margin: 0 auto !important">

                <tr>
                    <td colspan="2" class="border-ccc">Prior Schools Attended</td>
                    <td class="border-ccc">Date From</td>
                    <td class="border-ccc">Date To</td>
                    <td class="border-ccc">City, Tehsil, District, Country, Tel, Fax</td>
                    <td class="border-ccc">SLC Received</td>
                </tr>

                @php
                    $total_fields = 1;
                    $this_sn = 1;
                @endphp
                @foreach($applicant->academics as $acd)
                    <tr>
                        <td class="border-ccc">{{ $this_sn }}</td>
                        <td class="border-ccc">{{ $acd->school }}</td>
                        <td class="border-ccc">{{ date("d / M / Y", strtotime($acd->from_date)) }}</td>
                        <td class="border-ccc">{{ date("d / M / Y", strtotime($acd->to_date)) }}</td>
                        <td class="border-ccc">{{ $acd->address }}</td>
                        <td class="border-ccc">{{ $acd->slc_received }}</td>
                    </tr>
                    @php $total_fields--; $this_sn++; @endphp
                @endforeach

                @for($i = $total_fields; $i > 0; $i--)
                    <tr>
                        <td class="border-ccc">{{ $this_sn }}</td>
                        <td class="border-ccc"></td>
                        <td class="border-ccc"></td>
                        <td class="border-ccc"></td>
                        <td class="border-ccc"></td>
                    </tr>
                    @php $this_sn++; @endphp
                @endfor

            </table>


        </div>




        <div id="contract_information">

            <h5 class="visibility-hidden"
                style="background: #5098E4; color: white; text-transform: uppercase; font-weight: bold; text-align: center; padding: 3px 0px; padding-bottom: 0px; margin-top: 0px; margin-bottom: 0px; line-height: 10px">Medical Information</h5>





            <table class="border-ccc" style="margin: 0 auto !important">


                <tr>
                    <td class="border-ccc">Indicate any health conditions that your child may suffer from, such as:</td>
                </tr>

                <tr>
                    <td class="border-ccc">
                        @foreach($diseases as $adid => $adtitle)
                            <span class="checkbox-boxy">

                                @php
                                    $diseaseExists = $applicant->applicantDiseases->where('id', $adid);
                                    // echo $diseaseExists->count();
                                @endphp

                                @if($diseaseExists->count() > 0)
                                    <i class="fa fa-check"></i>
                                @else
                                    <i class="empty-box"></i>
                                @endif
                            </span>
                            &nbsp;&nbsp;<span class="visibility-hidden">{{ $adtitle }}</span>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        @endforeach
                    </td>
                </tr>


                <tr>
                    <td class="border-ccc">Please indicate if the student has had any major operations or injuries (Specify):</td>
                </tr>


                <tr>
                    @if($applicant->doctors->count() > 0)
                        <td class="border-ccc">{{ $applicant->doctors[0]->major_surgeries }}</td>
                    @else
                        <td class="border-ccc"><p style="padding: 8px 0px !important"></p></td>
                    @endif
                </tr>



                <tr>
                    <td class="border-ccc">Indicate if the student takes any medications (Please explain):</td>
                </tr>


                <tr>
                    @if($applicant->doctors->count() > 0)
                        <td class="border-ccc">{{ $applicant->doctors[0]->medications }}</td>
                    @else
                        <td class="border-ccc"><p style="padding: 8px 0px !important"></p></td>
                    @endif
                </tr>


            </table>


            <table class="border-ccc" style="margin: 0 auto !important">
                <tr>
                    <td class="border-ccc">Doctor's Name:</td>
                    <td class="border-ccc">Address:</td>
                    <td class="border-ccc">Phone:</td>
                </tr>

                @if($applicant->doctors->count() > 0)
                    <tr>
                        <td class="border-ccc">{{ $applicant->doctors[0]->doctor_name }}</td>
                        <td class="border-ccc">{{ $applicant->doctors[0]->address }}</td>
                        <td class="border-ccc">{{ $applicant->doctors[0]->phone_number }}</td>
                    </tr>
                @else
                    <tr>
                        <td class="border-ccc"><p style="padding: 8px 0px !important"></p></td>
                        <td class="border-ccc"><p style="padding: 8px 0px !important"></p></td>
                        <td class="border-ccc"><p style="padding: 8px 0px !important"></p></td>
                    </tr>
                @endif

            </table>



            <table style="margin: 0 auto !important; margin-top: 20px !important; margin-bottom: 0px !important">

                <tr>
                    <td colspan="3" style="font-size: 10px !important">This application becomes a binding contract upon the undersigned only when the applicant has passed the entrance exam and successfully being enrolled in the school. Alif Education System Administration reserves the right to admit or reject the applicant if such action is deemed necessary and is seen in the best interest of the school. It is understood that classes are strictly limited and priority is given to those students and their siblings who are currently enrolled in the school. Alif Education System is presently not equipped to handle Special Education classes</td>
                </tr>


                {{--<tr>
                    <td style="width: 400px"></td>

                    <td style=" width: 200px; padding-right: 20px">
                        <p style="border-bottom: 1px solid #ccc;">.</p>
                        <p>Signature of Parent / Guardian</p>
                    </td>

                    <td style="width: 100px">

                        <p style="border-bottom: 1px solid #ccc">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            /
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            /

                        </p>
                        <p>Date</p>
                    </td>
                </tr>--}}
            </table>



            <table style="margin: 0 auto !important; ">

                <tr>
                    <td colspan="2">
                        <p style="font-size: 11px"><strong>Parent - Student Contract</strong></p>
                    </td>
                </tr>


                <tr>
                    <td colspan="2" style="font-size: 10px !important">
                        I/We, (parent's name)
                        <span style="border-bottom: 1px solid #000; padding: 0px 20px !important"><strong>{{ $applicant->father_name }}</strong></span>
                        and (student's name)
                        <span style="border-bottom: 1px solid #000; padding: 0px 20px !important"><strong>{{ $applicant->name }}</strong></span>
                        agree and accept without reservation, to abid by, and follow all rules, regulation and procedures of Alif Education System as stated in the parent's handbook. We accept the course of disciplinary action which will be instituted if any rule or regulation is not followed and will also pay for any school property that is damaged by our child. We accept that the principal's decision in all matters relating to this school is final.
                        <br>
                        I authorize Alif Education to photograph or video tape my child for publication(s).
                    </td>
                </tr>


                {{--<tr>
                    <td style="padding-top: 10px !important; width: 44%">
                        Parent's Signature __________________________
                    </td>

                    <td style="padding-top: 10px !important">
                        Date __________________________
                    </td>
                </tr>--}}

            </table>



        </div>




        <div id="office_use_information">

            {{--<h4 class="visibility-hidden"
                style="background: #5098E4; color: white; text-transform: uppercase; font-weight: bold !important; text-align: center; padding: 5px 0px !important; margin-top: 20px !important; margin-bottom: 20px !important; line-height: 13px !important; font-size: 14px !important;">For Office Use Only
            </h4>--}}



            <table class="" style="margin: 0 auto !important;" >

                {{--<tr>
                    <td class="border-b-ou" style="width: 49%; padding-top: 30px !important;">
                        <span class="ou_box">Student Name:</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;<strong>{{ $applicant->name }}</strong>
                    </td>

                    <td style="width: 2%"></td>

                    <td class="border-b-ou" style="width: 49%; padding-top: 30px !important;">
                        <span class="ou_box">Father Name:</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;<strong>{{ $applicant->father_name }}</strong>
                    </td>
                </tr>

                <tr>
                    <td class="border-b-ou" style="padding-top: 30px !important;">
                        <span class="ou_box">Class in which admitted</span>
                    </td>

                    <td></td>

                    <td class="border-b-ou" style="padding-top: 30px !important;">
                        <span class="ou_box">Admission No.</span>
                    </td>
                </tr>

                <tr>
                    <td class="border-b-ou" style="padding-top: 30px !important;">
                        <span class="ou_box">Remarks:</span>
                    </td>

                    <td></td>

                    <td class="border-b-ou" style="padding-top: 30px !important;">
                        <span class="ou_box">Date of Admission</span>
                    </td>
                </tr>--}}


                {{--<tr>

                    <td class="border-b-ou" style="padding-top: 35px !important;">

                    </td>

                    <td></td>

                    <td></td>
                </tr>--}}


                <tr>

                    <td style="padding-top: 10px !important; width: 230px; b-order: 1px solid red">
                        Parent's Signature __________________________
                    </td>

                    <td style="padding-top: 10px !important; width: 140px;  b-order: 1px solid red">
                        Date __________________
                    </td>



                    <td style="padding-top: 10px !important; padding-left: 50px; b-order: 1px solid red">
                        Principal's Sign/Stamp __________________________
                    </td>

                    {{--<td class="border-b-ou" style="padding-top: 10px !important;">
                        <span class="ou_box">Principal's signature and stamp:</span>
                    </td>--}}

                    {{--<td></td>

                    <td class="border-b-ou" style="padding-top: 30px !important;">
                        <span class="ou_box">Date of Admission</span>
                    </td>--}}
                </tr>

            </table>


        </div>



    </div>


</div>
