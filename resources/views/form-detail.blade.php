<style>
    .table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
        padding: 4px 10px;
        line-height: 1.42857143;
        vertical-align: top;
        border-top: 1px solid #ddd;
    }
    .header-name h3 {
        font-size: 20px;
        margin-top: 4px;
        font-style: oblique;
    }

    .singnature span {
        border-top: 1px dotted #ede;
        padding: 7px 15px;
    }

    .c-address address {
        border-top: 5px solid #ddd;
        border-bottom: 5px solid #ddd;
        padding: 10px 20px;
    }

    @media print {
        .header-border {
            -webkit-print-color-adjust: exact;
            margin-top: 5px;
        }

        .nid-hide {
            display: none !important;
        }

        .uppercase {
            text-transform: uppercase;
        }
    }

    fieldset {
        border: 3px solid #ddd !important;
        margin: 0;
        min-width: 0;
        padding: 5px;
        position: relative;
        border-radius: 4px;
        padding-left: 10px !important;
    }

    legend {
        font-size: 14px;
        font-weight: bold;
        margin-bottom: 0px;
        width: auto;
        border: 3px solid #ddd;
        border-radius: 4px;
        padding: 5px 5px 5px 10px;
        background-color: #ffffff;
        display: inline-block;
    }

</style>
<div class="printDiv">
    <button type="button" class="btn btn-success" onclick="printDiv('print_id');">Print</button>

    <div class="" id="print_id">
        <style type="text/css" media="print">

            @import

            {
            "/bower_components/bootstrap/dist/css/bootstrap.min.css"
            }
        </style>
        <div style="margin-bottom: 5px;">
            <div id="image_preview" style="
                position: absolute;
                width: 160px;
                height: 140px;
                margin-top: 2px;
                display: block;
                overflow: hidden;
                right: 0;
                top: 0px;">
                <img width="140px" height="160px" src="{{ asset($form->photo2) }}">
            </div>

            <div class="content_area" style="width: 100%;" align="center">BANGLADESH JUTE MILLS CORPORATION
                <br>
                Application Form for Enlistment with BJMC as a Local Buyer of Jute Goods <br>
                <p align="center">
                    <strong>Tracking Number :</strong> {{$form->trackingNumber}}
                </p>
            </div>


        </div>

        <div style="margin-top: 80px">
            <div class="">
                <fieldset>
                    <legend>Particulars of the Applicant</legend>

                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <th style="width: 200px">Name:</th>
                            <td style="width: 240px">{{$form->name}}</td>
                            <th style="width: 200px"></th>
                            <td style="width: 240px"></td>
                        </tr>
                        <tr>
                            <th style="width: 200px">Father Name:</th>
                            <td style="width: 240px">{{$form->fatherName}}</td>
                            <th style="width: 200px">Mother Name:</th>
                            <td style="width: 240px">{{$form->motherName}}</td>
                        </tr>
                        <tr>
                            <th style="width: 200px">Mobile No:</th>
                            <td style="width: 240px">{{$form->mobile}}</td>
                            <th style="width: 200px">Email:</th>
                            <td style="width: 240px">{{$form->designation}}</td>
                        </tr>
                        <tr>
                            <th style="width: 200px">Religion:</th>
                            <td style="width: 240px">{{$form->profession}}</td>
                            <th style="width: 200px">Gender</th>
                            <td style="width: 240px">{{$form->annualIncome}}</td>
                        </tr>
                        <tr>
                            <th style="width: 200px">Marital Status:</th>
                            <td style="width: 240px">{{$form->bname}}</td>
                            <th style="width: 200px">Blood Group:</th>
                            <td style="width: 240px">{{$form->poootao}}</td>
                        </tr>
                        <tr>
                            <th style="width: 200px">Nationality:</th>
                            <td style="width: 240px">{{$form->country}}</td>
                            <th style="width: 200px">NID:</th>
                            <td style="width: 240px">{{$form->NID}}</td>
                        </tr>
                        <tr>
                            <th style="width: 200px">Date of Birth:</th>
                            <td style="width: 240px">{{$form->birth}}</td>
                            <th style="width: 200px">Quota:</th>
                            <td style="width: 240px">{{$form->bankAccNo}}</td>
                        </tr>
                        <tr>
                            <th style="width: 200px">Departmental Candidate Status:</th>
                            <td style="width: 240px">{{$form->bankName}}</td>
                        </tr>

                        </tbody>
                    </table>
                </fieldset>
            </div>

             <div class="" style="margin-top:12px">
                <fieldset>
                    <legend>Address Information</legend>
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <th colspan="2" style="text-align: center; width: 440px">Permanent Address</th>
                            <th colspan="2" style="text-align: center; width: 440px">Present Address</th>

                        </tr>
                        <tr>
                            <th style="width: 200px">House: / Village:</th>
                            <td style="width: 240px">{{$form->permenentAddress}}</td>
                            <th style="width: 200px">House: / Village:</th>
                            <td style="width: 240px">{{$form->currentAddress}}</td>
                        </tr>
                        <tr>
                            <th style="width: 200px">Post Office:</th>
                            <td style="width: 240px">{{$form->permenentAddressPostOffice}}</td>
                            <th style="width: 200px">Post Office:</th>
                            <td style="width: 240px">{{$form->currentAddressPostOffice}}</td>
                        </tr>
                        <tr>
                            <th style="width: 200px">Thana/Upazila/Area :</th>
                            <td style="width: 240px">{{$form->Upazila->name}}</td>
                            <th style="width: 200px">Thana/Upazila/Area :</th>
                            <td style="width: 240px">{{$form->PresentUpazila->name}}</td>
                        </tr>
                        <tr>
                            <th style="width: 200px">District :</th>
                            <td style="width: 240px">{{$form->upazila->district->name}}</td>
                            <th style="width: 200px">District :</th>
                            <td style="width: 240px">{{$form->PresentUpazila->district->name}}</td>
                        </tr>
                        </tbody>
                    </table>
                </fieldset>
            </div>

            <div class="" style="margin-top:12px">
                <fieldset>
                    <legend>Academic Qualifications:</legend>
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <th style="text-align: center; width: 16%">Education Level</th>
                            <th style="text-align: center; width: 16%">Board</th>
                            <th style=" text-align: center;width: 20%">Department</th>
                            <th style="text-align: center; width: 24%">Institution</th>
                            <th style="text-align: center;width: 12%">Passing Year</th>
                            <th style="text-align: center; width: 12%">Result</th>
                        </tr>
                        @if($form->pito!=NULL)
                            <tr>
                                <td style="text-align: center; width: 16%">{{$form->pito}}</td>
                                <td style="text-align: center; width: 16%">{{$form->poootao}}</td>
                                <td style=" text-align: center;width: 20%">{{$form->APss}}</td>
                                <td style="text-align: center; width: 24%">{{$form->APpos}}</td>
                                <td style="text-align: center;width: 12%">{{$form->ponum}}</td>
                                <td style="text-align: center; width: 12%">{{$form->APname}}</td>
                            </tr>
                        @endif
                        @if($form->e2EL!=NULL)
                            <tr>
                                <td style="text-align: center; width: 16%">{{$form->e2EL}}</td>
                                <td style="text-align: center; width: 16%">{{$form->e2BD}}</td>
                                <td style=" text-align: center;width: 20%">{{$form->e2CON}}</td>
                                <td style="text-align: center; width: 24%">{{$form->e2INS}}</td>
                                <td style="text-align: center;width: 12%">{{$form->e2PY}}</td>
                                <td style="text-align: center; width: 12%">{{$form->e2R}}</td>
                            </tr>
                        @endif
                        @if($form->e3EL!=NULL)
                            <tr>
                                <td style="text-align: center; width: 16%">{{$form->e3EL}}</td>
                                <td style="text-align: center; width: 16%"></td>
                                <td style=" text-align: center;width: 20%">{{$form->e3SJ}}</td>
                                <td style="text-align: center; width: 24%">{{$form->e3INS}}</td>
                                <td style="text-align: center;width: 12%">{{$form->e3PY}}</td>
                                <td style="text-align: center; width: 12%">{{$form->e3R}}</td>
                            </tr>
                        @endif
                        @if($form->photo10!=NULL)
                            <tr>
                                <td style="text-align: center; width: 16%">{{$form->photo10}}</td>
                                <td style="text-align: center; width: 16%"></td>
                                <td style=" text-align: center;width: 20%">{{$form->OEGname}}</td>
                                <td style="text-align: center; width: 24%">{{$form->NOHname}}</td>
                                <td style="text-align: center;width: 12%">{{$form->PITO2}}</td>
                                <td style="text-align: center; width: 12%">{{$form->mota}}</td>
                            </tr>
                        @endif

                        </tbody>
                    </table>
                </fieldset>
            </div>

        </div>

    </div>

</div>

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });

    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>