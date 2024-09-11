import './bootstrap';

import FollowAlongMenu from './common/header/followAlongMenu'
import AboutSectionScrollAnimation from './common/sections/aboutSectionScrollAnimation'
import TestimonialSlider from './common/sections/testimonialSlider'

import NiceSelect from './common/utils/niceSelect'
import FormLabel from './common/utils/formLabel'
import LoadingAnimation from './common/utils/loadingAnimation'

// const loadModule = (module) => { import("/resources/js/" + module + ".js").then((clazz) => { (new clazz.default()).boot() }) }
const loadModule = (module) => { new module().boot() }

window.onload = () => {

    loadModule(FollowAlongMenu)
    loadModule(AboutSectionScrollAnimation)
    loadModule(TestimonialSlider)

    loadModule(NiceSelect)
    loadModule(FormLabel)
    loadModule(LoadingAnimation)

    // loadModule("common/header/followAlongMenu")
    // loadModule("common/sections/aboutSectionScrollAnimation")
    // loadModule("common/sections/testimonialSlider")
    //
    // loadModule("common/utils/niceSelect")
    // loadModule("common/utils/formLabel")
    // loadModule("common/utils/loadingAnimation")

}
