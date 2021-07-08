<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>

    <div class="container"><br/><br/></br>
        <h2 class="center">Ajout de contact</h2>
        <form method="POST", action="projet.php">
            Nom : <br/>
            <input class="form-control" type='text' name='nom'/><br/>
            Telephone : <br/>
            <input class="form-control" type='text' name='telephone'/><br/>
            Email : <br/>
            <input class="form-control" type='text' name='email'/><br/>
            <input class="btn btn-success" type='submit' value="Enregisrer"/><br/>
        </form>

        <?php

            $dsn = 'mysql:host=localhost;dbname=test';
            $bdd= new PDO($dsn, 'root', '');	

           
            if(isset($_POST["nom"]) && isset($_POST["telephone"]) && isset($_POST["email"])){
                $nom = $_POST["nom"];
                $tel = $_POST["telephone"];
                $email = $_POST["email"];
                if(!empty($nom) && !empty($tel) && !empty($email)){
                    if(!telephone($tel)){
                        $res = $bdd->exec('insert into carnet (nom, telephone, email) values ("'.$nom.'", "'.$tel.'","'.$email.'")');
                        if($res){
                            echo '<script>alert("Enregistrement reussi !!")</script>';
                        }
                    }else{
                        echo '<script>alert("ce numero telephone existe deja")</script>';
                    }
                }else{
                    echo '<script>alert("Veuillez renseigner tous les champs !!")</script>';
                }

            }
        ?>
        <br/><br/>
        <h2>Liste des contacts du carnet</h2>
        <?php
            $bdd = new PDO('mysql:host=localhost; dbname=test', 'root', '');
            $stmt = $bdd->query('select * from carnet');
            echo '<table class="table">';
            echo'<thead>
                <tr>
                <th scope="col">id</th>
                <th scope="col">Nom</th>
                <th scope="col">Telephone</th>
                <th scope="col">Email</th>
                </tr>
            </thead>';
            echo '<tbody>';
            while($row=$stmt->fetch()){
                echo '<tr>
                    <th scope="row">'.$row['id'].'</th>
                    <td>'.$row["nom"].'</td>
                    <td>'.$row["telephone"].'</td>
                    <td>'.$row['email'].'</td>
                </tr>';
            }
            echo '</tbody>';
        
            echo '</table>';
        ?>
        <?php
             function telephone($tel){
                $dsn = 'mysql:host=localhost;dbname=test';
                $bdd= new PDO($dsn, 'root', '');
                $stmt = $bdd->query("select * from carnet where telephone='".$tel."'");
                if($row=$stmt->fetch())
                    return true;
                return false;
            }

            

        ?>
        
        
        
    </div>

    <?php
    $to      = 'houma.mamour@gmail.com';
    $subject = 'Testing sendmail';
    $message = 'Hi, you received an email!';
    $headers = 'From: houma.mamour@gmail.com' . "\r\n" . 
            'Reply-To: houma.mamour@gmail.com' . "\r\n" .
            'MIME-Version: 1.0' . "\r\n" .
            'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

    if(mail($to, $subject, $message, $headers))
    echo "Envoi reussi"; 
    else
    echo "Echec de l'envoi";
    
    
    ?>

<script>  
  
  var a;  
  a = setInterval(fun, 5000);   
  $i=0;
  function fun() {  
    $i=$i+1;
    alert("Email ", $i);  
  }
</script>  

<body>