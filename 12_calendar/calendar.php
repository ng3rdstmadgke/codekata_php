<?php
/*
* [カレンダークラス]
* 1) 仕様
*   - 1582年以降(グレゴリオ暦制定の翌年)から採用
*
* 2) 処理
*   1.その月の日数を求める
*       - うるう年かどうかの判定
*   2. その月が何曜日から始まるか
*       - ツェラーの公式
*/
class Calendar {
    // 求める年
    private static $year;

    // 求める月
    private static $month;

    // うるう年かどうか(bool)
    private static $isLeap;

    // 求める月の日数
    private static $days;

    // 曜日(日:0, 月:1, ... 土:6)
    private static $dayOfWeek;

    // 月の日数リスト
    private static $monthDays = [
        1=>31,
        2=>28,
        3=>31,
        4=>30,
        5=>31,
        6=>30,
        7=>31,
        8=>31,
        9=>30,
        10=>31,
        11=>30,
        12=>31
    ];

    public function __construct() {

    }

    // メイン
    public static function calendar($year, $month) {
        self::$year = $year;
        self::$month = $month;
        if (self::isLeap() === true && $month === 2) {
            self::$days = self::$monthDays[2] + 1;
        }else {
            self::$days = self::$monthDays[$month];
        }
        self::dayOfWeek();
        self::printCalendar();

    }

    // うるう年の判定を行う
    private static function isLeap(): bool {
        if (self::$year % 400 === 0) {
            return true;
        }elseif (self::$year % 100 === 0){
            return false;
        }elseif (self::$year % 4 === 0) {
            return true;
        }else {
            return false;
        }
    }

    // 入力年月の1日の曜日の算出を行う(日:0, 月:1, ... 土:6)
    private static function dayOfWeek() {
        if (self::$month === 1 || self::$month ===2) {
            $y = self::$year - 1;
            $m = self::$month + 12;
        }else {
            $y = self::$year;
            $m = self::$month;
        }
        self::$dayOfWeek = ($y + floor($y / 4) - floor($y / 100) + floor($y / 400) + floor((13 * $m + 8) / 5) + 1) % 7;
    }

    // カレンダーを表示する
    private static function printCalendar() {
        $header = sprintf(" %13s/%-13s\n", self::$year, self::$month);
        $header .= " Sun Mon Tue Wed Thu Fri Sat\n";
        $body = str_repeat("    ", self::$dayOfWeek);
        for ($i = 1; $i <= self::$days; $i++) {
            $body .= sprintf("%4s", $i);
            if (($i + self::$dayOfWeek) % 7 === 0) {
                $body .= "\n";
            }
        }
        print $header . $body . "\n";
    }
}

for ($i = 1; $i <= 12; $i++) {
    Calendar::calendar(2017, $i);
}
