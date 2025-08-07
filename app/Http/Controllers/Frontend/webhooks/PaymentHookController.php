<?php

namespace App\Http\Controllers\Frontend\webhooks;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Psr\Log\LoggerInterface;
class PaymentHookController extends Controller
{

    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }


    protected function validateGithubWebhook($known_token, Request $request)
    {
        if (($signature = $request->headers->get('X-Hub-Signature')) == null) {
            throw new BadRequestHttpException('Header not set');
        }

        $signature_parts = explode('=', $signature);

        if (count($signature_parts) != 2) {
            throw new BadRequestHttpException('signature has invalid format');
        }

        $known_signature = hash_hmac('sha1', $request->getContent(), $known_token);

        if (! hash_equals($known_signature, $signature_parts[1])) {
            throw new UnauthorizedException('Could not verify request signature ' . $signature_parts[1]);
        }
    }


    /**
     * Entry point to our webhook handler
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function handle(Request $request)
    {
//        $this->validateGithubWebhook(config('app.webhook_secret'), $request);
        $this->validateGithubWebhook('123456', $request);
        $this->logger->info('Hello. finally The webhook is validated');
        $this->logger->info($request->getContent());
        DB::table('webhook_calls')->insert([
            'name' => 'webhook',
            'payload' => 'working'
        ]);
    }
}
