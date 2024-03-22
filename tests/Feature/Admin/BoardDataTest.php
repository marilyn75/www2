<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Models\User;
use App\Models\BoardConf;
use App\Models\BoardData;
use App\Models\BoardFile;
use App\Models\TmpFile;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BoardDataTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void{
        parent::setUp();

        // 테스트용 가짜 관리자 생성 및 로그인
        $user = User::factory()->state(['is_admin'=>1])->create();
        $this->actingAs($user);

        // 게시판설정 데이터 세팅
        $conf = BoardConf::factory()->create(['file_num'=>3, 'file_type'=>'pdf']);

        // 게시판 데이터 세팅
        $data = BoardData::factory(10)->create(['board_id'=>$conf->first()->id]);
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

    public function test_게시판_데이터관리_리스트페이지에_접근이_가능하다(): void
    {
        $response = $this->get(route('admin.board',1));
        $response->assertStatus(200);
    }

    public function test_게시판아이디가_게시판설정에_없으면_경고페이지로_이동(): void
    {
        $response = $this->get(route('admin.board',2));
        $response->assertStatus(200)
            ->assertSeeText('존재하지 않는 게시판 입니다.');
    }

    public function test_데이터테이블용_데이터를_불러올_수_있다(): void
    {
       
        $response = $this->getJson(route('admin.board.data',1), ['X-Requested-With' => 'XMLHttpRequest']);
        $response->assertJson(['draw'=>0]);
        //$response->assertJson(['']);
    }

    public function test_글쓰기_페이지로_접근이_가능하다(): void
    {
        $response = $this->get(route('admin.board.create',1));
        $response->assertStatus(200);
    }

    public function test_게시글을_작성_할_수_있다(): void
    {

        /** 파일 첨부 테스트 **/ 
        $ss_id = md5(uniqid()); // 첨부 게시판용 유니크값 생성
        $file = UploadedFile::fake()->create('testfile.pdf');
        $payload = [
            'mupfile' => $file,
            'board_conf_id' => 1,
            'file_ss_id' => $ss_id,
            'module' => 'board',
        ];

        $response = $this->post(route('common.file.upload'), $payload); // 임시파일저장
        $response->assertStatus(200);
        $this->assertDatabaseHas('tmpfiles',['ss_id'=>$ss_id]); // 데이터 저장 확인
        $tmp_file = TmpFile::where('ss_id',$ss_id)->first();
        $this->assertFileExists(public_path($tmp_file->filepath . $tmp_file->filename));

        /** 게시물 저장 처리 **/
        $payload = [
            'title' => Str::limit(fake()->sentence(), 30),
            'content' => fake()->paragraph(5),
            'tmpfile_idx' => [1],
        ];

        $response = $this->post(route('admin.board.store',1), $payload);
        unset($payload['tmpfile_idx']);
        $this->assertDatabaseHas('board_datas', $payload);
        $this->assertDatabaseHas('board_files', ['filename' => $tmp_file->filename]);

        $board_file = BoardFile::where('filename', $tmp_file->filename)->first();
        $this->assertFileExists(public_path($board_file->filepath . $board_file->filename));

        unlink(public_path($board_file->filepath . $board_file->filename)); // 테스트 파일 삭제
       
        $response->assertSessionHas('success_message','게시글이 등록 되었습니다.')
            ->assertStatus(302);
    }

    public function test_게시글을_볼_수_있다(): void
    {
        // 임시 게시글 저장
        $data = BoardData::factory(1)->create(['board_id'=>1]);
        
        $response = $this->get(route('admin.board.show',$data->first()->id));
        $response->assertStatus(200)
            ->assertSeeText($data->first()->title);

    }

    public function test_게시글수정_페이지에_접근할_수_있다(): void
    {
        $board_data = BoardData::first();
        $response = $this->get(route('admin.board.edit',$board_data->id));
        $response->assertStatus(200);
    }

    public function test_게시글을_수정_할_수_있다(): void
    {
        $board_data = BoardData::first();

        $payload = [
            'title' => Str::limit(fake()->sentence(), 30),
            'content' => fake()->paragraph(5),
        ];

        $response = $this->post(route('admin.board.update',$board_data->id),$payload);
        
        $this->assertDatabaseHas('board_datas', $payload);
       
        $response->assertSessionHas('success_message','게시글이 수정 되었습니다.')
            ->assertStatus(302);
    }

    public function test_게시글을_삭제_할_수_있다(): void
    {
        $board_data = BoardData::first();

        // Ajax Post 요청, 데이터 삭제처리 호출
        $response = $this->json('POST', route('admin.board.destroy', $board_data->id), ['_token'=>csrf_token()]);

        $response->assertStatus(200);

        // 리턴값 확인
        $response->assertJsonFragment(['result'=>true]);

        // 데이터베이스에서 삭제된 것을 확인
        $this->assertDatabaseMissing('board_datas', ['id' => $board_data->id, 'deleted_at'=>null]);

        // 첨부파일 데엍 삭제 확인
        $this->assertDatabaseMissing('board_files', ['board_data_id' => $board_data->id, 'deleted_at'=>null]);
    }
}
