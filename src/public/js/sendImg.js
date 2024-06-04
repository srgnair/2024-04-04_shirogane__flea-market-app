document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('fileSelect').addEventListener('click', function() {
        document.getElementById('fileElem').click();
    });
});

function onChangeFileInput(input) {
    const fileList = document.getElementById('fileList');
    fileList.innerHTML = '';

    for (let i = 0; i < input.files.length; i++) {
        const listItem = document.createElement('div');
        listItem.textContent = input.files[i].name;
        fileList.appendChild(listItem);
    }
}
