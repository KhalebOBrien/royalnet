// Form validation for register 


function validateRegister() {
    const SURNAME = document.querySelector('#surname')
    const OTHERNAME = document.querySelector('#otherName')
    const EMAIL = document.querySelector('#email')
    const PHONE_NUM = document.querySelector('#phoneNum')
    const PWD = document.querySelector('#pwd')
    const RENETER_PWD = document.querySelector('#pwd2')
    let register_err = document.querySelector('#register-err-msg')
    let emailRegEx =  /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;

    if (SURNAME.value === "") {
        register_err.innerHTML = "Enter Surname"
        SURNAME.className = 'form-control mt-2 form-input border-danger'
        return false
    } else {
        SURNAME.className = 'form-control mt-2 form-input '
    }


    if (OTHERNAME.value === "") {
        register_err.innerHTML = "Enter Other Name"
        OTHERNAME.className = 'form-control mt-2 form-input border-danger'
        return false
    }else {
        OTHERNAME.className = 'form-control mt-2 form-input '
    }

    if (EMAIL.value === "") {
        register_err.innerHTML = "Enter email"
        EMAIL.className = 'form-control mt-2 form-input border-danger'
        return false
    }else {
        EMAIL.className = 'form-control mt-2 form-input '
    }
    if (!emailRegEx.test(EMAIL.value)) {
        register_err.innerHTML = "Enter valid email"
        EMAIL.className = 'form-control mt-2 form-input border-danger'
        return false
    }else {
        EMAIL.className = 'form-control mt-2 form-input '
    }


    if (PHONE_NUM.value === "") {
        register_err.innerHTML = "Enter phone number"
        PHONE_NUM.className = 'form-control mt-2 form-input border-danger'
        return false
    }else {
        PHONE_NUM.className = 'form-control mt-2 form-input '
    }
    if (PHONE_NUM.value.length !== 11) {
        register_err.innerHTML = "Phone number must be 11 digits"
        PHONE_NUM.className = 'form-control mt-2 form-input border-danger'
        return false
    }else {
        PHONE_NUM.className = 'form-control mt-2 form-input '
    }
   

    if (PWD.value.length < 6) {
        register_err.innerHTML = "Password must be up to six characters"
        PWD.className = 'form-control mt-2 form-input border-danger'
        return false
    }else {
        PWD.className = 'form-control mt-2 form-input '
    }


    if (RENETER_PWD.value !== PWD.value) {
        register_err.innerHTML = "Both passwords must match"
        RENETER_PWD.className = 'form-control mt-2 form-input border-danger'
        return false
    }else {
        RENETER_PWD.className = 'form-control mt-2 form-input'
    }
}   