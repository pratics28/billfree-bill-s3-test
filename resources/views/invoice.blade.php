<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body style="height=100%; width:100%;">
   <header>
        <img src="{{ public_path().'/logo.jpeg' }}" height="100" width="100" style="margin-left:105px;"/>
   </header>

   <section class="mt-5">
        <div class="container">
            <div class="row to-from-user-detail">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body border-dark mb-3">
                            <p class="card-text text-primary" style="font-weight:500;">Your Details:</li>
                            <p class="card-text text-secondary" style="line-height:1px; font-weight:500;">From</li>
                            <p class="card-text" style="font-weight:500;">{{ isset($invoice->fromUser->name) ? $invoice->fromUser->name : '' }}</p>
                            <p class="card-text text-secondary" style="font-size:12px; font-weight:500;">{{ isset($invoice->fromUser->address) ? $invoice->fromUser->address : '' }}</p>
                            <p class="card-text text-secondary" style="font-size:12px; font-weight:500;">{{ isset($invoice->fromUser->email) ? $invoice->fromUser->email : '' }} <br/>
                                    {{ isset($invoice->fromUser->mobile_code) ? $invoice->fromUser->mobile_code : '' }}
                                    {{ isset($invoice->fromUser->mobile_number) ? $invoice->fromUser->mobile_number : '' }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-body border-dark mb-3">
                            <p class="card-text text-primary" style="font-weight:500;">Client Details:</li>
                            <p class="card-text text-secondary" style="line-height:1px; font-weight:500;">To</li>
                            <p class="card-text" style="font-weight:500;">{{ isset($invoice->toUser->name) ? $invoice->toUser->name : '' }}</p>
                            <p class="card-text text-secondary" style="font-size:12px; font-weight:500;">{{ isset($invoice->toUser->address) ? $invoice->toUser->address : '' }}</p>
                            <p class="card-text text-secondary" style="font-size:12px; font-weight:500;">{{ isset($invoice->toUser->email) ? $invoice->toUser->email : '' }} <br/>
                                    {{ isset($invoice->toUser->mobile_code) ? $invoice->toUser->mobile_code : '' }}
                                    {{ isset($invoice->toUser->mobile_number) ? $invoice->toUser->mobile_number : '' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5" style="font-size:16px; font-weight:500;">
                <div class="col-6">
                    <span style="font-weight:500;">Invoice No:</span> <span class="text-secondary" style="font-weight:500;"> {{ $invoice->invoice_no }}</span>
                </div>
                <div class="col-6">
                    <span style="font-weight:500;">Invoice Date:</span> <span class="text-secondary" style="font-weight:500;"> {{ $invoice->created_at ? date('F jS, Y', strtotime($invoice->created_at)) : '' }}</span>
                </div>
                <div class="col-6">
                    <span style="font-weight:500;">Due Date:</span> <span class="text-secondary" style="font-weight:500;"> {{ $invoice->due_date ? date('F jS, Y', strtotime($invoice->due_date)) : '' }}</span>
                </div>
            </div>

            <div class="row mt-5" style="font-size:16px; font-weight:500;">
                <table class="table table-striped">
                    <thead class="table-light">
                        <th>Item</th>
                        <th>HRS/QTY</th>
                        <th>Rate</th>
                        <th>Tax</th>
                        <th>Subtotal</th>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @if(isset($invoice->lineItems))
                            @forelse($invoice->lineItems as $lineItem)
                            <tr class="text-secondary">
                                <td>{{ $lineItem->item }}</td>
                                <td>{{ $lineItem->quantity }}</td>
                                <td>{{ $lineItem->rate }}</td>
                                <td>{{ $lineItem->tax }}</td>
                                <td>{{ $lineItem->sub_total }}</td>
                            </tr>
                            @php $total += $lineItem->sub_total; @endphp
                            @empty
                            @endforelse
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="row mt-5" style="font-size:16px; font-weight:500;">
                <div class="col-md-12">
                    <table class="table table-responsive-sm" style="width: 300px; margin-left: 75%;">
                        <thead class="table-light">
                            <th colspan="2">Invoice Summary</th>
                        </thead>
                        <tbody>
                            @if(isset($invoice->lineItems))
                                <tr class="text-secondary">
                                    <td>Sub Total</td>
                                    <td>USD {{ $total }}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
   </section>
</body>
</html>
