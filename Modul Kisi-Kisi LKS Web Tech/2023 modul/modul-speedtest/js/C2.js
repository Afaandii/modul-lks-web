function splitImage() {
  const x = parseInt(document.getElementById('xInput').value);
  const y = parseInt(document.getElementById('yInput').value);
  const container = document.getElementById('imageContainer');
  const imgElement = container.querySelector('img');

  if (!imgElement) {
      console.error('Image not found in the container.');
      return;
  }

  container.innerHTML = ''; // Clear previous cards

  const imgWidth = imgElement.naturalWidth;
  const imgHeight = imgElement.naturalHeight;
  const cardWidth = imgWidth / x;
  const cardHeight = imgHeight / y;

  for (let i = 0; i < y; i++) {
      for (let j = 0; j < x; j++) {
          const card = document.createElement('div');
          card.classList.add('card');
          card.style.width = `${cardWidth}px`;
          card.style.height = `${cardHeight}px`;
          card.style.backgroundImage = `url(${imgElement.src})`;
          card.style.backgroundPosition = `-${j * cardWidth}px -${i * cardHeight}px`;
          card.style.backgroundSize = `${imgWidth}px ${imgHeight}px`;

          card.addEventListener('click', function() {
              card.style.animation = 'fadeOut 0.5s forwards';
              setTimeout(() => card.remove(), 500);
          });

          container.appendChild(card);
      }
  }
}
