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
                Items List
            </h2>
            <div class="row">
                @foreach($items as $item)
                <div class="col-md-3 mt-3">
                    <div class="card shadow">
                        <div class="card-body">
                            <h3 class="text-secondary text-center">
                                {{ $item->name }}
                            </h3>
                            <p class="text-center text-secondary">
                                {{ $item->description }}
                            </p>
                            <p class="text-center text-secondary font-weight-bold">
                                ${{ number_format($item->price, 2, '.', ',') }}
                            </p>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-secondary btn-sm" data-id="{{ $item->id }}" data-name="{{ $item->name }}">Get</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </body>
    
    {{-- SOCKET.IO --}}
    <script src="https://cdn.socket.io/4.2.0/socket.io.min.js"></script>
    <script>
        const socket = io.connect("http://192.168.118.1:3030");

        document.addEventListener('click', (e) => {
            if(e.target.tagName.toLowerCase() === 'button' && e.target.getAttribute('data-id')) {
                let itemId = e.target.getAttribute('data-id');
                let itemName = e.target.getAttribute('data-name');
                socket.emit('order', {
                    itemId: itemId,
                    itemName: itemName
                });

            }
        });
    </script>
</html>
