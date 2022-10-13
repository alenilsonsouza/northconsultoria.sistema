const inputSearchEl = document.querySelector('#searchPartner');
const divContent = document.querySelector('.parceiros_redes');

inputSearchEl.addEventListener('keyup', async (e) => {
    let str = e.target.value;
    if(str.length >= 3) {
        await getPartnerSearch(str);
    } else {
        await getPartnerAll();
    }
});

async function getPartnerSearch(string) {
    let r = await fetch(`${BASE_URL}ajax/listarRedesSite?s=${string}`);
    let response = await r.text();
    divContent.innerHTML = response;
}
async function getPartnerAll() {
    let r = await fetch(`${BASE_URL}ajax/listarTodosRedesSite`);
    let response = await r.text();
    divContent.innerHTML = response;
}

