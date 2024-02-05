<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Messages</title>
        <style>
            * {
                box-sizing: border-box;
            }

            body {
                display: grid;
            }

            form {
                display: grid;
                gap: .5rem;
                width: min(100%, 30rem);
                margin-inline: auto;
            }
        </style>
    </head>

    <body>
        <form method="POST">
            <h2>Leave a message!</h2>
            <label for="name">name</label>
            <input type="text" name="name">
            <label for="email">email</label>
            <input type="email" name="email">
            <label for="message">message</label>
            <textarea name="message" rows="1"></textarea>
            <button>Submit</button>
        </form>

        <div class="messages">
            <div>Loading...</div>
        </div>

        <script>
            const messages = fetch('../controller/MessageController.php?getMessages')
                .then(res => res.json())
                .then((messages) => {
                    let messageHTML = '';
                    // console.log(messages);
                    messages.forEach(message => {
                        console.log(message);
                        messageHTML += `
                                <div>
                                    <h2>${message.name}</h2>
                                    <p>${message.email}</p>
                                    <p>${message.message}</p>
                                    <p>${message.created_at}</p>
                                </div>
                                `
                    });
                    const parent = document.querySelector('.messages');

                    parent.innerHTML = messageHTML;
                });
        </script>

    </body>

</html>