<?php

namespace Tests\Feature\Common;

use Tests\TestCase;
use App\Models\Menu;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NewspaperAdTest extends TestCase
{
    use RefreshDatabase;
    
    protected function setUp(): void
    {
        parent::setUp();

        // 테스트용 메뉴생성
        $arrMenu = [
            ['code'=>'newspaperad', 'title'=>'신문광고', 'type'=>'P', 'top_image'=>null, 
            'board_id'=>null, 'content_id'=>null, 'program_module'=>'NewspaperAd', 
            'url'=>null, 'is_use'=>1,],
        ];

        Menu::rebuildSubtree(Menu::find(1), $arrMenu);

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
    }

    public function test_신문광고_목록페이지를_볼_수_있다(): void
    {
        $response = $this->get(route('page',3));
        
        $response->assertStatus(200)
            ->assertSee('2023-10-10');
    }
}
