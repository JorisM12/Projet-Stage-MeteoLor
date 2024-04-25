const btnBurgerMenu = document.querySelector('#burger-menu');
const btnCloseBurgerMenu = document.querySelector('#btn-close-menu');
const burgerMenuElem = document.querySelector('.bloc-burger-menu');
btnBurgerMenu.addEventListener('click',()=>{
    burgerMenuElem.style.display = 'flex';
    burgerMenuElem.style.animation ='burgerAnimationOpen 0.3s';
    burgerMenuElem.style.right = '0px';    
})
btnCloseBurgerMenu.addEventListener('click',()=>{
    burgerMenuElem.style.animation ='burgerAnimationClose 0.4s';
    setTimeout(()=>{
        burgerMenuElem.style.display = 'none';
    },300)
})