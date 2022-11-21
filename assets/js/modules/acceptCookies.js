function acceptCookie() {
    let cookieAccept = document.querySelector('.cookieAccept');
    let bt = document.querySelector('.acceptCookie');
    if(cookieAccept){
        if(localStorage.getItem('cookies') == null) {
            cookieAccept.style.display = 'flex';
        }
    }
    if (bt) {
        bt.addEventListener('click', () => {
            localStorage.setItem('cookies', 'accept');
            cookieAccept.style.display = 'none';
        });
    }

}
export default acceptCookie;