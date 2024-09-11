import { Form } from "../../classes/forms/Form.js";
import { z } from "zod";
import { api, copyNode, request, sleep } from "@/lib/utils";
import { invalid_type_error, required_error } from "../../config/forms.js";

export class ContactForm extends Form {

    constructor(formElement) {
        super(formElement, {
            fields: {

                name: z.string({ invalid_type_error, required_error })
                    .min(1, required_error)
                    .max(50),

                email: z.string({ invalid_type_error, required_error })
                    .email()
                    .min(1, required_error)
                    .max(50),

                company: z.string({ invalid_type_error, required_error })
                    .min(1, required_error)
                    .max(100),

                subject: z.enum(JSON.parse(formElement.subject_values.value), {
                    errorMap: (issue, _ctx) => {
                        return { message: "Please select a subject" }
                    }
                }),

                message: z.string({ invalid_type_error, required_error })
                    .min(1, required_error)
                    .max(500)

            },
            // data: { state: "default" }
        });
    }

    submit = async () => {

        if(!this.validateData()) { return; }

        this.resetMessages()
        this.updateState(State.LOADING)
        const response = await request(axios.post, api("contact"), this.serializeData())
        this.updateState(State.DEFAULT)

        if(response.status === 200) {
            this.showMessage("success")
            Toastify({
                node: copyNode(".submit-message-success"),
                duration: 5000,
                className: "success",
                gravity: "bottom"
            }).showToast();
        } else {
            this.showMessage("error")
            Toastify({
                node: copyNode(".submit-message-error"),
                duration: 8000,
                className: "success",
                gravity: "bottom"
            }).showToast();
        }

    }

    updateState(state) {
        if(state === State.LOADING) { $loading(state) }
        if(state === State.DEFAULT) { $loading("finished") }
        this.$refs.button.setAttribute("state", state)
    }

}

class State {
    static DEFAULT = "default"
    static LOADING = "loading"
}
