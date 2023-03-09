<?php 
include('db.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat App</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function aj(){
            var req=new XMLHttpRequest();
            req.onreadystatechange=function(){
                if(req.readyState==4 && req.status==200){
                    document.getElementById('chat').innerHTML=req.response;
                }
            }
            req.open('POST','chat.php',true);
            req.send();
        }
        setInterval(function() {aj()},1000);
    </script>
</head>
<body onload="aj();">
    <div id="container">
        <div id="chat_box">
            <div id="chat">

            </div>
            <?php 
                $query="SELECT * FROM chat ORDER BY id DESC";
                $run=mysqli_query($con,$query);
                while($row=mysqli_fetch_array($run)){
                $name=$row['name'];
                $msg=$row['msg'];
                $date=$row['date'];
            ?>
            <div id="chat_data">
                <span  style="color:#4E31AA"><?php echo $name ?></span>
                <span>: </span>
                <span><?php echo $msg ?></span>
                <span style="float: right; color:#4E31AA"><?php echo $date ?></span>
            </div>
            <?php  } ?>
        </div>
        <form action="index.php" method="POST">            
            <input type="text" name="name" id="input" placeholder="enter your name">
            <textarea name="msg" placeholder="enter your massege"></textarea>
            <button name="submit"><span id="text">send</span></button>
        </form>
        <?php
            if(isset($_POST['submit'])){
                $name=$_POST['name'];
                $msg=$_POST['msg'];
                $insert="insert into chat (name,msg) values ('$name','$msg')";
                $run_insert=mysqli_query($con,$insert);
                header('location:index.php');
            }
        ?>
    </div>
</body>
</html>