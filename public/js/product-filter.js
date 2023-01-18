window.onload = function(){
    const filterForm = document.querySelector('#product #productFilter');
    const inputForm = document.querySelectorAll('#product #productFilter input');
    inputForm.forEach(input =>{
        input.addEventListener('change', function(){

            const Form = new FormData(filterForm);
            const Params = new URLSearchParams;
            
            Form.forEach((value, key) => {
                Params.append(key, value);
            });
            const Url = new URL(window.location.href);

            fetch(Url.pathname + "?" + Params.toString() + "&ajax=1",{
                headers: {
                    "X-Requested-With": "XMLHttpRequest"
                }
                }).then(response => 
                    response.json()
            ).then(data =>{
                const content = document.querySelector("#product #content");

                content.innerHTML = data.content;
            }).catch(e => alert(e))
        })
    })


    //FOOTER 
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

function sortCheckbox(element){
    if(element.checked != true){
        return element.checked = false;
    }

    let checkSort = document.querySelectorAll('#product .sortInput');
    for (let i = 0; i < checkSort.length; i++){
        checkSort[i].checked = false;
    }
    return element.checked = true;   
}