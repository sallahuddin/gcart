<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
            
                margin: 10px;
            }

            .full-height {
                
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            #mytable,td{
    border:1px solid blue;
}
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
 <form id="frmTasks"  method="POST" action="#" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
                 <input id="username" class="form-control col-md-7 col-xs-12" name="username" placeholder="Enter username" required="required" type="text">
                 <button type="button" class="btn btn-primary" id="Show" onclick ="gituser()">Show</button>
               </form>
                </div>

                <div  id="gitview">

                <div>

               
            </div>
        </div>
    </body>

<script>
    function gituser()
{ 

  var username = $('#username').val();
  if(username.length == 0)
  {
      alert('please enter the username');
      return false;
  }
  var url = "{{ url('/') }}/employees";
  $.get('https://api.github.com/users/' + username +'/followers', function (data) {
    if(data.length == 0)
  {
      alert('no follower found');
      return false;
  }

   var tbl=$("<table/>").attr("id","mytable");
    $("#gitview").append(tbl);
    for(var i=0;i<data.length;i++)
    {
        var tr="<tr>";
      /*  var td1="<td>"+data[i]["id"]+"</td>";
        var td2="<td>"+data[i]["login"]+"</td>"; */
        var td3="<td><img src='" +data[i]["avatar_url"] + "' height='230' width='230'></td></tr>";
        $("#mytable").append(tr+td3); 

    }   
});

}

</script>
</html>
