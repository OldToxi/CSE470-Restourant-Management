<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')

    <style>
        table 
        {
            border:2px solid #D44658;
            margin: auto;
            width:1400px;
        }
        th 
        {
            background: #D44658;
            color:white;
            padding:15px;
            margin:15px;
        }
        td
        {
            color:white;
            padding:15px;
        }
    </style>
  </head>
  <body>
        
        @include('admin.header')
       

        @include('admin.sidebar')
    
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
            <h1>All Foods</h1>
            <div>
                <table>
                    <tr>
                        <th>Food Title</th>
                        <th>Details</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Delete</th>
                    </tr>
                    @foreach($data as $data)
                    <tr>
                        <td>{{$data->title}}</td>
                        <td>{{$data->price}}</td>
                        <td>{{$data->detail}}</td>
                        <td>
                          <img width="150" src="food_img/{{$data->image}}" alt="">
                        </td>
                        <td>
                          <a class="btn btn-danger" onclick="return confirm('Are you sure want to delete this item')" href="{{url('delfood',$data->id)}}">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            </div>
        </div>
       </div>
    <!-- JavaScript files-->
  @include('admin.js')
  </body>
</html>