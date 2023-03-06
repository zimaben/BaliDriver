import flatpickr from "flatpickr";

export const setUpCarousel = (elem) =>{
    let slides = elem.querySelectorAll('.rbt-carousel-slide');
    let indicators = elem.querySelector('.rbt-indicators');
    if(slides) slides[0].classList.add('active');
    if(indicators) indicators.children[0].classList.add('active');
    let ctrlLeft = elem.querySelectorAll('.rbt-carousel-control.left')[0];
    let ctrlRight = elem.querySelectorAll('.rbt-carousel-control.right')[0];

    if(ctrlLeft) ctrlLeft.addEventListener('click', (e) => { ArrowLeft(e)});
    if(ctrlRight) ctrlRight.addEventListener('click', (e) => { ArrowRight(e)});
    for(let indicator of indicators.children){indicator.addEventListener('click', (e)=> IndicatorClick(e))};
}

const ArrowLeft = (e) => {
    let parent = e.target.closest('.wp-block-rbt-carousel-slider');
    let indicators = parent.querySelector('.rbt-indicators');
    let slides = parent.querySelectorAll('.rbt-carousel-slide');
    let active = 0;
    for(let indicator of indicators.children){
        if(indicator.classList.contains('active')){
            indicator.classList.remove('active');
            break;
        } else {
            active++;
        }
        
    }
    slides[active].classList.remove('active');
    let newactive = (active === 0) ? indicators.children.length - 1 : active - 1;
    slides[newactive].classList.add('active');
    indicators.children[newactive].classList.add('active');
    
}
const ArrowRight = (e) => {
    let parent = e.target.closest('.wp-block-rbt-carousel-slider');
    let indicators = parent.querySelector('.rbt-indicators');
    let slides = parent.querySelectorAll('.rbt-carousel-slide');
    let active = 0;
    for(let indicator of indicators.children){
        if(indicator.classList.contains('active')){
            indicator.classList.remove('active');
            break;
        } else {
            active++;
        }
    }
    slides[active].classList.remove('active');
    let newactive = ( active === indicators.children.length - 1 ) ? 0 : active + 1;
    slides[newactive].classList.add('active');
    indicators.children[newactive].classList.add('active');
}
const IndicatorClick = (e) => {
    let parent = e.target.closest('.wp-block-rbt-carousel-slider');
    let indicator = e.target.classList.contains('rbt-indicator') ? e.target : e.target.closest('.rbt-indicator');
    let indicators = parent.querySelector('.rbt-indicators');
    let slides = parent.querySelectorAll('.rbt-carousel-slide');
    Array.from(slides).forEach(slide => { slide.classList.remove('active')});
    for(let i=0;i<indicators.children.length;i++){
        if(indicators.children[i] === indicator){
            indicators.children[i].classList.add("active");
            slides[i].classList.add('active');  
        } else {
            indicators.children[i].classList.remove("active");
        }
    }
}
const doIconClick = (e) => {
    let group = e.target.closest('.switchgroup.icons');
    let form = group.closest('form.rbt-form');
    let theswitch = e.target.classList.contains('iconswitch') ? e.target : e.target.closest('.iconswitch');
    if(!theswitch || !group || !form) return false;
    let switches = group.querySelectorAll('.iconswitch');
    let value = theswitch.dataset.switchValue === "true" ? true : false;
    for(let s of switches) {
        if(s === theswitch){
            s.classList.add("active");
            let inp = form.querySelector('[name="'+s.dataset.switch+'"]');
            /* to fire an event, which is what we need, we will need to click the switch */
            if(inp.checked !== value) inp.click();

        } else {
            s.classList.remove("active");
        }
    }
}
export const doBookingFormInit = (elem) => {
    let datepicker = elem.querySelector("#pickupdate");
    let dp_init = datepicker ? flatpickr(datepicker, 
        {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
        }
    ) : false;
    let service_type = elem.querySelector('[name="is_airport"]');
    if(service_type) service_type.addEventListener('change', (e)=>{doServiceChange(e)});
    let fromto = elem.querySelector('[name="from_to"]');
    if(fromto) fromto.addEventListener('change', (e)=>{doFromTo(e)});
    let icon_controls = elem.querySelectorAll('.iconswitch');
    if(icon_controls){
        for(let ctrl of icon_controls) ctrl.addEventListener('click', (e)=>{doIconClick(e)});
    }
}
const doFromTo = (e) => {
    let is_from = e.target.checked;
    let section = e.target.closest('section.form-section');
    let labels = section.querySelectorAll('label[data-show-on]');
    switch(is_from){
        case true:
            for (let label of labels){
                if (label.dataset.showOn === "1"){
                    label.classList.add("active");
                } else {
                    label.classList.remove("active");
                }
            }
        break;
        case false:
            for (let label of labels){
                if (label.dataset.showOn === "0"){
                    label.classList.add("active");
                } else {
                    label.classList.remove("active");
                }
            }
        break;
        default:break;
    }
}
const doServiceChange = (e) => {
    /*
    
    let indicator = e.target.classList.contains('rbt-indicator') ? e.target : e.target.closest('.rbt-indicator');
    let indicators = parent.querySelector('.rbt-indicators');
    */
    let slider = e.target.closest('.wp-block-rbt-carousel-slider');
    let slides = slider ? slider.querySelectorAll('.rbt-carousel-slide') : false;
    let is_airport = e.target.checked;
    let form = e.target.closest('form.rbt-form');
    let sections = form.querySelectorAll('section[data-show-on]');
    let labels = form.querySelectorAll('label[data-show-on]');
    switch(is_airport) {
        case true:
            /* right */
            for(let section of sections){
                if(section.dataset.showOn === "1" ){
                    section.classList.add("active");
                } else {
                    section.classList.remove("active");
                }
            }
            for (let label of labels){
                if (label.dataset.showOn === "1"){
                    //only toggle labels outside form sections
                    if(!label.classList.contains('section')) label.classList.add("active");
                } else {
                    //only toggle labels outside form sections
                    if(!label.classList.contains('section')) label.classList.remove("active");
                }
            }
            if(slides){
                slides[1].classList.remove("active");
                slides[0].classList.add("active");
            }
        break;
        case false:
            /* left */
            for(let section of sections){
                if(section.dataset.showOn === "0" ){
                    section.classList.add("active");
                } else {
                    section.classList.remove("active");
                }
            }
            for (let label of labels){
                if (label.dataset.showOn === "0"){
                    //only toggle labels outside form sections
                    if(!label.classList.contains('section')) label.classList.add("active");
                } else {
                    //only toggle labels outside form sections
                    if(!label.classList.contains('section')) label.classList.remove("active");
                }
            }
            if(slides){
                slides[0].classList.remove("active");
                slides[1].classList.add("active");
            }
        break;
        default: break;
    }
}