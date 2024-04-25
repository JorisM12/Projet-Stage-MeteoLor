const btnSnow = document.querySelector('#btn-nav-mobile div:first-child');
const btnWeather = document.querySelector('#btn-nav-mobile div:last-child');
const btnNextGraph =  document.querySelector('a#nextGraph');
const btnPreviousGraph =  document.querySelector('a#previousGraph');
const weatherModuleElem = document.querySelector('#weather-module');
const snowModuleElem =  document.querySelector('main section.container-type-1:nth-child(2)')
const graphTemp = document.querySelector('#container-aside aside:nth-child(1)');
const graphWind = document.querySelector('#container-aside aside:nth-child(2)');
const graphRain = document.querySelector('#container-aside aside:nth-child(3)');
btnSnow.addEventListener('click',()=>{
    weatherModuleElem.style.display ='none';
    snowModuleElem.style.display ='flex';
})
btnWeather.addEventListener('click',()=>{
    snowModuleElem.style.display ='none';
    weatherModuleElem.style.display ='block';
})
let index = 0;
btnNextGraph.addEventListener('click',()=>{
    index > 2 ? index = 0 : index = index;
    index++;
    viewGraph(index);
});
function viewGraph(index) {
    switch (index) {
        case 1:
            graphTemp.classList.add('viewNone');
            graphWind.classList.remove('viewNone');
            break;
        case 2:
            graphWind.classList.add('viewNone');
            graphRain.classList.remove('viewNone');
            break;
        case 3:
            graphRain.classList.add('viewNone');
            graphTemp.classList.remove('viewNone');
            break;
        default:
            break;
    }
}