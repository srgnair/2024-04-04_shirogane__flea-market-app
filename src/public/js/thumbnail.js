const fileSelect = document.getElementById("fileSelect");
const fileElem = document.getElementById("fileElem");

fileSelect.addEventListener("click", (e) => {
    if (fileElem) {
        fileElem.click();
    }
}, false);

const onChangeInputFile = (e) => {
    if (e.target.files && e.target.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
        document.getElementById('thumbnail').setAttribute('src', e.target.result);
        };
        reader.readAsDataURL(e.target.files[0]);
    }
};