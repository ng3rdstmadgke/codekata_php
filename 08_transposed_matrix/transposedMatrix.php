<?php
function transposedMatrix(array $matrix): array {
    $matrixLength = count($matrix);
    $elementLength = count($matrix[0]);
    $retMatrix = [];
    for ($i = 0; $i < $elementLength; $i++) {
        $retElem = [];
        for ($j = 0; $j < $matrixLength; $j++) {
            $retElem[] = $matrix[$j][$i];
        }
        $retMatrix[] = $retElem;
    }
    return $retMatrix;
}

function printMatrix(array $matrix) {
    foreach ($matrix as $arr) {
        foreach ($arr as $num) {
            print "{$num} ";
        }
        print "\n";
    }
}

$sample = [[1,2,3],
           [4,5,6],
           [7,8,9]];
printMatrix(transposedMatrix($sample));
