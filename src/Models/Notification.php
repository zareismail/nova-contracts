<?php

namespace Zareismail\NovaContracts\Models;

use Illuminate\Database\Eloquent\Model;
use Zareismail\NovaContracts\Notifications\NotificationCreated;

class Notification extends Model  
{  	 
    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'data' => 'json',
        'read_at' => 'datetime',
        'created_at' => 'datetime',
    ];


    /**
     * Bootstrap the model and its traits.
     *
     * @return void
     */
    public static function boot()
    {
    	parent::boot();

    	static::created(function($notification) {
    		$user = $notification->notifiable instanceof \Illuminate\Contracts\Auth\Authenticatable
						? $notification->notifiable
						: request()->user();

    		$user->notify(new NotificationCreated($notification));
    	});

    	static::saving(function($notification) {
    		$notification->fillForNotificationCreated();
    	});
    }

    public function fillForNotificationCreated()
    {
    	$this->forceFill([
    		'id' 	=> time(),
    		'type' 	=> NotificationCreated::class,
    	]); 
    }

	/**
	 * Query the notifiable model.
	 * 
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function notifiable()
	{
		return $this->morphTo();
	}

	/**
	 * Return`s the notification title.
	 * 
	 * @return string
	 */
	public function title()
	{
		return data_get($this->data, 'title');
	}

	/**
	 * Return`s the notification level.
	 * 
	 * @return string
	 */
	public function level()
	{
		return data_get($this->data, 'level');
	}
}
