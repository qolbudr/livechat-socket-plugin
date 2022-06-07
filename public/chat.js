(function ($) {
    $.fn.chatInit = function( options ) {
        // This is the easiest way to have default options.
        var settings = $.extend({
            chatId: '47c96-6f5-d41b529-6450',
            userId: null,
            userName: null,
            userEndpoint: null,
            screenWidth: $(window).width(),
            screenHeight: $(window).height()
        }, options );
        // Greenify the collection based on the settings variable.
        this.append(`<iframe frameborder="0" id="chat-frame"  src="http://127.0.0.1:8000/?user_url=${settings.userEndpoint}&from_id=${settings.userId}&chat_id=${settings.chatId}&username=${settings.userName}&width=${settings.screenWidth}&height=${settings.screenHeight}" style="height:100px; width:100px;overflow:hidden;position:fixed;z-index:99999;bottom:0;right:0"></iframe>`);
        window.addEventListener('message', function(event) {
          if(event.data.message === 'maximize')
          {
          	if(screen.width > 768) {
          		$("#chat-frame").css({'width':'400px', 'height':'-webkit-fill-available'});
          	} else {
          		$("#chat-frame").css({'width':'100vw', 'height':'-webkit-fill-available'});
          	}
          } else {
            $("#chat-frame").css({'width':'100px', 'height':'100px'});
          }
        }, false);
    };
}(jQuery));