let contactForm = document.querySelector('#contact .form-section #contact-form');
let pattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;

function contactFormAction(){
    if(contactForm['full-name'].value === '' || contactForm['email-sender'].value === ''
    || contactForm['contact-subject'].value === '' || contactForm['contact-message'].value === ''){
        errorContactManagement('You must fill in all the required fields*')
    }else if(!contactForm['email-sender'].value.match(pattern)){
        errorContactManagement('Please Enter Valid Address');
    }

    let contactData = document.querySelectorAll('#contact #contact-form .contact-data');
    let form_data = new FormData();

    for (let count = 0; count < contactData.length; count++){
        form_data.append(contactData[count].name , contactData[count].value);
    }
    document.querySelector('#contact #contact-form .ct-button').disable = true;

    const xhttp = new XMLHttpRequest();
    xhttp.open('POST','/contact/handler');
    xhttp.send(form_data);

    xhttp.onreadystatechange = function(){
        if(xhttp.readyState == 4 && xhttp.status == 200){
            document.querySelector('#contact #contact-form .ct-button').disable = false;
            document.querySelector('#contact .form-section #contact-form').reset();
            if(document.querySelector('#contact #contact-form .errorContact').style.display = 'flex'){
                document.querySelector('#contact #contact-form .errorContact').style.display = 'none'
            }
            document.querySelector('#contact #contact-form .successContactMsg').innerHTML = 'Message sent successfully';
            document.querySelector('#contact #contact-form .successContact').style.display = 'flex';
            return document.documentElement.scrollTop = 420;
        }
    }
}
function errorContactManagement(message){
    window.location.href = '#contact-form';
    document.querySelector('#contact #contact-form .errorContactMsg').innerHTML = message;
    document.querySelector('#contact #contact-form .errorContact').style.display = 'flex';
    // The heigh of the div that contain the map is 420px scrollTop 420 bring us just below the map
    return document.documentElement.scrollTop = 420;
}
function closeContactsuccess(){
    return document.querySelector('#contact #contact-form .successContact').style.display = 'none';
}
function closeContactErr(){
    return document.querySelector('#contact #contact-form .errorContact').style.display = 'none';
}
