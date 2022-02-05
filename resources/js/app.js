const { default: axios } = require('axios');


require('./bootstrap');

const toxicWords = ['bitch','keparat','fuck','bastard','anjing','babi','pantek','bajingan','coli','colmek','pukimak','lonte','dongo','biadab','biadap','ngocok','toket','tempek','tomlol','henceut','kanjut','oppai','tetek','kanyut','itil','titit','tytyd','tolol','idiot','bangsat','bangsad','pucek','kontol','pantek','memek','puki','jembut','meki','jingan','bodoh','goblok','bokep','dajjal','silit','setan','sange','jancok','dancok','goblog','autis','bagong','peler','ngentot','ngentod','ngewe','pler','ngtd','kntl','ajg','njing','njeng','xnxx','xvideos','crot'];


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

    if(toxicWords.some(v => message_input.value === v)){
      alert('Speak a good word or remain silent.');
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
  
  const chatHistory = document.getElementById('messages');

  function scrollToBottom() {
    chatHistory.scrollTop = chatHistory.scrollHeight;
  }
  scrollToBottom();

  window.Echo.channel('publicChat').listen('MessagePublic', (e) => {
    if(e.username == username_input.value){
      messages_el.innerHTML += `
      <div class='message my-message my-2'>${e.message} <strong>:${e.username}</strong></div>
      `
    }else {
      messages_el.innerHTML += `
      <div class='message other-message my-2'><strong> ${e.username}:</strong> ${e.message}</div>
      `
    }
    scrollToBottom();
  });
} else if(document.getElementById('messageType').value == 'private') {
  // private message
  const privateMessageElement = document.getElementById('privateMessage');
  const privateMessageInput = document.getElementById('privateMessageInput');
  const privateMessageForm = document.getElementById('privateMessageForm');
  const conversationId = document.getElementById('conversationId');
  const receiverId = document.getElementById('receiverId');
  const userId = document.getElementById('userId');
  const userUsername = document.getElementById('userName');
  
  privateMessageForm.addEventListener('submit', function(e) {
    e.preventDefault();
  
    let has_errors = false;
  
    if(privateMessageInput.value == '') {
      alert('Please enter a message');
      has_errors = true;
    }

    if(toxicWords.some(v => privateMessageInput.value === v)){
      alert('Speak a good word or remain silent.');
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
        sender_id: userId.value,
        sender_username : userUsername.value,
        message: privateMessageInput.value,
        receiver_id: receiverId.value
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
    if(e.senderId == userIdLogin){
      privateMessageElement.innerHTML += `
      <li class="clearfix">
        <div class="message my-message float-right">
        ${e.message}
        </div>
      </li>
      `
    } else {
      privateMessageElement.innerHTML += `
      <li class="clearfix">
          <div class="message other-message">${e.message}</div>
      </li>
      `
    }
    
    scrollToBottom();
  })
}


window.Echo.private('notif.' + userIdLogin).listen('Notif', function(e){
  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })

  Toast.fire(swalOption = {
    icon: 'success',
    title: 'new message from ' + e.senderUserName
  })
});