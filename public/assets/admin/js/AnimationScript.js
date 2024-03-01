function changeSideBar() {
    toggle_open=document.getElementById("open");
    toggle_close=document.getElementById("close");
    item_titles=document.getElementsByClassName("item_title")
    item_icons=document.getElementsByClassName("item_icon")
    footer_icon=document.getElementById("footer_icon");
    header_title=document.getElementById("header_title");
    footer_title=document.getElementById("footer_title");
    sidebar =document.getElementById("sidebar");

    if (toggle_open.hasAttribute('hidden')) {

        toggle_close.setAttribute("hidden", "true");
        toggle_open.removeAttribute('hidden');
        sidebar.style.width = '4.5%';
        for (const key in item_titles) {
            if (!isNaN(key)) {
                item_titles[key].style.width="0";
            }   
        }
        for (const key in item_icons) {
            if (!isNaN(key)) {
                item_icons[key].style.width="100%";   
            }   
        }
        footer_title.style.width="0";
        footer_icon.style.width="100%"
        header_title.style.width="0px"
        changeMain('4.5%',chooseMain());
    } else {
        toggle_open.setAttribute("hidden", "true");
        toggle_close.removeAttribute('hidden');
        sidebar.style.width = '14.5%'
        for (const key in item_titles) {
            if (!isNaN(key)) {
                item_titles[key].style.width="70%";
            } 
        }
        for (const key in item_icons) {
            if (!isNaN(key)) {
                item_icons[key].style.width="30%";
            }   
        }
        footer_title.style.width="70%";
        footer_icon.style.width="30%"
        header_title.style.width="140px"
        changeMain('14.5%',chooseMain());
    }
}
function chooseMain() {
    if(document.getElementById("contract")!=null)
        return  document.getElementById("contract")
    if(document.getElementById("order")!=null)
        return  document.getElementById("order")
    if(document.getElementById("invoice")!=null)
        return  document.getElementById("invoice")
    if(document.getElementById("customer")!=null)
        return  document.getElementById("customer")
    if(document.getElementById("trip")!=null)
        return  document.getElementById("trip")
    if(document.getElementById("ship")!=null)
        return  document.getElementById("ship")
    if(document.getElementById("cargo")!=null)
        return  document.getElementById("cargo")
    if(document.getElementById("price")!=null)
        return  document.getElementById("price")
    if(document.getElementById("schedule")!=null)
        return  document.getElementById("schedule")
    if(document.getElementById("container")!=null)
        return  document.getElementById("container")
    if(document.getElementById("seaport")!=null)
        return  document.getElementById("seaport")
    if(document.getElementById("account")!=null)
        return  document.getElementById("account")
    return null
}
function changeMain(widthSideBar,object) {
    if (widthSideBar =="14.5%") {
        object.style.width ="85.5%";
    } else {
        object.style.width ="95.5%"
    }
}