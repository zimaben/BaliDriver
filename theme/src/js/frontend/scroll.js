// Description: Scroll functions

export const removeScrollSVG = (item) => {
    document.removeEventListener('scroll', doScrollSVG );
}
export const scrollSVG = (item) => {
    let svg = item.querySelector('svg');
    if(!svg) return false;
    window.currentScrollItem = item;
    document.addEventListener('scroll', doScrollSVG);
}
const doScrollSVG = () => {

    let item = window.currentScrollItem;
    let parent = item.closest('.rbt-card-section')
    let cards = parent.querySelectorAll('.rbt-card-image > .imgwrap');
    let svg = item.querySelector('svg');
    let path = svg.querySelector('#svg-map-line');

    let elementTop = item.getBoundingClientRect().top;
    let pixels_scrolled_from_item_top = window.scrollY - elementTop;
    let scrollPercent =  Math.min( ((pixels_scrolled_from_item_top) / item.clientHeight), 1);
    let pathLength = path.getTotalLength();
    path.style.strokeDasharray = pathLength;
    path.style.strokeDashoffset = pathLength;
    let drawLength = Math.max(pathLength * scrollPercent, 0);
    path.style.strokeDashoffset = pathLength - drawLength;
    //path.style.strokeDashoffset = drawLength - pathLength;
    switch (cards.length){
        case 0: break;
        case 1: 
            if(scrollPercent > .45){
                cards[0].classList.add('active')
                cards[0].style.backgroundImage = `url(${cards[0].getAttribute('data-image-light')})`;
            } else {
                cards[0].classList.remove('active');
                cards[0].style.backgroundImage = `url(${cards[0].getAttribute('data-image-dark')})`;
            };
            break;
        case 2: 
            if(scrollPercent > .3){
                cards[0].classList.add('active');
                cards[0].style.backgroundImage = `url(${cards[0].getAttribute('data-image-light')})`;

            } else {
                cards[0].classList.remove('active');
                cards[0].style.backgroundImage = `url(${cards[0].getAttribute('data-image-dark')})`;
            }
            if(scrollPercent > .6){
                cards[1].classList.add('active');
                cards[1].style.backgroundImage = `url(${cards[1].getAttribute('data-image-light')})`;
            } else {
                cards[1].classList.remove('active');
                cards[1].style.backgroundImage = `url(${cards[1].getAttribute('data-image-dark')})`;
            }
            break;
        case 3:
            if(scrollPercent > .07){
                cards[0].classList.add('active');
                cards[0].style.backgroundImage = `url(${cards[0].getAttribute('data-image-light')})`;
            } else {
                cards[0].classList.remove('active');
                cards[0].style.backgroundImage = `url(${cards[0].getAttribute('data-image-dark')})`;
            }
            if(scrollPercent > .45){
                cards[1].classList.add('active');
                cards[1].style.backgroundImage = `url(${cards[1].getAttribute('data-image-light')})`;
            } else {
                cards[1].classList.remove('active');
                cards[1].style.backgroundImage = `url(${cards[1].getAttribute('data-image-dark')})`;
            }
            if(scrollPercent > .82){
                cards[2].classList.add('active');
                cards[2].style.backgroundImage = `url(${cards[2].getAttribute('data-image-light')})`;
            } else {
                cards[2].classList.remove('active');
                cards[2].style.backgroundImage = `url(${cards[2].getAttribute('data-image-dark')})`;
            }
            break;
    }
}
export const doScrollReveal = (sr) => {
    let start = sr.scrollTop;
    let ht = sr.offsetHeight;
    if (window.scrollY >= start && window.scrollY <= start + ht ){
      
      const charnum = sr.children.length;
      const px_per = ht / charnum;
      const ths_px = window.scrollY - start;
      const numactive = Math.ceil(ths_px / px_per);
      console.log("windowY", window.scrollY, "scrollTop",sr.scrollTop, "scrollHeight",sr.scrollHeight, px_per, ths_px, numactive);
      Array.from(sr.children).forEach((element, index) => { if(index <= (Math.max(4, numactive)) ){ element.classList.add("active")} else {element.classList.remove("active")} })
    }
}
/*
takes element and function as arguments. If no function is included it will add an "active" class
*/
export const addObserver = (el, options = {} ) => {
    //https://css-tricks.com/scroll-triggered-animation-vanilla-javascript/
    // Check if `IntersectionObserver` is supported
    if(!('IntersectionObserver' in window)) {
        // Simple fallback
        // The animation/callback will be called immediately so
        // the scroll animation doesn't happen on unsupported browsers
        console.log("This browser doesn't support IntersectionObserver");
        if(options.cb){
        options.cb(el)
        } else{
        entry.target.classList.add('active')
        }
        // We don't need to execute the rest of the code
        return
    }
    let observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {

            if(entry.isIntersecting) {
  
                if(options.cb) {
                    console.log("isIntersecting triggered");
                    options.cb(el)
                } else {
                    entry.target.classList.add('active')
                }
                //observer.unobserve(entry.target)
            } 
            //unbind 
            if(!entry.isIntersecting){
                if(options.unbind){
                    console.log("unbinding call");
                    options.unbind(el)
                }
            }
        })
    }, options)
    observer.observe(el)
}