function toggleMenu(){
    let menu2El = document.querySelector('.menu2');

    if(menu2El.getAttribute('style') === 'display: block;') {
        menu2El.style.display = 'none';
    } else {
        menu2El.style.display = 'block';
    }
}