let slideIndex = 1;
showSlides(slideIndex,'slide-left');

function plusSlides(n, animate){
    showSlides(slideIndex += n, animate);
}

function showSlides(n, animate){
    let i;
    let slides = document.querySelectorAll('#about .slide-testimonial');
    if(n > slides.length){ slideIndex = 1 };
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
      }
    slides[slideIndex-1].style.display = "flex";

    slides[slideIndex - 1].classList.remove('slide-left');
    slides[slideIndex - 1].classList.remove('slide-right');
    slides[slideIndex - 1].classList.add(animate);
}