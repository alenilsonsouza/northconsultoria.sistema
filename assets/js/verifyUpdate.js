const localVersion = localStorage.getItem('north_version');

if(localVersion != VERSION) {
    document.querySelector('.updateInfo').style.display = 'flex';
    localStorage.setItem('north_version', VERSION);
}