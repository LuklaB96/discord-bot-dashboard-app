import { Submenu } from './modules/Submenu.js';


var subMenuSubscribers = {};
// ['parent'] = target
subMenuSubscribers['submenu-parent'] = 'submenu';
subMenuSubscribers['submenu-parent1'] = 'submenu1';

const submenu = new Submenu(subMenuSubscribers, 50);

$('document').ready(() => {
    submenu.setSubMenuPosition();
    const btn = document.querySelector(".btn-toggle");

    btn.addEventListener("click", function () {
        document.body.classList.toggle("dark-theme");
    });
})

window.RefreshSubMenu = function () {
    ShowHideLeftTitles();
    submenu.setSubMenuPosition();
}
function ShowHideLeftTitles() {
    var spans = document.getElementsByClassName('leftNavbarTitle');

    for (var i = 0; i < spans.length; i++) {
        if (spans[i].style.display === 'none')
            spans[i].style.display = 'inline-flex';
        else
            spans[i].style.display = 'none';
    }
}