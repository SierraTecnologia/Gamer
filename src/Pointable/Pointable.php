<?php
/**
 * Rotinas de Inclusão de Dados
 */

namespace Gamer\Pointable;

class Pointable
{
    public static function acoes()
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
     */
    public static function sobreVoce()
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

    public static function feedbacks()
    {
        PointType::create(
            [
            'description' => 'De uma boa sugestão para o sistema.',
            'points' => 1
            ]
        );
    }
}
