<?php

namespace Gamer\Pointable\Mapeamento;

use Gamer\Pointable\Pointable;

class Video extends Pointable
{
    public static $POINTS = 1;
    public static $STEPS = 2;

    /**
     * @return string[]
     *
     * @psalm-return array{0: 'Assista videos e ganhe 1 ponto por pergunta respondida!'}
     */
    public static function description(): array
    {
        return [
            'Assista videos e ganhe 1 ponto por pergunta respondida!'
        ];
    }

    public static function stepZero(): void
    {
        // Procura por Video não Potuado
        $video = Video::rand();

        // Assista o VIdeo e Clique em Assisti.
        $video->url;
    }


    public static function stepOne(): void
    {


    }
    
}