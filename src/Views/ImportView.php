<?php

namespace ImportUser\Csv\Views;

/**
 * Class ImportView
 * @package ImportUser\Csv\Views
 */
class ImportView {
    /**
     * Display output.
     * @param array $messages
     */
    public function output(array $messages)
    {
        if ($messages['status']) {
            echo str_pad('', 80, "*");
            printf("\nStatus:\n");
            $this->printMessages($messages['status']);
        }
        if ($messages['error']) {
            echo str_pad('', 80, "*");
            printf("\nError:\n");
            $this->printMessages($messages['error']);
        }
    }

    /**
     * Send out put to STDOUT.
     *
     * @param array $message
     */
    protected function printMessages(array $messages)
    {
        foreach ($messages as $message) {
            printf("  $message\n");
        }
    }
}
