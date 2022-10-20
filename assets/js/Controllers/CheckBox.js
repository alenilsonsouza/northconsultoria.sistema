const checkBoxAllEl = document.querySelector('#checkall');
const checksEls = document.querySelectorAll('.ckeckbox');
const formCheckEl = document.querySelector('#formCheck');

checkBoxAllEl.addEventListener('change', e => e.target.checked ? checkInputAll() : removeCheckedInputAll());

formCheckEl.addEventListener('submit', e => {
    e.preventDefault();
    let q = 0;
    checksEls.forEach(item => item.checked ? q++ : '');
    q === 0 ? alert('Marque pelo menos uma para arquivar') : e.target.submit();
});

function checkInputAll() { checksEls.forEach(item => item.setAttribute('checked', 'checked')); }

function removeCheckedInputAll() { checksEls.forEach(item => item.removeAttribute('checked')); }