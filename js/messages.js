'use strict'

let closeIcon1 = document.querySelector("#errorMessage .closeIcon")
let closeIcon2 = document.querySelector("#sucessMessage .closeIcon")

if(closeIcon1 !== null) closeIcon1.addEventListener('click', closeMessage)
if(closeIcon2 !== null) closeIcon2.addEventListener('click', closeMessage)

function closeMessage(event) {
    let message = event.target.parentNode.parentNode
    message.remove()
}