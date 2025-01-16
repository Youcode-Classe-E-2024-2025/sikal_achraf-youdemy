# App Class Documentation

## Overview
The `app` class is a core component of an MVC (Model-View-Controller) architecture. It is responsible for routing requests by parsing the URL, identifying the appropriate controller and method, and executing the requested functionality with optional parameters.

---

## Class Structure

### Properties
- **`$controller`** *(protected)*: Default controller set to `_404`. This is used when the requested controller is not found.
- **`$method`** *(protected)*: Default method set to `index`. This method is executed if no specific method is provided in the URL.

### Methods
- **`__construct()`**: The constructor handles the routing logic by:
  1. Parsing the URL.
  2. Determining the controller and method.
  3. Dynamically calling the appropriate controller and method with any URL parameters.

- **`geturl()`** *(private)*: Retrieves and sanitizes the URL from the query string. Returns the URL segments as an array.

---

## How It Works
1. **Parse the URL**: The URL is retrieved and split into an array of segments.
   - The first segment is treated as the controller name.
   - The second segment is treated as the method name.
   - Any remaining segments are passed as parameters to the method.

2. **Controller Selection**:
   - If the specified controller file exists, it is loaded, and the controller is set.
   - If the file does not exist, the default `_404` controller is used.

3. **Method Selection**:
   - The method is determined based on the second URL segment.
   - If the method exists in the selected controller, it is set; otherwise, the default `index` method is used.

4. **Dynamic Invocation**:
   - The specified method is called on the controller object with any remaining URL segments as parameters.

---

## URL Structure
The routing system interprets the URL in the following format:

```
http://yourdomain.com/{controller}/{method}/{param1}/{param2}/...
```

### Example URLs
1. **Default**
   ```
   http://yourdomain.com/
   ```
   - Controller: `home`
   - Method: `index`

2. **Custom Controller and Method**
   ```
   http://yourdomain.com/user/profile
   ```
   - Controller: `User`
   - Method: `profile`

3. **Method with Parameters**
   ```
   http://yourdomain.com/product/view/123
   ```
   - Controller: `Product`
   - Method: `view`
   - Parameters: `123`

---

## Code Walkthrough

### Constructor
```php
function __construct() {
    $arr = $this->geturl();
    $filename = "../app/controller/".ucfirst($arr[0]).".php";
    if(file_exists($filename)) {
        require $filename;
        $this->controller = $arr[0];
        unset($arr[0]);
    } else {
        require "../app/controller/".$this->controller.".php";
    }

    $myController = new $this->controller();
    $myMethod = $arr[1] ?? $this->method;
    if (!empty($arr[1])) {
        if (method_exists($myController, strtolower($myMethod))) {
            $this->method = strtolower($myMethod);
            unset($arr[1]);
        }
    }

    $arr = array_values($arr);
    call_user_func_array([$myController, $this->method], $arr);
}
```

### URL Parsing
```php
private function geturl() {
    $url = $_GET['url'] ?? 'home';
    $url = filter_var($url, FILTER_SANITIZE_URL);
    $arr = explode('/', $url);
    return $arr;
}
```

---

## Key Features
- **Dynamic Routing**: Automatically maps URL segments to controllers, methods, and parameters.
- **Default Fallbacks**: Uses `_404` controller and `index` method if none are specified or found.
- **Sanitized URLs**: Ensures the URL is safe and free from invalid characters.
- **Flexible Parameters**: Supports passing multiple parameters through the URL.

---

## Example Usage
### File Structure
```
/app
    /controller
        Home.php
        User.php
        _404.php
```

### `Home.php`
```php
class Home {
    public function index() {
        echo "Welcome to the homepage!";
    }

    public function about() {
        echo "This is the about page.";
    }
}
```

### `User.php`
```php
class User {
    public function profile($id) {
        echo "User profile for ID: $id";
    }
}
```

### `_404.php`
```php
class _404 {
    public function index() {
        echo "404 - Page not found.";
    }
}
```

---

## Notes
- Ensure that controllers are named properly and placed in the `controller` directory.
- All methods in controllers should be public.
- Use meaningful URL segments to enhance usability and SEO.

---

## License
This project is open-source and available for modification and distribution.
