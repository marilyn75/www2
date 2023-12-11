<?php

namespace Tests\Feature\Admin;

use App\Models\NewspaperAd;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\UploadedFile;
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

        // 테스트용 데이터 생성
        $data = NewspaperAd::factory(10)->create();
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

    public function test_신문광고를_등록_할_수_있다(): void
    {
        /** 파일 첨부 테스트 **/ 
        $file = UploadedFile::fake()->create('testfile.pdf');
        
        /** 신문광고 저장 처리 **/
        $payload = [
            'news_code' => 70,
            'news_txt' => '부산일보',
            'pub_date' => '2023-10-10',
            'file' => $file,
        ];

        $response = $this->post(route('admin.newspaper-ads.store'), $payload);
        unset($payload['file']);
        $this->assertDatabaseHas('newspaper_ads', $payload);
        $this->assertDatabaseHas('module_files', ['module_code' => 'newspaperad','filename_org' => 'testfile.pdf']);

        $model = NewspaperAd::orderBy('id','desc')->first();
        $file_data = $model->file();
        
        $this->assertFileExists(public_path($file_data->filepath . $file_data->filename));

        unlink(public_path($file_data->filepath . $file_data->filename)); // 테스트 파일 삭제
       
        $response->assertSessionHas('success_message','신문광고가 등록 되었습니다.')
            ->assertStatus(302);
    }

    public function test_수정하기_페이지로_접근이_가능하다(): void
    {
        $data = NewspaperAd::first();

        $response = $this->get(route('admin.newspaper-ads.edit', $data->id));
        $response->assertStatus(200);
    }

    public function test_신문광고를_수정_할_수_있다(): void
    {
        // 테스트 데이터  //////////////////////////////////////////////////////
        /** 파일 첨부 테스트 **/ 
        $pre_file = UploadedFile::fake()->create('testfile.pdf');
        
        /** 신문광고 저장 처리 **/
        $pre_payload = [
            'news_code' => 70,
            'news_txt' => '부산일보',
            'pub_date' => '2023-10-10',
            'file' => $pre_file,
        ];

        $response = $this->post(route('admin.newspaper-ads.store'), $pre_payload);
        // 테스트 데이터  //////////////////////////////////////////////////////
        $model = NewspaperAd::orderBy('id','desc')->first();
        $pre_file_data = $model->file();

        $file = UploadedFile::fake()->create('testfile2.pdf');
        $payload = [
            'news_code' => 71,
            'news_txt' => '국제신문',
            'pub_date' => '2023-12-06',
            'file' => $file,
        ];

        $response = $this->post(route('admin.newspaper-ads.update', $model->id), $payload);
        unset($payload['file']);
        $this->assertDatabaseHas('newspaper_ads', $payload);
        $this->assertDatabaseHas('module_files', ['module_code' => 'newspaperad','module_data_id' => $model->id,'filename_org' => 'testfile2.pdf']);

        $file_data = NewspaperAd::where('id', $model->id)->first()->file();

        $this->assertFileDoesNotExist(public_path($pre_file_data->filepath . $pre_file_data->filename));
        $this->assertFileExists(public_path($file_data->filepath . $file_data->filename));

        unlink(public_path($file_data->filepath . $file_data->filename)); // 테스트 파일 삭제

        $response->assertSessionHas('success_message','신문광고가 수정 되었습니다.')
            ->assertStatus(302);

    }

    public function test_신문광고를_삭제_할_수_있다():void
    {

        // 테스트 데이터  //////////////////////////////////////////////////////
        /** 파일 첨부 테스트 **/ 
        $pre_file = UploadedFile::fake()->create('testfile.pdf');
        
        /** 신문광고 저장 처리 **/
        $pre_payload = [
            'news_code' => 70,
            'news_txt' => '부산일보',
            'pub_date' => '2023-10-10',
            'file' => $pre_file,
        ];

        $response = $this->post(route('admin.newspaper-ads.store'), $pre_payload);
        // 테스트 데이터  //////////////////////////////////////////////////////
        $model = NewspaperAd::orderBy('id','desc')->first();
        $pre_file_data = $model->file();

        // Ajax Post 요청, 데이터 삭제처리 호출
        $response = $this->json('POST', route('admin.newspaper-ads.destroy', $model->id), ['_token'=>csrf_token()]);

        // 데이터베이스에서 삭제된 것을 확인
        $this->assertDatabaseMissing('newspaper_ads', ['id' => $model->id, 'deleted_at'=>null]);

        // 첨부파일 데이터 삭제 확인
        $this->assertDatabaseMissing('module_files', ['module_code'=>'newspaperad', 'module_data_id' => $model->id, 'deleted_at'=>null]);

        $this->assertFileDoesNotExist(public_path($pre_file_data->filepath . $pre_file_data->filename));
        
    }
}
