<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <form action="{{ url('api/register') }}" method="POST">
           @csrf

           <label for="">Name</label>
           <input type="text" name="name" class="form-control" id="">


           <label for="">Email</label>
           <input type="email" name="email" class="form-control" id="">

           <label for="">Password</label>
           <input type="password" name="password" class="form-control" id="">
           <label for="">Confirm Password</label>
           <input type="password" name="password_confirmation" class="form-control" id="">


           <label for="">Phone</label>
           <input type="text" name="phone" class="form-control" id="">
           <button type="submit" class="btn btn-primary"> Save</button>
        </form>
    </div>

</body>
</html>
