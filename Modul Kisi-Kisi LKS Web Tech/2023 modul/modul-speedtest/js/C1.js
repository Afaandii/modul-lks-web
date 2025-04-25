window.onload = function() {
  const canvas = document.getElementById('myCanvas');
  const context = canvas.getContext('2d');
  let x = 0; // Posisi awal lingkaran
  const y = canvas.height / 3; // Tengah vertikal
  const radius = 20; // Ukuran lingkaran
  const speed = 2; // Kecepatan gerak lingkaran

  function drawCircle() {
      context.clearRect(0, 0, canvas.width, canvas.height); // Bersihkan canvas
      context.beginPath();
      context.arc(x, y, radius, 0, Math.PI * 2, false); // Gambar lingkaran
      context.fillStyle = 'blue';
      context.fill();
  }

  function update() {
      x += speed; // Perbarui posisi x
      if (x > canvas.width) {
          x = -radius; // Reset posisi jika melebihi batas kanan
      }
      drawCircle(); // Gambar ulang lingkaran
      requestAnimationFrame(update); // Panggil kembali fungsi update
  }

  update(); // Mulai animasi
};
