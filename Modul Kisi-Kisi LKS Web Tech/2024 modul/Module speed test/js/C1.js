document.addEventListener("DOMContentLoaded", function () {
  const cursor = document.createElement("div");
  cursor.classList.add("custom-cursor");
  document.body.appendChild(cursor);

  document.addEventListener("mousemove", (e) => {
      cursor.style.left = `${e.pageX}px`;
      cursor.style.top = `${e.pageY}px`;
  });

  document.addEventListener("mousedown", (e) => {
      // Perbesar kursor saat klik
      cursor.style.transform = "scale(2)";

      // Efek ripple
      const ripple = document.createElement("div");
      ripple.classList.add("ripple");
      document.body.appendChild(ripple);
      ripple.style.left = `${e.pageX}px`;
      ripple.style.top = `${e.pageY}px`;

      // Hapus ripple setelah animasi selesai
      setTimeout(() => {
          ripple.remove();
      }, 500);
  });

  document.addEventListener("mouseup", () => {
      cursor.style.transform = "scale(1)";
  });
});
