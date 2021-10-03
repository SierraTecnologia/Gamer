<?php

namespace Gamer\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Models\User;
use Gamer\Models\Role;
use Gamer\Services\PaymentGatewayService;
use Log;
use Gamer\Tools\Organizer;

class RoutineOrganizerCreateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $companyToken;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, $companyToken)
    {
        $this->user = $user;
        $this->companyToken = $companyToken;
    }

    /**
     * Execute the job.
     *
     * @return bool
     */
    public function handle(): bool
    {
        $organizerResult = Organizer::getOrganizerServiceForUser($this->user, $this->companyToken)->foundOrganizerDataByToken();
        if (empty($organizerResult)) {
            return false;
        }

        DB::table('users')->firstOrCreate(
            [
            'name'              => $organizerResult['name'],
            'cpf'               => $organizerResult['cpf'],
            'email'             => $organizerResult['email'],
            'password'          => bcrypt('q1w2e3r4'.rand()),
            'token'             => \SiUtils\Helper\General::generateToken(),
            'token_public'      => $this->companyToken,
            'role_id'           => Role::$CLIENT
            ]
        );

        return true;
    }
}
