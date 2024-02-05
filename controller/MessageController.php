<?php

require_once '../model/MessagesModel.php';

class MessageController extends MessagesModel
{
    function addMessage($name, $email, $message)
    {
        // validateion
        if (empty($name) || empty($email) || empty($message)) {
            return "Please fill in all fields";
        }
        // check if valid length 
        if (strlen($name) > 20 || strlen($email) > 256 || strlen($message) > 1000) {
            return "Please enter valid data";
        }

        // insert into database
        $this->insertMessage($name, $email, $message);
    }

    function messagesWithFilters($filters = [])
    {
        return $this->getMessages();
    }
}
$messageController = new MessageController();

$filters = [];

$error = '';

// print_r($_GET);

if (isset($_GET['search'])) {
    $filters['search'] = $_GET['search'];
}

if (isset($_GET['orderBy'])) {
    $filters['orderBy'] = $_GET['orderBy'];
}

if (isset($_GET['getMessages'])) {
    echo json_encode($messageController->messagesWithFilters($filters));
}



if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message'])) {
    $error = $messageController->addMessage($_POST['name'], $_POST['email'], $_POST['message']);
    return $error;
}

?>