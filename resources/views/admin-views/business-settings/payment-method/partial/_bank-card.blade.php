{{-- {{ dd($bank) }} --}}
@foreach ($bank as $b)
<div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
    <a type="button" data-toggle="modal" data-target="#exampleModal{{ $b['code'] }}"
        class="btn w-100 h-100 {{ $b['is_activated'] == 'false' ? '' : 'disabled'}}">
        <div class="card card-body card-hover-shadow h-100 text-white text-center" style="background-color: #22577A;">
            <h1 class="p-2 text-white">{{$b['name']}}</h1>
            {{-- <div class="text-uppercase">{{\App\CPU\translate('commission_earned')}}</div> --}}
        </div>
    </a>
</div>

<div class="modal fade" id="exampleModal{{ $b['code'] }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ $b['name'] }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('admin.business-settings.xendit-payment.vaCreate') }}">
                @csrf
            <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="bank" value="{{ $b['code'] }}">
                        <label for="name" class="col-form-label">Insert your name:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create Virtual Account</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- @include('admin-views.business-settings.payment-method.partial._modal-bank',[$bank]) --}}
@endforeach
