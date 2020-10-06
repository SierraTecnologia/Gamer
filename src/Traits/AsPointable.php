<?php
/**
 * @todo Fazer aqui essa trait
 */

namespace Gamer\Traits;

use Log;
use Pedreiro\Models\Base;
use Auth;
use Illuminate\Database\Eloquent\Builder;

trait AsPointable
{

    public static function bootAsPointable()                                                                                                                                                             
    {

        // static::deleting(function (self $user) {
        //     optional($user->photos)->each(function (Photo $photo) {
        //         $photo->delete();
        //     });
        // });
    }
    
    // public function registerMediaConversions(Media $media = null)
    // {
    //     $this->addMediaConversion('thumb')
    //         ->width(50)
    //         ->height(50);
    // }

    // /**
    //  * @return \Illuminate\Database\Eloquent\Relations\HasMany
    //  */
    // public function photos()
    // {
    //     return $this-->getMedia();
    // }
}
