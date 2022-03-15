const formSearchCorretor = document.querySelector('#form_search_corretor');
const formRegister = document.querySelector('#form-register');
const inputSearch = document.querySelector('#n_corretor');
const resultCorretor = document.querySelector('#result--corretor');
const inputHiddenIdCorretor = document.querySelector('#id_corretor');
const noCorretoEl = document.querySelector('#no-corretor');
const DependentesArea = document.querySelector('#bt_dependentes');
const formDependenteArea = document.querySelector('.area-dependentes-form');
const btAddDependente = document.querySelector('#addDependente');
const cpfInput = document.querySelectorAll('.cpfInput');
const emailInput = document.querySelector('.emailInput');
const enabledDisabledInpus = document.querySelectorAll('.input-enableDisabled');
const idClient = document.querySelector('#id_client');

formSearchCorretor.addEventListener('submit', submitFormCorretor);
noCorretoEl.addEventListener('change', changeNoCorretor);
btAddDependente.addEventListener('click', addDependente);
formRegister.addEventListener('submit', registerData);
emailInput.addEventListener('blur', verifyEmailInput)

cpfInput.forEach(item => {
    item.addEventListener('keyup', verifyCPFInput);
});

enabledDisabledInpus.forEach(item => {
    enableDisableInput(item, true);
});

// Verificação se CPF já existe 
async function verifyCPFInput(e) {
    let warning = document.querySelector('.warningCPF');
    let elem = e.target;
    let cpf = e.target.value;
    if (cpf.length == 14) {
        let res = await verifycpfExist(cpf);
        if (!res.response) {
            enabledDisabledInpus.forEach(item => {
                enableDisableInput(item, false);
            });
            elem.removeAttribute('style');
            formatWarningHandler(warning, false, '')
        } else {
            enabledDisabledInpus.forEach(item => {
                enableDisableInput(item, true);
            });
            elem.style.border = '4px solid red';
            formatWarningHandler(warning, true, 'CPF já cadastrado no sistema.')
        }
    }
}
async function verifyEmailInput(e) {
    let warning = document.querySelector('.warningEmail');
    let elem = e.target;
    let email = e.target.value;
    if (email.length > 4) {
        let res = await verifyEmailExist(email);
        elem.removeAttribute('style');
        formatWarningHandler(warning, false, '');
        enabledDisabledInpus.forEach(item => {
            enableDisableInput(item, false);
        });
        if (res.response === true) {
            elem.style.border = '4px solid red';
            formatWarningHandler(warning, true, 'E-mail já existe no sistema!');
            enabledDisabledInpus.forEach(item => {
                enableDisableInput(item, true);
            });
            elem.removeAttribute('disabled');
            elem.style.backgroundColor = '#fff';
        }
    }

}
function formatWarningHandler(elem, b = false, text) {
    if (b === true) {
        elem.style.padding = '5px';
        elem.style.color = 'red';
        elem.innerHTML = text;
    } else {
        elem.removeAttribute('style');
        elem.innerHTML = '';
    }

}

function enableDisableInput(e, bool = false) {
    if (bool === true) {
        e.setAttribute("disabled", "disabled");
        e.style.backgroundColor = '#ccc';
    } else {
        e.removeAttribute("disabled");
        e.removeAttribute('style');
    }
}

async function registerData(e) {
    e.preventDefault();

    let formData = new FormData(formRegister);

    let data = {
        id_people: formData.get('id_corretor'),
        id_plan: formData.get('id_plan'),
        name: formData.get('fullName'),
        mother_name: formData.get('nameMother'),
        birthdate: formData.get('birthdate'),
        email: formData.get('email'),
        tel_fix: formData.get('tel_fixed'),
        tel_cel: formData.get('tel_cel'),
        cpf: formData.get('cpf'),
        rg: formData.get('rg'),
        from: formData.get('from'),
        sexo: formData.get('sexo'),
        marital_status: formData.get('marital_status'),
        type_register: 'T',
        kinship: ''
    }

    let registerPostId = await registerPost(data);

    let confirm = false;

    if (registerPostId !== null) {
        confirm = true;
        // Endereço
        let dataAddress = {
            id_people: registerPostId,
            cep: formData.get('cep'),
            logradouro: formData.get('logradouro'),
            numero: formData.get('numero'),
            complemento: formData.get('complemento'),
            bairro: formData.get('bairro'),
            cidade: formData.get('cidade'),
            estado: formData.get('estado')
        }
        await addAddressRegister(dataAddress);

        // Documentos do titular
        let doc;
        doc = {
            id_people: registerPostId,
            file: formData.get('file_rg'),
            type: 'RG'
        }
        await addDoc(doc);

        doc = {
            id_people: registerPostId,
            file: formData.get('file_cpf'),
            type: 'CPF'

        }
        await addDoc(doc);

        doc = {
            id_people: registerPostId,
            file: formData.get('file_cr'),
            type: 'CR'

        }
        await addDoc(doc);

    }

    // Pegar informações dos dependentes (ALL)
    let dNome = formData.getAll('d_name');
    let dMotherName = formData.getAll('d_motherName');
    let dCpf = formData.getAll('d_cpf');
    let dRg = formData.getAll('d_rg');
    let dBirthdate = formData.getAll('d_birthdate');
    let dSexo = formData.getAll('d_sexo');
    let dParentesco = formData.getAll('d_parentesco');
    let dFileRG = formData.getAll('d_file_rg');
    let dFileRgTitle = formData.getAll('d_file_rg_title');
    let dFileCPF = formData.getAll('d_file_cpf');
    let dFileCPFTitle = formData.getAll('d_file_cpf_title');

    // Cadastrado de Depentende individuais
    for (let q = 0; q < dNome.length; q++) {
        if (dNome[q]) {
            let data = {
                id_people: registerPostId,
                id_plan: formData.get('id_plan'),
                name: dNome[q],
                mother_name: dMotherName[q],
                birthdate: dBirthdate[q],
                email: '',
                tel_fix: '',
                tel_cel: '',
                cpf: dCpf[q],
                rg: dRg[q],
                from: '',
                sexo: dSexo[q],
                marital_status: '',
                type_register: 'D',
                kinship: dParentesco[q]
            }
            let idDependente = await registerPost(data);
            if (idDependente !== null) {
                confirm = true;
            }
            let doc;
            doc = {
                id_people: idDependente,
                file: dFileRG[q],
                type: 'RG'
            }
            await addDoc(doc);

            doc = {
                id_people: idDependente,
                file: dFileCPF[q],
                type: 'CPF'
            }
            await addDoc(doc);
        }

    }

    // mensagem de confirmação
    if (confirm) {
        idClient.value = registerPostId;

        // obsoleto...
        formRegister.submit();

        // novo...
        /*let obj = {};
        for (let item of formData) {
            Object.defineProperty(obj, item[0], {
                value: item[1]
            });
        }
        console.log(obj);
        addClientToAsass(obj);
        modalEl.style.display = 'none';*/
        
    }

}

function submitFormCorretor(e) {
    e.preventDefault();
    let id = inputSearch.value;
    getOne(id, 'C');
}
let n = 0;
function addDependente() {
    n++;
    let divEl = document.createElement('div');
    divEl.setAttribute('class', `area-dependentes grid grid-4 elementItem${n}`);
    divEl.setAttribute('data-n', n);

    let html = `
                <div class="bt-remove" data-btn="${n}">Remover</div>
                <div>
                    <label for="d_name">Nome:</label>
                    <input type="text" name="d_name" id="d_name${n}">
                </div>
                <div>
                    <label for="d_motherName">Nome da mãe:</label>
                    <input type="text" name="d_motherName" id="d_motherName${n}">
                </div>
                <div>
                    <label for="d_cpf">CPF:</label>
                    <input type="text" name="d_cpf" id="d_cpf${n}" onkeyup="mascara('###.###.###-##',this,event,true);">
                </div>
                <div>
                    <label for="d_rg">RG:</label>
                    <input type="text" name="d_rg" id="d_rg${n}">
                </div>
                <div>
                    <label for="d_birthdate">Data de Nascimento:</label>
                    <input type="date" name="d_birthdate" id="d_birthdate${n}">
                </div>
                <div>
                    <label for="d_sexo">Sexo:</label>
                    <select name="d_sexo" id="d_sexo${n}">
                        <option value="M">Masculino</option>
                        <option value="F">Feminino</option>
                    </select>
                </div>
                <div>
                    <label for="d_parentesco">Perentesco:</label>
                    <select name="d_parentesco" id="d_parentesco${n}">
                        <option value="Pai">Pai</option>
                        <option value="Mãe">Mãe</option>
                        <option value="Irmão">Irmão</option>
                        <option value="Irmã">Irmã</option>
                        <option value="Primo(a)">Primo(a)</option>
                        <option value="Tio(a)">Tio(a)</option>
                        <option value="Filho(a)">Filho(a)</option>
                    </select>
                </div>
                <div>
                    <label for="d_file_rf">Foto do RG:</label>
                    <input type="file" name="d_file_rg" id="d_file_rg${n}" required accept="image/*">
                    <input type="hidden" name="d_file_rg_title" value="RG">
                </div>
                <div>
                    <label for="d_file_cpf">Foto do CPF:</label>
                    <input type="file" name="d_file_cpf" id="d_file_cpf${n}" required accept="image/*">
                    <input type="hidden" name="d_file_cpf_title" value="CPF">
                </div>
    `;
    divEl.innerHTML = html;
    formDependenteArea.appendChild(divEl);
    handleremoveDependente();
}

function handleremoveDependente() {
    let btRemoveDependente = document.querySelectorAll('.bt-remove');
    btRemoveDependente.forEach((item) => {
        item.addEventListener('click', removeItemDependente);
    });
}

function removeItemDependente(e) {
    let num = e.target.getAttribute('data-btn');
    document.querySelector(`.elementItem${num}`).remove();
}

function changeNoCorretor(e) {
    if (e.target.checked) {
        formSearchCorretor.style.display = 'none';
        resultCorretor.style.display = 'none';
        inputHiddenIdCorretor.value = '';
        resultCorretor.innerHTML = '';
        inputHiddenIdCorretor.value = '';
        inputSearch.value = '';
        resultCorretor.classList.remove('corretor--result--area');
    } else {
        formSearchCorretor.style.display = 'flex';
        resultCorretor.style.display = 'block';
    }
}
async function addClientToAsass(data) {
    loading(true);
    await apiLocal.addClientToAsass(data);
    loading(false);
    
}

async function getOne(id, type) {
    loading(true);
    let result = await Api.getRegisterOne(id, type);
    loading(false);
    result.error === '' ? mountResultCorretor(result.list) : alert(result.error);
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

async function addDoc(data) {
    loading(true);
    let result = await Api.addFile(data);
    loading(false);
    if (result.error !== '') {
        alert(result.error);
    }
}

async function registerPost(data) {
    loading(true);
    let result = await Api.addRegister(data);
    loading(false);

    if (result.error === '') {
        return result.id
    } else {
        alert(result.error);
        return null;
    }
}

async function addAddressRegister(data) {
    loading(true);
    let result = await Api.addAddress(data);
    loading(false);

    if (result.error === '') {
        return null;
    } else {
        alert(result.error);
    }
}

async function addAsaasClient(data) {
    loading(true);
    let result = await apiAsaas.addClient(data);
    loading(false);
    console.log(result);
    if (result.id) {

        return result.id;
    } else {
        alert('Ops! Houve algum erro no cadastro do Asaas');
    }
}

function mountResultCorretor(item) {
    if (item) {
        resultCorretor.classList.add('corretor--result--area');
        resultCorretor.innerHTML = `<p>Vendedor(a):<br><strong>${item.name}</strong></p>`;
        inputHiddenIdCorretor.value = item.id;
    } else {
        resultCorretor.classList.add('corretor--result--area');
        resultCorretor.innerHTML = `<p>Sem resultados</p>`;
        inputHiddenIdCorretor.value = '';

    }
}

