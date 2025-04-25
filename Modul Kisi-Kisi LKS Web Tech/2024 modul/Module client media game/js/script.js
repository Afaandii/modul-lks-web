// show rules game
let rulesBox = document.getElementById('game-rules')
let introBtn = document.getElementById('intro')
let closeBtn = document.getElementById('close-rules')
let playBtn = document.getElementById('play-game')
let usernameInput = document.getElementById("username");

document.addEventListener("DOMContentLoaded", function() {
  let countdownOverlay = document.getElementById("countdown-overlay");
  let countdownText = document.getElementById("countdown-text");

  function toggleButtonState() {
      if (usernameInput.value.trim().length > 0) {
          playBtn.removeAttribute("disabled");
          playBtn.style.cursor = "pointer";
      } else {
          playBtn.setAttribute("disabled", true);
          playBtn.style.cursor = "not-allowed";
      }
  }

  usernameInput.addEventListener("input", toggleButtonState);
  usernameInput.addEventListener("paste", function() {
      setTimeout(toggleButtonState, 0);
  });

  toggleButtonState(); // Pastikan tombol dalam kondisi disable awalnya


    playBtn.addEventListener("click", function(event) {
      event.preventDefault(); // Cegah halaman langsung berpindah

      countdownOverlay.style.display = "block"; // Tampilkan countdown

      let countdown = 3;
      countdownText.textContent = countdown;

      let countdownInterval = setInterval(() => {
          countdown--;
          countdownText.textContent = countdown;

          if (countdown <= 0) {
              clearInterval(countdownInterval);
              countdownOverlay.style.display = "none"; 
              window.location.href = 'dashboard-game.html'; 
          }
      }, 1000);
  });


});

introBtn.addEventListener('click', function(){
  rulesBox.style.display = 'block'
})

closeBtn.addEventListener('click', function(){
  rulesBox.style.display = 'none'
})

window.onload = function() {
  document.getElementById("gameWelcome").style.display = "block";
};

function closeWelcome() {
  document.getElementById("gameWelcome").style.display = "none";
}

//game
console.log("Script.js berhasil dimuat!");

