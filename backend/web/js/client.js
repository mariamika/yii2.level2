if (!window.WebSocket) {
    alert('Ваш браузер не поддерживает веб-сокеты!');
}

let webSocket = new WebSocket("ws://chat:8080");

webSocket.onmessage = function(event){
    let data = event.data;
    let messageContainer = document.createElement('div');
    let textNode = document.createTextNode(data);
    messageContainer.appendChild(textNode);
    document.getElementById("root-chat")
        .appendChild(messageContainer);
};

document.getElementById("chat-form")
    .addEventListener("submit", function () {
        let textMessage = this.message.value;
        webSocket.send(textMessage);
        event.preventDefault();
        return false;
    });