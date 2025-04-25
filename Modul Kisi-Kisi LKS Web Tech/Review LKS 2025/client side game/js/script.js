let close = document.getElementById('close')
let rules = document.getElementById('rules')
let intruction = document.getElementById('intruction')
let play = document.getElementById('play')
let countdownCon = document.getElementById('countdown-con')
let countdown = document.getElementById('countdown')

close.addEventListener('click', function(){
    rules.style.display = 'none'
})

intruction.addEventListener('click', function(){
    rules.style.display = 'block'
    rules.style.transition = '0.5 ease-in-out'
})

play.addEventListener('click', function(){
    countdownCon.style.display = 'block'
    // setInterval(countdown.value - 1, 1000)
})
