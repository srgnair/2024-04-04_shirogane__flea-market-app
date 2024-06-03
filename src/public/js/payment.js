    function formSwitch() {
        hoge = document.getElementsByName('maker')
        if (hoge[0].checked) {
            document.getElementById('foodList').style.display = "";
            document.getElementById('placeList').style.display = "none";
        } else if (hoge[1].checked) {
            document.getElementById('foodList').style.display = "none";
            document.getElementById('placeList').style.display = "";
        } else {
            document.getElementById('foodList').style.display = "none";
            document.getElementById('placeList').style.display = "none";
        }
    }
    window.addEventListener('load', formSwitch());