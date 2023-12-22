<?php

// The ErrorController file/class is gonna be autoloaded because it's in the App namespace
// and the App namespace is registered in the composer.json file
namespace App\Controllers;

// Use the ErrorController class to handle errors in the Router.php file
// use App\Controllers\ErrorController;
// ErrorController::notFound();
class ErrorController
{
  /*
   * 404 not found error
   * 
   * @return void
   */
  // pass in a message and a default message to display on the error page
  // https://stackoverflow.com/questions/45109062/php-static-methods-vs-non-static-methods-standard-functions/45111144#45111144
  public static function notFound($message = 'Resource not found')
  {
    http_response_code(404);

    loadView('error', [
      'status' => '404',
      'message' => $message
    ]);
  }

  /*
   * 403 unauthorized error
   * 
   * @return void
   */
  public static function unauthorized($message = 'You are not authorized to view this resource')
  {
    http_response_code(403);

    loadView('error', [
      'status' => '403',
      'message' => $message
    ]);
  }
}
