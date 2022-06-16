<?php
//Question No 1: kpc error?bez ":" nedrīkst? =>  ($c !== 0) ? $coins = $coins . "$c";
//Question No 2: vai ir komanda, ar kuru pēc IF var aizsūtīt uz citu command line?
//Question No 3: mazas problēmas ar tipu pārejām (piemēram: array-string-int) ...

function changeInCoins($amount) {
    $coinType = [200,100,50,20,10,5,2,1];
    $coins = "";
    do {
        for ($i=0; $i<count($coinType); $i++) {
            $c = floor(($amount / $coinType[$i]));
            $coins = $coins . "$c";
            $amount = $amount - ($c * $coinType[$i]);
        }
    }
    while ($amount === 0);
    $newArr = str_split($coins);
    return $result = array_combine($coinType,$newArr);

}

function balance($reminder, $coins) {
    foreach ($coins as $coin => $amount) {
        $returnedCoinAmount = intdiv($reminder, $coin);
        $coins[$coin] +=$returnedCoinAmount;
        $reminder -=$returnedCoinAmount * $coin;
    }
    return $coins;
}

$items =
    [
    "BlackCoffee" => 55,
    "WhiteCoffee" => 58,
    "HotWater" => 20,
    "Lemon Tea" => 45,
    "Vodka" => 300
    ];

//echo $items[key($items)];
//echo $items["BlackCoffee"] . PHP_EOL;
$wallet =
    [
        200 => 3,
        100 => 3,
        50 => 3,
        20 => 3,
        10 => 3,
        5 => 3,
        2 => 3,
        1 => 3,
    ];

$No=0;
echo "CoffeeMachine menu:" . PHP_EOL;
foreach ($items as $item => $amount)
    {
    $No+=1;
    echo "$No => [$item - $amount cents]" . PHP_EOL;
    }

echo PHP_EOL;

$insertedAmount = 0;
$moneyLeft = 0;
echo "Your wallet balance: " . PHP_EOL;
foreach ($wallet as $coin => $amount)
    {
    echo "[$coin cent coin x ($amount)]" . PHP_EOL;
    }

echo PHP_EOL;

$chosenItem = readline("Choose product: [1-5]");
    switch ($chosenItem) {
        case 1:
            $chosenItem = "BlackCoffee";
                break;
        case 2:
            $chosenItem = "WhiteCoffee";
            break;
        case 3:
            $chosenItem = "HotWater";
            break;
        case 4:
            $chosenItem = "Lemon Tea";
            break;
        case 5:
            $chosenItem = "Vodka";
            break;
        }

$productPrice = $items["$chosenItem"] ;

echo "You choose: " . $chosenItem . ", which costs: " . $productPrice . "cents" . PHP_EOL;

while (true) {
    $coinsInserted = readline("Please insert coins 1/2/5/10/20/50/100/200, to confirm & finnish input `buy`: ");
    if ($coinsInserted === "buy")
    {

        if ($insertedAmount < $productPrice)
        {
            echo "Not enough money inserted!" . PHP_EOL;
            continue;
        }

        $moneyLeft = $insertedAmount - $productPrice;
        echo PHP_EOL;
        echo "Thank you for your purchase! Your CHANGE: " . $moneyLeft . " cents" . PHP_EOL;
        foreach (changeInCoins($moneyLeft) as $coin => $amount)
        {
            if ($amount !== "0") {
            echo "[$coin cent coin x ($amount)]" . PHP_EOL;
            }
        }
//        print_r(changeInCoins($moneyLeft));
        echo "NEW BALANCE:" . PHP_EOL;
        $balance= balance($moneyLeft, $wallet);
        foreach ($balance as $coin => $amount)
        {
            echo "[$coin cent coin x ($amount)]" . PHP_EOL;
        }

        exit;
    }


         if (!isset($wallet[$coinsInserted]))
         {
         echo "Invalid coin." . PHP_EOL;
         continue;
         };

         if ($wallet[$coinsInserted]<=0)
         {
             echo "You dont have such a coin" . PHP_EOL;
             continue;
         };

    $wallet[$coinsInserted] -= 1;
    $insertedAmount += $coinsInserted;

    echo "Inserted amount: ". $insertedAmount . PHP_EOL;

}
