const costumersEl = document.querySelector('#costumers');
const start_dateEl = document.querySelector('#start_date');
const final_dateEl = document.querySelector('#final_date');
const resulEl = document.querySelector('.result');


costumersEl.addEventListener('change', getValuesFromForm);
start_dateEl.addEventListener('change', getValuesFromForm);
final_dateEl.addEventListener('change', getValuesFromForm);


async function getValuesFromForm() {
    let costumer = costumersEl.value.toString();
    let startDate = start_dateEl.value.toString();
    let finalDate = final_dateEl.value.toString();

    if(startDate <= finalDate) {
        let data = {
            costumer,
            startDate,
            finalDate
        }
        let res = await apiLocal.getClientsByConstumer(data);
        resulEl.innerHTML =  res;
    }

    console.log(costumersEl.value);
    console.log(start_dateEl.value);
    console.log(final_dateEl.value);
}
