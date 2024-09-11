export default class {

    swiperParams = () => { return {
        injectStyles: [
            ':host ::slotted(swiper-slide) { height: fit-content; }',
            ':host .swiper-wrapper { height: fit-content; }',
            ':host .swiper { height: fit-content; }',
        ],
    }};

    constructor() {
        this.section = document.querySelector("section#testimonials")
        this.swiperElement = this.section.querySelector("swiper-container")
        this.initialize()
        this.swiperInstance = this.swiperElement.swiper
        this.buttons = this.section.querySelectorAll("div.slider-control")
    }

    initialize() {
        Object.assign(this.swiperElement, this.swiperParams());
        this.swiperElement.initialize();
    }

    boot() {
        this.initialize()
        this.buttons.forEach((button) => {
            button.addEventListener("click", () => {
                const action = button.getAttribute("action")
                if(action === "next") { this.swiperInstance.slideNext() }
                if(action === "prev") { this.swiperInstance.slidePrev() }
            })
        })
    }

}
