<?php

if (!function_exists('showProfileImage')) {
    function showProfileImage()
    {
        if(!auth()->check()) return null;

        if (auth()->user()->file) {
            if(strpos(auth()->user()->file,'http')!==false)
                return auth()->user()->file;
            else
                return asset('/files/profile/' . auth()->user()->file);
        } else {
            $socialAccount = auth()->user()->socialAccounts()->first();
            if(!empty($socialAccount)){
                return $socialAccount->avatar;
            }else{
                return asset('/images/user-placeholder.png');
            }
        }
    }
}

// byte 표기
if (!function_exists('formatBytes')) {
    function formatBytes($bytes, $precision = 2) {
        $units = ["B", "KB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB"];

        $bytes = max($bytes, 0);
        $power = floor(($bytes ? log($bytes) : 0) / log(1024));
        $power = min($power, count($units) - 1);

        // 바이트 값을 선택된 단위로 변환
        $bytes /= (1 << (10 * $power));

        // 지정된 소수 자릿수로 반올림
        $formatted = round($bytes, $precision);

        // 변환된 값과 단위를 문자열로 반환
        return $formatted . ' ' . $units[$power];
    }
}

// 파일 아이콘
if (!function_exists('fileIcon')) {
    function fileIcon($filename){
        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        switch($extension){
            case 'hwp':
            case 'hwpx':
                $icon_file = 'hwp.gif';
                break;
            case 'jpg':
            case 'jpeg':
            case 'gif':
            case 'png':
            case 'jfif':
            case 'bmp':
                $icon_file = 'img.gif';
                break;
            case 'pdf':
                $icon_file = 'pdf.gif';
                break;
            case 'ppt':
            case 'pptx':
                $icon_file = 'ppt.gif';
                break;
            case 'txt':
                $icon_file = 'txt.gif';
                break;
            case 'mp4':
            case 'avi':
            case 'wmv':
            case 'mpg':
            case 'mpeg':
            case 'mkv':
            case 'mov':
                $icon_file = 'vod.gif';
                break;
            case 'mp3':
            case 'wav':
            case 'wma':
            case 'flac':
                $icon_file = 'wav.gif';
                break;
            case 'doc':
            case 'docx':
                $icon_file = 'word.gif';
                break;
            case 'xls':
            case 'xlsx':
            case 'csv':
                $icon_file = 'xls.gif';
                break;
            case 'zip':
            case 'apk':
            case 'rar':
            case '7z':
                $icon_file = 'zip.gif';
                break;
            default:
                $icon_file = 'default.gif';
                break;
        }

        return "/images/Common/ficon/" . $icon_file;
    }
}

// 날짜형식
if (!function_exists('formatCreatedAt')) {
    function formatCreatedAt($created_at) {
        // 입력된 created_at 문자열을 날짜 객체로 변환
        $date = new DateTime($created_at);
    
        // 현재 시간을 구합니다
        $now = new DateTime();
    
        // 날짜 차이 계산
        $interval = $now->diff($date);
    
        // 오늘, 어제, 또는 날짜 형식에 따라 출력
        if ($interval->d == 0) {
            return '오늘, ' . $date->format('H:i');
        } elseif ($interval->d == 1) {
            return '어제, ' . $date->format('H:i');
        } else {
            return $date->format('Y.m.d H:i');
        }
    }
}