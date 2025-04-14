 <?php

// use Illuminate\Http\Request;

// define('LARAVEL_START', microtime(true));

// // Determine if the application is in maintenance mode...
// if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
//     require $maintenance;
// }

// // Register the Composer autoloader...
// require __DIR__.'/../vendor/autoload.php';

// // Bootstrap Laravel and handle the request...
// (require_once __DIR__.'/../bootstrap/app.php')
//     ->handleRequest(Request::capture());

  use Illuminate\Http\Request;
  use Illuminate\Database\QueryException;
  
  define('LARAVEL_START', microtime(true));
  
  // Kiểm tra chế độ bảo trì...
  if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
      require $maintenance;
  }
  
  // Nạp autoloader của Composer...
  require __DIR__.'/../vendor/autoload.php';
  
  // Khởi động Laravel và xử lý yêu cầu...
  try {
      (require_once __DIR__.'/../bootstrap/app.php')
          ->handleRequest(Request::capture());
  } catch (QueryException $e) {
      if (str_contains($e->getMessage(), 'Connection refused')) {
          die('Kết nối cơ sở dữ liệu thất bại. Vui lòng kiểm tra cấu hình cơ sở dữ liệu.');
      }
      throw $e;
  }
