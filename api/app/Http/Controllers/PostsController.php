<?php

namespace App\Http\Controllers;

use App\Http\Requests\Posts\CreatePostRequest;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostsController extends Controller
{
  /**
   * Display a listing of the posts.
   * @return JsonResponse
   * @throws AuthorizationException
   * @version 1.0.0
   * @since 1.0.0
   * @author Pola Eskandar
   */
  public function index(): JsonResponse
  {
    $this->authorize('viewAny', Post::class);

    $posts = Post::with(['comments', 'comments.user', 'user', 'likes'])
      ->where('schedule_on', '<', Carbon::now())
      ->orWhere('schedule_on', NULL)
      ->orderBy('created_at', 'desc')
      ->paginate(4);

    if (count($posts) === 0) return response()->json(['err' => 'No more posts found'], 404);
    else return response()->json(['posts' => $posts]);
  }

  /**
   * Store a newly created post in storage.
   * @param CreatePostRequest $request
   * @return JsonResponse
   * @throws AuthorizationException
   * @since 1.0.0
   * @author Pola Eskandar
   * @version 1.0.0
   */
  public function store(CreatePostRequest $request): JsonResponse
  {
    $this->authorize('create', Post::class);
    $body = $request->validated('body');
    $scheduleOn = $request->validated('schedule_on');

    if (!$scheduleOn) {
      $post = Post::create(['body' => $body, 'user_id' => $request->user()->id, 'schedule_on' => NULL]);
      return response()->json(['post' => $post], 201);
    }

    $startDate = Carbon::parse($scheduleOn)->subHour();
    $endDate = now()->addYear();
    $check = Carbon::parse($scheduleOn)->between($startDate, $endDate);

    if (!$check) return response()->json(['err' => 'Cannot schedule post on the requested time. Please try again...'], 400);
    Post::create(['body' => $body, 'user_id' => $request->user()->id, 'posted_on' => Carbon::parse($scheduleOn)]);
    return response()->json(['msg' => 'Post scheduled successfully.'], 201);
  }

  /**
   * Display the specified resource.
   */
  public function show(Post $post)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Post $post)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Post $post)
  {
    //
  }
}
