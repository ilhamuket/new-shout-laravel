@extends('payment::layouts.master')

@section('content')
    <button type="button" class="btn btn-primary" id="pay-button">Primary</button>
@endsection

@push('scripts')
<script>
    document.getElementById('pay-button').onclick = function () {
        console.log('Button clicked');
        fetch('/payment/create-payment')
            .then(response => response.json())
            .then(data => {
                snap.pay(data.snap_token, {
                    onSuccess: function(result) { console.log('Success', result); },
                    onPending: function(result) { console.log('Pending', result); },
                    onError: function(result) { console.log('Error', result); },
                    onClose: function() { console.log('Customer closed the popup without finishing the payment'); }
                });
            });
    };
</script>
@endpush
