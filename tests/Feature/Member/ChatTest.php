<?php

namespace Tests\Feature\Member;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChatTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void{
        parent::setUp();

        // 테스트용 가짜 관리자 생성
        $user = User::factory()->state(['is_admin'=>1])->create();
    }

    public function test_로그인_전이면_로그인하라는_안내표시(): void
    {
        $response = $this->get(route('chat'));

        $response->assertStatus(200)
            ->assertSeeText('로그인 후');
    }

    public function test_로그인_후이면_채팅창으로_리디렉션(): void
    {
        // 로그인한 상태를 가정
        $user = User::factory()->create();
        $this->actingAs($user);

        $targetUser = User::where('is_admin', 1)->first();
        
        $response = $this->get(route('chat'), ['target_id'=>$targetUser->id]);

        $user->refresh();
        $channel = $user->chatUserChannels->first()->channel->channel;

        $this->assertDatabaseHas('chat_users', [
            'channel_id' => $user->chatUserChannels->first()->channel->id,
            'user_id' => $user->id,
        ]);
        $this->assertDatabaseHas('chat_users', [
            'channel_id' => $user->chatUserChannels->first()->channel->id,
            'user_id'=>$targetUser->id,
        ]);
        
        $response->assertStatus(302)
            ->assertRedirect(route('chat', $channel));
    }

    // public function test_메세지를_실시간으로_주고_받을_수_있다(): void
    // {
    //     // 두개의 다른 사용자 인증 (사용자 / 관리자)
    //     $user = User::factory()->create();
    //     $this->actingAs($user);

    //     $admin = User::where('is_admin', 1)->first();
    //     $this->actingAs($admin);
    // }
}
