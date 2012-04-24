<?php
function getHttpData(){
  if (isset($_SERVER['REQUEST_URI']) && isset($_SERVER['REQUEST_METHOD'])
  		&& isset($_SERVER['QUERY_STRING'])
  		&& isset($_SERVER['CONTENT_LENGTH']) && $_SERVER['CONTENT_LENGTH'] > 0)
    {
      $requestData = '';
      $httpContent = fopen('php://input', 'r');
      while ($data = fread($httpContent, 1024))
          $requestData .= $data;
      fclose($httpContent);
      return trim($requestData);
    }
  return NULL;
}
$response["url"]    = $_SERVER['REQUEST_URI'];
$response["method"] = (isset($_SERVER['REQUEST_METHOD']))
                          ? $_SERVER['REQUEST_METHOD'] : 'GET';
$response["body"] = getHttpData();
header('Content-Type: application/json');
echo json_encode($response);
?>