<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css" />
    <script type="javascript" src="js/matrix.js"></script>
    <!-- <link rel="shortcut icon" href="pic/favicon.ico" /> -->
    <title>example_app2</title>
</head>
<body>
    <!-- header +++ -->
    <header>
        <div class="container">
                <img src="images/logo.png" alt="Logo">
        </div>
    </header>
    <!-- header --- -->

    <!-- main +++ -->
    <div class="main">
        <!-- main container +++ -->
        <div class="container">
            <div class="form-conteiner" >
                <form method="POST" action="">
                    <input name="name" type="text" class="form" placeholder="Name"/>
                    <input name="email" type="text" class="form" placeholder="E-mail"/>
                    <textarea name="message" placeholder="Message" class="form" rows="5"></textarea>
                    <input type="submit" class="form" value="Submit"/>
                </form>
            </div>
            <div calss="error_message">
                <span class="message">{LOGERROR}</span>
            </div>
        </div>
        <!-- main container --- -->
    </div>
    <!-- main --- -->

    <!-- footer +++ -->
    <footer>
        <div class="container">
            <table class="table_form_data">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>E-mail</th>
                    <th>Message</th>
                    <th>Create Date</th>
                </tr>
                {FORMDATA}
            </table>
        </div>
    </footer>
    <!-- footer --- -->
</body>
</html>