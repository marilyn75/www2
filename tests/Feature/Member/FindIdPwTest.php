<?php

namespace Tests\Feature\Member;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FindIdPwTest extends TestCase
{
    use RefreshDatabase;

    public function test_이메일찾기_화면을_열_수_있다(): void
    {
        $response = $this->get(route('findid'));

        $response->assertStatus(200);

        // 로그인한 상태를 가정
        $user = User::factory()->create();
        $this->actingAs($user);

        // 로그인 페이지 이동 후 리디렉션
        $response = $this->get(route('login'))
            ->assertRedirect(route('main'))
            ->assertStatus(302);
    }

    // public function test_유효성검사가_잘_된다(): void
    // {
    //     $response = $this->post(route('findid'), ['phone'=>'010-000-0000']);

    //     $response->assertStatus(302);
    //     $response->assertSessionHasErrors(['이름 필드는 필수입니다.']);
    // }

    public function test_일치하는_데이터가_없으면_에러메세지를_표시한다(): void
    {
        $response = $this->post(route('findid'), ['name'=>'홍길동', 'phone'=>'010-000-0000']);
        $response->assertSessionHas('error_message','일치하는 회원정보가 없습니다.')
            ->assertStatus(302);
    }

    public function test_일치하는_데이터가_있으면_이메일을_표시한다(): void
    {
        $user = User::factory()->create();

        $response = $this->post(route('findid'), ['name'=>$user->name, 'phone'=>$user->phone]);
        $response->assertSeeText($user->email)
            ->assertStatus(200);
    }

    public function test_비밀번호찾기_화면을_열_수_있다(): void
    {
        $response = $this->get(route('findpw'));

        $response->assertStatus(200);

        // 로그인한 상태를 가정
        $user = User::factory()->create();
        $this->actingAs($user);

        // 로그인 페이지 이동 후 리디렉션
        $response = $this->get(route('login'))
            ->assertRedirect(route('main'))
            ->assertStatus(302);
    }
}
