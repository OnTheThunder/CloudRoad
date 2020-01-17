
function changeicon() {
    document.getElementById('notificacion').classList.add('fa-exclamation-triangle');
    document.getElementById('notificacion').classList.remove('fa-bell');

}


/*
function newUpdate() {
    console.log("entroupdate")
    setInterval(changeicon, 2000);
}
*/

/*var docBody = document.getElementById('notificacion');
docBody.onload = newUpdate;*/
newUpdate()
