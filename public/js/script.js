const slides = document.querySelector('.slides');
const slideCount = document.querySelectorAll('.slides img').length;
let index = 0;

document.querySelector('.next').onclick = () => {
    index = (index + 1) % slideCount;
    slides.style.transform = `translateX(-${index * 100}%)`;
}

document.querySelector('.prev').onclick = () => {
    index = (index - 1 + slideCount) % slideCount;
    slides.style.transform = `translateX(-${index * 100}%)`;
}

