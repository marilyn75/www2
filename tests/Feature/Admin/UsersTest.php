<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersTest extends TestCase
{
    use RefreshDatabase;

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
        $response = $this->get(route('admin.users'));
        $response->assertRedirect(route('main'))
            ->assertStatus(302);

        // 로그인한 상태를 가정 관리자가 아닌 경우 메인으로 이동
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get(route('admin.users'));
        $response->assertRedirect(route('main'))
            ->assertStatus(302);
    }

    public function test_회원관리_페이지에_접근할_수_있다(): void
    {
        $response = $this->get(route('admin.users'));
        $response->assertStatus(200);
    }

    public function test_데이터테이블용_데이터를_불러올_수_있다(): void
    {
        $user = User::factory(5)->create();
        $response = $this->getJson(route('admin.users.data'), ['X-Requested-With' => 'XMLHttpRequest']);
        $response->assertJson(['draw'=>0]);
        //$response->assertJson(['']);
    }

    public function test_회원정보수정_페이지에_접근할_수_있다(): void
    {
        $user = User::factory()->create();
        $response = $this->get(route('admin.users.edit',$user->id));
        $response->assertStatus(200);
    }

    public function test_회원정보를_변경_할_수_있다(): void
    {
        $user = User::factory()->create();

        $image = UploadedFile::fake()->image('profile.jpg');

        $payload = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'company' => '회사명',
            'position' => '직책',
            'phone' => '010-0000-0000',
            'zip_code' => '12345',
            'address' => '도로명 또는 지번 주소',
            'address_detail' => '상세주소',
            'file' => $image,
        ];

        $response = $this->post(route('admin.users.update'),$payload);
        unset($payload['file']);
        sleep(1);
        $this->assertDatabaseHas('users', $payload);
        $data = User::find($user->id);
        $filename = $data->file;
        if(!empty($filename))    unlink(public_path("/files/profile/".$filename)); // 테스트 파일 삭제

        $response->assertSessionHas('success_message','회원정보가 변경 되었습니다.')
            ->assertStatus(302);
    }

    public function test_회원정보를_삭제_할_수_있다(): void
    {
        $user = User::factory()->create();

        // Ajax Post 요청, 데이터 삭제처리 호출
        $response = $this->json('POST', route('admin.users.destroy', $user->id), ['_token'=>csrf_token()]);

        $response->assertStatus(200);

        // 리턴값 확인
        $response->assertJsonFragment(['result'=>true]);

        // 데이터베이스에서 삭제된 것을 확인
        $this->assertDatabaseMissing('users', ['id' => $user->id, 'deleted_at'=>null]);
    }

    public function test_패스워드를_변경_할_수_있다(): void
    {
        $user = User::factory()->create();
        $password = "1234567";

        $payload = [
            'id' => $user->id,
            'password' => $password,
            'password_confirmation' => '1111111',
        ];
        
        // 유효성 검사
        $this->postJson(route('admin.users.changepassword'),$payload)
            ->assertJsonValidationErrors(['password']);

        $payload['password_confirmation'] = $password;
        $response = $this->post(route('admin.users.changepassword'),$payload);

        // 패스워드가 변경 되었는지 체크
        $this->assertTrue(Hash::check($password, $user->fresh()->password));

        $response->assertSessionHas('success_message','비밀번호가 변경 되었습니다.')
            ->assertStatus(302);
    }
}
