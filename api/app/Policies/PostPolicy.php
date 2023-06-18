<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
  /**
   * Determine whether the user can view any models.
   * @param ?User $user
   * @return Response
   * @since 1.0.0
   * @author Pola Eskandar
   * @version 1.0.0
   */
  public function viewAny(?User $user): Response { return Response::allow(); }

  /**
   * Determine whether the user can view the model.
   * @param ?User $user
   * @param Post $post
   * @return Response
   * @since 1.0.0
   * @author Pola Eskandar
   * @version 1.0.0
   */
  public function view(?User $user, Post $post): Response { return Response::allow(); }

  /**
   * Determine whether the user can create posts.
   * @param User $user
   * @return Response
   */
  public function create(User $user): Response
  {
    return $user->hasVerifiedEmail()
      ? Response::allow()
      : Response::deny('Creating new post forbidden. Please verify your email');
  }

  /**
   * Determine whether the user can update the model.
   * @param User $user
   * @param Post $post
   * @return Response
   */
  public function update(User $user, Post $post): Response { }

  /**
   * Determine whether the user can delete the model.
   * @param User $user
   * @param Post $post
   * @return Response
   */
  public function delete(User $user, Post $post): Response
  {
    return $user->id === $post->user->id
      ? Response::allow()
      : Response::deny('You cannot delete this post!');
  }

  /**
   * Determine whether the user can restore the model.
   * @param User $user
   * @param Post $post
   * @return Response
   */
  public function restore(User $user, Post $post): Response { }

  /**
   * Determine whether the user can permanently delete the model.
   * @param User $user
   * @param Post $post
   * @return Response
   */
  public function forceDelete(User $user, Post $post): Response { }

  /**
   * Determine whether the user can like posts.
   * @param User $user
   * @return Response
   */
  public function likePost(User $user): Response
  {
    return $user->hasVerifiedEmail()
      ? Response::allow()
      : Response::deny('Liking posts forbidden. Please verify your email');
  }
}
