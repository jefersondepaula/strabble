<?php

use Src\Boot;
use Src\Engine\Dictionary\Dictionary;
use Src\Engine\Scrabble;

$list = [];

if(isset($_GET["rack"])) :
    $rack = $_GET["rack"];
    filter_input(INPUT_GET,$rack,FILTER_SANITIZE_STRING);    

    require_once 'Src/Boot.php';

    $boot = new Boot();

    $dictionary = new Dictionary($boot);

    $scrabble = new Scrabble($dictionary);

    $list = $scrabble->matchInDictionary($rack);
endif;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Scrabble Dic</title>
</head>
<body class="grid-container">
    <header>
        <div class="title-area flex-center">
            <h1>Scrabble Game</h1>
        </div>        
    </header>
    <main>
        <section class="form-area">
            <div class="form-title">
                <div class="container flex-center">                
                    <h2>Find all word possibilities</h2>                    
                </div> 
            </div> 
            <div class="container">
                <div class="form-search">
                    <div class="form-input-area flex-center">
                        <h2>Letters in your rack!</h2>
                        <form method="GET">
                            <input type="search" name="rack" id="" placeholder="Your Word Here!!"><br>
                            <input class="button" type="submit" value="GO">
                        </form>
                    </div>
                    <div class="form-result-info flex-center">
                        <?php if(isset($_GET['rack']) || (count($list)>0)) :?>
                            <h2 class="form-result-word"><?php echo $_GET['rack']? "Your word is ". $_GET['rack'] : "Your word is..."; ?>!!</h2>
                            <h2 class="form-result-total"><?php echo (count($list)>0)? "Found ".count($list)." Results." : "" ?></h2>   
                        <?php else: ?>
                            <h2 class="form-result-word">Your word is...!!</h2>
                            <h2 class="form-result-total"></h2>  
                        <?php endif; ?>                    
                    </div>                
                </div>                           
            </div>
            <?php if(count($list)>0): ?>
                <div class="results">
                    <div class="container">                        
                        <div class="result-count flex-center">                        
                            <h2>Found <?php echo count($list)?> possibilities</h2>
                        </div>                
                    </div>
                </div>
                <div class="result-list">
                    <ul>
                        <?php foreach($list as $key=>$value):?>
                            <li>
                                <div class="list-item container flex-center">
                                    <?= $key; ?><span><?=$value?> - PTS</span>
                                </div>                                
                            </li>
                        <?php endforeach;?>
                    </ul>
                </div> 
            <?php endif;?>
        </section>                  
    </main>    
    <script src="assets/js/script.js"></script>
</body>
</html>