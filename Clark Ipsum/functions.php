<?php

$data = ["PUB", "Canvas", "strategic plan", "academic plan", "audit", "security", "Chime Tower", "Oswald", "Andersen Fountain", "Office of Planning and Effectiveness", "Registrar", "Financial Aid", "administration", "Student Affairs", "Slack", "AA4", "Coffee Lounge", "dean", "academic probation", "Registration", "Admissions", "Bakery", "Office of Instruction", "Scarpelli Hall", "Hanna Hall", "Bauer Hall", "Cannel Library", "CTEC", "CGT", "Foster Hall", "Gaiser", "free pizza", "quarter", "STEPP", "guided pathways", "library", "academic early warning", "bookstore", "advising", "security", "parking lot", "Bauer Hall", "penguins", "penguins Fly", "The Next Step", "athletics", "faculty", "penguin nation", "continuing education", "STEM", "IT", "elearning", "I-BEST", "apply", "music", "engineering", "medical", "The Independent", "Oswald", 'exams', 'quiz', 'Running Start', 'Sam Elliot', 'Archer Gallery', 'art', "Cashier's Office","Business Technology", "English", "Office of the President", "chemistry", 'biology', 'geology', 'Business Technology', 'Business Medical Office', 'Welding', 'Clark College Foundation', 'T Building', 'Dental Hygiene','Disability Support Services', 'Facilities Services', 'Foster Auditorium','midterm','module', 'survey', 'power', 'privilege', 'inequity', 'Frost Art Center', 'quarter', "AA-1", "AA-2", "AA-5", "AA-4", 'Joan Stout Hall', 'Beacock Music Hall', 'Anna Pechanec Hall', 'Hawkins Hall', 'winter', 'fall', 'spring', 'summer', 'Child Care Center', 'T Building', "O'Connell Sports Center", 'Christensen Soccer Field', 'Corporate and Continuing Education', 'Clark College at WSUV', 'Brown House', 'Diesel', 'Automotive', 'Diversity Center', 'Culinary', 'email', 'TechHub', 'eLearning', 'Engineering', 'AA', 'AS', 'AAT', 'BSAM', 'Career Services', 'Teaching and Learning','professor', 'instructor', 'assignment', 'essay', 'open book', 'closed book', 'degree', 'certificate'];

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
