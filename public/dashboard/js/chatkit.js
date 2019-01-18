const tokenProvider = new Chatkit.TokenProvider({
    url: "https://us1.pusherplatform.io/services/chatkit_token_provider/v1/da2beadc-12c4-416d-8e6c-13d3b31018a1/token"
  });
  
  const chatManager = new Chatkit.ChatManager({
    instanceLocator: "v1:us1:da2beadc-12c4-416d-8e6c-13d3b31018a1",
    userId: "prepadmin",
    tokenProvider: tokenProvider
  });

  
chatManager
  .connect()
  .then(currentUser => {
    currentUser.subscribeToRoom({
        roomId: currentUser.rooms[0].id,
        hooks:{
            onMessage: message => {
                //console.log('Received new message: ${message.text}')
                const ul = document.getElementById("messagesList");
                const li = document.createElement("li");
                li.appendChild(
                    document.createTextNode('${message.senderId}:${message.text}')
                );
                ul.appendChild(li)
            }
        }
    })
    const form = document.getElementById("messageForm");
    form.addEventListener("submit", e => {
        e.preventDefault();
        const input = document.getElementById("messageText");
        currentUser.sendMessage({
            text:input.nodeValue,
            roomId:currentUser.rooms[0].id
        });
        input.value ="";
    })
  })
  .catch(error => {
    console.error("error:", error);
  });