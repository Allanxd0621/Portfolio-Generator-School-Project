<?php 

session_start();

//Hi sir I will create a different side using the same principles but mag gamit ko ug post sir for challenge and to flex my skills 

//instead of creating a boring portfolio sir I am going to make a portfolio maker with database for your very own photos and infos 

$cann = mysqli_connect('localhost' , 'root' , '' , 'portfolioMaker');
// database ni sir sa phpmyadmin roscodb1 ngan sir 
//btw sir uploaded diay ni nga website sa infinityFree sir free hosting sir recommend use kaayo nako for simple projects that uses php and mysql

if(!$cann){
    die("Connection Failed"); // kani sir if dili naka connect imong device sa atong database sir mo gawas ni instead of error 500 or 404 
}



//kani na line sir para nis server form if naa bay na input ang user isset ba 


//gama ta daan variable to determine if nay kuwang or wala sa imong ge input sir 

$error = ''; //kani ang placeholder if naa kay kuwang sir
$lack = false; //default false sata sir kay wapaman kay ge input

if ($_SERVER['REQUEST_METHOD'] === 'POST') {



//pero instead of isset sir server akong gamit kay it refers to everything 

    if (
        empty($_POST['username']) ||   empty($_POST['bio']) || empty($_POST['school']) || empty($_POST['degree']) ||   
        empty($_POST['skill1']) || empty($_POST['skill2']) || empty($_POST['skill3']) ||    empty($_POST['interest']) ||   empty($_POST['interest2']) || empty($_POST['contact']) ||
        empty($_FILES['profilePfp']['name'])  
    ) {
        $lack = true; // so if naa kay kuwang sir ma true nani siya kay nag kuwang man kas time effort aw 
        $error = 'Sir kuwang imong input lihog ko fill up';
        //if kuwang sir naa tay user feedback ari na mag timan an na kuwang imong ge input sir so disaka pwede mo padayun 
    }

    if(!$lack){
        // kani sir if walay kuwang saimog input sir this means $lack is false and pwede naka mag padayun sa next code block 

        //una nato buhaton sir is kwaon ang imohang inputs using $_POST and ebutang nato sa variables pero sir sa photo sir dili man pwede mo cater ug multimedia ang $_POST so mo gamit ta ug $_FILES para shesh ta sir 

        $pfp = $_FILES['profilePfp']['name'];

        //karun sir atong e butang sa sa temporary variable imong picture before nato e butang sa folder na mo cater sa profile pictires

        $tmpPfp = $_FILES['profilePfp']['tmp_name'];
        
        $folder = "../photo/" . $pfp;

        move_uploaded_file($tmpPfp , $folder); //gikan ni tmp e butang nato sa folder ang path name sa photo na ge enter sa user 

        //now kwaon nanato ang mga inputs using post 
        $username = $_POST['username'];
        $bio = $_POST['bio'];
        $school = $_POST['school'];
        $degree = $_POST['degree'];
        $skill1 = $_POST['skill1'];
        $skill2 = $_POST['skill2'];
        $skill3 = $_POST['skill3'];
        $interest = $_POST['interest'];
        $interest2 = $_POST['interest2'];
        $contact = $_POST['contact'];
        

        //sunod atoa naning e insert ang data sa atong sql table 

        $sql = "INSERT INTO infos (username , bio , school , degree , skill1 , skill2 , skill3 , interest , interest2 , contact, pfp) VALUES
        ('$username'
        ,'$bio',
        '$school',
        '$degree',
        '$skill1',
        '$skill2',
        '$skill3',
        '$interest',
        '$interest2',
        '$contact',
        '$pfp'
        )";
        //after saving sa tanan data inputs sa variable

        mysqli_query($cann , $sql); //atoa ng e query ang tanan value padong sa mysql table na atong ginama

        //now this is the magic sir atong e session ang username arun gamiton sa home php 

        $_SESSION['username'] = $username; 

        //ang value sa username e session nato padong sa home arun pwede siya gamiton as atong reference for the select 


      
//11/13/2026    

//after ma query adto nata sa home.php

header("location: ../home/home.php");
exit(); //same sa javascript pero js is windows.location.href 

}
}






?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Allan THe great</title>
    <link rel="stylesheet" href="../asset/index.css?v=2">

</head>

<div class="hello">

<h2>Hello sir instead of creating a boring portfolio site sir 
    I coded a portfolio generator using $_POST and Simple Mysql and tmp name move photo to flex my skills. Naa ra ang comments and codes nako sir sakong github repository just enter this link sir 
    <br>
    <br>
    <a href="">GitHub nako</a>
    <br>
    <br>
    
    It serves the same aspect of using variables sir so dont worry, anyways please input your details sir. 
    <br><br>
    -allanTheGreat

    
</h2>

<button id="okayBtn">Okay</button>

</div>

<form method="post" enctype="multipart/form-data">
    <h1>Fill up this form sir</h1>
    <p>PS: aybalaka sir akong e delete dayun imong info sa databse</p>
    <h2>choose a profile picture</h2>
    <input type="file" accept="image/*" name="profilePfp">
    <input type="text" name="username" placeholder="Enter your full Name">
    <input type="text" name="bio" placeholder="Enter your bio">
    <input type="text" name="school" placeholder="Enter your School">
    <input type="text" name="degree" placeholder="Enter your degree eksampol BSIT">
    <input type="text" name="skill1" placeholder="Enter skill">
    <input type="text" name="skill2" placeholder="Enter skill 2">
    <input type="text" name="skill3" placeholder="Enter skill 3">
    <input type="text" name="interest" placeholder="Enter hobby">
    <input type="text" name="interest2" placeholder="Enter hobby 2">
    <input type="tel" name="contact" placeholder="Enter contact number">
    <button type="submit">Submit</button>
    <p><?php echo $error; ?></p>
</form>


<body>
    <script src="../src/hello.js"></script>
</body>
</html>