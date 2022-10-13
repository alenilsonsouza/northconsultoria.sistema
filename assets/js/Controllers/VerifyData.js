const cpfInput = document.querySelector('#cpf');
const emailInput = document.querySelector('#email');

cpfInput.addEventListener('keyup', handlerCPFExist);
emailInput.addEventListener('blur', handlerEmailExist);

async function handlerCPFExist(e) {
    let cpf = e.target.value;
    if (cpf.length === 14) {
        let result = await verifycpfExist(cpf);
        
        let inputEls = document.querySelectorAll('input, select, button');
        disabledInputForm(inputEls, 'OFF');
        if (result.response === true) {
            disabledInputForm(inputEls, 'ON');
            cpfInput.removeAttribute('disabled');
            alert('CPF já cadastrado no sistema');
        }
    }
}

async function handlerEmailExist(e) {
    let email = e.target.value;
    let result = await verifyEmailExist(email);

    let inputEls = document.querySelectorAll('input, select, button');
    disabledInputForm(inputEls, 'OFF');
    if (result.response === true) {
        disabledInputForm(inputEls, 'ON');
        emailInput.removeAttribute('disabled');
        alert('E-mail já cadastrado no sistema');
    }
}

async function verifycpfExist(cpf) {
    loading(true);
    let result = await Api.verifyCPFExists(cpf);
    loading(false);
    return result;
}

async function verifyEmailExist(email) {
    loading(true);
    let result = await Api.verifyEmailExists(email);
    loading(false);
    return result;
}

function disabledInputForm(items, status) {
    items.forEach((item) => {
        if (status === 'ON') {
            item.setAttribute('disabled', 'disabled');
        } else {
            item.removeAttribute('disabled');
        }

    });
}