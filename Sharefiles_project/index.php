<?php
        // var_dump($_FILES);
        if(isset($_FILES['image']) && $_FILES['image']['error'] === 0 ){
            if($_FILES['image']['size'] < 3000000){
                
                $informationsImage = pathinfo($_FILES['image']['name']);
                $extensionArray = ['png','jpg','jpeg','pdf', 'gif'];
                // var_dump($informationsImage);
                $itemExtension = strtolower($informationsImage['extension']);
                
                if(in_array($itemExtension,$extensionArray)){
                    $newImageName = ''.time().rand().rand().'.'.$informationsImage['extension'];
                    move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/'. $newImageName);

                }

            };
        }; 

?>

<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="css/default.css">
        <link rel="icon" type="image/png" href="images/favicon.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
        <title>ShareFiles - Hébergez gratuitement vos images et en illimité</title>
    </head>
    <body>

        <header>
            <a href="../">
                <span>ShareFiles</span>
            </a>
        </header>

        <section>

            <h1>
                <?php
                    if($_SERVER['REQUEST_METHOD']=='POST')
                    {
                        echo "<img class='imageJustUpload' src='./uploads/$newImageName' alt='Sharefiles'>";
                    } else {
                        ?><i class="fas fa-paper-plane"></i><?php
                    };    
                ?>
            </h1>

            <?php if($_SERVER['REQUEST_METHOD']=='POST'){ ?>
                        <h2>Fichier envoyer avec succès</h2>

                        <p>Voici le lien vers votre image:</p>
                        <input type="text" name="imageLink" id="link" value='./uploads/'.$newImageName>
                       
                    <?php } else { ?>
                        <form method="post" action='index.php' enctype="multipart/form-data" >
                            <p>
                                <label for="image">Sélectionnez votre fichier</label><br>
                                <input type="file" name="image" id="image">
                            </p>
                            <p id="send">
                                <button type="submit">Envoyer <i class="fas fa-long-arrow-alt-right"></i></button>
                            </p>
                        </form>
                    <?php }; ?>
                    
        </section>
        
    </body>
</html>