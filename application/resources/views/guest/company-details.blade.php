<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="px-4 sm:px-0">
        <h3 class="text-base font-semibold leading-7 text-gray-900">Company Information</h3>
    </div>
    <div class="mt-6 border-t border-gray-100">
        <dl class="divide-y divide-gray-100">
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">Name</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $company->name }}</dd>
            </div>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">Logo</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <img
                        class="h-12 w-12 flex-none rounded-full bg-gray-50" src="{{ asset($company->logo) }}"
                        alt="Company Logo"></dd>
            </div>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">Description</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $company->description }}</dd>
            </div>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">Address</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $company->address }}</dd>
            </div>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">Real-time Financial Details</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    <li>Stock Value: $ {{ number_format($financialDetails['p'], 2) }}</li>
                    <li>Volume: {{ $financialDetails['v'] }}</li>
                    <li>Timestamp: {{ $financialDetails['t'] }}</li>
                </dd>
            </div>


        </dl>
    </div>
</div>

@script
    <script>
        const finnhubKey = "{{ config('services.finnhub.token') }}";
        const socket = new WebSocket(`wss://ws.finnhub.io?token=${finnhubKey}`);

        // TODO:this is static symbol for now because this is
        //  the one that only working from finnhub ,
        //  However after ingrating with paid service we can use:
        // 'symbol': @json($company->symbol)
        // in the request body
        socket.addEventListener('open', function(event) {
            socket.send(JSON.stringify({
                'type': 'subscribe',
                'symbol': 'BINANCE:BTCUSDT',
            }))
        });

        socket.addEventListener('message', function(event) {
            var data = JSON.parse(event.data);
            if (data.data) {
                $wire.dispatch('financial-details-updated', [
                    data.data[0]
                ]);
            } else {
                console.log('no data provided from the third party');
            }
        });
    </script>
@endscript
