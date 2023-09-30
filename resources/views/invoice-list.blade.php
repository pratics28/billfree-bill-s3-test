<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body style="height=100%; width:100%;">
   <section class="mt-5">
        <div class="container">
            <div class="row mt-5" style="font-size:16px; font-weight:500;">
                <table class="table table-striped">
                    <thead class="table-light">
                        <th>From</th>
                        <th>To</th>
                        <th>Invoice No</th>
                        <th>Invoice Date</th>
                        <th>Due Date</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @if(isset($invoices))
                            @forelse($invoices as $invoice)
                            <tr class="text-secondary">
                                <td>{{ isset($invoice->fromUser->name) ? $invoice->fromUser->name : '' }} 
                                    <br/> {{ isset($invoice->fromUser->email) ? $invoice->fromUser->email : '' }} 
                                    <br/> {{ isset($invoice->fromUser->mobile_code) ? $invoice->fromUser->mobile_code : '' }} 
                                    {{ isset($invoice->fromUser->mobile_number) ? $invoice->fromUser->mobile_number : '' }}
                                </td>
                                <td>{{ isset($invoice->toUser->name) ? $invoice->toUser->name : '' }} 
                                    <br/> {{ isset($invoice->toUser->email) ? $invoice->toUser->email : '' }} 
                                    <br/> {{ isset($invoice->toUser->mobile_code) ? $invoice->toUser->mobile_code : '' }} 
                                    {{ isset($invoice->toUser->mobile_number) ? $invoice->toUser->mobile_number : '' }}
                                </td>
                                <td>{{ $invoice->invoice_no }}</td>
                                <td>{{ $invoice->created_at ? date('F jS, Y', strtotime($invoice->created_at)) : '' }}</td>
                                <td>{{ $invoice->due_date ? date('F jS, Y', strtotime($invoice->due_date)) : '' }}</td>
                                <td><a href="{{url('invoices/'.$invoice->id)}}" target="_blank">Download Pdf</a></td>
                            </tr>
                            @empty
                            @endforelse
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
   </section>
</body>
</html>
