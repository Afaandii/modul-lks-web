const button = document.querySelector(".animation-btn");

        button.addEventListener("click", function(event) {
            for (let i = 0; i < 10; i++) {
                let bubble = document.createElement("span");
                bubble.classList.add("bubble");
                document.body.appendChild(bubble);

                // menentukan posisi sumbu horizontal dan vertikal dari bubble
                let x = event.clientX + (Math.random() * 200 - 100);
                let y = event.clientY + (Math.random() * 200 - 100);
                let size = Math.random() * 20 + 20;

                bubble.style.width = `${size}px`;
                bubble.style.height = `${size}px`;
                bubble.style.left = `${x}px`;
                bubble.style.top = `${y}px`;

                setTimeout(() => {
                    bubble.remove();
                }, 600);
            }
        });