let signupForm = document.querySelector('#signup #signupForm');
let errMsg = document.querySelector('#signup #signupForm .errorSignUp .errSignUpMsg');
let errMsgContainer = document.querySelector('#signup #signupForm .errorSignUp');
let pattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;

function signup(){
   if(signupForm['email-address'].value === '' || signupForm['password'].value === ''
    || signupForm['password2'].value === '' || signupForm['lastname'].value === ''
    || signupForm['firstname'].value === '' || signupForm['country'].value === ''
    || signupForm['address'].value === '' || signupForm['city'].value === ''
    || signupForm['postcode'].value === '' || signupForm['phone'].value === ''
    || signupForm['birth-date'].value === ''){
    
        return errorSignUpRedirect('You must fill in all the required fields*');

   }else if(signupForm['password'].value != signupForm['password2'].value){
        return errorSignUpRedirect('The field Password and the field Confirm Password must be identical')
   }else if(signupForm['password'].value.length < 8 || signupForm['password'].value.length > 30){
    return errorSignUpRedirect('The password must be between 8 and 30 characters');
   }else if (!signupForm['email-address'].value.match(pattern)){
        return errorSignUpRedirect('Please Enter Valid Email Address');
   }else if (signupForm['lastname'].value.length < 2 || signupForm['lastname'].value.length > 30
    || signupForm['firstname'].value.length < 2 || signupForm['firstname'].value.length > 30){
    return errorSignUpRedirect('Lastname and Firstname must be between 2 and 30 characters');
   }else if (!signupForm['termsOfUse'].checked){
    return errorSignUpRedirect('You must accept terms of use');
}

    let signupData = document.querySelectorAll('#signup #signupForm .signupData');
    let form_data = new FormData();

    for(let count = 0; count < signupData.length; count++){
        form_data.append(signupData[count].name , signupData[count].value);
    }
    document.querySelector('#signup #signupForm #signupSubmit').disabled = true;

    const xhttp = new XMLHttpRequest();
    xhttp.open('POST', '/signup/handler');
    xhttp.send(form_data);

    xhttp.onreadystatechange = function (){
        if(xhttp.readyState == 4 && xhttp.status == 200){
            document.querySelector('#signup #signupForm #signupSubmit').disabled = false;
            document.querySelector('#signup #signupForm').reset();
            if(errMsgContainer.style.display = 'flex'){
                errMsgContainer.style.display = 'none'
            }
            document.querySelector('#signup #signupForm .signupSuccess .suSuccessMsg').innerHTML = 'Account created | check your inbox to confirm your address';
            document.querySelector('#signup #signupForm .signupSuccess').style.display = 'flex';
            return document.documentElement.scrollTop = 0;
        }
    }
}

function errorSignUpRedirect(message){
    window.location.href = '#signupForm';
    errMsg.innerHTML = message;
    if(window.innerWidth > 992){
        document.documentElement.scrollTop = 0 ;
    }
    return errMsgContainer.style.display = 'flex';
}
function closeSuccessSignUp(){
    document.querySelector('#signup #signupForm .signupSuccess').style.display = 'none';
}
function closeErrMsgSignUp(){
    return errMsgContainer.style.display = 'none';
}