
window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo'

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    //encrypted: true,
    namespace: 'App.Events',
    wsHost: 'sockets.dailyleaks.space',
    wsPort: 6001,
    disableStats: true
});

 



window.Echo.join('chat')
    .here((users) => {
        var active_users = "";
        users.forEach(function(user) {
            active_users += '<div id="'+user['id']+'" class="media hover-effect" title="click to chat with '+user['name']+'"><img class="mr-3" src="https://via.placeholder.com/50x50" alt="Generic placeholder image"><div class="media-body"><h5 class="mt-0" class="name">'+user['name']+'</h5><p >'+user['email']+'</p></div></div>';
        });
        $("#active_users").html(active_users);
    })
    .joining((user) => {
         
        $("#active_users").append('<div id="'+user.id+'" class="media hover-effect" title="click to chat with '+user.name+'"><img class="mr-3" src="https://via.placeholder.com/50x50" alt="Generic placeholder image"><div class="media-body"><h5 class="mt-0" class="name">'+user.name+'</h5><p >'+user.email+'</p></div></div>');
    })
    .leaving((user) => {
        $("#"+user.id).remove();
    });



    $(document).on('click','.hover-effect',function(){
        var id = $(this).attr('id');
        window.location.href = "/chat/"+id;
        
    });

$(document).on("click","#send",function(){
    var text = $("#text").val();
    sendMessage(text)
    $("#text").val("");
});
 
 


$(document).keypress(function(event){
	
	var keycode = (event.keyCode ? event.keyCode : event.which);
	if(keycode == '13'){
        var text = $("#text").val();
        if(text.length > 0)
        {
            sendMessage(text)
            $("#text").val("");	
        }
        
	}
	
});



function sendMessage(message)
{
    var string = '	<div class="balon1 p-2 m-0 position-relative"  ><a class="float-right"> '+ message+'   </a></div>';
    $("#sohbet").append(string).animate({
        scrollTop: $('#sohbet')[0].scrollHeight}, 100);
}
