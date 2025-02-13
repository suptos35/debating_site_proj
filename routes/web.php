<?php

use App\Models\Post;
use App\Models\Catagory;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

Route::get('/', function () {
    //posts where parent_id is null with catagory and user
    $posts = Post::whereNull('parent_id')->with('catagory', 'user')->get();

    // $posts = App\Models\Post::whereNull('parent_id')->get();
    return view('home', ['posts' => $posts]);

});

Route::get('/user/{user}', function (User $user) {
    //posts by user where parent_id is null
    $posts = $user->posts()->whereNull('parent_id')->with('catagory', 'user')->get();


    $type = 'User';
    $name = $user->username;
    return view('filter_post', ['user' => $user, 'posts' => $posts, 'type' => $type, 'name' => $name]);
});

Route::get('/catagory/{catagory}', function (Catagory $catagory) {
    //posts by catagory where parent_id is null
    $posts = $catagory->posts()->whereNull('parent_id')->with('catagory', 'user')->get();

    $type = 'Catagory';
    $name = $catagory->name;
    return view('filter_post', ['catagory' => $catagory, 'posts' => $posts, 'type' => $type, 'name' => $name]);
});

Route::get('/index', function () {
    $posts = App\Models\Post::whereNull('parent_id')->get();
    return view('index', ['posts' => $posts]);

});

Route::get('/post/{post}', function (Post $post) {
    $pros = $post->pros;
    $cons = $post->cons;
    return view('points', ['post' => $post, 'pros' => $pros, 'cons' => $cons]);
});

Route::get('/login', function(){
    $error = null;
    $success = null;
    return view('login', ['error' => $error, 'success' => $success]);
});

Route::get('/logout', function(){
    session(['user' => null]);
    return redirect('/');
});

Route::post('/login', function(Request $request){
    $error = null;
    $success = null;
    // dd($request->all());
    $email = $request->input('email');
    // dd($email);
    $password = $request->input('password');
    //check if user exists
    $user = App\Models\User::where('email', $email)->first();
    // dd($user);
    if(!$user){
        $error = 'User not found';
        return view('login', ['error' => $error, 'success' => $success]);
    }
    //check if password is correct
    else if(!Hash::check($password, $user->password)){
        $error = 'Incorrect password';
        return view('login', ['error' => $error, 'success' => $success]);
    }
    //login user
    else{
        session(['user' => $user]);
        $success = 'Login successful';
        return view('login', ['error' => $error, 'success' => $success]);
    }


});

Route::get('/register', function(){
    $errors =[];
    $success = null;
    return view('reg', ['errors' => $errors, 'success' => $success]);
});

Route::post('/register', function(Request $request){
    // dd($request->all());
    $error = null;
    $success = null;
    $email = $request->input('floating_email');
    $password = $request->input('floating_password');
    $repeat_password = $request->input('repeat_password');
    $first_name = $request->input('floating_first_name');
    $username = $request->input('floating_last_name');

    // check for any empty field
    $errors = [];

    if (empty($password) || empty($repeat_password) || empty($first_name) || empty($username)) {
        $errors[] = 'Please fill in all fields';
    }

    //if any record of User with the same email exists, return error
    if(App\Models\User::where('email', $email)->exists()){
        $errors[] = 'Email already exists';
    }
    //if password and repeat password do not match, return error
    if($password != $repeat_password){
        $errors[] = 'Passwords do not match';
    }
    //password must be at least 8 characters long
    if(strlen($password) < 8){
        $errors[] = 'Password must be at least 8 characters long';
    }
    //username unique
    if(App\Models\User::where('username', $username)->exists()){
        $errors[] = 'Username already exists';

    }

    if (!empty($errors)) {
        return view('reg', ['errors' => $errors, 'success' => $success]);
    }


    //create new user
    $user = new App\Models\User();
    $user->email = $email;
    $user->password = $password;
    $user->name = $first_name;
    $user->username = $username;
    $user->save();
    $success = 'User created successfully!';

    return view('reg', ['error' => $error, 'success' => $success]);
});
