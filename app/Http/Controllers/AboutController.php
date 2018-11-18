namespace App\Http\Controllers;

use App\Http\Request\ContactFormRequest;
use Illuminate\Http\Request;

class AboutController extends Controller {

  public function store(Request $request)
  {

    $contact = [];

    $contact['name'] = $request->get('name');
    $contact['email'] = $request->get('email');
    $contact['msg'] = $request->get('msg');

    // Mail delivery logic goes here
	Mail::to(config('mail.support.address'))->send(new ContactEmail($contact));

    flash('Your message has been sent!')->success();

    return redirect()->route('contact.create');

  }

}
