let edit_buttons = document.querySelectorAll('body #my_page_body #user_info div form div.edit_user_info input[value="Edit"]')
for(let i = 0; i < edit_buttons.length; i++) 
    edit_buttons[i].addEventListener('click', edit_topic)

function edit_topic(event) {
    let form = event.target.parentNode.parentNode.parentNode
    let edit_button = event.target
    let cancel_button = form.querySelector('div.edit_user_info div.buttons input[value="Cancel"]')
    let save_button = form.querySelector('div.edit_user_info div.buttons input[value="Save"]')
    let input_box = form.querySelector('div.edit_user_info span.user_input')
    let text = form.querySelector('span.info_topics')

    edit_button.setAttribute('hidden', true) // edit button is hidden
    if(text != null) text.setAttribute('hidden', true) // text is hidden
    save_button.removeAttribute('hidden') // save button shows up
    cancel_button.removeAttribute('hidden') // cancel button shows up
    input_box.removeAttribute('hidden') // input box shows up

    cancel_button.addEventListener('click', cancel_edition)
}

function cancel_edition(event) {
    let form = event.target.parentNode.parentNode.parentNode
    let edit_button = form.querySelector('div.edit_user_info div.buttons input[value="Edit"]')
    let cancel_button = event.target
    let save_button = form.querySelector('div.edit_user_info div.buttons input[value="Save"]')
    let input_box = form.querySelector('div.edit_user_info span.user_input')
    let text = form.querySelector('span.info_topics')

    edit_button.removeAttribute('hidden') // edit button shows up
    if(text != null) text.removeAttribute('hidden') // text shows up
    save_button.setAttribute('hidden', true) // save button is hidden
    cancel_button.setAttribute('hidden', true) // cancel button is hidden
    input_box.setAttribute('hidden', true) // input box is hidden

    form.reset() // resets all the forms values
}