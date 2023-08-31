<?php

namespace Tests\Feature\Member;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChangePasswordTest extends TestCase
{
    use RefreshDatabase;

    public function test_로그아웃_상태에서_접근하면_로그인_페이지로_이동한다(): void
    {
        // 로그인 페이지 이동
        $response = $this->get(route('changepw'));
        $response->assertRedirect(route('login'))
            ->assertStatus(302);
    }

    public function test_로그인_상태에서_비밀번호변경_페이지를_볼_수_있다(): void
    {
        // 로그인한 상태를 가정
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('changepw'));
        $response->assertStatus(200);
    }

    public function test_현재_비밀번호가_다른경우_에러메세지_표시(): void
    {
        // 로그인한 상태를 가정
        $user = User::factory()->create();
        $this->actingAs($user);

        $payload = [
            'curr_password' => 'wrong_password',
            'password' => 'new_password',
            'password_confirmation' => 'new_password',
        ];

        $response = $this->post(route('changepw'),$payload);

        $response->assertSessionHas('error_message','현재 비밀번호가 불일치 합니다.')
            ->assertStatus(302);
    }

    public function test_비밀번호_변경을_할_수_있다(): void
    {
        // 로그인한 상태를 가정
        $user = User::factory()->create(['password'=>bcrypt('old_password')]);
        $this->actingAs($user);

        $payload = [
            'curr_password' => 'old_password',
            'password' => 'new_password',
            'password_confirmation' => 'new_password',
        ];

        $response = $this->post(route('changepw'),$payload);

        $response->assertSessionHas('success_message','비밀번호가 변경 되었습니다.')
            ->assertStatus(302);

        // 비밀번호 변경 후 로그인 상태를 확인 (예를 들어, 로그인 페이지로 리디렉션하는지 확인)
        Auth::logout();
        $this->assertGuest(); // 로그인하지 않은 상태임을 확인

        // 변경된 비밀번호로 다시 로그인 시도 (새로운 비밀번호로 로그인 성공하는지 확인)
        $loginAttempt = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'new_password',
        ]);

        // 변경된 비밀번호로 로그인 성공하는지 확인
        $this->assertAuthenticated('web');
        $loginAttempt->assertStatus(302);

    }
}
