let username = document.getElementById('username').value
let playerName = document.getElementById("player-name")
let playBtn = document.getElementById("play-btn")

playBtn.addEventListener('click', function () { 
  playerName.innerText = username
 })