document.addEventListener("DOMContentLoaded", function() {
    var container = document.querySelector(".hnp_lt_wrap");
    
    var hnp_lightbox = document.createElement("div");
    hnp_lightbox.classList.add("hnp_lightbox");
    container.appendChild(hnp_lightbox);
    
    var message = document.createElement("div");
    message.classList.add("message");
    message.textContent = "Gespeichert";
    hnp_lightbox.appendChild(message);
    
    setTimeout(function() {
        hnp_lightbox.style.display = "none";
    }, 2000); // Anzeigedauer in Millisekunden
});

var cssCode = `
    .hnp_lt_wrap {
        position: relative;
    }
    
    .hnp_lt_wrap .hnp_lightbox {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }
    
    .hnp_lt_wrap .message {
        background-color: #efaa15;
        padding: 18px;
        border-radius: 5px;
        color: #fff;
        font-size: 20px;
    }
`;

var style = document.createElement("style");
style.type = "text/css";
style.innerHTML = cssCode;
document.getElementsByTagName("head")[0].appendChild(style);