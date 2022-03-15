const LoadingEl = document.querySelector('.loading');
const elementsForm = document.querySelectorAll('input, select, textarea, button');

function loading(bool) {
    if(bool) {
        LoadingEl.style.display = 'flex';
        elementsForm.forEach((item)=>{
            item.setAttribute('disabled','disabled');
            
        })
    } else {
        LoadingEl.style.display = 'none';
        elementsForm.forEach((item)=>{
            item.removeAttribute('disabled');
        })
    }
}