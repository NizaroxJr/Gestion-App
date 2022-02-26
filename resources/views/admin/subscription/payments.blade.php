<x-admin-component>

@section('CustomStyles')
<link href="{{asset('plugins/tags/tagsinput.css')}}" rel="stylesheet" type="text/css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@stop

@section('content')
<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Checkout page') }}</div>

                <div class="card-body">
                    <form id="payment-form" action="{{ route('payments.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="plan" id="plan" value="{{ request('plan') }}">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" id="card-holder-name" class="form-control" value="" placeholder="Name on the card">
                        </div>
                        <div class="form-group">
                            <label for="">Card details</label>
                            <div id="card-element"></div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100" id="card-button" data-secret="{{ $intent->client_secret }}">Pay</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('CustomScripts')
<script>
const stripe = Stripe('{{ config('cashier.key') }}')

    const elements = stripe.elements()
    const cardElement = elements.create('card')

    cardElement.mount('#card-element')

    const form = document.getElementById('payment-form')
    const cardBtn = document.getElementById('card-button')
    const cardHolderName = document.getElementById('card-holder-name')

    form.addEventListener('submit', async (e) => {
        e.preventDefault()

        cardBtn.disabled = true
        const { setupIntent, error } = await stripe.confirmCardSetup(
            cardBtn.dataset.secret, {
                payment_method: {
                    card: cardElement,
                    billing_details: {
                        name: cardHolderName.value
                    }
                }
            }
        )

        if(error) {
            cardBtn.disable = false
        } else {
            let token = document.createElement('input')

            token.setAttribute('type', 'hidden')
            token.setAttribute('name', 'token')
            token.setAttribute('value', setupIntent.payment_method)

            form.appendChild(token)

            form.submit();
        }
    })
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"

        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"

        crossorigin="anonymous">

</script>

<script src="{{asset('plugins/tags/tagsinput.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@stop
</x-admin-component>
