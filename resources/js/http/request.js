export const request = async (httpMethod, url, data = false) => {
    try {
        if(data){ return await httpMethod(url, data) }
        else { return await httpMethod(url) }
    }
    catch (err) { return err.response }
}

export const csrf = () => { return document.querySelector("meta[name='csrf']").content }

export const redirect = (url) => { window.location.href = url }
