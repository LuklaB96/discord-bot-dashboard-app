export class Submenu {
    constructor(subscribers, timeout = 100) {
        this._timeout = timeout;
        this._subscribers = subscribers;
    }
    setSubMenuPosition() {
        const setPos = () => {
            for (var key in this._subscribers) {
                var parent = document.getElementById(key);
                var target = document.getElementById(this._subscribers[key]);
                var Rect = parent.getBoundingClientRect();
                target.style.left = Rect.width + "px";
                target.style.top = Rect.top - (Rect.height + 1) + "px";
            }
        }
        setTimeout(() => {
            setPos();
        }, this._timeout);
    }
}