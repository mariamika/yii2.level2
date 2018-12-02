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
    $('#root-chat').load(location.href + ' #root-chat');
};

document.getElementById("chat-form")
    .addEventListener("submit", function () {
        let task_id = this.task_id.value;
        let textMessage = this.message.value;
        webSocket.send(textMessage);
        event.preventDefault();
        $.ajax({
            type: 'POST',
            data: {message: textMessage, task_id: task_id},
            url:'/admin/comment',
            error: function () {
                $('#root-chat').html('There was an error!');
            },
        });
        return false;
    });