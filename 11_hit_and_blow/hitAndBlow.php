<?php
function hitAndBlow($n) {
    // 正解の数値を生成
    $numbers = range(0, 9);
    $hitNum[] = array_splice($numbers, rand(1, 9), 1)[0];
    for ($i = 0; $i < $n - 1; $i++) {
        $hitNum[] = array_splice($numbers, rand(0, count($numbers) - 1), 1)[0];
    }
    printf("答えは%d桁の数値です\n", $n);
    // var_dump($hitNum);

    while (true) {
        // ユーザーの入力
        do {
            printf("数値を入力してください : ");
            $input = trim(fgets(STDIN));
        } while(strlen($input) !== $n || ctype_digit($input) === false);
        $input = str_split($input);

        // 判定
        $judge = [];
        for ($i = 0; $i < $n; $i++) {
            if ((int) $input[$i] === $hitNum[$i]) {
                $judge[] = "hit";
            }elseif (in_array((int) $input[$i], $hitNum, true)) {
                $judge[] = "blow";
            }
        }

        // 結果の出力
        $valueCnt = array_count_values($judge);
        if (isset($valueCnt["hit"]) && $valueCnt["hit"] === $n) {
            printf("あたりです！正解は%sです\n", implode($hitNum));
            break;
        }else {
            if (isset($valueCnt["hit"])) {
                printf("hit:%s, ", $valueCnt["hit"]);
            }
            if (isset($valueCnt["blow"])) {
                printf("blow:%s", $valueCnt["blow"]);
            }
            print "\n";
        }
    }

}
hitAndBlow(3);
