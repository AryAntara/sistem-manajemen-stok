
import Html from "../html";

const FORM_CREATE_SELECTOR = '#product-create';
const FORM_EDIT_SELECTOR = '#product-edit';
/**
 * Custom error message map for input type text
 *
 * @param {string} errorMessage
 * @param {string} fieldName
 */
function mapErrorMessageOfInputText(errorMessage, fieldName){
    const form = document.querySelector(FORM_CREATE_SELECTOR),
        input = form.querySelector(`[name=${fieldName}]`),
        td = input.parentNode

    let errorMessageWrapper  = document.createElement('span');
    Html.addClass(errorMessageWrapper, `message-error-${fieldName} relative`)

    let i = document.createElement('i');
    i.classList = "bi bi-info-circle-fill text-xl text-red-500";

    let toolTip = document.createElement('div');
    Html.addClass(toolTip, [
        'bg-white border-2 border-black rounded-xl p-2 absolute top-[-50px] w-max text-red-500 border-red-500'
    ])

    toolTip.innerText = errorMessage;
    toolTip.style.display = 'none';

    i.addEventListener('click', () => {
      toolTip.style.display = 'block'
      toolTip.style.transition = 2
      setTimeout(() => toolTip.style.display = 'none', 1000)
    })

    errorMessageWrapper.appendChild(i);
    errorMessageWrapper.appendChild(toolTip);

    td.appendChild(errorMessageWrapper);
}

/**
 * Show product Image
 *
 * @param {number?} id - uniqe id for input id
 */
function showProductImage(id){
    const image =
        !id ?
        document.querySelector(`${FORM_CREATE_SELECTOR} input[type=file]`) :
        document.querySelector(`${FORM_EDIT_SELECTOR}-${id} input[type=file]`)
    console.log(image.files)
    if(image?.files[0]){
        let imagePath = URL.createObjectURL(image.files[0])
        const img = document.createElement('img');
        img.src = imagePath;

        const imageWrapper =
        !id ?
            document.querySelector(`${FORM_CREATE_SELECTOR} .image-wrapper`) :
            document.querySelector(`${FORM_EDIT_SELECTOR}-${id} .image-wrapper`)
        imageWrapper.innerHTML = ''
        imageWrapper.appendChild(img)
    }

    console.log(image);
}

export default {
    mapErrorMessageOfInputText,
    showProductImage,
}
