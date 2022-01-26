const { default: axios } = require('axios');

require('./bootstrap');


if(document.getElementById('messageType').value == 'public'){
  // public message
  const messages_el = document.getElementById('messages');
  const username_input = document.getElementById('username');
  const message_input = document.getElementById('message_input');
  const message_form = document.getElementById('message_form');
  
  message_form.addEventListener('submit', function(e) {
    e.preventDefault();
  
    let has_errors = false;
  
    if(username_input.value == '') {
      alert('Please enter a username');
      has_errors = true;
    }
  
    if(message_input.value == '') {
      alert('Please enter a message');
      has_errors = true;
    }
  
    if(has_errors) {
      return;
    }
  
    const options = {
      method: 'post',
      url: '/send-message',
      data: {
        username: username_input.value,
        message: message_input.value
      }
    }
  
    axios(options);
  });
  
  window.Echo.channel('chat').listen('MessagePublic', (e) => {
    messages_el.innerHTML += `
    <div class='message'><strong> ${e.username}:</strong> ${e.message}</div>
    `
  });
} else if(document.getElementById('messageType').value == 'private') {
  // private message
  const privateMessageElement = document.getElementById('privateMessage');
  const privateMessageInput = document.getElementById('privateMessageInput');
  const privateMessageForm = document.getElementById('privateMessageForm');
  const conversationId = document.getElementById('conversationId');
  const userId = document.getElementById('userId');
  
  privateMessageForm.addEventListener('submit', function(e) {
    e.preventDefault();
  
    let has_errors = false;
  
    if(privateMessageInput.value == '') {
      alert('Please enter a message');
      has_errors = true;
    }
  
    if(has_errors) {
      return;
    }
  
    const options = {
      method: 'post',
      url: '/send-private-message',
      data: {
        conversation_id: conversationId.value,
        user_id: userId.value,
        message: privateMessageInput.value,
      }
    }
  
    axios(options);
  })


  const chatHistory = document.getElementById('chat-history');

  function scrollToBottom() {
    chatHistory.scrollTop = chatHistory.scrollHeight;
  }
  scrollToBottom();
  

  window.Echo.private('privateChat.' + conversationId.value).listen('MessagePrivate', function(e) {
    if(e.userId == userIdLogin){
      privateMessageElement.innerHTML += `
      <li class="clearfix">
        <div class="message-data text-right">
            <span class="message-data-time">10:10 AM, Today</span>
            <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="avatar">
        </div>
        <div class="message other-message float-right">
          ${e.message}
        </div>
      </li>
      `
      // scrollToBottom();
    } else {
      privateMessageElement.innerHTML += `
      <li class="clearfix">
          <div class="message-data">
              <span class="message-data-time">10:15 AM, Today</span>
          </div>
          <div class="message my-message">${e.message}</div>
      </li>
      `
    }
    // const chatHistory = document.getElementById('chat-history');
    scrollToBottom();

    
  })

  

  

}