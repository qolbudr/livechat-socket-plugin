<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('emoji.min.css') }}">
    <title>Chats Application</title>
    <style type="text/css">
    	html, body {
  	    width: 100%;
  	    height: 100%;
    		margin: 0;
    		padding: 0;
    		background-color: transparent;
    	}

    	.chat-bubble,.chat-close {
    		position: fixed;
    		right: 20px;
    		bottom: 20px;
    		width: 60px;
    		height: 60px;
    		border-radius: 60px;
    		background-color: black;
    		color: white;
    		cursor: pointer;
    	}

    	.chat-close {
    		visibility: hidden;
    		opacity: 0;
    	}

    	.chat-content {
    		position: fixed;
    		right: 20px;
    		left: 20px;
    		top: 20px;
    		bottom: 100px;
    		width: calc(100% - 40px);
    		background-color: white;
    		border: 2px solid #edededa1;
    		border-radius: 30px;
    		height: calc(100% - 120px);
    		visibility: hidden;
    		opacity: 0;
    		transition: 0.2s ease-in;
            overflow-x: hidden;
            overflow-y: hidden;
    	}

    	.chat-header {
    		height: 60px;
    		display: flex;
    		align-items: center;
    		border-bottom: 1px solid #edededa1;
    	}

    	.chat-body {
    		height: calc(100% - 120px);
    		width: 100%;
    		overflow-y: scroll;
    	}

    	.chat-footer {
    		height: 60px;
    		width: 100%;
    		font-size: 12px;
    	}

    	.item-nav,.message-item,.user-item {
    		cursor: pointer;
    	}

    	.message-item,.user-name {
    		border-bottom: 1px solid #edededa1;
    	}

    	.avatar {
    		width: 30px;
    	}

    	.last-message,.last-timestamp,.chat-inner .status {
    		font-size: 12px;
    	}

    	#search,#chat-input {
    		box-shadow: unset;
    		outline: unset;
    	}

      .chat-inner,.chat-outer {
        transition: 0.5s ease-in;
        height: 100%;
        width: 100%;
      }
    
      .chat-inner {
        visibility: hidden;
        opacity: 0;
      }
    
      #back {
        cursor: pointer;
      }
    
      .chat-body .chat {
        max-width: 70%;
        word-break: break-all;
        font-size: 15px;
        border-radius: 10px;
      }
    
      .message-info {
        max-width: 55%;
      }
    </style>
  </head>
  <body>
    <div class="chat-bubble d-flex align-items-center justify-content-center shadow">
    	<i data-feather="message-square"></i>
    </div>
    <div class="chat-close d-flex align-items-center justify-content-center shadow">
    	<i data-feather="x"></i>
    </div>
    <div class="chat-content">
      <div class="chat-outer">
      	<div class="chat-header px-4 justify-content-between">
      		<h5 class="chat-title m-0 p-0">Chats</h5>
      		<div class="close-btn">
      		    <i data-feather="x"></i>
      		</div>
      	</div>
      	<div class="chat-body">
      		<div class="tab message-list">
      			<!-- <div class="message-item px-4 py-2 d-flex align-items-start justify-content-between">
      				<div class="message-info d-flex align-items-center">
      					<img class="avatar" src="{{ asset('avatar.jpg') }}" alt="avatar">
      					<div class="message-detail-info ml-2">
      						<h6 class="sender-name m-0 p-0">Abid</h6>
      						<p class="last-message text-muted p-0 m-0">Hello</p>
      					</div>
      				</div>
      				<p class="text-muted last-timestamp">Yesterday</p>
      			</div> -->
      		</div>
      		<div class="tab user-list d-none">
      			<div class="search-box mb-2 px-4 py-3">
      				<input class="form-control border-none bg-light" id="search" placeholder="Search user">
      			</div>
      			<div class="user-wrap">
  	    			<!-- <div class="user-item px-4 py-2 d-flex align-items-start justify-content-between">
  	    				<img class="avatar" src="{{ asset('avatar.jpg') }}" alt="avatar">
  	    				<div class="user-name w-100 ml-2">
  	    					<h6 class="name">Abid</h6>
  	    				</div>
  	    			</div> -->
      			</div>
      		</div>
          <div class="status d-none h-100 w-100 text-secondary align-items-center justify-content-center">
            <h5>Find user to chat</h5>
          </div>
        </div>
      	<div class="chat-footer px-4  d-flex justify-content-between align-items-center">
      		<div class="item-nav w-100 text-center" data-target="message-list" title="Chats">
      			<i data-feather="message-circle"></i>
      			<p class="m-0">Chats</p>
      		</div>
      		<div class="item-nav w-100 text-center" data-target="user-list" title="User">
      			<i data-feather="user"></i>
      			<p class="m-0">User</p>
      		</div>
      	</div>
      </div>
      <div class="chat-inner">
        <div class="chat-header px-4">
          <div id="btn-back">
            <i id="back" data-feather="arrow-left"></i>
          </div>
          <img class="avatar ml-3" src="{{ asset('avatar.jpg') }}" alt="avatar">
          <div class="message-detail-info ml-3 text-truncate">
            <h6 class="username m-0 p-0 text-truncate">Abid</h6>
            <p class="status text-muted p-0 m-0">Offline</p>
          </div>
        </div>
        <div class="chat-body p-3">
          
        </div>
        <div class="chat-footer px-4  d-flex align-items-center">
          <input class="form-control border-none bg-light mb-2" id="chat-input" placeholder="Enter your message here">
        </div>
      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js"></script>
    <script src="{{ asset('emoji.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.1.3/socket.io.js"></script>
    <script type="text/javascript">
      let userUrl = `{{ $_GET['user_url'] }}`;
      var fromId = `{{ $_GET['from_id'] }}`;
      var chatId = `{{ $_GET['chat_id'] }}`;
      var fromName = `{{ $_GET['username'] }}`;
      var listUser = [];
      var socket = io.connect(`http://127.0.0.1:3000`);
      var allData = {};
      var screenWidth = {{ $_GET['width'] }};
      var screenHeight = {{ $_GET['height'] }};
      
      if(screenHeight < 500 || screenWidth < 768) {
          $(`.chat-content`).css({
              'width': '100%',
              'top': 0,
              'bottom': 0,
              'left': 0,
              'right': 0,
              'border-radius': 0,
              'height': '100%'
          })
      }

      function fetchUser() {
        $.ajax({
          type: `get`,
          url: userUrl,
          success: function(result) {
            listUser = result;
            let html = ``;
            result.forEach(function(user) {
              html += `
                <div data-user-name="${user.name}" data-user-id="${user.id}" class="user-item px-4 py-2 d-flex align-items-start justify-content-between">
                  <img class="avatar" src="{{ asset('avatar.jpg') }}" alt="avatar">
                  <div class="user-name w-100 ml-2">
                    <h6 class="name">${user.name}</h6>
                  </div>
                </div>
              `
            })

            $(`.user-wrap`).html(html);
            openChat();
          }
        })
      }

      function fetchAllChat(target) {
        if(target == "message-list") {
          $(`.chat-body .status`).removeClass('d-none')
          $(`.chat-body .status`).addClass('d-flex')
        } else {
          $(`.chat-body .status`).addClass('d-none')
          $(`.chat-body .status`).removeClass('d-flex')
        }

        $.ajax({
          type: `get`,
          url: `{{ URL::to('fetch_all_chat') }}/${chatId}/${fromId}`,
          success: function(result) {
            if(result.length <= 0) {
              $(`.chat-body .status`).removeClass('d-none')
              $(`.chat-body .status`).addClass('d-flex')
              $(`.chat-body .message-list`).addClass('d-none')
              if(target != "message-list") {
                $(`.chat-body .status`).addClass('d-none')
                $(`.chat-body .status`).removeClass('d-flex')
              }
            } else {
              $(`.chat-body .status`).remove();
              if(target == "message-list") {
                $(`.chat-body .message-list`).removeClass('d-none')
              }
            }

            let html = ``;
            result.forEach(function(chat) {
              if(chat.to_id != fromId) {
                  html += `
                    <div data-user-name="${chat.to_name}" data-user-id="${chat.to_id}"  class="message-item px-4 py-2 d-flex align-items-start justify-content-between">
                      <div class="message-info d-flex align-items-center">
                        <img class="avatar" src="{{ asset('avatar.jpg') }}" alt="avatar">
                        <div class="message-detail-info ml-2 text-truncate">
                          <h6 class="sender-name m-0 p-0 text-truncate">${chat.to_name}</h6>
                          <p class="last-message text-muted p-0 m-0">${chat.message}</p>
                        </div>
                      </div>
                      <p class="text-muted last-timestamp">${chat.created_at}</p>
                    </div>`
              } else {
                html += `
                    <div data-user-name="${chat.from_name}" data-user-id="${chat.from_id}"  class="message-item px-4 py-2 d-flex align-items-start justify-content-between">
                      <div class="message-info d-flex align-items-center">
                        <img class="avatar" src="{{ asset('avatar.jpg') }}" alt="avatar">
                        <div class="message-detail-info ml-2 text-truncate">
                          <h6 class="sender-name m-0 p-0 text-truncate">${chat.from_name}</h6>
                          <p class="last-message text-muted p-0 m-0">${chat.message}</p>
                        </div>
                      </div>
                      <p class="text-muted last-timestamp">${chat.created_at}</p>
                    </div>
                  `   
              }
            })

            $(`.chat-outer .message-list`).html(html);
            openChat();
          }
        })
      }

      function fetchAllMessage(toId) {
        $.ajax({
          type: `get`,
          url: `{{ URL::to('fetch_all_message') }}/${chatId}/${fromId}/${toId}`,
          success: function(result) {
            let html = ``
            result.forEach(function(message) {
              if(message.from_id == fromId) {
                html += `
                <div class="chat-me w-100 d-flex justify-content-end mb-2">
                  <div class="chat bg-dark text-white px-3 py-2">${message.message}</div>
                </div>
                `
              } else {
                html += `
                <div class="chat-other w-100 d-flex justify-content-start mb-2">
                  <div class="chat bg-light text-dark px-3 py-2">${message.message}</div>
                </div>
                `
              }
            })

            $(`.chat-inner .chat-body`).html(html);
          }
        })
      }

      function openChat() {
        $(`.message-item,.user-item`).click(function() {
          $(`.chat-inner`).css({'visibility': 'visible', 'opacity': '100', 'display': 'block'});
          $(`.chat-outer`).css({'visibility': 'hidden', 'opacity': '0', 'display': 'none'});
          let username = $(this).attr(`data-user-name`);
          let id = $(this).attr(`data-user-id`);
          $(`.chat-inner .username`).text(username);

          allData = {
            toId: id,
            fromId: fromId,
            toName: username,
            fromName: fromName,
            chatId: chatId
          }
          
          socket.emit("openChat", allData);
          fetchAllMessage(id);
        })
      }

      async function searchUser(text) {
        let searchResult = [];

        if(text) {
          await listUser.forEach(function(user) {
            if(user.name.indexOf(text) > -1) {
              searchResult.push(user);
            }
          })
        } else {
          fetchUser();
        }

        let html = ``;
        searchResult.forEach(function(user) {
          html += `
            <div data-user-name="${user.name}" data-user-role="${user.role}" data-user-id="${user.id}" class="user-item px-4 py-2 d-flex align-items-start justify-content-between">
              <img class="avatar" src="{{ asset('avatar.jpg') }}" alt="avatar">
              <div class="user-name w-100 ml-2">
                <h6 class="name">${user.name}</h6>
              </div>
            </div>
          `
        })

        $(`.user-wrap`).html(html);
        openChat();
      }

    	$(`.item-nav`).click(function() {
    		let title = $(this).attr(`title`);
    		let target = $(this).attr(`data-target`);
    		$(`.chat-outer .tab`).addClass(`d-none`);
    		$(`.chat-outer .${target}`).removeClass(`d-none`);
    		$(`.chat-outer .chat-title`).text(title);

        fetchAllChat(target);
        fetchUser("message-list");
    	})

    	$(`.chat-bubble`).click(function() {
            window.parent.postMessage({message: 'maximize'}, '*');
    		$(`.chat-content`).css({'visibility': 'visible', 'opacity': '100'});
    		$(this).css({'visibility': 'hidden', 'opacity': '0'})
    		$(`.chat-close`).css({'visibility': 'visible', 'opacity': '100'})
    	})

    	$(`.chat-close`).click(function() {
    		$(`.chat-content`).css({'visibility': 'hidden', 'opacity': '0'});
    		$(this).css({'visibility': 'hidden', 'opacity': '0'})
    		$(`.chat-bubble`).css({'visibility': 'visible', 'opacity': '100'})
    		setTimeout(function() {
        		window.parent.postMessage({message: 'minimize'}, '*');
        	}, 500)
    	})
    	
    	$(`.close-btn`).click(function() {
    	    $(`.chat-close`).click();
    	})

      $(`.message-item`).click(function() {
        $(`.chat-inner`).css({'visibility': 'visible', 'opacity': '100', 'display': 'block'});
        $(`.chat-outer`).css({'visibility': 'hidden', 'opacity': '0', 'display': 'none'});
      })

      $(`#btn-back`).click(function() {
        $(`.chat-outer`).css({'visibility': 'visible', 'opacity': '100', 'display': 'block'});
        $(`.chat-inner`).css({'visibility': 'hidden', 'opacity': '0', 'display': 'none'});
        fetchAllChat();
      })

      $(`#search`).on('keyup', function() {
        let text = $(this).val();
        searchUser(text);
      })

      function sendChat(e) {
        if(e.keyCode == 13) {
          const messageText = $(`#chat-input`)[0].emojioneArea.getText();
          socket.emit("sendMessage", messageText);
          $(`#chat-input`)[0].emojioneArea.setText(``);
          $.ajax({
            type: `get`,
            url: `{{ URL::to('send_message') }}/${allData.chatId}/${allData.fromId}/${allData.toId}/${allData.fromName}/${allData.toName}/${messageText}`,
            success: function(result) {
              console.log(result);
            }
          })
        }
      }

      $(document).ready(function() {
        $(`#chat-input`).emojioneArea({
          pickerPosition: "top",
          tonesStyle: "radio",
          events: {
            keyup: function (editor, event) {
              sendChat(event);
            },
          }
        });

        fetchUser();
        fetchAllChat("message-list");
        feather.replace();
      });

      socket.on("updateChat", function (userId, data) {
          if(userId == fromId) {
            $(`.chat-inner .chat-body`).append(`
              <div class="chat-me w-100 d-flex justify-content-end mb-2">
                <div class="chat bg-dark text-white px-3 py-2">${data}</div>
              </div>
            `)
          } else {
            $(`.chat-inner .chat-body`).append(`
              <div class="chat-other w-100 d-flex justify-content-start mb-2">
                <div class="chat bg-light text-dark px-3 py-2">${data}</div>
              </div>
            `)
          }

          const element = document.querySelector(`.chat-inner .chat-body`);
          element.scrollTop = element.scrollHeight; 
      });
    </script>
  </body>
</html>