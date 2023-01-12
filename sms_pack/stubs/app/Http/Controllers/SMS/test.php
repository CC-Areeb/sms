<?php

class AutomatedTesting
{
    /**
     * Run automated tests on the project
     *
     * @return void
     */
    public function runTests()
    {
        // Use PHPUnit to run the tests
        $command = 'vendor/bin/phpunit';
        exec($command, $output, $return);

        // Check the output for any errors or failures
        $errors = false;
        foreach ($output as $line) {
            if (strpos($line, 'Error') !== false || strpos($line, 'Failure') !== false) {
                $errors = true;
                break;
            }
        }

        // Respond to the user with the results of the tests
        if ($errors) {
            echo "Tests failed. Please check the output for more information.\n";
        } else {
            echo "Tests passed.\n";
        }
    }

    /**
     * Check for any third-party scripts in the project
     *
     * @return void
     */
    public function checkThirdPartyScripts()
    {
        // Get a list of all files in the project
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(base_path()));

        // Search for any third-party scripts in the files
        $thirdPartyScripts = [];
        foreach ($files as $file) {
            if ($file->isFile()) {
                $contents = file_get_contents($file->getRealPath());
                if (strpos($contents, '//example.com') !== false || strpos($contents, 'http://example2.com') !== false) {
                    $thirdPartyScripts[] = $file->getRealPath();
                }
            }
        }

        // Respond to the user with the results of the check
        if (count($thirdPartyScripts) > 0) {
            echo "Third-party scripts detected in the following files:\n";
            foreach ($thirdPartyScripts as $script) {
                echo $script . "\n";
            }
        } else {
            echo "No third-party scripts detected.\n";
        }
    }
}

