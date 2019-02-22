
<link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>

    <div>
        <?php
            include 'Event.php';
            $eventObj = new Event();

            $eventObj->fetchPosts();

        ?>

    
    </div>


<?php
    require('footer.php');
?>