<!DOCTYPE html>
<html lang="en">

<head>
  @include('home.css')
</head>

<body class="index-page">

    @include('home.header')
    <div class="container section-title" data-aos="fade-up">
        <div class="cart-wrapper">
            <table class="cart-table">
                <tr class="cart-header">
                    <th>Food Title</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Image</th>
                </tr>
                @foreach($data as $data)
                <tr>
                    <td>{{$data->title}}</td>
                    <td>{{$data->price}}</td>
                    <td>{{$data->quantity}}</td>
                    <td><img width="150" src="food_img/{{$data->image}}"></td>
                </tr>
                @endforeach
            </table>
        </div>

    </div>
    <style>
        body {
        background-color: #2f2f2f; /* dark background */
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    .cart-wrapper {
        width: 100%;
        padding: 40px;
        box-sizing: border-box;
    }

    .cart-table {
        width: 100%;
        border-collapse: collapse;
        background-color: #3c3c3c; /* dark table background */
        color: white;
        border: 1px solid #444;
    }

    .cart-table th,
    .cart-table td {
        padding: 15px;
        text-align: center;
        border: 1px solid #555;
    }

    .cart-header th {
        background-color: #ff1a1a;
        color: white;
        font-weight: bold;
        font-size: 16px;
    }

    .cart-table img {
        width: 100px;
        height: auto;
        border-radius: 8px;
    }
    </style>


    <!-- Contact Section -->
    @include('home.contact')

    @include('home.footer')

</body>

</html>