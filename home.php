
<?php 

//atong e session ang username na imong ge butang diri sir 

session_start();

$cann = mysqli_connect('localhost' , 'root' , '' , 'portfolioMaker');

if(!$cann){
    die("connecshon Feyldd");
}

//now sir diri kay need nato kwaong ang information na imong ge submit gikan sa databse padong diri sa atong home page in a form of a portfolio 

//unsaon man sir? gamitan natog select and fetch_assoc tapos atong e while loop ang data na naka echo sa tibook holder 

//pero sir ang short cut sa echo atong gamiton 
// <?= htmlspecialchars($data['ang row'])??'' // mas nindot siya sir kay taas ra kaayo ang 
// echo htmlspecialchars($data['row']) 

//now e declare nanato ang username na gikan sa session

$username = $_SESSION['username'];


//mao na atong gamiton pang compare satong sql select 

$select = "SELECT * FROM infos WHERE username = '$username' ";


//now sir kwaong nato ang value sa tanan row na ni match ni username 

$result = mysqli_query($cann , $select); // e query nato ang value ni select 

//then fetch nato ang data using assoc but instead of normal assoc atong gamiton ug while loop para nice and shesh 

while($data = mysqli_fetch_assoc($result)){

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($data['username']) ?> | Portfolio</title>
    <link rel="stylesheet" href="../asset/home.css">
</head>

<body>

    <!-- diri sir atong ibutang ang profile picture and name -->
    <header>

        <img 
            src="<?= htmlspecialchars('../photo/' . $data['pfp']) ?>" 
            alt="Profile Picture"
            width="180"
        >

        <h1><?= htmlspecialchars($data['username']) ?></h1>

        <p><?= htmlspecialchars($data['degree']) ?></p>

    </header>


    <!-- now sir diri nato ibutang ang information about sa user -->
    <main>

        <!-- about me section -->
        <section>

            <h2>About Me</h2>

            <p><?= htmlspecialchars($data['bio']) ?></p>

        </section>


        <!-- education section -->
        <section>

            <h2>Education</h2>

            <h3><?= htmlspecialchars($data['school']) ?></h3>

            <p><?= htmlspecialchars($data['degree']) ?></p>

        </section>


        <!-- skills section -->
        <section>

            <h2>My Skills</h2>

            <ul>
                <li><?= htmlspecialchars($data['skill1']) ?></li>
                <li><?= htmlspecialchars($data['skill2']) ?></li>
                <li><?= htmlspecialchars($data['skill3']) ?></li>
            </ul>

        </section>


        <!-- interests section -->
        <section>

            <h2>My Interests</h2>

            <ul>
                <li><?= htmlspecialchars($data['interest']) ?></li>
                <li><?= htmlspecialchars($data['interest2']) ?></li>
            </ul>

        </section>


        <!-- contact information -->
        <section>

            <h2>Contact Information</h2>

            <p><?= htmlspecialchars($data['contact']) ?></p>

        </section>

    </main>


    <!-- footer -->
    <footer>

        <p>
            &copy; <?= date('Y') ?>
            <?= htmlspecialchars($data['username']) ?>
            All Rights Reserved.
        </p>

    </footer>

</body>
</html>

<?php
}
?>
