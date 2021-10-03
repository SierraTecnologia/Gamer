<?php
/**
 * Procura trampos
 */

namespace Gamer\Processing;

use Log;
use App\Models\User;

class Pointable
{
    protected $referenceComponent;

    public function __construct()
    {
        
    }
    
    /**
     * @return static
     */
    public function setComponent($component): self
    {
        $this->component = $component;
        return $this;
    }
    
    public function setReferenceComponent($referenceComponent): void
    {
        $this->referenceComponent = $referenceComponent;
    }

    public function run(): void
    {

    }
    
    public function profileToProfile(): void
    {
        // Get Points from Profile Fa

    }
    
    public function postToProfile(Post $post, Profile $profile)
    {
        return ($post->countLikes()*1)+($post->countComments()*3);
    }

}
