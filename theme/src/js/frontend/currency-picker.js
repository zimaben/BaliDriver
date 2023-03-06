export const doCurrencyPicker = (elem) => {
    elem.addEventListener('click', (e) => { currencyPickerClick(e); });
    let currencyList = elem.querySelector('.currency-list');
    let listitems = currencyList ? currencyList.querySelectorAll('li') : false;
    if (listitems) {
        Array.from(listitems).forEach( (item) => {
            item.addEventListener('click', (e) => { currencyClick(e) });
        })
    }
}
const currencyClick = (e) => {
    let currencies = [];
    let listitem = e.target.closest('li[data-currency-list]');
    if(!listitem) return false;
    let list = listitem.closest('UL');
    if(list) Array.from(list.children).forEach( (item) => { if(item.hasAttribute('data-currency-list')) currencies.push(item.dataset.currencyList.toLowerCase() ) });
    let thiscurrency = listitem.dataset.currencyList;
    let multiplier = listitem.dataset.currencyMultiplier;
    let showpriceitems = document.querySelectorAll('.showprice');
    /* update DOM */
    for(let item of showpriceitems){
        let currentprice = item.dataset.defaultPrice ? item.dataset.defaultPrice : item.innerText;
        currencies.forEach( (currency) => {item.classList.remove(currency)})
        item.classList.add(thiscurrency.toLowerCase() );
        let newprice = Math.ceil( parseInt(currentprice) * parseFloat(multiplier) );
        item.innerHTML = newprice;
    }
    /* update picker label */
    let picker = listitem.closest('.currency-picker');
    let label = picker.querySelector('.currency-label .innertext');
    if(label) label.innerText = thiscurrency;
}

const currencyPickerClick = (e) => {
    let picker = e.target.classList.contains('currency-picker') ? e.target : e.target.closest('.currency-picker');
    if(!picker) return false;
    e.stopPropagation();
    let list = picker.querySelector('.currency-list');
    if(picker.classList.contains('active')){
        // close the picker
        picker.classList.remove('active', 'dismissable');
        list.classList.remove('active', 'dismissable');
        list.style.maxHeight = null;
    } else {
        picker.classList.add('active','dismissable');
        list.classList.add('active', 'dismissable');
        list.style.maxHeight = list.scrollHeight + "px";

    }
};