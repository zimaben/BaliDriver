import { addObserver } from './global.js';
export const setScrollReveal = (item) => {
    
    let sr_arr = item.innerText.split('');
    item.innerHTML = '';
    sr_arr.map( char => {
        let spn = document.createElement('SPAN');
        spn.classList.add("scrollRevealChar")
        spn.innerText = char;
        if(item.children.length < 4){
            spn.classList.add("active");
        }
        item.appendChild(spn);
    });
    addObserver(item, doScrollReveal(item)); 
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