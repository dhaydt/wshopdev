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
                <li class="breadcrumb-item" aria-current="page">{{\App\CPU\translate('xendit_payment')}}</li>
            </ol>
        </nav>

        <div class="row" style="padding-bottom: 20px">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body" style="padding: 20px">
                        <h5 class="text-center">{{\App\CPU\translate('Xendit_Payment')}}</h5>
                        {{-- @php($config=\App\CPU\Helpers::get_business_settings('cash_on_delivery')) --}}
                        {{-- {{ dd($bank) }} --}}
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="flex-between gx-2 gx-lg-3 mb-2">
                                    <div>
                                        <h4><i style="font-size: 30px"
                                            class="tio-chart-line-up"></i>{{\App\CPU\translate('Select_Bank_for_Virtual_Account_Payment')}}</h4>
                                    </div>
                                </div>
                                <div class="row gx-2 gx-lg-3" id="order_stats">
                                    @include('admin-views.business-settings.payment-method.partial._bank-card',['data'=>$bank])
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
