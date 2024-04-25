const windowDelete = document.querySelector(".windowDeleteConfirm");
const btnTrueConfirm = document.querySelector('.windowDeleteConfirm button.button-type-4');
const btnFalseConfirm = document.querySelector('.windowDeleteConfirm div.button-type-3');
const btnDelete = document.querySelectorAll('a.btn-delete');
const windowDeleteElem = document.querySelector('.windowDeleteConfirm');
const formPosition = document.querySelector('footer');
const formAction = document.querySelector('#formAction');
let link = '';
btnDelete.forEach(Element =>{
    Element.addEventListener('click',function(event){
        windowDeleteElem.style.display="block";
        link =  Element.href;
        event.preventDefault();
        console.log(formAction.action); 
    })
})
btnFalseConfirm.addEventListener('click',function(event){
    windowDeleteElem.style.display="none";
    event.preventDefault();
})
btnTrueConfirm.addEventListener('click',()=>{
    formAction.action = link;
})



