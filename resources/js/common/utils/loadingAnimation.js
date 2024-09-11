export default class {

    constructor() {
        this.appLoading = document.querySelector("app-loading")
        this.state = State.DEFAULT
        this.currentWidth = 0
        this.lastWidthAdded = 0
    }

    boot() { window.$loading = this.set; }

    set = (state) => {

        if([State.DEFAULT, State.LOADING, State.FINISHED].includes(state)) { this.state = state }
        else { console.error("Wrong loading state"); return }

        if(state === State.DEFAULT)  {
            this.setWidth(0);
            this.lastWidthAdded = 0
        }

        if(state === State.LOADING)  {

            this.setWidth(30)

            const interval = setInterval(() => {
                if(this.state === State.FINISHED) { clearInterval(interval); return; }
                this.lastWidthAdded = this.lastWidthAdded === 0 ? 25 : this.lastWidthAdded / 2
                this.setWidth(this.currentWidth + this.lastWidthAdded)
            }, 100)

        }

        if(state === State.FINISHED) {
            this.setWidth(100)
            setTimeout(() => { this.set(State.DEFAULT) }, 1000)
        }

    }

    setWidth(widthPercent) {
        this.currentWidth = widthPercent
        this.appLoading.style.width = `${widthPercent}%`
    }

}

class State {
    static DEFAULT = "default"
    static LOADING = "loading"
    static FINISHED = "finished"
}
