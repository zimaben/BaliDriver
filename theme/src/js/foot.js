import * as global from './frontend/global.js';

window.addEventListener('DOMContentLoaded', (event) => {
    
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