<?php

namespace App\Helper;

class TerminalHelper
{
    static function inputString(?string $info): string
    {
        echo "$info ";
        $result = fgets(STDIN);
        return trim($result);
    }

    static function askForNumberInput(string|null $sentence = null): int
    {
        if ($sentence != null) {
            echo $sentence;
        }
        $input = trim(fgets(STDIN));
        if (is_numeric($input)) {
            return (int)$input;
        }
        return -1;
    }

    static function askForOrdinalNumber(array $array, string $sentence): int
    {
        while (true) {
            echo $sentence;
            $input = self::askForNumberInput();
            if ($input > count($array) || $input <= 0) {
                echo "Select an available number" . PHP_EOL;
            } else {
                return $input;
            }
        }
    }

    static function pressEnterToContinue()
    {
        TerminalHelper::inputString("press ENTER to continue");
    }

    static function isThisWindows(): bool
    {
        return strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';
    }

    static function clearScreen()
    {
        if (TerminalHelper::isThisWindows()) {
            pclose(popen('cls', 'w'));
        } else {
            system('clear');
        }
    }

    static function confirmYesNo(string $message): bool
    {
        while (true) {
            $confirm = TerminalHelper::inputString($message);
            if ($confirm == "y") {
                return true;
            } elseif ($confirm == "n") {
                return false;
            }
        }
    }
}