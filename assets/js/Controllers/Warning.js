const popEl = document.querySelector('.popupAviso');
const btClosePopEl = document.querySelector('#btFechar');

if (btClosePopEl) {
    btClosePopEl.addEventListener('click', e => {
        popEl.style.display = 'none';
    })
}
