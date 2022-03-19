// This function validates the update account section


function validateUpdateAccountName() {
    const NEW_SURNAME = document.querySelector('#new-surname')
    const NEW_OTHERNAME = document.querySelector('#new-othername')
    const NEW_NUM = document.querySelector('#new-number')
    let register_err = document.querySelector('#register-err-msg')
    
    if (NEW_SURNAME.value === "") {
        register_err.innerHTML = "Enter Surname"
        NEW_SURNAME.className = 'form-control mb-2 form-input border-danger'
        return false
    } else {
        NEW_SURNAME.className = 'form-control mb-2 form-input '
    }


    if (NEW_OTHERNAME.value === "") {
        register_err.innerHTML = "Enter Other Name"
        NEW_OTHERNAME.className = 'form-control mb-2 form-input border-danger'
        return false
    }else {
        NEW_OTHERNAME.className = 'form-control mb-2 form-input '
    }

    if (NEW_NUM.value === "") {
        register_err.innerHTML = "Enter phone number"
        NEW_NUM.className = 'form-control mb-2 form-input border-danger'
        return false
    }else {
        NEW_NUM.className = 'form-control mb-2 form-input '
    }
    if (NEW_NUM.value.length !== 11) {
        register_err.innerHTML = "Phone number must be 11 digits"
        NEW_NUM.className = 'form-control mb-2 form-input border-danger'
        return false
    }else {
        NEW_NUM.className = 'form-control mb-2 form-input '
    }
   
}