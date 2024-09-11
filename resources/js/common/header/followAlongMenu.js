export default class {

    constructor() {
        this.menuButtons = document.querySelectorAll(".header__menu .menu__item")
        this.highlight = document.querySelector(".header__menu .menu__highlight")
        this.offsetWidth = this.menuButtons[0].getBoundingClientRect().left
        this.offsetHeight = this.menuButtons[0].getBoundingClientRect().top
    }

    boot() {

        const defineHighlightPosition = (element, init = false) => {

            const elementPos = element.getBoundingClientRect();
            const highlightPose = {
                width: elementPos.width, height: elementPos.height,
                top: Math.round(elementPos.top - this.offsetHeight + 7),
                left: Math.round(elementPos.left - this.offsetWidth + 5),
            }

            this.highlight.style.width = `${highlightPose.width}px`;
            this.highlight.style.height = `${highlightPose.height}px`;
            this.highlight.style.transform = `translate(${highlightPose.left}px, ${highlightPose.top}px)`;
            if (init) {
                setTimeout(() => {
                    this.highlight.style.transition = '.5s cubic-bezier(.8, .5, .2, 1.4)'
                }, 100)
            }

        }

        // register click listeners
        this.menuButtons.forEach((button) => {
            button.addEventListener("click", (e) => {
                defineHighlightPosition(e.currentTarget)
            })
        })

        // set highlight on the first element
        defineHighlightPosition(this.menuButtons[0], true)

    }

}
