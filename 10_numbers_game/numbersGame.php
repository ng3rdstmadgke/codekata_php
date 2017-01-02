<?php
function numbersGame() {
    $hitNum = rand(1, 100);
    while (true) {
        do {
            print "数値を入力してください : ";
            $input = trim(fgets(STDIN));
        } while (ctype_digit($input) === false);
        $input = (int) $input;
        if ($input === $hitNum) {
            printf("あたりです！正解は%sでした！\n", $hitNum);
            break;
        }elseif ($input > $hitNum) {
            printf("%dよりも小さい数字です。\n", $input);
        }elseif ($input < $hitNum) {
            printf("%dよりも大きい数字です。\n", $input);
        }
    }
}

numbersGame();
