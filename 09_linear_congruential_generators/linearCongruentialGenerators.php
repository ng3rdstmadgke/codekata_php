<?php
$x = 12345;
$ave = 0;
for ($i = 0; $i < 100; $i++) {
    $ave += $x / 100000;
    $x = (997 * $x + 1) % 65536;
    printf($x / 100000 . " ");
    if ($i !== 0 && $i % 10 === 0) {
        print "\n";
    }
}
print "\n";
printf("ave = %f\n", $ave / 100);
