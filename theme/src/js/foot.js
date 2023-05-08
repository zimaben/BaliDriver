import * as global from './frontend/global.js';
import { setUpCanvas, setUpSlide } from './frontend/animated-canvas.js';
import { setUpCarousel, doBookingFormInit } from './frontend/carousel.js';
import { doCurrencyPicker } from './frontend/currency-picker.js';
import { scrollSVG, removeScrollSVG, addObserver } from './frontend/scroll.js';

window.addEventListener('DOMContentLoaded', (event) => {
    
    let processlist = document.querySelectorAll('[data-process]');
    //do our process list - switch is fastest
    processlist.forEach((item) => {
        let process = item.getAttribute('data-process');
        switch (process){
            case "doProgressiveHeader" : 
                doProgressiveHeader(item);
                break;
            case "CarouselControls" : 
                setUpCarousel(item);
                break;
            case "doSlide" : 
                setUpSlide(item);
                break;
            case "doCanvasSlide" : 
                setUpCanvas(item);
                break;
            case "doBookingFormInit" : 
                doBookingFormInit(item);
                break;
            case "doCurrencyPicker" : 
                doCurrencyPicker(item);
                break;
            case "scrollTrigger" : 
                let functionname = item.getAttribute('data-scroll-function');
                switch (functionname){
                    case "scrollSVG" : 
                        //add scrolltrigger (intersection observer)
                        console.log("adding observer");
                        addObserver(item, {
                            cb: scrollSVG,
                            unbind: removeScrollSVG
                        });
                    break;
                    default: break;
                }
                break;
            default: 
                //she doesn't even go here
                break;
        }      
    });
    global.doAccordionClicks();
    //window.onload_data_fetch();
    global.doMobileMenuClick();
    //window.setupModals();
});
window.addEventListener('resize', (event) =>{
    let processlist = document.querySelectorAll('[data-process]');
    //do our process list - switch is fastest
    processlist.forEach((item) => {
        let process = item.getAttribute('data-process');
        switch (process){
            case "doProgressiveHeader" : 
                doProgressiveHeader(item);
                break;
            default: 
                //she doesn't even go here
                break;
        }      
    });
});
//window.onscroll = function(){global.stickyNav();}
//do scroll reveal
document.addEventListener("scroll", (event) => {
    global.stickyNav();
  });