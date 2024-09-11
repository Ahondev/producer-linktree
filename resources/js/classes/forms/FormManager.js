export class FormManager {

    static __INSTANCE__ = null
    controllerInstances = {}
    static instance() { return FormManager.__INSTANCE__ }

    constructor(forms) { this.forms = forms }
    controller(form) { return this.forms[form] }
    resolve(controller) { return this.controllerInstances[controller] }
    registerInstance(controller, instance) { this.controllerInstances[controller] = instance }

}
