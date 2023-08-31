<?php

namespace Tests\Feature\Member;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_회원가입_페이지를_볼_수_있다(): void
    {
        // $response = $this->get('/member/register');
        $response = $this->get(route('register'));
        
        $response->assertStatus(200);
    }

    public function test_로그인_상태에서_접근_시_메인페이지로_이동된다(): void
    {
        // 로그인한 상태를 가정
        $user = User::factory()->create();
        $this->actingAs($user);

        // 로그인 페이지 이동 후 리디렉션
        $response = $this->get(route('login'))
            ->assertRedirect(route('main'))
            ->assertStatus(302);

    }

    public function test_회원가입_저장_시_유효성_검사가_잘_된다(): void
    {
        $payload = ['name'=>'홍길동', 'email'=>'test@test.com', 'password'=>'123456', 'password_confirmation'=>'123456'];
        $response = $this->post('/member/register',$payload);

        // Assert that no validation errors are present...
        $response->assertValid();

        // // Assert that the given keys do not have validation errors...
        // $response->assertValid(['name', 'email']);
    }

    public function test_회원가입_시_이메일_중복체크를_한다(): void
    {
        $data = User::factory()->create();
        
        $payload = ['name'=>'홍길동', 'email'=>$data->email, 'password'=>'123456', 'password_confirmation'=>'123456'];
        $response = $this->post('/member/register',$payload);

        $response->assertSessionHas('error_message','이미 가입된 이메일 입니다.')
            ->assertStatus(302);
    }

    public function test_회원가입_처리가_잘_된다(): void
    {
        $payload = ['name'=>'홍길동', 'email'=>'test@test.com', 'password'=>'123456', 'password_confirmation'=>'123456'];
        $response = $this->post('/member/register',$payload);

        $data = User::first();
        
        unset($payload['password_confirmation']);
        unset($payload['password']);
        
        $this->assertDatabaseHas('users',$payload);
        $response->assertRedirect(route('login'));
    }
}
    