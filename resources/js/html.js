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

/**
 * Toggle the loader
 *
 * @param {string} state - state to toggle, if hidden remove the loader
 */
function toggleLoader(hidden = true){
    hidden ? document.getElementById("loader").style.display = "none" :  document.getElementById("loader").style.display = "flex"
}

export default {
    addClass, removeAndAddClass, removeClass, toggleLoader
}
