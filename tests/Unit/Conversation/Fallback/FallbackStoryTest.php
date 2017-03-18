<?php

declare(strict_types=1);

namespace Tests\Unit\Conversation\Fallback;

use FondBot\Channels\Telegram\TelegramDriver;
use FondBot\Contracts\Events\MessageSent;
use FondBot\Conversation\Context;
use FondBot\Conversation\ContextManager;
use FondBot\Conversation\Fallback\FallbackInteraction;
use FondBot\Conversation\Fallback\FallbackStory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Classes\FakeDriver;
use Tests\TestCase;

/**
 * @property \FondBot\Conversation\Fallback\FallbackStory story
 */
class FallbackStoryTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp()
    {
        parent::setUp();

        $this->story = new FallbackStory;
    }

    public function test_activations()
    {
        $this->assertSame([], $this->story->activations());
    }

    public function test_firstInteraction()
    {
        $this->assertSame(FallbackInteraction::class, $this->story->firstInteraction());
    }

    public function test_after()
    {
        $context = new Context(new FakeDriver);

        $contextManager = $this->mock(ContextManager::class);
        $contextManager->shouldReceive('save')->once();
        $contextManager->shouldReceive('clear')->once();

        $this->expectsEvents(MessageSent::class);

        $this->story->setContext($context);
        $this->story->run();
    }
}