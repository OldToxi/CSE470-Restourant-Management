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
                    <th>Remove</th>

                </tr>
                <?php
                $total_price=0;
                ?>


                @foreach($data as $data)
                <tr>
                    <td>{{$data->title}}</td>
                    <td>{{$data->price}}</td>
                    <td>{{$data->quantity}}</td>
                    <td><img width="150" src="food_img/{{$data->image}}"></td>
                    <td>
                        <a onclick="return confirm('Are you sure want to remove this item?')" class="btn btn-danger" href="{{url('remove_cart',$data->id)}}">Delete</a>
                    </td>                
                </tr>
                <?php
                $total_price = $total_price+ $data->price;
                ?>

                @endforeach
            </table>
            <h1 style="color:white; font-weight:bold; padding-top:60px;">Total Price = {{$total_price}}tk</h1>
        </div>
        <div class="div_center">
            <form action="{{url('confirm_order')}}" method="post">
                @csrf
                <div class='div_padding'>
                    <label for="">Name</label>
                    <input type="text" name="name" value="{{Auth()->user()->name}}">
                </div>
                <div class='div_padding'>
                    <label for="">Email</label>
                    <input type="email" name="email" value="{{Auth()->user()->email}}">
                </div>
                <div class='div_padding'>
                    <label for="">Address</label>
                    <input type="text" name="address" value="{{Auth()->user()->address}}">
                </div>
                <div class='div_padding' style="color: white; text-align: left; padding-left: 250px;">
                    <input class="btn btn-info" type="submit" value="Order Now" style="font-size:18px; padding:12px 24px; color:white;">
                </div>
            </form>
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
    .div_center
    {
        display:flex;
        justify-content:center;
        align-items:center;
        color:white;
        font-weight:bold;
    }
    label
    {
        display:inline-block;
        width: 200px;
    }
    .div_padding
    {
        padding:20px;
    }
    </style>


    <!-- Contact Section -->
    @include('home.contact')

    @include('home.footer')

</body>

</html>