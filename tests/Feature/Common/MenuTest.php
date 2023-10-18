<?php

namespace Tests\Feature\Common;

use Tests\TestCase;
use App\Models\Menu;
use App\Models\Content;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MenuTest extends TestCase
{
    use RefreshDatabase;
    
    protected function setUp(): void{
        parent::setUp();

        // 메뉴 탑 이미지 생성
        $file = UploadedFile::fake()->image(public_path('files/menu/bg.jpg'), 1920, 500);
        $image = Image::make($file);
        $image->save(public_path('files/menu/bg.jpg'));
        
        // 메뉴연결용 컨텐츠 생성
        Content::factory()->count(1)->create();

        // 테스트용 메뉴생성
        $arrMenu = [
            ['code'=>'intro', 'title'=>'회사소개', 'type'=>'M', 'top_image'=>'bg.jpg', 'board_id'=>null, 'content_id'=>null, 'url'=>null, 'is_use'=>1,
                'children' => [
                    ['code'=>'intro1', 'title'=>'컨텐츠', 'type'=>'C', 'top_image'=>null, 'board_id'=>null, 'content_id'=>1, 'url'=>null, 'is_use'=>1],
                    ['code'=>'intro2', 'title'=>'준비중', 'type'=>'W', 'top_image'=>null, 'board_id'=>null, 'content_id'=>null, 'url'=>null, 'is_use'=>1],
                ],
            ],
            ['code'=>'sale', 'title'=>'물건관리', 'type'=>'M', 'top_image'=>null, 'board_id'=>null, 'content_id'=>null, 'url'=>null, 'is_use'=>1],
            ['code'=>'board', 'title'=>'게시판', 'type'=>'M', 'top_image'=>null, 'board_id'=>null, 'content_id'=>null, 'url'=>null, 'is_use'=>1,
                'children' => [
                    ['code'=>'notice', 'title'=>'공지사항', 'type'=>'B', 'top_image'=>null, 'board_id'=>null, 'content_id'=>null, 'url'=>null, 'is_use'=>1],
                    ['code'=>'free', 'title'=>'자유게시판', 'type'=>'B', 'top_image'=>null, 'board_id'=>null, 'content_id'=>null, 'url'=>null, 'is_use'=>1],
                    ['code'=>'hidden', 'title'=>'안보이는메뉴', 'type'=>'W', 'top_image'=>null, 'board_id'=>null, 'content_id'=>null, 'url'=>null, 'is_use'=>0],
                ],
            ],
            ['code'=>'menu1', 'title'=>'1차메뉴', 'type'=>'M', 'top_image'=>null, 'board_id'=>null, 'content_id'=>null, 'url'=>null, 'is_use'=>1,
                'children' => [
                    ['code'=>'menu11', 'title'=>'2차메뉴', 'type'=>'M', 'top_image'=>null, 'board_id'=>null, 'content_id'=>1, 'url'=>null, 'is_use'=>1,
                        'children' => [
                            ['code'=>'menu111', 'title'=>'3차메뉴', 'type'=>'W', 'top_image'=>null, 'board_id'=>null, 'content_id'=>1, 'url'=>null, 'is_use'=>1]
                        ],
                    ],
                ],
            ],
        ];

        Menu::rebuildSubtree(Menu::find(1), $arrMenu);
        // $menu = Menu::defaultOrder()->withDepth()->descendantsOf(1)->toTree()->toArray();

        // dd($menu);
    }

    public function tearDown(): void
    {
        parent::tearDown();

        unlink(public_path('files/menu/bg.jpg'));
    }


    public function test_사용자화면에_메뉴가_표시된다(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        $response->assertSeeTextInOrder(['회사소개', '컨텐츠', '준비중', '물건관리', '게시판', '공지사항', '자유게시판']);
    }

    public function test_메뉴연결페이지에_상단이미지가_잘_표시된다(): void
    {
        $response = $this->get(route('page',4));

        $response->assertStatus(200)
            ->assertSee('files/menu/bg.jpg');
    }

    public function test_메뉴연결페이지에_로케이션이_잘_표시된다(): void
    {
        $response = $this->get(route('page',13));

        $response->assertStatus(200)
            ->assertSeeTextInOrder(['1차메뉴', '2차메뉴', '3차메뉴']);;
    }

    public function test_컨텐츠메뉴화면이_잘_표시된다(): void
    {
        $content = Menu::find(4)->content->content;

        $response = $this->get(route('page',4));

        $response->assertStatus(200)
            ->assertSee($content);
    }

    public function test_게시판메뉴화면이_잘_표시된다(): void
    {
        $content = Menu::find(4)->content->content;

        $response = $this->get(route('page',4));

        $response->assertStatus(200)
            ->assertSee($content);
    }


    public function test_준비중메뉴화면이_잘_표시된다(): void
    {
        $response = $this->get(route('page',5));

        $response->assertStatus(200);
    }
}
