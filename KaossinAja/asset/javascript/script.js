var popupRegis = document.getElementById("popupRegis");
var popupLogin = document.getElementById("popupLogin");

var openPopupBtnRegis = document.getElementById("open-popup-regis");
var openPopupBtnLogin = document.getElementById("open-popup-login");

var closeBtns = document.querySelectorAll(".close-btn");

openPopupBtnRegis.onclick = function () {
  popupRegis.style.display = "flex";
};
openPopupBtnLogin.onclick = function () {
  popupLogin.style.display = "flex";
};

closeBtns.forEach(function (closeBtn) {
  closeBtn.onclick = function () {
    popupRegis.style.display = "none";
    popupLogin.style.display = "none";
  };
});

// window.onclick = function(event) {
//     if (event.target == popupRegis) {
//         popupRegis.style.display = "none";
//     }
//     if (event.target == popupLogin) {
//         popupLogin.style.display = "none";
//     }
// }
