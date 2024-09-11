<form id="get-in-touch" @submit.prevent="submit()">

    <div class="form-messages" show="false">

        <message name="success" class="message flex align-center justify-start gap-2">
            @icon("checkmark.svg")
            <p>Your form has been sent successfully, we will get in touch back soon!</p>
        </message>

        <message name="error" class="message flex align-center justify-start gap-2">
            @icon("checkmark.svg")
            <p>Your form has not been sent!</p>
        </message>

    </div>

    <div class="form-fields">

        @csrf()

        <div class="field text field-1">
            <div class="field-wrapper">
                <label for="name">Full name</label>
                <input type="text" name="name" id="name" x-model="data.name">
            </div>
            <error name="name"></error>
        </div>

        <div class="field text field-2">
            <div class="field-wrapper">
                <label for="email">Your email</label>
                <input type="text" name="email" id="email" x-model="data.email">
            </div>
            <error name="email"></error>
        </div>

        <div class="field text field-3">
            <div class="field-wrapper">
                <label for="company">Your company</label>
                <input type="text" name="company" id="company" x-model="data.company">
            </div>
            <error name="company"></error>
        </div>

        <div class="field select field-4" style="z-index: 2;">
            <div class="field-wrapper">
                <label for="subject">Subject</label>
                <input hidden disabled id="subject_values" value="{{ json_encode($data["contact"]["subjects"]) }}">
                <select name="subject" id="subject" x-model="data.subject">
                    <option data-display="Select">Subject</option>
                    @foreach($data["contact"]["subjects"] as $subject)
                        <option value="{{ $subject }}">{{ $subject }}</option>
                    @endforeach
                </select>
            </div>
            <error name="subject"></error>
        </div>

        <div class="field text field-5">
            <div class="field-wrapper">
                <label for="message">Please drop a few words detailing your inquiry</label>
                <textarea name="message" id="message" x-model="data.message"></textarea>
            </div>
            <error name="message"></error>
        </div>

    </div>

    <div class="form-submit">
        <button class="btn btn-primary" type="submit" x-ref="button" state="default">
            Contact me
        </button>
    </div>

    <div class="form-toasts" x-show="false">
        <div class="submit-message-success">
            <strong>Thank you for getting in touch!</strong> <br>
            I appreciate you contacting me, and will get back in touch with you soon!
        </div>
        <div class="submit-message-error">
            <strong>Oops something went wrong!</strong> <br>
            I apologize but there was an error from my side submitting the form <br>
            Please try again later, i'm probably already working on the problem!
        </div>
    </div>

</form>
