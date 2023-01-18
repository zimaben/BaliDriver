import {test_figma, run_first_setup, run_critical_css, test_figma_item, get_figma_item } from './admin/adminhead.js';

document.addEventListener('DOMContentLoaded', () => {
    const setupbutton = document.getElementById('setupbutton');
    if(setupbutton){ setupbutton.addEventListener('click', run_first_setup); }
    const criticalcssbutton = document.getElementById('criticalcssbutton');
    if(criticalcssbutton){ criticalcssbutton.addEventListener('click', run_critical_css); }
    const testfigmabutton = document.getElementById('figmatest');
    if(testfigmabutton){ testfigmabutton.addEventListener('click', test_figma ); }
    const testfigmaitembutton = document.getElementById('figmatestitem');
    if(testfigmaitembutton){ 
        console.log("found button");testfigmaitembutton.addEventListener('click', test_figma_item ); 
    }
    const figmagetitembutton = document.getElementById('figmagetitem');
    if(figmagetitembutton){ 
        figmagetitembutton.addEventListener('click', get_figma_item ); 
    }
    const syncmapbutton = document.getElementById('gmap_sync');
    if(syncmapbutton) syncmapbutton.addEventListener('click', gmap_sync);
})