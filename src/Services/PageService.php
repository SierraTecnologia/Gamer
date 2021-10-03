<?php

namespace Gamer\Services\Points;

use Gamer\Entities\Points\Type;

class PageService
{

    protected $type = false;

    public function __construct(Type $type)
    {
        $this->type = $type;
    }

    /**
     * @return static
     */
    public static function getService(Type $type): self
    {
        return new static($type);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getView()
    {
        return view('gamer::pages.points.index');
    }

}
