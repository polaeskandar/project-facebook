<?php

namespace App\Models;

use App\Notifications\SendVerificationLink;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
  use HasApiTokens, HasFactory, Notifiable;

  protected $fillable = ['name', 'email', 'password'];
  protected $hidden = ['password', 'remember_token'];
  protected $casts = ['email_verified_at' => 'datetime'];

  public function sendEmailVerificationNotification(): void { $this->notify(new SendVerificationLink); }

  public function posts(): HasMany { return $this->hasMany(Post::class); }
  public function comments(): HasMany { return $this->hasMany(Comment::class); }
  public function likes(): HasMany { return $this->hasMany(Like::class); }
  public function roles(): BelongsToMany { return $this->belongsToMany(Role::class)->withTimestamps(); }
  public function profileImages(): HasMany { return $this->hasMany(ProfileImage::class, 'user_id', 'id'); }
  public function currentProfileImage() { return $this->profileImages()->latest(); }

  public function friendsSender()
  {
    return $this->belongsToMany(User::class, 'friend_requests', 'sender_id', 'receiver_id')
      ->wherePivot('accepted_on', '<>', 'NULL');
  }

  public function friendsReceiver()
  {
    return $this->belongsToMany(User::class, 'friend_requests', 'receiver_id', 'sender_id')
      ->wherePivot('accepted_on', '<>', 'NULL');
  }

  public function pendingRequests()
  {
    return $this->belongsToMany(User::class, 'friend_requests', 'receiver_id', 'sender_id')
      ->whereNull('friend_requests.accepted_on')->whereNull('friend_requests.deleted_at');
  }

  public function getFriendsAttribute()
  {
    if (!array_key_exists('friends', $this->relations)) {
      $friends = $this->friendsSender->merge($this->friendsReceiver);
      $this->setRelation('friends', $friends);
    }

    return $this->getRelation('friends');
  }

  public function friendsSuggestion()
  {
    $friendRequestsIdsQuery = DB::table('friend_requests')
      ->where('sender_id', '=', auth()->id())
      ->orWhere('receiver_id', auth()->id())
      ->get(['sender_id', 'receiver_id']);

    $friendRequestsIdsArray = [];

    foreach ($friendRequestsIdsQuery as $key => $value) {
      array_push($friendRequestsIdsArray, $value->sender_id);
      array_push($friendRequestsIdsArray, $value->receiver_id);
    }

    $friendRequestsIdsArray = array_unique($friendRequestsIdsArray);

    $randomUsers = $this->where('id', '!=', auth()->id())->inRandomOrder()->limit(5)->get();
    return $randomUsers->filter(function ($user) use ($friendRequestsIdsArray) {
      $userId = $user->id;
      if (in_array($userId, $friendRequestsIdsArray)) return false;
      else return true;
    });
  }

  public function getFriendsSuggestionAttribute()
  {
    if (!array_key_exists('friendsSuggestion', $this->relations)) {
      $friendsSuggestion = $this->friendsSuggestion();
      $this->setRelation('friendsSuggestion', $friendsSuggestion);
    }

    return $this->getRelation('friendsSuggestion');
  }
}
