<?php
/**
* userTurn : ユーザーが標準入力から単語を入力する。単語が$wordsDictにない場合はやり直し。
* cpuTurn : $usedWordsの最後の単語の末尾の文字を頭文字とする単語を$wordsDictから検索する。
* useWord : $wordsDictから$wordを削除し、$usedWordsに$wordを追加する
* judge : ゲームが続行可能か判断する。判断基準は
*         1. 単語の頭文字が直前の単語の末尾の文字と等しいか。
*         2. 単語が$usedWordsに入っていないか
*         3. 単語の末尾の文字から始まる単語が$wordsDictにあるか
*
*/
class WordChain {
    private $usedWords;
    private $originDict;
    private $wordsDict;
    private $word;
    private $turn;

    public function __construct() {
        $fileContents = file_get_contents("word.txt");
        $this->usedWords = [];
        $this->originDict = array_slice(explode("\n", $fileContents), 0, -1);
        $this->wordsDict = array_slice(explode("\n", $fileContents), 0, -1);
        $this->word = '';
        $this->turn = rand(0, 1); // 0 : USER先攻, 1 : CPU先攻
    }

    /*
    * ユーザーが単語を入力する。
    */
    public function userTurn() {
        while (true) {
            print "USER : ";
            $input = trim(fgets(STDIN));
            if (in_array($input, $this->originDict) === false) {
                print "この単語は辞書に存在しない単語です。入力しなおしてください。\n";
                continue;
            }
            break;
        }
        $this->word = $input;
    }

    /*
    * CPUが単語を入力する
    */
    public function cpuTurn() {
        if (count($this->usedWords) > 0) {    // 通常
            $end = substr($this->usedWords[count($this->usedWords) - 1], -1);
            $indexList = [];
            foreach ($this->wordsDict as $k=>$v) {
                if ($end === substr($v, 0, 1)) {
                    $indexList[] = $k;
                }
            }
            $this->word = $this->wordsDict[$indexList[array_rand($indexList, 1)]];
            printf("CPU : %s\n", $this->word);
        }else {                                 // CPUが先攻かつ最初のターン
            $this->word = $this->wordsDict[array_rand($this->wordsDict, 1)];
            printf("CPU : %s\n", $this->word);
        }
    }

    /*
    * 入力された単語がしりとりのルールに反さないか判定する。
    */
    public function judge(): array {
        // 一番初めのターンは無条件で続行可能
        if (count($this->usedWords) === 0) {
            return [1, 0];
        }
        // 1. 単語の頭文字が直前の単語の末尾の文字と等しいか。
        if (substr($this->word, 0, 1) !== substr($this->usedWords[count($this->usedWords) - 1], -1)) {
            return [2, 0];
        }
        // 2. 単語が$usedWordsに入っていないか
        if (in_array($this->word, $this->usedWords)) {
            return [3, array_search($this->word, $this->usedWords)];
        }
        // 3. 単語の末尾の文字から始まる単語が$wordsDictにあるか
        $flg = false;
        foreach ($this->wordsDict as $v) {
            if (substr($this->word, -1) === substr($v, 0, 1)) {
                $flg = true;
                break;
            }
        }
        if ($flg === false) {
            return [4, 0];
        }
        // 4. 続行可能な場合
        return [1, 0];

    }

    /*
    * judge()の戻り値を元にメッセージを生成する。
    */
    public function createMessage(array $judge) {
        $wordsCnt = count($this->usedWords) + 1;
        if ($judge[0] === 2) {
            return sprintf("しりとりのルール違反です。 CPU の勝ちです。今回のしりとりでは %d 個の単語を使用しました。\n", $wordsCnt);
        }elseif ($judge[0] === 3) {
            $player;
            if ($judge[1] % 2 === 0 && $this->turn === 0) {
                $player = "USER";
            }elseif ($judge[1] % 2 === 0 && $this->turn === 1) {
                $player = "CPU";
            }elseif ($judge[1] % 2 === 1 && $this->turn === 0) {
                $player = "CPU";
            }else {
                $player = "USER";
            }
            return sprintf("その言葉は %d 回目に %s が使用しています。 CPU の勝ちです。今回のしりとりでは %d 個の単語を使用しました。\n", $judge[1] + 1, $player, $wordsCnt);
        }else {
            return sprintf("まいりました！ USER の勝ちです。　今回のしりとりでは %d 個の単語を使用しました。\n", $wordsCnt);
        }
    }

    public function useWord() {
        $this->usedWords[] = $this->word;
        foreach ($this->wordsDict as $k=>$v) {
            if ($v === $this->word) {
                array_splice($this->wordsDict, $k, 1);
                break;
            }
        }
    }

    /*
    * しりとりを実行
    */
    public function main() {
        $cnt = 1;
        if ($this->turn === 1) {
            $cnt++;
            print "CPUが先攻です";
            fgets(STDIN);
        }else {
            print "USERが先攻です";
            fgets(STDIN);
        }
        while (true) {
            if ($cnt % 2 === 0) $this->cpuTurn();
            else $this->userTurn();
            $j = $this->judge();
            if ($j !== [1, 0]) {
                $message = $this->createMessage($j);
                print($message);
                break;
            }
            $this->useWord();
            $cnt++;
        }
    }
}

// main
$ins = new WordChain();
$ins->main();
