<?php

$data = ["PUB", "canvas", "registrar", "financial aid", "administration", "student affairs", "slack", "AA4", "coffee lounge", "dean", "academic probation", "registration", "admissions", "Scarpelli Hall", "Hanna Hall", "Bower Hall", "Cannel Library", "CTEC", "CGT", "foster hall", "gaiser", "free pizza", "quarter", "STEPP", "guided pathways", "library", "academic early warning", "bookstore", "advising", "security", "parking lot", "bauer", "cannell", "penguins", "penguins fly", "next step", "athletics", "faculty", "penguin nation", "continuing education", "STEM", "IT", "elearning", "ibest", "apply", "music", "engineering", "medical", "the independent", "oswald", 'testing', 'running start', 'Sam Elliot'];

function randChar($input)
{
    $i = random_int(0, count($input) - 1);
    $randChar = $input[$i];
    if (is_array($randChar)) {
        $i = random_int(0, count($randChar) - 1);
        randChar($randChar);
        return (string) $randChar[$i];

    } else {
        return (string) $randChar;
    }
}

function generateSentence($data)
{
    $sentence = [];
    $sentenceLength = random_int(8, 12);
    $output = "";
    while (count($sentence) < $sentenceLength) {
        array_push($sentence, randChar($data));
    }

    foreach ($sentence as $word) {
        $output .= $word . " ";
    }
    return ucfirst(trim($output, " ") . ". ");

}

function generateParagraph($data)
{
    $paragraph = [];
    $paragraphs = [];
    $paragraphLength = random_int(5, 8);
    $output = "";
    while (count($paragraph) < $paragraphLength) {
        array_push($paragraph, generateSentence($data));
    }
    foreach ($paragraph as $data) {
        $output .= $data;
    }
    return $output;
}

function generateParagraphs($data, $paraCount = 1)
{
    $paragraphs = [];
    $output = [];
    while ($paraCount > 0) {
        array_push($paragraphs, generateParagraph($data));
        $paraCount = $paraCount - 1;
        array_push($output, $paragraphs);

    }
    $output = ['result' => $paragraphs];
    return json_encode($output);
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // var_dump($_POST);
    if (isset($_GET['paraNumber'])) {
        $paraNumber = $_GET['paraNumber'];
    }
    if ($paraNumber != '') {
        header("Access-Control-Allow-Origin: *");
        echo generateParagraphs($data, $paraNumber);
    }
}
