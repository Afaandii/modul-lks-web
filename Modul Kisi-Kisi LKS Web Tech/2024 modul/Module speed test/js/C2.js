const ball = document.querySelector('.ball')
let container = document.querySelector('.container')

document.addEventListener('mousemove', function (e) { 
  const containerRect = container.getBoundingClientRect();

  const ballRect = ball.getBoundingClientRect();

  let x = Math.max(containerRect.left, Math.min(e.pageX, containerRect.right - ballRect.width));
  let y = Math.max(containerRect.top, Math.min(e.pageY, containerRect.bottom - ballRect.height));

  ball.style.left = `${x - containerRect.left}px`;
  ball.style.top = `${y - containerRect.top}px`;  
 })