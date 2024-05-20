document.addEventListener('DOMContentLoaded', (event) => {
    const items = document.querySelectorAll('.carousel-item');
    const totalItems = items.length;
    let currentIndex = 0;
    
    function showCarouselItem(index) {
        items.forEach((item, i) => {
            item.style.display = (i === index) ? 'block' : 'none';
        });
    }

    function nextCarouselItem() {
        currentIndex = (currentIndex + 1) % totalItems;
        showCarouselItem(currentIndex);
    }

    function prevCarouselItem() {
        currentIndex = (currentIndex - 1 + totalItems) % totalItems;
        showCarouselItem(currentIndex);
    }

    document.getElementById('carousel-arrow-left').addEventListener('click', prevCarouselItem);
    document.getElementById('carousel-arrow-right').addEventListener('click', nextCarouselItem);

    showCarouselItem(currentIndex);
    setInterval(nextCarouselItem, 7000);
});
