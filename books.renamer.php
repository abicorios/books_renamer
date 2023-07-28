<?php
$books_directory = trim(readline("Enter the path to the folder with books: "));
echo $books_directory;
echo "\n";
echo "Files: \n";
$files = scandir($books_directory);
$files = array_diff($files, ['.', '..']);
foreach ($files as $file) {
    if (is_file("$books_directory/$file")) {
        echo "$file\n";
    }
}
$delimiter = trim(readline("Enter the delimiter: "));
echo "\n";
$output_directory = trim(readline("Enter the path to the output folder: "));
echo "\n";
if (!is_dir($output_directory)) {
    mkdir($output_directory, 0777, true);
}
foreach ($files as $file) {
    if (is_file("$books_directory/$file")) {
        preg_match('/\d{4}/', $file, $matches);
        if (count($matches) != 1) {
            continue;
        }
        $year = $matches[0];
        $new_file_name = str_replace("$delimiter$year", '', $file);
        $new_file_name = "$year$delimiter$new_file_name";
        echo "$new_file_name\n";
        copy("$books_directory/$file", "$output_directory/$new_file_name");
    }
}
