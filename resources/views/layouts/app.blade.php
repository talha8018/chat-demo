<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>

<script src="{{ asset('js/app.js') }}"  ></script>
    @if(!empty($user->id ))
   
        <script>

window.timer = null;
$(document).on('keydown','#text',function(){
    
  
            
            window.Echo.private("chats.{{ Auth::user()->id }}")
                .whisper('typing', {
                    name: "{{ Auth::user()->name }}"
                });

            });

              
 

window.Echo.private("chats.{{ $user->id }}")
                .listenForWhisper('typing', (e) => {
                    $(".typing").html(e.name+ ' is typing...');
                    clearTimeout(window.timer);
                   window.timer = setTimeout(function(){
                        $(".typing").html('');
                    }, 1000);
                });

                window.Echo.private("chating.{{ Auth::user()->id }}")
                .listenForWhisper('chat', (e) => {

                    sendMessage(e.message,'left')
                });

window.Echo.join('chat')
    .here((users) => {
        var active_users = "";
        users.forEach(function(user) {
            if(user['id']!= "{{ Auth::user()->id}}")
            {
            active_users += '<div id="'+user['id']+'" class="media hover-effect" title="click to chat with '+user['name']+'"><img class="mr-3" src="https://via.placeholder.com/50x50" alt="Generic placeholder image"><div class="media-body"><h5 class="mt-0" class="name">'+user['name']+'</h5><p >'+user['email']+'</p></div></div>';

            }
        });
        $("#active_users").html(active_users);
    })
    .joining((user) => {
         
        $("#active_users").append('<div id="'+user.id+'" class="media hover-effect" title="click to chat with '+user.name+'"><img class="mr-3" src="https://via.placeholder.com/50x50" alt="Generic placeholder image"><div class="media-body"><h5 class="mt-0" class="name">'+user.name+'</h5><p >'+user.email+'</p></div></div>');
    })
    .leaving((user) => {
        $("#"+user.id).remove();
    });
    
    
$(document).keypress(function(event){
	
	var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13')
    {
        var text = $("#text").val();
        if(text.length > 0)
        {
            window.Echo.private("chating.{{ $user->id }}")
                .whisper('chat', {
                    message: text
                });
            sendMessage(text,'right')
            $("#text").val("");	
        }
	}
	
});



function sendMessage(message,position)
{
    var classs = '';
    if(position == 'left')
    {
classs  = 'balon1';
    }
    else 
    {
        classs  = 'balon2';
    }
    var string = '	<div class="'+classs+' p-2 m-0 position-relative"  ><a class="float-'+ position +'"> '+ message+'   </a></div>';
    $("#sohbet").append(string).animate({
        scrollTop: $('#sohbet')[0].scrollHeight}, 100);
}



        </script>
    @endif
