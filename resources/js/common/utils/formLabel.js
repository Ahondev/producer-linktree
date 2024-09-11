export default class {

    formTypes = ["text"]

    constructor() {
        this.fields = document.querySelectorAll("form .field")
    }

    boot() {
        if(this.fields.length === 0) { return }
        this.fields.forEach((field) => {

            const isIncluded = () => {
                return (this.formTypes.filter(
                    (formType) => (field.className.includes(formType))
                )).length !== 0
            }

            if(!isIncluded()) { return }

            const label = field.querySelector("label")
            const inputID = label.getAttribute("for")
            const inputElement = field.querySelector(`#${inputID}`)

            inputElement.addEventListener("keyup", (e) => this.onChange(e, label))
            inputElement.addEventListener("keydown", (e) => this.onChange(e, label))

        })
    }

    onChange(e, label) {
        if(e.target.value.length !== 0) { label.classList.add("hidden") }
        else { label.classList.remove("hidden") }
    }

}
