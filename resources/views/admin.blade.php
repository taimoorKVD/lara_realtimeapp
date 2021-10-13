<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        
        {{-- Bootstrap CDN --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
        
    </head>
    <body>
        <div class="container mt-3 mb-4">
            <h2 class="text-center text-secondary">
                New Orders
            </h2>
            <table class="table" >
                <thead>
                  <tr>
                    <th scope="col">Code</th>
                    <th scope="col">Item</th>
                    <th scope="col">Quantity</th>
                  </tr>
                </thead>
                <tbody id="itemList">
                </tbody>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->order_code }}</td>
                            <td>{{ $order->items->name }}</td>
                            <td>{{ $order->quantity }}</td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
            
        </div>
    </body>
    
    {{-- SOCKET.IO --}}
    <script src="https://cdn.socket.io/4.2.0/socket.io.min.js"></script>
    
    {{-- JQUERY --}}
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    
    <script>
        const socket = io.connect("http://192.168.118.1:3030");

        socket.on('order_processed', (mydata) => {
            var rows = "";
            rows += "<tr class='text-success'><td>" + mydata.order.order_code + "</td><td>" + mydata.itemName + "</td><td>" + mydata.order.quantity + "</td></tr>";
            $( rows ).appendTo( "#itemList" );
        });
    </script>
</html>
