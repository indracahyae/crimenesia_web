<!DOCTYPE html>
<html>
<head>
    <!-- Standard Meta -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="_token" content="{!! csrf_token() !!}" />

    <!-- Site Properties -->
    <title>Login Admin</title>
    <link rel="stylesheet" href="{{asset('css/admin/admin.css')}}">

</head>

<body class="admin-login-body">

    <div class="ui centered card">
      <!-- <div class="image">
        <img src="{{asset('img/img-card.png')}}">
      </div> -->
      <div class="content">
        <img class="right floated mini ui image" src="{{asset('img/img-card.png')}}">
        <div class="header centered">Crimenesia</div>
        <div class="meta">Administrator Gate</div>
        <div class="description">
          <form class="ui form login">
            <div class="field">
              <input id="username" type="text" name="username" placeholder="Username">
            </div>
            <div class="field">
              <input id="password" type="password" name="password" placeholder="Password">
            </div>
            <div class="field">
              <!-- <div class="ui checkbox">
                <input type="checkbox" tabindex="0" class="hidden">
                <label>I agree to the Terms and Conditions</label>
              </div> -->
            </div>
            <button class="fluid ui teal button login">Login</button>
          </form>
        </div>
        <div class="ui hidden error message login">
          <i class="close icon"></i>
          <p>
            wrong username or password
          </p>
        </div>
      </div>
    </div>

    <script src="{{asset('js/admin/admin.js')}}"></script>
</body>
</html>
