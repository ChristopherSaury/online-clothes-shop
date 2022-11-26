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