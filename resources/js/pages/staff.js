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

export default {
    mapErrorMessageOfPhotoProfile
}
