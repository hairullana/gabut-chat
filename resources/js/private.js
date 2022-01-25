const { default: axios } = require('axios');

require('./bootstrap');


// private message
const privateMessageElement = document.getElementsById('private-message');
const privateMessageInput = document.getElementsById('private-message-input');
const privateMessageForm = document.getElementById('private-message-form');

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
      message: privateMessageInput.value
    }
  }

  axios(options);
});

window.Echo.channel('chat').listen('.message', (e) => {
  privateMessageElement.innerHTML += `
  <div class='message'><strong> ${e.username}:</strong> ${e.message}</div>
  `
});