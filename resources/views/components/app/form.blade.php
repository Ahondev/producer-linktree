<app-form
    x-data="FormController('{{ $name }}')"
    x-ref="formElement"
    x-init="$nextTick(() => {
        const controller = FormManager.resolve('{{ $name }}')
        controller.$refs = $refs
        $refs.formElement.removeAttribute('x-data')
        $refs.formElement.removeAttribute('x-ref')
        $refs.formElement.removeAttribute('x-init')
     })"
>
    @include("app.forms.$name", $data)
</app-form>
