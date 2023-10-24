const openUp = document.querySelector('#password');
const pass = document.querySelector('#clientPassword');

pass.addEventListener('focus', () => {
    openUp.classList.add('expanded');
})

pass.addEventListener('focusout', () => {
    openUp.classList.remove('expanded');
})