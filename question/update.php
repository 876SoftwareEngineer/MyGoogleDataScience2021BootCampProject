 <?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/question.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare question object
$question = new Question($db);
  
// get id of question to be edited
$data = json_decode(file_get_contents("php://input"));
 






  
// set ID property of question to be edited
$question->id = $data->id;
  
// set question property values
$question->variable_name = $data->variable_name;
$question->question_text = $data->question_text;
$question->category_id = $data->category_id;
  
// update the question
if($question->update()){
  
    // set response code - 200 ok
    http_response_code(200);
  
    // tell the user
    echo json_encode(array("message" => "The question was updated."));
}
  
// if unable to update the question, tell the user
else{
  
    // set response code - 503 service unavailable
    http_response_code(503);
  
    // tell the user
    echo json_encode(array("message" => "Unable to update that question."));
}
?>
