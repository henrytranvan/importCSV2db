<?php

// Loop throuth 1 to 100.
for ($i = 1; $i <= 100; $i++) {
    $output = $i;
    // The number is divisible by three
    if ($i % 3 == 0)
        $output = 'foo';
    if ($i % 5 == 0) {
        // The number is divisible by three and five.
        if ($output === 'foo') {
            $output = 'foobar';
        } // The number is divisible by five
        else {
            $output = 'bar';
        }
    }
    // Print output.
    echo $output;
    // Print comma.
    if ($i < 100) {
        echo ',';
    }
}
