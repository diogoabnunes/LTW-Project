'use strict'

let user = document.querySelector("#pet_info_body input[name='userId']")
let pet = document.querySelector("#pet_info_body input[name='petId']")
let csrf = document.querySelector("#pet_info_body input[name='csrf']")

let states = document.querySelectorAll('#pet_info_body #proposes .propose_box .propose .propose_state')

for(let state of states) defineStateColor(state)
// ##########################################################

let acceptButtons = document.querySelectorAll('#pet_info_body #proposes .propose_box .propose_answers input[value="Accept"]')
let rejectButtons = document.querySelectorAll('#pet_info_body #proposes .propose_box .propose_answers input[value="Reject"]')

for(let acceptButton of acceptButtons) acceptButton.addEventListener('click', acceptPropose)
for(let rejectButton of rejectButtons) rejectButton.addEventListener('click', rejectPropose)

function acceptPropose(event) {
    let proposeId = event.target.parentNode.parentNode.querySelector("input[name='proposeId']").getAttribute("value")
    let username = event.target.parentNode.parentNode.querySelector(".propose_author a").innerHTML

    let request = new XMLHttpRequest()
    request.onload = updateState
    request.open("post", "../api/api_update_propose_state.php", true)
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
    request.send(encodeForAjax({username: username, petId: pet.getAttribute("value"), proposeId: proposeId, value: "accepted", csrf: csrf.getAttribute("value")}))
}

function rejectPropose(event) {
    let proposeId = event.target.parentNode.parentNode.querySelector("input[name='proposeId']").getAttribute("value")
    let username = event.target.parentNode.parentNode.querySelector(".propose_author a").innerHTML

    let request = new XMLHttpRequest()
    request.onload = updateState
    request.open("post", "../api/api_update_propose_state.php", true)
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
    request.send(encodeForAjax({username: username, petId: pet.getAttribute("value"), proposeId: proposeId, value: "rejected", csrf: csrf.getAttribute("value")}))
}

function updateState() {
    let state = JSON.parse(this.responseText)

    // wrong csrf
    if(state.length === 0) return;

    let proposes = document.querySelectorAll("#pet_info_body #proposes .propose_box .propose")

    for(let propose of proposes){
        if(propose.querySelector("input[name='proposeId']").getAttribute("value") === state[0]) {
            // updates propose state
            propose.querySelector(".propose_state").innerHTML = state[1]
            // removes the acept and reject buttons
            propose.querySelector(".propose_answers").remove()
            // it's not possible to comment a rejeted or acepted propose
            propose.querySelector(".add_comment").remove() // it's not possible to comment a rejeted or accepted propose

            if(state[1] === "accepted") {
                propose.querySelector(".propose_state").style.backgroundColor = "green"
                // updates pet state
                document.querySelector("#pet_info_body #pet_info div div:nth-child(10) .info_topics").innerHTML = "adopted"
                // update current pet owner
                document.querySelector("#pet_info_body #pet_info div div:last-child .info_topics").innerHTML = state[2]
            
                rejectRemainingProposes(proposes, state[0]);
            }
            else propose.querySelector(".propose_state").style.backgroundColor = "red"
            break;
        }
    }
}

function rejectRemainingProposes(proposes, proposeId) {
    for(let propose of proposes){
        if(propose.querySelector("input[name='proposeId']").getAttribute("value") !== proposeId){
            propose.querySelector(".propose_state").innerHTML = "rejected"
            propose.querySelector(".propose_state").style.backgroundColor = "red"

            propose.querySelector(".propose_answers").remove()
            propose.querySelector(".add_comment").remove()
        }
    }
}

// ################################################################

let regularCommentButton = document.querySelector('#pet_info_body #comments .add_comment input[value="Comment"]')
let relatedCommentButtons = document.querySelectorAll('#pet_info_body #proposes .add_comment input[value="Comment"]')
let proposeButton = document.querySelector('#pet_info_body #proposes .add_propose input[value="Propose"]')

if(regularCommentButton != null) regularCommentButton.addEventListener('click', addComment)
for(let relatedCommentButton of relatedCommentButtons) relatedCommentButton.addEventListener('click', addComment)
if(proposeButton != null) proposeButton.addEventListener('click', addPropose)

function addComment(event) {
    let dateInstance = new Date();
    let date = dateInstance.getFullYear() + "-" + (dateInstance.getMonth() + 1) + "-" + dateInstance.getDate()
    let hour = dateInstance.getHours() + ":" + dateInstance.getMinutes()
    
    let proposeId = event.target.parentNode.querySelector("input[name='proposeId']").getAttribute("value")
    let comment = event.target.parentNode.querySelector("textarea")

    if(comment.value === "" || emptyString(comment.value)){ 
        comment.value = ""
        return;
    }
    
    let request = new XMLHttpRequest()
    request.onload = commentAdded
    request.open("post", "../api/api_add_comment.php", true)
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
    request.send(encodeForAjax({comment: comment.value, date: date, hour: hour, userId: user.getAttribute("value"), petId: pet.getAttribute("value"), proposeId: proposeId, csrf: csrf.getAttribute("value")}))

    comment.value = ""
}

function commentAdded() {
    let commentInfo = JSON.parse(this.responseText)

    // wrong csrf
    if(commentInfo.length === 0) return;
    
    let comment = createComment(commentInfo)
    if(commentInfo[3] === "null"){
        let regularComments = document.querySelector("#pet_info_body #comments .comment_box")
        regularComments.appendChild(comment)
    }
    else{
        let proposeComments = document.querySelectorAll("#pet_info_body #proposes .propose_box .propose")
        for(let propose of proposeComments){
            if(propose.querySelector('input[name="proposeId"]').getAttribute("value") === commentInfo[3]){
                propose.querySelector(".comments_on_propose").appendChild(comment)
                break;
            }
        }
    }
}

function createComment(comment) {
    let article = document.createElement("article")
    article.setAttribute("class", "comment")
    console.log(comment[5])
    article.innerHTML = '<p> <span class="comment_topic"> Author: </span> <span class="comment_author"> <a href="../actions/action_user_page.php?id=' + comment[5] + '">' + comment[4] + '</a> </span> </p> <p> <span class="comment_topic"> Date: </span> <span class="comment_date">' + comment[1] + '</span> </p> <p> <span class="comment_topic"> Hour: </span> <span class="comment_hour">' + comment[2] + '</span> </p> <p class="comment_body">' + comment[0] + '</p>'

    return article
}

function addPropose(event) {
    let dateInstance = new Date();
    let date = dateInstance.getFullYear() + "-" + (dateInstance.getMonth() + 1) + "-" + dateInstance.getDate()
    let hour = dateInstance.getHours() + ":" + dateInstance.getMinutes()
    
    let propose = event.target.parentNode.querySelector("textarea")

    if(propose.value === "" || emptyString(propose.value)){ 
        propose.value = ""
        return;
    }

    let request = new XMLHttpRequest()
    request.onload = proposeAdded
    request.open("post", "../api/api_add_propose.php", true)
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
    request.send(encodeForAjax({propose: propose.value, date: date, hour: hour, userId: user.getAttribute("value"), petId: pet.getAttribute("value"), csrf: csrf.getAttribute("value")}))

    propose.value = ""
}

function proposeAdded() {
    let proposeInfo = JSON.parse(this.responseText)

    // wrong csrf
    if(proposeInfo.length === 0) return;
    
    let article = document.createElement("article")
    article.setAttribute("class", "propose")

    let proposeIdHtml = '<input type="hidden" name="proposeId" value=' + proposeInfo['id'] + '>'
    let proposeAuthorHtml = '<p> <span class="propose_topic"> Author: </span> <span class="propose_author"><a href="../actions/action_user_page.php?id=' + proposeInfo['userId'] + '">' + proposeInfo['username'] + '</a></span> </p>'
    let proposeDateHtml = '<p> <span class="propose_topic"> Date: </span> <span class="propose_date">' + proposeInfo['date'] + '</span> </p>'
    let proposeHourHtml = '<p> <span class="propose_topic"> Hour: </span> <span class="propose_hour">' + proposeInfo['hour'] + '</span> </p>'
    let proposeStateHtml = '<p> <span class="propose_topic"> State: </span> <span class="propose_state">' + proposeInfo['state'] + '</span> </p>'
    let proposeBodyHtml = '<p class="propose_body">' + proposeInfo['description'] + '</p>'

    let commentOnProposeHtml = '<article class="comments_on_propose"></article>'

    let commentProposeIdHtml = "<input type='hidden' name='proposeId' value=" + proposeInfo['id'] + ">"
    let commentUserIdHtml = "<input type='hidden' name='userId' value=" + user.getAttribute("value") + ">"
    let commentPetIdHtml = "<input type='hidden' name='petId' value=" + pet.getAttribute("value") + ">"
    let textareaHtml = '<textarea name="propose" placeholder="Insert your comment here!"></textarea>'
    let buttonHtml = "<input type='button' value='Comment'>"
    let commentHtml = "<div class='add_comment'>" + commentProposeIdHtml + commentUserIdHtml + commentPetIdHtml + textareaHtml + buttonHtml + "</div>"

    article.innerHTML = proposeIdHtml + proposeAuthorHtml + proposeDateHtml + proposeHourHtml + proposeStateHtml + proposeBodyHtml + commentOnProposeHtml + commentHtml

    let proposes = document.querySelector("#pet_info_body #proposes .propose_box")
    proposes.appendChild(article)

    let state = article.querySelector('.propose_state')
    defineStateColor(state)

    let comment = article.querySelector('.add_comment input[value="Comment"]')
    comment.addEventListener('click', addComment)
}

// ################################################################

function defineStateColor(state) {
    if(state != null && state.innerHTML === "processing") state.style.backgroundColor = "yellow"
    else if (state != null && state.innerHTML == "accepted") state.style.backgroundColor = "green"
    else if(state != null) state.style.backgroundColor = "red"
}

function emptyString(string) {
    for(let i = 0; i < string.length; i++)
        if(string[i] !== " ") return false;
    return true;
}


function nextPhoto(petId,photoId){

    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("image").innerHTML = this.responseText;
        }
      };

    xmlhttp.open("GET","../actions/action_next_photo.php?p="+petId+"&ph="+photoId,true);
    xmlhttp.send();

}

function previousPhoto(petId,photoId){

    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("image").innerHTML = this.responseText;
        }
      };

    xmlhttp.open("GET","../actions/action_previous_photo.php?p="+petId+"&ph="+photoId,true);
    xmlhttp.send();

}
