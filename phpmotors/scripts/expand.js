const openUp = document.querySelector('#password');
const pass = document.querySelector('#clientPassword');

pass.addEventListener('focus', () => {
    openUp.classList.add('expanded');
})

/*pass.addEventListener('focusout', () => {   >>>>>>> commented out because it was causing problems with the form submit - focus had to be removed before the button would submit data
    openUp.classList.remove('expanded');
})*/