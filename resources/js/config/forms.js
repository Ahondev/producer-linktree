import { ContactForm } from "../common/forms/contactForm.js";

export const forms = () => {
    return {
        "get-in-touch": ContactForm
    }
}

export const invalid_type_error = "Invalid type provided for this field"
export const required_error = "This field cannot be empty"
