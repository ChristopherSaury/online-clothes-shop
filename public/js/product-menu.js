let arrowCategory = document.querySelector('#product .product-section #category-option #arrCat');
let arrowColor = document.querySelector('#product .product-section #color-option #arrCol');
let arrowSort = document.querySelector('#product .product-section #sort-option #arrSort');
let categoryMenu = document.querySelector('#product .product-section #category-menu');
let colorMenu = document.querySelector('#product .product-section #color-menu');
let sortMenu = document.querySelector('#product .product-section #sort-menu');

function toggleFilterMenu(element, classToggle){
    const toggleClass = [categoryMenu, colorMenu, sortMenu];
    const filterArrow = [arrowCategory, arrowSort, arrowColor];
    
    for (let j = 0; j < filterArrow.length; j++ ){
        filterArrow[j].style.transform = 'rotate(0deg)';
    }
    for (let i = 0; i < toggleClass.length; i++){
        toggleClass[i].style.display = 'none';

        if(toggleClass[i].classList.contains(classToggle) 
        &&  !element.children[1].classList.contains('openedArrow')){
            toggleClass[i].style.display = 'initial';
            element.children[1].classList.add('openedArrow');
            element.children[1].style.transform = 'rotate(180deg)';
        }else if(toggleClass[i].classList.contains(classToggle) 
        && element.children[1].classList.contains('openedArrow')){
            toggleClass[i].style.display = 'none';
            element.children[1].classList.remove('openedArrow');
            element.children[1].style.transform = 'rotate(0deg)';
        }
    }
}