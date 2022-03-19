// This function validates the login form

function validateLogin() {
    const EMAIL = document.querySelector('#email')
    const PWD = document.querySelector('#password')
    let register_err = document.querySelector('#register-err-msg')

    if (EMAIL.value === "") {
        register_err.innerHTML = "Invalid Email"
        EMAIL.className = 'form-control mt-2 form-input border-danger'
        return false
    } else {
        EMAIL.className = 'form-control mt-2 form-input '
    }


    if (PWD.value === "") {
        register_err.innerHTML = "Invalid Password"
        PWD.className = 'form-control mt-2 form-input border-danger'
        return false
    }else {
        PWD.className = 'form-control mt-2 form-input '
    }
}