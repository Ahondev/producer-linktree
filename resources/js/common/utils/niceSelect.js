export default class {

    constructor() {
        this.selects = document.querySelectorAll("select")
    }

    boot() {
        if(this.selects.length === 0) { return }
        this.selects.forEach((select) => {
            new NiceSelect(select)
            const elementToObserve = select.parentNode.querySelector(".nice-select .current")
            const observer = new MutationObserver(function(mutationsList, observer) {
                elementToObserve.classList.add("selected")
            });
            observer.observe(elementToObserve, {characterData: false, childList: true, attributes: false});
        })
    }

}
