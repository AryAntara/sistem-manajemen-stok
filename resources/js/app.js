import axios from 'axios'
import './bootstrap'
import { KaryawanModal } from "./pages/karyawan"
// Alpine JS setup

import Alpine from 'alpinejs'

document.addEventListener('DOMContentLoaded', function () {
    window.Alpine = Alpine
    Alpine.start()
    Alpine.data('karyawan_modal', () => KaryawanModal)

    // loader
    setTimeout(() => document.getElementById("loader").style.display = "none", 900)

    // image processor
    Alpine.store('image', {
        showImage,
    })

    // form processor
    Alpine.store('form', {
        sendPost,
    })


})

/**
 * @var {array} - List of form error custom method 
 */
const customFormErrorMaps = {}

/**
 * Show image when input file changed
 *  
 * @param {number || null} id - id of image wrapper
 * @return {void}
 */
function showImage(id = null) {
    const idProfileWrapper = id ? `photo-profile-wrapper-${id}` : 'photo-profile-wrapper'
        , idImageWrapper = id ? `image-wrapper-${id}` : 'image-wrapper'
        , idPhotoProfile = id ? `photo-profile-${id}` : 'photo-profile'
        , image = document.getElementById(idPhotoProfile).files[0]
        , imagePath = URL.createObjectURL(image)
        , imageWrapper = document.getElementById(idProfileWrapper)

    console.log(idPhotoProfile, idImageWrapper);
    // remove the shadow
    document.getElementsByClassName(idImageWrapper)[0].classList = `${idImageWrapper} absolute w-full h-full flex items-center justify-center top-0 border-4 border-dashed rounded-full`
    imageWrapper.src = imagePath
}


/**
 * Send post into backend and process the data
 * 
 * @param {string} selector
 */
async function sendPost(selector) {
    const form = document.querySelector(selector)
        , url = form.getAttribute('action')
        , formData = new FormData(form)
        , fields = Array.from(form.querySelectorAll('input, select')).map(item => item.getAttribute("name"))

    try {
        await axios.post(url, formData)
        location.reload()
    } catch (err) {
        const res = err.response
            , errData = res.data

        mapFormError(errData.errors, fields, selector)
    }
}


/**
 * Mapping error response from a request and display it into the form
 * 
 * @param {array} errors
 * @param {array} fields - all field, fields have no error, it should be removed their old error
 * @param {string} formSelector
 * 
 * @return {void}
 */
function mapFormError(errors, fields, formSelector = 'form') {

    // parsing id 
    let id = formSelector.split('-');
    id = id[id.length - 1];    

    fields.forEach((fieldName) => {
        document.querySelector(`.message-error-${fieldName}`)?.remove()        
        if (!Object.keys(errors).find(item => item === fieldName)) {
            return
        }

        // using the special function first if there to map the error
        if (customFormErrorMaps[fieldName]) {
            customFormErrorMaps[fieldName](errors[fieldName], fieldName, id, selector)
            return
        }

        const errorMessageNode = document.createElement("p")
        errorMessageNode.classList = `text-red-500 message-error-${fieldName} font-bold mt-2`
        errorMessageNode.innerText = errors[fieldName][0]
        
        const input = document.querySelector(`${formSelector} [name=${fieldName}]`)
        if (input) {
            const inputParent = input.parentNode
            inputParent.appendChild(errorMessageNode)
        }
    })
}

/**
 * Custom error message map for photo profile
 * 
 * @param {string} errorMessage
 * @param {string} fieldName
 * @param {number} id - additional data
 * 
 * @return {void}
 */
function mapErrorMessageOfPhotoProfile(errorMessage, fieldName, id = null) {
    const idImageWrapper = id ? `#photo-profile-wrapper-${id}` : '#photo-profile-wrapper'
        , imageWrapper = document.querySelector(idImageWrapper)
        , imageWrapperParentNode = imageWrapper.parentNode

    // change color to red
    removeAndAddClass(imageWrapperParentNode, ["bg-gray-700"], ["bg-red-400"])

    imageWrapperParentNode.parentNode.querySelector("p").innerText = errorMessage
}

customFormErrorMaps['profile_photo'] = mapErrorMessageOfPhotoProfile


/**
 * Html Extra function to help works with html element
 */

/**
 * 
 * Remove one class into an element
 * 
 * @param {Element} element 
 * @param {string} className 
 */
function removeClass(element, className) {
    let classList = element.classList.value
        , classListArray = classList.split(" ")

    if (classListArray.includes(className)) {
        const classNameIndex = classListArray.indexOf(className)
        classListArray = [...classListArray.slice(0, classNameIndex - 1), ...classListArray.slice(classListArray)]
    }

    element.classList = classListArray.join(" ")
}

/**
 * 
 * Add one class into element
 * 
 * @param {Element} element 
 * @param {string} className 
 */
function addClass(element, className) {
    let classList = element.classList.value
        , classListArray = classList.split(" ")

    if (!classListArray.includes(className)) {
        classListArray.push(className)
    }

    element.classList = classListArray.join(" ")
}

/**
 * Remove and add new class into an element
 * 
 * @param {Element} element
 * @param {array} removedClasses
 * @param {array} addedClasses 
 * 
 */
function removeAndAddClass(element, removedClasses, addedClasses) {

    // remove class
    for (const removedClass of removedClasses) {
        removeClass(element, removedClass)
    }

    // add class
    for (const addedClass of addedClasses) {
        addClass(element, addedClass)
    }
}