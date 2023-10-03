function ShowHideLeftTitles() {
    var spans = document.getElementsByClassName('leftNavbarTitle');

    for (var i = 0; i < spans.length; i++) {
        if (spans[i].style.display === 'none')
            spans[i].style.display = 'inline-flex';
        else
            spans[i].style.display = 'none';
    }
}

function SetSubMenuPosition(subscribers) {
    for (var key in subscribers) {
        var parent = document.getElementById(key);
        var target = document.getElementById(subscribers[key]);
        var Rect = parent.getBoundingClientRect();
        target.style.left = Rect.width + "px";
        target.style.top = Rect.top - (Rect.height + 1) + "px";
    }
}