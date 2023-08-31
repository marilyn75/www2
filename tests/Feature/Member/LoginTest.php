<?php

namespace Tests\Feature\Member;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_로그인_화면을_열_수_있다(): void
    {
        $response = $this->get(route('login'));

        $response->assertStatus(200);
    }

    public function test_로그인_상태에서_접근_시_메인페이지로_이동한다(): void
    {
        // 로그인한 상태를 가정
        $user = User::factory()->create();
        $this->actingAs($user);

        // 로그인 페이지 이동 후 리디렉션
        $response = $this->get(route('login'))
            ->assertRedirect(route('main'))
            ->assertStatus(302);

    }

    public function test_로그인_성공(): void
    {
        $payload = ['name'=>'홍길동', 'email'=>'test@test.com', 'password'=>bcrypt('123456')];
        User::create($payload);

        $response = $this->post(route('login'),['email'=>'test@test.com', 'password'=>'123456']);
        $this->assertAuthenticated('web');
        $response->assertStatus(302);

    }

    public function test_로그인_실패_시_에러메세지_표시한다(): void
    {
        $payload = ['name'=>'홍길동', 'email'=>'test@test.com', 'password'=>bcrypt('123456')];
        User::create($payload);

        $response = $this->post(route('login'),['email'=>'test@test.com', 'password'=>'111111']);
        
        $response->assertSessionHas('error_message','이메일 또는 비밀번호가 유효하지 않습니다.')
            ->assertStatus(302);
    }

    public function test_로그아웃(): void
    {
        $response = $this->get(route('logout'));
        $this->assertGuest('web');
        $response->assertStatus(302);
    }
}
