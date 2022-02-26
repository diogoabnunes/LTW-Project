'use strict'

function encodeForAjax(data) {
    return Object.keys(data).map(function(k){
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&')
}

let filters = document.querySelectorAll("#home_body #filters input")

for(let filter of filters)
    filter.addEventListener("click", selectedFilter)

function selectedFilter() {
    let species = getSelectedSpeciesFilter()
    let breeds = getSelectedBreedsFilter()
    let genders = getSelectedGendersFilter()
    let states = getSelectedStatesFilter()

    let request = new XMLHttpRequest()
    request.onload = displayPets
    request.open("post", "../api/api_selected_filters.php", true)
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
    request.send(encodeForAjax({species: species, breeds: breeds, genders: genders, states: states}))
}

function getSelectedSpeciesFilter() {
    let speciesInput = document.querySelectorAll("#home_body #filters #search_specie #listSpecies li input")
    let species = []

    for(let input of speciesInput) 
        if(input.checked) species.push(input.getAttribute("value"))
    
    return species;
}

function getSelectedBreedsFilter() {
    let breedsInput = document.querySelectorAll("#home_body #filters #search_breed #listBreeds li input")
    let breeds = []

    for(let input of breedsInput)
        if(input.checked) breeds.push(input.getAttribute("value"))
    
    return breeds;
}

function getSelectedGendersFilter() {
    let gendersInput = document.querySelectorAll("#home_body #filters #search_gender #listGender li input")
    let genders = []

    for(let input of gendersInput) 
        if(input.checked) genders.push(input.getAttribute("value"))
    
    return genders;
}

function getSelectedStatesFilter() {
    let statesInput = document.querySelectorAll("#home_body #filters #search_state #listState li input")
    let states = []

    for(let input of statesInput) 
        if(input.checked) states.push(input.getAttribute("value"))

    return states;
}

function displayPets() {
    let pets = JSON.parse(this.responseText)
    let petsSection = document.querySelector("#home_body #pets")
    petsSection.innerHTML = ""

    for(let pet of pets){
        let article = document.createElement('article')
        article.setAttribute('class', 'pets')
        article.innerHTML = "<a href='../actions/action_pet_info.php?id=" + pet['id'] + "'> <img id = 'petImage' src=" + pet['img'] + " alt='Pet Photo'> <span id='petName'> " + pet['petname'] + "</span> </a>"
        petsSection.appendChild(article)
    }
}