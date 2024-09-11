import {type ClassValue, clsx} from 'clsx'
import {twMerge} from 'tailwind-merge'
import {type Ref} from 'vue'

import type {Updater} from '@tanstack/vue-table'

export function cn(...inputs: ClassValue[]) {
  return twMerge(clsx(inputs))
}

export function valueUpdater<T extends Updater<any>>(updaterOrValue: T, ref: Ref) {
  ref.value
      = typeof updaterOrValue === 'function'
      ? updaterOrValue(ref.value)
      : updaterOrValue
}

export const request = async (httpMethod: any, url: string, data = false) => {

    try {

    const token = localStorage.getItem('auth_token')
    const headers = {
      'X-CSRF-TOKEN': csrf(),
      'Access-Control-Allow-Origin': domain(),
      'Access-Control-Allow-Headers': 'X-CSRF-TOKEN, X-Requested-With',
      'Authorization': `Bearer ${token}`
    }

    if(data){ return await httpMethod(url, data, {headers: headers}) }
    else { return await httpMethod(url, { }, {headers: headers}) }

  }
  catch (err) { return err.response }
}

export const asFormData = (data: Object, parentKey = '') => {
    const formData = new FormData();

    const appendFormData = (key: string, value: any) => {
        if (value instanceof File || value instanceof Blob) {
            formData.append(key, value);
        } else if (Array.isArray(value)) {
            value.forEach((item, index) => {
                appendFormData(`${key}[${index}]`, item);
            });
        } else if (typeof value === 'object' && value !== null) {
            Object.entries(value).forEach(([nestedKey, nestedValue]) => {
                appendFormData(`${key}[${nestedKey}]`, nestedValue);
            });
        } else {
            if (value === null) return;
            formData.append(key, value);
        }
    };

    Object.entries(data).forEach(([key, value]) => {
        appendFormData(parentKey ? `${parentKey}[${key}]` : key, value);
    });

    return formData;
};

export const asArray = (data: Object) => {
    const finalArray = []
    Object.keys(data).forEach((key) => {
        console.log(key)
        finalArray.push(data[key]);
    });
    return finalArray
}

export const csrf = () => {
  const metaTag = <HTMLMetaElement> document.querySelector("meta[name='csrf']")
  return metaTag.content
}

const domain = () => {
  let metaTag = <HTMLMetaElement> document.querySelector("meta[name='domain']");
  return metaTag.content
}

const appURL = () => {
  return "https://" + domain() + "/"
}

export const api = (uri: string) => {
  return "https://" + domain() + "/api/" + uri
}
export const redirect = (url: string) => { window.location.href = url }

export const extend = (obj: Array, src: Array) => {
  Object.keys(src).forEach(function(key) { obj[key] = src[key]; });
  return obj;
}

export const sleep = (ms: number) => {
    return new Promise(resolve => setTimeout(resolve, ms));
}

export const copyNode = (selector: string) => {
    const node = document.querySelector(selector)
    return node.cloneNode(true)
}

export const uuid = () => { return crypto.randomUUID().split("-")[0] }
