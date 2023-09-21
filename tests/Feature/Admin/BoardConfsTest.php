<?php

namespace Tests\Feature\Admin;

use App\Models\BoardConf;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BoardConfsTest extends TestCase
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
        $response = $this->get(route('admin.board-confs'));
        $response->assertRedirect(route('main'))
            ->assertStatus(302);

        // 로그인한 상태를 가정 관리자가 아닌 경우 메인으로 이동
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get(route('admin.board-confs'));
        $response->assertRedirect(route('main'))
            ->assertStatus(302);
    }

    public function test_게시판관리_페이지에_접근할_수_있다(): void
    {
        $response = $this->get(route('admin.board-confs'));
        $response->assertStatus(200);
    }

    public function test_데이터테이블용_데이터를_불러올_수_있다(): void
    {
        BoardConf::factory(5)->create();
        $response = $this->getJson(route('admin.board-confs.data'), ['X-Requested-With' => 'XMLHttpRequest']);
        $response->assertJson(['draw'=>0]);
        //$response->assertJson(['']);
    }

    public function test_게시판을_생성_할_수_있다(): void
    {
        $payload = [
            'board_name' => 'board_name',
            'skin' => 'board',
            'use_comment' => '1',
            'use_secret' => '1',
            'file_num' => '5',
            'file_type' => 'png,jpg,jpeg',
            'file_size' => 2097152,
            'file_total_size' => 83886080,
        ];

        $response = $this->post(route('admin.board-confs.store', $payload));

        $this->assertDatabaseHas('board_confs', $payload);
        
        $response->assertSessionHas('success_message','게시판이 생성 되었습니다.')
            ->assertStatus(302);
    }

    public function test_게시판설정수정_페이지에_접근할_수_있다(): void
    {
        $board_conf = BoardConf::factory()->create();
        $response = $this->get(route('admin.board-confs.edit',$board_conf->id));
        $response->assertStatus(200);
    }

    public function test_게시판_설정을_수정_할_수_있다(): void
    {
        $board_conf = BoardConf::factory()->create();

        $payload = [
            'id' => $board_conf->id,
            'board_name' => 'board_name',
            'skin' => 'board',
            'use_comment' => '1',
            'use_secret' => '1',
            'file_num' => '5',
            'file_type' => 'png,jpg,jpeg',
            'file_size' => 2097152,
            'file_total_size' => 83886080,
        ];

        $response = $this->post(route('admin.board-confs.update'),$payload);
        
        $this->assertDatabaseHas('board_confs', $payload);
       
        $response->assertSessionHas('success_message','게시판 설정이 수정되었습니다.')
            ->assertStatus(302);
    }

    public function test_게시판을_삭제_할_수_있다(): void
    {
        $board_conf = BoardConf::factory()->create();

        // Ajax Post 요청, 데이터 삭제처리 호출
        $response = $this->json('POST', route('admin.board-confs.destroy', $board_conf->id), ['_token'=>csrf_token()]);

        $response->assertStatus(200);

        // 리턴값 확인
        $response->assertJsonFragment(['result'=>true]);

        // 데이터베이스에서 삭제된 것을 확인
        $this->assertDatabaseMissing('board_confs', ['id' => $board_conf->id, 'deleted_at'=>null]);
    }
}
