<?php
/**
 * Rotinas de Inclusão de Dados
 */

namespace Gamer\Pointable;

class Pointable
{
    public static function acoes(): void
    {
        PointType::create(
            [
            'description' => 'Interaja com Alguem',
            'points' => 1
            ]
        );
    }

    /**
     * Complete seu Perfil
     *
     * @return void
     */
    public static function sobreVoce(): void
    {
        PointType::create(
            [
            'description' => 'Preencha seu Whatsapp',
            'points' => 1
            ]
        );
        PointType::create(
            [
            'description' => 'Complete 100% o seu Perfil',
            'points' => 1
            ]
        );
    }

    public static function feedbacks(): void
    {
        PointType::create(
            [
            'description' => 'De uma boa sugestão para o sistema.',
            'points' => 1
            ]
        );
    }
}
