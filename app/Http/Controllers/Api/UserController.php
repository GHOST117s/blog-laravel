<?php
namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Comment;
use App\Models\Post;



class UserController extends Controller
{
    //
    public function register(Request $request){
        // echo"<pre>";
        // print_r($request->all());
        // dd("msg");
        $validateData = $request->validate([
            'name' => 'required',
            'email' => ['required','email'],
            'password' => ['min:8','confirmed'],
         
        ]);

        $validateData['password'] = bcrypt($request->password);
        $user = User::create($validateData);

        // echo "<pre>";
        // print_r($user);
        $token = $user->createToken('auth_token')->accessToken;
        
        return response()->json(
            [
                'token' => $token,
                'user' => $user,
                'message' =>"User created successfully",
                'status' => 1
            ]
            );
          
           
    }
    public function login(Request $request)
    {
        $validateData = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        
        $user = User::where('email', $validateData['email'])->first();
        
        if (!$user) {
            return response()->json(['message' => 'Email not found', 'status' => 0]);
        }
        
        if (!Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid password', 'status' => 0]);
        }
        
        $token = $user->createToken('auth_token')->accessToken;

          // Create a post after successful login
        $post = $user->posts()->create([
        'title' => $request->title,
        'body' => $request->body
    ]);


        return response()->json([
            'token' => $token,
            'user' => $user,
            'post' => $post,
            'message' => "Login successful post sucessfully ",
            'status' => 1
        ]);
    }
    







//     public function login(Request $request){
//         $validateData = $request->validate([
//             'email'=>['required','email'],
//             'password'=>['required']
//         ]);
//         $user = User::where(['email' => $validateData['email'], 'password' => $validateData['password']])->first();
//             if (!$user) {
//             return response()->json(['message' => 'Email not found', 'status' => 0]);
// }
//         $token = $user->createToken('auth_token')->accessToken;
//         return response()->json([
//            'token' => $token,
//              'user' => $user,
//                 'message' => "login",
//                  'status' => 1
// ]);
//         // echo '<pre>';
//         // print_r($user);
//     }
    public function getUser($id){
        $user = User::find($id);
        if(is_null($user)){
            return response()->json(
                [
                  
                    'user' => null,
                    'message' =>"User Not found",
                    'status' => 0
                ]
                );
        }else{
            return response()->json(
                [
                  
                    'user' => $user,
                    'message' =>"User found",
                    'status' => 1
                ]
                );
        }
    }

    public function comment(Request $request)
    {
        $validateData = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        
        $user = User::where('email', $validateData['email'])->first();
        
        if (!$user) {
            return response()->json(['message' => 'Email not found', 'status' => 0]);
        }
        
        if (!Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid password', 'status' => 0]);
        }
        
        $token = $user->createToken('auth_token')->accessToken;

    //create a comment

    $comment = new Comment;
    $comment->body = $request->body;
    $comment->user_id = $user->id;
    $comment->post_id = $request->post_id;
    $comment->save();


        return response()->json([
            'token' => $token,
            'user' => $user,
            // 'post' => $post,
            'commnet'=>$comment,
            'message' => "Login successful post  and commnet sucessfully ",
            'status' => 1
        ]);
    }
    


    /// edit post



    public function editpost(Request $request, $id)
    {
    $post = Post::find($id);
    
  
        if (!$post) {
            return response()->json(['message' => 'Post not found', 'status' => 0]);
        }
    
        $post->update([
         'title' => $request->title,
         'body' => $request->body
        ]);
    
        return response()->json([
            'post' => $post,
            'message' => "Post edited successfully",
            'status' => 1
        ]);
    }


    public function deletepost($id)
    {
    
    
        $post = Post::find($id);
        $post->comments()->delete();
        $post->delete();
    
        return response()->json([
            'post' => $post,
            'message' => "Post deleted successfully",
            'status' => 1
        ]);
    }








}
