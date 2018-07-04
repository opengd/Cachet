<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /></head>
    <link href="https://fonts.googleapis.com/css?family=Oswald|Roboto" rel="stylesheet" />
<body>
    <style>
        @media only screen and (max-width: 600px) {
            .inner-body {
                width: 100% !important;
            }

            .footer {
                width: 100% !important;
            }
        }

        @media only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
            }
        }

        body {
            font-family: "Roboto", Helvetica, Arial, sans-serif;
        }

        .flex-container {
            display: flex;
            /* height: 300px; */
            justify-content: center;
            align-items: center;
            align-content: center;
            background-color: rgb(237, 237, 237);
            padding-bottom: 20px;
            padding-top: 20px;
        }

        .container {
            padding: 15px;
            background-color: #ffffff;
            width: 700px;
            margin: auto;
        }

        h2 {
            font-family: "Oswald", Helvetica, Arial, sans-serif;
            line-height: 1.5; 
            font-size: 25px; 
            font-weight: 500;
        }

        p {
            font-family: "Roboto", Helvetica, Arial, sans-serif;
            line-height: 1.5;
            font-size: 14px;
            font-weight: 300;
            color: black;
        }

        small {
            font-family: "Roboto", Helvetica, Arial, sans-serif;
            line-height: 1;
            font-size: 12px;
            font-weight: 300;
        }

        img {
            margin-top: 30px;
            margin-bottom: 30px;
        }

        .line {
            margin-top: 30px;
            margin-bottom: 5px;
        }

        .brg {
            color: rgb(60, 60, 60);
        }

        a:link {
            font-family: "Roboto", Helvetica, Arial, sans-serif;
            color: #326482;
            background-color: transparent;
            text-decoration: line;
        }

        .view {
            margin-top: 30px;
            margin-bottom: 30px; 
        }

    </style>
    <div class="flex-container">
        <div class="container">
            {{ $header or '' }}

            {{ Illuminate\Mail\Markdown::parse($slot) }}
            {{ $subcopy or '' }}
            {{ $footer or '' }}
        </div>
    </div>
</body>
</html>
