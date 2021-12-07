@extends('layouts.back-end.app')

@section('title', \App\CPU\translate('Payment Method'))

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a
                        href="{{route('admin.dashboard')}}">{{\App\CPU\translate('Dashboard')}}</a></li>
                <li class="breadcrumb-item">{{\App\CPU\translate('xendit_payment')}}</li>
                <li class="breadcrumb-item" aria-current="page">{{\App\CPU\translate('xendit_virtual_account')}}</li>
            </ol>
        </nav>

        <div class="row" style="padding-bottom: 20px">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body" style="padding: 20px">
                        <h5 class="text-center">{{\App\CPU\translate('Xendit_Virtual_Account')}}</h5>
                        {{-- @php($config=\App\CPU\Helpers::get_business_settings('cash_on_delivery')) --}}
                        {{-- {{ dd($virtual) }} --}}
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="flex-between gx-2 gx-lg-3 mb-2">
                                    <div>
                                        <h4><i style="font-size: 30px"
                                            class="tio-chart-line-up"></i>{{\App\CPU\translate('Your_Virtual_Account_for_Payment')}}</h4>
                                    </div>
                                </div>
                                <div class="row gx-2 gx-lg-3 justify-content-center" id="virtual-account">
                                    <div class="col-md-8">
                                        <div class="card">
                                            <div class="card-header text-capitalize">
                                                {{\App\CPU\translate('Virtual')}} {{\App\CPU\translate('Account')}} <br>
                                            </div>
                                            <div class="card-body">
                                                <div class="card-body" style="text-align: {{Session::get('direction') === " rtl" ? 'right' : 'left'
                                                    }};">
                                                    <div class="flex-start">
                                                        <div>
                                                            <h4>Status : </h4>
                                                        </div>
                                                        <div class="mx-1">
                                                            <h4>{!! $virtual['status']=='PENDING'?'<label
                                                                    class="badge badge-danger">PENDING</label>':'<label
                                                                    class="badge badge-success">Active</label>' !!}</h4>
                                                        </div>
                                                    </div>
                                                    <div class="flex-start">
                                                        <div>
                                                            <h5>{{\App\CPU\translate('name')}} : </h5>
                                                        </div>
                                                        <div class="mx-1">
                                                            <h5>{{$virtual['name']}}</h5>
                                                        </div>
                                                    </div>
                                                    <div class="flex-start">
                                                        <div>
                                                            <h5>{{\App\CPU\translate('Account_Number')}} : </h5>
                                                        </div>
                                                        <div class="mx-1">
                                                            <h5>{{$virtual['account_number']}}</h5>
                                                        </div>
                                                    </div>
                                                    <div class="flex-start">
                                                        <div>
                                                            <h5>{{\App\CPU\translate('Bank')}} : </h5>
                                                        </div>
                                                        <div class="mx-1">
                                                            <h5>{{$virtual['bank_code']}}</h5>
                                                        </div>
                                                    </div>
                                                    <div class="flex-start">
                                                        <div>
                                                            <h5>{{\App\CPU\translate('Expiration_Date')}} : </h5>
                                                        </div>
                                                        <div class="mx-1">
                                                            <h5>{{$virtual['expiration_date']}}</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection

@push('script')
    <script>
        function copyToClipboard(element) {
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($(element).text()).select();
            document.execCommand("copy");
            $temp.remove();
            toastr.success("{{\App\CPU\translate('Copied to the clipboard')}}");
        }
    </script>
@endpush
