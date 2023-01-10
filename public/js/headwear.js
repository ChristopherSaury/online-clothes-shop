let arrowCategory = document.querySelector('#product .product-section #category-option #arrCat');
let arrowColor = document.querySelector('#product .product-section #color-option #arrCol');
let categoryMenu = document.querySelector('#product .product-section #category-menu');
let colorMenu = document.querySelector('#product .product-section #color-menu');

console.log(colorMenu);

function toogleCategory(){
    if(!categoryMenu.classList.contains('open-cat')){
        categoryMenu.classList.add('open-cat');
        arrowCategory.style.transform = 'rotate(180deg)';
        categoryMenu.style.display = 'initial';

        if(colorMenu.classList.contains('open-color')){
            colorMenu.classList.remove('open-color');
            arrowColor.style.transform = 'rotate(0deg)';
            colorMenu.style.display = 'none';
        }

    }else if (categoryMenu.classList.contains('open-cat')){
        categoryMenu.classList.remove('open-cat');
        arrowCategory.style.transform = 'rotate(0deg)';
        categoryMenu.style.display = 'none'; 
    }
}

function toggleColorMenu(){
    if(!colorMenu.classList.contains('open-color')){
        colorMenu.classList.add('open-color');
        arrowColor.style.transform = 'rotate(180deg)';
        colorMenu.style.display = 'initial';

        if(categoryMenu.classList.contains('open-cat')){
            categoryMenu.classList.remove('open-cat');
            arrowCategory.style.transform = 'rotate(0deg)';
            categoryMenu.style.display = 'none';
        }

    }else if (colorMenu.classList.contains('open-color')){
        colorMenu.classList.remove('open-color');
        arrowColor.style.transform = 'rotate(0deg)';
        colorMenu.style.display = 'none';
    }
}
