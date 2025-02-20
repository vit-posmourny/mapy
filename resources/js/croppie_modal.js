var imgBtn = document.getElementById('i-user-foto');

imgBtn.addEventListener('click', openDialogInNewWindow);

function openDialogInNewWindow() {
    // Define the content for the new window
    const dialogWindow = window.open("/croppie", "DialogWindow", "width=505,height=900,menubar=no,resizable=no,status=no,titlebar=no,left=300");
}