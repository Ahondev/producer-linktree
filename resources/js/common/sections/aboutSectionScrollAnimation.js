export default class {

    constructor() {
        this.section = document.querySelector("section#about")
        this.triggers = this.section.querySelectorAll(".trigger")
        this.box = this.section.querySelector(".icon-box")
        this.stepContents = this.section.querySelectorAll(".steps-container .step-content")

        this.controller = new ScrollMagic.Controller()

        this.currentStep = 1
    }

    boot() {
        this.initializeBox()
        // this.initializeSteps()
        this.initializeClassChangeObserver()
    }

    initializeBox() {

        let trigger = this.section.querySelector(".trigger-1")

        // handle box vertical scrolling
        const scene = new ScrollMagic.Scene({triggerElement: trigger, duration: (800 * this.triggers.length) - 100})
            .setPin(this.box, {pushFollowers: false})
            // .addIndicators()
            .addTo(this.controller)

        scene.on("end", () => {
            this.currentStep = 5
            this.section.setAttribute("step", '5')
            this.box.classList.toggle("step-5")
            this.onStepChange(5)
        })

        // handle box class changes (icon changes)
        let currentStep = 1

        this.triggers.forEach((trigger) => {
            // let trigger = this.section.querySelector(`.trigger-${currentStep}`)
            // let trigger = this.section.querySelector(`.trigger-${currentStep}`)
            const scene = new ScrollMagic.Scene({triggerElement: trigger, duration: 700})
                .setClassToggle(this.box, `step-${currentStep}`)
                // .addIndicators()
                .addTo(this.controller)
            currentStep = currentStep + 1
        })

    }

    // initializeSteps() {
    //
    //     let currentStep = 1
    //
    //     this.triggers.forEach((trigger) => {
    //         let trigger = this.section.querySelector(`.trigger-${currentStep}`)
    //         const scene = new ScrollMagic.Scene({triggerElement: trigger, duration: 400})
    //             .setPin(step, {pushFollowers: false})
    //             // .addIndicators()
    //             .addTo(this.controller)
    //         currentStep = currentStep + 1
    //     })
    //
    // }

    initializeClassChangeObserver() {

        const options = { attributes: true }

        const handleClassChange = (mutation) => {
            const newClasses = mutation.target.className.split(" ")
            try { // normal case
                const step = (newClasses.filter((value) => value.includes("step-"))[0]).split("-")[1]
                this.section.setAttribute("step", step)
                this.currentStep = step
                this.onStepChange(step)
            } catch (e) { // case when no steps
                this.currentStep = 0
                this.section.setAttribute("step", '0')
                this.onStepChange(0)
            }
        }

        const observer = new MutationObserver((mutationList, observer) => {
            mutationList.forEach((mutation) => {
                if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                    handleClassChange(mutation)
                }
            })
        })

        observer.observe(this.box, options)

    }

    onStepChange(newStep) {
        this.stepContents.forEach((content) => {

            if(content.className.includes("active")) {
                content.style.opacity = '0';
                setTimeout(() => {
                    content.classList.remove("active")
                }, 300)
            }

            setTimeout(() => {
                if(content.className.includes(`step-content-${this.currentStep}`)) {
                    content.style.opacity = '1';
                    content.classList.add("active")
                }
            }, 300)

        })
    }

}
