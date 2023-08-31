<?php

namespace Tests\Feature\Member;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfileTest extends TestCase
{

    use RefreshDatabase;

    public function test_로그인_상태에서_회원정보_수정_페이지를_볼_수_있다(): void
    {
        // 로그인한 상태를 가정
        $user = User::factory()->create();
        $this->actingAs($user);
        
        $response = $this->get(route('profile'));

        $response->assertStatus(200);
    }

    public function test_로그아웃_상태에서_접근하면_로그인_페이지로_이동한다(): void
    {
        // 로그인 페이지 이동
        $response = $this->get(route('profile'));
        $response->assertRedirect(route('login'))
            ->assertStatus(302);
    }

    public function test_회원정보를_변경_할_수_있다(): void
    {

        $t = Storage::fake('public');
        $image = UploadedFile::fake()->image('profile.jpg');
        
        // 로그인한 상태를 가정
        $user = User::factory()->create(['password'=>bcrypt('old_password')]);
        $this->actingAs($user);

        $payload = [
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

        $response = $this->post(route('profile'),$payload);
        unset($payload['file']);
        sleep(1);
        $this->assertDatabaseHas('users', $payload);
        $data = User::find($user->id);
        $filename = $data->file;
        unlink(public_path()."/files/profile/".$filename);

        $response->assertSessionHas('success_message','회원정보가 변경 되었습니다.')
            ->assertStatus(302);


    }
}
