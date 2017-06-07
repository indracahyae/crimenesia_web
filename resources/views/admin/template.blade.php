
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="_token" content="{{ csrf_token() }}"/>
    <title>@yield('page_title')</title>
    <link rel="stylesheet" href="{{asset('css/admin/admin.css')}}">

</head>
<body class="admin">

    <!-- side menu for mobile -->
    <div class="ui sidebar inverted vertical menu">
        <a href="" class="item">Policw</a>
        <a href="" class="item">Society</a>
        <a href="" class="item">Admin</a>

    </div>

    <!-- mobile fixed menu -->
    <div class="ui menu borderless fixed mobile-menu">
        <a class="item sidebar-button">
            <i class="content icon"></i>
        </a>
        <a href="{{url('#')}}" class="item">CNS</a>
        <div class="right menu">
            <div class="ui dropdown icon item">
                <i class="ui teal horizontal label topUsername">{{session('loginAdmin.username')}}</i>
                <i class="large setting icon"></i>
                <div class="menu">
                	@if(session('loginAdmin.akses') == 1)
						<a href="{{url('homeCrudAdmin')}}" class="ui item"><i class="lock icon"></i> Manage Admin</a>
                	@endif                 
                    <a href="{{url('myProfileAdmin')}}" class="ui item"><i class="user icon"></i> My Profile</a>
                    <a href="{{url('logOutAdmin')}}" class="ui item"><i class="sign out icon"></i> Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- default menu -->
    <div class="ui menu borderless fixed default-menu">
        <h5 class="ui header item">
          <img src="{{asset('img/img-card.png')}}" class="ui circular image">
          Crimenesia
        </h5>
        <!-- <a href="" class="item">Crime Nesia</a> -->

        <div class="right menu">
                        
            <a href="{{url('keluhanAdmin')}}" class="item"><i class="spy icon"></i> Police</a>
            <a href="{{url('keluhanAdmin')}}" class="item"><i class="user icon"></i> Society</a>
                   
            <div class="ui dropdown icon item">
                <i class="ui teal horizontal label topUsername">{{session('loginAdmin.username')}}</i>
                <i class="large setting icon"></i>
                <div class="menu">
                    @if(session('loginAdmin.akses') == 1)
                        <a href="{{url('homeCrudAdmin')}}" class="ui item"><i class="lock icon"></i> Manage Admin</a>
                    @endif

                    <a href="{{url('myProfileAdmin')}}" class="ui item"><i class="user icon"></i> My Profile</a>
                    <a href="{{url('logOutAdmin')}}" class="ui item"><i class="sign out icon"></i> Logout</a>
                </div>
            </div>
        </div>
    </div>


    <div class="pusher">
        <div class="ui container">
            <!-- Isi Page -->
            @yield('page_content')

        </div>  
    </div> <!-- end .pusher -->

<script src="{{asset('js/admin/admin.js')}}"></script>
</body>
</html>
