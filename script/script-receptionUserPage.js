const formMobileElem = document.querySelector('main section#desktop-view-choice section');
const btnFormMobileElem = document.querySelector('main section#desktop-view-choice section');
const btnCloseFormElem = document.querySelector('main section#desktop-view-choice div#close-form-mobile');
btnCloseFormElem.addEventListener('click',()=>{
    formMobileElem.style.display = 'none';
})