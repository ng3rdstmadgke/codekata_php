<?php
$n = 15;
for ($i = 1; $i <= $n; $i++){
    if ($i % 3 == 0)
        print "Fizz";
    if ($i % 5 == 0)
        print "Buzz";
    if ($i % 3 != 0 && $i % 5 != 0)
        print $i;
    print "\n";
}
