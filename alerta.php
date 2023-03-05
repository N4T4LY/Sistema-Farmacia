<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
<!-- <link rel="stylesheet" type="text/css" href="../css/css/style.css">
<link rel="stylesheet" type="text/css" href="../css/css/all.min.css"> -->
 <!-- Theme style -->
 <!-- <link rel="stylesheet" href="../css/css/adminlte.min.css">  -->  
<title></title>
</head>
<body>

  <p hidden>La sesion expira en:&nbsp;</p><div id="number" class="text-danger"></div>


<script type="text/javascript">
    n=100
    var l = document.getElementById('number');
    var id= window.setInterval(function(){
        document.onmousemove=function(){
            n=100
        };
        l.innerText=n;
        n--;
        if(n<=-1){
            alert("la sesion expiro")
            location.href="../controlador/logout.php"

        }

    },1200);

</script>
</body>
</html>
