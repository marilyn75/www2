<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NewspaperAdsTest extends TestCase
{
    use RefreshDatabase, SoftDeletes;

    protected function setUp(): void{
        parent::setUp();

        // 테스트용 가짜 관리자 생성 및 로그인
        $user = User::factory()->state(['is_admin'=>1])->create();
        $this->actingAs($user);
    }

    public function test_관리자가_아닌_경우_접근이_불가하다(): void
    {
        // 로그아웃
        auth()->logout();

        // 로그인안한 상태는 메인으로 이동
        $response = $this->get(route('admin.newspaper-ads',1));
        $response->assertRedirect(route('main'))
            ->assertStatus(302);

        // 로그인한 상태를 가정 관리자가 아닌 경우 메인으로 이동
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get(route('admin.newspaper-ads',1));
        $response->assertRedirect(route('main'))
            ->assertStatus(302);
    }

    public function test_신문광고관리_리스트_페이지에_접근할_수_있다(): void
    {
        $response = $this->get(route('admin.newspaper-ads'));
        $response->assertStatus(200);
    }

    public function test_데이터테이블용_데이터를_불러올_수_있다(): void
    {
        $response = $this->getJson(route('admin.newspaper-ads.data',1), ['X-Requested-With' => 'XMLHttpRequest']);
        $response->assertJson(['draw'=>0]);
        //$response->assertJson(['']);
    }

    public function test_등록하기_페이지로_접근이_가능하다(): void
    {
        $response = $this->get(route('admin.newspaper-ads.create'));
        $response->assertStatus(200);
    }
}
