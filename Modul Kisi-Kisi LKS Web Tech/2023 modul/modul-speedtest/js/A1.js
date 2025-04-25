let chatItem = document.getElementById('chat-list');
let windowchat = document.getElementById('window-chat');
let back = document.querySelector('.back')

chatItem.addEventListener('click', function () { 
  chatItem.style.display = 'none'
  windowchat.style.display = 'flex'
 })

 back.addEventListener('click', function(){
  windowchat.style.display = 'none'
  chatItem.style.display = 'block'
 })