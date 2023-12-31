    <?php 

    use src\Model\Stock; 

    if(isset($_POST['name'])){
        $name = $_POST['name'];
        if(!Stock::exists($name)){
            $stock = new Stock($name); 

            if($stock->isStockReal()){
                $stock->save();
            }
        }
    }


    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="src/resources/main.css">
        <title>Home | Stock App</title>
    </head>

    <body>
        <div class="container">
            <h1>Stocks</h1>
            <form action="" method="POST">
                <input type="text" name="name">
                <input type="submit" value="Add Stock">
            </form>
            <div class="stocks">
                <?php
                    $stocks =  Stock::getAll();
                    foreach ($stocks as $stock):
                ?>
                <div class="stock">
                    <div> <?= $stock->getTicker() ?></div>
                    <div> <?= $stock->getName() ?></div>
                    <div> <?= $stock->getStock()->lastPrice ?></div>
                </div>
                <?php endforeach ?>

            </div>
        </div>

    </body>

    </html>