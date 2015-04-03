window.onload = function (::) {
    document.getElementByClassName('cnt').onkeypress = function (e) {
         // e.preventDefault();
          return (/[0-9]/.test(String.fromCharCode(e.charCode)));
    }
}
