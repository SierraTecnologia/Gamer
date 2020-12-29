<?php

namespace Gamer\Models;

use Illuminate\Database\Eloquent\Model;

class GamerEvent extends Model
{
    /**
     * @var string
     */
    protected $table = 'gamer_events';

    /**
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $fillable = [
      'event',
      'user_id',
      'position',
      'value'
    ];
    
    public $formFields = [
        ['name' => 'event', 'label' => 'Event', 'type' => 'text'],
        ['name' => 'position', 'label' => 'Position', 'type' => 'text'],
        ['name' => 'value', 'label' => 'Value', 'type' => 'text'],
        ['name' => 'user_id', 'label' => 'User', 'type' => 'select', 'relationship' => 'user'],
    ];

    public $indexFields = [
        'event',
        'user_id',
        'position',
        'value'
    ];

  
    // /**
    //  * @return \Illuminate\Database\Eloquent\Relations\MorphTo
    //  */
    // public function pointable()
    // {
    //     return $this->morphTo();
    // }

    // /**
    //  * @param Model $pointable
    //  *
    //  * @return static
    //  */
    //  public function getCurrentPoints(Model $pointable)
    //  {
    //      $currentPoint = Transaction::
    //      where('pointable_id', $pointable->id)
    //      ->where('pointable_type', $pointable->getMorphClass())
    //      ->orderBy('created_at', 'desc')
    //      ->pluck('current')->first();

    //      if (!$currentPoint) {
    //        $currentPoint = 0.0;
    //      }

    //      return $currentPoint;
    //  }

    // /**
    //  * @param Model $pointable
    //  * @param $amount
    //  * @param $message
    //  * @param $data
    //  *
    //  * @return static
    //  */
    // public function addTransaction(Model $pointable, $amount, $message, $data = null)
    // {
    //     $transaction = new static();
    //     $transaction->amount = $amount;

    //     $transaction->current = $this->getCurrentPoints($pointable) + $amount;

    //     $transaction->message = $message;
    //     if ($data) {
    //       $transaction->fill($data);
    //     }
    //     // $transaction->save();
    //     $pointable->transactions()->save($transaction);

    //     return $transaction;
    // }
}
