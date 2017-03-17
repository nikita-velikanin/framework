<?php

declare(strict_types=1);

namespace FondBot\Contracts\Channels;

interface WebhookVerification
{
    /**
     * Whether current request type is verification.
     *
     * @return bool
     */
    public function isVerificationRequest(): bool;

    /**
     * Run webhook verification and respond if required.
     *
     * @return mixed
     */
    public function verifyWebhook();
}
