const activepage = window.location.pathname;
const navLinks = document.querySelectorAll('div a').forEach(link => {
    if(link.href.includes(`${activepage}`)){
        link.classList.add('active');
    }
})