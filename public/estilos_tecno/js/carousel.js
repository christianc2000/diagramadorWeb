document.addEventListener("DOMContentLoaded", function () {
    const carousels = document.querySelectorAll(".carousel-container");

    carousels.forEach((carousel) => {
        let currentIndex = 0;
        let itemsPerPage = determineItemsPerPage(); // Cambiar a let para que sea reasignable

        function determineItemsPerPage() {
            const screenWidth = window.innerWidth;
            if (screenWidth >= 1024) {
                return 4;
            } else if (screenWidth >= 768) {
                return 3;
            } else if (screenWidth >= 640) {
                return 2;
            } else {
                return 1;
            }
        }

        function showPage(page) {
            const items = carousel.querySelectorAll(".carousel-item");
            const totalPages = Math.ceil(items.length / itemsPerPage);

            if (page < 0) {
                currentIndex = totalPages - 1;
            } else if (page >= totalPages) {
                currentIndex = 0;
            } else {
                currentIndex = page;
            }

            const itemWidth = 100 / itemsPerPage; // Ancho en porcentaje
            const translateValue = -currentIndex * itemWidth * itemsPerPage + "%"; // Ajuste del cálculo
            carousel.querySelector(".carousel-wrapper").style.transform = "translateX(" + translateValue + ")";
        }

        showPage(0);

        carousel.querySelector(".prevBtn").addEventListener("click", function () {
            showPage(currentIndex - 1);
        });

        carousel.querySelector(".nextBtn").addEventListener("click", function () {
            showPage(currentIndex + 1);
        });

        window.addEventListener("resize", function () {
            // Ajustar la cantidad de elementos por página en cambio de tamaño de pantalla
            itemsPerPage = determineItemsPerPage();
            showPage(0);
        });
    });
});
