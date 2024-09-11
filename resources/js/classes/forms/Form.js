import { z } from "zod";
import { extend } from "@/lib/utils";

export class Form {

    constructor(formElement, params) { this.formElement = formElement; this.updateFormParams(params) }

    updateFormParams(params) {

        this.params = params

        this.fields = Object.keys(params["fields"])

        this.schema = z.object(
            Object.entries(this.fields).reduce(
                (acc, [key, value]) => ({ ...acc, [value]: params["fields"][value] }), {}
            )
        )

        this.data = extend(
            Object.entries(this.fields).reduce(
                (acc, [key, value]) => ({...acc, [value]: ""}), {}
            ),
            Object.keys(params).includes("data") ? params["data"] : { }
        )

    }

    serializeForAlpine() { return () => {
        return Object.fromEntries(Object.entries(this));
    } }

    serializeData() {
        return Object.entries(this.data).reduce(
            (acc, [key, value]) => (
                this.fields.includes(key) ?
                    { ...acc, [key]: this.data[key] } : { ...acc, [key]: value }
            ), {}
        )
    }

    resetErrors() {
        const errorElements = this.formElement.querySelectorAll("error")
        if(errorElements.length === 0) { return }
        errorElements.forEach((errorElement) => {
            errorElement.innerText = ""
            if(errorElement.hasAttribute("show")){
                errorElement.removeAttribute("show", "")
            }
        })
    }

    showError(name, message) {
        const errorElement = this.formElement.querySelector(`error[name='${name}']`)
        errorElement.innerText = message
        errorElement.setAttribute("show", "")
    }

    showMessage(name) {
        const errorElement = this.formElement.querySelector(`message[name='${name}']`)
        errorElement.setAttribute("show", "")
        // errorElement.removeAttribute("hide", "")
    }

    resetMessages() {
        const messagesElement = this.formElement.querySelectorAll("message")

        messagesElement[0].parentNode.setAttribute(
            "show",
            messagesElement.length === 0 ? "false" : "true"
        )

        if(messagesElement.length === 0) { return }
        messagesElement.forEach((messageElement) => {
            if(messageElement.hasAttribute("show")){
                messageElement.removeAttribute("show", "")
                // messageElement.setAttribute("hide", "")
            }
        })

    }

    validateData() {

        this.resetErrors()

        const response = this.schema.safeParse(this.serializeData())
        if(response.success){ return true }

        response.error.issues.forEach((issue) => {
            this.showError(issue.path[0], issue.message)
        })

    }

    updateRef(ref, value) {
        this.dispatchUpdate(this.$refs[ref], { detail: value })
    }

    dispatchUpdate(el = this.formElement, data = {}) {
        console.log("dispatchUpdate : ", data)
        el.dispatchEvent(
            new CustomEvent('update', { detail: data })
        )
    }

}
