let sidebar = document.querySelector(".sidebar");
let closeBtn = document.querySelector("#btn");
let userSubMenu = document.querySelector("#userSubMenu");
let fileManagerSubMenu = document.querySelector("#fileManagerSubMenu");

closeBtn.addEventListener("click", () => {
    sidebar.classList.toggle("open");
    menuBtnChange();
});

userSubMenu.addEventListener("click", () => {
    toggleSubMenu(userSubMenu);
});

fileManagerSubMenu.addEventListener("click", () => {
    toggleSubMenu(fileManagerSubMenu);
});

function menuBtnChange() {
    if (sidebar.classList.contains("open")) {
        closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");
    } else {
        closeBtn.classList.replace("bx-menu-alt-right", "bx-menu");
    }
}

function toggleSubMenu(icon) {
    let subMenu = icon.parentElement.nextElementSibling;
    subMenu.classList.toggle("open");
    icon.classList.toggle("bx-chevron-up");
    icon.classList.toggle("bx-chevron-down");
}
