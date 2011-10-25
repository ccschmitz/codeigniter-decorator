> This place is disgusting.... You need a decorator up in here!

## What It Is

A simple decorator library which allows you to remove a lot of data retrieval from your controllers and unnecessary logic from your views. It gives you one place to retrieve and prep data which drastically cleans up your controllers and views. This means:

* No more mucking up your controllers with calls to your model to retrieve data.
* No more conditionals in your views to see if certain attributes are set or not.

## How It Works

Create the directory `application/decorators` and place a file in there for each data type you want to have a decorator for. Chances are you will want to have a decorator for each model. Make sure to add the `_decorator` extension to the file name.

**File Name:** `application/decorators/user_decorator.php`

Inside the file, add method for retrieving and prepping the data inside of the decorator file.

	class User_decorator extends CI_Decorator {

		public function __construct()
		{
			parent::__construct();

			$this->load->model('user_model');
		}
		
		public function view()
		{
			$this->user_model->find($user_id);
		}
	}

Make a call to the library from your controller, I have been calling it where I load my views:

**Inside the Controller:** `$this->load->view('users/view', $this->decorator->decorate());`

The library will try to guess what decorator you want to call by using the controller and method requested, otherwise you can specify the decorator you want to use in the first parameter of `decorate()` (i.e. `$this->decorator->decorate('users/create')`).