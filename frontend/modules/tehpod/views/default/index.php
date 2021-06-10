<div class="chatwrapper">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <div id="chat"></div>

  <textarea id="message"></textarea><button id="btnSend">Отправить</button>
  <!--<div id="response" style="color:#D00"></div>-->
  <script>
      $(function() {
          var chat = new WebSocket('ws://localhost:8080');
          chat.onmessage = function(e) {
              $('#response').text('');

              var response = JSON.parse(e.data);
              if (response.type && response.type == 'chat') {
                  $('#chat').append('<div><b>' + response.from + '</b>: ' + response.message + '</div>');
                  $('#chat').scrollTop = $('#chat').height;
              } else if (response.message) {
                  $('#response').text(response.message);
              }
          };
          chat.onopen = function(e) {
              $('#response').text("Connection established! Please, set your username.");
          };
          $('#btnSend').click(function() {
              if ($('#message').val()) {
                  chat.send( JSON.stringify({'action' : 'chat', 'message' : $('#message').val(), 'username' : '<?= Yii::$app->user->identity->username ?>'}) );
              } else {
                  alert('Enter the message')
              }
          })

      });
  </script>

</div>
