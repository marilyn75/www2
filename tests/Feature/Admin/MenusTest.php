<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Models\Menu;
use App\Models\User;
use App\Models\Content;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MenusTest extends TestCase
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
        $response = $this->get(route('admin.menus',1));
        $response->assertRedirect(route('main'))
            ->assertStatus(302);

        // 로그인한 상태를 가정 관리자가 아닌 경우 메인으로 이동
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get(route('admin.menus',1));
        $response->assertRedirect(route('main'))
            ->assertStatus(302);
    }
    
    public function test_메뉴관리_목록_페이지_접근이_가능하다(): void
    {
        $response = $this->get(route('admin.menus',1));
        $response->assertStatus(200);
    }

    public function test_메뉴추가_페이지_접근이_가능하다(): void
    {
        $response = $this->get(route('admin.menus.create',1));
        $response->assertStatus(200);
    }

    public function test_메뉴추가_처리가_잘_된다(): void
    {
        $image = UploadedFile::fake()->image('menu-bg.jpg', 2000, 650);
        
        $payload = [
            'title' => '고객센터',
            'code' => 'center',
            'type' => 'M',
            'url' => '/center',
            'top_image' => $image,
        ];

        $response = $this->post(route('admin.menus.store',1), $payload);  // pc 1차 메뉴

        // 1차메뉴 하위로 데이터 저장 체크
        $payload['parent_id'] = 1;
        unset($payload['top_image']);

        // 디비체크
        $this->assertDatabaseHas('menus', $payload);

        // 테스트 이미지 삭제
        $data = Menu::orderBy('id', 'desc')->first();
        unlink(public_path('files/menu/'.$data['top_image']));

        // 하위메뉴 추가 처리
        $payload = [
            'title' => '회사소개',
            'code' => 'greeting',
            'type' => 'L',
            'url' => '/greeting',
        ];

        $response = $this->post(route('admin.menus.store',$data['id']), $payload);  // pc 2차 메뉴
        $payload['parent_id'] = $data['id'];
        // 디비체크
        $this->assertDatabaseHas('menus', $payload);


        $response->assertSessionHas('success_message','메뉴가 생성 되었습니다.')
            ->assertStatus(302);
    }

    public function test_메뉴수정_페이지에_접근할_수_있다(): void
    {
        Menu::factory()->state(['parent_id'=>1])->count(1)->create();
        $menu = Menu::latest()->first();

        $response = $this->get(route('admin.menus.edit',$menu->id));
        $response->assertStatus(200);
    }

    public function test_메뉴를_수정_할_수_있다(): void
    {
        Menu::factory()->state(['parent_id'=>1])->count(1)->create();
        $menu = Menu::orderBy('id', 'desc')->first();

        $payload = [
            'title' => '회사소개',
            'code' => 'greeting',
            'type' => 'L',
            'url' => '/greeting',
        ];
        $response = $this->post(route('admin.menus.update', $menu->id), $payload);
        $payload['id'] = $menu->id;
        // 디비체크
        $this->assertDatabaseHas('menus', $payload);

        $response->assertSessionHas('success_message','메뉴가 수정 되었습니다.')
            ->assertStatus(302);
    }

    public function test_메뉴를_삭제_할_수_있다(): void
    {
        Menu::factory()->state(['parent_id'=>1])->count(1)->create();
        $menu = Menu::orderBy('id', 'desc')->first();

        Menu::factory()->state(['parent_id'=>$menu->id])->count(3)->create();

        // 상위메뉴를 삭제하면 하위메뉴도 같이 삭제됨

        // Ajax Post 요청, 데이터 삭제처리 호출
        $response = $this->json('POST', route('admin.menus.destroy', $menu->id), ['_token'=>csrf_token()]);

        $response->assertStatus(200);

        // 리턴값 확인
        $response->assertJsonFragment(['result'=>true]);

        // 데이터베이스에서 삭제된 것을 확인
        $delMenu = Menu::descendantsAndSelf($menu->id);
        foreach($delMenu as $_dm){
            $this->assertDatabaseMissing('menus', ['id'=>$_dm->id]);
        }
    }

    public function test_메뉴순서변경_페이지에_접근할_수_있다(): void
    {
        Menu::factory()->state(['parent_id'=>1])->count(1)->create();
        $menu = Menu::orderBy('id', 'desc')->first();

        Menu::factory()->state(['parent_id'=>$menu->id])->count(3)->create();

        $response = $this->get(route('admin.menus.create',5));
        $response->assertStatus(200);
    }

    public function test_메뉴순서를_일괄_수정_할_수_있다(): void
    {
        Menu::factory()->state(['parent_id'=>1])->count(1)->create();
        $menu = Menu::orderBy('id', 'desc')->first();

        $newMenus = Menu::factory()->state(['parent_id'=>$menu->id])->count(3)->create();
        foreach($newMenus as $_mn){
            $ids[] = $_mn->id;
        }

        $tree = Menu::descendantsOf(1)->toTree();
        dd($tree->toArray());
        
        

        $r = Menu::rebuildSubtree(Menu::find(1), $tree);
        print_r($r);
        dd($tree);
    }

    public function test_메뉴옵션을_일괄_수정_할_수_있다(): void
    {
        Menu::factory()->state(['parent_id'=>1])->count(1)->create();
        $menu = Menu::orderBy('id', 'desc')->first();

        $newMenus = Menu::factory()->state(['parent_id'=>$menu->id])->count(3)->create();

        foreach($newMenus as $_mn){
            $ids[] = $_mn->id;
        }
        
        $payload = [
            'gubun' => 'left',
            'root' => $menu->id,
            'chk_use' => [$ids[1]],
        ];

        $response = $this->post(route('admin.menus.option'), $payload);

        $compareData = ['id'=> $ids[0], 'is_use' => 0];
        $this->assertDatabaseHas('menus', $compareData);
        $compareData = ['id'=> $ids[1], 'is_use' => 1];
        $this->assertDatabaseHas('menus', $compareData);
        $compareData = ['id'=> $ids[2], 'is_use' => 0];
        $this->assertDatabaseHas('menus', $compareData);

        $response->assertSessionHas('success_message','옵션이 수정 되었습니다.')
        ->assertStatus(302);
    }
}
