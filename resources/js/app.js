import axios from 'axios'
import './bootstrap'
import Staff from "./pages/staff"
import Product from './pages/product'
import Alpine from 'alpinejs'
import html from './html'

document.addEventListener('DOMContentLoaded', function () {
    window.Alpine = Alpine
    Alpine.start()

    // loader
    setTimeout(() => html.toggleLoader(true), 900)

    // profile processor
    Alpine.store('profile', {
        showImage,
    })

    // product processor
    Alpine.store('product', {
        showImage: Product.showProductImage
    })

    // form processor
    Alpine.store('form', {
        sendPost: sendPostFromForm,
    })


    // universal axios method
    Alpine.store('axios', {
        sendPost: sendPost
    })

})

/**
 * @var {object} - List of form error custom method, selector must be [name]-[parent selector]
 */
const customFormErrorMaps = {
    'profile_photo-form#staff-create' : Staff.mapErrorMessageOfPhotoProfile,
    'profile_photo-form#staff-edit' : Staff.mapErrorMessageOfPhotoProfile,

    'name-#product-create' : Product.mapErrorMessageOfInputText,
    'code-#product-create' : Product.mapErrorMessageOfInputText,
    'category-#product-create' : Product.mapErrorMessageOfInputText,
    'price-#product-create' : Product.mapErrorMessageOfInputText
}


/**
 * Show image when input file changed for photo profile
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

    // remove the shadow
    document.getElementsByClassName(idImageWrapper)[0].classList = `${idImageWrapper} absolute w-full h-full flex items-center justify-center top-0 border-4 border-dashed rounded-full`
    imageWrapper.src = imagePath
}


/**
 * Send post into backend and process the data
 *
 * @param {string} selector
 */
async function sendPostFromForm(selector) {

    // enable loader
    html.toggleLoader(false)

    const form = document.querySelector(selector)
        , url = form.getAttribute('action')
        , formData = new FormData(form)
        , fields = Array.from(form.querySelectorAll('input, select, textarea')).map(item => item.getAttribute("name"))

    try {
        await axios.post(url, formData)
        location.reload()
    } catch (err) {
        // rmeove loader
        html.toggleLoader(true)

        const res = err.response
            , errData = res.data

        if (err.response.status == 422) {
            mapFormError(errData.errors, fields, selector)
        } else {
            console.error(err);
        }
    }
}

/**
 * Send post into backend and process the data
 *
 * @param {string} url
 * @param {string} selector
 */
async function sendPost(url, selector) {

    // show loader
    html.toggleLoader(false)
    const formWrapper = document.querySelector(selector)
        , fieldElements = Array.from(formWrapper.querySelectorAll('input, select, textarea'))
        , fields = fieldElements.map(item => item.getAttribute("name"))

    const formData = new FormData();

    for (const element of fieldElements) {
        let name = element.getAttribute('name')
            , value = element.value
            , isFile = element.getAttribute('type') === 'file'
        if (isFile) value = element.files[0]
        formData.append(name, value);
    }

    try {
        await axios.post(url, formData)
        location.reload()
    } catch (err) {

        // remove loader
        html.toggleLoader(true);

        const res = err.response
            , errData = res.data

        if (err.response.status == 422) {
            mapFormError(errData.errors, fields, selector)
        } else {
            console.error(err);
        }
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
    id = parseInt(id[id.length - 1]);

    fields.forEach((fieldName) => {
        document.querySelector(`.message-error-${fieldName}`)?.remove()
        if (!Object.keys(errors).find(item => item === fieldName)) {
            return
        }

        // using the special function first if there to map the error

        // remove special indifier of form selector
        let selector = formSelector.split('-');

        if (selector.length > 2) selector = selector.slice(0, 2);
        selector = selector.join('-');

        let fieldNameSelector = `${fieldName}-${selector}`;

        if (customFormErrorMaps[fieldNameSelector]) {
            customFormErrorMaps[fieldNameSelector](errors[fieldName], fieldName, id, formSelector)
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



