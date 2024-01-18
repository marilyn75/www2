<?php

namespace Tests\Feature\Member;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LeaveTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_로그인_상태에서_회원탈퇴_페이지를_볼_수_있다(): void
    {
        // 로그인한 상태를 가정
        $user = User::factory()->create();
        $this->actingAs($user);
        
        $response = $this->get(route('leave'));

        $response->assertStatus(200);
    }

    public function test_로그아웃_상태에서_접근하면_로그인_페이지로_이동한다(): void
    {
        // 로그인 페이지 이동
        $response = $this->get(route('leave'));
        $response->assertRedirect(route('login'))
            ->assertStatus(302);
    }

}
