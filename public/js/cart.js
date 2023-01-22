function resetCart(){
    let modal = document.querySelector('#shopping-cart .modal-msg');
    let btnSubmit = document.querySelector('#shopping-cart form #payment');
   
    modal.style.display = 'grid';
    btnSubmit.disabled = true;

    const xhttp = new XMLHttpRequest;
    xhttp.open('POST', '/cart/empty');
    xhttp.send();

    xhttp.onreadystatechange = function(){
        if(xhttp.readyState == 4 && xhttp.status == 200){
            btnSubmit.disabled = false;
            setTimeout(function(){
                window.location.href = '/cart';
            }, 5000)
        }
    }
}
