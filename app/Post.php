class Post extends Model 
{
  public static $rules = [
        'title' => ['required'],
        'body' => ['required', 'min:10']
    ];
}
