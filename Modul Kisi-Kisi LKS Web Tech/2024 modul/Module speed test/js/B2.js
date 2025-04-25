const ratingContainer = document.querySelector(".rating-container");
    const starsFill = document.querySelector(".stars-fill");

    ratingContainer.addEventListener("mousemove", function (e) {
      const rect = this.getBoundingClientRect();
      const offsetX = e.clientX - rect.left;
      const width = rect.width;
      const percentage = (offsetX / width) * 100;

      const step = Math.round(percentage / 10) * 10;
      starsFill.style.width = step + "%";
    });

    ratingContainer.addEventListener("mouseleave", function () {
      starsFill.style.width = "0";
    });