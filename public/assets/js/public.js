// Set cookies on close button on banner template
function setCookie(){
    document.cookie = "wp_banner_closed_template=Template is closed";
    // document.getElementById("wp_banner_popup_overlay").style.display="none!important";
}

// Check if the cookies is set
function getCookie(name) {
    let nameEQ = name + "=";
    let ca = document.cookie.split(';');
    for(let i=0;i < ca.length;i++) {
        let c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

let cookie_set = getCookie("wp_banner_closed_template");
if(cookie_set){
    let overlay = document.getElementById("wp_banner_popup_overlay");
    overlay.style.display='none';

    alert("testic");
}