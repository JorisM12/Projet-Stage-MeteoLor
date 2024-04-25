const btnHoursA = document.querySelector('#hourly-order div div:nth-child(1)');
const btnHoursB = document.querySelector('#hourly-order div div:nth-child(2)');
const btnHoursC = document.querySelector('#hourly-order div div:nth-child(3)');
const btnHoursD = document.querySelector('#hourly-order div div:nth-child(4)');
const btnHoursE = document.querySelector('#hourly-order div div:nth-child(5)');
const btnViewSky = document.querySelector('#type-obs-order div div:nth-child(1)');
const btnViewTemperature = document.querySelector('#type-obs-order div div:nth-child(2)');
const btnViewWind = document.querySelector('#type-obs-order div div:nth-child(3)');
const viewSkyElem = document.querySelectorAll('main section #map div.weather-obs.sky');
const viewTemperatureElem = document.querySelectorAll('main section #map div.weather-obs.temperature');
const viewWindElem = document.querySelectorAll('main section #map div.weather-obs.wind');
const observationWindowElem = document.querySelector('aside');
const screenWidth = window.innerWidth;
btnViewSky.addEventListener('click',()=>{
    viewSkyElem.forEach(Element => {
        Element.style.display='block';
    })
    viewTemperatureElem.forEach(Element => {
        Element.style.display='none';
    })
    viewWindElem.forEach(Element => {
        Element.style.display='none';
    })
    btnViewSky.classList.add('box-selected');
    btnViewTemperature.classList.remove('box-selected');
    btnViewWind.classList.remove('box-selected');
})
btnViewTemperature.addEventListener('click',()=>{
    viewSkyElem.forEach(Element => {
        Element.style.display='none';
    })
    viewTemperatureElem.forEach(Element => {
        Element.style.display='block';
    })
    viewWindElem.forEach(Element => {
        Element.style.display='none';
    })
    btnViewSky.classList.remove('box-selected');
    btnViewTemperature.classList.add('box-selected');
    btnViewWind.classList.remove('box-selected');
})
btnViewWind.addEventListener('click',()=>{
    viewSkyElem.forEach(Element => {
        Element.style.display='none';
    })
    viewTemperatureElem.forEach(Element => {
        Element.style.display='none';
    })
    viewWindElem.forEach(Element => {
        Element.style.display='block';
    })
    btnViewSky.classList.remove('box-selected');
    btnViewTemperature.classList.remove('box-selected');
    btnViewWind.classList.add('box-selected');
})
function viewDesktopObs () {
    viewSkyElem.forEach(Element =>{
        Element.addEventListener('mouseover',()=>{
            const positionElem = Element.getBoundingClientRect();
            const topViewPosition = positionElem.bottom + 30;
            const leftViewPosition = positionElem.left - 70;
            observationWindowElem.style.left= leftViewPosition+'px';
            observationWindowElem.style.top= topViewPosition+'px';
            observationWindowElem.style.display="flex";
            
        })
        Element.addEventListener('mouseout',()=>{
            observationWindowElem.style.display="none";
        })
    })
}
function executeScriptBasedOnScreenWidth() {
    viewSkyElem.forEach(Element => {
        Element.addEventListener('click', () => {
            observationWindowElem.style.display = "flex";
        });
    });
    observationWindowElem.addEventListener('click', () => {
        observationWindowElem.style.display = "none";
    });
}
if(screenWidth < 1100 ) {
    executeScriptBasedOnScreenWidth();
}else{
    viewDesktopObs();
}