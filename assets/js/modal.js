
const modalEl = document.querySelector('.modal');
const modalClose = document.querySelector('.modal-close');


function openModal(type, id) {
    modalEl.style.display = 'block';
    if(type === 'planos') {
        let inputIdPlan = document.querySelector('#id_plan');
        
        inputIdPlan.value = id;
        getPlanOne(id);
    }
}

function closeModal() {
    modalEl.style.display = 'none';
}

async function getPlanOne(id) {
    loading(true)
    let result = await Api.getPlanOne(id);
    loading(false);
    result.error === ''?mountDescPlan(result.list):alert(result.error);
}

function mountDescPlan(item) {
    let registerTitle = document.querySelector('.register--title h2');
    let inputHiddenPlanValue = document.querySelector('#planValue');
    let inputHiddenPlanName = document.querySelector('#planName');
    registerTitle.innerHTML = `${item.product} - ${item.valor_real}`;
    inputHiddenPlanValue.value = item.price;
    inputHiddenPlanName.value = item.product;
}