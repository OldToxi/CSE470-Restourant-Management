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
                <tr>

                    <th>Food title</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Delivery Status</th>>
                    <th>Rating</th>
                    <th>Feedback</th>
                </tr>
                @foreach ($data as $data)
                    <tr>

                        <td>{{ $data->title }}</td>
                        <td>{{ $data->quantity }}</td>
                        <td>{{ $data->price }}</td>
                        <td>
                            <img width="100" src="food_img/{{ $data->image }}" alt="">
                        </td>
                        <td>{{ $data->delivery_status }}</td>
                        <td>
                            @if ($data->delivery_status == 'Delivered')
                                @if ($data->rating)
                                    {{ $data->rating }}
                                @else
                                    <form action="{{ url('/rate_order/' . $data->id) }}" method="POST">
                                        @csrf
                                        <select name="rating" onchange="this.form.submit()">
                                            <option value="">Rate</option>
                                            @for ($i = 1; $i <= 5; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </form>
                                @endif
                            @else
                                <span style="color: red;">Not Delivered</span>
                            @endif
                        </td>
                        <td>
                            @if ($data->delivery_status == 'Delivered')
                                @if ($data->feedback)
                                    Feedback Given
                                @else
                                    <button type="button" class="btn btn-sm btn-warning" data-toggle="modal"
                                        data-target="#feedbackModal{{ $data->id }}">
                                        Leave Feedback
                                    </button>
                                @endif
                            @else
                                <span style="color: red;">Not Delivered</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                <!-- Feedback Modal -->
                <div class="modal fade" id="feedbackModal{{ $data->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="feedbackModalLabel{{ $data->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form action="{{ url('/submit_feedback/' . $data->id) }}" method="POST">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="feedbackModalLabel{{ $data->id }}">Leave Feedback
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span style="color:white;" aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" style="color:black;">
                                    <textarea name="feedback" class="form-control" rows="5" placeholder="Write your feedback here..." required></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </table>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        body {
            background-color: #2f2f2f;
            /* dark background */
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
            background-color: #3c3c3c;
            /* dark table background */
            color: white;
            border: 1px solid #444;
        }

        .cart-table th,
        .cart-table td {
            padding: 15px;
            text-align: center;
            border: 1px solid #555;
        }

        .cart-table th {
            background-color: rgb(41, 23, 141);
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
