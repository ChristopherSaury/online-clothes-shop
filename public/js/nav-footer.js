//NAVBAR OPTIONNAL LINK
let clothesLink = document.querySelector('.clothes-shop-link');
let shoesLink = document.querySelector('.shoes-shop-link');

// CLOTHES LINK
const optLinkClothes = () =>{
    shoesLink.style.display = "none";
    clothesLink.style.display = "grid";
}
const closeOptLinkClothes = () =>{
    clothesLink.style.display = "none";
}
// SHOES LINK
const optLinkShoes = () =>{
    clothesLink.style.display = "none";
    shoesLink.style.display = "grid";
}
const closeOptLinkShoes = () =>{
    shoesLink.style.display = "none";
}

// DATE FOOTER  
let yearData = document.getElementById('currentYear');
let currentYear = new Date().getFullYear();
yearData.innerHTML = currentYear;

//MODAL FOOTER
window.onload = () =>{
    const modal = document.querySelector('#modal');
    const close = document.querySelector('.close');
    const links = document.querySelectorAll('.gallery-container a');
    const image = document.querySelector('.modal-content img');
    
    for(let link of links){
        link.addEventListener("click", function(e){
            e.preventDefault();
            image.src = this.href;

            modal.classList.add("show");
        });
        close.addEventListener("click", function(){
            modal.classList.remove('show');
        });
        modal.addEventListener("click", function(){
            modal.classList.remove('show');
        })
    }
}
// NAVBAR MOBILE
function openMobileMenu(){
    let menuIcon = document.querySelector('#mobile-nav .fa-bars');
    let crossMenu = document.querySelector('#mobile-nav .fa-xmark');
    let menuMobile = document.querySelector('.mobile-menu');

    if(!crossMenu.classList.contains('open')){
        crossMenu.classList.add('open');
        menuIcon.style.display = 'none';
        crossMenu.style.display = 'initial';
        menuMobile.style.display = 'flex';
    }else if(crossMenu.classList.contains('open')){
        crossMenu.classList.remove('open');
        crossMenu.style.display = 'none';
        menuIcon.style.display = 'initial';
        menuMobile.style.display = 'none';
    }
}

let navBtn = document.getElementsByClassName('accordion');
let i;

for (i = 1; i <= 4; i++){
    navBtn[i].addEventListener('click', function(){
        this.classList.toggle('btn-active');

        let panel = this.nextElementSibling;
        if (panel.style.display === "flex") {
            panel.style.display = "none";
          } else {
            panel.style.display = "flex";
          }
    });
}
