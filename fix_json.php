<?php
$jsonString = file_get_contents('lang/en.json');
$lines = explode("\n", $jsonString);

$seenKeys = [];
$outputLines = [];

foreach ($lines as $line) {
    if (preg_match('/^\s*"([^"]+)"\s*:/', $line, $matches)) {
        $key = $matches[1];
        if (isset($seenKeys[$key])) {
            continue; // Skip duplicate
        }
        $seenKeys[$key] = true;
    }
    $outputLines[] = $line;
}

// Fix trailing commas
for ($i = 0; $i < count($outputLines); $i++) {
    // If this line ends with a comma, check if the next non-empty line is a closing brace
    if (preg_match('/,\s*$/', $outputLines[$i])) {
        $nextValidLine = '';
        for ($j = $i + 1; $j < count($outputLines); $j++) {
            if (trim($outputLines[$j]) !== '') {
                $nextValidLine = trim($outputLines[$j]);
                break;
            }
        }
        if ($nextValidLine === '}') {
            $outputLines[$i] = preg_replace('/,\s*$/', '', $outputLines[$i]);
        }
    }
}

file_put_contents('lang/en.json', implode("\n", $outputLines));
echo "Duplicates removed successfully.\n";
