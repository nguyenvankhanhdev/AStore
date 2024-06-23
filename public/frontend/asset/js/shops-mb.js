/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
const chooseBtnGr = ()=>{
    const btnLocal = document.querySelector('.abbot-local'),
        btnLocation = document.querySelector('.abbot-location'),
        abbotChoose = document.querySelector('.abbot-choose');
    btnLocal.addEventListener("click", (e) => {
        e.preventDefault()
        btnLocal.classList.add("active")
        btnLocation.classList.remove("active")
        abbotChoose.classList.remove('close')
    });
    btnLocation.addEventListener("click", (e) => {
        e.preventDefault()
        btnLocal.classList.remove("active")
        btnLocation.classList.add("active")
        abbotChoose.classList.add('close')
    });
}

// const chooseBranch = ()=>{
//     document.querySelectorAll("input[name='grp1']").forEach((input) => {
//         input.addEventListener('change', ()=>{
//             const abbotMap =  document.querySelector('.abbot-map')
//             abbotMap.classList.remove('close')
//             abbotMap.children[1].children[1].textContent = input.nextElementSibling.textContent
                   
//         });
//     });
// }

const formMobiles = document.querySelectorAll(".js-form-mobile");
const formInputs = document.querySelectorAll(".js-form-input");
const formClears = document.querySelectorAll(".js-form-clear");
const formCloses = document.querySelectorAll(".js-form-close");
function hasParentWithMatchingSelector(target, selector) {
   return [...document.querySelectorAll(selector)].some((el) => el !== target && el.contains(target));
}
function getNextSibling(elem, callback) {
   // Get the next sibling element
   let sibling = elem.nextElementSibling;

   // If there's no selector, return the first sibling
   if (!callback || typeof callback !== "function") return sibling;

   // If the sibling matches our test condition, use it
   // If not, jump to the next sibling and continue the loop
   let index = 0;
   while (sibling) {
      if (callback(sibling, index, elem)) return sibling;
      index++;
      sibling = sibling.nextElementSibling;
   }
}
function getPrevSibling(elem, callback) {
   // Get the next sibling element
   let sibling = elem.previousElementSibling;

   // If there's no selector, return the first sibling
   if (!callback || typeof callback !== "function") return sibling;

   // If the sibling matches our test condition, use it
   // If not, jump to the next sibling and continue the loop
   let index = 0;
   while (sibling) {
      if (callback(sibling, index, elem)) return sibling;
      index++;
      sibling = sibling.previousElementSibling;
   }
}

function showResult(isShow = true, node) {
   const parent = node.closest(".js-form-mobile");
   let formResult = parent.querySelector(".form-search-result");
   let formClose = parent.querySelector(".js-form-close");
   let formClear = parent.querySelector(".js-form-clear");
   if (isShow) {
      formResult.classList.add("open");
      formClear.classList.add("open");
   } else {
      formResult.classList.remove("open");
      formClear.classList.remove("open");
   }
}

function handleClick(e) {
   e.stopPropagation();
   document.body.classList.add("disable-scroll");
   this.classList.add("open");
   this.querySelector("input").focus();
}

function handleInput(e) {
   if (hasParentWithMatchingSelector(this, ".open") && this.value.length > 0) {
      showResult(true, this.parentNode);
   } else {
      showResult(false, this.parentNode);
   }
}

function handleClear(e) {
   e.stopPropagation();
   const parent = this.parentNode.closest(".js-form-mobile");
   let formInput = parent.querySelector(".js-form-input");
   formInput.value = "";
   showResult(false, this.parentNode);
}

function handleClose(e) {
   e.stopPropagation();
   document.body.classList.remove("disable-scroll");
   const parent = this.parentNode.closest(".js-form-mobile");
   parent.classList.remove("open");
   parent.querySelector(".js-form-input").value = "";
   showResult(false, this.parentNode);
}

formMobiles.forEach((e) => {
   e.addEventListener("click", handleClick);
});
formInputs.forEach((e) => {
   e.addEventListener("paste", handleInput);
   e.addEventListener("input", handleInput);
});
formClears.forEach((e) => {
   e.addEventListener("click", handleClear);
});
formCloses.forEach((e) => {
   e.addEventListener("click", handleClose);
});


let __init = function(){
   //  chooseBtnGr();
   //  chooseBranch();
}();


/******/ })()
;