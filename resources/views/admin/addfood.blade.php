<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
    <style>
        label
        {
            display: inline-block;
            width: 210px;
            color: white;
        }
        .div_foods
        {
            padding:20px;
        }
    </style>
  </head>
  <body>
        
        @include('admin.header')
       

        @include('admin.sidebar')
    
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">

          <form action="{{url('uploadfood')}}" method="post" enctype="multipart/form-data">

          @csrf
           <div class="div_foods">
                <label for="">Food Title</label>
                <input type="text" name="title" required>
            </div>
            <div class="div_foods">
                <label for="">Price</label>
                <input type="text" name="price" required>
            </div>
            <div class="div_foods">
                <label for="">Food Info</label>
                <textarea name="Info" cols="60" rows="8" required></textarea>
            </div>
            <div class="div_foods">
                <label for="">Add Image</label>
                <input type="file" name="img" required>
            </div>
            <div class="div_foods">
                <input type="submit" value="Add Food" class="btn btn-warning">
            </div>

        </div>
       </div>
    <!-- JavaScript files-->
  @include('admin.js')
  </body>
</html>