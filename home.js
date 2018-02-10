

getSchools("dropdown");

function getSchools(destination) {

    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById(destination).innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET","getSchools.php",true); // send request to php and receive what we have in php
    xmlhttp.send();

}